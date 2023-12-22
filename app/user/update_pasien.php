<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_patient']))
		{
            $idPasien = $_GET['idPasien'];
			$f_nama=$_POST['f_nama'];
			$l_nama=$_POST['l_nama'];
			$no_pasien=$_POST['no_pasien'];
            $no_tlp=$_POST['no_tlp'];
            $kategori=$_POST['kategori'];
            $alamat=$_POST['alamat'];
            $umur = $_POST['umur'];
            $pat_dob = $_POST['pat_dob'];
            $keluhan = $_POST['keluhan'];
            $diagnosis = $_POST['diagnosis'];
            //sql to insert captured values
			$query="UPDATE  pasien  SET f_nama=?, l_nama=?, umur=?, pat_dob=?, no_pasien=?, no_tlp=?, kategori=?, alamat=?, keluhan=?, diagnosis=? WHERE idPasien = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssssssi', $f_nama, $l_nama, $umur, $pat_dob, $no_pasien, $no_tlp, $kategori, $alamat, $keluhan, $diagnosis, $idPasien);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success['success'] = "Patient Details Updated";
                sleep(2);
                header("Location: manage_pasien.php");
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pasien</a></li>
                                        <li class="breadcrumb-item active">Manage Pasien</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Update Detail Pasien</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <!--LETS GET DETAILS OF SINGLE PATIENT GIVEN THEIR ID-->
                    <?php
                            $idPasien=$_GET['idPasien'];
                            $ret="SELECT  * FROM pasien WHERE idPasien=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$idPasien);
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
                                    <form method="post">
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
                                                    class="form-control" id="inputPassword4"
                                                    placeholder="Nama Belakang">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Tanggal Lahir</label>
                                                <input type="text" required="required"
                                                    value="<?php echo $row->pat_dob;?>" name="pat_dob"
                                                    class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Umur</label>
                                                <input required="required" type="text" value="<?php echo $row->umur;?>"
                                                    name="umur" class="form-control" id="inputPassword4"
                                                    placeholder="Umur">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Alamat</label>
                                            <input required="required" type="text" value="<?php echo $row->alamat;?>"
                                                class="form-control" name="alamat" id="inputAddress"
                                                placeholder="Alamat">
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputCity" class="col-form-label">No Telepon</label>
                                                <input required="required" type="text"
                                                    value="<?php echo $row->no_tlp;?>" name="no_tlp"
                                                    class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCity" class="col-form-label">Keluhan</label>
                                                <input required="required" type="text"
                                                    value="<?php echo $row->keluhan;?>" name="keluhan"
                                                    class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState" class="col-form-label">Tipe Pasien</label>
                                                <select id="inputState" required="required" name="kategori"
                                                    class="form-control">
                                                    <option>Pilih</option>
                                                    <option>Rawat Inap</option>
                                                    <option>Rawat Jalan</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2" style="display:none">
                                                <?php 
                                                        $length = 5;    
                                                        $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                                <label for="inputZip" class="col-form-label">Tambah Pasien</label>
                                                <input type="text" name="no_pasien"
                                                    value="<?php echo $patient_number;?>" class="form-control"
                                                    id="inputZip">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputAddress" class="col-form-label">Diagnosis
                                                    Penyakit</label>
                                                <textarea required="required" type="text" class="form-control"
                                                    name="diagnosis" id="editor"
                                                    <?php echo $row->diagnosis;?>></textarea>
                                            </div>
                                        </div>

                                        <button type="submit" name="update_patient" class="ladda-button btn btn-success"
                                            data-style="expand-right">Tambah Pasien</button>

                                    </form>
                                    <!--End Patient Form-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <?php  }?>
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

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

    <!-- Loading buttons js -->
    <script src="assets/libs/ladda/spin.js"></script>
    <script src="assets/libs/ladda/ladda.js"></script>

    <!-- Buttons init js-->
    <script src="assets/js/pages/loading-btn.init.js"></script>

</body>

</html>