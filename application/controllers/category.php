<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Category Controller
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		BugleCMS
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Viral Thakkar
 * @Date		16th March 2015
 * @link		http://104.236.210.247/buglecms/index.php/category/
*/


// class Category extends CI_Controller {
class Category extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

	public function index() {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."category/recordsweb");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER,0);
		$response['categories'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/category/index',$response);
	}

	function export() {

		$this->load->model('category_model'); 
		$categoies = $this->category_model->getcategory();
		
		set_time_limit (0);
		ini_set('memory_limit','25000001M');
		$this->load->library("PHPExcel");
		$phpExcel = new PHPExcel();
		$prestasi = $phpExcel->setActiveSheetIndex(0);
		set_time_limit (0);
		
		
				//merger
		$phpExcel->getActiveSheet()->mergeCells('A1:E1');
				//manage row hight
		$phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
				//style alignment
		$styleArray = array(
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
		);
//		$phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);					
		$phpExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);
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
		
	
	foreach(range('A2','E2') as $columnID) {
 			   $phpExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(50);
		}
	
		$prestasi->setCellValue('A1', 'Category');
		$phpExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray);
		$phpExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray1);
		$phpExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray12);
		
		$prestasi->setCellValue('A2', 'No');
		$prestasi->setCellValue('B2', 'Category ID');
		$prestasi->setCellValue('C2', 'Category Name');						
		$prestasi->setCellValue('D2', 'Parent Name');		
		$prestasi->setCellValue('E2', 'No. of Products');			
		$no=0;
		$rowexcel = 2;
		
		foreach ($categoies as $key=>$val) {
			$no++;
			$rowexcel++;
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel,':E'.$rowexcel)->applyFromArray($styleArray);
											
			$prestasi->setCellValue('A'.$rowexcel, $no);
			$prestasi->setCellValue('B'.$rowexcel, $val['category_id']);
			$prestasi->setCellValue('C'.$rowexcel, $val['category_name']);
			$prestasi->setCellValue('D'.$rowexcel, $val['parent_name']);
			$prestasi->setCellValue('E'.$rowexcel, $val['no_of_products']);																																					
		}
		set_time_limit(0);
		ini_set('memory_limit','25000001M');
		$prestasi->setTitle('Category');
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"category.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$objWriter->save("php://output");	
		redirect('/index');	

	}	

	public function save() {

		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			$this->form_validation->set_rules('name', 'Category Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('page_title', 'page_title', 'required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
			$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');

			if ($this->form_validation->run() == FALSE) {
					$flashdata = array(
			            "class" => "alert-error",
			            "message" => validation_errors()
			        );

			        $this->session->set_userdata('flash_message', $flashdata );
	                return redirect('category/add');
	        }


			$category = $_POST;	
			$config['upload_path'] = './assests/images/categories/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $this->load->library('upload', $config);
     		$this->load->library("image_lib");

	        if(!$this->upload->do_upload('image_name')){ 
	        	$error = $this->upload->display_errors();
	        	$this->display_error_msg($error);
	        	return redirect('category/add');
	        } else {
	        	$data_upload_files = $this->upload->data();

	        	if($_POST['parent_id']=='' || $_POST['parent_id'] == 'null') {
	        		$width = 317;
	        		$height = 216;
	        	} else {
	        		$width = 250;
	        		$height = 280;
	        	}


				$config_thumb = array(
					"image_library" => "gd2",
					"source_image" => "assests/images/categories/".$_FILES['image_name']['name'],
					"create_thumb" => FALSE,
					"new_image" => "assests/images/categories/".$_FILES['image_name']['name'],
					"maintain_ratio" => TRUE,
					"thumb_marker" =>  '',
					"width" => $width,
					"height" => $height
				);

					// initializing
				$this->image_lib->initialize($config_thumb);
				if (!$this->image_lib->resize()) {
					$error = $this->image_lib->display_errors("<p>", "</p>");
					$this->session->set_flashdata("photo_error",$error);
				}	

	        	$category['image_name'] = $_FILES['image_name']['name'];
	        }
			if($_FILES['banner_image']['size']!=0) {
				$config['upload_path'] = './assests/images/categories/';
		        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		        $this->load->library('upload', $config);
		  		$this->load->library("image_lib");

		        if(!$this->upload->do_upload('banner_image')){ 
		        	$error = $this->upload->display_errors('<div style="color:red">','</div>');
		        	$this->session->set_flashdata('slider_error',$error);
		        } else {
		        	$data_upload_files = $this->upload->data();

					$config_thumb = array(
						"image_library" => "gd2",
						"source_image" => "assests/images/categories/".$_FILES['banner_image']['name'],
						"create_thumb" => FALSE,
						"new_image" => "assests/images/categories/".$_FILES['banner_image']['name'],
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
					}		        	

		        	$category['banner_image'] = $_FILES['banner_image']['name'];
		        }
		    }
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."category/add");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$category);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
			$response = (array) json_decode(curl_exec($ch),true);
			if($response[0]['status']=='true') {
				$this->display_success_msg($response[0]['message']);
			} else {
				$this->display_error_msg($response[0]['message']);
			}
			$response['title'] = "BugleCMS - Category Add";
			curl_close($ch);
		}
		redirect('/category/index');		
	}

	public function update() {
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			$this->form_validation->set_rules('name', 'Category Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('page_title', 'page_title', 'required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
			$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->display_error_msg(validation_errors());
	            return redirect('category/edit/'.$this->input->post('category_id'));
	        }
	        
			$category = $_POST;
			if($_FILES['image_name']['size']!=0) {
				$config['upload_path'] = './assests/images/categories/';
		        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		        $this->load->library('upload', $config);
		        if(!$this->upload->do_upload('image_name')){ 
		        	$error = $this->upload->display_errors('<div style="color:red">','</div>');
		        	$this->session->set_flashdata('slider_error',$error);
		        } else {
		        	$data_upload_files = $this->upload->data();
		        	$category['image_name'] = $_FILES['image_name']['name'];
		        }
		    }
			if($_FILES['banner_image']['size']!=0) {
				$config['upload_path'] = './assests/images/categories/';
		        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		        $this->load->library('upload', $config);
		        if(!$this->upload->do_upload('banner_image')){ 
		        	$error = $this->upload->display_errors('<div style="color:red">','</div>');
		        	$this->session->set_flashdata('slider_error',$error);
		        } else {
		        	$data_upload_files = $this->upload->data();
		        	$category['banner_image'] = $_FILES['banner_image']['name'];
		        }
		    }
		    if($category['parent_id'] =='') {
                $category['parent_id'] = 0;
            } else {
	            $category['parent_id'] = (int) $category['parent_id'];
            }
            $category['category_id'] = (int) $category['category_id'];
            $this->load->model('category_model'); 
            $this->category_model->update($category);  
            $this->display_success_msg("Category Updated Successfully");
			// $ch = curl_init();
			// curl_setopt($ch, CURLOPT_URL, API_URL."category/update1");
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			// curl_setopt($ch, CURLOPT_HEADER, FALSE);
			// curl_setopt($ch, CURLOPT_POST, TRUE);
			// curl_setopt($ch, CURLOPT_POSTFIELDS,$category);
			// curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
			// $response = (array) json_decode(curl_exec($ch),true);

			// if($response[0]['status']=='true') {
			// 	$this->display_success_msg($response[0]['message']);
			// } else {
			// 	$this->display_error_msg($response[0]['message']);
			// }			
			// curl_close($ch);
		}
		redirect('/category/index');		
	}

	public function add() {
		$this->load->model('category_model'); 
		$categories = $this->category_model->fetch_categories();
		foreach ($categories as $key => $value) {
			$list[$value['category_id']] = $value['name'];
		}
		$categories['list'] = $list;
		$this->layout->view_render('admin/category/add',$categories);
	}

	public function edit($categoryid) {

		$category['category_id'] = $categoryid;
		$response['title'] = "BugleCMS - Update Category";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."category/recordsweb?category_id=".$categoryid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER,0);
		$response['categorydetails'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->load->model('category_model'); 
		$categories = $this->category_model->fetch_categories();
		foreach ($categories as $key => $value) {
			$list[$value['category_id']] = $value['name'];
		}
		$response['list'] = $list;
		$this->layout->view_render('admin/category/edit', $response);
	}

	public function delete($categoryid) {
        $category['category_id'] = (int) $categoryid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."category/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$category);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		$response['title'] = "BugleCMS - Delete Category";
		curl_close($ch);
		redirect('/category/index');		
	}

}


