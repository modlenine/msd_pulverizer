<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="<?=base_url('assets/js/jquery.min.js?v='.filemtime('./assets/js/jquery.min.js'))?>"></script>

	<!-- Date & Time Picker CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/components/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/components/timepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/components/daterangepicker.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/font-icons.css" type="text/css" />

    	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/style.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/sweetalert2/sweetalert2.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/custom.css">

</head>
<body>
                            <div class="row form-group">
                            <div class="col-md-12">
                                <label for="">กรุณาเลือกเวลา</label>
                                <!-- <div class="form-group">
                                    <div class="input-group text-start inputTime flex-container" data-target-input="nearest" data-target=".datetimepicker1">
                                        <input type="text" id="mdrd_chooseTime" name="mdrd_chooseTime" class="form-control datetimepicker-input datetimepicker1" data-target=".datetimepicker1" placeholder="กรุณาเลือกเวลา" required/>
                                        <div class="input-group-text clockIcondiv" style="align-self: center" data-target=".datetimepicker1" data-toggle="datetimepicker"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <div class="input-group text-left" data-target-input="nearest" data-target=".datetimepicker1">
                                        <input type="text" id="mdrd_chooseTime" name="mdrd_chooseTime" class="form-control datetimepicker-input datetimepicker1" data-target=".datetimepicker1" required/>
                                        <div class="input-group-append" data-target=".datetimepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text bgClock"><i class="icon-clock"></i></div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-12 bottommargin-sm">
                                <label for="">Date Format</label>
                                <input type="text" value="" class="form-control text-start component-datepicker format" placeholder="DD-MM-YYYY">
                            </div>


                        </div>
</body>
</html>

    <script src="<?=base_url('assets/')?>timepicker/js/components/moment.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/components/timepicker.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/components/datepicker.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/components/daterangepicker.js"></script>

<script>
    $(document).ready(function(){
        $('.datetimepicker1').datetimepicker({
			format: "HH:mm",
			showClose: true
    	});

		$('.datetimepicker1_edit').datetimepicker({
			format: "HH:mm",
			showClose: true
    	});

		$('.datepicker1').datetimepicker({
			format: "HH:mm",
			showClose: true
    	});

		$('.component-datepicker.format').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
		});
    });
</script>