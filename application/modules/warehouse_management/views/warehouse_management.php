<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Warehouse Management</h1>
          INVENTORY MANAGEMENT > <span class="active1"> WAREHOUSE MANAGEMENT </p>
        </div>
        <div class="col-sm-6">
            <button class="users button1 float-sm-right" data-toggle="modal" data-target="#Addwarehouse_management"><i class="fas fa-plus-circle" aria-hidden="true"></i>  Add Warehouse </button>

            <!--Add WArehouse Modal -->
            <!-- Modal -->
    				<div class="modal fade" id="Addwarehouse_management" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
    					<form id="addwarehouse1_management" method="post">
    						<div class="modal-dialog modal-lg" role="document">
    							<div class="modal-content">
    								<div class="modal-header bg-info1">
    									<h5 class="modal-title" id="exampleModalLabel">Add Warehouse</h5>
    									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
    									</button>
    								</div>
    								<div class="modal-body">
    									<div class="row">
    										<div class="col-6">
    											<div class="form-group">
    												<label for="wh_name">WH Name: <span class="required">*</span></label>
    												<input type="text" class="form-control" name="wh_name" id="wh_name" data-type="wh_name" value="">
                            <span class="err"></span>
    											</div>
    										</div>
                        <div class="col-6">
    											<div class="form-group">
    												<label for="wh_type">WH Type: <span class="required">*</span></label>
    												<input type="text" class="form-control" name="wh_type" id="wh_type" data-type="wh_type" value="">
                            <span class="err"></span>
    											</div>
    										</div>
    									</div>
    									<div class="row">
                        <div class="col-6">
    											<div class="form-group">
    												<label for="wh_assigned">WH Assigned: <span class="required">*</span></label>
    												<input type="text" class="form-control" name="wh_assigned" id="wh_assigned" data-type="wh_assigned" value="">
                            <span class="err"></span>
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
          <!-- End Add warehouse  Modal -->

          <!--Edit WArehouse Modal -->
          <!-- Modal -->
          <div class="modal fade" id="Editwarehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
            <form id="editWarehouseM" method="post">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
                    	<input type="hidden" class="form-control editwarehouse_id" name="editwarehouse_id" value="">
                    <button type="button" class="close warehouseID" name="warehouseID" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="wh_name">WH Name: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="wh_name" id="wh_name" data-type="wh_name" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="wh_type">WH Type: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="wh_type" id="wh_type" data-type="wh_type" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="wh_assigned">WH Assigned: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="wh_assigned" id="wh_assigned" data-type="wh_assigned" value="">
                          <span class="err"></span>
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
        <!-- End Edit warehouse  Modal -->


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
                    <div class="middle">
                      <div class="">
                          <a href="javascript:;" class="btn-newj t_btn" data-id="3">All Warehouse</a>
                      </div>
                      <div class="">
                          <a href="javascript:;" class="btn-newj f_btn" data-id="1">New Jiandra</a>
                      </div>
                      <div class="">
                          <a href="javascript:;" class="btn-newj s_btn" data-id="2">Mrs. P Mktg</a>
                      </div>

                      <!-- <button class="button company1" data-id="1">New Jiandra</button>
                      <button class="button company1" data-id="2">Mrs.P Mktg</button> -->
                    </div>
                  <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable warehouse_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                      <th class="header-title">WH Name</th>
                      <th class="header-title">WH Type</th>
                      <th class="header-title">WH Assigned</th>
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
