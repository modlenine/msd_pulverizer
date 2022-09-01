<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายการใบงาน</title>

		<!-- Date picker -->
		<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/default/zebra_datepicker.min.css" type="text/css" />
		
</head>
<body>
    <div class="main-container">
		<div class="pd-ltr-20">
		
			<div class="row">
				<div class="col-xl-12 mb-30">
					<div class="card-box height-100-p pd-20">
						<div class="mt-5"></div>
						<div class="row mb-3">
							<div class="col-md-6">
								<button type="button" id="btn-addMachineData" class="btn btn-primary btnIndex" style="display:none;">
									<i class="fi-plus mr-2"></i>เพิ่มข้อมูล</button>
								<button type="button" id="btn-graphMachineData" class="btn btn-secondary btnIndex">
									<i class="fi-graph-bar mr-2"></i>กราฟ</button>
							</div>
						</div>
						<hr>
						<div class="mt-4"></div>
						<h3 style="text-align:center;">ข้อมูลเครื่องบด</h3>

						<div class="row mt-4">
							<div class="col-md-12">
								<div id="searchBydate">
									<input type="text" name="datestart" id="datestart" class="" placeholder="วันที่เริ่มต้น">
									<input type="text" name="dateend" id="dateend" class="" placeholder="วันที่สิ้นสุด">
								</div>
								<div id="btn_searchBydateDiv" class="mt-2">
									<button type="button" id="btn_clearSearchByDate" class="btn btn-warning"><i class="fa fa-rotate-left mr-2" aria-hidden="true"></i>ล้างการค้นหา</button>

									<button type="button" id="btn_searchBydate" class="btn btn-success"><i class="fa fa-search mr-2" aria-hidden="true"></i>ค้นหา</button>
									
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table id="dataMainList" class="table table-striped table-bordered" cellspacing="0">
								<thead>
									<tr>
										<th>Form No.</th>
										<th>Machine Name</th>
										<th>Item Number</th>
										<th>Production Number</th>
										<th>Batch Number</th>
										<th>Order</th>
										<th>Output</th>
										<th>Blade Type</th>
										<th>Screen (Mesh)</th>
										<th>Gap</th>
										<th>Date</th>
										<th>Status</th>
										<th>Memo</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</body>
</html>

<script>
	$(document).ready(function(){
		checkProductionUser();
		localStorage.removeItem('tab');

		let url = "<?php echo base_url(); ?>";

		$('#btn-addMachineData').click(function(){
			$('#addNewData_modal').modal('show');
		});

		let datestart = "";
		let dateend = "";
		loadDataList();

		// $(document).on('click' , '.l_viewmain' , function(){
		// 	const data_mainformno = $(this).attr("data_mainformno");
		// 	const data_maincode = $(this).attr("data_maincode");
		// 	$('#getMaincode').val(data_maincode);
		// 	let link = url+'viewfulldata.html/'+data_mainformno;
		// 	window.open(link, '_blank');
		// });


		$(document).on('click' , '#btn-graphMachineData' , function(){
			location.href = url+'main/graph/graphPage';
		});


		$(document).on('click' , '#btn_searchBydate' , function(){
			if($('#datestart').val() != "" && $('#dateend').val() != ""){
				let date_start = $('#datestart').val();
				let date_end = $('#dateend').val();
				loadDataListByDate(date_start , date_end);
			}
		});

		$(document).on('click' , '#btn_clearSearchByDate' , function(){
			let table = $('#dataMainList').DataTable();
			table.state.clear();
			location.reload();
		});


		$('#datestart').Zebra_DatePicker({
            pair: $('#dateend')
        });
        $('#dateend').Zebra_DatePicker({
            direction: true
        });



	// Function zone
		function loadDataList()
		{
			let thid = 1;
			$('#dataMainList thead th').each(function() {
				var title = $(this).text();
				$(this).html(title + ' <input type="text" id="mainlist_'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
				thid++;
			});

				var widthss;
				const browserWidth = $(window).width();
					if(browserWidth > 768){
						$('#dataMainList').css('width' , '800px');
					}else if(browserWidth > 1023){
						$('#dataMainList').css('width' , '1400px');
					}

				$(window).resize(function(){
					if(browserWidth > 768 && browserWidth < 1024){
						$('#dataMainList').css('width' , '800px');
					}else if(browserWidth > 1023){
						$('#dataMainList').css('width' , '1300px');
					}
				});

				if(datestart != "" && dateend != ""){
					$('#dataMainList').DataTable().destroy();
					
				}
				
					var table = $('#dataMainList').removeAttr('width').DataTable({
								"scrollX": true,
								"processing": true,
								"serverSide": true,
								"stateSave": true,
								stateLoadParams: function(settings, data) {
									for (i = 0; i < data.columns["length"]; i++) {
										let col_search_val = data.columns[i].search.search;
										if (col_search_val !== "") {
											$("input", $("#dataMainList thead th")[i]).val(col_search_val);
										}
									}
								},
								"ajax": {
									"url":"<?php echo base_url('main/loadMainData') ?>",
								},
								order: [
									[0, 'desc']
								],
								columnDefs: [{
										targets: "_all",
										orderable: false
									},
									{"width": "80","targets": 0},
									{"width": "200","targets": 1},
									{"width": "100","targets": 2},
									{"width": "150","targets": 3},
									{"width": "150","targets": 4},
									{"width": "100","targets": 5},
									{"width": "100","targets": 6},
									{"width": "100","targets": 7},
									{"width": "100","targets": 8},
									{"width": "100","targets": 9},
									{"width": "100","targets": 10},
									{"width": "100","targets": 11},
									{"width": "150","targets": 12}
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

				$('#mainlist_11').prop('readonly' , true).css({
					'background-color':'#F5F5F5',
					'cursor':'no-drop'
				});

				
		}

		function loadDataListByDate(date_start , date_end)
		{
			let thid = 1;
			$('#dataMainList thead th').each(function() {
				var title = $(this).text();
				$(this).html(title + ' <input type="text" id="mainlist_'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
				thid++;
			});

				var widthss;
				const browserWidth = $(window).width();
					if(browserWidth > 768){
						$('#dataMainList').css('width' , '800px');
					}else if(browserWidth > 1023){
						$('#dataMainList').css('width' , '1400px');
					}

				$(window).resize(function(){
					if(browserWidth > 768 && browserWidth < 1024){
						$('#dataMainList').css('width' , '800px');
					}else if(browserWidth > 1023){
						$('#dataMainList').css('width' , '1300px');
					}
				});

				if(date_start != "" && date_end != ""){
					$('#dataMainList').DataTable().destroy();
					
				}
				
					var table = $('#dataMainList').removeAttr('width').DataTable({
								"scrollX": true,
								"processing": true,
								"serverSide": true,
								"stateSave": true,
								stateLoadParams: function(settings, data) {
									for (i = 0; i < data.columns["length"]; i++) {
										let col_search_val = data.columns[i].search.search;
										if (col_search_val !== "") {
											$("input", $("#dataMainList thead th")[i]).val(col_search_val);
										}
									}
								},
								"ajax": {
									"url":"<?php echo base_url('main/loadMainDataByDate/') ?>"+date_start+"/"+date_end,
								},
								order: [
									[0, 'desc']
								],
								columnDefs: [{
										targets: "_all",
										orderable: false
									},
									{"width": "80","targets": 0},
									{"width": "200","targets": 1},
									{"width": "100","targets": 2},
									{"width": "120","targets": 3},
									{"width": "150","targets": 4},
									{"width": "150","targets": 5},
									{"width": "150","targets": 6},
									{"width": "150","targets": 7},
									{"width": "150","targets": 8},
									{"width": "150","targets": 9},
									{"width": "100","targets": 10},
									{"width": "100","targets": 11},
									{"width": "150","targets": 12}
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

				$('#mainlist_8').prop('readonly' , true).css({
					'background-color':'#F5F5F5',
					'cursor':'no-drop'
				});
		}

		function checkProductionUser()
		{
			const deptcode = "<?php echo getUser()->DeptCode; ?>";
			const ecode = "<?php echo getUser()->ecode; ?>";
			if(deptcode != "1007"){
				if(ecode == "M1809" || ecode == "M0282"){
					$('#btn-addMachineData').css('display' , '');
				}else{
					$('#btn-addMachineData').css('display' , 'none');
				}

			}else{
				$('#btn-addMachineData').css('display' , '');
			}
		}


	});
</script>
