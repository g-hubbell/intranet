<?php
    
    session_start();
    error_reporting(E_ALL);
    
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repass=$_POST['repass'];
    $passphrase=$_POST['passphrase'];

    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "user_db";

        
    $link =  mysql_connect($servername, $serveruser, $serverpass);
    if(!$link){
        echo(mysql_error());
    }
    else{
        echo("connected successfully");
    }
    mysql_select_db($database,$link);


    if($repass != $password){
        echo("Passwords do not match");
    }


    if ($passphrase == "Jackal"){
        $table = "owners_managers_list";
    }

    elseif ($passphrase == "dontsaybong"){
        $table="employee_list"; 
    }
    
    else{
        echo("Passphrase invalid");
    }

    $sql = "SELECT Key FROM $table WHERE MAX('Key')";
    
    $result = mysql_query($sql);
    
    if(!$result){
        echo( mysql_error());
    
}
    $key = $result + 1;


    
    $sql = "INSERT INTO $table (Key,Username, Password) VALUES ($key, $username, $password)";
    $result = mysql_query($sql);

    if(!$result){
        echo( mysql_error());
    
}
    $_SESSION['user']=$username;

    if($table == "owners_managers_list"){
        header("location: http://hsglobalinc.com/home/manager/home-manager.php");
    }
    elseif($table =="employee_list"){
        header("location: http://hsglobalinc.com/home/employee/home.php");
    }


?>