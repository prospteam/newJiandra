<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Stock Autoloading</h1>
          INVENTORY MANAGEMENT > <span class="active1"> STOCK AUTOLOADING </p>
        </div>
        <div class="col-sm-6">
           <div class="modal fade" id="editStockOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form id="editstockout" method="post">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Stock Out</h5>
                    <input type="hidden" class="form-control stockout_id" name="stockout_id" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- <div class="form-horizontal">
                        <div class="form-group row m-b-10">
                        <label for="sodate" class="col-md-12 col-lg-4 col-form-label"> Date: <span class="text-red">*</span></label>
                        <div class="col-lg-8 col-md-12">
                            <div class="input-group m-b-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" name="sodate" value="<?php echo date('F d, Y'); ?>">
                            </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="form-horizontal">
                        <div class="form-group row m-b-10">
                        <label for="so_datedelivered" class="col-md-12 col-lg-4 col-form-label">Type: <span class="text-red">*</span></label>
                        <div class="col-lg-8 col-md-12">
                            <div class="input-group m-b-0">
                                <select class="form-control" id="so_type" class="so_type" name="so_type" >
                                  <option value="" selected hidden>Select Type</option>
                                  <option value="1">Stock Out</option>
                                  <option value="2">Stock Transfer</option>
                            </select>
                            <span class="err"></span>
                            </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="form-horizontal warehouse" style="display:none">
                        <div class="form-group row m-b-10">
                        <label for="so_datedelivered" class="col-md-12 col-lg-4 col-form-label">Warehouse: <span class="text-red">*</span></label>
                        <div class="col-lg-8 col-md-12">
                            <div class="input-group m-b-0">
                                <select class="form-control" class="warehouse" name="warehouse" >
                                  <option value="" selected hidden>Select Warehouse</option>
                                <?php foreach($warehouse as $k => $value) : ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['wh_name'] ?></option>
                              <?php  endforeach; ?>
                            </select>
                                <span class="err"></span>
                            </div>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="form-horizontal">
                        <div class="form-group row m-b-10">
                        <label for="so_datedelivered" class="col-md-12 col-lg-4 col-form-label">Date Delivered: <span class="text-red">*</span></label>
                        <div class="col-lg-8 col-md-12">
                            <div class="input-group m-b-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" name="so_datedelivered" value="<?php echo date('F d, Y'); ?>">
                            </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="table-responsive view_stock_transfer1">
                          <table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="view_stock_out">
                            <thead>
                                <th class="header-title purch">SKU <span class="required">*</span></th>
                                <th class="header-title purch">Product <span class="required">*</span></th>
                                <th class="header-title purch">Remaining Stocks <span class="required">*</span></th>
                                <th class="header-title purch">Quantity <span class="required">*</span></th>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                    </div>
                    <span class="btn btn-sm btn-primary" id="addNewStockOut_edit"><i class="fa fa-plus"></i> Add Product</span>
                  <br>
                    <hr>
                    <div class="row">
                      <div class="col-6">
                            <label for="note">Note: </label>
                            <textarea rows="4" cols="50" class="form-control" name="stockmovement_note" value=""></textarea>
                      </div>
                      <div class="col-6">
                        <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Total Quantity <span class="text-red">*</span></label>
                            <input type="text" class="form-control disabled-normal total_quantity" name="total_quantity" readonly="" disabled="">

                      </div>

                        </div>
                  <br>
                        <div class="modal-footer">
                           <button type="submit" class="btn btn-primary add" id="edit_submit">Submit</button>
                        </div>
                  </div>
                  </div>
                </div>
              </form>
              </div>
        </div>
        </div>

        <!--View User Modal -->
        <!-- Modal -->
        <div class="modal fade" id="ViewStockout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info1">
                  <h5 class="modal-title" id="exampleModalLabel">View Stock Autoloading</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="stockOutProducts">
                    <div class="form-group">
                        <label for="">Date Stock Load</label>
                        <input type="text" name="" class="form-control date_load" readonly value="">
                    </div>
                    <div class="form-group">
                        <label for="">Note</label>
                        <textarea name="stockloading_note" readonly class="form-control stockloading_note" rows="8" cols="80"></textarea>
                    </div>
                </div>
              </div>
            </div>

      <!-- End View user Modal -->

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
                    <table class="table table-bordered table-striped dataTable stockout_tbl" role="grid" aria-describedby="example1_info">
                      <thead>
                        <th class="header-title">Date Transferred</th>
                        <th class="header-title">Stock Code</th>
                        <th class="header-title">Product</th>
                        <th class="header-title">Quantity</th>
                        <th class="header-title">More Details</th>
                        <!-- <th class="header-title">Status</th> -->
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
