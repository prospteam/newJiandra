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
            <button class="users stockout button1 float-sm-right" data-toggle="modal"><i class="fas fa-truck-loading" aria-hidden="true"></i> Stock Out </button>
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

                <div class="modal fade" id="StockOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <form id="stockout" method="post">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-info1">
                          <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-horizontal">
                              <div class="form-group row m-b-10">
                              <label for="sodate" class="col-md-12 col-lg-4 col-form-label">Stock Out Date: <span class="text-red">*</span></label>
                              <div class="col-lg-8 col-md-12">
                                  <div class="input-group m-b-0">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                      </div>
                                      <input type="text" class="form-control disabled-normal total_cost" name="sodate" value="<?php echo date('F d, Y'); ?>" readonly="" disabled="">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-horizontal">
                              <div class="form-group row m-b-10">
                              <label for="so_datedelivered" class="col-md-12 col-lg-4 col-form-label">Warehouse: <span class="text-red">*</span></label>
                              <div class="col-lg-8 col-md-12">
                                  <div class="input-group m-b-0">
                                      <select class="form-control" class="warehouse" name="warehouse" >
                                        <option value="" selected hidden>Select Warehouse</option>
                                      <?php foreach($warehouse as $k => $value) : ?>
                                          <option value="<?php echo $value['warehouse_id'] ?>"><?php echo $value['warehouse_name'] ?></option>
                                    <?php  endforeach; ?>
                                  </select>
                                      <span class="err"></span>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group" id="show_supplier">
        											</div>
        										</div>
                            <div class="col-6">
                              <div class="form-group" id="show_warehouse">
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
                                      <input type="text" class="form-control disabled-normal total_cost" name="so_datedelivered" value="<?php echo date('F d, Y'); ?>" readonly="" disabled="">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <hr>
                              <span class="btn btn-sm btn-primary" id="addNewPO"><i class="fa fa-plus"></i> Add Product</span>
                            <br>

                          <div class="table-responsive view_purchase_orders_details">
                                <table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="add_new_product">
                                  <thead>
                                      <th class="header-title purch">SKU <span class="required">*</span></th>
                                      <th class="header-title purch">Product <span class="required">*</span></th>
                                      <th class="header-title purch">Quantity <span class="required">*</span></th>
                                      <th class="header-title purch">Unit Price <span class="required">*</span></th>
                                      <th class="header-title purch">Total <span class="required">*</span></th>

                                  </thead>
                                  <tbody>

                                      <tr>
                                        <td class="purch_td">
                                          <select class="form-control code select2" style="width: 100%;" name="prod_code[]">
                                            <option value="">Select SKU</option>
                                            <?php
                                                foreach($products as $key => $value){
                                                    echo '<option value="'.$value['id'].'">'.$value['code'].'</option>';
                                                }
                                            ?>
                                          </select>
                                          <!-- <input type="text" class="form-control" name="prod_name[]" value=""> -->
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                            <input type="text" class="form-control prod_name" name="prod_name[]" value="">
                                          <!-- <input type="text" class="form-control" name="prod_name[]" value=""> -->
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                          <input type="number" class="form-control purchase_quantity" name="quantity[]" value="">
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                          <input type="text" class="form-control purchase_price" name="unit_price[]" value="">
                                          <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                          <input type="number" class="form-control purchase_total" name="total[]" value="" readonly>
                                          <span class="err"></span>
                                        </td>
                                      </tr>

                                  </tbody>
                                </table>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-6">
                                  <label for="note">Note: </label>
                                  <textarea rows="4" cols="50" class="form-control" name="purchase_note" value=""></textarea>
                            </div>
                            <div class="col-md-12 col-lg-6 order-md-2">
                                            <div class="form-horizontal">
                                                <div class="form-group row m-b-10">
                                                    <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Quantity <span class="text-red">*</span></label>
                                                    <div class="col-lg-8 col-md-12">
                                                        <input type="text" class="form-control disabled-normal total_quantity" name="total_quantity" readonly="" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-horizontal">
                                                <div class="form-group row m-b-10">
                                                    <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Cost <span class="text-red">*</span></label>
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="input-group m-b-0">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control disabled-normal total_cost" name="total_cost" readonly="" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-horizontal">
                                                <div class="form-group row m-b-10">
                                                    <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Grand Total <span class="text-red">*</span></label>
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="input-group m-b-0">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control disabled-normal grand_total" name="grand_total" readonly="" disabled="">
                                                        </div>
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
