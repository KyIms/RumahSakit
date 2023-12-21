<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_doc']))
		{
			$f_nama=$_POST['f_nama'];
			$l_nama=$_POST['l_nama'];
			$id_dokter=$_GET['id_dokter'];
            $email=$_POST['email'];
            $pwd=$_POST['pwd'];
            $doc_dpic=$_FILES["doc_dpic"]["name"];
		    move_uploaded_file($_FILES["doc_dpic"]["tmp_name"],"./assets/images/profil/".$_FILES["doc_dpic"]["name"]);

            //sql to insert captured values
			$query="UPDATE dokter SET f_nama=?, l_nama=?,  email=?, pwd=?, doc_dpic=? WHERE id_dokter = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssss', $f_nama, $l_nama, $email, $pwd, $doc_dpic, $id_dokter);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Employee Details Updated";
                sleep(2);
                header("Location:manage_dokter.php");
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
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
                                        <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dokter</a></li>
                                        <li class="breadcrumb-item active">Manage Dokter</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Update Detail Dokter</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <?php
                            $id_dokter=$_GET['id_dokter'];
                            $ret="SELECT  * FROM dokter WHERE id_dokter=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$id_dokter);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                        ?>
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
                                                <input type="text" required="required"
                                                    value="<?php echo $row->f_nama;?>" name="f_nama"
                                                    class="form-control" id="inputEmail4" placeholder="Nama Depan">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Nama Belakang</label>
                                                <input required="required" type="text"
                                                    value="<?php echo $row->l_nama;?>" name="l_nama"
                                                    class="form-control" id="inputPassword4">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Email</label>
                                            <input required="required" type="email" value="<?php echo $row->email;?>"
                                                class="form-control" name="email" id="inputAddress">
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

                                        <button type="submit" name="update_doc" class="ladda-button btn btn-success"
                                            data-style="expand-right">Simpan</button>

                                    </form>
                                    <!--End Patient Form-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    <?php }?>

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

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

    <!-- Loading buttons js -->
    <script src="assets/libs/ladda/spin.js"></script>
    <script src="assets/libs/ladda/ladda.js"></script>

    <!-- Buttons init js-->
    <script src="assets/js/pages/loading-btn.init.js"></script>

</body>

</html>