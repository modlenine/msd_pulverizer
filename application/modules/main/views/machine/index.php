<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
                <h3 style="text-align:center;">รายการ เทมเพลต ทั้งหมด</h3>
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

                createRunscreenSelectedList_edit(runScreenSelected);
                createRunscreenMainList_edit(runScreenMain);
                // Runscreen select zone
            }).catch(err=>{
                console.error('Error' , err);
            });
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
                <li class="list-group-item list-group-item list-group-item-action runSelectLeftLi_edit"
                    data_run_autoid = "`+runscreenSelectedArray[i].detail_autoid+`"
                    data_run_name = "`+runscreenSelectedArray[i].detail_column_name+`"
                    data_run_min = "`+runscreenSelectedArray[i].detail_min+`"
                    data_run_max = "`+runscreenSelectedArray[i].detail_max+`"
                    data_run_spoint = "`+runscreenSelectedArray[i].detail_spoint+`"
                >
                    <span>`+runscreenSelectedArray[i].detail_column_name+`</span><br>
                    <span><b>Min: </b>`+runscreenSelectedArray[i].detail_min+`</span>
                    <span><b>Max: </b>`+runscreenSelectedArray[i].detail_max+`</span><br>
                    <span><b>SPoint: </b>`+runscreenSelectedArray[i].detail_spoint+`</span><br>
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
                    <span><b>Min: </b>`+runscreenMainArray[i].run_min+`</span>
                    <span><b>Max: </b>`+runscreenMainArray[i].run_max+`</span><br>
                    <span><b>SPoint: </b>`+runscreenMainArray[i].run_spoint+`</span>
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



    }); //End document ready



</script>
</html>