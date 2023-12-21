<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');
if (isset($_POST['add_doc'])) {
    $f_nama = $_POST['f_nama'];
    $l_nama = $_POST['l_nama'];
    $no_dokter = $_POST['no_dokter'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $spesialis = $_POST['spesialis']; // Mendapatkan nilai spesialisasi dari form
    $doc_dpic=$_FILES["doc_dpic"]["name"];
    move_uploaded_file($_FILES["doc_dpic"]["tmp_name"],"./assets/images/profil/".$_FILES["doc_dpic"]["name"]);
        
    $query = "INSERT INTO dokter (f_nama, l_nama, no_dokter, email, pwd, spesialis, doc_dpic) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssss', $f_nama, $l_nama, $no_dokter, $email, $pwd, $spesialis, $doc_dpic);
    $stmt->execute();
    /*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
    //declare a varible which will be passed to alert function
    if ($stmt) {
        $_SESSION['success'] = "Employee Details Added";
        header("Location: manage_dokter.php");
        exit();
    } else {
        $_SESSION['error'] = "Please Try Again Or Try Later";
        header("Location: manage_dokter.php");
        exit();
    }
}
?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">

<!--Head-->
<?php include('assets/inc/head.php'); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include("assets/inc/nav.php"); ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("assets/inc/sidebar.php"); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dokter</a></li>
                                        <li class="breadcrumb-item active">Tambah Dokter</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tambah Detail Dokter</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title"></h4>
                                    <!--Add Patient Form-->
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Nama Depan</label>
                                                <input type="text" required="required" name="f_nama"
                                                    class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Nama Belakang</label>
                                                <input required="required" type="text" name="l_nama"
                                                    class="form-control" id="inputPassword4">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputSpecialization" class="col-form-label">Spesialis</label>
                                            <input type="text" class="form-control" name="spesialis"
                                                id="inputSpecialization">
                                        </div>

                                        <div class="form-group col-md-2" style="display:none">
                                            <?php

                                            $length = 5;
                                            $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                            ?>
                                            <label for="inputZip" class="col-form-label">Nomor</label>
                                            <input type="text" name="no_dokter" value="<?php echo $patient_number; ?>"
                                                class="form-control" id="inputZip">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Email</label>
                                            <input required="required" type="email" class="form-control" name="email"
                                                id="inputAddress">
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity" class="col-form-label">Password</label>
                                                <input required="required" type="password" name="pwd"
                                                    class="form-control" id="inputCity">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputCity" class="col-form-label">Gambar Profil</label>
                                                <input type="file" name="doc_dpic" class="btn btn-success form-control"
                                                    id="inputCity">
                                            </div>
                                        </div>
                                        <button type="submit" name="add_doc" class="ladda-button btn btn-success"
                                            data-style="expand-right">Tambah Dokter</button>

                                    </form>
                                    <!--End Patient Form-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include('assets/inc/footer.php'); ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

    <!-- Loading buttons js -->
    <script src="assets/libs/ladda/spin.js"></script>
    <script src="assets/libs/ladda/ladda.js"></script>

    <!-- Buttons init js-->
    <script src="assets/js/pages/loading-btn.init.js"></script>

</body>

</html>