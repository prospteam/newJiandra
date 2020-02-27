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
            <button class="users stockmovement button1 float-sm-right" data-toggle="modal"><i class="fas fa-truck-loading" aria-hidden="true"></i> Stock Movement </button>
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


                <!-- Modal for Stock Out-->

                <div class="modal fade" id="StockMovement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <form id="stockmovement" method="post">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-info1">
                          <h5 class="modal-title" id="exampleModalLabel">Stock Movement</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php foreach($stockmovement as $k => $value) :  ?>
                            <input type="hidden" class="form-control" name="stockmovement_id" value="<?php echo $value['stockmovement_code']?>">
                        <?php  endforeach; ?>
                        <div class="modal-body">
                          <div class="form-horizontal">
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
                          </div>
                          <div class="form-horizontal">
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
                          </div>

                          <div class="form-horizontal from_warehouse" style="display:none">
                              <div class="form-group row m-b-10">
                              <label for="so_datedelivered" class="col-md-12 col-lg-4 col-form-label">From Warehouse: <span class="text-red">*</span></label>
                              <div class="col-lg-8 col-md-12">
                                  <div class="input-group m-b-0">
                                      <select class="form-control" id="from_warehouse" class="from_warehouse" name="from_warehouse" >
                                        <option value="" selected hidden>Select From Warehouse</option>
                                      <?php foreach($from_warehouse as $k => $value) : ?>
                                          <option class="from_warehouse_opt" value="<?php echo $value['warehouse_id'] ?>"><?php echo $value['wh_name'] ?></option>
                                    <?php  endforeach; ?>
                                  </select>
                                      <span class="err"></span>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-horizontal to_warehouse" style="display:none">
                              <div class="form-group row m-b-10">
                              <label for="so_datedelivered" class="col-md-12 col-lg-4 col-form-label">Transfer to Warehouse: <span class="text-red">*</span></label>
                              <div class="col-lg-8 col-md-12">
                                  <div class="input-group m-b-0">
                                      <select class="form-control" class="warehouse" name="warehouse" >
                                        <option value="" selected hidden>Select To Warehouse</option>
                                      <?php foreach($to_warehouse as $k => $value) : ?>
                                          <option value="<?php echo $value['id'] ?>"><?php echo $value['wh_name'] ?></option>
                                    <?php  endforeach; ?>
                                  </select>
                                      <span class="err"></span>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-horizontal">
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
                          </div>
                          <hr>



                          <!--when stock movement type is stock transfer -->
                          <div class="table-responsive view_purchase_orders_details" id="stock_transfer_movement">
                                <table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="add_new_product">
                                  <thead>
                                      <th class="header-title purch">SKU <span class="required">*</span></th>
                                      <th class="header-title purch">Product <span class="required">*</span></th>
                                      <th class="header-title purch">Remaining Stocks <span class="required">*</span></th>
                                      <th class="header-title purch">Quantity <span class="required">*</span></th>


                                  </thead>
                                  <tbody>

                                      <tr>
                                        <td class="purch_td" >
                                          <select class="form-control stock_prod_code select2" id="wh_stock_code" style="width: 100%;" name="wh_prod_code[]" disabled>
                                            <!-- <option value="">Select SKU</option> -->
                                            <?php
                                                // foreach($products as $key => $value){
                                                //     echo '<option value="'.$value['product'].'" data-stock="'.$value['stock_id'].'">'.$value['code'].'</option>';
                                                // }

                                            ?>
                                          </select>
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td" style="display:none">
                                            <input type="text" class="form-control stock_id" name="stock_id[]" value="" readonly>
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                            <input type="text" class="form-control prod_name" name="prod_name[]" value="" readonly>
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                            <input type="text" class="form-control remaining_stocks" name="remaining_stocks[]" value="" readonly>
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                          <input type="text" class="form-control purchase_quantity sm_quantity number_only" name="quantity[]" value="">
                                          <span class="err"></span>
                                        </td>
                                      </tr>

                                  </tbody>
                                </table>
                          </div>
                          <!--end -->
                          <span class="btn btn-sm btn-primary" id="addNewSO"><i class="fa fa-plus"></i> Add Product</span>
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
        									<button type="submit" class="btn btn-primary add">Submit</button>
        								</div>
                        </div>
                        </div>
                      </div>
                    </form>
                    </div>
                    <!-- end of Stock out-->
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
                    <th class="header-title">Warehouse</th>
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
