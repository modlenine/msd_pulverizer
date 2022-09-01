<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exportdata_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        require("PHPExcel/Classes/PHPExcel.php");
        
    }



    public function exportdata_fromtemplate($mainformno)
    {

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->setActiveSheetIndex(0);
            //กำหนดส่วนหัวเป็น Column แบบ Fix ไม่มีการเปลี่ยนแปลงใดๆ
            $objPHPExcel->getActiveSheet()->setCellValue('a1', 'Run Screen');
            $objPHPExcel->getActiveSheet()->setCellValue('b1', 'S/Point');
            //กำหนดส่วนหัวเป็น Column แบบ Fix ไม่มีการเปลี่ยนแปลงใดๆ


            //สรา้งส่วนหัวตามการ Loop ของข้อมูลโดยใช้สูตรการรนับตัวอักษรเข้ามาช่วย เพื่อให้ให้ PhpExcel นั้นสร้างข้อมูลใน Column ถัดๆไปของ Excel นั่นเองตัวอย่างเช่น ข้อมูลตั้งต้นอยู่ที่ Column C1 ข้อมูลชุดถัดไปนั้นจะต้องสร้างที่ Column D1 และ E1 ....ถัดไปเรื่อยๆจนจบชุดข้อมูล
            $ii = 1;
            $cha = "b";
            if(getWorktime2($mainformno)->num_rows() != 0){
                  foreach(getWorktime2($mainformno)->result() as $rs){//Main Loop
              
                      $detailFormno[]=$rs->far_detail_formno;
                      
                      $next_cha = ++$cha; 
                      //The following if condition prevent you to go beyond 'z' or 'Z' and will reset to 'a' or 'A'.
                      // if (strlen($next_cha) > 1) 
                      // {
                      // $next_cha = $next_cha[0];
                      // }
                      $objPHPExcel->getActiveSheet()->setCellValue($next_cha.$ii, convertTimeToShift($rs->far_worktime)."\n".$rs->far_worktime);
                      $objPHPExcel->getActiveSheet()->getStyle($next_cha.$ii)->getAlignment()->setWrapText(true);                 
                  
                        $i = 2;
                        foreach(get_runscreen_name($mainformno)->result() as $rsx){//Loop runscreen name , S/Point

                              $objPHPExcel->getActiveSheet()->setCellValue('a' . $i , $rsx->far_runscreen_name);
                              $objPHPExcel->getActiveSheet()->getColumnDimension('a')->setAutoSize(true);
                              $objPHPExcel->getActiveSheet()->setCellValue('b' . $i , valueFormat($rsx->far_runscreen_value));

                              foreach($detailFormno as $rss){//Loop Runscreen Value
                                  $runValue = get_time_value($rss , $rsx->far_runscreen_linenum , $mainformno);
                                  $objPHPExcel->getActiveSheet()->setCellValue($next_cha.$i , valueFormat($runValue));
                              }
                              $i++;
                        }
                  }//Main Loop
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Export Machine Setup เลขที่ '.$mainformno.'.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            echo $objWriter->save('php://output');
    }

    public function exportdata($m_code)
    {

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->setActiveSheetIndex(0);
            //กำหนดส่วนหัวเป็น Column แบบ Fix ไม่มีการเปลี่ยนแปลงใดๆ

            $machinenameEx = "Machine Name : ".getviewfulldata($m_code)->m_template_name;
            $batchnumberEx = "Batch Number : ".getviewfulldata($m_code)->m_batch_number;
            $productionnumberEx = "Production Number : ".getviewfulldata($m_code)->m_product_number;
            $itemnumberEx = "Item Number : ".getviewfulldata($m_code)->m_item_number;

            $typeofbag = "Type of bag : ".getviewfulldata($m_code)->m_typeofbag;
            $typeofbagtxt = "Bag text : ".getviewfulldata($m_code)->m_typeofbagtxt;
            $bladetype = "Blade Type : ".getviewfulldata($m_code)->m_bladeType;
            $screenMesh = "Screen (Mesh) : ".getviewfulldata($m_code)->m_screenMesh;
            $gap = "Gap : ".getviewfulldata($m_code)->m_gap;

            $objPHPExcel->getActiveSheet()->setCellValue('a1', $machinenameEx);
            $objPHPExcel->getActiveSheet()->setCellValue('d1', $batchnumberEx);
            $objPHPExcel->getActiveSheet()->setCellValue('a2', $productionnumberEx);
            $objPHPExcel->getActiveSheet()->setCellValue('d2', $itemnumberEx);
            $objPHPExcel->getActiveSheet()->setCellValue('a3', $typeofbag);
            $objPHPExcel->getActiveSheet()->setCellValue('d3', $typeofbagtxt);
            $objPHPExcel->getActiveSheet()->setCellValue('a4', $bladetype);
            $objPHPExcel->getActiveSheet()->setCellValue('c4', $screenMesh);
            $objPHPExcel->getActiveSheet()->setCellValue('d4', $gap);


            $objPHPExcel->getActiveSheet()->setCellValue('a6', 'Run Screen');
            $runCha = "b";
            $check_runCha = 1;
            $total_runCha = getRunScreen_exportData($m_code)->num_rows();
            foreach(getRunScreen_exportData($m_code)->result() as $rs1){
                $objPHPExcel->getActiveSheet()->setCellValue($runCha.'6', $rs1->d_run_name);
                $objPHPExcel->getActiveSheet()->getColumnDimension($runCha)->setAutoSize(true);

                if($check_runCha == $total_runCha){
                    ++$runCha;

                    $objPHPExcel->getActiveSheet()->setCellValue($runCha.'6', "memo");
                    $objPHPExcel->getActiveSheet()->getColumnDimension($runCha)->setAutoSize(true);
                }

                ++$runCha;
                $check_runCha++;
            }

            // Loop Time
            $t1 = 7;
            foreach(getRunScreenTime_exportData($m_code)->result() as $rs2){
                $objPHPExcel->getActiveSheet()->setCellValue('a'.$t1, $rs2->d_worktime);

                    // Loop Run Value
                    $runvalCha = "b";
                    $check_valcha = 1;
                    $total_valcha = getRunScreenValue_export($m_code , $rs2->d_detailcode)->num_rows();
                    $memo = "";
                    foreach(getRunScreenValue_export($m_code , $rs2->d_detailcode)->result() as $rs3){
                        $objPHPExcel->getActiveSheet()->setCellValue($runvalCha.$t1, $rs3->d_run_value);

                        if($check_valcha == $total_valcha){
                            ++$runvalCha;
                            if(getMemo($m_code , $rs3->d_detailcode)->num_rows() != 0){
                                $memo = getMemo($m_code , $rs3->d_detailcode)->row()->me_memo;
                            }else{
                                $memo = "";
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue($runvalCha.$t1, $memo);
                        }

                        ++$runvalCha;
                        $check_valcha++;
                    }
                    // Loop Run Value

                $t1++;
            }
            // Loop Time

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Export Machine Pulverizer เลขที่ '.getMainFormno($m_code).'.xlsx"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                echo $objWriter->save('php://output');
    }



    public function exportdata_templateList()
    {

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->setActiveSheetIndex(0);
            //กำหนดส่วนหัวเป็น Column แบบ Fix ไม่มีการเปลี่ยนแปลงใดๆ
 
            $objPHPExcel->getActiveSheet()->setCellValue('a1', 'No');
            $objPHPExcel->getActiveSheet()->setCellValue('b1', 'Template Name');
            $objPHPExcel->getActiveSheet()->setCellValue('c1', 'Item Number');

            // Loop Time
            $t1 = 2;
            $count = 1;
            foreach(getdataForExportMasterList()->result() as $rs){

                $objPHPExcel->getActiveSheet()->setCellValue('a'.$t1,$count);
                $objPHPExcel->getActiveSheet()->setCellValue('b'.$t1, $rs->master_name);
                $objPHPExcel->getActiveSheet()->getColumnDimension('b')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->setCellValue('c'.$t1, $rs->master_itemnumber);
                $objPHPExcel->getActiveSheet()->getColumnDimension('c')->setAutoSize(true);

                $t1++;
                $count++;
            }
            // Loop Time

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Export Machine pulverizer Template Master List.xlsx"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                echo $objWriter->save('php://output');
    }
    

    

}
/* End of file ModelName.php */

?>
