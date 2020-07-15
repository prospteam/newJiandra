<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> BAD ORDER WAREHOUSE</h1>
                    INVENTORY MANAGEMENT > <span class="active1"> B.O WAREHOUSE </p>
                </div>
                <div class="col-sm-6">
                    <button class="users button1 float-sm-right" data-toggle="modal" data-target="#Addbo"><i class="fas fa-plus-circle" aria-hidden="true"></i> Add B.O </button>


                    <div class="modal fade" id="Addbo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="addbo" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Bad Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="date_purchased"> Date Purchased: <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control datepicker"  id="date_purchased" name="date_purchased" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="date_returned">Date Returned: <span class="required">*</span></label>
                                                    <input type="text" class="form-control datepicker" id="date_returned" name="date_returned" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="quantity"> Quantiy: <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" name="quantity" id="qunatity" value="" placeholder="Enter Quantity">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="sellprice">Sell Price: <span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="sellprice" id="sellprice" value="" placeholder="Enter Sell Price">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="supplier">Company: <span class="required">*</span></label>
                                                    <!-- <input type="text" class="form-control" name="position" value=""> -->
                                                    <select class="form-control" class="company" name="company" id="company" >
                                                        <option value="" selected hidden>Select Company</option>
                                                        <?php foreach ($company as $k => $value) : ?>
                                                            <option value="<?php echo $value['company_id'] ?>"><?php echo $value['company_name'] ?></option>
                                                        <?php endforeach; ?>
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
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="show_products">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="reason">Reason: (Ex. Expired/Damage) </label>
                                                <textarea rows="4" cols="50" class="form-control" name="reason" value=""></textarea>
                                                <span class="err"></span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right add">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- View Bad order -->
                    <div class="modal fade" id="viewbo" tabindex="-1" role="dialog" aria-
                        labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info1">
                                    <h5 class="modal-title" id="exampleModalLabel"> View Bad Order Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="date_purchased">Date Purchased:</label>
                                                <p class="date_purchased"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="date_returned">Date Returned:</label>
                                                <p class="date_returned"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="quantity">Quantity: </label>
                                            <p class="quantity"> </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="sellprice">Sell Price: </label>
                                                <p class="sellprice"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="company">Company:</label>
                                                <p class="company"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="supplier">Supplier:</label>
                                                <p class="supplier"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="warehouse">Warehouse:</label>
                                                <p class="warehouse"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="product_name">Products:</label>
                                                <p class="product_name"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="reason">Reason:</label>
                                                <p class="reason"> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- View Bad order -->

                    <!-- edit bad order -->
                    <div class="modal fade" id="Editbo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="editbo" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Bad Order</h5>
                                            <input type="hidden" class="form-control editbo_id" name="editbo_id" value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="date_purchased"> Date Purchased: <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="date_purchased" id="date_purchased1" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="date_returned">Date Returned: <span class="required">*</span></label>
                                                    <input type="text" class="form-control datepicker"  id="date_returned1" name="date_returned" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="quantity"> Quantiy: <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" name="quantity" value="" id="quantity1" placeholder="Enter Quantity">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="sellprice">Sell Price: <span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="sellprice" id="sellprice1" value="" placeholder="Enter Sell Price">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="supplier">Company: <span class="required">*</span></label>
                                                    <!-- <input type="text" class="form-control" name="position" value=""> -->
                                                    <input type="hidden" class="form-control" name="edit_bo_id" value="">
                                                    <select class="form-control" class="company" name="company_edit">
                                                        <option value="" selected hidden>Select Company</option>
                                                        <?php foreach ($company as $k => $value) : ?>
                                                            <option value="<?php echo $value['company_id'] ?>"><?php echo $value['company_name'] ?></option>
                                                        <?php endforeach; ?>
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
                                                <div class="form-group" id="edit_show_warehouse" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="edit_show_products">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="reason">Reason: (Ex. Expired/Damage) </label>
                                                <textarea rows="4" cols="50" class="form-control" name="reason" value=""></textarea>
                                                <span class="err"></span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right add">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- edit bad order -->

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
                                <table class="table table-bordered table-striped dataTable badorder_tbl" role="grid" aria-describedby="example1_info">
                                    <!-- <table class="table table-bordered table-striped dataTable stocksmov_tbl" role="grid" aria-describedby="example1_info"> -->
                                    <thead>
                                        <th class="header-title">Date Purchased</th>
                                        <th class="header-title">Date Returned</th>
                                        <th class="header-title">Product Name</th>
                                        <th class="header-title">Reason</th>
                                        <th class="header-title">Supplier</th>
                                        <th class="header-title">Action</th>
                                        <th class="header-title">Status</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
