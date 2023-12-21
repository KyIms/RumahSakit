<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $user=$_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<!--Head Code-->
<?php include("assets/inc/head.php");?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include('assets/inc/nav.php');?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include('assets/inc/sidebar.php');?>
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

                                <h4 class="page-title">Rumah Sakit Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <!--Start Rawat Jalan-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="fab fa-accessible-icon  font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                                    //code untuk jumlah pasien rawat jalan
                                                    $result ="SELECT count(*) FROM pasien WHERE kategori = 'Rawat Jalan' ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($rawatjalan);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                            <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?php echo $rawatjalan;?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Rawat Jalan</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Rawat Jalan-->


                        <!--Start Rawat Inap-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="mdi mdi-hotel   font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                                    //code untuk jumlah pasien rawat inap 
                                                    $result ="SELECT count(*) FROM pasien WHERE kategori = 'Rawat Inap' ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($rawatinap);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                            <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?php echo $rawatinap;?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Rawat Inap</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Rawat Inap-->

                        <!--Start Dokter-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="mdi mdi-doctor font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                                    //code untuk jumlah dokter yang bekerja 
                                                    $result ="SELECT count(*) FROM dokter ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($doc);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                            <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?php echo $doc;?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Dokter</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Dokter-->

                    </div>

                    <div class="row">

                        <!--Start User-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="fas fa-user-tag font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                                    /*code untuk jumlah user yang ada
                                                     */ 
                                                    $result ="SELECT count(*) FROM users ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($user);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                            <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?php echo $user;?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">User</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End User-->

                        <!--Start Obat-->
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="mdi mdi-pill font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <?php
                                                    /* 
                                                     * code untuk jumlah obat yang tersedia
                                                     */ 
                                                    $result ="SELECT count(*) FROM obat ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($phar);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                            <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?php echo $phar;?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Obat</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                        <!--End Obat-->

                    </div>



                    <!--Daftar Dokter-->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Daftar Dokter</h4>

                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-centered m-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="2">Gambar</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Spesialis</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php
                                                $ret="SELECT * FROM dokter ORDER BY RAND() LIMIT 10 "; 
                                                //sql code to get to ten docs  randomly
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>
                                        <tbody>
                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="./assets/images/profil/<?php echo $row->doc_dpic;?>"
                                                        alt="img" title="contact-img"
                                                        class="rounded-circle avatar-sm" />
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <?php echo $row->f_nama;?> <?php echo $row->l_nama;?>
                                                </td>
                                                <td>
                                                    <?php echo $row->email;?>
                                                </td>
                                                <td>
                                                    <?php echo $row->spesialis;?>
                                                </td>
                                                <td>
                                                    <a href="detail_dokter.php?id_dokter=<?php echo $row->id_dokter;?>&&no_dokter=<?php echo $row->no_dokter;?>"
                                                        class="btn btn-xs btn-primary"><i class="mdi mdi-eye"></i>
                                                        Lihat</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php }?>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include('assets/inc/footer.php');?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->



    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Plugins js-->
    <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
    <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.time.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.selection.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.crosshair.js"></script>

    <!-- Dashboar 1 init js-->
    <script src="assets/js/pages/dashboard-1.init.js"></script>

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

</body>

</html>