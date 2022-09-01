<div id="create_template">

    <div class="modal fade bs-example-modal-lg" id="create_template_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable createTempMdSize">

        <form id="frm_saveTemplate" @submit.prevent="saveTemplate" autocomplete="off" class="needs-validation" novalidate style="width:100%">
        
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{title}}</h4>
                    <button type="button" class="close close_createTemplate" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12 form-inline">
                            <div class="custom-control custom-radio mb-5 ml-3">
                                <input type="radio" id="choiceTemplate_new" name="choiceTemplates" class="custom-control-input" value="new">
                                <label class="custom-control-label" for="choiceTemplate_new">สร้างใหม่</label>
                            </div>
                        
                            <div class="custom-control custom-radio mb-5 ml-3">
                                <input type="radio" id="choiceTemplate_copy" name="choiceTemplates" class="custom-control-input" value="copy">
                                <label class="custom-control-label" for="choiceTemplate_copy">คัดลอก</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                          <button type="submit" id="btn-saveNewTemplate" class="btn btn-success"><i class="fi-save mr-2"></i>บันทึก</button>
                          <!-- <button type="button" id="btn-calcelNewTemplate" class="btn btn-danger close_createTemplate" data-dismiss="modal"><i class="fi-x mr-2"></i>ปิด</button> -->
                      </div>
                    </div>
                </div>

                <!-- <div id="btn_saveNewTemplate" class="modal-header">
                    <div class="row">
                      <div class="col-lg-12">
                          <button type="button" id="btn-saveNewTemplate" class="btn btn-success">บันทึก</button>
                          <button type="button" id="btn-calcelNewTemplate" class="btn btn-danger close_createTemplate" @click="close_createTemplate">ปิด</button>
                      </div>
                    </div>
                </div> -->

                <div id="createTemplateZone" class="modal-body" style="display:none;">

                    <!-- For new template -->
                    <div class="row">
                        <div class="col-md-4">
                            <div id="templateImageArea">
                                <img id="showImageTemplate" src="<?=base_url('uploads/noimage2.jpg')?>" alt="">
                            </div>  
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 form-group cTemplateSource" style="display:none;">
                                    <label for=""><b>Template Source Name</b></label>
                                    <input type="text" name="templateSourceName" id="templateSourceName" class="form-control">
                                    <div id="showTemplateSource"></div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Template Name</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="templateName" id="templateName" class="form-control" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Item Number</b></label>
                                    <input type="text" name="itemNumber" id="itemNumber" class="form-control">
                                    <div id="showItemidList"></div>
                                </div>
                                <!-- <div class="col-md-12 form-group">
                                    <label for=""><b>STD Output (kg./hr)</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="stdoutput" id="stdoutput" class="form-control" required>
                                </div> -->
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Max Amp</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="maxamp" id="maxamp" class="form-control" required>
                                </div>
                                <!-- <div class="col-md-12 form-group">
                                    <label for=""><b>Packing (kg./bag)</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="packing" id="packing" class="form-control" required>
                                </div> -->
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Upload Template Picture</b></label>
                                    <input type="file" name="templatePicture" id="templatePicture" class="form-control" onchange="loadimageTemplate(event)">
                                    <input hidden type="text" name="templatePicture_o" id="templatePicture_o">
                                    <input hidden type="text" name="templatePicturePath_o" id="templatePicturePath_o">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="dropdown-divider"></div>

                        <div class="row">
                        <div class="col-md-12">
                            <label for=""><b>อัพโหลดรูปภาพอื่นๆ</b></label>
                            <input id="t_otherImage" name="t_otherImage[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/*">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for=""><b>หมายเหตุ</b></label>
                            <textarea name="t_remark" id="t_remark" cols="30" rows="10" class="form-control" style="height:100px;"></textarea>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="searchRunscreenMain" id="searchRunscreenMain" class="form-control" placeholder="Search Run Screen Master">
                            <div class="mt-2">
                                <span><b>Total : <span id="totalRunMainCount"></span> รายการ</b></span>
                            </div>
                            <div id="showRunscreenMain" class="mt-2"></div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="searchRunscreenSelected" id="searchRunscreenSelected" class="form-control" placeholder="Search Run Screen Selected">
                            <div class="mt-2">
                                <span><b>Total : <span id="totalRunSelectedCount"></span> รายการ</b></span>
                                <div class="iconUpAndDown">
                                    <i id="runUp" class="fa fa-chevron-circle-up runUpArrow" aria-hidden="true" style="display:none;"></i>&nbsp;&nbsp;
                                    <i id="runDown" class="fa fa-chevron-circle-down runDownArrow" aria-hidden="true" style="display:none;"></i>
                                </div>
                            </div>
                            <div id="showRunscreenSelected" class="mt-2"></div>
                        </div>
                    </div>
                    
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                </div> -->
                
            </div>

            </form>
        

        </div>
    </div>

</div>

<script>

    $(document).ready(function(){
        let url = "<?php echo base_url(); ?>";
        let runScreenMain = [];
        let runScreenSelected = [];

        $(document).on('click' , '.run_spoint' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            console.log(data_run_autoid);
        });


        $(document).on('change' , 'input[type=radio][name=choiceTemplates]' , function(){
            // console.log($(this).val());
            $('#createTemplateZone').css('display' , '');
            if($(this).val() == "new"){
                runScreenSelected = [];
                createRunscreenSelectedList(runScreenSelected);
                $('#showImageTemplate').attr('src' , url+'uploads/noimage2.jpg');
                $('#frm_saveTemplate input[type=text]').val('');
                $('.cTemplateSource').css('display' , 'none');
            }else if($(this).val() == "copy"){
                runScreenSelected = [];
                createRunscreenSelectedList(runScreenSelected);
                $('#showImageTemplate').attr('src' , url+'uploads/noimage2.jpg');
                $('#frm_saveTemplate input[type=text]').val('');
                $('.cTemplateSource').css('display' , '');
            }
            loadMainRunscreen();
        });


        $(document).on('keyup' , '#templateSourceName' , function(){
            if($(this).val() != ""){
                getTemplateSource();
            }else{
                $('#showTemplateSource').html('');
            }
        });

        $(document).on('click','.temSourceLi' , function(){
            const data_master_temcode = $(this).attr("data_master_temcode");
            const data_master_name = $(this).attr("data_master_name");
            const data_master_itemnumber = $(this).attr("data_master_itemnumber");
            const data_master_stdoutput = $(this).attr("data_master_stdoutput");
            const data_master_maxamp = $(this).attr("data_master_maxamp");
            const data_master_image = $(this).attr("data_master_image");
            const data_master_imagePath = $(this).attr("data_master_imagePath");
            const data_master_imagestatus = $(this).attr("data_master_imagestatus");
            const data_master_packing = $(this).attr("data_master_packing");

            $('#templateSourceName').val(data_master_name);
            $('#itemNumber').val(data_master_itemnumber);
            $('#stdoutput').val(data_master_stdoutput);
            $('#maxamp').val(data_master_maxamp);
            $('#packing').val(data_master_packing);
      
            $('#templatePicture_o').val(data_master_image);
            $('#templatePicturePath_o').val(data_master_imagePath);

            $('#showImageTemplate').attr('src' , url+data_master_imagePath+data_master_image);

            $('#showTemplateSource').html('');
            loadSelectedRunscreen_copy(data_master_temcode);
            
        });

        $(document).on('click' , '.close_createTemplate' , function(){
            $('#frm_saveTemplate input[type=text]').val('');
            $('#frm_saveTemplate input[type=radio]').prop('checked' , false);
            $('.cTemplateSource').css('display','none');
            $('#showTemplateSource , #showItemidList').html('');

            runScreenMain = [];
            runScreenSelected = [];

            console.log(runScreenSelected);
            createRunscreenMainList(runScreenMain);
            createRunscreenSelectedList(runScreenSelected);
        });


        $(document).on('click' , '.runRight' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            const data_run_name = $(this).attr("data_run_name");
            const data_run_min = $(this).attr("data_run_min");
            const data_run_max = $(this).attr("data_run_max");
            const data_run_spoint = $(this).attr("data_run_spoint");

            let resultarray = {
                "run_autoid":data_run_autoid,
                "run_name":data_run_name,
                "run_min":data_run_min,
                "run_max":data_run_max,
                "run_spoint":data_run_spoint
            }
            runScreenSelected.push(resultarray);
            // console.log(runScreenSelected);
            
            for(let i = 0; i < runScreenSelected.length; i++){
                runScreenMain = runScreenMain.filter(function(value , index , arr){
                    return value.run_autoid != runScreenSelected[i].run_autoid;
                });
            }
            // console.log(runScreenMain);
            createRunscreenMainList(runScreenMain);
            createRunscreenSelectedList(runScreenSelected);
        });



        $(document).on('click' , '.runSelectLeft' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            const data_run_name = $(this).attr("data_run_name");
            const data_run_min = $(this).attr("data_run_min");
            const data_run_max = $(this).attr("data_run_max");
            const data_run_spoint = $(this).attr("data_run_spoint");

            $('.runDownArrow').css('display' , 'none');
            $('.runUpArrow').css('display' , 'none');

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
                    return value.run_autoid != data_run_autoid;
                })
            }
            runScreenMain.push(resultarray);
            // console.log(runScreenSelected);
            createRunscreenSelectedList(runScreenSelected);
            createRunscreenMainList(runScreenMain);
            
        });


        $(document).on('click' , '.rSelectedRun' , function(){
            const data_run_autoid = $(this).attr("data_run_autoid");
            runSelected(data_run_autoid);
        });



        $(document).on('click' , '.runDownArrow' , function(){
            const initialIndex = parseInt($(this).attr('data_indexofarray'));
            const finalIndex = initialIndex+1 ;
            const data_run_autoid = $(this).attr('data_run_autoid');

            runScreenSelected = moveElement(runScreenSelected,initialIndex,finalIndex);
            createRunscreenSelectedList(runScreenSelected);
            $('#rSelectedRun_'+data_run_autoid).prop('checked' , true);
            runSelected(data_run_autoid); 
            document.getElementById("rSelectedRun_"+data_run_autoid).scrollIntoView();
        });

        $(document).on('click' , '.runUpArrow' , function(){
            const initialIndex = $(this).attr('data_indexofarray');
            const finalIndex = initialIndex-1 ;
            const data_run_autoid = $(this).attr('data_run_autoid');

            runScreenSelected = moveElement(runScreenSelected,initialIndex,finalIndex);
            createRunscreenSelectedList(runScreenSelected);
            $('#rSelectedRun_'+data_run_autoid).prop('checked' , true);
            runSelected(data_run_autoid);
            document.getElementById("rSelectedRun_"+data_run_autoid).scrollIntoView();
        });


        $(document).on('keyup' , '#itemNumber' , function(){
            if($(this).val() != ""){
                loadItemidFormTable();
            }else{
                $('#showItemidList').html('');
            }
        });


        $(document).on('click','.itemidA' , function(){
            const itemid = $(this).attr("data_itemid");
            $('#itemNumber').val(itemid);
            $('#showItemidList').html('');
        });

        $(document).on('keyup' , '#searchRunscreenMain' , function(){
            const value = $(this).val().toLowerCase(); 
            $('.runRightLi').filter(function(){ 
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1) 
            });
        });

        $(document).on('keyup' , '#searchRunscreenSelected' , function(){
            const value = $(this).val().toLowerCase(); 
            $('.runSelectLeftLi').filter(function(){ 
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1) 
            });
        });
        




        let create_template = new Vue({
            el:'#create_template',
            data:{
                title:'หน้า สร้างเทมเพลต',
                addnewTemp:null,
                runscreenMain:'',
                totalMain:0,
                templateSource:''
            },
            methods: {

                saveTemplate()
                {
                    // Check Template name Input
                    if(runScreenSelected.length == 0){
                        swal({
                            title: 'กรุณาเลือก Runscreen',
                            type: 'error',
                            showConfirmButton: false,
                            timer:800
                        });
                    }else if($('#templateName').val() == ""){
                        swal({
                            title: 'กรุณาระบุชื่อเทมเพลต',
                            type: 'error',
                            showConfirmButton: false,
                            timer:800
                        });
                    }else if($('#maxamp').val() == ""){
                        swal({
                            title: 'กรุณาระบุ Max Amp',
                            type: 'error',
                            showConfirmButton: false,
                            timer:800
                        });
                    }else{
                        $('#btn-saveNewTemplate').prop('disabled' , true);
                        $('#create_template_modal').modal('hide');
                        $('.loader').fadeIn(100); 

                        const form = $('#frm_saveTemplate')[0];
                        const data = new FormData(form);

                        axios.post(url+'main/machine/saveTemplate',data ,{
                            header:{
                                'Content-Type' : 'multipart/form-data'
                            },
                        }).then(res=>{
                            console.log(res);
                            if(res.data.status == "Insert Data Success"){
                                swal({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer:800
                                }).then(function(){
                                    location.reload();
                                });
                            }else{
                                $('#btn-saveNewTemplate').prop('disabled' , false);
                                $('#create_template_modal').modal('show');
                                $('.loader').fadeOut(100);
                            }
                        }).catch(err=>{
                            console.error('Err' , err);
                        });
                    }




               
                },
                
            },
            mounted() {
                
            },

        });

        function createRunscreenMainList(runscreenMainArray)
        {
            let outputHtml = `<ul class="list-group">`;
            for(let i = 0; i < runscreenMainArray.length; i++){
                outputHtml += `
                <li class="list-group-item list-group-item list-group-item-action runRightLi">
                    <span>`+runscreenMainArray[i].run_name+`</span><br>
                    <span><b>Min: </b>`+parseFloat(runscreenMainArray[i].run_min)+`</span>
                    <span><b>Max: </b>`+parseFloat(runscreenMainArray[i].run_max)+`</span><br>
                    <span><b>S/POINT: </b>`+parseFloat(runscreenMainArray[i].run_spoint)+`</span>
                    <i class="fa fa-chevron-circle-right runRight" aria-hidden="true"
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
            $('#showRunscreenMain').html(outputHtml);
            $('#totalRunMainCount').html(runscreenMainArray.length);
        }

        function createRunscreenSelectedList(runscreenSelectedArray)
        {
            let outputHtml = `<ul class="list-group">`;
            for(let i = 0; i < runscreenSelectedArray.length; i++){
                outputHtml += `
                <li class="list-group-item list-group-item list-group-item-action runSelectLeftLi">
                    <span>`+runscreenSelectedArray[i].run_name+`</span><br>
                    <span><b>Min: </b>`+parseFloat(runscreenSelectedArray[i].run_min)+`</span>
                    <span><b>Max: </b>`+parseFloat(runscreenSelectedArray[i].run_max)+`</span><br>
                    <span><b>S/POINT: </b>`+parseFloat(runscreenSelectedArray[i].run_spoint)+`</span><br>
                    <input hidden type="text" id="select_run_name" name="select_run_name[]" value="`+runscreenSelectedArray[i].run_name+`">
                    <input hidden type="text" id="select_run_min" name="select_run_min[]" value="`+runscreenSelectedArray[i].run_min+`">
                    <input hidden type="text" id="select_run_max" name="select_run_max[]" value="`+runscreenSelectedArray[i].run_max+`">
                    <input hidden type="text" id="select_run_spoint" name="select_run_spoint[]" value="`+runscreenSelectedArray[i].run_spoint+`">
                    <input hidden type="text" id="select_run_autoid" name="select_run_autoid[]" value="`+runscreenSelectedArray[i].run_autoid+`">
                    <i class="fa fa-chevron-circle-left runSelectLeft" aria-hidden="true"
                        data_run_autoid = "`+runscreenSelectedArray[i].run_autoid+`"
                        data_run_name = "`+runscreenSelectedArray[i].run_name+`"
                        data_run_min = "`+runscreenSelectedArray[i].run_min+`"
                        data_run_max = "`+runscreenSelectedArray[i].run_max+`"
                        data_run_spoint = "`+runscreenSelectedArray[i].run_spoint+`"
                    ></i>
                    <input type="radio" id="rSelectedRun_`+runscreenSelectedArray[i].run_autoid+`" name="rSelectedRun" class="rSelectedRun"
                        data_run_autoid = '`+runscreenSelectedArray[i].run_autoid+`'
                    >
                </li>
                `;
            }
            outputHtml += `</ul>`;
            $('#showRunscreenSelected').html(outputHtml);
            $('#totalRunSelectedCount').html(runscreenSelectedArray.length);
            console.log(runscreenSelectedArray);
        }


        function moveElement(array,initialIndex,finalIndex) 
        {
            array.splice(finalIndex,0,array.splice(initialIndex,1)[0])
            console.log(array);
            return array;
        }

        function runSelected(data_run_autoid)
        {
            // console.log(data_run_autoid);
            let runAutoidArray = [];
            for(let i = 0; i < runScreenSelected.length; i++){
                runAutoidArray.push(runScreenSelected[i].run_autoid);
            }
            console.log(runAutoidArray);
            let index = runAutoidArray.indexOf(data_run_autoid);
            console.log(index);

            // control arrow fix min and max
            let min = 0;
            let max = runScreenSelected.length-1;

            if(index == min){
                $('.runDownArrow').css('display' , '');
            }else if(index > min && index != max){
                $('.runDownArrow').css('display' , '');
            }else if(index == max){
                $('.runDownArrow').css('display' , 'none');
            }

            if(index == max){
                $('.runUpArrow').css('display' , '');
            }else if(index < max && index != min){
                $('.runUpArrow').css('display' , '');
            }else if(index == min){
                $('.runUpArrow').css('display' , 'none');
            }

            if(min == 0 && max == 0){
                $('.runUpArrow').css('display' , 'none');
                $('.runDownArrow').css('display' , 'none');
            }

            // ส่งข้อมูลไปเก็บไว้ที่ Attr ของลูกศร
            $('.runDownArrow , .runUpArrow').attr({
                'data_indexofarray':index,
                'data_run_autoid':data_run_autoid
            });


            console.log('Min:'+min+' Max:'+max);
            console.log(data_run_autoid);
            // runAutoidArray = [];
            // index = null;
        }


        function loadItemidFormTable()
        {
            axios.post(url+'main/machine/loadItemidFormTable' , {
                action:'loadItemidFormTable',
                itemNumber:$('#itemNumber').val()
            }).then(res=>{
                console.log(res.data.status);
                $('#showItemidList').html(res.data.outputHtml);
            }).catch(err=>{
                console.error('Error' , err);
            });
        }


        function loadMainRunscreen()
        {
            axios.post(url+'main/machine/loadMainRunscreen',{
                action:'loadMainRunscreen'
            }).then(res=>{
                // console.log(res.data);
                // $('#showRunscreenMain').html(res.data.outputHtml);
                runScreenMain = res.data.outputArray;
                createRunscreenMainList(runScreenMain);
                console.log(runScreenMain);
            }).catch(err=>{
                console.error('Error' , err);
            });
        }

        function loadSelectedRunscreen_copy(master_temcode)
        {
            axios.post(url+'main/machine/loadSelectedRunscreen_copy',{
                action:"loadSelectedRunscreen_copy",
                master_temcode:master_temcode
            }).then(res => {
                // console.log(res.data);
                runScreenSelected = res.data.resultSelectData;
                
                for(let i = 0; i < runScreenSelected.length; i++){
                    runScreenMain = runScreenMain.filter(function(value , index , arr){
                        return value.run_autoid != runScreenSelected[i].run_autoid;
                    });
                }
                console.log(runScreenSelected);
                console.log(runScreenMain);

                createRunscreenSelectedList(runScreenSelected);
                createRunscreenMainList(runScreenMain);
                
            })
        }


        function getTemplateSource()
        {
            axios.post(url+'main/machine/getTemplateSource' , {
                action:"getTemplateSource",
                tempSource:$('#templateSourceName').val()
            }).then(res=>{
                console.log(res.data);
                let templateSourceData = res.data.templateSource;
                if(res.data.status == "Select Data Success"){
                    let output ='';
                    output +=`
                    <ul class="list-group temSourceLiUl">
                    `;
                    for(let i = 0; i < templateSourceData.length; i++){
                        output +=`
                        <li class="list-group-item temSourceLi"
                            data_master_temcode="`+templateSourceData[i].master_temcode+`"
                            data_master_name="`+templateSourceData[i].master_name+`"
                            data_master_itemnumber="`+templateSourceData[i].master_itemnumber+`"
                            data_master_stdoutput="`+templateSourceData[i].master_stdoutput+`"
                            data_master_maxamp="`+templateSourceData[i].master_maxamp+`"
                            data_master_packing="`+templateSourceData[i].master_packing+`"
                            data_master_image="`+templateSourceData[i].master_image+`"
                            data_master_imagePath="`+templateSourceData[i].master_imagePath+`"
                            data_master_imagestatus="`+templateSourceData[i].master_imagestatus+`"
                        >`+templateSourceData[i].master_name+`</li>
                        `;
                    }
                    output +=`
                    </ul>
                    `;

                    $('#showTemplateSource').html(output);
                }
            });
        }



    }); //End document function




    let loadimageTemplate = function(event) { 
        let reader = new FileReader(); 
        reader.onload = function(){ 
        let output = document.getElementById('showImageTemplate'); 
        output.src = reader.result; 
        }; 
            reader.readAsDataURL(event.target.files[0]); 
    };
</script>