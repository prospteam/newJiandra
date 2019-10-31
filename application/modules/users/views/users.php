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
            <button class="button1 float-sm-right" data-toggle="modal" data-target="#AddUser"><i class="fas fa-plus-circle" aria-hidden="true"></i> Add User </button>

            <!--Add User Modal -->
          <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="modal-title card-title" id="exampleModalLabel">Add Supplier</h3>
                      </div>
                    </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" value="">
                    <label for="username">Username:</label>
                    <input type="text" name="supplier_contact_person" value="">
                    <label for="company">Company:</label>
                    <input type="text" name="company" value="">
                    <label for="vendor">Vendor:</label>
                    <input type="text" name="vendor" value="">
                    <label for="office_number">Office Number:</label>
                    <input type="text" name="office_number" value="">
                    <label for="home_phone">Home Phone:</label>
                    <input type="text" name="home_phone" value="">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" name="mobile_number" value="">
                    <label for="tin">TIN:</label>
                    <input type="text" name="tin" value="">
                    <label for="tin">Fax Number:</label>
                    <input type="text" name="fax_number" value="">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
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
                <div class="row">.
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr class="table-header" role="row">
                      <th class="header-title sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 283px;">Name</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 359px;">Company</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 320px;">Type</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Action</th>
                      <th class="header-title sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 176px;">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr role="row" class="odd">
                      <td class="table-data sorting_1">Gecko</td>
                      <td class="table-data">Firefox 1.0</td>
                      <td class="table-data">1.7</td>
                      <td class="action"><i class="fas fa-pen"></i> <i class="fa fa-trash" aria-hidden="true"></i></td>
                      <td class="table-data"><button type="button" class="inactive btn btn-block btn-danger">inactive</button></td>
                    </tr>
                    <tr role="row" class="odd">
                      <td class="sorting_1">Gecko</td>
                      <td class="table-data">Firefox 1.0</td>
                      <td class="table-data">1.7</td>
                      <td class="action"><i class="fas fa-pen"></i> <i class="fa fa-trash" aria-hidden="true"></i></td>
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
