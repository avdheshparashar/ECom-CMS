<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Subscriber extends CI_Controller {
class Subscriber extends Admin_Controller {

	
	public function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."subscriber/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['subscribers'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Subscribers List";
		curl_close($ch);
		$this->layout->view_render('admin/subscriber/index', $response);
	}

	function export() {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."subscriber/records");
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
	
		$prestasi->setCellValue('A1', 'Subscriber');
		$phpExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray);
		$phpExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray1);
		$phpExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray12);
		
		$prestasi->setCellValue('A2', 'No');
		$prestasi->setCellValue('B2', 'Email');				
		
		$no=0;
		$rowexcel = 2;
		
		foreach ($response[0]['data'] as $key=>$val) {
			$no++;
			$rowexcel++;
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel,':B'.$rowexcel)->applyFromArray($styleArray);
											
			$prestasi->setCellValue('A'.$rowexcel, $no);
			$prestasi->setCellValue('B'.$rowexcel, $val['email']);																																					
		}
		set_time_limit(0);
		ini_set('memory_limit','25000001M');
		$prestasi->setTitle('Subscriber');
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"subscriber.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$objWriter->save("php://output");	
		redirect('/index');	

	}

	public function add()
	{
		$this->layout->view_render('admin/slideshow/add');
	}
	public function edit()
	{
		$this->layout->view_render('admin/slideshow/edit');
	}
}


