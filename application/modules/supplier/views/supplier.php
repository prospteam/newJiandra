<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><b>Supplier</b></h1>
					ENROLLMENT > <span class="active1"> SUPPLIERS</p>
				</div>
				<div class="col-sm-6">
					<button type="button" class="button1 float-sm-right" data-toggle="modal" data-target="#addSupplier "><i class="fas fa-plus-circle" aria-hidden="true"></i> Add Supplier </button>
				</div>
				<!-- Modal Add supplier-->
				<div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
					<form id="addsupplier" method="post">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header bg-info1">
									<h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>

									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="supplier_name">Supplier Name: <span class="required">*</span></label>
												<input type="text" class="form-control" name="supplier_name" value="">
												<span class="err"></span>
											</div>
										</div>
								</div>
								<hr>
										<span class="btn btn-sm btn-primary" id="addnewCP"><i class="fa fa-plus"></i> Supplier Contact Person</span>
									<br>
									<div class="table-responsive view_supplier_contact_details">
												<table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="add_contact_person">
													<thead>
															<th class="header-title supp">Name</th>
															<th class="header-title supp">Mobile Number</th>
															<th class="header-title supp">Email </th>
															<th class="header-title supp">Position </th>
													</thead>
													<tbody>

															<tr>
																<td class="supp_td">
																	<input type="text" class="form-control contact_person" name="contact_name[]" value="">
																	<span class="err"></span>
																</td>
																<td class="supp_td">
																	<input type="number" class="form-control contact_mobileno" name="mobile_number[]" value="">
																	<span class="err"></span>
																</td>
																<td class="supp_td">
																	<input type="text" class="form-control contact_email" name="contact_email[]" value="">
																	<span class="err"></span>
																</td>
																<td class="supp_td">
																	<input type="text" class="form-control supp_position" name="supp_position[]" value="">
																	<span class="err"></span>
																</td>
															</tr>

													</tbody>
												</table>
									</div>
									<hr>

									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="companytitle">Company: <span class="required">*</span> </label>
												<!-- <input type="text" name="companytitle" value="" required> -->
												<div class="select2-purple">
													<select class="form-control js-example-basic-multiple" name="company[]" multiple="multiple"></select>
													<span class="err"></span>
												</div>
									</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="email">Email: <span class="required">*</span> </label>
											<input type="email" class="form-control" name="email" value="">
											<span class="err"></span>
										</div>
								</div>
							</div>
								<div class = "row">
								   <!-- <div class="col-lg-6">
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
								<div class="col-lg-6">
									<div class="form-group">
										<label for="address">Address: <span class="required">*</span> </label>
										<input type="text" class="form-control" name="address" value="">
										<span class="err"></span>
									</div>
								</div>

									<div class="col-lg-6">
									<div class="form-group">
										<label for="office_number">Office Number: </label>
										<input type="number" class="form-control" name="office_number" value="">
									</div>
                </div>
              </div>
							<div class = "row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="fax_number">Fax Number:</label>
										<input type="number" class="form-control" name="fax_number" value="">
									</div>
								</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="tin_number">TIN: </label>
									<input type="number" class="form-control" name="tin_number" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for=""><i class="fa fa-upload" aria-hidden="true"></i> Supplier Logo </label>
									<div class="uploadfile-container2">
										<input class="input-file" name="logo" id="my-file" type="file" accept="image/* ">
										<p class="file-return"></p>
									</div>
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

				<!--view supplier modal -->
				<div class="modal fade" id="viewSupplier" tabindex="-1" role="dialog" aria-	labelledby="exampleModalLabel" aria-hidden="true">\
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header bg-info1">
									<h5 class="modal-title" id="exampleModalLabel"> View Supplier Details</h5>
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
									</div>
									<div class="table-responsive purch_prod">
												<table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="view_supplier_contact_details">
													<thead>
														<th class="header-title supp">Name</th>
														<th class="header-title supp">Mobile Number </span></th>
														<th class="header-title supp">Email </span></th>
														<th class="header-title supp">Position </span></th>

													</thead>
													<tbody>
														<tr>
															<!-- <td class="purch_td">
																<input type="text" class="form-control" name="prod_name[]" value="">
																<span class="err"></span>
															</td>
															<td class="purch_td">
																<input type="number" class="form-control purchase_quantity" name="quantity[]" value="">
																<span class="err"></span>
															</td>
															<td class="purch_td">
																<input type="number" class="form-control purchase_price" name="unit_price[]" value="">
																<span class="err"></span>
															</td>
															<td class="purch_td">
																<input type="number" class="form-control purchase_total" name="total[]" value="" readonly>
																<span class="err"></span>
															</td> -->
														</tr>
													</tbody>
												</table>
									</div>
								<div class = "row">
											<div class="col-6">
													<label for="company">Company: </label>
													<p class="company"> </p>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="email">Email: </label>
												<p class="email"> </p>
											</div>
										</div>
									</div>
							<div class = "row">
								<div class="col-6">
									<div class="form-group">
										<label for="address">Address:</label>
										<p class="address"> </p>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="tin_number">TIN:</label>
										<p class="tin_number"> </p>
									</div>
								</div>
							</div>
							<div class="row">
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
				<!-- End of view Supplier -->

				<!-- Modal Edit supplier-->
				<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
					<form id="editSupplier" class = "editcompany" method="post">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header bg-info1">
									<h5 class="modal-title" id="exampleModalLabel"> Edit Supplier</h5>
									<input type="hidden" class="form-control supplierID" name="supplier_id" value="">
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
									</div>
									<hr>
											<span class="btn btn-sm btn-primary" id="addnewCP"><i class="fa fa-plus"></i> Supplier Contact Person</span>
										<br>
										<div class="table-responsive view_supplier_contact_details">
													<table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="add_contact_person">
														<thead>
																<th class="header-title supp">Name</th>
																<th class="header-title supp">Mobile Number</span></th>
																<th class="header-title supp">Email </th>
																<th class="header-title supp">Position </th>
														</thead>
														<tbody>

																<tr>
																	<td class="supp_td">
																		<input type="text" class="form-control contact_person" name="contact_name[]" value="">
																		<span class="err"></span>
																	</td>
																	<td class="supp_td">
																		<input type="number" class="form-control contact_mobileno" name="mobile_number[]" value="">
																		<span class="err"></span>
																	</td>
																	<td class="supp_td">
																		<input type="text" class="form-control contact_email" name="contact_email[]" value="">
																		<span class="err"></span>
																	</td>
																	<td class="supp_td">
																		<input type="text" class="form-control supp_position" name="supp_position[]" value="">
																		<span class="err"></span>
																	</td>
																</tr>

														</tbody>
													</table>
										</div>
										<hr>
									<div class="row">
										<div class="col-6">
												<div class="form-group">
														<label for="companytitle">Company</label>
															<div class="select2-purple">
																<select class="form-control js-example-basic-multiple-edit" name="company[]" multiple="multiple">
												 				</select>
															</div>
															<span class="err"></span>
											</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="email">Email:</label>
											<input type="email" class="form-control" name="email" value="">
											<span class="err"></span>
										</div>
									</div>
								</div>
								<div class = "row">
									<div class="col-6">
										<div class="form-group">
											<label for="address">Address:</label>
											<input type="text" class="form-control" name="address" value="">
											<span class="err"></span>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label for="office_number">Office Number:</label>
											<input type="number" class="form-control" name="office_number" value="">
										</div>
									</div>
							</div>
							<div class = "row">
								<div class="col-6">
									<div class="form-group">
										<label for="fax_number">Fax Number:</label>
										<input type="number" class="form-control" name="fax_number" value="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="tin_number">TIN:</label>
										<input type="number" class="form-control" name="tin_number" value="">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group filecontent">
											<label for=""><i class="fa fa-upload" aria-hidden="true"></i> Supplier Logo </label>
											<div class="uploadfile-container2">
												<button type="button">Choose File</button>
												<span class = "filechosen" >No file chosen</span>
												<p class="file-return"></p>
											</div>
										</div>
										<div class="form-group uploadfile">
											<label for="SupplierLogo"><i class="fa fa-upload" aria-hidden="true"></i> Supplier Logo </label>
											<div class="uploadfile-container2">
												<input class="input-file my-file" name="logo" id="my-file" type="file" accept="image/*">
												<p class="file-return"></p>
											</div>
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
					<div class="middle">
						<div class="">
								<a href="javascript:;" class="btn-newj t_btn" data-id="0">All Suppliers</a>
						</div>
						<div class="">
								<a href="javascript:;" class="btn-newj f_btn" data-id="1">New Jiandra</a>
						</div>
						<div class="">
								<a href="javascript:;" class="btn-newj s_btn" data-id="2">Mrs. P Mktg</a>
						</div>

						<!-- <button class="button company1" data-id="1">New Jiandra</button>
						<button class="button company1" data-id="2">Mrs.P Mktg</button> -->
					</div>
					<div class="row">
						<div class="table-responsive">
						<div class="col-sm-12">
							<table id="example1" class="table table-bordered table-striped dataTable suppliers_tbl" role="grid" aria-describedby="example1_info">
								<thead>
								<th class="header-title">Logo</th>
								<th class="header-title">Name</th>
								<th class="header-title">Email</th>
								<th class="header-title">Action</th>
								<th class="header-title">Status</th>
							</thead>
							</table>

						</div>
					</div>
					</div>

				</div>
			</div>
		</div>

		<!-- /.card-body -->
	</div>
