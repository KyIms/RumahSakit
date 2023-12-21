<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php');?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include("assets/inc/nav.php");?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("assets/inc/sidebar.php");?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <!--Get Details Of A Single User And Display Them Here-->
        <?php
                $no_pasien=$_GET['no_pasien'];
                $idPasien=$_GET['idPasien'];
                $ret="SELECT  * FROM pasien WHERE idPasien=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$idPasien);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
            {
                $mysqlDateTime = $row->pat_date_joined;
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pasien</a></li>
                                        <li class="breadcrumb-item active">Lihat Pasien</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?php echo $row->f_nama;?> <?php echo $row->l_nama;?>
                                    Profil</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <div class="card-box text-center">
                                <img src="assets/images/users/patient.png"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">


                                <div class="text-left mt-3">

                                    <p class="text-muted mb-2 font-13"><strong>Nama Lengkap :</strong> <span
                                            class="ml-2"><?php echo $row->f_nama;?>
                                            <?php echo $row->l_nama;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>No Telepeon :</strong><span
                                            class="ml-2"><?php echo $row->no_tlp;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Alamat :</strong> <span
                                            class="ml-2"><?php echo $row->alamat;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Tanggal Lahir :</strong> <span
                                            class="ml-2"><?php echo $row->pat_dob;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Umur :</strong> <span
                                            class="ml-2"><?php echo $row->umur;?> Tahun</span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Keluhan :</strong> <span
                                            class="ml-2"><?php echo $row->keluhan;?></span></p>
                                    <hr>
                                    <p class="text-muted mb-2 font-13"><strong>Data Record :</strong> <span
                                            class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($mysqlDateTime));?></span>
                                    </p>
                                    <hr>




                                </div>

                            </div> <!-- end card-box -->

                        </div> <!-- end col-->

                        <!--<?php }?> -->
                        <div class="col-lg-8 col-xl-8">
                            <div class="card-box">
                                <ul class="nav nav-pills navtab-bg nav-justified">
                                    <li class="nav-item">
                                        <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            Medical Record
                                        </a>
                                    </li>
                                </ul>
                                <!--Medical History-->
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="aboutme">
                                        <ul class="list-unstyled timeline-sm">
                                            <?php
                                                    $pres_no_pasien =$_GET['no_pasien'];
                                                    $ret="SELECT  * FROM resep WHERE pres_no_pasien ='$pres_no_pasien'";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    // $stmt->bind_param('i',$pres_pat_number );
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    
                                                    while($row=$res->fetch_object())
                                                        {
                                                    $mysqlDateTime = $row->pres_date; //trim timestamp to date

                                                ?>
                                            <li class="timeline-sm-item">
                                                <span
                                                    class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($mysqlDateTime));?></span>
                                                <h5 class="mt-0 mb-1"><?php echo $row->pres_keluhan;?></h5>
                                                <p class="text-muted mt-2">
                                                    <?php echo $row->pres_ins;?>
                                                </p>

                                            </li>
                                            <?php }?>
                                        </ul>

                                    </div> <!-- end tab-pane -->
                                    <!-- end Prescription section content -->
                                </div>
                                <!-- end vitals content-->
                            </div>
                            <!-- end lab records content-->

                        </div> <!-- end tab-content -->
                    </div> <!-- end card-box-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

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

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>


</html>