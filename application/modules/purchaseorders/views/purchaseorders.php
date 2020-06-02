<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Purchase Order</h1>
                    HOME > <span class="active1"> VIEW PURCHASE ORDER </p>
                </div>
                <div class="col-sm-6">
                    <!-- <button class="users button1 float-sm-right purchase-order-btn" data-toggle="modal" data-target="#AddPurchaseOrder"><i
                            class="fas fa-plus-circle" aria-hidden="true"></i> Purchase Order </button> -->
                            <!-- <form class="" id="import_cs_po" method="post">
                                <div class=" form-group">
                                    <input type="file" name="csv_file_po" value="">
                                </div>
                                <input class="" type="submit" id="import_csv_btn" name="csv_submit" value="Import CSV">
                            </form> -->
                    <!--Add User Modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="AddPurchaseOrder" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form id="addpurchaseorder" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Purchase Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php foreach($purchase as $k => $value) :  ?>

                                    <input type="hidden" class="form-control" name="purchase_id"
                                        value="<?php echo $value['purchase_code']?>">
                                    <?php  endforeach; ?>
                                    <div class="modal-body" id="addProduct">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="supplier">Company: <span
                                                            class="required">*</span></label>
                                                    <!-- <input type="text" class="form-control" name="position" value=""> -->
                                                    <select class="form-control" class="company" name="company">
                                                        <option value="" selected hidden>Select Company</option>
                                                        <?php foreach($company as $k => $value) : ?>
                                                        <option value="<?php echo $value['company_id'] ?>">
                                                            <?php echo $value['company_name'] ?></option>
                                                        <?php  endforeach; ?>
                                                    </select>
                                                    <span class="err"></span>
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
                                        <hr>

                                        <br>

                                        <div class="table-responsive view_purchase_orders_details">
                                            <table class="table table-bordered table-striped purchase" role="grid"
                                                aria-describedby="example1_info" id="add_new_product">
                                                <thead>
                                                    <th class="header-title purch">SKU <span class="required">*</span>
                                                    </th>
                                                    <th class="header-title purch">Product <span
                                                            class="required">*</span></th>
                                                    <th class="header-title purch">Quantity <span
                                                            class="required">*</span></th>
                                                    <th class="header-title purch">Unit Price <span
                                                            class="required">*</span></th>
                                                    <th class="header-title purch">Total <span class="required">*</span>
                                                    </th>

                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td class="purch_td">
                                                            <select class="form-control code select2"
                                                                style="width: 100%;" name="prod_code[]">
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
                                                            <input type="text" class="form-control prod_name"
                                                                name="prod_name[]" value="" readonly>
                                                            <!-- <input type="text" class="form-control" name="prod_name[]" value=""> -->
                                                            <span class="err"></span>
                                                        </td>
                                                        <td class="purch_td">
                                                            <input type="text"
                                                                class="form-control purchase_quantity number_only"
                                                                name="quantity[]" value="">
                                                            <span class="err"></span>
                                                        </td>
                                                        <td class="purch_td">
                                                            <input type="text"
                                                                class="form-control purchase_price number_only"
                                                                name="unit_price[]" value="">
                                                            <span class="err"></span>
                                                        </td>
                                                        <td class="purch_td">
                                                            <input type="text" class="form-control purchase_total"
                                                                name="total[]" value="" readonly>
                                                            <span class="err"></span>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <ul class="list-group" id="result"></ul>
                                        </div>
                                        <span class="btn btn-sm btn-primary" id="addNewPO"><i class="fa fa-plus"></i>
                                            Add Product</span>
                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="note">Note: </label>
                                                <textarea rows="4" cols="50" class="form-control" name="purchase_note"
                                                    value=""></textarea>
                                            </div>
                                            <div class="col-md-12 col-lg-6 order-md-2">
                                                <div class="form-horizontal">
                                                    <div class="form-group row m-b-10">
                                                        <label for="batchCode"
                                                            class="col-md-12 col-lg-4 col-form-label">Quantity <span
                                                                class="text-red">*</span></label>
                                                        <div class="col-lg-8 col-md-12">
                                                            <input type="text"
                                                                class="form-control disabled-normal total_quantity"
                                                                name="total_quantity" readonly="" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal">
                                                    <div class="form-group row m-b-10">
                                                        <label for="batchCode"
                                                            class="col-md-12 col-lg-4 col-form-label">Cost <span
                                                                class="text-red">*</span></label>
                                                        <div class="col-lg-8 col-md-12">
                                                            <div class="input-group m-b-0">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text"
                                                                    class="form-control disabled-normal total_cost"
                                                                    name="total_cost" readonly="" disabled="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal">
                                                    <div class="form-group row m-b-10">
                                                        <label for="batchCode"
                                                            class="col-md-12 col-lg-4 col-form-label">Grand Total <span
                                                                class="text-red">*</span></label>
                                                        <div class="col-lg-8 col-md-12">
                                                            <div class="input-group m-b-0">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text"
                                                                    class="form-control disabled-normal grand_total"
                                                                    name="grand_total" readonly="" disabled="">
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
                        </form>
                    </div>
                </div>
                <!-- End Add user Modal -->

                <!--View User Modal -->
                <!-- Modal -->
                <div class="modal fade" id="ViewPurchaseOrders" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info1">
                                <h5 class="modal-title" id="exampleModalLabel">View Purchase Ordered Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="purchaseOrders">
                                <div class="row">
                                    <div class="col-6">
                                        <h1 class="inp_head">#<span class="code"></span> </h1> <br>
                                    </div>
                                    <div class="col-6 dateO">
                                        <h1 class="inp_head"><span class="date"></span> </h1> <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="company">Company:</label>
                                            <p class="company"></p> <br>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="supplier">Supplier:</label>
                                        <p class="supplier"></p> <br>
                                    </div>
                                    <div class="col-4">
                                        <label for="supplier">Warehouse:</label>
                                        <p class="warehouse"></p> <br>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive purch_prod po_tbl">
                                <table class="table table-bordered table-striped purchase" role="grid"
                                    aria-describedby="example1_info" id="view_purchase_orders_details">
                                    <thead>
                                        <th class="header-title purch">SKU</th>
                                        <th class="header-title purch">Product</th>
                                        <th class="header-title purch">Quantity </th>
                                        <th class="header-title purch">Unit Price</th>
                                        <th class="header-title purch">Total </th>
                                        <th class="header-title purch">Delivered </th>
                                        <th class="header-title purch">Variance</th>
                                        <th class="header-title purch"></th>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- <td class="purch_td">
                                    <input type="text" class="form-control" name="prod_name[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control purchase_quantity" name="quantity[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control purchase_price" name="unit_price[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control purchase_total" name="total[]" value="" readonly>
                                    <span class="err"></span>
                                  </td> -->
                                        </tr>
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
                                            <label for="batchCode"
                                                class="col-md-12 col-lg-4 col-form-label">Quantity</label>
                                            <div class="col-lg-8 col-md-12">
                                                <input type="text" class="form-control disabled-normal qty" readonly=""
                                                    disabled="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-horizontal">
                                        <div class="form-group row m-b-10">
                                            <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Cost <span
                                                    class="text-red">*</span></label>
                                            <div class="col-lg-8 col-md-12">
                                                <div class="input-group m-b-0">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control disabled-normal total_cost"
                                                        readonly="" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-horizontal">
                                        <div class="form-group row m-b-10">
                                            <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Grand Total
                                                <span class="text-red">*</span></label>
                                            <div class="col-lg-8 col-md-12">
                                                <div class="input-group m-b-0">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control disabled-normal grand_total"
                                                        readonly="" disabled="">
                                                </div>
                                            </div>
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
                <div class="modal fade" id="EditPurchaseOrder" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form id="editpurchaseorder" method="post">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info1">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Purchase Order</h5>
                                    <input type="hidden" class="form-control purchaseID" name="purchase_id[]">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php //foreach($purchase as $k => $value) : ?>
                                <!-- <input type="hidden" class="form-control" name="purchase_code" value="<?php //echo $value['purchase_code']?>"> -->
                                <?php  //endforeach; ?>
                                <div class="modal-body" id="addProduct">
                                    <div class="row">
                                        <div class="col-6">
                                            <div id="sup" style="display:none">  </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="edit_purchase_code"
                                                    value="">
                                                <label for="supplier">Company: <span class="required">*</span></label>
                                                <!-- <input type="text" class="form-control" name="position" value=""> -->
                                                <select class="form-control" class="company" name="company_edit"
                                                    value="">
                                                    <!-- <option value="" selected hidden>Select Company</option> -->
                                                    <?php foreach($company as $k => $value) : ?>
                                                    <option value="<?php echo $value['company_id'] ?>">
                                                        <?php echo $value['company_name'] ?></option>
                                                    <?php  endforeach; ?>
                                                </select>
                                                <span class="err"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group" id="edit_show_supplier">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group" id="edit_show_warehouse">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <br>

                                    <div class="table-responsive view_purchase_orders_details">
                                        <table class="table table-bordered table-striped purchase" role="grid"
                                            aria-describedby="example1_info" id="edit_purch">
                                            <thead>
                                                <th class="header-title purch">SKU <span class="required">*</span></th>
                                                <th class="header-title purch">Product <span class="required">*</span>
                                                </th>
                                                <th class="header-title purch">Quantity <span class="required">*</span>
                                                </th>
                                                <th class="header-title purch">Unit Price <span
                                                        class="required">*</span></th>
                                                <th class="header-title purch">Total <span class="required">*</span>
                                                </th>

                                            </thead>
                                            <tbody>

                                                <!-- <tr>
                                  <td class="purch_td">
                                    <input type="text" class="form-control" name="prod_name[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control purchase_quantity" name="quantity[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control purchase_price" name="unit_price[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control purchase_total" name="total[]" value="" readonly>
                                    <span class="err"></span>
                                  </td>
                                </tr> -->

                                            </tbody>
                                        </table>
                                    </div>
                                    <span class="btn btn-sm btn-primary" id="addNewPO_edit"><i class="fa fa-plus"></i>
                                        Add Product
                                    </span>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="note">Note: </label>
                                            <textarea rows="4" cols="50" class="form-control note" name="purchase_note"
                                                value=""></textarea>
                                        </div>
                                        <div class="col-md-12 col-lg-6 order-md-2">
                                            <div class="form-horizontal">
                                                <div class="form-group row m-b-10">
                                                    <label for="batchCode"
                                                        class="col-md-12 col-lg-4 col-form-label">Quantity <span
                                                            class="text-red">*</span></label>
                                                    <div class="col-lg-8 col-md-12">
                                                        <input type="text"
                                                            class="form-control disabled-normal total_quantity"
                                                            readonly="" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-horizontal">
                                                <div class="form-group row m-b-10">
                                                    <label for="batchCode"
                                                        class="col-md-12 col-lg-4 col-form-label">Cost <span
                                                            class="text-red">*</span></label>
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="input-group m-b-0">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text"
                                                                class="form-control disabled-normal total_cost"
                                                                readonly="" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-horizontal">
                                                <div class="form-group row m-b-10">
                                                    <label for="batchCode"
                                                        class="col-md-12 col-lg-4 col-form-label">Grand Total <span
                                                            class="text-red">*</span></label>
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="input-group m-b-0">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text"
                                                                class="form-control disabled-normal grand_total"
                                                                readonly="" disabled="">
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
                    </form>
                </div>
            </div>
            <!-- End Edit purchase order Modal -->

            <!--View Delete Modal -->
            <!-- Modal -->
            <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form id="adduser" method="post">
                    <div class="modal-dialog modal-xs" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash"
                                        style="color:black" aria-hidden="true"></i> Delete User</h5>
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

            <!--update delivery status Modal -->
            <!-- Modal -->
            <div class="modal fade" id="DeliveryStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">\
                <form id="change_deliveryStat" method="post">
                    <div class="modal-dialog modal-xs" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info1">
                                <h5 class="modal-title" id="exampleModalLabel">Update Delivery Status</h5>
                                <input type="hidden" class="form-control purchaseID" name="purchase_id[]">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row deliver">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="purchase_code_delivery"
                                                value="">
                                            <input type="hidden" class="form-control" name="product" value="">
                                            <input type="hidden" class="form-control" name="code" value="">
                                            <input type="hidden" class="form-control" name="warehouse_id" value="">
                                            <input type="hidden" class="form-control" name="warehouse_name" value="">
                                            <input type="hidden" class="form-control" name="quantity" value="">
                                            <!-- <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Status</label> -->
                                            <select class="form-control" class="delivery_status" name="delivery_status"
                                                id="delivery_status" value="">
                                                <option value="1" selected>Pending</option>
                                                <option value="2">On Hold</option>
                                                <option value="3">Processing</option>
                                                <option value="4">Delivered</option>
                                            </select>
                                            <br>
                                            <div class="row" id="remarks_delivery" style="display:none">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="remarks">Remarks:</label>
                                                        <textarea rows="4" cols="50" class="form-control"
                                                            name="remarks_deliv" value=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary add">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End update delivery status Modal -->

            <!--update  status Modal -->
            <!-- Modal -->
            <div class="modal fade" id="Status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">\
                <form id="change_Stat" method="post">
                    <div class="modal-dialog modal-xs" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info1">
                                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                <input type="hidden" class="form-control purchaseID" name="purchase_id[]">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="purchase_code_status"
                                                value="">
                                            <!-- <label for="batchCode" class="col-md-12 col-lg-4 col-form-label">Status</label> -->
                                            <select class="form-control" class="status" name="status" value=""
                                                id="status">
                                                <option value="1" selected>Pending</option>
                                                <option value="2">Approved</option>
                                                <option value="3">Cancelled</option>
                                            </select>
                                            <br>
                                            <div class="row" id="remarks" style="display:none;">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="remarks">Remarks:</label>
                                                        <textarea rows="4" cols="50" class="form-control" name="remarks"
                                                            value=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <button type="submit" class="btn btn-sm btn-primary add">Submit</button> -->
                                </div>
                                <div class="modal-footer deliver">
                                    <button type="submit" class="btn btn-primary add">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End update  status Modal -->

            <!--view view remarks Modal -->
            <!-- Modal -->
            <div class="modal fade" id="viewRemarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">\
                <form id="viewRemarks" method="post">
                    <div class="modal-dialog modal-xs" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info1">
                                <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                                <input type="hidden" class="form-control purchaseID" name="purchase_id[]">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="remarks">Status Remarks:</label>
                                            <p class="viewremarks"></p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="remarks">Delivery Remarks:</label>
                                            <p class="view_deliv_remarks"></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End view remarks Modal -->
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
                            <table class="table table-bordered table-striped dataTable purchase_tbl" role="grid"
                                aria-describedby="example1_info">
                                <thead>
                                    <th class="header-title">Date Ordered</th>
                                    <th class="header-title">Purchase Code</th>
                                    <th class="header-title">Company</th>
                                    <th class="header-title">Supplier</th>
                                    <th class="header-title">Action</th>
                                    <th class="header-title">P.O Status</th>
                                    <th class="header-title">Delivery Status</th>
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
