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
      <div class="middle">
          <button class="button company1">New Jiandra Enterprises </button>
          <button class="button company2">Mrs.P Mktg. </button>
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <thead class="tableheader">
            <tr>
              <th>Supplier Logo</th>
              <th>Supplier Name</th>
              <th>Action</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class ="tablelist">
            <tr>
              <th>Ariane's Name</th>
              <td>Ariane Donza</td>
              <td><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              <td><button class="status">Inactive</button></td>
            </tr>
            <tr>
              <th>Rogen's Name</th>
              <td>Rojs Gen</td>
              <td><i class="fa fa-clone" aria-hidden="true"></i><i class="fas fa-pen"></i><i class="fa fa-trash" aria-hidden="true"></i></td>
              <td><button class="status1">Active</button></td>
            </tr>
          </tbody>
      </div>
    </div>
</div>
