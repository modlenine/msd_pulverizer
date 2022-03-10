<?php
class login_fn{
    private $ci;
    function __construct()
    {
        $this->ci =&get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function logci()
    {
        return $this->ci;
    }
}


function lfn()
{
    $obj = new login_fn();
    return $obj->logci();
}


function getUser()
{
    lfn()->load->model("login/login_model" , "login");
    return lfn()->login->getuser();
}
function callLogin()
{
    lfn()->load->model("login/login_model" , "login");
    return lfn()->login->callLogin();
}
function getUserImage()
{
    $url = "https://intranet.saleecolour.com/intsys/usermanagement/uploads/";

    if(getUser()->file_img == "" || getUser()->file_img == null){
        $imageUser = "default.jpg";
    }else{
        $imageUser = getUser()->file_img;
    }

    return $url.$imageUser;
}



?>