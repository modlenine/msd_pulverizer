<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Machine extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("machine_model" , "machine");
    }
    

    public function index()
    {
        $data = array(
            "title" => "Machine page"
        );
        getHead();
        getContent("machine/index" , $data);
        getFooter();
    }



    // Runscreen Zone
    public function saveRunscreen()
    {
        $this->machine->saveRunscreen();
    }
    public function checkDuplicateRunscreen()
    {
        $this->machine->checkDuplicateRunscreen();
    }
    public function getAllRunscreen()
    {
        $this->machine->getAllRunscreen();
    }
    public function saveEditRunscreen()
    {
        $this->machine->saveEditRunscreen();
    }
    public function deleteRunscreen()
    {
        $this->machine->deleteRunscreen();
    }
    public function loadMainRunscreen()
    {
        $this->machine->loadMainRunscreen();
    }
    public function loadItemidFormTable()
    {
        $this->machine->loadItemidFormTable();
    }
    public function saveTemplate()
    {
        $this->machine->saveTemplate();
    }

    public function checkFolder()
    {
        // $yearNow = date("Y");
        // $dateNow = date("Y-m-d");
        // $paths = 'uploads\images';

        // if(!file_exists($paths."\\".$yearNow)){
        //     mkdir($paths."\\".$yearNow , 0755 , true);
        // }

        // if(!file_exists($paths."\\".$yearNow."\\".$dateNow)){
        //     mkdir($paths."\\".$yearNow."\\".$dateNow , 0755 , true);
        // }
        $date = date_create();
        echo date_timestamp_get($date);

    }
     // Runscreen Zone




    //  Template Zone
     public function loadTemplateList()
     {
         $this->machine->loadTemplateList();
     }
     public function loaddataToEditModal()
     {
         $this->machine->loaddataToEditModal();
     }
     public function saveEditTemplate()
     {
         $this->machine->saveEditTemplate();
     }
     public function deleteTemplate()
     {
         $this->machine->deleteTemplate();
     }

     public function getTemplateSource()
     {
         $this->machine->getTemplateSource();
     }

     public function loadSelectedRunscreen_copy()
     {
         $this->machine->loadSelectedRunscreen_copy();
     }

     public function loadSumRun()
     {
         $this->machine->loadSumRun();
     }

     public function saveRunscreenEdit()
     {
         $this->machine->saveRunscreenEdit();
     }

    //  Other Image
    public function loadOtherImage()
    {
        $this->machine->loadOtherImage();
    }

    public function delOtherImage()
    {
        $this->machine->delOtherImage();
    }


    public function countTemplate()
    {
        $this->machine->countTemplate();
    }

    public function loadTemplateMasterList()
    {
        $this->machine->loadTemplateMasterList();
    }


}/* End of file Machine.php */


?>