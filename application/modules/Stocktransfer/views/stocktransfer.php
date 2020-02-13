<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Stock Transfer</h1>
          STOCK MANAGEMENT > <span class="active1"> STOCK TRANSFER </p>
        </div>
        <div class="col-sm-6">
           <div class="modal fade" id="editStockTransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form id="editstocktransfer" method="post">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Stock Transfer</h5>
                    <input type="hidden" class="form-control stockout_id" name="stockout_id" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
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
                    <div class="form-horizontal warehouse" style="display:none">
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


                    <div class="table-responsive view_stock_transfer1">
                          <table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="view_stock_transfer">
                            <thead>
                                <th class="header-title purch">SKU <span class="required">*</span></th>
                                <th class="header-title purch">Product <span class="required">*</span></th>
                                <th class="header-title purch">Remaining Stocks <span class="required">*</span></th>
                                <th class="header-title purch">Quantity <span class="required">*</span></th>


                            </thead>
                            <tbody>

                                <!-- <tr>
                                  <td class="purch_td">
                                    <select class="form-control js-example-basic-multiple-editStockTransfer select2" style="width: 100%;" name="prod_code[]">
                                      <option value="">Select SKU</option> -->
                                      <?php
                                          //foreach($products as $key => $value){
                                             // echo '<option value="'.$value['product'].'">'.$value['code'].'</option>';
                                          // }
                                      ?>
                                    <!-- </select>

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
                                </tr> -->

                            </tbody>
                          </table>
                    </div>
                    <span class="btn btn-sm btn-primary" id="addNewSTransfer_edit"><i class="fa fa-plus"></i> Add Product</span>
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

                <!-- Modal for Stock Out-->

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
                    <table class="table table-bordered table-striped dataTable stocksmov_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                    <th class="header-title">Date</th>
                    <th class="header-title">Transferred Warehouse</th>
                    <th class="header-title">Date Delivered</th>
                    <th class="header-title">Product</th>
                    <th class="header-title">Quantity</th>
                    <th class="header-title">Note</th>
                    <th class="header-title">Actions</th>
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
            </div>
              </div>
              <!-- /.card-body -->
            </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
