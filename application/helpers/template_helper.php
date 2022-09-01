<?php
class template_fn{
    private $ci;
    function __construct()
    {
        $this->ci =&get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function templatefn()
    {
        return $this->ci;
    }
}


function tempfn()
{
    $obj = new template_fn();
    return $obj->templatefn();
}


function getHead()
{
    return tempfn()->load->view("templates/head");
}
function getFooter()
{
    return tempfn()->load->view("templates/footer");
}
function getContent($page , $data)
{
    return tempfn()->load->view($page , $data);
}
function getModal($modal)
{
    return tempfn()->load->view($modal);
}

// Get Main form no
function getFormNo()
{
    // check formno ซ้ำในระบบ
    $checkRowdata = tempfn()->db->query("SELECT
    m_formno FROM main ORDER BY m_autoid DESC LIMIT 1 
    ");
    $result = $checkRowdata->num_rows();

    $cutYear = substr(date("Y"), 2, 2);
    $getMonth = substr(date("m"), 0, 2);
    $formno = "";
    if ($result == 0) {
        $formno = "MP" . $cutYear . "000001";
    } else {

        $getFormno = $checkRowdata->row()->m_formno;
        $cutGetYear = substr($getFormno, 2, 2); //KB2003001
        $cutNo = substr($getFormno, 4, 6); //อันนี้ตัดเอามาแค่ตัวเลขจาก CRF2003001 ตัดเหลือ 001
        $cutNo++;

        if ($cutNo < 10) {
            $cutNo = "00000" . $cutNo;
        } else if ($cutNo < 100) {
            $cutNo = "0000" . $cutNo;
        }else if($cutNo < 1000){
            $cutNo = "000" . $cutNo;
        }else if($cutNo < 10000){
            $cutNo = "00" . $cutNo;
        }else if($cutNo < 100000){
            $cutNo = "0" . $cutNo;
        }

        if ($cutGetYear != $cutYear) {
            $formno = "MP" . $cutYear ."000001";
        } else {
            $formno = "MP" . $cutGetYear . $cutNo;
        }
    }

    return $formno;
}
// Get Main form no



?>