<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Purchase Order</h1>
                    HOME > <span class="active1"> ADD PURCHASE ORDER </p>
                </div>
            </div>
            <form id="addpurchaseorder" method="post">
            <div class="row">
                <div class="col-6">
                    <?php foreach($purchase as $k => $value) :  ?>

                    <input type="hidden" class="form-control" name="purchase_id"
                        value="<?php echo $value['purchase_code']?>">
                    <?php  endforeach; ?>
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
                                        name="unit_price[]" value="" readonly>
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
            <button type="submit" class="btn btn-primary float-right add">Submit</button>
            </form>
        </div>
    </section>
</div>
