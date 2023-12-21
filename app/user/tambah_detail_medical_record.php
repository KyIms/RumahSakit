<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_patient_mdr']))
		{
			$mdr_nama = $_POST['mdr_nama'];
			$no_pasien = $_POST['no_pasien'];
            //$pres_pat_type = $_POST['pres_pat_type'];
            $mdr_alamat = $_POST['mdr_alamat'];
            $mdr_umur = $_POST['mdr_umur'];
            $mdr_no = $_POST['mdr_no'];
            $mdr_resep = $_POST['mdr_resep'];
            $deskripsi = $_POST['deskripsi'];
            $mdr_keluhan = $_POST['mdr_keluhan'];
            //sql to insert captured values
			$query="INSERT INTO  medical_records  (mdr_nama, no_pasien, mdr_alamat, mdr_umur, mdr_no, mdr_resep, mdr_keluhan, deskripsi) VALUES(?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssss', $mdr_nama, $no_pasien, $mdr_alamat, $mdr_umur, $mdr_no, $mdr_resep, $mdr_keluhan, $deskripsi);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Medical Record Ditambahkan";
                header("Location: tambah_medical_record.php");
        exit();
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
                $no_pasien = $_GET['no_pasien'];
                $ret="SELECT  * FROM pasien WHERE no_pasien=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$no_pasien);
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
                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Medical Records</a>
                                        </li>
                                        <li class="breadcrumb-item active">Tambah Medical Record</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tambah Medical Record</h4>
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
                                                <label for="inputEmail4" class="col-form-label">Nama Pasien</label>
                                                <input type="text" required="required" readonly name="mdr_nama"
                                                    value="<?php echo $row->f_nama;?> <?php echo $row->l_nama;?>"
                                                    class="form-control" id="inputEmail4" placeholder="Nama Pasien">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Umur Pasien</label>
                                                <input required="required" type="text" readonly name="mdr_umur"
                                                    value="<?php echo $row->umur;?>" class="form-control"
                                                    id="inputPassword4" placeholder="Umur Pasien">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Alamat Pasien</label>
                                                <input required="required" type="text" readonly name="mdr_alamat"
                                                    value="<?php echo $row->alamat;?>" class="form-control"
                                                    id="inputPassword4" placeholder="Alamat Pasien">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">No Pasien</label>
                                                <input type="text" required="required" readonly name="no_pasien"
                                                    value="<?php echo $row->no_pasien;?>" class="form-control"
                                                    id="inputEmail4" placeholder="DD/MM/YYYY">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Keluhan
                                                    Pasien</label>
                                                <input required="required" type="text" readonly name="mdr_keluhan"
                                                    value="<?php echo $row->keluhan;?>" class="form-control"
                                                    id="inputPassword4" placeholder="Keluhan Pasien">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Resep
                                                    Pasien</label>
                                                <input required="required" type="text" name="mdr_resep"
                                                    class="form-control" id="inputPassword4" placeholder="Resep Pasien">
                                            </div>
                                        </div>
                                        <?php }?>
                                        <hr>
                                        <div class="form-row">


                                            <div class="form-group col-md-2" style="display:none">
                                                <?php 
                                                            $length = 5;    
                                                            $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                        ?>
                                                <label for="inputZip" class="col-form-label">No Medical Record
                                                </label>
                                                <input type="text" name="mdr_no" value="<?php echo $pres_no;?>"
                                                    class="form-control" id="inputZip">
                                            </div>
                                        </div>
                                        <?php
                                                    $pres_no_pasien = $_GET['no_pasien'];
                                                    $ret="SELECT  * FROM resep WHERE pres_no_pasien = ?";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->bind_param('s',$pres_no_pasien);
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                ?>

                                        <?php }?>


                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Hasil Pemeriksaan</label>
                                            <textarea required="required" type="text" class="form-control"
                                                name="deskripsi" id="editor"> </textarea>
                                        </div>

                                        <button type="submit" name="add_patient_mdr"
                                            class="ladda-button btn btn-primary" data-style="expand-right">Tambah
                                            Medical Record</button>

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