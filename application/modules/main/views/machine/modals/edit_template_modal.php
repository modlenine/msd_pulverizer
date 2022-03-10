<div id="edit_template">

    <div class="modal fade bs-example-modal-lg" id="edit_template_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable createTempMdSize">

        <form id="frm_saveEditTemplate" autocomplete="off" @submit.prevent="saveEditTemplate" style="width:100%" class="needs-validation" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">แก้ไขข้อมูลเทมเพลต</h4>
                    <button type="button" class="close close_createTemplate" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-header">
                    
                    <div class="row">
                      <div class="col-lg-12">
                          <button type="submit" id="btn-saveEditTemplate" class="btn btn-success"><i class="fi-save mr-2"></i>บันทึก</button>
                          <button type="button" id="btn-deleteEditTemplate" class="btn btn-warning "><i aria-hidden="true" class="fa fa-trash mr-2"></i>ลบ</button>
                          <button type="button" id="btn-sumRun_createTemplate" class="btn btn-info sumRun_createTemplate"><i class="fa fa-file-text-o mr-2"></i>ดูภาพรวม</button>
                          <button type="button" id="btn-calcelEditTemplate" class="btn btn-danger close_createTemplate" data-dismiss="modal"><i class="fi-x mr-2"></i>ปิด</button>
                      </div>
                    </div>
                </div>

                <div class="modal-body">

                    <!-- For new template -->
                    <div class="row">
                        <div class="col-md-4">
                            <div id="templateImageArea">
                                <img id="showImageTemplate_edit" src="<?=base_url('uploads/noimage2.jpg')?>" alt="">
                            </div>  
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Template Name</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="templateName_edit" id="templateName_edit" class="form-control" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Item Number</b></label>
                                    <input type="text" name="itemNumber_edit" id="itemNumber_edit" class="form-control">
                                    <div id="showItemidList_edit"></div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>STD Output (kg./hr)</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="stdoutput_edit" id="stdoutput_edit" class="form-control" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Max Amp</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="maxamp_edit" id="maxamp_edit" class="form-control" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Packing (kg./bag)</b>&nbsp;<span class="textRequest">*</span></label>
                                    <input type="text" name="packing_edit" id="packing_edit" class="form-control" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>Upload Template Picture</b></label>
                                    <input type="file" name="templatePicture_edit" id="templatePicture_edit" class="form-control" onchange="loadimageTemplate_edit(event)">
                                </div>
                                <input hidden type="text" name="tempCode_edit" id="tempCode_edit">
                                <input hidden type="text" name="imageFile_edit" id="imageFile_edit">
                                <input hidden type="text" name="imagePath_edit" id="imagePath_edit">
                            </div>
                        </div>
                    </div>
                        <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="searchRunscreenMain_edit" id="searchRunscreenMain_edit" class="form-control" placeholder="Search Run Screen Master">
                            <div class="mt-2">
                                <span><b>Total : <span id="totalRunMainCount_edit"></span> รายการ</b></span>
                            </div>
                            <div id="showRunscreenMain_edit" class="mt-2"></div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="searchRunscreenSelected_edit" id="searchRunscreenSelected_edit" class="form-control" placeholder="Search Run Screen Selected">
                            <div class="mt-2">
                                <span><b>Total : <span id="totalRunSelectedCount_edit"></span> รายการ</b></span>
                                <div class="iconUpAndDown_edit">
                                    <i id="runUp_edit" class="fa fa-chevron-circle-up runUpArrow_edit" aria-hidden="true" style="display:none;"></i>&nbsp;&nbsp;
                                    <i id="runDown_edit" class="fa fa-chevron-circle-down runDownArrow_edit" aria-hidden="true" style="display:none;"></i>
                                </div>
                            </div>
                            <div id="showRunscreenSelected_edit" class="mt-2"></div>
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

    <!-- Edit Head Modal -->
    <div class="modal fade bs-example-modal-lg" id="sumRun_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">

            <div class="modal-content">
                <div class="modal-header">
                    <div id="">เทมเพลต : <span id="sr_title"></span></div>
                    <div>
                        <button type="button" class="close btn-closeSumRun" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                </div>

                <div class="modal-header">
                    
                    <div>
                        <button type="button" class="btn btn-warning btn-closeSumRun" id="btn-closeSumRun" data-dismiss="modal"><i class="fi-x mr-2"></i>ปิด</button>
                    </div>
                    <div>
                    
                    </div>
                </div>

                <div class="modal-body">
                    <h4 style="text-align:center;">Total : <span id="sumRunTotal"></span> รายการ</h4>
                    <div id="showSumRumData" class="mt-3"></div>
                </div>
            </div>

        </div>
    </div>
    <!-- Edit Head Modal -->

</div>

<script>
$(document).ready(function(){
let url = "<?php echo base_url(); ?>";


    $(document).on('click' , '#btn-deleteEditTemplate' , function(){
        swal({
                title: 'คุณต้องการลบ เทมเพลต นี้ใช่หรือไม่ ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'ลบเลย'
            }).then((result)=> {
                if(result.value == true){
                    let templateCode = $('#tempCode_edit').val();
                    deleteTemplate(templateCode);
                }
                
            });
    });


    $(document).on('click' , '.sumRun_createTemplate' , function(){
        const data_templatecode = $(this).attr("data_templatecode");
        const data_templatename = $(this).attr("data_templatename");
        console.log(data_templatecode);
        $('#sr_title').html(data_templatename);
        $('#sumRun_modal').modal('show');
        $('#edit_template_modal').modal('hide');
        loadSumRun(data_templatecode);
    });

    $(document).on('click' , '.btn-closeSumRun' ,function(){
        $('#sumRun_modal').modal('hide');
        $('#edit_template_modal').modal('show');
    });



// Vue Zone
    let edit_template = new Vue({
        el:"#edit_template",
        data:{
            title:"test"
        },
        methods: {
            saveEditTemplate()
            {
                // Check Input null
                if($('#templateName_edit').val() != "" &&
                $('#stdoutput_edit').val() != "" &&
                $('#maxamp_edit').val() != ""){
                    $('#btn-saveEditTemplate').prop('disabled' , true);

                    const form = $('#frm_saveEditTemplate')[0];
                    const data = new FormData(form);

                    axios.post(url+'main/machine/saveEditTemplate',data ,{
                        header:{
                            'Content-Type' : 'multipart/form-data'
                        },
                    }).then(res=>{
                        console.log(res);
                        if(res.data.status == "Update Data Success"){
                            swal({
                                title: 'บันทึกข้อมูลสำเร็จ',
                                type: 'success',
                                showConfirmButton: false,
                                timer:1000
                            }).then(function(){
                                // location.reload();
                                // $('#edit_template_modal').modal('hide');
                                // loadTemplateList();
                                location.reload();
                            });
                        }
                    }).catch(err=>{
                        console.error('Err' , err);
                    });
                }else{
                    swal({
                        title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                        type: 'error',
                        showConfirmButton: false,
                        timer:1000
                    });
                }


            },






        },
    });
// Vue Zone


    function deleteTemplate(templateCode)
    {
        axios.post(url+'main/machine/deleteTemplate' , {
            action:"deleteTemplate",
            templateCode:templateCode,
            imageFile:$('#imageFile_edit').val(),
            imagePath:$('#imagePath_edit').val()
        }).then(res => {
            console.log(res.data);
            if(res.data.status == "Delete Template Success"){
                swal({
                    title: 'ลบรายการสำเร็จ',
                    type: 'success',
                    showConfirmButton: false,
                    timer:800
                    });
                    $('#edit_template_modal').modal('hide');
                    loadTemplateList();
            }else{
                swal({
                    title: 'พบข้อผิดพลาดในการลบรายการ',
                    type: 'error',
                    showConfirmButton: false,
                    timer:800
                    });
            }
        }).catch(err => {
            console.error('Err',err);
        });
    }


    function loadTemplateList()
    {
        axios.post(url+'main/machine/loadTemplateList',{
            action:"loadTemplateList",
            searchTemplate:$('#searchTemplate').val()
        }).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                createTemplateBox(res.data.getTemplate);
            }else{
                $('#showTemplateList').html(`<h1>ไม่พบข้อมูล</h1>`);
            }
        }).catch(err=>{
            console.error('Error' , err);
        });
    }

    function createTemplateBox(templateData)
    {
        // runScreenMain = [];
        // runScreenSelected = [];
        console.log(templateData);
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
    }

    function loadSumRun(templatecode)
    {
        if(templatecode != ""){
            axios.post(url+'main/machine/loadSumRun' , {
                action:"loadSumRun",
                templatecode:templatecode
            }).then(res=>{
                console.log(res.data);
                if(res.data.status == "Select Data Success"){
                    let rsSumRun = res.data.sumrun;
                    $('#sumRunTotal').html(rsSumRun.length);

                    let output = '';

                    output +=`
                    <table id="tbl_sumRun" class="table table-striped">
                        <tr>
                            <th>Run Screen</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>SPoint</th>
                        </tr>`;

                        for(let i = 0; i < rsSumRun.length; i++){
                            output +=`
                            <tr>
                                <td>`+rsSumRun[i].detail_column_name+`</td>
                                <td>`+rsSumRun[i].detail_min+`</td>
                                <td>`+rsSumRun[i].detail_max+`</td>
                                <td>`+rsSumRun[i].detail_spoint+`</td>
                            </tr>
                            `
                        }
                    
                    output +=`
                    </table>
                    `;

                    $('#showSumRumData').html(output);
                }
            });
        }
    }


}); //End document function



let loadimageTemplate_edit = function(event) { 
        let reader = new FileReader(); 
        reader.onload = function(){ 
        let output = document.getElementById('showImageTemplate_edit'); 
        output.src = reader.result; 
        }; 
            reader.readAsDataURL(event.target.files[0]); 
    };


</script>