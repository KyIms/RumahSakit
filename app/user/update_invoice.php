<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_payroll']))
		{
			$pay_id = $_GET['pay_id'];
			$pay_nama = $_POST['pay_nama'];
			$pay_no = $_POST['pay_no'];
            //$pres_pat_type = $_POST['pres_pat_type'];
            // $no_pasien = $_POST['no_pasien'];
            $resep = $_POST['resep'];
            $pay_emp_salary = $_POST['pay_emp_salary'];
            $pay_descr = $_POST['pay_descr'];
            $pay_status = $_POST['pay_status'];
            //$mdr_pat_ailment = $_POST['mdr_pat_ailment'];
            //sql to insert captured values
			$query="UPDATE invoice SET pay_nama=?, pay_no = ?, resep=?, pay_emp_salary=?, pay_descr=?, pay_status = ? WHERE pay_id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssss',  $pay_nama, $pay_no, $resep, $pay_emp_salary, $pay_descr, $pay_status, $pay_id);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Payroll Record Updated ";
                header("Location: manage_invoice.php");
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
                $pay_id = $_GET['pay_id'];
                $ret="SELECT  * FROM invoice WHERE pay_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pay_id);
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                                        <li class="breadcrumb-item active">Update Invoice</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Update Invoice Pasien</h4>
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
                                                <label for="inputPassword4" class="col-form-label">No Invoice</label>
                                                <input required="required" type="text" readonly name="pay_no"
                                                    value="<?php echo $row->pay_no;?>" class="form-control"
                                                    id="inputPassword4" placeholder="no Invoice">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">Nama Pasien</label>
                                                <input type="text" required="required" readonly name="pay_nama"
                                                    value="<?php echo $row->pay_nama;?>" class="form-control"
                                                    id="inputEmail4" placeholder="Patient's Name">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="col-form-label">Jenis Obat</label>
                                                <input required="required" type="text" readonly name="resep"
                                                    value="<?php echo $row->resep?>" class="form-control"
                                                    id="inputPassword4" placeholder="Patient`s Last Name">
                                            </div>

                                        </div>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Total Biaya
                                                    (Rp)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" required="required" name="pay_emp_salary"
                                                        value="<?php echo $row->pay_emp_salary;?>" class="form-control"
                                                        id="inputEmail4">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputState" class="col-form-label">Payroll Status</label>
                                                <select id="inputState" required="required" name="pay_status"
                                                    class="form-control">
                                                    <option>Pilih</option>
                                                    <option>Lunas</option>
                                                    <option>Belum Lunas</option>
                                                </select>
                                            </div>
                                        </div>

                                </div>


                                <div class="form-group">
                                    <label for="inputAddress" class="col-form-label col-md-2">Deskripsi Invoice</label>
                                    <textarea type="text" class="form-control" name="pay_descr" id="editor"
                                        value="<?php echo $row->pay_descr;?>"> </textarea>
                                </div>

                                <button type="submit" name="update_payroll" class="ladda-button btn btn-primary"
                                    data-style="expand-right">Update Invoice</button>

                                </form>
                                <!--End Patient Form-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                    <?php }?>
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