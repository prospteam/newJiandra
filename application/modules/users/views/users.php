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
          <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddUser"><i
              class="fas fa-plus-circle" aria-hidden="true"></i> Add User </button>

          <!--Add User Modal -->
          <!-- Modal -->
          <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">\
            <form id="adduser" method="post">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="fullname">Full Name: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="fullname" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="username">Username: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="username" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="password">Password: <span class="required">*</span></label>
                          <input type="password" class="form-control" name="password" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="position">Position: <span class="required">*</span></label>
                          <!-- <input type="text" class="form-control" name="position" value=""> -->
                          <select class="form-control" class="position" id="position" name="position">
                            <option value="" selected hidden>Select Position</option>
                            <?php foreach($position as $k => $value) : ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['position_name'] ?></option>
                            <?php  endforeach; ?>
                          </select>
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>

                    <div class="row company">
                      <div class="col-12">
                        <div class="form-group">
                          <div class="select2-purple">
                            <label for="company">Companies: <span class="required">*</span></label>
                            <select class="form-control js-example-basic-multiple-addU" name="company[]"
                              multiple="multiple"></select>
                            <span class="err"></span>
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
          <!-- End Add user Modal -->

          <!--View User Modal -->
          <!-- Modal -->
          <div class="modal fade" id="ViewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">\

            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info1">
                  <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="userDetails">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <p class="name"> </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="username">Username:</label>
                        <p class="username"> </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="username">Password:</label>
                        <p class="password"> </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="position">Position:</label>
                        <p class="position"> </p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="company">Companies:</label>
                        <p class="company"> </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- End View user Modal -->

          <!--View Edit Modal -->
          <!-- Modal -->
          <div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">\
            <form id="edituser" method="post">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <input type="hidden" class="form-control userID" name="user_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="fullname">Full Name: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="fullname">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="username">Username: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="username">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="password">Password: <span class="required">*</span></label>
                          <input type="password" class="form-control" name="password">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="position">Position: <span class="required">*</span></label>
                          <!-- <input type="text" class="form-control" name="position" value=""> -->
                          <select class="form-control" class="position" name="position" id="edit_position"
                            placeholder="Select Position">
                            <!-- <option value="">Select Position</option> -->
                            <?php foreach($position as $k => $value) : ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['position_name'] ?></option>
                            <?php  endforeach; ?>
                          </select>
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row company">
                      <div class="col-12">
                        <div class="form-group">
                          <div class="select2-purple">
                            <label for="company">Companies: <span class="required">*</span></label>
                            <select class="form-control js-example-basic-multiple-editU" name="company[]"
                              multiple="multiple"></select>
                            <span class="err"></span>
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
          <!-- End Edit user Modal -->

          <!--View Delete Modal -->
          <!-- Modal -->
          <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">\
            <form id="adduser" method="post">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash" style="color:black"
                        aria-hidden="true"></i> Delete User</h5>
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
                <table class="table table-bordered table-striped dataTable users_tbl" role="grid"
                  aria-describedby="example1_info">
                  <thead>

                    <th class="header-title">Name</th>
                    <th class="header-title">Username</th>
                    <th class="header-title">Position</th>
                    <th class="header-title">Company</th>
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
