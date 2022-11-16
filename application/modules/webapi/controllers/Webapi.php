<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapi extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("webapi_model" , "webapi");
    }
    

    public function index()
    {
        return false;
    }

    public function getMachineList()
    {
        $this->webapi->getmachineList();
    }

    public function getLastJobRun()
    {
        $this->webapi->getLastJobRun();
    }

    public function loadHistoryList()
    {
        $this->webapi->loadHistoryList();
    }


    public function testquery()
    {

        $sql = $this->db->query("SELECT
        fam_autoid,
        fam_formno,
        fam_prodid,
        fam_machinename,
        fam_machine,
        fam_productcode,
        fam_batchnumber,
        fam_output,
        fam_mis,
        ptwo_pagestatus
        FROM farrel_main 
        WHERE fam_machine = '22CP2500-2' AND fam_machine != ''
        AND ptwo_pagestatus = 'Start' ");

        $mainFormnoArray = [];

        foreach($sql->result() as $rs){
            $mainFormnoArray[] = $rs->fam_formno;
        }

        // $output = "";
        // $nocount = 1 ;
        // $count = count($mainFormnoArray);
        // foreach($mainFormnoArray as $rs){
        //     if($count == $nocount){
        //         $output .= " '$rs' ";
        //     }else{
        //         $output .= " '$rs', ";
        //     }
        //     $nocount++; 
        // }
        

        // $sql2 = $this->db->query("SELECT
        // far_detail_formno,
        // far_main_formno,
        // far_worktime,
        // far_datetime
        // FROM farrel_detail WHERE far_main_formno IN ($output)
        // GROUP BY far_datetime ORDER BY far_datetime DESC LIMIT 1");


        // $sql3 = $this->db->query("SELECT
        // fam_autoid,
        // fam_formno,
        // fam_prodid,
        // fam_machinename,
        // fam_machine,
        // fam_productcode,
        // fam_batchnumber,
        // fam_output,
        // fam_mis,
        // ptwo_pagestatus
        // FROM farrel_main 
        // WHERE fam_formno = '$lastJobMainform' ");

        // echo $sql2->row()->far_main_formno;

        // $outarray = array(
        //     "result" => $sql2->row()->far_main_formno
        // );
        // echo json_encode($outarray);

        print_r($mainFormnoArray);
    }

}

/* End of file Controllername.php */

?>
