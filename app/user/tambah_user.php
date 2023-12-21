<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_vendor']))
		{
			$nama=$_POST['nama'];
			$alamat=$_POST['alamat'];
			$nomor=$_POST['nomor'];
            $no_tlp = $_POST['no_tlp'];
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $user_dpic = $_POST['user_dpic'];
            //$doc_pwd=sha1(md5($_POST['doc_pwd']));
            
            //sql to insert captured values
			$query="INSERT INTO users (nama, alamat, nomor,  no_tlp, username, pwd, user_dpic) values(?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssss', $nama, $alamat, $nomor, $no_tlp, $username, $pwd, $user_dpic);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Tambah User";
                sleep(1);
                header("Location: manage_user.php");
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">

<!--Head-->
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                        <li class="breadcrumb-item active">Tambah User</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tambah Detail User</h4>
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
                                    <form method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">Nama User</label>
                                                <input type="text" required="required" name="nama" class="form-control"
                                                    id="inputEmail4">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">No Telepon</label>
                                                <input required="required" type="text" name="no_tlp"
                                                    class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Alamat</label>
                                                <input required="required" type="text" name="alamat"
                                                    class="form-control" id="inputPassword4">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2" style="display:none">
                                            <?php 
                                                        $length = 5;    
                                                        $vendor_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                            <label for="inputZip" class="col-form-label">No User</label>
                                            <input type="text" name="nomor" value="<?php echo $vendor_number;?>"
                                                class="form-control" id="inputZip">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Username</label>
                                            <input required="required" type="text" class="form-control" name="username"
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
                                                <input type="file" name="user_dpic" class="btn btn-success form-control"
                                                    id="inputCity">
                                            </div>
                                        </div>

                                        <button type="submit" name="add_vendor" class="ladda-button btn btn-success"
                                            data-style="expand-right">Tambah User</button>

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
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>

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