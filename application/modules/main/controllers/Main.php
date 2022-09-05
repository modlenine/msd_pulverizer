<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("main_model" , "main");
    }
    

    public function index()
    {
        $data = array(
            "title" => "Index page"
        );
        getHead();
        getContent("index" , $data);
        getFooter();
    }

    public function loadMainData()
    {
        $this->main->loadMainData();
    }

    public function loadMainDataByDate($date_start , $date_end)
    {
        $this->main->loadMainDataByDate($date_start , $date_end);
    }

    public function searchTemplate()
    {
        $this->main->searchTemplate();
    }

    public function searchTemplateByItemnumber()
    {
        $this->main->searchTemplateByItemnumber();
    }

    public function searchProductNo()
    {
        $this->main->searchProductNo();
    }

    public function searchBag()
    {
        $this->main->searchBag();
    }

    public function saveMaindata()
    {
        $this->main->saveMaindata();
    }

    public function viewfulldata($datamainform)
    {
        $data = array(
            "title" => "หน้าแสดงรายละเอียดของรายการ" . $datamainform,
            "mainformno" => $datamainform
        );
        getHead();
        getContent("viewfulldata" , $data);
        getFooter();
    }
    
    public function loadSpoint()
    {
        $this->main->loadSpoint();
    }



    public function saveSpoint()
    {
        $this->main->saveSpoint();
    }

    public function checkFormStatus()
    {
        $this->main->checkFormStatus();
    }

    public function loadDetailData()
    {
        $this->main->loadDetailData();
    }

    public function saveStart()
    {
        $this->main->saveStart();
    }

    public function saveCancel()
    {
        $this->main->saveCancel();
    }

    public function saveStop()
    {
        $this->main->saveStop();
    }

    public function loadSpointInMainData()
    {
        $this->main->loadSpointInMainData();
    }

    public function loadSpointForEdit()
    {
        $this->main->loadSpointForEdit();
    }

    public function saveRunDetail()
    {
        $this->main->saveRunDetail();
    }

    public function loadRunDetailData()
    {
        $this->main->loadRunDetailData();
    }

    public function loadMemoRunDetail()
    {
        $this->main->loadMemoRunDetail();
    }

    public function loadImageRunDetailForShow()
    {
        $this->main->loadImageRunDetailForShow();
    }

    public function loadImageBeforeStart()
    {
        $this->main->loadImageBeforeStart();
    }

    public function loadRunGroupList()
    {
        $this->main->loadRunGroupList();
    }

    public function loadDataForEdit()
    {
        $this->main->loadDataForEdit();
    }

    public function saveRunDetailEdit()
    {
        $this->main->saveRunDetailEdit();
    }

    public function deleteFileEdit()
    {
        $this->main->deleteFileEdit();
    }

    public function deleteFileSpointEdit()
    {
        $this->main->deleteFileSpointEdit();
    }

    public function deleteRunDetail()
    {
        $this->main->deleteRunDetail();
    }

    public function updateLinenumGroup()
    {
        $this->main->updateLinenumGroup();
    }

    public function testcode()
    {
        $this->load->view("testdate");
    }


    public function loadQcSampling()
    {
        $this->main->loadQcSampling();
    }


    public function loadQcsamplingByLinenum()
    {
        $this->main->loadQcsamplingByLinenum();
    }

    public function saveMemoStop()
    {
        $this->main->saveMemoStop();
    }

    public function saveEditHead()
    {
        $this->main->saveEditHead();
    }

    public function loadCheckMachinePage()
    {
        $this->main->loadCheckMachinePage();
    }

    public function saveMachineCheck()
    {
        $this->main->saveMachineCheck();
    }

    public function loadCheckGroupForEdit()
    {
        $this->main->loadCheckGroupForEdit();
    }

    public function loadCheckMainPageEdit()
    {
        $this->main->loadCheckMainPageEdit();
    }

    public function saveEditMachineCheck()
    {
        $this->main->saveEditMachineCheck();
    }

    public function deleteMachineCheck()
    {
        $this->main->deleteMachineCheck();
    }

    public function getSpeacialData()
    {
        $this->main->getSpeacialData();
    }

}/* End of file Main.php */
?>