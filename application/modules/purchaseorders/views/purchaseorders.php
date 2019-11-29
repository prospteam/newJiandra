<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Purchase Order</h1>
          HOME > <span class="active1"> PURCHASE ORDER </p>
        </div>
        <div class="col-sm-6">
            <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddPurchaseOrder"><i class="fas fa-plus-circle" aria-hidden="true"></i>  Purchase Order </button>

            <!--Add User Modal -->
            <!-- Modal -->
    				<div class="modal fade" id="AddPurchaseOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    					<form id="addpurchaseorder" method="post">
    						<div class="modal-dialog modal-lg" role="document">
    							<div class="modal-content">
    								<div class="modal-header bg-info1">
    									<h5 class="modal-title" id="exampleModalLabel">Add Purchase Order</h5>
    									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
    									</button>
    								</div>
                    <?php foreach($purchase as $k => $value) : ?>
                        <input type="hidden" class="form-control" name="purchase_id" value="<?php echo $value['id']?>">
                  <?php  endforeach; ?>
    								<div class="modal-body" id="addProduct">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="supplier">Company: <span class="required">*</span></label>
                            <!-- <input type="text" class="form-control" name="position" value=""> -->
                            <select class="form-control" class="supplier" name="company" >
                              <option value="" selected hidden>Select Company</option>
                            <?php foreach($company as $k => $value) : ?>
                                <option value="<?php echo $value['company_id'] ?>"><?php echo $value['company_name'] ?></option>
                          <?php  endforeach; ?>
                        </select>
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group" id="show_supplier">
    											</div>
    										</div>
                      </div>
                      <hr>
                          <span class="btn btn-sm btn-primary" id="addNewPO"><i class="fa fa-plus"></i> Add Product</span>
                        <br>

                      <div class="table-responsive">
                            <table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="view_purchase_orders_details">
                              <thead>
                                  <th class="header-title purch">Product <span class="required">*</span></th>
                                  <th class="header-title purch">Quantity <span class="required">*</span></th>
                                  <th class="header-title purch">Unit Price <span class="required">*</span></th>
                                  <th class="header-title purch">Total <span class="required">*</span></th>

                              </thead>
                              <tbody>
                                <tr>
                                  <td class="purch_td">
                                    <input type="text" class="form-control" name="prod_name[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control" name="quantity[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control" name="unit_price[]" value="">
                                    <span class="err"></span>
                                  </td>
                                  <td class="purch_td">
                                    <input type="number" class="form-control" name="total[]" value="">
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
                                                    <input type="text" class="form-control disabled-normal total_quantity" readonly="" disabled="">
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
                                                        <input type="text" class="form-control disabled-normal total_cost" readonly="" disabled="">
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
                                                        <input type="text" class="form-control disabled-normal grand_total" readonly="" disabled="">
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
          <!-- End Add user Modal -->

          <!--View User Modal -->
          <!-- Modal -->
          <div class="modal fade" id="ViewPurchaseOrders" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\

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
                    <table class="table table-bordered table-striped purchase" role="grid" aria-describedby="example1_info" id="view_purchase_orders_details">
                  <thead>
                    <th class="header-title purch">Product</th>
                    <th class="header-title purch">Ordered</th>
                    <th class="header-title purch">Delivered</th>
                    <th class="header-title purch">Action</th>
                  </thead>
                  <tbody>
                    <tr>

                    </tr>
                  </tbody>
                </table>
                  </div>
                </div>
              </div>

          </div>
        <!-- End View user Modal -->

        <!--View Edit Modal -->
        <!-- Modal -->
        <div class="modal fade" id="EditPurchaseOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <form id="editpurchaseorder" method="post">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info1">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Purchase Order</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php foreach($purchase as $k => $value) : ?>
                    <input type="hidden" class="form-control" name="purchase_id" value="<?php echo $value['id']?>">
              <?php  endforeach; ?>
                <div class="modal-body">
                    <span class="btn btn-md btn-primary" id="addNewPO_edit"><i class="fa fa-plus"></i> Add New</span>
                    <br>
                      <br>
                      <table id="edit_purch">
                        <thead>
                          <!-- <th class="header-title purch"></th>
                          <th class="header-title purch"></th>
                          <th class="header-title purch"></th> -->
                          <!-- <th class="header-title purch">Action</th> -->
                        </thead>

                      <tbody>
                        <tr>

                        </tr>
                      </tbody>
                    </table>
                  <!-- <div class="edit">
                  </div>
                  <div id="editPurchase">
                  </div> -->
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary add">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      <!-- End Edit purchase order Modal -->

      <!--View Delete Modal -->
      <!-- Modal -->
      <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
        <form id="adduser" method="post">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash" style="color:black" aria-hidden="true"></i>  Delete User</h5>
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
                    <table class="table table-bordered table-striped dataTable purchase_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                    <th class="header-title">Date Ordered</th>
                    <th class="header-title">Purchase Code</th>
                    <th class="header-title">Supplier</th>
                    <th class="header-title">Action</th>
                    <th class="header-title">Status</th>
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
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled" id="example1_previous">
                        <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                      </li>
                      <li class="paginate_button page-item next" id="example1_next">
                        <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                      </li>
                    </ul>
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
