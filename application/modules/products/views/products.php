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
    												<!-- <input type="text" class="form-control" name="brand" value=""> -->
                            <select class="form-control js-example-basic-multiple-addproducts"  name="brand" id="brand" data-type="brand">
                              <option></option>
                          </select>
                            <span class="err"></span>
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-6">
    											<div class="form-group">
    												<label for="category">Category: <span class="required">*</span></label>
    												<!-- <input type="text" class="form-control" name="category" value=""> -->
                            <select class="form-control js-example-basic-multiple-addproducts"  name="category" id="category" data-type="category">
                              <option></option>
                          </select>
                            <span class="err"></span>
    											</div>
    										</div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="variant">Variant: <span class="required">*</span></label>
                            <!-- <input type="text" class="form-control" name="variant" value=""> -->
                            <select class="form-control js-example-basic-multiple-addproducts"  name="variant" id="variant" data-type="variant">
                              <option></option>
                          </select>
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

          <!--View Products Modal -->
          <!-- Modal -->
            <div class="modal fade" id="viewproducts" tabindex="-1" role="dialog" aria-	labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel"> View Products Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="code">Code:</label>
                          <p class="code"> </p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="brand">Brand:</label>
                          <p class="brand"> </p>
                        </div>
                      </div>
                    </div>
                  <div class = "row">
                        <div class="col-6">
                            <label for="category">Category: </label>
                            <p class="category"> </p>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="variant">Variant: </label>
                          <p class="variant"> </p>
                        </div>
                      </div>
                    </div>
                <div class = "row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="description">Description:</label>
                      <p class="description"> </p>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="price">Price:</label>
                      <p class="price"> </p>
                    </div>
                  </div>
                  <div class = "row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="volume">Volume:</label>
                            <p class="volume"> </p>
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
                  </div>
                </div>
              </div>
          </div>
        <!-- End View user Modal -->

        <!--View Edit Modal -->
        <!-- Modal -->
        <div class="modal fade" id="editProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
          <form id="editProducts" method="post">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info1">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
                  	<input type="hidden" class="form-control editproducts_id" name="editproducts_id" value="">
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
                        <label for="brand1">Brand: <span class="required">*</span></label>
                        <!-- <input type="text" class="form-control" name="brand" value=""> -->
                        <select class="form-control js-example-basic-multiple-editproducts"  name="brand" id="brand1" data-type="brand">
                          <option></option>
                      </select>
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="category1">Category: <span class="required">*</span></label>
                        <!-- <input type="text" class="form-control" name="category" value=""> -->
                        <select class="form-control js-example-basic-multiple-editproducts"  name="category" id="category1" data-type="category">
                          <option></option>
                      </select>
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="variant1">Variant: <span class="required">*</span></label>
                        <!-- <input type="text" class="form-control" name="variant" value=""> -->
                        <select class="form-control js-example-basic-multiple-editproducts"  name="variant" id="variant1" data-type="variant">
                          <option></option>
                      </select>
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
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary add">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
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
                      <th class="header-title">Price</th>
                      <th class="header-title">Volume</th>
                      <th class="header-title">Action</th>
                      <th class="header-title">Status</th>
                  </thead>
                  <tbody>

                </tbody>
                </table>
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
