<?php
class getfn
{
    private $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function gci()
    {
        return $this->ci;
    }
}



function gfn()
{
    $obj = new getfn();
    return $obj->gci();
}



function getDb()
{

    if($_SERVER['HTTP_HOST'] == "localhost"){
        $sql = gfn()->db->query("SELECT * FROM db WHERE db_autoid = 2 ");
    }else{
        $sql = gfn()->db->query("SELECT * FROM db WHERE db_autoid = 1 ");
    }
    return $sql->row();
}

function getMaincode($manformno)
{
    $sql = gfn()->db->query("SELECT
    main.m_code
    FROM
    main
    WHERE m_formno = '$manformno'
    ");

    return $sql->row()->m_code;
}

function getMainFormno($m_code)
{
    $sql = gfn()->db->query("SELECT
    main.m_code,
    main.m_formno
    FROM
    main
    WHERE m_code = '$m_code'
    ");

    return $sql->row()->m_formno;
}

function getActivityData($m_code)
{
    $sql = gfn()->db->query("SELECT m_product_number , m_item_number , m_batch_number , m_dataareaid from main where m_code = '$m_code' ");
    return $sql->row();
}


function getRuningCode($groupcode)
{
    $date = date_create();
    $dateTimeStamp = date_timestamp_get($date);
    return $groupcode.$dateTimeStamp;
}


function getviewfulldata($maincode)
{
    if($maincode != ""){
        $sql = gfn()->db->query("SELECT
        main.m_autoid,
        main.m_formno,
        main.m_code,
        main.m_areaid,
        main.m_template_code,
        main.m_template_name,
        main.m_machine,
        main.m_product_number,
        main.m_item_number,
        main.m_batch_number,
        main.m_order,
        main.m_std_output,
        main.m_maxamp,
        main.m_packing,
        main.m_typeofbag,
        main.m_typeofbagtxt,
        main.m_status,
        main.m_memo,
        main.m_dataareaid,
        main.m_user,
        main.m_ecode,
        main.m_deptcode,
        main.m_datetime,
        main.m_graph_testid,
        main.m_graph_testiduse,
        main.m_user_start,
        main.m_ecode_start,
        main.m_datetime_start,
        main.m_datetime_stop,
        main.m_user_stop,
        main.m_ecode_stop,
        main.m_user_modify,
        main.m_ecode_modify,
        main.m_datetime_modify,
        main.m_bladeType,
        main.m_screenMesh,
        main.m_gap
        FROM
        main
        WHERE m_code = '$maincode'
        ");

        return $sql->row();
    }
}

function saveActivity($action,$productionNo="",$batchNo="",$itemNo="",$dataareaid="")
{
    // Update User Activity table
    $arSaveUserActivity = array(
        "u_action" => $action,
        "u_prodnumber" => $productionNo,
        "u_batchnumber" => $batchNo,
        "u_itemnumber" => $itemNo,
        "u_dataareaid" => $dataareaid,
        "u_user" => getUser()->Fname." ".getUser()->Lname,
        "u_ecode" => getUser()->ecode,
        "u_deptcode" => getUser()->DeptCode,
        "u_datetime" => date("Y-m-d H:i:s")
    );
    gfn()->db->insert("user_activity" , $arSaveUserActivity);
}

function getFileForCheck($templateMaster)
{
    $sql = gfn()->db->query("SELECT master_imagestatus FROM template_master WHERE master_temcode = '$templateMaster' ");
    if($sql->num_rows() != 0){
        return $sql->row()->master_imagestatus;
    }else{
        return null;
    }
}


function valueFormat($inputNumber)
{
    $conToDecimal = floatval($inputNumber);
    $stringafterDot = strstr($conToDecimal, ".");
    $decimalNumber = strlen($stringafterDot);

    if($decimalNumber == 0){
        $conNumber = number_format($inputNumber , 0);
    }else{
        $conNumber = number_format($inputNumber , 4);
    }

    if($conNumber == 0){
        return null;
    }else{
        return $conNumber;
    }
    
}


function valueFormat2($inputNumber)
{
    if(substr($inputNumber , -2 , 1) != 0){
        $rsCheckBumber = number_format($inputNumber,4,'.','');
    }else if(substr($inputNumber , -3 , 1) != 0){
        $rsCheckBumber = number_format($inputNumber,2,'.','');
    }else if(substr($inputNumber , -4 , 1) != 0){
        $rsCheckBumber = number_format($inputNumber,1,'.','');
    }else{
        $rsCheckBumber = number_format($inputNumber,0,'.','');
    }


    return $rsCheckBumber;
}


function getRunScreen_exportData($m_code)
{
    $sql = gfn()->db->query("SELECT
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
    details.d_run_memo,
    details.d_linenum
    FROM
    details
    where d_maincode = '$m_code' AND d_action = 'Spoint'
    order by d_linenum asc");

    return $sql;
}

function getMemo($m_code , $d_code)
{
    $sql = gfn()->db->query("SELECT me_memo FROM memo WHERE me_maincode = '$m_code' AND me_detailcode = '$d_code' ");
    return $sql;
}

function getRunScreenTime_exportData($m_code)
{
    $sql = gfn()->db->query("SELECT
    details.d_templatecode,
    details.d_worktime,
    details.d_workdate,
    details.d_action,
    details.d_linenum,
    details.d_linenum_group,
    details.d_detailcode
    FROM
    details
    where d_maincode = '$m_code' and d_action = 'Run'
    group by d_linenum_group");

    return $sql;
}

function getRunScreenValue_export($m_code , $d_code)
{
    $sql = gfn()->db->query("SELECT
    details.d_run_value,
    details.d_linenum,
    details.d_linenum_group,
    details.d_detailcode,
    details.d_maincode
    FROM
    details
    where d_maincode = '$m_code' and d_detailcode = '$d_code'
    order by d_linenum asc");
    return $sql;
}



function getdataForExportMasterList()
{
    $sql = gfn()->db->query("SELECT
            template_master.master_autoid,
            template_master.master_temcode,
            template_master.master_name,
            template_master.master_itemnumber,
            template_master.master_remark
            FROM
            template_master
            ORDER BY master_autoid ASC
            ");

        return $sql;
}


function getCheckMachine($maincodeno)
{
    if($maincodeno != ""){
        $sql = gfn()->db->query("SELECT mck_m_code FROM machine_check WHERE mck_m_code = '$maincodeno' ");
        if($sql->num_rows() != 0){
            return 1 ;
        }else{
            return 0 ;
        }
    }
}



?>