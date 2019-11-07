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
				<!-- Modal Add supplier-->
				<div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
					<form id="addsupplier" method="post">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-users"></i> Add Supplier</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="supplier_name">Supplier Name:</label>
												<input type="text" class="form-control" name="supplier_name" value="">
												<span class="err"></span>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="supplier_contact_person">Supplier Contact Person:</label>
												<input type="number" class="form-control" name="supplier_contact_person" value="">
												<span class="err"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
												<label for="companytitle">Company</label>
												<!-- <input type="text" name="companytitle" value="" required> -->
											<select class="form-control js-example-basic-multiple-addsupplier" name="company[]" multiple="multiple"></select>
												<span class="err"></span>
									</div>
								</div>
								<div class = "row">
								   <!-- <div class="col-6">
										 <div class="form-group">
											 <label for="vendor">Vendor:</label>
											 <select class="form-control" class="vendor" name="vendor">
												 <option value="">Select Vendor</option>
													 <?php //foreach($vendor as $k => $value) : ?>
															 <option value="<?php// echo $value['id'] ?>"><?php //echo $value['fullname'] ?></option>
												 <?php  //endforeach; ?>
									 			</select>
												<span class="err"></span>
										 </div>
										</div> -->
								<div class="col-4">
									<div class="form-group">
										<label for="office_number">Office Number:</label>
										<input type="tel" class="form-control" name="office_number" value="">
										<span class="err"></span>
									</div>
								</div>

                  <div class="col-4">
									<div class="form-group">
										<label for="home_number">Home Phone:</label>
										<input type="number" class="form-control" name="home_number" value="">
									</div>
									</div>
									<div class="col-4">
									<div class="form-group">
										<label for="mobile_number">Mobile Number</label>
										<input type="number" class="form-control" name="mobile_number" value="">
									</div>
                </div>
              </div>
							<div class = "row">
								<div class="col-6">
									<div class="form-group">
										<label for="tin">TIN:</label>
										<input type="number" class="form-control" name="tin_number" value="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="tin">Fax Number:</label>
										<input type="number" class="form-control" name="fax_number" value="">
									</div>
								</div>
							</div>
							<div class="col-sm-4">
                <label for=""><i class="fa fa-upload" aria-hidden="true"></i> Supplier Logo </label>
                <div class="uploadfile-container2">
                  <input class="input-file" name="logo" id="my-file" type="file" accept="image/*">
                  <p class="file-return"></p>
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

				<!--view supplier modal -->
				<!-- Modal Add supplier-->
				<div class="modal fade" id="viewSupplier" tabindex="-1" role="dialog" aria-	labelledby="exampleModalLabel" aria-hidden="true">\
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-eye"></i> View Supplier Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="supplier_name">Supplier Name:</label>
												<p class="supplier_name"> </p>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="supplier_contact_person">Supplier Contact Person:</label>
												<p class="supplier_contact_person"> </p>
											</div>
										</div>
									</div>
								<div class = "row">
											<div class="col-6">
													<label for="company">Company</label>
													<p class="company"> </p>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="office_number">Office Number:</label>
												<p class="office_number"> </p>
											</div>
										</div>
									</div>
								<div class = "row">
                  <div class="col-6">
									<div class="form-group">
										<label for="home_number">Home Phone:</label>
										<p class="home_number"> </p>
									</div>
									</div>
									<div class="col-6">
									<div class="form-group">
										<label for="mobile_number">Mobile Number</label>
										<p class="mobile_number"> </p>
									</div>
                </div>
              </div>
							<div class = "row">
								<div class="col-6">
									<div class="form-group">
										<label for="tin">TIN:</label>
										<p class="tin"> </p>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="fax_number">Fax Number:</label>
										<p class="fax_number"> </p>
									</div>
								</div>
							</div>
								</div>
							</div>
						</div>
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
					<div class="middle">
						<button class="button company1" onClick="window.location.href = '<?= base_url("supplier/index/1"); ?>supplier/index';return false;">New Jiandra</button>
						<button class="button company2" onClick="window.location.href = '<?= base_url("supplier/index/2"); ?>supplier/index';return false;">Mrs.P Mktg</button>
					</div>
					<div class="row">.
						<div class="col-sm-12">
							<table id="example1" class="table table-bordered table-striped dataTable suppliers_tbl" role="grid" aria-describedby="example1_info">
								<thead>
								<th class="header-title">Supplier Logo</th>
								<th class="header-title">Supplier Name</th>
								<th class="header-title">Action</th>
								<th class="header-title">Status</th>
							</thead>
							</table>

						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- /.card-body -->
	</div>
