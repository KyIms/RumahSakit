<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $user=$_SESSION['userid'];
  if(isset($_GET['delete']))
  {
        $id=intval($_GET['delete']);
        $adn="delete from pasien where idPasien=?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Patients Records Deleted";
            header("Location: manage_pasien.php");
          }
            else
            {
                $err = "Try Again Later";
            }
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php');?>

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
                                        <li class="breadcrumb-item"><a href="tambah_pasien.php">Pasien</a></li>
                                        <li class="breadcrumb-item active">Manage Pasien</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Manage Detail Pasien</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"></h4>
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-12 text-sm-center form-inline">
                                            <div class="form-group mr-2" style="display:none">
                                                <select id="demo-foo-filter-status"
                                                    class="custom-select custom-select-sm">
                                                    <option value="">Lihat Semua</option>
                                                    <option value="Discharged">Kembali</option>
                                                    <option value="OutPatients">Rawat Jalan</option>
                                                    <option value="InPatients">Rawat Inap</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="demo-foo-search" type="text" placeholder="Search"
                                                    class="form-control form-control-sm" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0"
                                        justfify-content-center data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Nama</th>
                                                <th data-hide="phone">Nomor</th>
                                                <th data-hide="phone">Alamat</th>
                                                <th data-hide="phone">No Telepon</th>
                                                <th data-hide="phone">Umur</th>
                                                <th data-hide="phone">Kategori</th>
                                                <th data-hide="phone">Diagnosis</th>
                                                <th data-hide="phone">Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php
                                            /*
                                                *get details of allpatients
                                                *
                                            */
                                                $ret="SELECT * FROM  pasien ORDER BY RAND() "; 
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
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row->f_nama;?> <?php echo $row->l_nama;?></td>
                                                <td><?php echo $row->no_pasien;?></td>
                                                <td><?php echo $row->alamat;?></td>
                                                <td><?php echo $row->no_tlp;?></td>
                                                <td><?php echo $row->umur;?> Tahun</td>
                                                <td><?php echo $row->kategori;?></td>
                                                <td><?php echo $row->diagnosis;?></td>

                                                <td>
                                                    <a href="manage_pasien.php?delete=<?php echo $row->idPasien;?>"
                                                        class="badge badge-danger"><i
                                                            class=" mdi mdi-trash-can-outline "></i> Hapus</a>
                                                    <a href="detail_pasien.php?idPasien=<?php echo $row->idPasien;?>&&no_pasien=<?php echo $row->no_pasien;?>"
                                                        class="badge badge-success"><i class="mdi mdi-eye"></i>
                                                        Lihat</a>
                                                    <a href="update_pasien.php?idPasien=<?php echo $row->idPasien;?>"
                                                        class="badge badge-primary"><i
                                                            class="mdi mdi-check-box-outline "></i> Update</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php  $cnt = $cnt +1 ; }?>
                                        <tfoot>
                                            <tr class="active">
                                                <td colspan="10">
                                                    <div class="text-right">
                                                        <ul
                                                            class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0">
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div> <!-- end .table-responsive-->
                            </div> <!-- end card-box -->
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


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Footable js -->
    <script src="assets/libs/footable/footable.all.min.js"></script>

    <!-- Init js -->
    <script src="assets/js/pages/foo-tables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>