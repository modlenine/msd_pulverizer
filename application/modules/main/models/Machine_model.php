<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class machine_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->db4 = $this->load->database("mssql_prodplan", true);
    }

    // Runscreen Zone
    public function checkDuplicateRunscreen()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "checkDuplicateRunscreen"){

            $sql = $this->db->query("SELECT run_name 
            FROM runscreen 
            WHERE run_name = '$received_data->runscreen_name' 
            ");

            if($sql->num_rows() != 0){
                $output = array(
                    "msg" => "พบข้อมูลซ้ำในระบบ",
                    "status" => "Found Duplicate Data"
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูลซ้ำในระบบ",
                    "status" => "Not Found Duplicate Data"
                );
            }

            
        }else{
            $output = array(
                "msg" => "Cannot Connect"
            );
        }

        echo json_encode($output);
    }
    public function saveRunscreen()
    {
        
        if($this->input->post("add_runscreen_name") != ""){
            $arInsert = array(
                "run_name" => $this->input->post("add_runscreen_name"),
                "run_min" => $this->input->post("add_min"),
                "run_max" => $this->input->post("add_max"),
                "run_spoint" => $this->input->post("add_spoint"),
                "run_userpost" => getUser()->Fname." ".getUser()->Lname,
                "run_ecode" => getUser()->ecode,
                "run_datetime" => date("Y-m-d H:i:s"),
            );

            $this->db->insert("runscreen" , $arInsert);

            $action = "สร้างรายการ Run Screen สำเร็จ";
            saveActivity(
                $action,
                "",
                "",
                "",
                ""
            );

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert Data Success"
            );
        }else{
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert Data Not Success"
            );
        }

        echo json_encode($output);
    }
    public function getAllRunscreen()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "getAllRunscreen"){
            $sql = $this->db->query("SELECT 
            run_autoid,
            run_name,
            run_min,
            run_max,
            run_spoint
            FROM runscreen ORDER BY run_autoid DESC
            ");

            $output = '
            <h4><u>รายการ Runscreen ทั้งหมด</u></h4>
                <div class="table-responsive">
                    <table id="runscreenManage" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="runname">Run Screen</th>
                                <th class="runmin">Min</th>
                                <th class="runmax">Max</th>
                                <th class="runspoint">S/POINT</th>
                                <th class="runBtn">#</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
            foreach($sql->result() as $rs){
                $output .= '
                    <tr>
                        <td>' . $rs->run_name . '</td>
                        <td>' . $rs->run_min . '</td>
                        <td>' . $rs->run_max . '</td>
                        <td>' . $rs->run_spoint . '</td>
                        <td>
                        <i class="fa fa-edit iconRunEdit"
                            data_run_name = "'.$rs->run_name.'" 
                            data_run_autoid="'.$rs->run_autoid.'"
                            data_run_min="'.$rs->run_min.'"
                            data_run_max="'.$rs->run_max.'"
                            data_run_spoint="'.$rs->run_spoint.'"
                        ></i>
                        <i class="fa fa-trash iconRunDel" data_run_autoid="'.$rs->run_autoid.'"></i>
                        </td>
                    </tr>
                    ';
            }
                $output .= '
                        </tbody>
                    </table>
                </div>
                ';
            echo $output;

        }else{
            echo "Not ok";
        }
    }
    public function saveEditRunscreen()
    {
        if($this->input->post("add_runscreen_name") != ""){
            $arUpdate = array(
                "run_name" => $this->input->post("add_runscreen_name"),
                "run_min" => $this->input->post("add_min"),
                "run_max" => $this->input->post("add_max"),
                "run_spoint" => $this->input->post("add_spoint"),
                "run_userpost" => getUser()->Fname." ".getUser()->Lname,
                "run_ecode" => getUser()->ecode,
                "run_datetime" => date("Y-m-d H:i:s"),
            );
            $this->db->where("run_autoid" , $this->input->post("add_autoid"));
            $this->db->update("runscreen" , $arUpdate);

            $action = "แก้ไขรายการ Run Screen สำเร็จ";
            saveActivity(
                $action,
                "",
                "",
                "",
                ""
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
    public function deleteRunscreen()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "deleteRunscreen"){
            $this->db->where("run_autoid" , $received_data->run_autoid);
            $this->db->delete("runscreen");

            $action = "ลบรายการ Run Screen สำเร็จ";
            saveActivity(
                $action,
                "",
                "",
                "",
                ""
            );

            $output = array(
                "msg" => "ลบข้อมูล Runscreen สำเร็จ",
                "status" => "Delete Data Success"
            );
        }else{
            $output = array(
                "msg" => "ลบข้อมูลไม่สำเร็จ",
                "status" => "Delete Data Not Success"
            );
        }
        echo json_encode($output);
    }
    public function loadMainRunscreen()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadMainRunscreen"){
            $sql = $this->db->query("SELECT
            runscreen.run_autoid,
            runscreen.run_name,
            runscreen.run_min,
            runscreen.run_max,
            runscreen.run_spoint
            FROM
            runscreen
            ORDER BY run_autoid DESC");

            // $outputHtml = '
            // <ul class="list-group">';
            // foreach($sql->result() as $rs){
            //     $outputHtml .='
            //     <li class="list-group-item list-group-item list-group-item-action runRightLi">
            //         <span>'.$rs->run_name.'</span><br>
            //         <span><b>Min: </b>'.$rs->run_min.'</span>
            //         <span><b>Max: </b>'.$rs->run_max.'</span><br>
            //         <span><b>SPoint: </b>'.$rs->run_spoint.'</span>
            //         <i class="fa fa-chevron-circle-right runRight" aria-hidden="true"
            //             data_run_autoid = "'.$rs->run_autoid.'"
            //             data_run_name = "'.$rs->run_name.'"
            //             data_run_min = "'.$rs->run_min.'"
            //             data_run_max = "'.$rs->run_max.'"
            //             data_run_spoint = "'.$rs->run_spoint.'"
            //         ></i>
            //     </li>
            //     ';
            // }
            // $outputHtml .='
            // </ul>
            // ';

            foreach($sql->result() as $rs){
                $rsArray = array(
                    "run_autoid" => $rs->run_autoid,
                    "run_name" => $rs->run_name,
                    "run_min" => $rs->run_min,
                    "run_max" => $rs->run_max,
                    "run_spoint" => $rs->run_spoint
                );
                $resultOutput[] = $rsArray;
            }

            $output = array(
                "msg" => "ดึงข้อมูล Runscreen สำเร็จ",
                "status" => "Select Data Success",
                "outputArray" => $resultOutput
            );

            echo json_encode($output);
            
        }
    }
    public function loadItemidFormTable()
    {
        $received_data = json_decode(file_get_contents("php://input"));

        if($received_data->action == "loadItemidFormTable"){
            $itemNumber = $received_data->itemNumber;
            $sql = $this->db4->query("SELECT TOP 50
                itemid 
            FROM
                prodtable WHERE itemid LIKE '%$itemNumber%' 
            GROUP BY
                itemid 
            ORDER BY
                itemid ASC");

            $output = '';
            $output .= '<ul class="list-group itemidUl">';
                foreach ($sql->result() as $rs) {
            
                    $output .= '
                    <a href="javascript:void(0)" id="itemidA" class="itemidA"
                        data_itemid = "'.$rs->itemid.'"
                    ><li class="list-group-item mb-1 itemidLi">
                    <span>' . $rs->itemid . '</span><br>
                    </li></a>
                ';
                }
            $output .= '</ul>';
            $result = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "outputHtml" => $output
            );
        }else{
            $result = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }

        echo json_encode($result);
    }
    public function saveTemplate()
    {
        if($this->input->post("templateName") != "" &&
        $this->input->post("maxamp") != ""
        ){
            // Save Detail Table
            $date = date_create();
            $dateTimeStamp = date_timestamp_get($date);

            $fileInput = "templatePicture";
            $this->saveMasterTable($fileInput , $dateTimeStamp);
            $this->saveDetailsTable($dateTimeStamp);

            $templatename = $this->input->post("templateName");
            $action = "สร้าง Template สำเร็จ ($templatename)";
            saveActivity(
                $action,
                "",
                "",
                "",
                ""
            );
            
            $output = array(
                "msg" => "สร้าง Template สำเร็จ",
                "status" => "Insert Data Success"
            );
        }else{
            $output = array(
                "msg" => "สร้าง Template ไม่สำเร็จ",
                "status" => "Insert Data Not Success"
            );
        }

        echo json_encode($output);
    }
    private function saveMasterTable($fileInput , $dateTimeStamp)
    {
        $imageFile = uploadImageTemplate($fileInput);
        $yearNow = date("Y");
        $dateNow = date("Y-m-d");
        $imagePath = "uploads/template_images/".$yearNow."/".$dateNow."/";

        if($imageFile != null){
            $rsImageFile = $imageFile;
            $rsImagePath = $imagePath;
            $imageStatus = "yes";
        }else{

            if($this->input->post("choiceTemplates") == "new"){
                $rsImageFile = "noimage2.jpg";
                $rsImagePath = "uploads/";
                $imageStatus = "no";
            }else if($this->input->post("choiceTemplates") == "copy"){

                $rsImagePath = $this->input->post("templatePicturePath_o");
                

                if($this->input->post("templatePicture_o") != "noimage2.jpg"){
                    
                    $imageOld = $this->input->post("templatePicture_o");
                    $rsImageFile = "copy-".getRuningCode(9)."-".$this->input->post("templatePicture_o");
                    $imageStatus = "yes";

                    $pathSource = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$rsImagePath.$imageOld;
                    $pathDestination = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$rsImagePath.$rsImageFile;
                    // Copy Image
                    copy($pathSource , $pathDestination);
                }else{
                    $imageStatus = "no";
                    $rsImageFile = $this->input->post("templatePicture_o");
                }

                
                
                
            }
            
        }

            //อัพโหลด Template Other Image
            $fileOtherInput = "t_otherImage";
            uploadTemplateOtherImage($fileOtherInput , $dateTimeStamp);


            $arInsertTemplate = array(
                "master_temcode" => $dateTimeStamp,
                "master_name" => $this->input->post("templateName"),
                "master_itemnumber" => $this->input->post("itemNumber"),
                "master_maxamp" => $this->input->post("maxamp"),
                "master_image" => $rsImageFile,
                "master_imagePath" => $rsImagePath,
                "master_imagestatus" => $imageStatus,
                "master_user" => getUser()->Fname." ".getUser()->Lname,
                "master_remark" => $this->input->post("t_remark"),
                "master_ecode" => getUser()->ecode,
                "master_deptcode" => getUser()->DeptCode,
                "master_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("template_master" , $arInsertTemplate);
    }
    private function saveDetailsTable($dateTimeStamp)
    {
        $column_name = $this->input->post("select_run_name");
        $linenum = 1;
        foreach($column_name as $key => $column_names){//Run loop with column name
            $arsaveTemplate = array(
                "detail_mastercode" => $dateTimeStamp,
                "detail_column_name" => $column_names,
                "detail_name" => $this->input->post("templateName"),
                "detail_min" => $this->input->post("select_run_min")[$key],
                "detail_max" => $this->input->post("select_run_max")[$key],
                "detail_spoint" => $this->input->post("select_run_spoint")[$key],
                "detail_linenum" => $linenum,
                "detail_runautoid" => $this->input->post("select_run_autoid")[$key],
                "detail_user" => getUser()->Fname." ".getUser()->Lname,
                "detail_ecode" => getUser()->ecode,
                "detail_deptcode" => getUser()->DeptCode,
                "detail_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("template_details" , $arsaveTemplate);
            $linenum++;
        }
    }



    // Template Zone
    public function loadTemplateList()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        $template = [];
         if($received_data->action == "loadTemplateList"){
            $sql = $this->db->query("SELECT
            template_master.master_autoid,
            template_master.master_temcode,
            template_master.master_name,
            template_master.master_itemnumber,
            template_master.master_image,
            template_master.master_imagePath,
            template_master.master_user,
            template_master.master_ecode,
            template_master.master_deptcode,
            template_master.master_datetime
            FROM
            template_master
            WHERE master_name LIKE '%$received_data->searchTemplate%'
            ORDER BY template_master.master_autoid DESC");

            foreach($sql->result() as $rs){
                $result = array(
                    "master_autoid" => $rs->master_autoid,
                    "master_temcode" => $rs->master_temcode,
                    "master_name" => $rs->master_name,
                    "master_itemnumber" => $rs->master_itemnumber,
                    "master_image" => $rs->master_image,
                    "master_imagePath" => $rs->master_imagePath
                );
                $template[] = $result;
            }

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "getTemplate" => $template
            );
            

         }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "getTemplate" => null
            );
         }
         echo json_encode($output);
    }
    public function loaddataToEditModal()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loaddataToEditModal"){

            // Select Main data
            $sqlSelectMainTable = $this->db->query("SELECT
            template_master.master_temcode,
            template_master.master_name,
            template_master.master_itemnumber,
            template_master.master_stdoutput,
            template_master.master_maxamp,
            template_master.master_packing,
            template_master.master_image,
            template_master.master_imagePath,
            template_master.master_remark
            FROM
            template_master
            WHERE template_master.master_temcode = '$received_data->templateCode'
            ");
            // Select Main data

            // Select Detail Data
            $sqlSelectDetailTable = $this->db->query("SELECT
            template_details.detail_mastercode,
            template_details.detail_column_name,
            template_details.detail_name,
            template_details.detail_min,
            template_details.detail_max,
            template_details.detail_spoint,
            template_details.detail_linenum,
            template_details.detail_runautoid,
            template_details.detail_autoid
            FROM
            template_details
            WHERE template_details.detail_mastercode = '$received_data->templateCode'
            ORDER BY template_details.detail_linenum ASC
            ");
            foreach($sqlSelectDetailTable->result() as $rsDetail){
                $detailArray = array(
                    "detail_mastercode" => $rsDetail->detail_mastercode,
                    "detail_column_name" => $rsDetail->detail_column_name,
                    "detail_name" => $rsDetail->detail_name,
                    "detail_min" => $rsDetail->detail_min,
                    "detail_max" => $rsDetail->detail_max,
                    "detail_spoint" => $rsDetail->detail_spoint,
                    "detail_linenum" => $rsDetail->detail_linenum,
                    "detail_runautoid" => $rsDetail->detail_runautoid,
                    "detail_autoid" => $rsDetail->detail_autoid
                );

                $allDetail[] = $detailArray;
            }

        // Select Detail Data

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "master_temcode" => $sqlSelectMainTable->row()->master_temcode,
                "master_name" => $sqlSelectMainTable->row()->master_name,
                "master_itemnumber" => $sqlSelectMainTable->row()->master_itemnumber,
                "master_image" => $sqlSelectMainTable->row()->master_image,
                "master_imagePath" => $sqlSelectMainTable->row()->master_imagePath,
                "master_stdoutput" => $sqlSelectMainTable->row()->master_stdoutput,
                "master_maxamp" => $sqlSelectMainTable->row()->master_maxamp,
                "master_packing" => $sqlSelectMainTable->row()->master_packing,
                "allDetail" => $allDetail,
                "master_remark" => $sqlSelectMainTable->row()->master_remark,
            );


        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }

        echo json_encode($output);
    }
    public function saveEditTemplate()
    {
        if($this->input->post("templateName_edit") != ""){
            // Save Detail Table
            $master_temcode = $this->input->post("tempCode_edit");
            $fileInput = "templatePicture_edit";
            $this->saveEditMasterTable($fileInput , $master_temcode);
            $this->saveEditDetailsTable($master_temcode);

            $action = "แก้ไข Template สำเร็จ";
            saveActivity(
                $action,
                "",
                "",
                "",
                ""
            );
            
            $output = array(
                "msg" => "แก้ไข Template สำเร็จ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "แก้ไข Template ไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }
    private function saveEditMasterTable($fileInput , $master_temcode)
    {
        $yearNow = date("Y");
        $dateNow = date("Y-m-d");
        $imageStatus = "";

        if($_FILES[$fileInput]['tmp_name'] != ""){

            if(getFileForCheck($master_temcode) == "yes"){
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$this->input->post("imagePath_edit").$this->input->post("imageFile_edit");
                unlink($path);
            }

            $imageStatus = "yes";
            $imageFile = uploadImageTemplate($fileInput);
            $imagePath = "uploads/template_images/".$yearNow."/".$dateNow."/";
        }else{
            $imageFile = $this->input->post("imageFile_edit");
            $imagePath = $this->input->post("imagePath_edit");
            if(getFileForCheck($master_temcode) == "yes"){
                $imageStatus = "yes";
            }else{
                $imageStatus = "no";
            }
        }

            //อัพโหลด Template Other Image
            $fileOtherInput = "t_otherImageEdit";
            uploadTemplateOtherImage($fileOtherInput , $master_temcode);

            $arInsertTemplate = array(
                "master_name" => $this->input->post("templateName_edit"),
                "master_itemnumber" => $this->input->post("itemNumber_edit"),
                "master_image" => $imageFile,
                "master_imagePath" => $imagePath,
                "master_imagestatus" => $imageStatus,
                "master_maxamp" => $this->input->post("maxamp_edit"),
                "master_user_modify" => getUser()->Fname." ".getUser()->Lname,
                "master_ecode_modify" => getUser()->ecode,
                "master_deptcode_modify" => getUser()->DeptCode,
                "master_datetime_modify" => date("Y-m-d H:i:s"),
                "master_remark" => $this->input->post("t_remarkEdit")
            );
            $this->db->where("master_temcode" , $master_temcode);
            $this->db->update("template_master" , $arInsertTemplate);
    }
    private function saveEditDetailsTable($master_temcode)
    {
        //Delete old template data
        $this->db->where("detail_mastercode" , $master_temcode);
        $this->db->delete("template_details");


        $column_name = $this->input->post("select_run_name_edit");
        $linenum = 1;
        foreach($column_name as $key => $column_names){//Run loop with column name
            $arsaveTemplate = array(
                "detail_mastercode" => $master_temcode,
                "detail_column_name" => $column_names,
                "detail_name" => $this->input->post("templateName_edit"),
                "detail_min" => $this->input->post("select_run_min_edit")[$key],
                "detail_max" => $this->input->post("select_run_max_edit")[$key],
                "detail_spoint" => $this->input->post("select_run_spoint_edit")[$key],
                "detail_linenum" => $linenum,
                "detail_runautoid" => $this->input->post("select_run_autoid_edit")[$key],
                "detail_user" => getUser()->Fname." ".getUser()->Lname,
                "detail_ecode" => getUser()->ecode,
                "detail_deptcode" => getUser()->DeptCode,
                "detail_datetime" => date("Y-m-d H:i:s")
            );
            $this->db->insert("template_details" , $arsaveTemplate);
            $linenum++;
        }
    }

    public function deleteTemplate()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "deleteTemplate"){
            //Delete Master table
            $this->db->where("master_temcode" , $received_data->templateCode);
            $this->db->delete("template_master");

            // Delete Detail table
            $this->db->where("detail_mastercode" , $received_data->templateCode);
            $this->db->delete("template_details");

            if($received_data->imageFile != "noimage2.jpg"){
                // Unlink File
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$received_data->imagePath.$received_data->imageFile;
                unlink($path);
            }


            // ลบ Other Image
            $getOtherImage = $this->db->query("SELECT
            template_image.tm_autoid,
            template_image.tm_templatecode,
            template_image.tm_imagename,
            template_image.tm_imagepath,
            template_image.tm_imagetype
            FROM
            template_image
            WHERE tm_templatecode = '$received_data->templateCode' ORDER BY tm_autoid ASC
            ");

            if($getOtherImage->num_rows() != 0){
                foreach($getOtherImage->result() as $rs){
                    $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$rs->tm_imagepath.$rs->tm_imagename;
                    @unlink($path);
                }
                
            }
            $this->db->where("tm_templatecode" , $received_data->templateCode);
            $this->db->delete("template_image");

            

            $action = "ลบ Template สำเร็จ";
            saveActivity(
                $action,
                "",
                "",
                "",
                ""
            );

            $output = array(
                "msg" => "ลบ เทมเพลต สำเร็จ",
                "status" => "Delete Template Success"
            );
        }else{
            $output = array(
                "msg" => "ลบ เทมเพลต ไม่สำเร็จ",
                "status" => "Delete Template Not Success"
            );
        }

        echo json_encode($output);
    }



    public function getTemplateSource()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "getTemplateSource"){
            $sql = $this->db->query("SELECT
            template_master.master_autoid,
            template_master.master_temcode,
            template_master.master_name,
            template_master.master_itemnumber,
            template_master.master_stdoutput,
            template_master.master_maxamp,
            template_master.master_packing,
            template_master.master_image,
            template_master.master_imagePath,
            template_master.master_imagestatus
            FROM
            template_master
            WHERE master_name LIKE '%$received_data->tempSource%'
            ORDER BY master_name ASC
            ");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "templateSource" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }

        echo json_encode($output);
    }



    public function loadSelectedRunscreen_copy()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadSelectedRunscreen_copy"){
            $sql = $this->db->query("SELECT
            template_details.detail_autoid,
            template_details.detail_mastercode,
            template_details.detail_column_name,
            template_details.detail_name,
            template_details.detail_min,
            template_details.detail_max,
            template_details.detail_spoint,
            template_details.detail_linenum,
            template_details.detail_runautoid
            FROM
            template_details
            WHERE detail_mastercode = '$received_data->master_temcode'
            ORDER BY detail_linenum ASC
            ");

            foreach($sql->result() as $rs){
                $runSelectData = array(
                    "run_autoid" => $rs->detail_runautoid,
                    "run_max" => $rs->detail_max,
                    "run_min" => $rs->detail_min,
                    "run_name" => $rs->detail_column_name,
                    "run_spoint" => $rs->detail_spoint,
                );
                $resultSelect[] = $runSelectData;
            }

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "resultSelectData" => $resultSelect
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }

        echo json_encode($output);
        
    }

    public function loadSumRun()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "loadSumRun"){
            $sql = $this->db->query("SELECT
            template_details.detail_column_name,
            template_details.detail_min,
            template_details.detail_max,
            template_details.detail_spoint
            FROM
            template_details
            WHERE
            template_details.detail_mastercode = '$received_data->templatecode'
            ORDER BY
            template_details.detail_linenum ASC");

            $output = array(
                "msg" => "ดึงข้อมูลสำเร็จ",
                "status" => "Select Data Success",
                "sumrun" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
                "sumrun" => null
            );
        }
        echo json_encode($output);
    }


    public function saveRunscreenEdit()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "saveRunscreenEdit"){
            $arupdateRun = array(
                "detail_min" => $received_data->min,
                "detail_max" => $received_data->max,
                "detail_spoint" => $received_data->spoint
            );
            $this->db->where("detail_autoid" , $received_data->autoid);
            $this->db->update("template_details" , $arupdateRun);

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



        // Other Image
        public function loadOtherImage()
        {
            $received_data = json_decode(file_get_contents("php://input"));
            if($received_data->action == "loadOtherImage"){
                $templatecode = $received_data->templatecode;
    
                // Select Template Other Image
                $sqlgetOtherImage = $this->db->query("SELECT
                template_image.tm_autoid,
                template_image.tm_templatecode,
                template_image.tm_imagename,
                template_image.tm_imagepath,
                template_image.tm_imagetype
                FROM
                template_image
                WHERE tm_templatecode = '$templatecode' AND tm_imagetype = 'Other Image' ORDER BY tm_autoid ASC
                ");
    
                $output = array(
                    "msg" => "ดึงรูปภาพ Other Image สำเร็จ",
                    "status" => "Select Data Success",
                    "otherImage" => $sqlgetOtherImage->result()
                );
            }else{
                $output = array(
                    "msg" => "ดึงรูปภาพ Other Image ไม่สำเร็จ",
                    "status" => "Select Data Not Success",
                    "otherImage" => null
                );
            }
            echo json_encode($output);
        }
    
    
        public function delOtherImage()
        {
            $received_data = json_decode(file_get_contents("php://input"));
            if($received_data->action == "delOtherImage"){
                $autoid = $received_data->data_autoid;
                $filename = $received_data->data_filename;
                $filepath = $received_data->data_filepath;
    
                $path = $_SERVER['DOCUMENT_ROOT']."/intsys/msd_pulverizer/".$filepath.$filename;
                unlink($path);
    
                $this->db->where("tm_autoid" , $autoid);
                $this->db->delete("template_image");
    
                $output = array(
                    "msg" => "ลบรูปภาพ Other Image สำเร็จ",
                    "status" => "Delete Data Success"
                );
            }else{
                $output = array(
                    "msg" => "ลบรูปภาพ Other Image ไม่สำเร็จ",
                    "status" => "Delete Data Not Success"
                );
            }
    
            echo json_encode($output);
        }
    
    
        public function countTemplate()
        {
            $received_data = json_decode(file_get_contents("php://input"));
            if($received_data->action == "countTemplate"){
                $sql = $this->db->query("SELECT
                template_master.master_autoid,
                template_master.master_temcode,
                template_master.master_name,
                template_master.master_itemnumber,
                template_master.master_remark
                FROM
                template_master");
    
                $output = array(
                    "msg" => "ดึงข้อมูล Template Count สำเร็จ",
                    "status" => "Select Data Success",
                    "templateCount" => $sql->num_rows()
                );
            }else{
                $output = array(
                    "msg" => "ดึงข้อมูล Template Count ไม่สำเร็จ",
                    "status" => "Select Data Not Success",
                    "templateCount" => null
                );
            }
            echo json_encode($output);
        }
    
    
        public function loadTemplateMasterList()
        {
            $received_data = json_decode(file_get_contents("php://input"));
            if($received_data->action == "loadTemplateMasterList"){
                $sql = $this->db->query("SELECT
                template_master.master_autoid,
                template_master.master_temcode,
                template_master.master_name,
                template_master.master_itemnumber,
                template_master.master_remark
                FROM
                template_master
                ORDER BY master_autoid ASC
                ");
    
                $output = array(
                    "msg" => "ดึงข้อมูล Master template list สำเร็จ",
                    "status" => "Select Data Success",
                    "result" => $sql->result()
                );
            }else{
                $output = array(
                    "msg" => "ดึงข้อมูล Master template list ไม่สำเร็จ",
                    "status" => "Select Data Not Success",
                    "result" => null
                );
            }
            echo json_encode($output);
        }




    
    

}/* End of file machine_model.php */




?>