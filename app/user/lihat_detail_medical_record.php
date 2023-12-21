<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<?php include ('assets/inc/head.php');?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include('assets/inc/nav.php');?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("assets/inc/sidebar.php");?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <?php
                $mdr_no=$_GET['mdr_no'];
                $mdr_id=$_GET['mdr_id'];
                $ret="SELECT  * FROM medical_records WHERE mdr_id = ?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$mdr_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                    $mysqlDateTime = $row->mdr_date_rec;
            ?>

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
                                        <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Medical Records</a>
                                        </li>
                                        <li class="breadcrumb-item active">Lihat Medical Records</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">#<?php echo $row->mdr_no;?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-xl-5">

                                        <div class="tab-content pt-0">

                                            <div class="tab-pane active show" id="product-1-item">
                                                <img src="assets/images/medical_record.png" alt=""
                                                    class="img-fluid mx-auto d-block rounded">
                                            </div>

                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-xl-7">
                                        <div class="pl-xl-3 mt-3 mt-xl-0">
                                            <h3 class="mb-3">Nama : <?php echo $row->mdr_nama;?></h3>
                                            <hr>
                                            <h4 class="text-danger">Umur : <?php echo $row->mdr_umur;?> Tahun</h4>
                                            <hr>
                                            <h4 class="text-danger ">No Pasien : <?php echo $row->no_pasien;?>
                                            </h4>
                                            <hr>
                                            <h4 class="text-danger ">Keluhan Pasien :
                                                <?php echo $row->mdr_keluhan;?></h4>
                                            <hr>
                                            <h4 class="text-danger ">Data Recor :
                                                <?php echo date("d/m/Y - h:m:s", strtotime($mysqlDateTime));?></h4>
                                            <hr>
                                            <hr>
                                            <h4 class="text-danger ">Resep :
                                                <?php echo $row->mdr_resep;?></h4>
                                            <hr>
                                            <h3 class="align-centre">Hasil Pemeriksaan</h3>
                                            <p class="text-muted mb-4">
                                                <?php echo $row->deskripsi;?>
                                            </p>
                                            <hr>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include('assets/inc/footer.php');?>
            <!-- end Footer -->

        </div>
        <?php }?>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>