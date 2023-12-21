<?php
$user = $_SESSION['userid'];
$ret = "select * from users where userid=?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $user);
$stmt->execute(); //ok
$res = $stmt->get_result();
//$cnt=1;
while ($row = $res->fetch_object()) {
?>
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="d-none d-sm-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li>


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" ata-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <img src="./assets/images/profil/<?php echo $row->user_dpic; ?>" alt="dpic" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    <?php echo $row->nama; ?>
                </span>
            </a>
        </li>
        <li style="padding: 23px 15px;">
            <a href="proses_logout.php" style="color: #fff; text-decoration: none;">
                Logout <i class="fe-log-out" style="color: #fff;"></i>
            </a>
        </li>
    </ul>

    <!-- LOGO -->
    <div class=" logo-box">
        <a href="dashboard.php" class="logo text-center">
            <span class="logo-lg">
                <!-- <img src="assets/images/D.png" alt="" height="50" width="100"> -->
                <span class=" logo-lg-text-light">Rumah Sakit </span>
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="assets/images/logo-sm-white.png" alt="" height="24">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li class="dropdown d-none d-lg-block">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                Create New
                <i class="mdi mdi-chevron-down"></i>
            </a>
            <div class="dropdown-menu">
                <!-- item-->
                <a href="tambah_pasien.php" class="dropdown-item">
                    <i class="fe-activity mr-1"></i>
                    <span>Pasien</span>
                </a>

                <!-- item-->
                <a href="tambah_dokter.php" class="dropdown-item">
                    <i class="fe-users mr-1"></i>
                    <span>Dokter</span>
                </a>

                <!-- item-->
                <a href="tambah_obat.php" class="dropdown-item">
                    <i class="mdi mdi-pill mr-1"></i>
                    <span>Obat</span>
                </a>

                <!-- item-->
                <a href=" tambah_medical_record.php" class="dropdown-item">
                    <i class="fe-list mr-1"></i>
                    <span>Medical Report</span>
                </a>

                <!-- item-->
                <a href="tambah_invoice.php" class="dropdown-item">
                    <i class="fe-layers mr-1"></i>
                    <span>Invoice</span>
                </a>

                <!-- item-->
                <a href="tambah_user.php" class="dropdown-item">
                    <i class="fe-shopping-cart mr-1"></i>
                    <span>User</span>
                </a>



                <div class="dropdown-divider">
                </div>


            </div>
        </li>

    </ul>
</div>
<?php } ?>