<div id="manage_runscreenVue">

    <div class="modal fade bs-example-modal-lg" id="manage_runscreen_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable manageRunModalSize">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{mainRunscreen}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-header">
                    <div>
                        <button type="button" class="btn btn-success newRunscreen"><i class="fi-plus mr-2"></i>เพิ่ม</button>
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fi-x mr-2"></i>ปิด
                        </button> -->
                    </div>
                    <div></div>
                </div>

                <div class="modal-body">
                    <div id="show_runscreenData"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="show_runscreen_management"></div>
                        </div>
                    </div>
                    
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>


    <div class="modal fade bs-example-modal-lg" id="add_runscreen_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add_runscreen_title">{{addRunscreen}}</h4>
                    <button type="button" class="close close-add_runscreen_modal" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form @submit.prevent="saveRunscreen" id="frm_saveRunscreen" autocomplete="off">
                    <div class="modal-body">
                        
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label for=""><b>Runscreen Name </b><span class="textRequest">*</span></label>
                                    <input type="tel" name="add_runscreen_name" id="add_runscreen_name" class="form-control">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for=""><b>S/POINT</b></label>
                                    <input type="tel" name="add_spoint" id="add_spoint" class="form-control">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for=""><b>Min</b></label>
                                    <input type="tel" name="add_min" id="add_min" class="form-control">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for=""><b>Max</b></label>
                                    <input type="tel" name="add_max" id="add_max" class="form-control">
                                </div>
                                <input hidden type="text" name="add_autoid" id="add_autoid">
                            </div>
                        
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger close-add_runscreen_modal" data-dismiss="modal"><i class="fi-x mr-2"></i>ปิด</button> -->
                        <button type="submit" id="btn_addRunscreen" class="btn btn-success"><i class="fi-save mr-2"></i>บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>

<script>
    $(document).ready(function(){

        $(document).on('click' , '.newRunscreen' , function(){
            $('#add_runscreen_modal').modal('show');
            $('#manage_runscreen_modal').modal('hide');
        });

        $(document).on('click' , '.close-add_runscreen_modal' , function(){
            $('#add_runscreen_modal').modal('hide');
            $('#manage_runscreen_modal').modal('show');

            $('#add_runscreen_name').val('');
            $('#add_spoint').val('');
            $('#add_min').val('');
            $('#add_max').val('');
            $('#add_autoid').val('');
            $('#add_runscreen_title').html('เพิ่มรายการ รันสกรีน');
            $('#btn_addRunscreen').html('<i class="fi-save mr-2"></i>บันทึก');
        });

        // Control add runscreen input
        $(document).on('keyup' , '#add_runscreen_name' ,function(){
            if($('#add_runscreen_name').val() != ""){
                $('#add_runscreen_name').removeClass('inputNull').addClass('inputSuccess');
            }else{
                $('#add_runscreen_name').removeClass('inputSuccess').addClass('inputNull');
            }
        });

        $(document).on('keyup' , '#add_spoint' ,function(){
            if($('#add_spoint').val() != ""){
                $('#add_spoint').removeClass('inputNull').addClass('inputSuccess');
            }else{
                $('#add_spoint').removeClass('inputSuccess').addClass('inputNull');
            }
        });

        $(document).on('keyup' , '#add_min' ,function(){
            if($('#add_min').val() != ""){
                $('#add_min').removeClass('inputNull').addClass('inputSuccess');
            }else{
                $('#add_min').removeClass('inputSuccess').addClass('inputNull');
            }
        });

        $(document).on('keyup' , '#add_max' ,function(){
            if($('#add_max').val() != ""){
                $('#add_max').removeClass('inputNull').addClass('inputSuccess');
            }else{
                $('#add_max').removeClass('inputSuccess').addClass('inputNull');
            }
        });
        // Control add runscreen input


        $(document).on('click' , '.iconRunEdit' , function(){
            $('#add_runscreen_modal').modal('show');
            $('#manage_runscreen_modal').modal('hide');

            const data_run_name = $(this).attr("data_run_name");
            const data_run_autoid = $(this).attr("data_run_autoid");
            const data_run_min = $(this).attr("data_run_min");
            const data_run_max = $(this).attr("data_run_max");
            const data_run_spoint = $(this).attr("data_run_spoint");

            $('#add_runscreen_name').val(data_run_name);
            $('#add_spoint').val(data_run_spoint);
            $('#add_min').val(data_run_min);
            $('#add_max').val(data_run_max);
            $('#add_autoid').val(data_run_autoid);
            $('#add_runscreen_title').html('แก้ไขรายการ Run Screen');
            $('#btn_addRunscreen').html('<i class="fi-save mr-2"></i>บันทึกการแก้ไข');
        });

       


        let manage_runscreenVue = new Vue({
            el:"#manage_runscreenVue",
            data:{
                mainRunscreen:"หน้าจัดการ รันสกรีน เพิ่ม , ลบ , แก้ไข",
                addRunscreen:"เพิ่มรายการ รันสกรีน",
                editRunscreen:"แก้ไขรายการ รันสกรีน",
                url:"<?php echo base_url();?>",
            },
            methods: {
                saveRunscreen(){
                    // Check input null
                    if($('#add_runscreen_name').val() == ""){
                        $('#add_runscreen_name').addClass('inputNull');
                    }else{
                        $('#add_runscreen_name').removeClass('inputNull');
                    }

                    if($('#add_spoint').val() == ""){
                        $('#add_spoint').addClass('inputNullWarning');
                    }else{
                        $('#add_spoint').removeClass('inputNullWarning');
                    }

                    if($('#add_min').val() == ""){
                        $('#add_min').addClass('inputNullWarning');
                    }else{
                        $('#add_min').removeClass('inputNullWarning');
                    }

                    if($('#add_max').val() == ""){
                        $('#add_max').addClass('inputNullWarning');
                    }else{
                        $('#add_max').removeClass('inputNullWarning');
                    }
                    // Check input null before send api
                    if(
                        $('#add_runscreen_name').val() != ""
                    ){

                        let checkPoint = 0;
                        // Check Min Max Spoint
                        if($('#add_max').val() != "" && $('#add_min').val() != "" && $('#add_spoint').val() != ""){
                            // Check Min max diff
                            if(parseFloat($('#add_max').val()) < parseFloat($('#add_min').val())){
                                swal({
                                    title: 'ค่า Max ต้องไม่น้อยกว่าค่า Min',
                                    type: 'error',
                                    showConfirmButton: false,
                                    timer:1000
                                });
                                $('#add_max').removeClass('inputSuccess').addClass('inputNull');
                            }else{
                                // Check Spoint
                                if(parseFloat($('#add_spoint').val()) > parseFloat($('#add_max').val())){
                                    swal({
                                        title: 'ค่า S/POINT ต้องไม่มากกว่าค่า Max',
                                        type: 'error',
                                        showConfirmButton: false,
                                        timer:1000
                                    });
                                    $('#add_spoint').removeClass('inputSuccess').addClass('inputNull');
                                }else if(parseFloat($('#add_spoint').val()) < parseFloat($('#add_min').val())){
                                    swal({
                                        title: 'ค่า S/POINT ต้องไม่น้อยกว่าค่า Min',
                                        type: 'error',
                                        showConfirmButton: false,
                                        timer:1000
                                    });
                                    $('#add_spoint').removeClass('inputSuccess').addClass('inputNull');
                                }else{
                                    checkPoint = 1;
                                    $('#add_spoint , #add_max , #add_min').removeClass('inputNull').addClass('inputSuccess');
                                }
                            }
                            console.log(checkPoint);
                        }else{
                            checkPoint = 1;
                        }

                        if(checkPoint == 1){
                            if($('#btn_addRunscreen').text() == "บันทึก"){
                                ///////////////////////
                                // For save runscreen
                                ///////////////////////
                                // Check duplicate function
                                axios.post(this.url+'main/machine/checkDuplicateRunscreen',{
                                    action:'checkDuplicateRunscreen',
                                    runscreen_name:$('#add_runscreen_name').val()
                                }).then(res=>{
                                    console.log(res.data);
                                    if(res.data.status == "Not Found Duplicate Data"){

                                        const form = $('#frm_saveRunscreen')[0];
                                        const data = new FormData(form);
                                        axios.post(this.url+'main/machine/saveRunscreen',data,{
                                            
                                        }).then(res=>{
                                            console.log(res.data);
                                            if(res.data.status == "Insert Data Success"){
                                                swal({
                                                    title: 'บันทึกข้อมูลสำเร็จ',
                                                    type: 'success',
                                                    showConfirmButton: false,
                                                    timer:1000
                                                }).then(function(){
                                                    $('#frm_saveRunscreen input').val('').removeClass('inputNull').removeClass('inputSuccess').removeClass('inputNullWarning');
                                                    $('#add_runscreen_modal').modal('hide');
                                                    $('#manage_runscreen_modal').modal('show');
                                                    manage_runscreenVue.getAllRunscreen();
                                                });
                                            }
                                        }).catch(err=>{
                                            console.error('Error' , err);
                                        });
                                    }else{
                                        swal({
                                        title: 'พบข้อมูลซ้ำในระบบ',
                                        type: 'error',
                                        showConfirmButton: false,
                                        timer:1000
                                        });
                                    }
                                }).catch(err=>{
                                    console.error('Error' , err);
                                });
                                ///////////////////////
                                // For save runscreen
                                ///////////////////////
                            }else{

                                ///////////////////////
                                // For Edit runscreen
                                ///////////////////////
                                const form = $('#frm_saveRunscreen')[0];
                                const data = new FormData(form);
                                axios.post(this.url+'main/machine/saveEditRunscreen',data,{
                                    
                                }).then(res=>{
                                    console.log(res.data);
                                    if(res.data.status == "Update Data Success"){
                                        swal({
                                            title: 'แก้ไขข้อมูลสำเร็จ',
                                            type: 'success',
                                            showConfirmButton: false,
                                            timer:1000
                                        }).then(function(){
                                            $('#frm_saveRunscreen input').val('').removeClass('inputNull').removeClass('inputSuccess').removeClass('inputNullWarning');
                                            $('#add_runscreen_modal').modal('hide');
                                            $('#manage_runscreen_modal').modal('show');
                                            manage_runscreenVue.getAllRunscreen();
                                        });
                                    }
                                }).catch(err=>{
                                    console.error('Error' , err);
                                });
                                ///////////////////////
                                // For Edit runscreen
                                ///////////////////////
                            }
                        }

                        

                    }else{
                        swal({
                            title: 'กรุณากรอกข้อมูลให้ครบถ้วนด้วยค่ะ',
                            type: 'error',
                            showConfirmButton: false,
                            timer:1000
                        });
                    }
                    




                },

                getAllRunscreen(){
                    $('.loader').fadeIn(1000); 
                    axios.post(url+'main/machine/getAllRunscreen',{
                        action:"getAllRunscreen"
                    }).then(res=>{
                        $('.loader').fadeOut(1000);
                        // console.log(res.data);

                        $('#show_runscreenData').html(res.data);

                        $("#runscreenManage thead th").each(function () {
                        var title = $(this).text();
                            $(this).html(
                                title +
                                    ' <input type="text" class="col-search-input" placeholder="Search ' +
                                    title +
                                    '" />'
                                );
                            });

                        var table = $("#runscreenManage").DataTable({
                            iDisplayLength: -1,
                            columnDefs: [
                            {
                                searching: false,
                                orderable: false,
                                targets: "_all",
                            },
                            ],
                            ordering: false,
                            paging: false,
                        });

                        table.columns().every(function () {
                            var table = this;
                            $("input", this.header()).on("keyup change", function () {
                                if (table.search() !== this.value) {
                                    table.search(this.value).draw();
                                }
                            });
                        });
                    })
                },

                deleteRunscreen(){
                    $(document).on('click' , '.iconRunDel' , function(){
                        swal({
                            title: 'ต้องการลบข้อมูล ใช่หรือไม่',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            confirmButtonText: 'ยืนยัน',
                            cancelButtonText: 'ยกเลิก'
                        }).then((result)=> {
                            if(result.value == true){
                                const data_run_autoid = $(this).attr("data_run_autoid");
                                axios.post(url+'main/machine/deleteRunscreen',{
                                    action:"deleteRunscreen",
                                    run_autoid:data_run_autoid
                                }).then(res=>{
                                    if(res.data.status == "Delete Data Success"){
                                        swal({
                                            title: 'ลบข้อมูลสำเร็จ',
                                            type: 'success',
                                            showConfirmButton: false,
                                            timer:1000
                                        }).then(function(){
                                            manage_runscreenVue.getAllRunscreen();
                                        });
                                    }else{
                                        swal({
                                            title: 'ลบข้อมูลไม่สำเร็จ',
                                            type: 'error',
                                            showConfirmButton: false,
                                            timer:1000
                                        });
                                    }
                                }).catch(err=>{
                                    console.error('Error' , err);
                                });
                            }
                        });   
                    });
                }

            },
            created() {
                this.getAllRunscreen();
                this.deleteRunscreen();
            },
        })
    });


</script>