
    
    <!-- js -->
	<script src="<?=base_url('assets/')?>vendors/scripts/core.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/script.min.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/process.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/layout-settings.js"></script>

	<script src="<?=base_url('assets/')?>src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url('assets/')?>src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=base_url('assets/')?>src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?=base_url('assets/')?>src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


    <!-- add sweet alert js & css in footer -->
	<script src="<?=base_url('assets/')?>src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="<?=base_url('assets/')?>src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Bootstrap File Upload Plugin -->
	<script src="<?=base_url('assets/')?>fileupload/bs-filestyle.js"></script>


	<!-- Date & Time Picker JS -->
	<script src="<?=base_url('assets/')?>timepicker/js/components/moment.js"></script>
	<script src="<?=base_url('assets/')?>timepicker/js/components/timepicker.js"></script>
	<!-- <script src="<?=base_url('assets/')?>timepicker/js/components/datepicker.js"></script> -->
	<script src="<?=base_url('assets/')?>timepicker/js/components/daterangepicker.js"></script>


	<!-- Data Table Button -->
	<script src="<?= base_url('assets/js/datatables/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables/vfs_fonts.js') ?>"></script>


	
	<!-- Date & Time Picker JS -->
	<script src="<?=base_url()?>assets/dist/zebra_datepicker.min.js"></script>
	<script src="<?=base_url()?>assets/ekko_lightbox/ekko-lightbox.min.js"></script>

</body>

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


		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox({
				alwaysShowClose: true,
			});
		});





			// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();






	});

</script>
</html>