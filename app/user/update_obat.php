<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_pharmaceutical']))
		{
			$nama_obat = $_POST['nama_obat'];
			$deskripsi = strip_tags($_POST['deskripsi']);
            $jumlah = $_POST['jumlah'];
            $kategori = $_POST['kategori'];
            $barcode = $_GET['barcode'];
            
                
            //sql to insert captured values
			$query="UPDATE  obat SET nama_obat = ?, deskripsi = ?, jumlah = ?, kategori = ? WHERE barcode = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssss', $nama_obat, $deskripsi, $jumlah, $kategori, $barcode);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Data Obat Diupdate";
                sleep(2);
                header("Location: manage_obat.php");
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
        <?php
                $barcode = $_GET['barcode'];
                $ret="SELECT  * FROM obat  WHERE barcode=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$barcode);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
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
                                        <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Obat</a></li>
                                        <li class="breadcrumb-item active">Manage Obat</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Update #<?php echo $row->barcode;?> -
                                    <?php echo $row->nama_obat;?></h4>
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
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Nama Obat
                                                    <input type="text" required="required"
                                                        value="<?php echo $row->nama_obat;?>" name="nama_obat"
                                                        class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Quantity Obat
                                                    (Karton)</label>
                                                <input required="required" type="text"
                                                    value="<?php echo $row->jumlah;?>" name="jumlah"
                                                    class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState" class="col-form-label">Kategori Obat</label>
                                                <input class="form-control" type="text" id="inputState"
                                                    value="<?php echo $row->kategori;?>" required="required"
                                                    name="kategori">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Deskripsi Obat</label>
                                            <textarea required="required" type="text" class="form-control"
                                                name="deskripsi" id="editor" <?php echo $row->deskripsi;?>></textarea>
                                        </div>

                                        <button type="submit" name="update_pharmaceutical"
                                            class="ladda-button btn btn-warning" data-style="expand-right">Update
                                            Obat</button>

                                    </form>

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
        <?php }?>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    <!--Load CK EDITOR Javascript-->
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>

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