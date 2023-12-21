<?php
if (isset($_POST['user_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT username ,pwd , userid FROM users WHERE username=? AND pwd=? "); //sql to log in
    $stmt->bind_param('ss', $username, $password); //bind fetched parameters
    $stmt->execute(); //execute bind
    $stmt->bind_result($username, $password, $user); //bind result
    $rs = $stmt->fetch();
    $_SESSION['userid'] = $user; //Assign session to admin id
    //$uip=$_SERVER['REMOTE_ADDR'];
    //$ldate=date('d/m/Y h:i:s', time());
    if ($rs) { //if its sucessfull
        header("location:app/user/dashboard.php");
    } else {

        $err = "Access Denied Please Check Your Credentials";
    }
}
