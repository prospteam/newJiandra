<?php echo "hi"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Supplier</b></h1>
          ENROLLMENT > <span class="active1"> SUPPLIER </p>
        </div>
        <div class="col-sm-6">
            <button  type="button"class="button1 float-sm-right" data-toggle="modal" data-target="#exampleModal "><i class="fas fa-plus-circle" aria-hidden="true"></i> Add User </button>
        </div>
        <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <label for="supplier_name">Supplier Name:</label>
                <input type="text" name="supplier_name" value="">
                <label for="supplier_contact_person">Supplier Contact Person:</label>
                <input type="text" name="supplier_contact_person" value="">
                <label for="company">Company:</label>
                <input type="text" name="company" value="">
                <label for="vendor">Vendor:</label>
                <input type="text" name="vendor" value="">
                <label for="office_number">Office Number:</label>
                <input type="text" name="office_number" value="">
                <label for="home_phone">Home Phone:</label>
                <input type="text" name="home_phone" value="">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" name="mobile_number" value="">
                <label for="tin">TIN:</label>
                <input type="text" name="tin" value="">
                <label for="tin">Fax Number:</label>
                <input type="text" name="fax_number" value="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
    <!-- Default box -->
    <div class="main header">
      <div class="col-md-12">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <button class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">New Jiandra</button>
                <button class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Mrs.P</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <table class="table" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Supplier Logo</th>
                          <th>Supplier Name</th>
                          <th>Action</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>Company Logo</td>
                        <td>Rojs Gen</td>
                        <td><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
                        <td><button type="button" class="active btn btn-block btn-success">active</button></td>
                      </tr>
                      <tr>
                        <td>Company Logo</td>
                        <td>Ariane</td>
                        <td><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
                        <td><button type="button" class="inactive btn btn-block btn-danger">inactive</button></td>
                      </tr>
                  </tbody>
              </table>
          </div>
    </div>
</div>
