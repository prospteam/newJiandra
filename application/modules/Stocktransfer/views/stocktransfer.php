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
                                                    <input type="text" class="form-control datepicker" name="date_purchased" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="date_returned">Date Returned: <span class="required">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="date_returned" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="quantity"> Quantiy: <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" name="quantity" value="" placeholder="Enter Quantity">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="sellprice">Sell Price: <span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="sellprice" value="" placeholder="Enter Sell Price">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="supplier">Company: <span class="required">*</span></label>
                                                    <!-- <input type="text" class="form-control" name="position" value=""> -->
                                                    <select class="form-control" class="company" name="company">
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
