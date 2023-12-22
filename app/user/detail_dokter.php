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
                $id_dokter=$_GET['id_dokter'];
                $ret="SELECT  * FROM dokter WHERE id_dokter=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$id_dokter);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                $no_dokter=$_GET['no_dokter'];
                //$cnt=1;
                while($row=$res->fetch_object())
            {
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dokter</a></li>
                                        <li class="breadcrumb-item active">Lihat Dokter</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?php echo $row->f_nama;?> <?php echo $row->l_nama;?>
                                    Profil</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-auto">
                            <div class="card-box text-center">
                                <img src="./assets/images/profil/<?php echo $row->doc_dpic;?>"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">


                                <div class="text-centre mt-3 ">

                                    <p class="text-muted mb-2 font-13"><strong>Nama Lengkap :</strong> <span
                                            class="ml-2"><?php echo $row->f_nama;?>
                                            <?php echo $row->l_nama;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Spesialis :</strong> <span
                                            class="ml-2"><?php echo $row->spesialis;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Nomor:</strong> <span
                                            class="ml-2"><?php echo $row->no_dokter;?></span></p>
                                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                                            class="ml-2"><?php echo $row->email;?></span></p>
                                </div>

                            </div> <!-- end card-box -->

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