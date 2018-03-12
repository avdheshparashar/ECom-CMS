<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Brand extends CI_Controller {
class Brand extends Admin_Controller {
	public function index($brandid=null) {
		$ch = curl_init();
		if($brandid!=null) {
			$this->load->model('brand_model'); 
			$response['branddetail'] = $this->brand_model->getbyid($brandid);
			//var_dump($branddetail);
		}
		curl_setopt($ch, CURLOPT_URL, API_URL."brand/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['brands'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Brands List";
		curl_close($ch);
		$this->layout->view_render('admin/brand/index', $response);
	}

	function export() {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."brand/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		set_time_limit (0);
		ini_set('memory_limit','25000001M');
		$this->load->library("PHPExcel");
		$phpExcel = new PHPExcel();
		$prestasi = $phpExcel->setActiveSheetIndex(0);
		set_time_limit (0);
		
		
				//merger
		$phpExcel->getActiveSheet()->mergeCells('A1:B1');
				//manage row hight
		$phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
				//style alignment
		$styleArray = array(
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
		);
//		$phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);					
		$phpExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
				//border
		$styleArray1 = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		  )
		);
				//background
		$styleArray12 = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => 'FFEC8B',
				),
			),
		);
	//	$phpExcel->columnIndexFromString($column);				//freeepane
	
	$phpExcel->getActiveSheet()->freezePane('A3');
				//coloum width
		
	
	foreach(range('A2','B2') as $columnID) {
 			   $phpExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(50);
		}
	
		$prestasi->setCellValue('A1', 'Brand');
		$phpExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray);
		$phpExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray1);
		$phpExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray12);
		
		$prestasi->setCellValue('A2', 'No');
		$prestasi->setCellValue('B2', 'Name');				
		
		$no=0;
		$rowexcel = 2;
		
		foreach ($response[0]['data'] as $key=>$val) {
			$no++;
			$rowexcel++;
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel,':B'.$rowexcel)->applyFromArray($styleArray);
											
			$prestasi->setCellValue('A'.$rowexcel, $no);
			$prestasi->setCellValue('B'.$rowexcel, $val['name']);																																					
		}
		set_time_limit(0);
		ini_set('memory_limit','25000001M');
		$prestasi->setTitle('Subscriber');
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"brand.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$objWriter->save("php://output");	
		redirect('/index');	

	}	

	public function cancel() {
		$brand = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."brand/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$brand);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		
		$response['title'] = "BugleCMS - Delete Brand";
		curl_close($ch);
		redirect('/brand/index');
	}	


	public function save() {
		$brand = $_POST;
		$config['upload_path'] = './assests/images/brands/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
  		$this->load->library("image_lib");

        if((int) $_FILES['banner_image']['size'] != 0) {
            if(!$this->upload->do_upload('banner_image')){ 
	        	$error = $this->upload->display_errors();
	        	$this->display_error_msg($error);
	        	return redirect('brand/index');
	        } else {
	        	$data_upload_files = $this->upload->data();
	        	
				$config_thumb = array(
					"image_library" => "gd2",
					"source_image" => "assests/images/brands/".$_FILES['banner_image']['name'],
					"create_thumb" => FALSE,
					"new_image" => "assests/images/brands/".$_FILES['banner_image']['name'],
					"maintain_ratio" => TRUE,
					"thumb_marker" =>  '',
					"width" => 1000,
					"height" => 192
				);

				// initializing
				$this->image_lib->initialize($config_thumb);
				if (!$this->image_lib->resize()) {
					$error = $this->image_lib->display_errors("<p>", "</p>");
					$this->session->set_flashdata("photo_error",$error);
					// print_r($error);
					// die();
				}	
				$brand['banner_image'] = $_FILES['banner_image']['name'];        	
	        }
    	}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."brand/savebrand");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$brand);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = curl_exec($ch);
		$response['title'] = "BugleCMS - Brand Update";
		curl_close($ch);
		redirect('/brand/index');		
	}

}
