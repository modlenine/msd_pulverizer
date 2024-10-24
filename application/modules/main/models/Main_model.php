<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->db3 = $this->load->database("mssql_prodplan" , true);
        $this->db4 = $this->load->database("prodplan" , true);
    }


    public function loadMainData()
    {


        // DB table to use
        $table = 'datalist';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array(
                'db' => 'm_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '';
                    $output .= '
                <a id="l_viewmain" class="l_viewmain" href="'.base_url('viewfulldata.html/').$d.'"
                    data_mainformno="'.$d.'"
                ><b>' . $d . '</b></a>
                ';
                    return $output;
                }
            ),
            array('db' => 'm_template_name', 'dt' => 1),
            array('db' => 'm_item_number', 'dt' => 2),
            array('db' => 'm_product_number', 'dt' => 3),
            array('db' => 'm_batch_number', 'dt' => 4),
            array('db' => 'm_order', 'dt' => 5,
                'formatter' => function($d , $row){
                    return valueFormat($d);
                }
            ),
            array('db' => 'm_std_output', 'dt' => 6,
                'formatter' => function($d , $row){
                    return valueFormat($d);
                }
            ),
            array('db' => 'm_bladeType', 'dt' => 7,
                // 'formatter' => function($d , $row){
                //     return valueFormat($d);
                // }
            ),
            array('db' => 'm_screenMesh', 'dt' => 8,
                // 'formatter' => function($d , $row){
                //     return valueFormat($d);
                // }
            ),
            array('db' => 'm_gap', 'dt' => 9,
                // 'formatter' => function($d , $row){
                //     return valueFormat($d);
                // }
            ),
            array(
                'db' => 'm_datetime', 'dt' => 10,
                'formatter' => function($d , $row){
                    return conDateTimeFromDb($d);
                }
            ),
            array(
                'db' => 'm_status', 'dt' => 11,
                'formatter' => function($d , $row){
                    $output = '';
                    if($d == "Start"){
                        $output .='
                            <span class="badge badge-success" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Cancel"){
                        $output .='
                            <span class="badge badge-danger" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Stop"){
                        $output .='
                            <span class="badge badge-danger" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Open"){
                        $output .='
                            <span class="badge badge-info" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Wait Start"){
                        $output .='
                            <span class="badge badge-info" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }
                    return $output;
                }
            ),
            array('db' => 'm_memo', 'dt' => 12,)
            );

        // SQL server connection information
        $sql_details = array(
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_databasename,
            'host' => getDb()->db_host
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require('server-side/scripts/ssp.class.php');

        $ecode = getUser()->ecode;
        $deptcode = getUser()->DeptCode;

        // if (getUser()->ecode == "M1848" || getUser()->ecode == "M0051" || getUser()->ecode == "M0112") {
        //     echo json_encode(
        //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        //     );
        // } else if (getUser()->posi > 75) {
        //     echo json_encode(
        //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        //     );
        // } else {
        //     echo json_encode(
        //         SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "m_owner = '$ecode' ")
        //     );
        // }

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );

        
    }


    public function loadMainDataByDate($date_start , $date_end)
    {


        // DB table to use
        $table = 'datalist';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array(
                'db' => 'm_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '';
                    $output .= '
                <a id="l_viewmain" class="l_viewmain" href="'.base_url('viewfulldata.html/').$d.'"
                    data_mainformno="'.$d.'"
                ><b>' . $d . '</b></a>
                ';
                    return $output;
                }
            ),
            array('db' => 'm_template_name', 'dt' => 1),
            array('db' => 'm_item_number', 'dt' => 2),
            array('db' => 'm_product_number', 'dt' => 3),
            array('db' => 'm_batch_number', 'dt' => 4),
            array('db' => 'm_order', 'dt' => 5,
                'formatter' => function($d , $row){
                    return valueFormat($d);
                }
            ),
            array('db' => 'm_std_output', 'dt' => 6,
                'formatter' => function($d , $row){
                    return valueFormat($d);
                }
            ),
            array('db' => 'm_bladeType', 'dt' => 7,
                // 'formatter' => function($d , $row){
                //     return valueFormat($d);
                // }
            ),
            array('db' => 'm_screenMesh', 'dt' => 8,
                // 'formatter' => function($d , $row){
                //     return valueFormat($d);
                // }
            ),
            array('db' => 'm_gap', 'dt' => 9,
                // 'formatter' => function($d , $row){
                //     return valueFormat($d);
                // }
            ),
            array(
                'db' => 'm_datetime', 'dt' => 10,
                'formatter' => function($d , $row){
                    return conDateTimeFromDb($d);
                }
            ),
            array(
                'db' => 'm_status', 'dt' => 11,
                'formatter' => function($d , $row){
                    $output = '';
                    if($d == "Start"){
                        $output .='
                            <span class="badge badge-success" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Cancel"){
                        $output .='
                            <span class="badge badge-danger" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Stop"){
                        $output .='
                            <span class="badge badge-danger" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Open"){
                        $output .='
                            <span class="badge badge-info" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }else if($d == "Wait Start"){
                        $output .='
                            <span class="badge badge-info" style="font-size:12px;padding:5px;"><b>'.$d.'</b></span>
                        ';
                    }
                    return $output;
                }
            ),
            array('db' => 'm_memo', 'dt' => 12,)
        );

        // SQL server connection information
        $sql_details = array(
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_databasename,
            'host' => getDb()->db_host
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require('server-side/scripts/ssp.class.php');

        $ecode = getUser()->ecode;
        $deptcode = getUser()->DeptCode;

        // if (getUser()->ecode == "M1848" || getUser()->ecode == "M0051" || getUser()->ecode == "M0112") {
        //     echo json_encode(
        //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        //     );
        // } else if (getUser()->posi > 75) {
        //     echo json_encode(
        //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        //     );
        // } else {
        //     echo json_encode(
        //         SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "m_owner = '$ecode' ")
        //     );
        // }

        echo json_encode(
            SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "m_datetime BETWEEN '$date_start 00:00:01' AND '$date_end 23:59:59' ")
        );

        
    }


    public function searchTemplate()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "searchTemplate"){
            $sql = $this->db->query("SELECT
            template_master.master_autoid,
            template_master.master_temcode,
            template_master.master_name,
            template_master.master_itemnumber,
            template_master.master_image,
            template_master.master_imagePath,
            template_master.master_maxamp
            FROM
            template_master
            WHERE template_master.master_name LIKE '%$received_data->templatename%'
            ORDER BY template_master.master_name ASC LIMIT 50
            ");

            $result = [];

            foreach($sql->result() as $rs){
                $resultArray = array(
                    "master_name" => $rs->master_name,
                    "master_temcode" => $rs->master_temcode,
                    "master_maxamp" => $rs->master_maxamp,
                );
                $result[] = $resultArray;
            }

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "templatedata" => $result
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }

        echo json_encode($output);
    }

    public function searchTemplateByItemnumber()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "searchTemplate"){
            $sql = $this->db->query("SELECT
            template_master.master_autoid,
            template_master.master_temcode,
            template_master.master_name,
            template_master.master_itemnumber,
            template_master.master_image,
            template_master.master_imagePath,
            template_master.master_maxamp
            FROM
            template_master
            WHERE template_master.master_itemnumber LIKE '%$received_data->itemnumber%'
            ORDER BY template_master.master_name ASC LIMIT 50
            ");

            $result = [];

            foreach($sql->result() as $rs){
                $resultArray = array(
                    "master_name" => $rs->master_name,
                    "master_temcode" => $rs->master_temcode,
                    "master_maxamp" => $rs->master_maxamp,
                );
                $result[] = $resultArray;
            }

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "templatedata" => $result
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }

        echo json_encode($output);
    }

    public function searchProductNo()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "searchProductNo"){

            $dataareaid = $received_data->m_areaid;
            $searchProdid = $received_data->m_product_number;


            $output = '';

            $sql = $this->db3->query("SELECT TOP 20
            prodtable.itemid,
            prodtable.dataareaid,
            prodtable.prodid,
            prodtable.inventdimid,
            inventdim.inventbatchid,
            prodtable.slc_orgreference,
            prodtable.slc_packageid,
            prodtable.qtysched,
            slc_packagespc.packageid,
            slc_packagespc.packagetxt
            FROM
            prodtable
            LEFT JOIN inventdim ON inventdim.inventdimid = prodtable.inventdimid AND inventdim.dataareaid = prodtable.dataareaid
            LEFT JOIN slc_packagespc ON slc_packagespc.packageid = prodtable.slc_packageid AND slc_packagespc.dataareaid = prodtable.dataareaid
                WHERE prodtable.dataareaid = '$dataareaid' AND prodtable.prodid like '%$searchProdid%' AND prodtable.prodstatus NOT IN (7, 8)
                ");

            $output = '<ul class="list-group lgprodid">';
            foreach ($sql->result() as $rs) {

                // $getBag = $this->getBagFormPD($rs->slc_packageid , $rs->dataareaid);
                // if($getBag->num_rows() != 0){
                //     $getBag_packid = $getBag->row()->packageid;
                //     $getBag_packtxt = $getBag->row()->packagetxt;
                // }else{
                //     $getBag_packid = null;
                //     $getBag_packtxt = null;
                // }

                if(substr($rs->slc_orgreference , 0 , 2) == "PD"){
                    $wipProdid = $this->checkPDWip($searchProdid , $dataareaid);

                    $sql2 = $this->db3->query("SELECT TOP 20
                    prodtable.itemid,
                    prodtable.dataareaid,
                    prodtable.prodid,
                    prodtable.inventdimid,
                    inventdim.inventbatchid,
                    prodtable.slc_orgreference,
                    prodtable.slc_packageid,
                    prodtable.qtysched,
                    slc_packagespc.packageid,
                    slc_packagespc.packagetxt
                    FROM
                    prodtable
                    LEFT JOIN inventdim ON inventdim.inventdimid = prodtable.inventdimid AND inventdim.dataareaid = prodtable.dataareaid
                    LEFT JOIN slc_packagespc ON slc_packagespc.packageid = prodtable.slc_packageid AND slc_packagespc.dataareaid = prodtable.dataareaid
                        WHERE prodtable.dataareaid = '$dataareaid' AND prodtable.prodid LIKE '%$wipProdid%'
                        ");

                    foreach($sql2->result() as $rss){
                        $output .= '
                        <a href="#" id="prodid_attr" class="prodid_attr"
                        data_prodid = "' . $rs->prodid . '"
                        data_prodiduse = "'.$rss->prodid.'"
                        data_itemid = "' . $rss->itemid . '"
                        data_inventbatchid = "' . $rss->inventbatchid . '"
                        data_dataareaid = "' . $rss->dataareaid . '"
                        data_slc_orgreference = "'.substr($rss->slc_orgreference , 0 , 2).'"
                        data_typeofbag = "'.$rss->packageid.'"
                        data_typeofbagtxt = "'.$rss->packagetxt.'"
                        data_qtysched = "'.$rss->qtysched.'"
                        ><li class="list-group-item">' . $rs->prodid . '</li></a>
                        ';
                    }

                }else{
                    $output .= '
                    <a href="#" id="prodid_attr" class="prodid_attr"
                        data_prodid = "' . $rs->prodid . '"
                        data_prodiduse = ""
                        data_itemid = "' . $rs->itemid . '"
                        data_inventbatchid = "' . $rs->inventbatchid . '"
                        data_dataareaid = "' . $rs->dataareaid . '"
                        data_slc_orgreference = "'.substr($rs->slc_orgreference , 0 , 2).'"
                        data_typeofbag = "'.$rs->packageid.'"
                        data_typeofbagtxt = "'.$rs->packagetxt.'"
                        data_qtysched = "'.$rs->qtysched.'"
                    ><li class="list-group-item">' . $rs->prodid . '</li></a>
                    ';
                }


                
            }
            $output .= '</ul>';
            echo $output;

        }
    }

    private function getBagFormPD($bagid , $dataareaid)
    {
        if($bagid != "" && $dataareaid != ""){
            $sql = $this->db3->query("SELECT
            slc_packagespc.packageid,
            slc_packagespc.packagetxt
            FROM slc_packagespc
            WHERE slc_packagespc.packageid = '$bagid' AND slc_packagespc.dataareaid = '$dataareaid'
            ");

            return $sql;
        }
    }


    public function searchBag()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "searchBag"){

            $m_areaid = $received_data->m_areaid;

            $searchText = $received_data->bagCode; 
            $idArr = explode(" ", $searchText); 
            $context = " CONCAT(packageid,' ', 
            packagetxt) "; 
            $condition = " $context LIKE '%" . implode("%' OR $context LIKE '%", $idArr) . "%' "; 

            $sql = $this->db3->query("SELECT TOP 20
            packageid,
            packagetxt,
            containweight
            FROM slc_packagespc
            WHERE $condition AND
            PACKAGEID IN ('BO15PABRLA14','BA15WOGYLA32','BA15WOGYLA35','BA15WOWHNL32','BA15LDWHLA27','BA15LDWHNL27','TA15PLBLNL50') AND
            DATAAREAID LIKE '%$m_areaid%'
            ORDER BY packageid ASC
            ");

            $output = array(
                "msg" => "ดึงข้อมูล Bag สำเร็จ",
                "status" => "Select Data Success",
                "resultBag" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Bag ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }
        echo json_encode($output);
    }

    //Recursive Function loop
    public function checkPDWip($prodid , $dataareaid)
    {
        $checkWip = "";
        $sqlwip = $this->db3->query("SELECT TOP 20
                prodtable.itemid,
                prodtable.dataareaid,
                prodtable.prodid,
                prodtable.inventdimid,
                prodtable.slc_orgreference
                FROM
                prodtable
                WHERE prodtable.dataareaid = '$dataareaid' AND prodtable.prodid like '%$prodid%'
                ");
        if($sqlwip->num_rows() != 0){
            $checkWip = $sqlwip->row()->slc_orgreference;
            if(substr($checkWip , 0 , 2) == "PD"){
                return $this->checkPDWip($checkWip , $dataareaid);
            }else{
                return $sqlwip->row()->prodid;
            }
        }  
    }
    //Recursive Function loop



    public function saveMaindata()
    {
        if(
            $this->input->post("m_areaid") != "" &&
            $this->input->post("m_product_number") != "" &&
            $this->input->post("m_template_name") != "" &&
            $this->input->post("m_order") != "" &&
            $this->input->post("m_std_output") != "" &&
            $this->input->post("m_maxamp") != "" &&
            $this->input->post("m_item_number") != "" &&
            $this->input->post("m_typeofbag") != "" &&
            $this->input->post("m_batch_number") != "" &&
            $this->input->post("m_typeofbag") != "" &&
            $this->input->post("m_machine") != ""
        ){
            $formno = getFormNo();

            $arSaveData = array(
                "m_formno" => $formno,
                "m_code" => getRuningCode(100),
                "m_areaid" => $this->input->post("m_areaid"),
                "m_product_number" => $this->input->post("m_product_number"),
                "m_template_name" => $this->input->post("m_template_name"),
                "m_machine" => $this->input->post("m_machine"),
                "m_order" => $this->input->post("m_order"),
                "m_std_output" => $this->input->post("m_std_output"),
                "m_maxamp" => $this->input->post("m_maxamp"),
                "m_item_number" => $this->input->post("m_item_number"),
                "m_batch_number" => $this->input->post("m_batch_number"),
                "m_template_code" => $this->input->post("m_template_code"),
                "m_user" => getUser()->Fname." ".getUser()->Lname,
                "m_ecode" => getUser()->ecode,
                "m_deptcode" => getUser()->DeptCode,
                "m_datetime" => date("Y-m-d H:i:s"),
                "m_status" => "Open",
                "m_typeofbag" => $this->input->post("m_typeofbag"),
                "m_typeofbagtxt" => $this->input->post("m_typeofbagtxt"),
                "m_bladeType" => $this->input->post("m_bladeType"),
                "m_screenMesh" => $this->input->post("m_screenMesh"),
                "m_gap" => $this->input->post("m_gap"),
                "m_dataareaid" => $this->input->post("m_areaid")
            );
            $this->db->insert("main" , $arSaveData);

            $action = "บันทึกข้อมูลหลัก เอกสารเลขที่ ".$formno;
            saveActivity(
                $action,
                $this->input->post("m_product_number"),
                $this->input->post("m_batch_number"),
                $this->input->post("m_item_number"),
                $this->input->post("m_areaid")
            );


            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert Data Success",
                "templateformno" => $formno
            );

        }else{
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function loadSpoint()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadSpoint"){
            $sql = $this->db->query("SELECT
            template_details.detail_autoid,
            template_details.detail_mastercode,
            template_details.detail_column_name,
            template_details.detail_name,
            template_details.detail_min,
            template_details.detail_max,
            template_details.detail_spoint,
            template_details.detail_linenum,
            template_details.detail_runautoid,
            template_details.detail_user,
            template_details.detail_ecode,
            template_details.detail_deptcode,
            template_details.detail_datetime
            FROM
            template_details
            WHERE detail_mastercode = '$received_data->templatecode'
            ORDER BY detail_linenum ASC");

            $resultData = [];
            foreach($sql->result() as $rs){
                $arrayResult = array(
                    "detail_mastercode" => $rs->detail_mastercode,
                    "detail_column_name" => $rs->detail_column_name,
                    "detail_name" => $rs->detail_name,
                    "detail_min" => $rs->detail_min,
                    "detail_max" => $rs->detail_max,
                    "detail_spoint" => $rs->detail_spoint,
                    "detail_linenum" => $rs->detail_linenum,
                    "detail_runautoid" => $rs->detail_runautoid
                );
                $resultData[] = $arrayResult;
            }

            $output = array(
                "msg" => "ดึงข้อมูล Set Point สำเร็จ",
                "status" => "Select Data Success",
                "resultSetpoint" => $resultData
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Set Point ไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function saveSpoint()
    {
        $detailcode = getRuningCode(200);
        $maincode = $this->input->post("mdsp_m_code");

        $fileInput = "mdsp_f_name";
        uploadImageSpoint($fileInput , $detailcode , $maincode);

        // Upload And Save Image Data

        // Upload And Save Image Data


        // Save Data to Detail Table
        $runscreenName = $this->input->post("mdsp_d_run_name");
        foreach($runscreenName as $key => $runscreenNames){
            // Save Detail Data
            $arSaveDetailSpoint = array(
                "d_maincode" => $this->input->post("mdsp_m_code"),
                "d_detailcode" => $detailcode,
                "d_templatecode" => $this->input->post("mdsp_d_templatecode")[$key],
                "d_action" => "Spoint",
                "d_run_name" => $runscreenNames,
                "d_run_min" => $this->input->post("mdsp_d_run_min")[$key],
                "d_run_max" => $this->input->post("mdsp_d_run_max")[$key],
                "d_run_value" => $this->input->post("mdsp_d_run_value")[$key],
                "d_linenum" => $this->input->post("mdsp_d_linenum")[$key],
                "d_user" => getUser()->Fname." ".getUser()->Lname,
                "d_ecode" => getUser()->ecode,
                "d_deptcode" => getUser()->DeptCode,
                "d_datetime" => date("Y-m-d H:i:s"),
            );
            $this->db->insert("details" , $arSaveDetailSpoint);
        }
         // Save Data to Detail Table



        //  Update Status Main Data
        $arUpdateMainData = array(
            "m_status" => "Wait Start",
        );
        $this->db->where("m_code" , $this->input->post("mdsp_m_code"));
        $this->db->update("main" , $arUpdateMainData);

        $action = "บันทึกข้อมูล Set Point Form Code : ".$this->input->post("mdsp_m_code");
        saveActivity(
            $action,
            getActivityData($maincode)->m_product_number,
            getActivityData($maincode)->m_batch_number,
            getActivityData($maincode)->m_item_number,
            getActivityData($maincode)->m_dataareaid
        );


        $output = array(
            "msg" => "บันทึก Spoint สำเร็จ",
            "status" => "Insert Data Success",
        );

        echo json_encode($output);
    }

    public function checkFormStatus()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "checkFormStatus"){
            $sql = $this->db->query("SELECT
            main.m_formno,
            main.m_code,
            main.m_areaid,
            main.m_status
            FROM
            main
            WHERE m_code = '$received_data->m_code'
            ");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "form_status" => $sql->row()->m_status
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function loadDetailData()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadDetailData"){
            $sqlSpoint = $this->db->query("SELECT
            details.d_autoid,
            details.d_maincode,
            details.d_detailcode,
            details.d_templatecode,
            details.d_worktime,
            details.d_action,
            details.d_run_name,
            details.d_run_min,
            details.d_run_max,
            details.d_run_value,
            details.d_linenum,
            details.d_linenum_group,
            details.d_user,
            details.d_ecode,
            details.d_deptcode,
            details.d_datetime,
            details.d_user_modify,
            details.d_ecode_modify,
            details.d_deptcode_modify,
            details.d_datetime_modify
            FROM
            details
            WHERE d_maincode = '$received_data->m_code' AND
            d_action = 'Spoint'
            ORDER BY d_linenum ASC
            ");

            // $result[] = $sqlSpoint->result();
            // Check ว่ามีการแนบไฟล์หรือไม่
            $getImageSpoint = $this->getImageBeforeStart($received_data->m_code);
            if($getImageSpoint->num_rows() != 0){
                $imageBeforeStart = $getImageSpoint->row()->f_maincode;
            }else{
                $imageBeforeStart = "";
            }

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "beforeStartImage" => $imageBeforeStart,
                "spoint" => $sqlSpoint->result()
            );

            echo json_encode($output);
        }
    }
    private function getImageBeforeStart($maincode)
    {
        $sql = $this->db->query("SELECT
        f_name,
        f_path,
        f_maincode
        FROM files
        WHERE f_maincode = '$maincode' AND f_type = 'Before Start'
        ");

        return $sql;
    }

    public function loadRunDetailData()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadRunDetailData"){

            $sqlRunGroup = $this->db->query("SELECT 
            d_linenum_group , d_worktime , d_detailcode , d_workdate
            FROM details 
            WHERE d_maincode = '$received_data->m_code' AND 
            d_action = 'Run' 
            GROUP BY d_linenum_group 
            ORDER BY d_linenum_group ASC
            ");

            if($sqlRunGroup->num_rows() != 0){
                foreach($sqlRunGroup->result() as $rs){

                    $sqlRun = $this->db->query("SELECT
                    details.d_autoid,
                    details.d_maincode,
                    details.d_detailcode,
                    details.d_templatecode,
                    details.d_worktime,
                    details.d_workdate,
                    details.d_action,
                    details.d_run_name,
                    details.d_run_min,
                    details.d_run_max,
                    details.d_run_value,
                    details.d_linenum,
                    details.d_linenum_group,
                    details.d_user,
                    details.d_ecode,
                    details.d_deptcode,
                    details.d_datetime,
                    details.d_user_modify,
                    details.d_ecode_modify,
                    details.d_deptcode_modify,
                    details.d_datetime_modify
                    FROM
                    details
                    WHERE d_maincode = '$received_data->m_code' AND
                    d_action = 'Run' AND
                    d_linenum_group = '$rs->d_linenum_group'
                    ORDER BY d_linenum ASC , d_linenum_group ASC
                    ");

                    // Check Image Data
                    $imageRun = "";
                    $getImageRunData = $this->loadImageRunDetail($received_data->m_code , $rs->d_detailcode);
                    if($getImageRunData->num_rows() != 0){
                        $imageRun = $received_data->m_code;
                    }else{
                        $imageRun = "";
                    }

                    $workDate = "";
                    if($rs->d_workdate != ""){
                        $workDate = conDateFromDb($rs->d_workdate);
                    }
    
                    $resultLineGroup = array(
                        "d_worktime" => $rs->d_worktime,
                        "d_workdate" => $workDate,
                        "d_linenum_group" => $rs->d_linenum_group,
                        "detailcode" => $rs->d_detailcode,
                        "imageRun" => $imageRun,
                        "memo" => $this->loadMemoRunDetail($received_data->m_code , $rs->d_detailcode),
                        "runByGroup" => $sqlRun->result()
                    );
                    $resultRunByGroup[] =  $resultLineGroup;
                }
            }else{
                $resultLineGroup = "ไม่พบข้อมูล";
            }

            

            // $result[] = $sqlSpoint->result();

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "run" => $resultRunByGroup
            );

            
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "run" => ""
            );
        }
        echo json_encode($output);
    }



    private function loadMemoRunDetail($m_code , $detailcode)
    {
        if($detailcode != ""){
            $sql = $this->db->query("SELECT
            me_memo
            FROM memo
            WHERE me_maincode = '$m_code' AND me_detailcode = '$detailcode'
            ");
            $memo = "";
            if($sql->num_rows() != 0){
                $memo = $sql->row()->me_memo;
            }else{
                $memo = "";
            }

            return $memo;
        } 
    }
    private function loadImageRunDetail($maincode , $detailcode)
    {
        if($detailcode != ""){
            $sql = $this->db->query("SELECT
            f_name,
            f_path
            FROM files
            WHERE f_maincode = '$maincode' AND f_detailcode = '$detailcode' AND f_type = 'Run Detail'
            ");

            return $sql;
        }
    }
    

    public function saveStart()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "saveStart"){
            $arUpdateStatus = array(
                "m_status" => "Start",
                "m_user_start" => getUser()->Fname." ".getUser()->Lname,
                "m_ecode_start" => getUser()->ecode,
                "m_datetime_start" => date("Y-m-d H:i:s")
            );
            $this->db->where("m_code" , $received_data->m_code);
            $this->db->update("main" , $arUpdateStatus);


            //Update user activity
            $action = "กดปุ่ม Start และบันทึกข้อมูล Formcode : ".$received_data->m_code." สำเร็จ";
            saveActivity(
                $action,
                getActivityData($received_data->m_code)->m_product_number,
                getActivityData($received_data->m_code)->m_batch_number,
                getActivityData($received_data->m_code)->m_item_number,
                getActivityData($received_data->m_code)->m_dataareaid
            );
            //Update user activity

            $output = array(
                "msg" => "อัพเดตข้อมูลสำเร็จ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }

    public function saveCancel()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "saveCancel"){
            $arUpdateStatus = array(
                "m_status" => "Cancel",
                "m_memo" => $received_data->m_memo,
                "m_user_cancel" => getUser()->Fname." ".getUser()->Lname,
                "m_ecode_cancel" => getUser()->ecode,
                "m_datetime_cancel" => date("Y-m-d H:i:s")
            );
            $this->db->where("m_code" , $received_data->m_code);
            $this->db->update("main" , $arUpdateStatus);


            //Update user activity
            $action = "กดปุ่ม Cancel และบันทึกข้อมูล Formcode : ".$received_data->m_code." สำเร็จ";
            saveActivity(
                $action,
                getActivityData($received_data->m_code)->m_product_number,
                getActivityData($received_data->m_code)->m_batch_number,
                getActivityData($received_data->m_code)->m_item_number,
                getActivityData($received_data->m_code)->m_dataareaid
            );
            //Update user activity

            $output = array(
                "msg" => "อัพเดตข้อมูลสำเร็จ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }

    public function saveStop()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "saveStop"){
            $arUpdateStatus = array(
                "m_status" => "Stop",
                "m_user_stop" => getUser()->Fname." ".getUser()->Lname,
                "m_ecode_stop" => getUser()->ecode,
                "m_datetime_stop" => date("Y-m-d H:i:s")
            );
            $this->db->where("m_code" , $received_data->m_code);
            $this->db->update("main" , $arUpdateStatus);


            //Update user activity
            $action = "กดปุ่ม Stop และบันทึกข้อมูล Formcode : ".$received_data->m_code." สำเร็จ";
            saveActivity(
                $action,
                getActivityData($received_data->m_code)->m_product_number,
                getActivityData($received_data->m_code)->m_batch_number,
                getActivityData($received_data->m_code)->m_item_number,
                getActivityData($received_data->m_code)->m_dataareaid
            );
            //Update user activity

            $output = array(
                "msg" => "อัพเดตข้อมูลสำเร็จ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }

    public function loadSpointInMainData()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadSpointInMainData"){
            $sql = $this->db->query("SELECT
            details.d_autoid,
            details.d_maincode,
            details.d_detailcode,
            details.d_templatecode,
            details.d_worktime,
            details.d_action,
            details.d_run_name,
            details.d_run_min,
            details.d_run_max,
            details.d_run_value,
            details.d_linenum
            FROM
            details
            WHERE d_maincode = '$received_data->m_code' AND d_action = 'Spoint'
            ORDER BY d_linenum ASC
            ");

            $output = array(
                "msg" => "ดึงข้อมูล สำเร็จ",
                "status" => "Select Data Success",
                "spointMainData" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล ไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "spointMainData" => null
            );
        }

        echo json_encode($output);
    }

    public function loadSpointForEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadSpointForEdit"){
            $sql = $this->db->query("SELECT
            details.d_autoid,
            details.d_maincode,
            details.d_detailcode,
            details.d_templatecode,
            details.d_worktime,
            details.d_action,
            details.d_run_name,
            details.d_run_min,
            details.d_run_max,
            details.d_run_value,
            details.d_linenum
            FROM
            details
            WHERE d_maincode = '$received_data->m_code' AND d_action = 'Spoint'
            ORDER BY d_linenum ASC
            ");

            // Get Image Spoint For Edit
            $sqlGetImageSpoint = $this->db->query("SELECT * FROM files WHERE f_maincode = '$received_data->m_code' AND f_type = 'Before Start' ORDER BY f_autoid ASC ");
            // Get Image Spoint For Edit

            $output = array(
                "msg" => "ดึงข้อมูล สำเร็จ",
                "status" => "Select Data Success",
                "spointMainData" => $sql->result(),
                "spointImage" => $sqlGetImageSpoint->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล ไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "spointMainData" => null,
                "spointImage" => null
            );
        }

        echo json_encode($output);
    }

    public function saveRunDetail()
    {
        if($this->input->post("mdrd_chooseTime") != "" && $this->input->post("mdrd_chooseDate") != ""){
            // Check Group Linenum
            $groupLinenum = $this->checkGroupNumber($this->input->post("mdrd_m_code"));

            $detailcode = getRuningCode(200);
            $maincode = $this->input->post("mdrd_m_code");

            // Upload Image And Save File Data
            $fileInput = "mdrd_f_name";
            uploadImageRunDetail($fileInput , $detailcode , $maincode);

            // Save Run Detail
            $mdrd_d_run_name = $this->input->post("mdrd_d_run_name");
            foreach($mdrd_d_run_name as $key => $mdrd_d_run_names){
                $arSaveRunDetail = array(
                    "d_maincode" => $this->input->post("mdrd_m_code"),
                    "d_detailcode" => $detailcode ,
                    "d_templatecode" => $this->input->post("mdrd_d_templatecode")[$key],
                    "d_worktime" => $this->input->post("mdrd_chooseTime"),
                    "d_workdate" => conDateFormat($this->input->post("mdrd_chooseDate")),
                    "d_action" => "Run",
                    "d_run_name" => $mdrd_d_run_names,
                    "d_run_min" => $this->input->post("mdrd_d_run_min")[$key],
                    "d_run_max" => $this->input->post("mdrd_d_run_max")[$key],
                    "d_run_value" => $this->input->post("mdrd_d_run_value")[$key],
                    "d_linenum" => $this->input->post("mdrd_d_linenum")[$key],
                    "d_linenum_group" => $groupLinenum,
                    "d_user" => getUser()->Fname." ".getUser()->Lname,
                    "d_ecode" => getUser()->ecode,
                    "d_deptcode" => getUser()->DeptCode,
                    "d_datetime" => date("Y-m-d H:i:s")
                );

                $this->db->insert("details" , $arSaveRunDetail);
            }

            // Save Memo Data
            if($this->input->post("mdrd_d_run_memo") != ""){
                $arSavememo = array(
                    "me_maincode" => $this->input->post("mdrd_m_code"),
                    "me_detailcode" => $detailcode,
                    "me_memo" => $this->input->post("mdrd_d_run_memo"),
                    "me_user" => getUser()->Fname." ".getUser()->Lname,
                    "me_ecode" => getUser()->ecode,
                    "me_deptcode" => getUser()->DeptCode,
                    "me_datetime" => date("Y-m-d H:i:s")
                );
                $this->db->insert("memo" , $arSavememo);
            }

            // Save Activity
            $action = "บันทึกข้อมูลการทำงาน Formcode : ".$this->input->post('mdrd_m_code')." วันที่".date("d-m-Y H:i:s");
            saveActivity(
                $action,
                getActivityData($maincode)->m_product_number,
                getActivityData($maincode)->m_batch_number,
                getActivityData($maincode)->m_item_number,
                getActivityData($maincode)->m_dataareaid
            );

            $output = array(
                "msg" => "บันทึกข้อมูลการทำงานสำเร็จ",
                "status" => "Insert Data Success"
            );
        }else{
            $output = array(
                "msg" => "บันทึกข้อมูลการทำงานไม่สำเร็จ",
                "status" => "Insert Data Not Success"
            );
        }

        echo json_encode($output);
    }
    private function checkGroupNumber($m_code)
    {
        $grouplinenum = 0;

        if($m_code != ""){
            $sql = $this->db->query("SELECT 
            d_linenum_group 
            FROM details 
            WHERE d_maincode = '$m_code' 
            AND d_action != 'Spoint' 
            ORDER BY d_linenum_group DESC
            ");

            if($sql->num_rows() == 0){
                $grouplinenum = 1;
            }else{
                $grouplinenum = $sql->row()->d_linenum_group;
                $grouplinenum++;
            }

            return $grouplinenum;
        }
    }


    public function loadImageRunDetailForShow()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadImageRunDetailForShow")
        {
            $sql = $this->db->query("SELECT * FROM files WHERE f_maincode='$received_data->m_code' AND f_detailcode = '$received_data->d_code' AND f_type = 'Run Detail' ORDER BY f_autoid ASC");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "imageRunDetail" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "imageRunDetail" => null
            );
        }

        echo json_encode($output);
    }


    public function loadImageBeforeStart()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadImageBeforeStart")
        {
            $sql = $this->db->query("SELECT * FROM files WHERE f_maincode='$received_data->m_code' AND f_detailcode = '$received_data->d_code' AND f_type = 'Before Start' ORDER BY f_autoid ASC");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "imageBeforeStart" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "imageBeforeStart" => null
            );
        }

        echo json_encode($output);
    }


    public function loadRunGroupList()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadRunGroupList"){
            $sql = $this->db->query("SELECT
            d_worktime,
            d_workdate,
            d_detailcode,
            d_maincode
            FROM details
            WHERE d_maincode = '$received_data->m_code' AND d_action = 'Run'
            GROUP BY d_linenum_group
            ORDER BY d_linenum_group ASC
            ");

            $sqlSpoint = $this->db->query("SELECT d_detailcode FROM details WHERE d_maincode = '$received_data->m_code' AND d_action = 'Spoint' GROUP BY d_action");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "runGroupList" => $sql->result(),
                "runSpointDCode" => $sqlSpoint->row()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "runGroupList" => null,
                "runSpointDCode" => null
            );
        }

        echo json_encode($output);
    }


    public function loadDataForEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadDataForEdit"){

            // Get Run Detail
            $sql = $this->db->query("SELECT
            details.d_autoid,
            details.d_maincode,
            details.d_detailcode,
            details.d_templatecode,
            details.d_worktime,
            details.d_workdate,
            details.d_action,
            details.d_run_name,
            details.d_run_min,
            details.d_run_max,
            details.d_run_value,
            details.d_run_memo,
            details.d_linenum,
            details.d_linenum_group
            FROM
            details
            WHERE d_maincode = '$received_data->m_code' AND
            d_detailcode = '$received_data->d_code'
            ORDER BY d_linenum ASC
            ");
            // Get Run Detail

            // Get worktime
            $worktime = '';
            $workdate = '';
            if($sql->num_rows() != 0){
                $worktime = $sql->row()->d_worktime;
                if($sql->row()->d_workdate != ""){
                    $workdate = conDateFromDb($sql->row()->d_workdate);
                }
            }else{
                $worktime = null;
            }

            // Get memo
            $sqlmemo = $this->db->query("SELECT
            me_memo
            FROM memo
            WHERE me_maincode = '$received_data->m_code' AND
            me_detailcode = '$received_data->d_code'
            ");

            if($sqlmemo->num_rows() != 0){
                $rsmemo = $sqlmemo->row()->me_memo;
            }else{
                $rsmemo = "";
            }
            // Get memo


            // Get Image
            $sqlImage = $this->db->query("SELECT
            f_name,
            f_path,
            f_autoid
            FROM files
            WHERE f_maincode = '$received_data->m_code' AND
            f_detailcode = '$received_data->d_code' AND
            f_type = 'Run Detail'
            ORDER BY f_autoid ASC
            ");

            if($sqlImage->num_rows() != 0){
                $rsImage = $sqlImage->result();
            }else{
                $rsImage = null;
            }
            // Get Image

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "memo" => $rsmemo,
                "runImage" => $rsImage,
                "runDetailForEdit" => $sql->result(),
                "worktime" => $worktime,
                "workdate" => $workdate
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "runDetailForEdit" => null
            );
        }

        echo json_encode($output);
    }


    public function saveRunDetailEdit()
    {
        if($this->input->post("listOfRunGroup") != ""){

            $detailcode = $this->input->post("listOfRunGroup");
            $maincode = $this->input->post("mdrde_m_code");

            if($detailcode == "Spoint"){
                // อัพโหลดรูปภาพ ก่อนเริ่มทำงาน
                $spointDetailCode = $this->input->post("spointDCode");
                $fileInput = "mdrdsp_f_name";
                uploadImageSpoint($fileInput , $spointDetailCode , $maincode);
                // อัพโหลดรูปภาพ ก่อนเริ่มทำงาน
            }else{
                // Upload Image And Save File Data
                $fileInput = "mdrde_f_name";
                uploadImageRunDetailEdit($fileInput , $detailcode , $maincode);

                // Update Memo
                // Check memo Data
                $sqlCheckMemo = $this->db->query("SELECT me_memo FROM memo WHERE me_maincode = '$maincode' AND me_detailcode = '$detailcode' ");

                if($sqlCheckMemo->num_rows() != 0){
                    $arupDatememo = array(
                        "me_memo" => $this->input->post("mdrde_d_run_memo")
                    );

                    $this->db->where("me_maincode" , $maincode);
                    $this->db->where("me_detailcode" , $detailcode);
                    $this->db->update("memo" , $arupDatememo);
                }else{
                    $arInsertMemo = array(
                        "me_memo" => $this->input->post("mdrde_d_run_memo"),
                        "me_maincode" => $maincode,
                        "me_detailcode" => $detailcode,
                        "me_user" => getUser()->Fname." ".getUser()->Lname,
                        "me_ecode" => getUser()->ecode,
                        "me_deptcode" => getUser()->DeptCode,
                        "me_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("memo" , $arInsertMemo);
                }
            }//End Condition



            // Update Detail value
            $d_autoid = $this->input->post("mdrde_d_autoid");
            foreach($d_autoid as $key => $d_autoids){
                $arUpdateRun = array(
                    "d_run_value" => $this->input->post("mdrde_d_run_value")[$key],
                    "d_worktime" => $this->input->post("mdrd_chooseTime_edit"),
                    "d_workdate" => conDateFormat($this->input->post("mdrd_chooseDate_edit"))
                );
                $this->db->where("d_autoid" , $d_autoids);
                $this->db->update("details" , $arUpdateRun);
            }
            // Update Detail value



            $action = "แก้ไขข้อมูล Run Screen เอกสารเลขที่ ".$detailcode." สำเร็จ (เอกสารหลัก $maincode)";
            saveActivity(
                $action,
                getActivityData($maincode)->m_product_number,
                getActivityData($maincode)->m_batch_number,
                getActivityData($maincode)->m_item_number,
                getActivityData($maincode)->m_dataareaid
            );


            // Update main modify user
            $arUpdateMain = array(
                "m_user_modify" => getUser()->Fname." ".getUser()->Lname,
                "m_ecode_modify" => getUser()->ecode,
                "m_datetime_modify" => date("Y-m-d H:i:s")
            );
            $this->db->where("m_code" , $maincode);
            $this->db->update("main" , $arUpdateMain);
            // Update main modify user
            

            $output = array(
                "msg" => "อัพเดตข้อมูลเรียบร้อย",
                "status" => "Update Data Success"
            );

            
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function deleteRunDetail()
    {
        if($this->input->post("listOfRunGroup") != ""){
            $detailcode = $this->input->post("listOfRunGroup");
            $maincode = $this->input->post("mdrde_m_code");

            // ลบไฟล์ออกก่อน
            $sqlGetFile = $this->db->query("SELECT
            f_name,
            f_path
            FROM files
            WHERE f_maincode = '$maincode' AND f_detailcode = '$detailcode'
            ORDER BY f_autoid ASC
            ");

            if($sqlGetFile->num_rows() != 0){
                foreach($sqlGetFile->result() as $rsImage){
                    $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$rsImage->f_path.$rsImage->f_name;
                    unlink($path);
                }

                $this->db->where("f_maincode" , $maincode);
                $this->db->where("f_detailcode" , $detailcode);
                $this->db->delete("files");
            }
            // ลบไฟล์ออกก่อน

            // ลบ Memo 
            $this->db->where("me_maincode" , $maincode);
            $this->db->where("me_detailcode" , $detailcode);
            $this->db->delete("memo");
            // ลบ Memo 


            // ลบ Rundetail
            $this->db->where("d_maincode" , $maincode);
            $this->db->where("d_detailcode" , $detailcode);
            $this->db->delete("details");
            // ลบ Rundetail


            $action = "ลบข้อมูล Run Screen เอกสารเลขที่ ".$detailcode." สำเร็จ (เอกสารหลัก $maincode)";
            saveActivity(
                $action,
                getActivityData($maincode)->m_product_number,
                getActivityData($maincode)->m_batch_number,
                getActivityData($maincode)->m_item_number,
                getActivityData($maincode)->m_dataareaid
            );

            $output = array(
                "msg" => "ลบรายการที่เลือกเรียบร้อยแล้ว",
                "status" => "Delete Data Success"
            );
        }else{
            $output = array(
                "msg" => "ลบรายการที่เลือกไม่สำเร็จ",
                "status" => "Delete Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function deleteFileEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "deleteFileEdit"){
            $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$received_data->f_path.$received_data->f_name;
            unlink($path);

            // Delete From Table
            $this->db->where("f_autoid" , $received_data->f_autoid);
            $this->db->delete("files");
            

            $output = array(
                "msg" => "ลบรูปภาพสำเร็จ",
                "status" => "Delete Data Success"
            );
        }else{
            $output = array(
                "msg" => "ลบรูปภาพไม่สำเร็จ",
                "status" => "Delete Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function deleteFileSpointEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "deleteFileSpointEdit"){
            $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$received_data->f_path.$received_data->f_name;
            unlink($path);

            // Delete From Table
            $this->db->where("f_autoid" , $received_data->f_autoid);
            $this->db->delete("files");
            

            $output = array(
                "msg" => "ลบรูปภาพสำเร็จ",
                "status" => "Delete Data Success"
            );
        }else{
            $output = array(
                "msg" => "ลบรูปภาพไม่สำเร็จ",
                "status" => "Delete Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function updateLinenumGroup()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "updateLinenumGroup"){
            $arUpdate = array(
                "d_linenum_group" => $received_data->d_linenum_group
            );
            $this->db->where("d_detailcode" , $received_data->detailcode);
            $this->db->update("details" , $arUpdate);
            $output = array(
                "msg" => "อัพเดตสำเร็จ",
                "status" => "Update Data Success",
                "detailcode" => $received_data->detailcode,
                "linenum_group" => $received_data->d_linenum_group
            );
        }else{
            $output = array(
                "msg" => "อัพเดตไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }



    public function loadQcSampling()
    {
            $batchNo = $this->input->post("batchNo");
            $productionNo = $this->input->post("productionNo");
            $itemNo = $this->input->post("itemNo");
            $dataareaid = $this->input->post("dataareaid");

            $sql = $this->db4->query("SELECT
            slc_qcsampletable.QCSampleId,
            slc_qcsampletable.QualityOrderId,
            slc_qcsampletable.InventBatchId,
            slc_qcsampletable.ItemId,
            slc_qcsampletable.SampleNo,
            slc_qcsampletable.Approve,
            slc_qcsampletable.ApproveBy,
            slc_qcsampletable.ApproveDateTime,
            slc_qcsampletable.QcBy,
            slc_qcsampletable.QCDateTime,
            slc_qcsampletable.Remark,
            slc_qcsampletable.TestGroupId,
            slc_qcsampletable.SamplingGroupId,
            slc_qcsampletable.LineNum,
            slc_qcsampletable.TestStatus,
            slc_qcsampletable.InventRefId,
            slc_qcsampletable.COAuse,
            slc_qcsampletable.modifiedDateTime,
            slc_qcsampletable.modifiedBy,
            slc_qcsampletable.createdDateTime,
            slc_qcsampletable.createBy,
            slc_qcsampletable.dataAreaId
            FROM
            slc_qcsampletable
            WHERE ItemId = '$itemNo' AND 
            InventBatchId = '$batchNo' AND 
            InventRefId = '$productionNo' AND 
            dataAreaId = '$dataareaid'
            ORDER BY LineNum ASC");

            if($sql->num_rows() != 0){
                $qCSampleId = $sql->row()->QCSampleId;
            }else{
                $qCSampleId = '';
            }

            $output = '
            <input hidden type="text" id="checkQcID" name="checkQcID" value="'.$qCSampleId.'">
            <table id="qcSamplingTable" class="table table-bordered table-responsive nowrap" cellspacing="0" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th class="table-secondary">QC Sampling No.</th>
                        <th class="table-secondary">Sample Series</th>
                        <th class="table-secondary">Item Number</th>
                        <th class="table-secondary">Batch Number</th>
                        <th class="table-secondary">Reference</th>
                        <th class="table-secondary">Status</th>
                        <th class="table-secondary">Sample No.</th>
                        <th class="table-secondary">QC By</th>
                        <th class="table-secondary">QC Date Time</th>
                        <th class="table-secondary">Approve By</th>
                        <th class="table-secondary">Remark</th>
                    </tr>
                </thead>
                <tbody>';

                    foreach ($sql->result() as $rs)
                    {
                        $testStatus = '';
                        switch($rs->TestStatus){
                            case 0:
                                $testStatus = "Open";
                                break;
                            case 1:
                                $testStatus = "Fail";
                                break;
                            case 2:
                                $testStatus = "Pass";
                                break;
                        }

                        $output .= '
                            <tr>
                                <td><span class="qclink"
                                    data_qcSampleId="'.$rs->QCSampleId.'"
                                    data_qcSampleNum="'.$rs->LineNum.'"
                                    data_areaId="'.$rs->dataAreaId.'"
                                >' . $rs->QCSampleId . '</span></td>
                                <td>' . $rs->LineNum . '</td>
                                <td>' . $rs->ItemId . '</td>
                                <td>' . $rs->InventBatchId . '</td>
                                <td>' . $rs->InventRefId . '</td>
                                <td>' . $testStatus . '</td>
                                <td>' . $rs->SampleNo . '</td>
                                <td>' . $rs->QcBy . '</td>
                                <td>' . conDatetimeFromDb($rs->QCDateTime) . '</td>
                                <td>' . $rs->ApproveBy . '</td>
                                <td>' . $rs->Remark . '</td>
                            </tr>
                        ';
                    }


                    $output .= '
                </tbody>
            </table>
            ';

            // $output = '
            //     Batch Number : '.$batchnumber.'
            //     Product Number : '.$productnumber.'
            //     Product Code : '.$productcode.'
            //     Data areaid : '.$dataareaid.'
            // ';

            
            echo $output;
    }



    public function loadQcsamplingByLinenum()
    {
        if($this->input->post("data_qcSampleId") != ""){

            $data_qcSampleId = $this->input->post("data_qcSampleId");
            $data_qcSampleNum = $this->input->post("data_qcSampleNum");
            $data_areaId = $this->input->post("data_areaId");

            $sql = $this->db4->query("SELECT
            slc_qcsampleline.SLC_QCSampleId,
            slc_qcsampleline.TestSequence,
            slc_qcsampleline.TestId,
            slc_qcsampleline.TestResult,
            slc_qcsampleline.StandardValue,
            slc_qcsampleline.LowerLimit,
            slc_qcsampleline.UpperLimit,
            slc_qcsampleline.LowerTolerance,
            slc_qcsampleline.VariableId,
            slc_qcsampleline.VariableOutcomeIdStandard,
            slc_qcsampleline.CertificateOfAnalysisReport,
            slc_qcsampleline.ActionOnFailure,
            slc_qcsampleline.TestInstrumentId,
            slc_qcsampleline.TestUnitID,
            slc_qcsampleline.IncludeResults,
            slc_qcsampleline.AcceptableQualityLevel,
            slc_qcsampleline.TestResultValueReal,
            slc_qcsampleline.QCSampleNum,
            slc_qcsampleline.TestResultValueOutcome,
            slc_qcsampleline.LABComment,
            slc_qcsampleline.BPC_SpecificationId,
            slc_qcsampleline.dataAreaId,
            slc_qcsampleline.TestOutcomeStatus,
            slc_qcsampleline.StandardValue,
            slc_qcsampleline.LowerLimit,
            slc_qcsampleline.UpperLimit
            FROM
            slc_qcsampleline
            WHERE SLC_QCSampleId = '$data_qcSampleId' AND
            QCSampleNum = '$data_qcSampleNum' AND
            dataAreaId = '$data_areaId' ORDER BY TestSequence ASC");

            $output = '
            <table id="qcSamplingTableByLinenum" class="table table-bordered" cellspacing="0" style="width:100%;">
                <thead>
                    <tr class="text-center">
                        <th class="table-secondary">Seq No.</th>
                        <th class="table-secondary" style="width:200px;">Test ID</th>
                        <th class="table-secondary">Test Value</th>
                        <th class="table-secondary" style="width:80px;">Pass / Fail</th>
                        <th class="table-secondary">Test Result</th>
                        <th class="table-secondary">Standard</th>
                        <th class="table-secondary">Min</th>
                        <th class="table-secondary">Max</th>
                        <th class="table-secondary" style="width:300px;">Comment From LAB</th>
                    </tr>
                </thead>
                <tbody>';

                    foreach ($sql->result() as $rs)
                    {
                        $testStatus = '';
                        switch($rs->TestOutcomeStatus){
                            case "Open":
                                $testStatus = '<i class="icon-minus1 iconTestFail"></i>';
                                break;
                            case "Pass":
                                $testStatus = '<i class="icon-ok iconTestPass"></i>';
                                break;
                            case "Fail":
                                $testStatus = '<i class="icon-remove iconTestFail"></i>';
                        }

                        // check ค่า 0.000 หากพบไม่ต้องแสดง
                        $rsStandardValue = "";
                        $rsLowerLimit = "";
                        $rsUpperLimit = "";
                        if(
                            $rs->StandardValue == 0.000 || 
                            $rs->LowerLimit == 0.000 || 
                            $rs->UpperLimit == 0.000
                        ){
                            $rsStandardValue = "";
                            $rsLowerLimit = "";
                            $rsUpperLimit = "";
                        }else{
                            $rsStandardValue = $rs->StandardValue;
                            $rsLowerLimit = $rs->LowerLimit;
                            $rsUpperLimit = $rs->UpperLimit;
                        }

                        

                        $output .= '
                            <tr>
                                <td class="text-center">' . $rs->TestSequence . '</td>
                                <td>' . $rs->TestId . '</td>
                                <td>' . $rs->TestResultValueReal . '</td>
                                <td>' . $rs->TestResultValueOutcome . '</td>
                                <td class="text-center">' . $testStatus . '</td>
                                <td>' . $rsStandardValue . '</td>
                                <td>' . $rsLowerLimit . '</td>
                                <td>' . $rsUpperLimit . '</td>
                                <td>' . $rs->LABComment . '</td>
                            </tr>
                        ';
                    }


                    $output .= '
                </tbody>
            </table>
            ';


            echo $output;

        }

        
    }



    public function saveMemoStop()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "saveMemoStop"){
            $arMemo = array(
                "m_memo" => $received_data->mainmemo
            );
            $this->db->where("m_code" , $received_data->maincode);
            $this->db->update("main" , $arMemo);

            $output = array(
                "msg" => "อัพเดตข้อมูลสำเร็จ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }



    public function saveEditHead()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "saveEditHead"){
            $arUpdateHead = array(
                "m_order" => $received_data->m_order,
                "m_std_output" => $received_data->m_std_output,
                "m_bladeType" => $received_data->m_bladeType,
                "m_screenMesh" => $received_data->m_screenMesh,
                "m_gap" => $received_data->m_gap,
                "m_machine" => $received_data->m_machine
            );
            $this->db->where("m_code" , $received_data->m_code);
            $this->db->update("main" , $arUpdateHead);

            $m_formno = getMainFormno($received_data->m_code);

            $action = "แก้ไขข้อมูลส่วน Head สำเร็จ เอกสารเลขที่ : $m_formno";
            saveActivity(
                $action,
                getActivityData($received_data->m_code)->m_product_number,
                getActivityData($received_data->m_code)->m_batch_number,
                getActivityData($received_data->m_code)->m_item_number,
                getActivityData($received_data->m_code)->m_dataareaid
            );

            $output = array(
                "msg" => "อัพเดตข้อมูลสำเร็จ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function loadCheckMachinePage()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadCheckMachinePage"){

            // Get Machine Check Template
            $sql = $this->db->query("SELECT * FROM machine_check_template order by mckt_checklist_linenum asc");
            // Get Machine Check Template

            // Get Item , Batch Number
            $getItemBatch = $this->db->query("SELECT mck_itemno , mck_batchno , mck_linenumgroup , mck_datetime from machine_check where mck_m_code = '$received_data->m_code' group by mck_linenumgroup order by mck_linenumgroup asc ");
            if($getItemBatch->num_rows() !=0){
                foreach($getItemBatch->result() as $rss){
                    $groupLine = array(
                        "batchno" => $rss->mck_batchno,
                        "itemno" => $rss->mck_itemno,
                        "linenumgroup" => $rss->mck_linenumgroup,
                        "datetime" => conDateTimeFromDb($rss->mck_datetime)
                    );
    
                    $resultByGroup[] = $groupLine;
                }
            }else{
                $resultByGroup = [];
            }
            
            // Get Item , Batch Number

            // Get value of Machine Check
            $valueArray = [];
            if($getItemBatch->num_rows() !=0){
                foreach($getItemBatch->result() as $rs){
                    $getValue = $this->db->query("SELECT mck_value , mck_linenumgroup from machine_check where mck_m_code = '$received_data->m_code' and mck_linenumgroup = '$rs->mck_linenumgroup' order by mck_linenum asc ");
    
                    $valueArray[] = $getValue->result();
                }
            }else{
                $valueArray = [];
            }
            
            

            if($getItemBatch->num_rows() != 0){
                $itemno = $getItemBatch->row()->mck_itemno;
                $batchno = $getItemBatch->row()->mck_batchno;
            }else{
                $itemno = null;
                $batchno = null;
            }


            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "check_template" => $sql->result(),
                "itemno" => $itemno,
                "batchno" => $batchno,
                "value" => $valueArray,
                "lineGroup" => $resultByGroup
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "check_template" => null,
            );
        }

        echo json_encode($output);
    }



    public function saveMachineCheck()
    {
        if($this->input->post("mcmd_mcode") != ""){
            $mckList = $this->input->post("mcklist");
            $m_code = $this->input->post("mcmd_mcode");

            $itemNumber = $this->input->post("mck_itemnumber");
            $batchNumber = $this->input->post("mck_batchnumber");

            // check Duplicate batch and item
                $sqlCheckDup = $this->db->query("SELECT
                machine_check.mck_autoid,
                machine_check.mck_m_code,
                machine_check.mck_itemno,
                machine_check.mck_batchno,
                machine_check.mck_user,
                machine_check.mck_ecode,
                machine_check.mck_deptcode,
                machine_check.mck_datetime
                FROM
                machine_check
                WHERE mck_itemno = '$itemNumber' AND mck_batchno = '$batchNumber' AND mck_m_code = '$m_code'
                GROUP BY mck_batchno
                ");
            if($sqlCheckDup->num_rows() != 0){
                $output = array(
                    "msg" => "บันทึกข้อมูลไม่สำเร็จพบข้อมูลซ้ำในระบบ",
                    "status" => "Insert Data Not Success Found Duplicate Data"
                );
            }else{
                $checkLinenumGroup = $this->db->query("SELECT mck_linenumgroup FROM machine_check WHERE mck_m_code = '$m_code' group by mck_linenumgroup order by mck_linenumgroup desc ");
                if($checkLinenumGroup->num_rows() != 0){
                    $linenumgroup = $checkLinenumGroup->row()->mck_linenumgroup;
                    $linenumgroup++;
                }else{
                    $linenumgroup = 1;
                }
    
                foreach($mckList as $key => $value){
                    $arInsertMachineCheck = array(
                        "mck_m_code" => $m_code,
                        "mck_list" => $value,
                        "mck_value" => $this->input->post("mckval")[$key],
                        "mck_itemno" => $this->input->post("mck_itemnumber"),
                        "mck_batchno" => $this->input->post("mck_batchnumber"),
                        "mck_linenumgroup" => $linenumgroup,
                        "mck_linenum" => $this->input->post("mcklinenum")[$key],
                        "mck_user" => getUser()->Fname." ".getUser()->Lname,
                        "mck_ecode" => getUser()->ecode,
                        "mck_deptcode" => getUser()->DeptCode,
                        "mck_datetime" => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("machine_check" , $arInsertMachineCheck);
                }
    
                $m_formno = getMainFormno($m_code);
                $action = "บันทึกผลการตรวจสอบเครื่องจักรของเอกสารเลขที่ : $m_formno สำเร็จ";
                saveActivity(
                    $action,
                    getActivityData($m_code)->m_product_number,
                    getActivityData($m_code)->m_batch_number,
                    getActivityData($m_code)->m_item_number,
                    getActivityData($m_code)->m_dataareaid
                );
    
                $output = array(
                    "msg" => "บันทึกข้อมูลสำเร็จ",
                    "status" => "Insert Data Success"
                );
            }
            // check Duplicate batch and item


        }else{
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function loadCheckGroupForEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadCheckGroupForEdit"){
            $sql = $this->db->query("SELECT mck_linenumgroup , mck_m_code , mck_batchno , mck_itemno from machine_check where mck_m_code = '$received_data->m_code' group by mck_linenumgroup order by mck_linenumgroup asc ");


            $output = array(
                "msg" => "ดึงข้อมูลเรียบร้อยแล้ว",
                "status" => "Select Data Success",
                "lineGroupEdit" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "lineGroupEdit" => null
            );
        }

        echo json_encode($output);
    }


    public function loadCheckMainPageEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadCheckMainPageEdit"){
            $sql = $this->db->query("SELECT * FROM machine_check 
            where mck_m_code = '$received_data->m_code' and 
            mck_linenumgroup = '$received_data->linegroup' ");

            if($sql->num_rows() != 0){
                $output = array(
                    "msg" => "ดึงข้อมูลสำเร็จ",
                    "status" => "Select Data Success",
                    "mcCheckEdit" => $sql->result(),
                    "batchno" => $sql->row()->mck_batchno,
                    "itemno" => $sql->row()->mck_itemno,
                    "datetime" => conDateTimeFromDb($sql->row()->mck_datetime)
                );
            }
            
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "mcCheckEdit" => null,
                "batchno" => null,
                "itemno" => null,
                "datetime" => null
            );
        }

        echo json_encode($output);
    }

    public function saveEditMachineCheck()
    {
        if($this->input->post("mcmd_mcodeEdit") != ""){

            $machineCheckValue = $this->input->post("mckval_edit");
            foreach($machineCheckValue as $key => $machineCheckValues){
                $arUpdate = array(
                    "mck_value" => $machineCheckValues,
                    "mck_user_modify" => getUser()->Fname." ".getUser()->Lname,
                    "mck_ecode_modify" => getUser()->ecode,
                    "mck_deptcode_modify" => getUser()->DeptCode,
                    "mck_datetime_modify" => date("Y-m-d H:i:s")
                );
                $this->db->where("mck_m_code" , $this->input->post("mcmd_mcodeEdit"));
                $this->db->where("mck_linenumgroup" , $this->input->post("lineGroupForEdit"));
                $this->db->where("mck_autoid" , $this->input->post("mck_autoid_edit")[$key]);
                $this->db->update("machine_check" , $arUpdate);
            }

            $m_code = $this->input->post("mcmd_mcodeEdit");
            $m_formno = getMainFormno($m_code);
            $action = "บันทึกผลการแก้ไข การตรวจสอบเครื่องจักรของเอกสารเลขที่ : $m_formno สำเร็จ";
            saveActivity(
                $action,
                getActivityData($m_code)->m_product_number,
                getActivityData($m_code)->m_batch_number,
                getActivityData($m_code)->m_item_number,
                getActivityData($m_code)->m_dataareaid
            );

            $output = array(
                "msg" => "อัพเดตข้อมูลสำเร็จ",
                "status" => "Update Data Success"
            );
            
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }


    public function deleteMachineCheck()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "deleteMachineCheck"){
            $this->db->where("mck_m_code" , $received_data->m_code);
            $this->db->where("mck_linenumgroup" , $received_data->linenum_group);
            $this->db->delete("machine_check");


            $m_formno = getMainFormno($received_data->m_code);
            $action = "ลบรายการ ตรวจสอบเครื่องจักรของเอกสารเลขที่ : $m_formno สำเร็จ";
            saveActivity(
                $action,
                getActivityData($received_data->m_code)->m_product_number,
                getActivityData($received_data->m_code)->m_batch_number,
                getActivityData($received_data->m_code)->m_item_number,
                getActivityData($received_data->m_code)->m_dataareaid
            );

            $output = array(
                "msg" => "ลบรายการสำเร็จ",
                "status" => "Delete Data Success"
            );
        }else{
            $output = array(
                "msg" => "ลบรายการไม่สำเร็จ",
                "status" => "Delete Data Not Success"
            );
        }

        echo json_encode($output);
    }




    public function getSpeacialData()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "getSpeacialData"){
            $templatecode = $received_data->get_templatecode;

            $sqlGetOtherImage = $this->db->query("SELECT
            template_image.tm_autoid,
            template_image.tm_templatecode,
            template_image.tm_imagename,
            template_image.tm_imagepath,
            template_image.tm_imagetype
            FROM
            template_image
            WHERE tm_templatecode = '$templatecode' AND tm_imagetype = 'Other Image' ORDER BY tm_autoid ASC
            ");

            $sqlgetRemark = $this->db->query("SELECT master_remark FROM template_master WHERE master_temcode = '$templatecode' ");

            if($sqlgetRemark->num_rows() != 0){
                $templateRemark = $sqlgetRemark->row()->master_remark;
            }else{
                $templateRemark = null;
            }
            $output = array(
                "msg" => "ดึงข้อมูล Speacial Data สำเร็จ",
                "status" => "Select Data Success",
                "imageOther" => $sqlGetOtherImage->result(),
                "templateRemark" => $templateRemark
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Speacial Data ไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "imageOther" => null,
                "templateRemark" => null
            );
        }
        echo json_encode($output);
    }


    public function getMachine()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "getMachine"){
            $sql = $this->db3->query("SELECT 
            a.wrkctrid as mach_name,
            a.prodfactory,
            a.enummatchinetype,
            case
                when a.enummatchinetype = 0 then 'NONE'
                when a.enummatchinetype = 1 then 'MIXER'
                when a.enummatchinetype = 2 then 'EXTRUDER'
                when a.enummatchinetype = 3 then 'BUSS'
                when a.enummatchinetype = 4 then 'FARREL'
                when a.enummatchinetype = 5 then 'TE75'
                when a.enummatchinetype = 6 then 'TE58'
                when a.enummatchinetype = 7 then 'TE96'
                when a.enummatchinetype = 8 then 'GRINDER'
                when a.enummatchinetype = 9 then 'VIBRATOR'
                when a.enummatchinetype = 10 then 'PACKING'
                when a.enummatchinetype = 11 then 'OVEN'
                when a.enummatchinetype = 12 then 'OUTSOURCE'
                when a.enummatchinetype = 13 then 'RM PREPARE'
            end as factory ,
            b.name as mach_desc
            from slc_wrkctrfactable a
                left join wrkctrtable b on a.wrkctrid = b.wrkctrid
            where 
            (
                b.recid IN (SELECT MAX(recid) as recid FROM wrkctrtable GROUP BY wrkctrid)
            ) 
            and a.prodfactory in (5)
            and a.enummatchinetype not in (11,1)
            and a.enummatchinetype not in (7 , 5)
            group by a.wrkctrid , a.prodfactory , a.enummatchinetype , b.name
            order by a.prodfactory asc");

            $output = array(
                "msg" => "ดึงข้อมูลเครื่องจักรสำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลเครื่องจักรไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "result" => null
            );
        }

        echo json_encode($output);
    }

    
    

}/* End of file ModelName.php */



?> 