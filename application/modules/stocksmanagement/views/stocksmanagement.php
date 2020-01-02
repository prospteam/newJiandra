<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Stock Management</h1>
          INVENTORY MANAGEMENT > <span class="active1"> STOCK MANAGEMENT </p>
        </div>
        <div class="col-sm-6">
            <button class="users generatereport button1 float-sm-right" data-toggle="modal"><i class="fas fa-file" aria-hidden="true"></i> Generate Report </button>

            <!-- Modal for View Products-->

            <div class="modal fade" id="GenerateReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form id="generateReport" method="post">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-info1">
                      <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="table-responsive purch_prod">
                            <table class="table table-bordered table-striped purch_prod" role="grid" aria-describedby="example1_info" id="view_stocks_products">
                              <thead>
                                  <th class="header-title purch">Item Code</th>
                                  <th class="header-title purch">Product</th>
                                  <th class="header-title purch">Quantity On hand </th>
                                  <th class="header-title purch">Physical Count</th>
                                  <th class="header-title purch">Notes </th>

                              </thead>
                              <tbody>
                                <tr>

                                </tr>
                              </tbody>
                            </table>
                      </div>
                      <div class="modal-footer">
      									<button type="submit" class="btn btn-primary add">Submit</button>
      								</div>
                    </div>
                    </div>
                  </div>
                </form>
                </div>
                <!-- end of view products-->
        </div>

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
                    <table class="table table-bordered table-striped dataTable stocks_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                    <th class="header-title">Item Code</th>
                    <th class="header-title">Principal Name</th>
                    <th class="header-title">Brand</th>
                    <th class="header-title">Description</th>
                    <th class="header-title">Packing</th>
                    <th class="header-title">Inventory Date</th>
                    <th class="header-title">Quantity On hand</th>
                    <th class="header-title">Physical Count</th>
                    <th class="header-title">Variance</th>
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
            </div>
              </div>
              <!-- /.card-body -->
            </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
