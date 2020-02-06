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
    									<div class="form-group">
    										<label for="wh_name">Warehouse Name: <span class="required">*</span></label>
    										<input type="text" class="form-control" name="wh_name" id="wh_name" data-type="wh_name" value="">
                                 <span class="err"></span>
    								   </div>
    							          <div class="form-group">
    									      <label for="wh_type">Warehouse Type: <span class="required">*</span></label>
                                    <select class="form-control" name="wh_type" >
                                      <option value="" selected hidden>Select Warehouse Type</option>
                                       <?php foreach($vehicles as $k => $value) : ?>
                                       <option value = "<?php echo $value['vehicle_type'] ?>"> <?php echo ($value['vehicle_type']== 1)?"Ex Truck":"Warehouse" ?></option>
                                       <?php  endforeach; ?>
                                   </select>
                                    <span class="err"></span>
    							          </div>
                                  <div class="col-6 input_add" >
                                      <!-- <div class="form-group" id="wh_address_show"></div> -->
                                  </div>
                                  <div class="form-group">
                                   <label for="company">Company: <span class="required">*</span></label>
                                      <div class="select2-purple">
                                        <select class="form-control js-example-basic-multiple-disp-comp" name="company[]" multiple="multiple"></select>
                                     </div>
                                   <span class="err"></span>
                                 </div>
                                 <div class="form-group">
                                    <label for="wh_assigned">Warehouse Assigned: <span class="required">*</span></label>
                                    <!-- <input type="text" class="form-control" name="wh_assigned" id="wh_assigned" data-type="wh_assigned" value=""> -->
                                    <select class="form-control" class="wh_assigned" name="wh_assigned" >
                                      <option value="" selected hidden>Select Warehouse Assigned</option>
                                    <?php foreach($users as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['fullname'] ?></option>
                                  <?php  endforeach; ?>
                                 </select>
                                    <span class="err"></span>
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
                        <div class="form-group">
                          <label for="wh_name">Warehouse Name: <span class="required">*</span></label>
                          <input type="text" class="form-control" name="wh_name" id="wh_name" data-type="wh_name" value="">
                          <span class="err"></span>
                        </div>
                        <div class="form-group">
                         <label for="wh_type2">Warehouse Type: <span class="required">*</span></label>
                         <select class="form-control edit_plate_number" name="wh_type2" >
                           <option value="" selected hidden>Select Warehouse Type</option>
                            <?php foreach($vehicles as $k => $value) : ?>
                            <option value = "<?php echo $value['vehicle_type'] ?>"> <?php echo ($value['vehicle_type']== 1)?"Ex Truck":"Warehouse" ?></option>
                            <?php  endforeach; ?>
                        </select>
                         <span class="err"></span>
                       </div>
                       <div class="col-6 input_edit" >
                          <!-- <div class="form-group" id="wh_address_show"></div> -->
                       </div>
                       <div class="form-group plate_num">
                          <label for="wh_plate_number"><b>Plate Number:</b><span class="required">*</span></label>
                          <!-- <input type="text" name="wh_plate_number" class="form-control" id="wh_plate_number" placeholder="Enter Plate Number"> -->
                          <select class="form-control js-example-basic-multiple-edit-platenum" class="wh_plate_number" name="wh_plate_number" >
                           <option value="" selected hidden>Select Plate Number</option>
                         <?php foreach($vehicles as $key => $value) : ?>
                             <option value="<?php echo $value['plate_number'] ?>"><?php echo $value['plate_number'] ?></option>
                       <?php  endforeach; ?>
                      </select>
                       </div>
                       <div class="group wh1_address">
                          <label for="wh_address"><b>Address:</b><span class="required">*</span></label>
                          <input type="text" name="wh_address" class="form-control" id="wh_address" placeholder="Enter Address">
                       </div>
                       <div class="form-group">
                       <label for="company">Company: <span class="required">*</span></label>
                           <div class="select2-purple">
                             <select class="form-control js-example-basic-multiple-edit-comp" name="company[]" multiple="multiple"></select>
                          </div>
                       <span class="err"></span>
                      </div>
                      <div class="form-group">
                        <label for="wh_assigned">Warehouse Assigned: <span class="required">*</span></label>
                        <!-- <input type="text" class="form-control" name="wh_assigned" id="wh_assigned" data-type="wh_assigned" value=""> -->
                        <select class="form-control" class="wh_assigned" name="wh_assigned" >
                          <option value="" selected hidden>Select Warehouse Assigned</option>
                        <?php foreach($users as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['fullname'] ?></option>
                      <?php  endforeach; ?>
                     </select>
                        <span class="err"></span>
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
                          <a href="javascript:;" class="btn-newj t_btn" data-id="0">All Warehouse</a>
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
                      <th class="header-title">Warehouse Name</th>
                      <th class="header-title">Warehouse Type</th>
                      <th class="header-title">Warehouse Assigned</th>
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
  <!-- /.content
           <!-- Modal -->
            <div class="modal fade" id="viewWarehouseType" tabindex="-1" role="dialog" aria-	labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                 <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel" >View Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 <div class="modal-body">
                    <div class="row">
                      <div class="col-6">
                         <div class="form-group">
                          <label for="viewWH" class="viewWH">Warehouse Type Details:  </label>
                          <p class="wh_type"> </p>
                         </div>
                      </div>
                      <div class="col-6">
                         <div class="form-group">
                          <label for="wh_name" class="name_wh">Name: </label>
                          <p class="wh_name"> </p>
                         </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                         <div class="form-group">
                          <label for="wh_assigned" class="assign">Assigned: </label>
                          <p class="wh_assigned"> </p>
                         </div>
                      </div>
                      <div class="col-6">
                         <div class="form-group">
                          <label for="wh_type" class="type">Type: </label>
                          <p class="wh_type1"> </p>
                         </div>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-6">
                          <div class="form-group">
                             <label for="company">Company: </label>
                             <p class="company"> </p>
                          </div>
                       </div>
                    </div>

                 </div>
               </div>
               </div>
          </div>
</div>
<!-- /.content-wrapper -->
