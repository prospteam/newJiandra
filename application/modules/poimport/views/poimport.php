<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> PURCHASE ORDER IMPORT</h1>
                    HOME > <span class="active1"> CSV IMPORTS </p>
                </div>
            </div>
        </div>
    </section>
    <div class="row p-y-15 p-x-10 m-x-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product CSV Import</h3>
                <div class="card-tools">
                     <a href="<?php echo base_url('assets/uploads/templates/products_import.csv'); ?>" class="btn btn-success btn-sm " download>Download CSV Template</a>
                </div>
            </div>
            <hr>
            <div class="card-body table-responsive text-center">
                <form id="submit_po_import">
                    <input name="import_type" hidden="" readonly="">
                    <div class="csvimport__file">
                        <strong><p class="csv_title"></p></strong>
                        <p>Click here to upload (only accepts .csv file)</p>
                        <input type="file" name="csv_file_pos" id="csv_file" class="csv_file">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-md m-t-15" value="Submit">
                </form>
            </div>

            <div id="csv_file_data">

            </div>

        </div>
    </div>
</div>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <!-- /.card-header -->
            <!-- <div class="card-body1">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">.
                        <div class="table-responsive">
                            <div class="col-sm-12">
                                <div id="csv_file_data_po"></div>
                                <!-- <table class="table table-bordered table-striped dataTable" role="grid"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <th class="header-title">SKU</th>
                                        <th class="header-title">Descrition</th>
                                        <th class="header-title">Packing</th>
                                        <th class="header-title">Brand</th>
                                        <th class="header-title">Category</th>
                                        <th class="header-title">Variants</th>
                                        <th class="header-title">Volume</th>
                                        <th class="header-title">Units</th>
                                        <th class="header-title">Unit</th>
                                    </thead>
                                    <tbody class="to_duplicate_add">

                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div> -->
            <!-- /.card-body -->
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
