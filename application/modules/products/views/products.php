<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> PRODUCTS</h1>
          HOME > <span class="active1"> PRODUCTS </p>
        </div>
        <div class="col-sm-6">
            <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddProducts"><i class="fas fa-plus-circle" aria-hidden="true"></i>  Add Products </button>

            <!--Add User Modal -->
            <!-- Modal -->
    				<div class="modal fade" id="AddProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
    					<form id="addproducts" method="post">
    						<div class="modal-dialog modal-lg" role="document">
    							<div class="modal-content">
    								<div class="modal-header bg-info1">
    									<h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
    									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
    									</button>
    								</div>
    								<div class="modal-body">
    									<div class="row">
    										<div class="col-6">
    											<div class="form-group">
    												<label for="code">Code: <span class="required">*</span></label>
    												<input type="text" class="form-control" name="code" value="">
                            <span class="err"></span>
    											</div>
    										</div>
    										<div class="col-6">
    											<div class="form-group">
    												<label for="brand">Brand: <span class="required">*</span></label>
    												<input type="text" class="form-control" name="brand" value="">
                            <span class="err"></span>
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-6">
    											<div class="form-group">
    												<label for="category">Category: <span class="required">*</span></label>
    												<input type="text" class="form-control" name="category" value="">
                            <span class="err"></span>
    											</div>
    										</div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="variant">Variant: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="variant" value="">
                            <span class="err"></span>
                          </div>
                        </div>
    									</div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="description">Description: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="description" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="price">Price: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="price" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="volume">Volume:</label>
                            <input type="text" class="form-control" name="volume" value="">
                          </div>
                        </div>
                        <!-- <div class="col-lg-6">
                          <div class="form-group">
                            <label for=""><i class="fa fa-upload" aria-hidden="true"></i> Add raw file </label>
                            <div class="uploadfile-container2">
                              <input class="input-file" name="logo" id="my-file" type="file" accept="image/* ">
                              <p class="file-return"></p>
                            </div>
                          </div>
                        </div> -->
                      </div>




    								</div>
    								<div class="modal-footer">
    									<button type="submit" class="btn btn-primary add">Submit</button>
    								</div>
    							</div>
    						</div>
    					</form>
    				</div>
          <!-- End Add user Modal -->

          <!--View User Modal -->
          <!-- Modal -->

        <!-- End View user Modal -->

        <!--View Edit Modal -->
        <!-- Modal -->

      <!-- End Edit user Modal -->

      <!--View Delete Modal -->
      <!-- Modal -->
      <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
        <form id="adduser" method="post">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash" style="color:black" aria-hidden="true"></i>  Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h1>OKKK</h1>
              </div>
            </div>
          </div>
        </form>
      </div>
    <!-- End Add Delete Modal -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
              <!-- /.card-header -->
              <div class="card-body1">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">.
                  <div class="table-responsive">
                  <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable products_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                      <th class="header-title">Code</th>
                      <th class="header-title">Brand</th>
                      <th class="header-title">Category</th>
                      <th class="header-title">Variant</th>
                      <th class="header-title">Description</th>
                      <th class="header-title">Price</th>
                      <th class="header-title">Volume</th>
                      <th class="header-title">Action</th>
                      <th class="header-title">Status</th>
                    <!-- <tr class="table-header" role="row">
                      <th class="header-title sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 283px;">Name</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 359px;">Company</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">Type</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Action</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Status</th>
                    </tr> -->
                  </thead>
                  <tbody>

                </tbody>
                </table>
                </div>
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
                        <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
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
              <!-- /.card-body -->
            </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
