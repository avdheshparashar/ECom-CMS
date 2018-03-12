<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Size extends CI_Controller {
class Field extends Admin_Controller {

	function __construct() {
    	parent::__construct();
			$this->load->library('form_validation');       
    	}
    	
	function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."field/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['fields'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Fields List";
		$this->layout->view_render('admin/field/index', $response);
	}

	public function add()
	{
		$this->layout->view_render('admin/field/add');
	}

	public function edit($fieldid) {
		$page['field_id'] = $fieldid;
		$response['title'] = "BugleCMS - Update Field";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."field/records?field_id=".$fieldid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['fielddetail'] = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		curl_close($ch);
		$this->layout->view_render('admin/field/edit', $response);
	}

	function export() {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."field/records");
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
		$phpExcel->getActiveSheet()->mergeCells('A1:C1');
				//manage row hight
		$phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
				//style alignment
		$styleArray = array(
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
		);
//		$phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);					
		$phpExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
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
 			   $phpExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(10);
		}
		$phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$prestasi->setCellValue('A1', 'Attribute');
		$phpExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleArray);
		$phpExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleArray1);
		$phpExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleArray12);
		
		$prestasi->setCellValue('A2', 'No');
		$prestasi->setCellValue('B2', 'Attribute ID');
		$prestasi->setCellValue('C2', 'Values');						
		$no=0;
		$rowexcel = 2;
		
		foreach ($response[0]['data'] as $key=>$val) {
			$no++;
			$rowexcel++;
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel,':C'.$rowexcel)->applyFromArray($styleArray);
											
			$prestasi->setCellValue('A'.$rowexcel, $no);
			$prestasi->setCellValue('B'.$rowexcel, $val['field_id']);
			$prestasi->setCellValue('C'.$rowexcel, $val['content']);																																			
		}
		set_time_limit(0);
		ini_set('memory_limit','25000001M');
		$prestasi->setTitle('Attribute');
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"attribute.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$objWriter->save("php://output");	
		redirect('/index');	

	}	


	public function save() {
	
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
			$field = $_POST;
			
			$this->form_validation->set_rules('name', 'Attribute Name', 'required');
			$this->form_validation->set_rules('content', 'Attribute Value', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->display_error_msg(validation_errors());
		        return redirect('/field/index');
		    }		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."field/add");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$field);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
			$response = (array) json_decode(curl_exec($ch),true);
			$response['title'] = "BugleCMS - Field Update";
			if($response[0]['status']=='true') {
				$this->display_success_msg($response[0]['message']);
			} else {
				$this->display_error_msg($response[0]['message']);
			}
			curl_close($ch);
			redirect('/field/index');
		}else{
			redirect('/field/index');
		}
	}

	public function cancel() {
		$size = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."field/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$size);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}		
		$response['title'] = "BugleCMS - Delete Field";
		curl_close($ch);
		redirect('/field/index');
	}
	

}