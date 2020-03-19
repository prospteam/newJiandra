<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Stock Receive</h1>
          STOCK MANAGEMENT > <span class="active1"> STOCK RECEIVE </p>
        </div>
        <div class="col-sm-6">
            <!--View stock receive Modal -->
            <!-- Modal -->
            <div class="modal fade" id="ViewStockReceive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form id="add_transfer_qty" method="post">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-info1">
                      <h5 class="modal-title" id="exampleModalLabel">View to Transferred Products</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="stockOutProducts">
                      <div class="row">
                        <div class="col-6">
                          <h1 class="inp_head">#<span class="code"></span> </h1> <br>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="date_ordered">Date:</label>
                              <p class="date_ordered"></p> <br>
                          </div>
                        </div>
                        <div class="col-6">
                          <label for="date_delivered">Date Delivered:</label>
                            <p class="date_delivered"></p> <br>
                          </div>
                        </div>
                            <div class="table-responsive view_purchase_orders_details" id="view_stockreceive">
                                  <table class="table table-bordered table-striped stocks purchase" role="grid" aria-describedby="example1_info" id="add_new_product">
                                    <thead>
                                        <th class="header-title purch">SKU </th>
                                        <th class="header-title purch">Product </th>
                                        <th class="header-title purch">Transferred Stocks </th>
                                        <th class="header-title purch">Actual Quantity </th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                  </table>
                            </div>
                            <hr>
                      <div class="row summary">
                        <div class="col-6">
                              <label for="note">Note: </label>
                              <p class="note"></p> <br>
                        </div>
                        <div class="col-md-12 col-lg-6 order-md-2">
                            <div class="form-horizontal">
                                <div class="form-group row m-b-10">
                                    <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Total Quantity</label>
                                    <div class="col-lg-8 col-md-12">
                                        <input type="text" class="form-control disabled-normal qty" readonly="" disabled="" value="">
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
                  </div>
              </form>
            </div>
          <!-- End View stock receive Modal -->
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
                                <table class="table table-bordered table-striped dataTable stocksreceive_tbl" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <th class="header-title">Code</th>
                                        <th class="header-title">Date</th>
                                        <th class="header-title">Stock From</th>
                                        <th class="header-title">Stock To</th>
                                        <th class="header-title">Delivery Date</th>
                                        <th class="header-title">Status</th>
                                        <th class="header-title">Action</th>
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
