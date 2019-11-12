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
              <form id="addvehicle" method="post">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck" style="color:black" aria-hidden="true"></i>  Add Vehicle</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h1 class="inp_head"> GENERAL INFORMATION </h1>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="plate_number">Plate Number:</label>
                            <input type="text" class="form-control" name="plate_number" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="vehicle_brand">Vehicle Brand:</label>
                            <input type="text" class="form-control" name="vehicle_brand" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label for="vehicle_type">Vehicle Type:</label>
                            <select class="form-control" name="vehicle_type">
                              <option value="1">Warehouse Truck</option>
                              <option value="2">Delivery Truck</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="vehicle_type" value=""> -->
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="fuel_type">Fuel Type:</label>
                            <input type="text" class="form-control" name="fuel_type" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label for="num_of_tires">Number of Tires:</label>
                            <input type="number" class="form-control" name="num_of_tires" value="">
                            <span class="err"></span>
                          </div>
                        </div>
                      </div>
                  <hr>
                    <h1 class="inp_head"> ACCOUNTING INFORMATION </h1>
                    <div class = "row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="accounting_date_acquired">Date Acquired:</label>
                          <input type="date" class="form-control" name="accounting_date_acquired" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="accounting_acqui_amount">Acqui Amount:</label>
                          <input type="text" class="form-control" name="accounting_acqui_amount" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class = "row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="accounting_full_dep_date">Full Dep. Date:</label>
                          <input type="date" class="form-control" name="accounting_full_dep_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="accounting_monthly_dep">Monthly Dep:</label>
                          <input type="text" class="form-control" name="accounting_monthly_dep" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <p style="font-weight:bold">Depereciation Period in Months</p>
                    <div class = "row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="accounting_accum_dep">Accum. Dep.:</label>
                          <input type="text" class="form-control" name="accounting_accum_dep" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="accounting_book_val">Book Value:</label>
                          <input type="text" class="form-control" name="accounting_book_val" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <p style="font-weight:bold">Approx. Volume Capacity (m3)</p>
                    <div class = "row">

                      <div class="col-2">
                        <div class="form-group approx">
                          <label for="approx_length">Length:</label>
                          <input type="number" class="form-control" name="approx_length" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <p>x</p>
                      </div>

                      <div class="col-2">
                        <div class="form-group approx">
                          <label for="approx_width">Width:</label>
                          <input type="number" class="form-control" name="approx_width" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <p>x</p>
                      </div>
                      <div class="col-2">
                        <div class="form-group approx">
                          <label for="approx_height">Height:</label>
                          <input type="number" class="form-control" name="approx_height" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <p>=</p>
                      </div>
                      <div class="col-2">
                        <div class="form-group approx">
                          <label for="approx_volume">Volume:</label>
                          <input type="number" class="form-control" name="approx_volume" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                    </div>
                    <div class = "row">
                      <div class="col-6">
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
                      <div class="col-3">
                        <div class="form-group">
                          <label for="van_reg_date">Registration Date:</label>
                          <input type="date" class="form-control" name="van_reg_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="van_policy_num">Policy Number:</label>
                          <input type="text" class="form-control" name="van_policy_num" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="van_renewal_date">Renewal Date:</label>
                          <input type="date" class="form-control" name="van_renewal_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="van_exp_date">Expiration Date:</label>
                          <input type="date" class="form-control" name="van_exp_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>

                    </div>
                    <p style="font-weight:bold">Land Transportation Details</p>
                    <div class = "row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="land_reg_date">Registration Date:</label>
                          <input type="date" class="form-control" name="land_reg_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="land_renewal_date">Renewal Date:</label>
                          <input type="date" class="form-control" name="land_renewal_date" value="">
                          <span class="err"></span>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="land_exp_date">Expiration Date:</label>
                          <input type="date" class="form-control" name="land_exp_date" value="">
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
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye" style="color:black" aria-hidden="true"></i>  View Vehicle Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h1 class="inp_head"> GENERAL INFORMATION </h1>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="plate_number">Plate Number:</label>
                          <p class="plate_number"> </p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="vehicle_brand">Vehicle Brand:</label>
                          <p class="vehicle_brand"> </p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="vehicle_type">Vehicle Type:</label>
                          <p class="vehicle_type"> </p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="fuel_type">Fuel Type:</label>
                          <p class="fuel_type"> </p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="num_of_tires">Number of Tires:</label>
                          <p class="num_of_tires"> </p>
                        </div>
                      </div>
                    </div>
                <hr>
                  <h1 class="inp_head"> ACCOUNTING INFORMATION </h1>
                  <div class = "row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="accounting_date_acquired">Date Acquired:</label>
                        <p class="accounting_date_acquired"> </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="accounting_acqui_amount">Acqui Amount:</label>
                        <p class="accounting_acqui_amount"> </p>
                      </div>
                    </div>
                  </div>
                  <div class = "row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="accounting_full_dep_date">Full Dep. Date:</label>
                        <p class="accounting_full_dep_date"> </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="accounting_monthly_dep">Monthly Dep:</label>
                        <p class="accounting_monthly_dep"> </p>
                      </div>
                    </div>
                  </div>
                  <p style="font-weight:bold">Depereciation Period in Months</p>
                  <div class = "row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="accounting_accum_dep">Accum. Dep.:</label>
                        <p class="accounting_accum_dep"> </p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="accounting_book_val">Book Value:</label>
                        <p class="accounting_book_val"> </p>
                      </div>
                    </div>
                  </div>
                  <p style="font-weight:bold">Approx. Volume Capacity (m3)</p>
                  <div class = "row">

                    <div class="col-2">
                      <div class="form-group approx">
                        <label for="approx_length">Length:</label>
                        <p class="approx_length"> </p>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <p>x</p>
                    </div>

                    <div class="col-2">
                      <div class="form-group approx">
                        <label for="approx_width">Width:</label>
                        <p class="approx_width"> </p>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <p>x</p>
                    </div>
                    <div class="col-2">
                      <div class="form-group approx">
                        <label for="approx_height">Height:</label>
                        <p class="approx_height"> </p>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <p>=</p>
                    </div>
                    <div class="col-2">
                      <div class="form-group approx">
                        <label for="approx_volume">Volume:</label>
                        <p class="approx_volume"> </p>
                      </div>
                    </div>
                  </div>
                  <div class = "row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="approx_weight">Approx. Weight Capacity (tons):</label>
                        <p class="approx_weight"> </p>
                      </div>
                    </div>

                  </div>
                  <hr>
                  <p style="font-weight:bold">Van Insurance Details</p>
                  <div class = "row">
                    <div class="col-3">
                      <div class="form-group">
                        <label for="van_reg_date">Registration Date:</label>
                        <p class="van_reg_date"> </p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label for="van_policy_num">Policy Number:</label>
                        <p class="van_policy_num"> </p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label for="van_renewal_date">Renewal Date:</label>
                        <p class="van_renewal_date"> </p>
                      </div>
                    </div>
                    <div class="col-3">
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
          <form id="editVehicle" method="post">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck" style="color:black" aria-hidden="true"></i>  Add Vehicle</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h1 class="inp_head"> GENERAL INFORMATION </h1>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="plate_number">Plate Number:</label>
                        <input type="text" class="form-control" name="plate_number" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="vehicle_brand">Vehicle Brand:</label>
                        <input type="text" class="form-control" name="vehicle_brand" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="vehicle_type">Vehicle Type:</label>
                        <select class="form-control" name="vehicle_type">
                          <option value="1">Warehouse Truck</option>
                          <option value="2">Delivery Truck</option>
                        </select>
                        <!-- <input type="text" class="form-control" name="vehicle_type" value=""> -->
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="fuel_type">Fuel Type:</label>
                        <input type="text" class="form-control" name="fuel_type" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="num_of_tires">Number of Tires:</label>
                        <input type="number" class="form-control" name="num_of_tires" value="">
                        <span class="err"></span>
                      </div>
                    </div>
                  </div>
              <hr>
                <h1 class="inp_head"> ACCOUNTING INFORMATION </h1>
                <div class = "row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="accounting_date_acquired">Date Acquired:</label>
                      <input type="date" class="form-control" name="accounting_date_acquired" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="accounting_acqui_amount">Acqui Amount:</label>
                      <input type="text" class="form-control" name="accounting_acqui_amount" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <div class = "row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="accounting_full_dep_date">Full Dep. Date:</label>
                      <input type="date" class="form-control" name="accounting_full_dep_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="accounting_monthly_dep">Monthly Dep:</label>
                      <input type="text" class="form-control" name="accounting_monthly_dep" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <p style="font-weight:bold">Depereciation Period in Months</p>
                <div class = "row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="accounting_accum_dep">Accum. Dep.:</label>
                      <input type="text" class="form-control" name="accounting_accum_dep" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="accounting_book_val">Book Value:</label>
                      <input type="text" class="form-control" name="accounting_book_val" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <p style="font-weight:bold">Approx. Volume Capacity (m3)</p>
                <div class = "row">

                  <div class="col-2">
                    <div class="form-group approx">
                      <label for="approx_length">Length:</label>
                      <input type="number" class="form-control" name="approx_length" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <p>x</p>
                  </div>

                  <div class="col-2">
                    <div class="form-group approx">
                      <label for="approx_width">Width:</label>
                      <input type="number" class="form-control" name="approx_width" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <p>x</p>
                  </div>
                  <div class="col-2">
                    <div class="form-group approx">
                      <label for="approx_height">Height:</label>
                      <input type="number" class="form-control" name="approx_height" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <p>=</p>
                  </div>
                  <div class="col-2">
                    <div class="form-group approx">
                      <label for="approx_volume">Volume:</label>
                      <input type="number" class="form-control" name="approx_volume" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                </div>
                <div class = "row">
                  <div class="col-6">
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
                  <div class="col-3">
                    <div class="form-group">
                      <label for="van_reg_date">Registration Date:</label>
                      <input type="date" class="form-control" name="van_reg_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="van_policy_num">Policy Number:</label>
                      <input type="text" class="form-control" name="van_policy_num" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="van_renewal_date">Renewal Date:</label>
                      <input type="date" class="form-control" name="van_renewal_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="van_exp_date">Expiration Date:</label>
                      <input type="date" class="form-control" name="van_exp_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>

                </div>
                <p style="font-weight:bold">Land Transportation Details</p>
                <div class = "row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="land_reg_date">Registration Date:</label>
                      <input type="date" class="form-control" name="land_reg_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="land_renewal_date">Renewal Date:</label>
                      <input type="date" class="form-control" name="land_renewal_date" value="">
                      <span class="err"></span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="land_exp_date">Expiration Date:</label>
                      <input type="date" class="form-control" name="land_exp_date" value="">
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
