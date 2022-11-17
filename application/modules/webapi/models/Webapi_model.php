<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapi_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/Bangkok");
    }

    public function getMachineList()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "getMachine_pulverizer"){
            $lastjobrun = [];
           
            $sql = $this->db->query("SELECT mach_name , mach_desc FROM machine_information WHERE mach_status = 'active'");

            foreach($sql->result() as $rs){
                if($this->getLastJobRun($rs->mach_name) != "null"){
                    $lastjobrun[] = $this->getLastJobRun($rs->mach_name)->row();
                }else{
                    $lastjobrun[] = "";
                }

            }

            $output = array(
                "msg" => "ดึงข้อมูลเครื่อง Pulverizer สำเร็จ",
                "status" => "Select Data Success",
                "machine_list" => $sql->result(),
                "lastjobrun" => $lastjobrun
            );
            echo json_encode($output);
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลเครื่อง Pulverizer ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
            echo json_encode($output);
        }

    }


    private function getLastJobRun($machine)
    {

        if($machine != ""){

            $mainFormnoArray = [];
            $resultData="";
            $sql = $this->db->query("SELECT
            m_autoid,
            m_formno,
            m_code,
            m_template_name,
            m_machine,
            m_product_number,
            m_item_number,
            m_batch_number,
            m_order,
            m_status
            FROM main 
            WHERE m_machine = '$machine' AND m_machine != ''
            AND m_status = 'Start' ");

            if($sql->num_rows() != 0){
                foreach($sql->result() as $rs){
                    $mainFormnoArray[] = $rs->m_code;
                }

                $output = "";
                $nocount = 1 ;
                $count = count($mainFormnoArray);
                foreach($mainFormnoArray as $rs){
                    if($count == $nocount){
                        $output .= " '$rs' ";
                    }else{
                        $output .= " '$rs', ";
                    }
                    $nocount++; 
                }
    
    
                $sql2 = $this->db->query("SELECT
                d_detailcode,
                d_maincode,
                d_worktime,
                d_datetime
                FROM details WHERE d_maincode IN ($output)
                GROUP BY d_datetime ORDER BY d_datetime DESC LIMIT 1");
    
                $condition = "";
                if($sql2->num_rows() != 0){
                    $lastJobMainform = $sql2->row()->d_maincode;
                    $condition = "m_code = '$lastJobMainform' ";
                }else{
                    $lastJobMainform = "";
                    $condition = "m_machine = '$machine' ";
                }
    
                $sql3 = $this->db->query("SELECT
                m_autoid,
                m_formno,
                m_code,
                m_template_name,
                m_machine,
                m_product_number,
                m_item_number,
                m_batch_number,
                m_order,
                m_status
                FROM main 
                WHERE $condition AND m_status = 'start' ");

                $resultData = $sql3;

            }else{
                $resultData = "null";
            }

            return $resultData;

        }

    }


    public function loadHistoryList()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadHistoryList_pulverizer"){
            $machine = $received_data->machine;

            if($received_data->search != ""){

                $search = $received_data->search;
                $idArr = explode(" ", $search);

                $context = " CONCAT(m_product_number,' ', 
                            m_batch_number,' ', 
                            m_item_number,' ',
                            m_formno,' ',
                            m_machine) "; 

                $condition = " $context LIKE '%" . implode("%' OR $context LIKE '%", $idArr) . "%' AND ";

            }else{
                $condition = "";
            }

            $sql = $this->db->query("SELECT
            m_autoid,
            m_formno,
            m_code,
            m_template_name,
            m_machine,
            m_product_number,
            m_item_number,
            m_batch_number,
            m_order,
            m_datetime_start,
            m_status
            FROM
            main
            WHERE $condition
            m_machine = '$machine' and m_status in ('Start' , 'Stop' , 'Wait Start')
            ORDER BY
            m_autoid DESC;");


            $output = array(
                "msg" => "ดึงประวัติการเดินเครื่องสำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงประวัติการเดินเครื่องไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }

        echo json_encode($output);
    }



    
    

}

/* End of file ModelName.php */

?>