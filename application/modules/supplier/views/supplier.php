<?php echo "hi"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><b>Supplier</b></h1>
					ENROLLMENT > <span class="active1"> SUPPLIER </p>
				</div>
				<div class="col-sm-6">
					<button type="button" class="button1 float-sm-right" data-toggle="modal" data-target="#addSupplier "><i class="fas fa-plus-circle" aria-hidden="true"></i> Add Supplier </button>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
					<form action="<?= base_url('supplier/addsupplier') ?>" method="post">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="supplier_name">Supplier Name:</label>
												<input type="text" class="form-control" name="supplier_name" value="" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="supplier_contact_person">Supplier Contact Person:</label>
												<input type="number" class="form-control" name="supplier_contact_person" value="" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="company_one">Company One:</label>
												<input type="text" class="form-control" name="company_one" value="" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="company_two">Company Two:</label>
												<input type="text" class="form-control" name="company_two" value="" required>
											</div>
										</div>
									</div>
								<div class = "row">
								   <div class="col-6">
									<div class="form-group">
										<label for="vendor">Vendor:</label>
										<input type="text" class="form-control" name="vendor" value="" required>
									</div>
									</div>
								<div class="col-6">
									<div class="form-group">
										<label for="office_number">Office Number:</label>
										<input type="tel" class="form-control" name="office_number" value="" required>
									</div>
								</div>
              </div>
                <div class="row">
                  <div class="col-6">
									<div class="form-group">
										<label for="home_number">Home Phone:</label>
										<input type="number" class="form-control" name="home_number" value="" required>
									</div>
									</div>
									<div class="col-6">
									<div class="form-group">
										<label for="mobile_number">Mobile Number</label>
										<input type="number" class="form-control" name="mobile_number" value="" required>
									</div>
                </div>
              </div>
							<div class = "row">
								<div class="col-6">
									<div class="form-group">
										<label for="tin">TIN:</label>
										<input type="number" class="form-control" name="tin_number" value="" required>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="tin">Fax Number:</label>
										<input type="number" class="form-control" name="fax_number" value="" required>
									</div>
								</div>
							</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary add">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>


			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- Default box -->
	<div class="card">
		<!-- /.card-header -->
		<div class="main header">

			<div class="card-body1">
				<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="dataTables_length" id="example1_length">
								<label>Show
									<select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select> entries
								</label>
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div id="example1_filter" class="dataTables_filter">
								<label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
							</div>
						</div>
					</div>
					<div class="middle">
						<button class="button company1">New Jiandra Enterprises </button>
						<button class="button company2">Mrs.P Mktg. </button>
					</div>
					<div class="row">.
						<div class="col-sm-12">
							<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr class="table-header" role="row">
										<th class="header-title sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 283px;">Supplier Logo</th>
										<th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 359px;">Supplier Name</th>
										<th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">Action</th>
										<th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Status</th>
									</tr>
								</thead>
								<tbody>
									<tr role="row" class="odd">
										<td class="table-data sorting_1">example1</td>
										<td class="table-data">example1</td>
										<td class="action"><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i> <i class="fa fa-trash" aria-hidden="true"></i></td>
										<td class="table-data"><button type="button" class="inactive btn btn-block btn-danger">inactive</button></td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">example1</td>
										<td class="table-data">example1</td>
										<td class="action"><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i> <i class="fa fa-trash" aria-hidden="true"></i></td>
										<td class="table-data"><button type="button" class="active btn btn-block btn-success">inactive</button></td>
									</tr>
								</tbody>
							</table>
							<table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
								<thead>
									<tr class="table-header" role="row">
										<th class="header-title sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 283px;">Supplier Logo</th>
										<th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 359px;">Supplier Name</th>
										<th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">Action</th>
										<th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Status</th>
									</tr>
								</thead>
								<tbody>
									<tr role="row" class="odd">
										<td class="table-data sorting_1">Gecko</td>
										<td class="table-data">Arriane</td>
										<td class="action"><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i> <i class="fa fa-trash" aria-hidden="true"></i></td>
										<td class="table-data"><button type="button" class="inactive btn btn-block btn-danger">inactive</button></td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1">example2</td>
										<td class="table-data">example2</td>
										<td class="action"><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i> <i class="fa fa-trash" aria-hidden="true"></i></td>
										<td class="table-data"><button type="button" class="active btn btn-block btn-success">inactive</button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-5">
							<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
						</div>
						<div class="col-sm-12 col-md-7">
							<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
								<ul class="pagination">
									<li class="paginate_button page-item previous disabled" id="example1_previous">
										<a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
									</li>
									<li class="paginate_button page-item active">
										<a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
									</li>
									<li class="paginate_button page-item ">
										<a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
									</li>
									<li class="paginate_button page-item ">
										<a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
									</li>
									<li class="paginate_button page-item ">
										<a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
									<li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
									</li>
									<li class="paginate_button page-item ">
										<a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a>
									</li>
									<li class="paginate_button page-item next" id="example1_next">
										<a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- /.card-body -->
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".company2").click(function() {
				$("#example2").show();
				$("#example1").hide();
			});
			$(".company1").click(function() {
				$("#example1").show();
				$("#example2").hide();
			});
		});

		$('#addSupplier form').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(result) {
					$('#addSupplier form')[0].reset();
					Swal.fire(result.title, result.msg, result.type);
				}
			});
		});
	</script>
