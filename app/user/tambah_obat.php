<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_pharmaceutical']))
		{
			$nama_obat = $_POST['nama_obat'];
			$deskripsi = $_POST['deskripsi'];
            $jumlah = $_POST['jumlah'];
            $kategori = $_POST['kategori'];
            $barcode = $_POST['barcode'];
            $phar_vendor = $_POST['phar_vendor'];
                
            //sql to insert captured values
			$query="INSERT INTO obat (nama_obat, barcode, deskripsi, jumlah, kategori, phar_vendor) VALUES (?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssss', $nama_obat, $barcode, $deskripsi, $jumlah, $kategori, $phar_vendor);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Obat Ditambahkan";
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Obat</a>
                                        </li>
                                        <li class="breadcrumb-item active">Tambah Obat</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tambah Daftar Obat</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <!--Add Patient Form-->
                                    <form method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Nama Obat</label>
                                                <input type="text" required="required" name="nama_obat"
                                                    class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Obat
                                                    Quantity(Karton)</label>
                                                <input required="required" type="text" name="jumlah"
                                                    class="form-control" id="inputPassword4">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Kategori Obat</label>
                                                <input required="required" type="text" name="kategori"
                                                    class="form-control" id="inputPassword4">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword4" class="col-form-label">Barcode Obat
                                                (EAN-8)</label>
                                            <?php 
                                                        $length = 10;    
                                                        $phar_bcode =  substr(str_shuffle('0123456789'),1,$length);
                                                    ?>
                                            <input required="required" type="text" value="<?php echo $phar_bcode;?>"
                                                name="barcode" class="form-control" id="inputPassword4">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Deskripsi Obat</label>
                                            <textarea required="required" type="text" class="form-control"
                                                name="deskripsi" id="editor"></textarea>
                                        </div>

                                        <button type="submit" name="add_pharmaceutical"
                                            class="ladda-button btn btn-success"
                                            data-style="expand-right">Simpan</button>

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