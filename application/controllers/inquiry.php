<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Inquiry extends CI_Controller {
class Inquiry extends Admin_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
   	}

	
	function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inquiry/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['inquiries'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - inquiries List";
		$this->layout->view_render('admin/inquiry/index', $response);
	}

	function export() {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inquiry/records");
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
		$phpExcel->getActiveSheet()->mergeCells('A1:G1');
				//manage row hight
		$phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
				//style alignment
		$styleArray = array(
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
		);
//		$phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);					
		$phpExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);
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
	
		$phpExcel->getActiveSheet()->freezePane('G3');
				//coloum width
		
	
		foreach(range('A2','G2') as $columnID) {
 			   $phpExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(10);
		}
		$phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$prestasi->setCellValue('A1', 'Inquiry');
		$phpExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);
		$phpExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray1);
		$phpExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray12);
		
		$prestasi->setCellValue('A2', 'No');
		$prestasi->setCellValue('B2', 'Product Name');
		$prestasi->setCellValue('C2', 'Customer Name');
		$prestasi->setCellValue('D2', 'Message');
		$prestasi->setCellValue('E2', 'Email');
		$prestasi->setCellValue('F2', 'Mobile');
		$prestasi->setCellValue('G2', 'Inquiry Date');
		$no=0;
		$rowexcel = 2;
		
		foreach ($response[0]['data'] as $key=>$val) {
			$no++;
			$rowexcel++;
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel,':G'.$rowexcel)->applyFromArray($styleArray);
											
			$prestasi->setCellValue('A'.$rowexcel, $no);
			$prestasi->setCellValue('B'.$rowexcel, $val['Product Name']);
			$prestasi->setCellValue('C'.$rowexcel, $val['Customer Name']);																																			
			$prestasi->setCellValue('D'.$rowexcel, $val['message']);
			$prestasi->setCellValue('E'.$rowexcel, $val['email']);
			$prestasi->setCellValue('F'.$rowexcel, $val['mobilenumber']);
			$prestasi->setCellValue('G'.$rowexcel, $val['created']);
		}
		set_time_limit(0);
		ini_set('memory_limit','25000001M');
		$prestasi->setTitle('Inquiry');
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"inquiry.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$objWriter->save("php://output");	
		redirect('/index');	

	}	



	public function reply($inquiryid) {
		$inquiry['inquiry_id'] = $inquiryid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inquiry/reply");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$inquiry);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		$response['title'] = "BugleCMS - Inquiry Replied";
		curl_close($ch);
		redirect('/inquiry/index');
	}


	public function cancel() {
		$inquiry = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inquiry/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$inquiry);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}		
		$response['title'] = "BugleCMS - DElete Inquiry";
		curl_close($ch);
		redirect('/inquiry/index');
	}	

	public function save() {
		$inquiry = $_POST;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inquiry/saveinquiry");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$inquiry);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}		
		$response['title'] = "BugleCMS - Inquiry Update";
		curl_close($ch);
		redirect('/inquiry/index');		
	}

}