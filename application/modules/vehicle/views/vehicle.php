<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Vehicles</h1>
          ENROLLMENT > <span class="active1"> VEHICLES </p>
        </div>
        <div class="col-sm-6">
            <button class="users button1 float-sm-right" data-toggle="modal" data-target="#AddVehicle"><i class="fas fa-plus-circle" aria-hidden="true"></i>  Add Vehicles </button>
            <!--Add User Modal -->
            <!-- Modal -->
            <div class="modal fade" id="AddVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
              <form id="AddVehicle" method="post">

                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-info1">
                      <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="companytitle">Company: <span class="required">*</span> </label>
								<!-- <input type="text" name="companytitle" value="" required> -->
								<div class="select2-purple">
									<select class="form-control add-company-vehicle" name="company[]" multiple="multiple"></select>
									<span class="err"></span>
								</div>
							</div>
						</div>
				      </div>
					<hr>
                      <h1 class="inp_head"> GENERAL INFORMATION </h1>
                      <div class="row">
                        <div class="col-lg-6 gen_info">
                          <div class="form-group">
                            <label for="vehicle_type">Vehicle Type: <span class="required">*</span></label>
                            <select class="form-control" name="vehicle_type">
                              <option value="" selected hidden>Select Vehicle Type</option>
                              <option value="1">EX Truck</option>
                              <option value="2">Delivery Truck</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="vehicle_type" value=""> -->
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-6 gen_info">
                          <div class="form-group">
                            <label for="cr_no">CR No.: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="cr_no" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="owner">Complete Owners Name.: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="owner" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="or_no">O.R No.: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="or_no" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="or_date">O.R Date:</label>
                            <input type="text" class="form-control datepicker" name="or_date" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="mv_file_no">MV File No.:</label>
                            <input type="text" class="form-control" name="mv_file_no" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="plate_number">Plate Number: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="plate_number" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="engine_no">Engine No.:</label>
                            <input type="text" class="form-control" name="engine_no" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="chassis_no">Chassis No.:</label>
                            <input type="text" class="form-control" name="chassis_no" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="denomination">Denomination:</label>
                            <input type="text" class="form-control" name="denomination" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="piston_displacement">Piston Displacement:</label>
                            <input type="text" class="form-control" name="piston_displacement" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="num_of_tires">Number of Cylinders:</label>
                            <input type="number" class="form-control" name="num_of_tires" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="fuel_type">Fuel:</label>
                            <select name="fuel_type" id="fuel_type" class="form-control js-example-basic-multiple-addvehicle"  data-type="fuel_type">
                              <option></option>
                          </select>
                            <!-- <input type="text" class="form-control" name="fuel_type" value=""> -->
                            <span class="err"></span>
                          </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="vehicle_brand">Make: <span class="required">*</span></label>
                            <select class="form-control js-example-basic-multiple-addvehicle"  name="vehicle_brand" id="vehicle_brand" data-type="vehicle_brand">
                              <option></option>
                          </select>
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="series">Series: <span class="required">*</span></label>
                            <input type="number" class="form-control" name="series" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label for="body_type">Body type: <span class="required">*</span></label>
                            <select class="form-control js-example-basic-multiple-bodyType-add"  name="body_type" id="body_type" data-type="body_type">
                              <option></option>
                          </select>
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label for="body_no">Body No.: </label>
                            <input type="number" class="form-control" name="body_no" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label for="year_model">Year Model:</label>
                            <input type="number" class="form-control" name="year_model" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="gross">Gross WT:</label>
                            <input type="number" class="form-control" name="gross" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="net">Net WT:</label>
                            <input type="number" class="form-control" name="net" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="shipping_wt">Shipping WT:</label>
                            <input type="number" class="form-control" name="shipping_wt" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="net_capacity">Net Capacity:</label>
                            <input type="number" class="form-control" name="net_capacity" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                  <hr>
                    <h1 class="inp_head"> ACCOUNTING INFORMATION </h1>
                    <div class = "row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="accounting_date_acquired">Date Acquired:</label>
                          <input type="text" class="form-control datepicker" name="accounting_date_acquired" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="accounting_acqui_amount">Acqui Amount:</label>
                          <input type="text" class="form-control" name="accounting_acqui_amount" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class = "row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="accounting_full_dep_date">Full Dep. Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="accounting_full_dep_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="accounting_monthly_dep">Monthly Dep:</label>
                          <input type="text" class="form-control" name="accounting_monthly_dep" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <p style="font-weight:bold">Depreciation Period in Months</p>
                    <div class = "row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="accounting_accum_dep">Accum. Dep.:</label>
                          <input type="text" class="form-control" name="accounting_accum_dep" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="accounting_book_val">Book Value:</label>
                          <input type="text" class="form-control" name="accounting_book_val" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <p style="font-weight:bold">Approx. Volume Capacity (m3)</p>
                    <div class = "row">

                      <div class="col-lg-2">
                        <div class="form-group approx">
                          <label for="approx_length">Length:</label>
                          <input type="number" class="form-control capacity" name="approx_length" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-xs-6 multiply">
                        <p>x</p>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group approx">
                          <label for="approx_width">Width:</label>
                          <input type="number" class="form-control capacity" name="approx_width" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-xs-6 multiply">
                        <p>x</p>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group approx">
                          <label for="approx_height">Height:</label>
                          <input type="number" class="form-control capacity" name="approx_height" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-xs-6 multiply">
                        <p>=</p>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group approx">
                          <label for="approx_volume">Volume:</label>
                          <input type="number" class="form-control" id="volume" name="approx_volume" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class = "row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="approx_weight">Approx. Weight Capacity (tons):</label>
                          <input type="number" class="form-control" name="approx_weight" value="">
                          <span class="err"></span>
                        </div>
                      </div>

                    </div>
                    <hr>
                    <p style="font-weight:bold">Van Insurance Details</p>
                    <div class = "row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="van_reg_date">Registration Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="van_reg_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="van_policy_num">Policy Number:</label>
                          <input type="text" class="form-control" name="van_policy_num" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="van_renewal_date">Renewal Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="van_renewal_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="van_exp_date">Expiration Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="van_exp_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>

                    </div>
                    <p style="font-weight:bold">Land Transportation Details</p>
                    <div class = "row insurance_details">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="land_reg_date">Registration Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="land_reg_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="land_renewal_date">Renewal Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="land_renewal_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="land_exp_date">Expiration Date:</label>
                          <input type="text" id="datepicker" class="form-control datepicker" name="land_exp_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>

                    </div>
                    <div class = "row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="material_desc">Part / Material / Service Description:</label>
                          <textarea rows="4" cols="50" class="form-control" name="material_desc" value=""></textarea>
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
          <!-- End Add Vehicle Modal -->

          <!--View Vehicle Modal -->
          <!-- Modal -->
          <div class="modal fade" id="ViewVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
            <!-- <form id="addvehicle" method="post"> -->
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info1">
                    <h5 class="modal-title" id="exampleModalLabel">View Vehicle Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="companytitle">Company:</label>
                        <p class="company"> </p>
                        </div>
                      </div>
                  </div>

                    <hr>
                    <h1 class="inp_head"> GENERAL INFORMATION </h1>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="vehicle_type">Vehicle Type:</label>
                          <p class="vehicle_type"> </p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cr_no">CR No.:</label>
                          <p class="cr_no"> </p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="owner">Complete Owners Name.:</label>
                          <p class="owner"> </p>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="or_no">O.R No.:</label>
                          <p class="or_no"> </p>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="or_date">O.R Date:</label>
                          <p class="or_date"> </p>
                        </div>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="mv_file_no">MV File No.:</label>
                          <p class="mv_file_no"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="plate_number">Plate Number:</label>
                          <p class="plate_number"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="engine_no">Engine No.:</label>
                          <p class="engine_no"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="chassis_no">Chassis No.:</label>
                          <p class="chassis_no"> </p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="denomination">Denomination:</label>
                          <p class="denomination"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="piston_displacement">Piston Displacement:</label>
                          <p class="piston_displacement"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="num_of_tires">Number of Cylinders:</label>
                          <p class="num_of_tires"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="fuel_type">Fuel:</label>
                          <p class="fuel_type"> </p>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="vehicle_brand">Vehicle Brand:</label>
                          <p class="vehicle_brand"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="series">Series:</label>
                          <p class="series"> </p>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="body_type">Body type:</label>
                          <p class="body_type"> </p>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="body_no">Body No.:</label>
                          <p class="body_no"> </p>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="year_model">Year Model:</label>
                          <p class="year_model"> </p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="gross">Gross WT: </label>
                          <p class="gross"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="net">Net WT:</label>
                          <p class="net"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="shipping_wt">Shipping WT:</label>
                          <p class="shipping_wt"> </p>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="net_capacity">Net Capacity:</label>
                          <p class="net_capacity"> </p>
                        </div>
                      </div>
                    </div>
                <hr>
                  <h1 class="inp_head"> ACCOUNTING INFORMATION </h1>
                  <div class = "row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="accounting_date_acquired">Date Acquired:</label>
                        <p class="accounting_date_acquired"> </p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="accounting_acqui_amount">Acqui Amount:</label>
                        <p class="accounting_acqui_amount"> </p>
                      </div>
                    </div>
                  </div>
                  <div class = "row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="accounting_full_dep_date">Full Dep. Date:</label>
                        <p class="accounting_full_dep_date"> </p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="accounting_monthly_dep">Monthly Dep:</label>
                        <p class="accounting_monthly_dep"> </p>
                      </div>
                    </div>
                  </div>
                  <p style="font-weight:bold">Depreciation Period in Months</p>
                  <div class = "row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="accounting_accum_dep">Accum. Dep.:</label>
                        <p class="accounting_accum_dep"> </p>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="accounting_book_val">Book Value:</label>
                        <p class="accounting_book_val"> </p>
                      </div>
                    </div>
                  </div>
                  <p style="font-weight:bold">Approx. Volume Capacity (m3)</p>
                  <div class = "row">

                    <div class="col-lg-2">
                      <div class="form-group approx">
                        <label for="approx_length">Length:</label>
                        <p class="approx_length"> </p>
                      </div>
                    </div>
                    <div class="col-xs-6 multiply">
                      <p>x</p>
                    </div>

                    <div class="col-lg-2">
                      <div class="form-group approx">
                        <label for="approx_width">Width:</label>
                        <p class="approx_width"> </p>
                      </div>
                    </div>
                    <div class="col-xs-6 multiply">
                      <p>x</p>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group approx">
                        <label for="approx_height">Height:</label>
                        <p class="approx_height"> </p>
                      </div>
                    </div>
                    <div class="col-xs-6 multiply">
                      <p>=</p>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group approx">
                        <label for="approx_volume">Volume:</label>
                        <p class="approx_volume"> </p>
                      </div>
                    </div>
                  </div>
                  <div class = "row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="approx_weight">Approx. Weight Capacity (tons):</label>
                        <p class="approx_weight"> </p>
                      </div>
                    </div>

                  </div>
                  <hr>
                  <p style="font-weight:bold">Van Insurance Details</p>
                  <div class = "row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="van_reg_date">Registration Date:</label>
                        <p class="van_reg_date"> </p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="van_policy_num">Policy Number:</label>
                        <p class="van_policy_num"> </p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="van_renewal_date">Renewal Date:</label>
                        <p class="van_renewal_date"> </p>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="van_exp_date">Expiration Date:</label>
                        <p class="van_exp_date"> </p>
                      </div>
                    </div>

                  </div>
                  <p style="font-weight:bold">Land Transportation Details</p>
                  <div class = "row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="land_reg_date">Registration Date:</label>
                        <p class="land_reg_date"> </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="land_renewal_date">Renewal Date:</label>
                        <p class="land_renewal_date"> </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="land_exp_date">Expiration Date:</label>
                        <p class="land_exp_date"> </p>
                      </div>
                    </div>

                  </div>
                  <div class = "row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="material_desc">Part / Material / Service Description:</label>
                        <p class="material_desc"> </p>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            <!-- </form> -->
          </div>
        <!-- End View Vehicle Modal -->
        <!-- Edit Vehicle Modal -->
        <div class="modal fade" id="editVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
          <form id="editvehicle" method="post">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info1">
                  <h5 class="modal-title" id="exampleModalLabel"> Edit Vehicle</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="companytitle">Company: <span class="required">*</span> </label>
                        <!-- <input type="text" name="companytitle" value="" required> -->
                        <div class="select2-purple">
                          <select class="form-control edit-company-vehicle" name="company[]" multiple="multiple"></select>
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                </div>

                  <hr>
                  <h1 class="inp_head"> GENERAL INFORMATION </h1>
                  <input type="hidden" class="form-control vehicleID" name="id" value="">

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="vehicle_type">Vehicle Type: <span class="required">*</span></label>
                        <select class="form-control" name="vehicle_type">
                        <!-- <option value="-1" selected="selected" disabled="disabled">Select Vehicle Type</option> -->
                          <option value="1">EX Truck</option>
                          <option value="2">Delivery Truck</option>
                        </select>
                        <!-- <input type="text" class="form-control" name="vehicle_type" value=""> -->
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="cr_no">CR No.: <span class="required">*</span></label>
                        <input type="text" class="form-control" name="cr_no" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="owner">Complete Owners Name.: <span class="required">*</span></label>
                        <input type="text" class="form-control" name="owner" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="or_no">O.R No.: <span class="required">*</span></label>
                        <input type="text" class="form-control" name="or_no" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="or_date">O.R Date:</label>
                        <input type="text" class="form-control datepicker" name="or_date" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="mv_file_no">MV File No.:</label>
                        <input type="text" class="form-control" name="mv_file_no" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="plate_number">Plate Number: <span class="required">*</span></label>
                        <input type="text" class="form-control" name="plate_number" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="engine_no">Engine No.:</label>
                        <input type="text" class="form-control" name="engine_no" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="chassis_no">Chassis No.:</label>
                        <input type="text" class="form-control" name="chassis_no" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="denomination">Denomination:</label>
                        <input type="text" class="form-control" name="denomination" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="piston_displacement">Piston Displacement:</label>
                        <input type="text" class="form-control" name="piston_displacement" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="num_of_tires">Number of Cylinders: </label>
                        <input type="number" class="form-control" name="num_of_tires" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="fuel_type">Fuel:</label>
                        <select name="fuel_type" id="fuel_type1" class="form-control js-example-basic-multiple-editvehicle"  data-type="fuel_type">
                          <option></option>
                      </select>
                        <span class="err"></span>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="vehicle_brand">Make: <span class="required">*</span></label>
                        <select name="vehicle_brand" id="vehicle_brand1" class="form-control js-example-basic-multiple-editvehicle"  data-type="vehicle_brand">
                          <option></option>
                      </select>
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="series">Series: <span class="required">*</span></label>
                        <input type="number" class="form-control" name="series" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label for="body_type">Body type: <span class="required">*</span></label>
                        <select id="body_type1" class="form-control js-example-basic-multiple-bodyType-edit"  data-type="body_type">
                          <option></option>
                      </select>
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label for="body_no">Body No.:</label>
                        <input type="number" class="form-control" name="body_no" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label for="year_model">Year Model:</label>
                        <input type="number" class="form-control" name="year_model" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="gross">Gross WT: </label>
                        <input type="number" class="form-control" name="gross" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="net">Net WT:</label>
                        <input type="number" class="form-control" name="net" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="shipping_wt">Shipping WT:</label>
                        <input type="number" class="form-control" name="shipping_wt" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="net_capacity">Net Capacity:</label>
                        <input type="number" class="form-control" name="net_capacity" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
              <hr>
                <h1 class="inp_head"> ACCOUNTING INFORMATION </h1>
                <div class = "row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="accounting_date_acquired">Date Acquired:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="accounting_date_acquired" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="accounting_acqui_amount">Acqui Amount:</label>
                      <input type="text" class="form-control" name="accounting_acqui_amount" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <div class = "row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="accounting_full_dep_date">Full Dep. Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="accounting_full_dep_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="accounting_monthly_dep">Monthly Dep:</label>
                      <input type="text" class="form-control" name="accounting_monthly_dep" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <p style="font-weight:bold">Depreciation Period in Months</p>
                <div class = "row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="accounting_accum_dep">Accum. Dep.:</label>
                      <input type="text" class="form-control" name="accounting_accum_dep" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="accounting_book_val">Book Value:</label>
                      <input type="text" class="form-control" name="accounting_book_val" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <p style="font-weight:bold">Approx. Volume Capacity (m3)</p>
                <div class = "row">

                  <div class="col-lg-2">
                    <div class="form-group approx">
                      <label for="approx_length">Length:</label>
                      <input type="number" class="form-control capacity_edit" name="approx_length" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-xs-6 multiply">
                    <p>x</p>
                  </div>

                  <div class="col-lg-2">
                    <div class="form-group approx">
                      <label for="approx_width">Width:</label>
                      <input type="number" class="form-control capacity_edit" name="approx_width" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-xs-6 multiply">
                    <p>x</p>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group approx">
                      <label for="approx_height">Height:</label>
                      <input type="number" class="form-control capacity_edit" name="approx_height" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-xs-6 multiply">
                    <p>=</p>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group approx">
                      <label for="approx_volume">Volume:</label>
                      <input type="number" id="volume_edit" class="form-control" name="approx_volume" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <div class = "row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="approx_weight">Approx. Weight Capacity (tons):</label>
                      <input type="number" class="form-control" name="approx_weight" value="">
                      <span class="err"></span>
                    </div>
                  </div>

                </div>
                <hr>
                <p style="font-weight:bold">Van Insurance Details</p>
                <div class = "row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="van_reg_date">Registration Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="van_reg_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="van_policy_num">Policy Number:</label>
                      <input type="text" class="form-control" name="van_policy_num" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="van_renewal_date">Renewal Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="van_renewal_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="van_exp_date">Expiration Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="van_exp_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>

                </div>
                <p style="font-weight:bold">Land Transportation Details</p>
                <div class = "row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="land_reg_date">Registration Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="land_reg_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="land_renewal_date">Renewal Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="land_renewal_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="land_exp_date">Expiration Date:</label>
                      <input type="text" id="datepicker" class="form-control datepicker" name="land_exp_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>

                </div>
                <div class = "row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="material_desc">Part / Material / Service Description:</label>
                      <textarea rows="4" cols="50" class="form-control" name="material_desc" value=""></textarea>
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
      <!-- End E Vehicle Modal -->



        <!--view view remarks Modal -->
        <!-- Modal -->
            <div class="modal fade" id="viewRemarks_inactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
              <form id="viewRemarks" method="post">
                <div class="modal-dialog modal-xs" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-info1">
                      <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                        <!-- <input type="hidden" class="form-control purchaseID" name="purchase_id[]" > -->
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class = "row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="remarks">Remarks:</label>
                              <p class="viewremarks"></p>
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
                    <table class="table table-bordered table-striped dataTable vehicle_tbl" role="grid" aria-describedby="example1_info">
                  <thead>
                    <th class="header-title">Vehicle Type</th>
                    <th class="header-title">Plate Number</th>
                    <th class="header-title">Vehicle Brand</th>
                    <th class="header-title">Action</th>
                    <th class="header-title">Status</th>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <th>Truck</th>
                      <th>12345SS</th>
                      <th>Mazda</th>
                      <th><i class="fas fa-clone"></i></a> <i class="fas fa-pen"></i></a> <i class="fa fa-trash" aria-hidden="true"> </th>
                      <th><button type="button" class="inactive btn btn-block btn-danger">inactive</button></th>
                    </tr>
                    <tr>
                      <th>Small Truck</th>
                      <th>SS12345</th>
                      <th>Suzuki</th>
                      <th><i class="fas fa-clone"></i></a> <i class="fas fa-pen"></i></a> <i class="fa fa-trash" aria-hidden="true"> </th>
                      <th><button type="button" class="active btn btn-block btn-success">active</button></th>
                    </tr> -->
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
