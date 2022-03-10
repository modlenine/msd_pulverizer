<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/style.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/magnific-popup.css" type="text/css" />

	<!-- Date & Time Picker CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/components/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/components/timepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/components/daterangepicker.css" type="text/css" />

	<link rel="stylesheet" href="<?=base_url('assets/')?>timepicker/css/custom.css" type="text/css" />

 
</head>
<body>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="">กรุณาเลือกเวลา</label>
                                <div class="form-group">
                                    <div class="input-group text-start" data-target-input="nearest" data-target=".datetimepicker1">
                                        <input type="text" class="form-control datetimepicker-input datetimepicker1" data-target=".datetimepicker1" placeholder="00:00 AM/PM" />
                                        <div class="input-group-text"  data-target=".datetimepicker1" data-toggle="datetimepicker"><i class="icon-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
</body>

    <script src="<?=base_url('assets/')?>timepicker/js/jquery.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/plugins.min.js"></script>

	<!-- Date & Time Picker JS -->
	<script src="<?=base_url('assets/')?>timepicker/js/components/moment.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/components/timepicker.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/components/datepicker.js"></script>

	<!-- Include Date Range Picker -->
	<script src="<?=base_url('assets/')?>timepicker/js/components/daterangepicker.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?=base_url('assets/')?>timepicker/js/functions.js"></script>
</html>

<script>
    $(document).ready(function(){
        $('.datetimepicker1').datetimepicker({
            format: "HH:mm",
            showClose: true
        });
    });

    alert('test');
</script>