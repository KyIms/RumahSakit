<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['userid'];
if (isset($_GET['delete_mdr_pat_id'])) {
    $id = intval($_GET['delete_mdr_pat_id']);
    $adn = "DELETE FROM medical_records WHERE mdr_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $success = "Medical Records Deleted";
        header("Location: manage_medical_record.php");
    } else {
        
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php'); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include('assets/inc/nav.php'); ?>
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Medical Records</a>
                                        </li>
                                        <li class="breadcrumb-item active">Manage Medical Records</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Manage Medical Records</h4>
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
                                        data-page-size="7">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Nama Pasien</th>
                                                <th data-hide="phone">No Pasien</th>
                                                <th data-hide="phone">Alamat</th>
                                                <th data-hide="phone">Keluhan</th>
                                                <th data-hide="phone">Umur</th>
                                                <th data-hide="phone">Hasil Pemeriksaan</th>
                                                <th data-hide="phone">Resep</th>
                                                <th data-hide="phone">Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        /*
                                                *get details of allpatients
                                                *
                                            */
                                        $ret = "SELECT * FROM  medical_records ORDER BY RAND() ";
                                        //sql code to get to ten docs  randomly
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row->mdr_nama; ?></td>
                                                <td><?php echo $row->no_pasien; ?></td>
                                                <td><?php echo $row->mdr_alamat; ?></td>
                                                <td><?php echo $row->mdr_keluhan; ?></td>
                                                <td><?php echo $row->mdr_umur; ?> Tahun</td>
                                                <td><?php echo $row->deskripsi; ?></td>
                                                <td><?php echo $row->mdr_resep; ?></td>
                                                <td>
                                                    <a href="lihat_detail_medical_record.php?mdr_id=<?php echo $row->mdr_id; ?>&&mdr_no=<?php echo $row->mdr_no; ?>"
                                                        class="badge badge-success"><i class="fas fa-eye"></i> Lihat</a>
                                                    <a href="update_medical_record.php?mdr_no=<?php echo $row->mdr_no; ?>"
                                                        class="badge badge-warning"><i class="fas fa-eye-dropper "></i>
                                                        Update</a>
                                                    <a href="manage_medical_record.php?delete_mdr_pat_id=<?php echo $row->mdr_id;?>"
                                                        class="badge badge-danger"><i
                                                            class="fas fa-trash-alt"></i>Hapus</a>


                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php $cnt = $cnt + 1;
                                        } ?>
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

    <!-- Footable js -->
    <script src="assets/libs/footable/footable.all.min.js"></script>

    <!-- Init js -->
    <script src="assets/js/pages/foo-tables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>