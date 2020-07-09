<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> PRODUCTS</h1>
                    HOME > <span class="active1"> PRODUCTS </p>
                </div>
                <div class="col-sm-6">
                    <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddProducts"><i class="fas fa-plus-circle" aria-hidden="true"></i> Add Products </button>
                    <div class="modal fade" id="AddProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="addproduct" method="post">
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
                                                    <label for="sodate"> Date Purchased: <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="sodate" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="code">Date Returned: <span class="required">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="sodate" value="" placeholder="Select Date">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="supplier">Company: <span class="required">*</span></label>
                                                    <!-- <input type="text" class="form-control" name="position" value=""> -->
                                                    <select class="form-control" class="company" name="company_bo">
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
                                            <div class="col-6">
                                                <label for="note">Reason: </label>
                                                <textarea rows="4" cols="50" class="form-control" name="stockmovement_note" value=""></textarea>
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
                                <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <!-- <table class="table table-bordered table-striped dataTable stocksmov_tbl" role="grid" aria-describedby="example1_info"> -->
                                    <thead>
                                        <th class="header-title">Date Returned</th>
                                        <th class="header-title">Purchase Code</th>
                                        <th class="header-title">Product Name</th>
                                        <th class="header-title">Reason</th>
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
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
