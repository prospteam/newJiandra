<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Users</h1>
          ENROLLMENT > <span class="active1"> USERS </p>
        </div>
        <div class="col-sm-6">
            <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddUser"><i class="fas fa-plus-circle" aria-hidden="true"></i>  Add User </button>

            <!--Add User Modal -->
            <!-- Modal -->
    				<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
    					<form id="adduser" method="post">
    						<div class="modal-dialog modal-lg" role="document">
    							<div class="modal-content">
    								<div class="modal-header">
    									<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus" style="color:black" aria-hidden="true"></i>  Add User</h5>
    									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
    									</button>
    								</div>
    								<div class="modal-body">
    									<div class="row">
    										<div class="col-6">
    											<div class="form-group">
    												<label for="fullname">Full Name:</label>
    												<input type="text" class="form-control" name="fullname" value="" required>
    											</div>
    										</div>
    										<div class="col-6">
    											<div class="form-group">
    												<label for="username">Username:</label>
    												<input type="text" class="form-control" name="username" value="" required>
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-6">
    											<div class="form-group">
    												<label for="password">Password:</label>
    												<input type="password" class="form-control" name="password" value="" required>
    											</div>
    										</div>
    										<div class="col-6">
    											<div class="form-group">
    												<label for="position">Position:</label>
    												<input type="text" class="form-control" name="position" value="" required>
    											</div>
    										</div>
    									</div>
    								<div class = "row">
    								   <div class="col-6">
    									<div class="form-group">
    										<label for="company">Company:</label>
                        <select class="form-control js-example-basic-multiple" name="company[]" multiple="multiple"></select>
                    <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection">
                      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false">
                        <ul class="select2-selection__rendered">
                          <li class="select2-search select2-search--inline">
                            <input class="select2-search__field form-control" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select Company">
                          </li>
                        </ul>
                      </span>
                    </span>
                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                  </span> -->

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
          <!-- End Add user Modal -->
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
                  <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable users_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                    <th class="header-title">Name</th>
                    <th class="header-title">Company</th>
                    <th class="header-title">Position</th>
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
              <!-- <div class="row">
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
              </div> -->
            </div>
              </div>
              <!-- /.card-body -->
            </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
