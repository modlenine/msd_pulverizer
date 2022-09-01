<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


    <!-- Set Point Zone -->
    <div class="modal fade bs-example-modal-lg" id="templateCount_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">

            <div class="modal-content">
                <div class="modal-header">
                    <div id="templateCountTitle"></div>
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                </div>

                <div class="modal-body">
                    
                <div class="row form-group">
                    <div class="col-md-12">
                        <button id="export_templateMasterList" class="btn btn-info">ส่งออกข้อมูล</button>
                    </div>
                </div>

                <div id="show_templatemasterlistdata"></div>

                </div>
            
            </div>

        </div>
    </div>
    <!-- Set Point Zone -->


<body>
<div id="machine_page">
    <div class="main-container">
		<div class="pd-ltr-20">


			<div class="card-box pd-20 height-100-p mb-30">
            <h3 style="text-align:center;">{{title}}</h3><br>
				<div class="row align-items-center">
                    <div class="col-lg-12 mainTemBtn">
                        <button type="button" class="btn btn-primary btnCreTem"><i class="fi-plus mr-2"></i>สร้าง เทมเพลต</button>
                        <button type="button" class="btn btn-primary btnCreRun"><i class="fi-plus mr-2"></i>จัดการ รันสกรีน</button>
                    </div>
				</div>
			</div>


            <div class="card-box pd-20 height-100-p mb-30">
                <h3 style="text-align:center;">รายการ เทมเพลต ทั้งหมด ( <span id="totalTemCount"></span> )</h3>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <input type="text" name="searchTemplate" id="searchTemplate" placeholder="ค้นหา Template" class="form-control" @keyup="loadTemplateList">
                    </div>
                </div>

                <div id="showTemplateList"></div>
			</div>


		</div>
	</div>
</div>
</body>
<script>
    

    $(document).ready(function(){
        let url = "<?php echo base_url() ?>";
        let runScreenMain = [];
        let runScreenSelected = [];

        // loadMainRunscreen_edit();
        countTemplate();

        $(document).on('click','.btnCreRun',function(){
            $('#manage_runscreen_modal').modal('show');
        });

        $(document).on('click' , '.btnCreTem' , function(){
            $('#create_template_modal').modal('show');
            $('#createTemplateZone').css('display' , 'none');
        });

        $(document).on('click' , '.templateBoxSelect' , function(){
            // For Clear array
            runScreenMain = [];
            runScreenSelected = [];


            const data_autoid = $(this).attr("data_autoid");
            const data_templatename = $(this).attr("data_templatename");
            const data_templatecode = $(this).attr("data_templatecode");

            $('#tempCode_edit').val(data_templatecode);
            $('.sumRun_createTemplate').attr({
                'data_templatecode':data_templatecode,
                'data_templatename':data_templatename
            });

            // // console.log(data_templatecode);
            
            $('#edit_template_modal').modal('show');
            // loaddataToEditModal(data_templatecode);
            loadMainRunscreen_edit(data_templatecode);
            
        });


        $(document).on('click' , '.runSelectLeft_edit' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            const data_run_name = $(this).attr("data_run_name");
            const data_run_min = $(this).attr("data_run_min");
            const data_run_max = $(this).attr("data_run_max");
            const data_run_spoint = $(this).attr("data_run_spoint");

            $('.runDownArrow_edit').css('display' , 'none');
            $('.runUpArrow_edit').css('display' , 'none');

            let resultarray = {
                "run_autoid":data_run_autoid,
                "run_name":data_run_name,
                "run_min":data_run_min,
                "run_max":data_run_max,
                "run_spoint":data_run_spoint
            }
            // runScreenSelected.push(resultarray);
            // console.log(runScreenSelected);
            for(let i = 0; i < runScreenSelected.length; i++){
                runScreenSelected = runScreenSelected.filter(function(value , index , arr){
                    return value.detail_runautoid != data_run_autoid;
                })
            }
            runScreenMain.push(resultarray);
            // console.log(runScreenSelected);
            createRunscreenSelectedList_edit(runScreenSelected);
            createRunscreenMainList_edit(runScreenMain);
            
        });



        $(document).on('click' , '.runRight_edit' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            const data_run_name = $(this).attr("data_run_name");
            const data_run_min = $(this).attr("data_run_min");
            const data_run_max = $(this).attr("data_run_max");
            const data_run_spoint = $(this).attr("data_run_spoint");

            let resultarray = {
                "detail_runautoid":data_run_autoid,
                "detail_column_name":data_run_name,
                "detail_min":data_run_min,
                "detail_max":data_run_max,
                "detail_spoint":data_run_spoint
            }
            runScreenSelected.push(resultarray);
            // console.log(runScreenSelected);
            
            for(let i = 0; i < runScreenSelected.length; i++){
                runScreenMain = runScreenMain.filter(function(value , index , arr){
                    return value.run_autoid != runScreenSelected[i].detail_runautoid;
                });
            }
            console.log(runScreenMain);
            createRunscreenMainList_edit(runScreenMain);
            createRunscreenSelectedList_edit(runScreenSelected);
        });



        $(document).on('click' , '.rSelectedRun_edit' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            runSelected(data_run_autoid);
        });



        $(document).on('click' , '.runDownArrow_edit' , function(){
            const initialIndex = parseInt($(this).attr('data_indexofarray'));
            const finalIndex = initialIndex+1 ;
            const data_run_autoid = $(this).attr('data_run_autoid');

            runScreenSelected = moveElement(runScreenSelected,initialIndex,finalIndex);
            createRunscreenSelectedList_edit(runScreenSelected);
            $('#rSelectedRun_edit_'+data_run_autoid).prop('checked' , true);
            runSelected(data_run_autoid); 
            document.getElementById("rSelectedRun_edit_"+data_run_autoid).scrollIntoView();
        });

        $(document).on('click' , '.runUpArrow_edit' , function(){
            const initialIndex = $(this).attr('data_indexofarray');
            const finalIndex = initialIndex-1 ;
            const data_run_autoid = $(this).attr('data_run_autoid');

            runScreenSelected = moveElement(runScreenSelected,initialIndex,finalIndex);
            createRunscreenSelectedList_edit(runScreenSelected);
            $('#rSelectedRun_edit_'+data_run_autoid).prop('checked' , true);
            runSelected(data_run_autoid);
            document.getElementById("rSelectedRun_edit_"+data_run_autoid).scrollIntoView();
        });



        $(document).on('click' , '#btn-saveRsEdit' ,function(){
            let templatecode = $('#tempCode_edit').val();
            saveRunscreenEdit(templatecode);
        });




        let machine_page = new Vue({
            el:"#machine_page",
            data:{
                title:"หน้าจัดการ เทมเพลต",
            },
            methods: {
                loadTemplateList()
                {
                    axios.post(url+'main/machine/loadTemplateList',{
                        action:"loadTemplateList",
                        searchTemplate:$('#searchTemplate').val()
                    }).then(res=>{
                        // console.log(res.data);
                        if(res.data.status == "Select Data Success"){
                            this.createTemplateBox(res.data.getTemplate);
                        }else{
                            $('#showTemplateList').html(`<h1>ไม่พบข้อมูล</h1>`);
                        }
                    }).catch(err=>{
                        console.error('Error' , err);
                    });
                },

                createTemplateBox(templateData)
                {
                 
                    let output = `
                    <div class="row mt-2">
                    `;
                    for(let i = 0; i < templateData.length; i++){
                        output += `
                        <div class="col-md-4 col-lg-3 col-6 form-group">
                            <div id="mainBox" class="templateBoxSelect"
                                data_autoid = "`+templateData[i].master_autoid+`"
                                data_templatename = "`+templateData[i].master_name+`"
                                data_templatecode = "`+templateData[i].master_temcode+`"
                            >
                                <img id="box_image" src="`+url+templateData[i].master_imagePath+templateData[i].master_image+`">
                                <span class="box_templatename">`+templateData[i].master_name+`</span>
                            </div>
                        </div>
                        `;
                    }

                    output += `
                    </div>
                    `;

                    $('#showTemplateList').html(output);
                },


            },
            created() {
                this.loadTemplateList();
            },
        }); //End vue cdn








        function saveRunscreenEdit(templatecode)
        {

            let checkPoint = 0;
            // Check Min Max Spoint
            if($('#rse_max').val() != "" && $('#rse_min').val() != "" && $('#rse_spoint').val() != ""){
                // Check Min max diff
                if(parseFloat($('#rse_max').val()) < parseFloat($('#rse_min').val())){
                    swal({
                        title: 'ค่า Max ต้องไม่น้อยกว่าค่า Min',
                        type: 'error',
                        showConfirmButton: false,
                        timer:1000
                    });
                    $('#rse_max').removeClass('inputSuccess').addClass('inputNull');
                }else{
                    // Check Spoint
                    if(parseFloat($('#rse_spoint').val()) > parseFloat($('#rse_max').val())){
                        swal({
                            title: 'ค่า Set Point ต้องไม่มากกว่าค่า Max',
                            type: 'error',
                            showConfirmButton: false,
                            timer:1000
                        });
                        $('#rse_spoint').removeClass('inputSuccess').addClass('inputNull');
                    }else if(parseFloat($('#rse_spoint').val()) < parseFloat($('#rse_min').val())){
                        swal({
                            title: 'ค่า Set Point ต้องไม่น้อยกว่าค่า Min',
                            type: 'error',
                            showConfirmButton: false,
                            timer:1000
                        });
                        $('#rse_spoint').removeClass('inputSuccess').addClass('inputNull');
                    }else{
                        checkPoint = 1;
                        $('#rse_spoint , #rse_max , #rse_min').removeClass('inputNull').addClass('inputSuccess');
                    }
                }
                console.log(checkPoint);
            }else{
                checkPoint = 1;
            }


            if(checkPoint == 1){
                axios.post(url+'main/machine/saveRunscreenEdit' , {
                    action:"saveRunscreenEdit",
                    min:$('#rse_min').val(),
                    max:$('#rse_max').val(),
                    spoint:$('#rse_spoint').val(),
                    autoid:$('#res_autoid').val()
                }).then(res => {
                    console.log(res.data);
                    if(res.data.status == "Update Data Success"){
                        runScreenSelected = [];
                        swal({
                            title: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer:1000
                        }).then(function(){
                            $('#editRunSelected_modal').modal('hide');
                            loaddataToEditModal(templatecode);
                        });
                        
                    }
                });
            }


            
        }





        function loaddataToEditModal(templateCode)
        {
            axios.post(url+'main/machine/loaddataToEditModal',{
                action:'loaddataToEditModal',
                templateCode:templateCode
            }).then(res=>{
                console.log(res.data);
                $('#templateName_edit').val(res.data.master_name);
                $('#itemNumber_edit').val(res.data.master_itemnumber);
                $('#stdoutput_edit').val(res.data.master_stdoutput);
                $('#maxamp_edit').val(res.data.master_maxamp);
                $('#showImageTemplate_edit').attr('src' , url+res.data.master_imagePath+res.data.master_image);

                $('#imageFile_edit').val(res.data.master_image);
                $('#imagePath_edit').val(res.data.master_imagePath);
                $('#packing_edit').val(res.data.master_packing);

                $('#t_remarkEdit').val(res.data.master_remark);
                
                let resultRunscreenDetail = res.data.allDetail;
                for(let i = 0; i < resultRunscreenDetail.length; i++){
                    runScreenSelected.push(resultRunscreenDetail[i]);
                }

                
                for(let i = 0; i < runScreenSelected.length;i++ ){
                    // เตรียมข้อมูลก่อน Build
                    runScreenMain = runScreenMain.filter(function(value , index , arr){
                        return value.run_autoid != runScreenSelected[i].detail_runautoid
                    });
                }

                // console.log(runScreenMain);
                loadOtherImage(templateCode);

                createRunscreenSelectedList_edit(runScreenSelected);
                createRunscreenMainList_edit(runScreenMain);
                // Runscreen select zone
            }).catch(err=>{
                console.error('Error' , err);
            });
        }

        function loadOtherImage(templatecode)
        {
            if(templatecode != ""){
                axios.post(url+'main/machine/loadOtherImage' , {
                    action:"loadOtherImage",
                    templatecode:templatecode
                }).then(res=>{
                    console.log(res.data);
                    if(res.data.status == "Select Data Success"){
                        // Show Other Image
                        let outputOtherImage ='';
                        let resultOtherImage = res.data.otherImage;
                        outputOtherImage +=`<div class="row form-group">`;
                            for(let i = 0; i < resultOtherImage.length; i++){
                                outputOtherImage +=`
                                <div class="col-md-4 col-lg-3 col-6 mt-2 divOtherImage">
                                <a href="`+url+resultOtherImage[i].tm_imagepath+resultOtherImage[i].tm_imagename+`" data-toggle="lightbox">
                                    <img class="runImageView" src="`+url+resultOtherImage[i].tm_imagepath+resultOtherImage[i].tm_imagename+`">
                                </a>
                                <i aria-hidden="true" class="fa fa-trash mr-2 delOtherImage"
                                    data_autoid="`+resultOtherImage[i].tm_autoid+`"
                                    data_filename="`+resultOtherImage[i].tm_imagename+`"
                                    data_filepath="`+resultOtherImage[i].tm_imagepath+`"
                                    data_templatecode="`+templatecode+`"
                                ></i>
                                </div>`;
                            }
                        outputOtherImage += `</div>`;
                        $('#show_otherimage').html(outputOtherImage);
                        // Show Other Image
                    }
                });
            }

        }


        $(document).on('click' , '.delOtherImage' , function(){
            const data_autoid = $(this).attr("data_autoid");
            const data_filename = $(this).attr("data_filename");
            const data_filepath = $(this).attr("data_filepath");
            const data_templatecode = $(this).attr("data_templatecode");
            if(data_autoid != ""){
                swal({
                    title: 'ต้องการลบรูปนี้ ใช่หรือไม่',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText:'ยกเลิก'
                }).then((result)=> {
                    if(result.value == true){
                        delOtherImage(data_autoid , data_filename , data_filepath , data_templatecode);
                    }
                });
            }
        });


        function delOtherImage(data_autoid , data_filename , data_filepath , data_templatecode)
        {
            if(data_autoid != ""){
                axios.post(url+'main/machine/delOtherImage' , {
                    action:"delOtherImage",
                    data_autoid:data_autoid,
                    data_filename:data_filename,
                    data_filepath:data_filepath
                }).then(res=>{
                    console.log(res.data);
                    if(res.data.status == "Delete Data Success"){
                        swal({
                            title: 'ลบรูปภาพสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer:800
                        }).then(function(){
                            loadOtherImage(data_templatecode);
                        });
                    }
                });
            }
        }


        function loadMainRunscreen_edit(data_templatecode)
        {
            axios.post(url+'main/machine/loadMainRunscreen',{
                action:'loadMainRunscreen'
            }).then(res => {
                // console.log(res.data);
                let resultRunscreen = res.data.outputArray;
                for(let i = 0; i < resultRunscreen.length; i++){
                    runScreenMain.push(resultRunscreen[i]);
                }
                console.log(runScreenMain);
                loaddataToEditModal(data_templatecode);
            }).catch(err => {
                console.error('Err',err);
            });
        }


        function createRunscreenSelectedList_edit(runscreenSelectedArray)
        {
            if(runscreenSelectedArray.length < 1){
                $('#btn-saveEditTemplate').prop('disabled' , true);
            }else{
                $('#btn-saveEditTemplate').prop('disabled' , false);
            }
            let outputHtml = `<ul class="list-group">`;
            for(let i = 0; i < runscreenSelectedArray.length; i++){
                outputHtml += `
                <li class="list-group-item list-group-item list-group-item-action runSelectLeftLi_edit">
                    <span>`+runscreenSelectedArray[i].detail_column_name+`</span><br>
                    <span><b>Min: </b>`+parseFloat(runscreenSelectedArray[i].detail_min)+`</span>
                    <span><b>Max: </b>`+parseFloat(runscreenSelectedArray[i].detail_max)+`</span><br>
                    <span><b>S/POINT: </b>`+parseFloat(runscreenSelectedArray[i].detail_spoint)+`</span><br>
                    <input hidden type="text" id="select_run_name_edit" name="select_run_name_edit[]" value="`+runscreenSelectedArray[i].detail_column_name+`">
                    <input hidden type="text" id="select_run_min_edit" name="select_run_min_edit[]" value="`+runscreenSelectedArray[i].detail_min+`">
                    <input hidden type="text" id="select_run_max_edit" name="select_run_max_edit[]" value="`+runscreenSelectedArray[i].detail_max+`">
                    <input hidden type="text" id="select_run_spoint_edit" name="select_run_spoint_edit[]" value="`+runscreenSelectedArray[i].detail_spoint+`">
                    <input hidden type="text" id="select_run_autoid_edit" name="select_run_autoid_edit[]" value="`+runscreenSelectedArray[i].detail_runautoid+`">
                    <i class="fa fa-chevron-circle-left runSelectLeft_edit" aria-hidden="true"
                        data_run_autoid = "`+runscreenSelectedArray[i].detail_runautoid+`"
                        data_run_name = "`+runscreenSelectedArray[i].detail_column_name+`"
                        data_run_min = "`+runscreenSelectedArray[i].detail_min+`"
                        data_run_max = "`+runscreenSelectedArray[i].detail_max+`"
                        data_run_spoint = "`+runscreenSelectedArray[i].detail_spoint+`"
                    ></i>
                    <i class="fa fa-pencil-square runItem_edit" aria-hidden="true"
                        data_run_autoid = "`+runscreenSelectedArray[i].detail_autoid+`"
                        data_run_name = "`+runscreenSelectedArray[i].detail_column_name+`"
                        data_run_min = "`+runscreenSelectedArray[i].detail_min+`"
                        data_run_max = "`+runscreenSelectedArray[i].detail_max+`"
                        data_run_spoint = "`+runscreenSelectedArray[i].detail_spoint+`"
                    ></i>
                    <input type="radio" id="rSelectedRun_edit_`+runscreenSelectedArray[i].detail_runautoid+`" name="rSelectedRun_edit" class="rSelectedRun_edit"
                        data_run_autoid = '`+runscreenSelectedArray[i].detail_runautoid+`'
                    >
                </li>
                `;
            }
            outputHtml += `</ul>`;
            $('#showRunscreenSelected_edit').html(outputHtml);
            $('#totalRunSelectedCount_edit').html(runscreenSelectedArray.length);
            console.log(runscreenSelectedArray);
        }

        function createRunscreenMainList_edit(runscreenMainArray)
        {
            let outputHtml = `<ul class="list-group">`;
            for(let i = 0; i < runscreenMainArray.length; i++){
                outputHtml += `
                <li class="list-group-item list-group-item list-group-item-action runRightLi_edit">
                    <span>`+runscreenMainArray[i].run_name+`</span><br>
                    <span><b>Min: </b>`+parseFloat(runscreenMainArray[i].run_min)+`</span>
                    <span><b>Max: </b>`+parseFloat(runscreenMainArray[i].run_max)+`</span><br>
                    <span><b>S/POINT: </b>`+parseFloat(runscreenMainArray[i].run_spoint)+`</span>
                    <i class="fa fa-chevron-circle-right runRight_edit" aria-hidden="true"
                        data_run_autoid = "`+runscreenMainArray[i].run_autoid+`"
                        data_run_name = "`+runscreenMainArray[i].run_name+`"
                        data_run_min = "`+runscreenMainArray[i].run_min+`"
                        data_run_max = "`+runscreenMainArray[i].run_max+`"
                        data_run_spoint = "`+runscreenMainArray[i].run_spoint+`"
                    ></i>
                </li>
                `;
            }
            outputHtml += `</ul>`;
            $('#showRunscreenMain_edit').html(outputHtml);
            $('#totalRunMainCount_edit').html(runscreenMainArray.length);
        }

        function runSelected(data_run_autoid)
        {
            // console.log(data_run_autoid);
            let runAutoidArray = [];
            for(let i = 0; i < runScreenSelected.length; i++){
                runAutoidArray.push(runScreenSelected[i].detail_runautoid);
            }
            console.log(runAutoidArray);
            let index = runAutoidArray.indexOf(data_run_autoid);
            console.log(index);

            // control arrow fix min and max
            let min = 0;
            let max = runScreenSelected.length-1;

            if(index == min){
                $('.runDownArrow_edit').css('display' , '');
            }else if(index > min && index != max){
                $('.runDownArrow_edit').css('display' , '');
            }else if(index == max){
                $('.runDownArrow_edit').css('display' , 'none');
            }

            if(index == max){
                $('.runUpArrow_edit').css('display' , '');
            }else if(index < max && index != min){
                $('.runUpArrow_edit').css('display' , '');
            }else if(index == min){
                $('.runUpArrow_edit').css('display' , 'none');
            }

            if(min == 0 && max == 0){
                $('.runUpArrow_edit').css('display' , 'none');
                $('.runDownArrow_edit').css('display' , 'none');
            }

            // ส่งข้อมูลไปเก็บไว้ที่ Attr ของลูกศร
            $('.runDownArrow_edit , .runUpArrow_edit').attr({
                'data_indexofarray':index,
                'data_run_autoid':data_run_autoid
            });


            console.log('Min:'+min+' Max:'+max);
            console.log(data_run_autoid);
            // runAutoidArray = [];
            // index = null;
        }


        function moveElement(array,initialIndex,finalIndex) 
        {
            array.splice(finalIndex,0,array.splice(initialIndex,1)[0])
            console.log(array);
            return array;
        }


        function countTemplate()
        {
            axios.post(url+'main/machine/countTemplate' , {
                action:"countTemplate"
            }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Select Data Success"){
                    let temcountHtml = `<a href="javascript:void(0)" class="clickTemCount">`+res.data.templateCount+` รายการ </a>`;
                    $('#totalTemCount').html(temcountHtml);
                }
            });
        }
        

        $(document).on('click','.clickTemCount' , function(){
            $('#templateCount_modal').modal('show');
            let tctitle = `<h3>รายการ Template ทั้งหมด</h3>`;
            $('#templateCountTitle').html(tctitle);
            masterTemplateList();
            
        });


        function masterTemplateList()
		{
            axios.post(url+'main/machine/loadTemplateMasterList' , {
                action:"loadTemplateMasterList"
            }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Select Data Success"){
                    let result = res.data.result;
                    let html = `
                    <div class="table-responsive">
                    <table id="tbl_template_masterlist_result" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="runname">#</th>
                                <th class="runmin">Template Name</th>
                                <th class="runmax">Item Number</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;
                    for(let i = 0; i < result.length; i++){
                        html +=`
                        <tr>
                            <td></td>
                            <td>`+result[i].master_name+`</td>
                            <td>`+result[i].master_itemnumber+`</td>
                        </tr>
                        `;
                    }
                        html += `
                        </tbody>
                    </table>
                    </div>
                        `;

                        $('#show_templatemasterlistdata').html(html);

                        let thid = 1;
                        $('#tbl_template_masterlist_result thead th').each(function() {
                            var title = $(this).text();
                            $(this).html(title + '<input type="text"  class="col-search-input" placeholder="Search ' + title + '" />');
                            thid++;
                        });
                            
                        var table = $('#tbl_template_masterlist_result').DataTable({
                            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                                $('td:eq(0)', nRow).html(iDisplayIndexFull +1);
                            },
                            stateLoadParams: function(settings, data) {
                                for (i = 0; i < data.columns["length"]; i++) {
                                    let col_search_val = data.columns[i].search.search;
                                    if (col_search_val !== "") {
                                        $("input", $("#tbl_template_masterlist_result thead th")[i]).val(col_search_val);
                                    }
                                }
                            },
                            
                            // order: [
                            //     [0, 'desc']
                            // ],
                            columnDefs: [{
                                    targets:'_all',
                                    orderable: false
                                },
                                // {"width": "80","targets": 0},
                                // {"width": "200","targets": 1},
                                // {"width": "100","targets": 2},
                            ],
                            
                        });


                        table.columns().every(function() {
                            var table = this;
                            $('input', this.header()).on('keyup change', function() {
                                if (table.search() !== this.value) {
                                    table.search(this.value).draw();
                                }
                            });
                        });
                }
            });      
		}




        $(document).on('click' , '#export_templateMasterList' , function(){
            location.href = url+'main/exportdata/exportdata_templateList';
        });




    }); //End document ready



</script>
</html>