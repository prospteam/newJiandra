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
                    <button class="prod_csv_btn button1 float-sm-right" data-toggle="modal" data-target="#csv_btn" onclick="window.location.href = 'http://localhost/newjiandra/productsimport';"><i class="fas fa-file-csv"></i> Upload CSV File </button>

                    <!--Add Products Modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="AddProducts" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="addproduct" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="code">Code: <span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="code" value="">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="volume">Volume: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts" name="volume" id="volume" data-type="volume">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="unit">Units: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts" name="unit" id="unit" data-type="unit">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="packing">Packing: <span class="required">*</span></label>
                                                    <!-- <select class="form-control js-example-basic-multiple-addproducts" name="packing" id="packing" data-type="packing"> -->
                                                        <input type="text" class="form-control" name="packing" value="">
                                                        <!-- <option></option>
                                                    </select> -->
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="brand">Brand: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts" name="brand" id="brand" data-type="brand">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="product_name">Name: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts" name="product_name" id="product_name" data-type="product_name">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="category">Category: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts" name="category" id="category" data-type="category">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="variant">Variants: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts" name="variant" id="variant" data-type="variant">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="supplier">Supplier:</label>
                                                    <select class="form-control" class="supplier" name="supplier">
                                                        <option value="" selected hidden>Select Supplier</option>
                                                        <?php foreach($supplier as $k => $value) : ?>
                                                            <option value="<?php echo $value['supplier_name'] ?>"><?php echo $value['supplier_name'] ?></option>
                                                        <?php  endforeach; ?>
                                                    </select>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea rows="1" cols="50" name="description" class="form-control"> </textarea>
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
                    <!-- End Add Products Modal -->
                    <!-- add cost Price -->
                    <div class="modal fade" id="view_cost_price" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="view_costPrice" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel"> Cost Price</h5>
                                        <!-- <input type="" class="form-control cost_price_id" name="cost_price_id"  value=""> -->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h1 class="disp_prod_cost_name"><span class="prod_cost_name">#</span> </h1> <br>
                                            </div>
                                        </div>
                                    <div class="table-responsive view_purchase_orders_details cost_modal_table">
                                        <div class="modal_header_margin">
                                            <input type="hidden" class="form-control" name="cost_price_id" value="">
                                        </div>
                                        <button type="button" class="cost cost_btn add_new_cost_btn float-sm-right" data-toggle="modal" data-target="#add_cost">
                                            <i class="fas fa-plus-circle" aria-hidden="true"></i> Add New
                                        </button>
                                        <div class="table-responsive purch_prod" id="cost_price_table">
                                            <table class="table table-bordered table-striped purchase add_new_cost_price_tbl" role="grid" aria-describedby="example1_info" id="add_new_cost_price">
                                                <thead>
                                                <tr>
                                                    <th class="header-title purch_td">Cost Price  </th>
                                                    <th class="header-title purch">Selling Price </th>
                                                    <th class="header-title purch">Effective Date</th>
                                                    <th class="header-title purch">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <!-- <td class="purch_td">
                                                    <span class="err"></span>
                                                </td>
                                                <td class="purch_td">
                                                <span class="err"></span>
                                            </td>
                                            <td class="purch_td">
                                            <span class="err"></span>
                                        </td>
                                        <td class="purch_td">
                                        <a href="javascript:;" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
                                                    </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="no_products_found">
                                            <span>No Products Found....</span>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end add cost price -->
                    <!-- Add another cost price modal -->
                    <div class="modal fade" id="add_cost_price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="add_costPrice" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Cost Price</h5>
                                        <input type="hidden" class="form-control product_id" name="product_id"  value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cost_price">Cost: <span class="required">*</span></label>
                                                        <input type="text" class="form-control number_only" name="cost_price" value="">
                                                        <span class="err"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="sell_price">Sell: <span  class="required">*</span></label>
                                                        <input type="text" class="form-control number_only" name="sell_price" value="">
                                                        <span class="err"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="effective_date">Effective Date<span  class="required">*</span></label>
                                                        <div class="form-group">
                                                            <div class="input-group m-b-0">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <!-- <input type="input" class="form-control datepicker" name="effective_date" value=""> -->
                                                                <input type="type" class="form-control datepicker" name="effective_date" value="<?php echo date('F d, Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <span class="err"></span>
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
                    <!-- end Add another cost price modal -->
                    <div class="modal fade" id="edit_cost_price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="edit_costPrice" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit New Cost Price</h5>
                                        <input type="hidden" class="form-control edit_cost_sell_price_id" name="cost_sell_price_id_edit"  value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cost_price_edit">Cost: <span class="required">*</span></label>
                                                        <input type="text" class="form-control number_only" name="cost_price_edit" value="">
                                                        <span class="err"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="sell_price_edit">Sell: <span  class="required">*</span></label>
                                                        <input type="text" class="form-control number_only" name="sell_price_edit" value="">
                                                        <span class="err"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="effective_date_edit">Effective Date<span  class="required">*</span></label>
                                                        <div class="form-group">
                                                            <div class="input-group m-b-0">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <!-- <input type="input" class="form-control datepicker" name="effective_date" value=""> -->
                                                                <input type="type" class="form-control datepicker" name="effective_date_edit" value="<?php echo date('F d, Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <span class="err"></span>
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
                    <!--View Products Modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="viewproducts" tabindex="-1" role="dialog" aria-
                        labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info1">
                                    <h5 class="modal-title" id="exampleModalLabel"> View Products Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="code">Code:</label>
                                                <p class="code"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="volume">Volume:</label>
                                                <p class="volume"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="unit">Units: </label>
                                            <p class="unit"> </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="packing">Packing: </label>
                                                <p class="packing"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="brand">Brand:</label>
                                                <p class="brand"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="product_name">Name:</label>
                                                <p class="product_name"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category">Category:</label>
                                                <p class="category"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="variant">Variants:</label>
                                                <p class="variant"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="supplier">Supplier:</label>
                                                <p class="supplier"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <p class="description"> </p>
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
            <div class="modal fade" id="editProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                <form id="editproducts_form" method="post">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info1">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
                                <input type="hidden" class="form-control editproducts_id" name="products_edit_id" value="">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="code">Code: <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="code" value="">
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="volume">Volume: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="volume" id="volume1" data-type="volume">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="unit">Unit: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="unit" id="unit1" data-type="unit">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="packing">Packing: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="packing" id="packing1" data-type="packing">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="brand">Brand: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="brand" id="brand1" data-type="brand">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="product_name">Name: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="product_name" id="product_name1" data-type="product_name">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="category">Category: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="category" id="category1" data-type="category">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="variant">Variant: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts" name="variant" id="variant1" data-type="variant">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="supplier">Supplier:</label>
                                            <select class="form-control" class="supplier" name="supplier_edit" value="" data-type="supplier">
                                                <!-- <option value="" selected hidden>Select Supplier</option> -->
                                                <?php foreach($supplier as $k => $value) : ?>
                                                    <option value="<?php echo $value['id'] ?>">
                                                    <?php echo $value['supplier_name'] ?></option>
                                                <?php  endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea rows="1" cols="50" name="description" class="form-control"> </textarea>
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
            <!-- End Edit user Modal -->

                    <!--View Delete Modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="adduser" method="post">
                            <div class="modal-dialog modal-lg" role="document">
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
                                <table class="table table-bordered table-striped dataTable products_tbl" role="grid"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <th class="header-title">SKU</th>
                                        <th class="header-title">Supplier</th>
                                        <th class="header-title">Description</th>
                                        <th class="header-title">Actions</th>
                                        <th class="header-title">Status</th>
                                        <!-- <th class="header-title">Unit</th> -->
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
