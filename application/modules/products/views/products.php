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
                    <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddProducts"><i
                            class="fas fa-plus-circle" aria-hidden="true"></i> Add Products </button>

                    <!--Add Products Modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="AddProducts" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="addproducts" method="post">
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
                                                    <label for="product_name">Name: <span
                                                            class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts"
                                                        name="product_name" id="product_name" data-type="product_name">
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
                                                    <select class="form-control js-example-basic-multiple-addproducts"
                                                        name="brand" id="brand" data-type="brand">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="category">Category: <span
                                                            class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts"
                                                        name="category" id="category" data-type="category">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="variant">Variant: <span
                                                            class="required">*</span></label>
                                                    <input type="text" class="form-control" name="variant" value="">
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="volume">Volume: <span class="required">*</span></label>
                                                    <select class="form-control js-example-basic-multiple-addproducts"
                                                        name="volume" id="volume" data-type="volume">
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
                                                    <select class="form-control js-example-basic-multiple-addproducts"
                                                        name="unit" id="unit" data-type="unit">
                                                        <option></option>
                                                    </select>
                                                    <span class="err"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea rows="2" cols="50" name="description"
                                                        class="form-control"> </textarea>
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
                    <div class="modal fade" id="disp_cost_price" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="disp_costPrice" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel"> Cost Price</h5>
                                        <input type="hidden" class="form-control editproducts_id" name="editproducts_id"  value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h1 class="disp_prod_name">#<span class="prod_name"></span> </h1> <br>
                                            </div>
                                        </div>
                                    <div class="table-responsive view_purchase_orders_details">
                                        <div class="modal_header_margin">
                                            <input type="hidden" class="form-control" name="editproducts_id" value="">
                                        </div>
                                        <button type="button" class="cost cost_btn add_new_cost_btn float-sm-right" data-toggle="modal" data-target="#add_cost">
                                            <i class="fas fa-plus-circle" aria-hidden="true"></i> Add New
                                        </button>
                                        <table class="table table-bordered table-striped purchase" role="grid"
                                            aria-describedby="example1_info" id="add_new_product">
                                            <thead>
                                                <th class="header-title purch">Cost Price  </th>
                                                <th class="header-title purch">Selling Price </th>
                                                <th class="header-title purch">Date Updated</th>
                                                <th class="header-title purch">Actions</th>
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="purch_td">
                                                        <input type="text" class="form-control price_cost" name="cost_price[]" value="" readonly>
                                                        <span class="err"></span>
                                                    </td>
                                                    <td class="purch_td">
                                                        <input type="text" class="form-control sell_price" name="selling_price[]" value="" readonly>
                                                        <span class="err"></span>
                                                    </td>
                                                    <td class="purch_td">
                                                        <input type="text" class="form-control date_up" name="date_updated[]" value="" readonly>
                                                        <span class="err"></span>
                                                    </td>
                                                    <td class="purch_td">
                                                        <a href="javascript:;" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary add">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end add cost price -->
                    <!-- Add another cost price modal -->
                    <div class="modal fade" id="add_cost_price"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                        <form id="add_costPrice" method="post">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info1">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Cost Price</h5>
                                        <input type="hidden" class="form-control editproducts_id" name="editproducts_id"  value="">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cost">Cost: <span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="cost" value="">
                                                        <span class="err"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="sell">Sell: <span  class="required">*</span></label>
                                                        <input type="text" class="form-control" name="sell" value="">
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
                                                <label for="product_name">Name:</label>
                                                <p class="product_name"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="brand">Brand: </label>
                                            <p class="brand"> </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category">Category: </label>
                                                <p class="category"> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="variant">Variant:</label>
                                                <p class="variant"> </p>
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
                                            <div class="form-group">
                                                <label for="unit">Unit:</label>
                                                <p class="unit"> </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="description">Desription:</label>
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
            <div class="modal fade" id="editProducts" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">\
                <form id="editProducts" method="post">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info1">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
                                <input type="hidden" class="form-control editproducts_id" name="editproducts_id"
                                    value="">
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
                                            <label for="product_name1">Name: <span
                                                    class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts"
                                                name="product_name" id="product_name1" data-type="product_name">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="brand1">Brand: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts"
                                                name="brand" id="brand1" data-type="brand">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="category1">Category: <span
                                                    class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts"
                                                name="category" id="category1" data-type="category">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="variant1">Variant: <span
                                                    class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts"
                                                name="variant" id="variant1" data-type="variant">
                                                <option></option>
                                            </select>
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="volume">Volume: <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="volume" value="">
                                            <span class="err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="unit1">Unit: <span class="required">*</span></label>
                                            <select class="form-control js-example-basic-multiple-editproducts"
                                                name="unit" id="unit1" data-type="unit">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea rows="2" cols="50" name="description"
                                                class="form-control"></textarea>
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
                                        <th class="header-title">Code</th>
                                        <th class="header-title">Name</th>
                                        <th class="header-title">Brand</th>
                                        <th class="header-title">Category</th>
                                        <th class="header-title">Volume</th>
                                        <!-- <th class="header-title">Unit</th> -->
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
            <!-- /.card-body -->
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
