<?php
    
 


    $username=$_POST['username'];
    $password=$_POST['password'];
    $usertype=$_POST['usertype'];




    if ($usertype == "manager"){
        $servername = "localhost:3306";
        $serveruser = "manager-intra";
        $serverpass = "Genie2222";
        $database = "user-db";
        $table = "owners_managers_list";

        
        
    }

    else{
        $servername = "localhost:3306";
        $serveruser = "employee_intra";
        $serverpass = "Genie2222";
        $database = "user-db";
        $table = "employee_list";
        
            
    }


    $link =  mysql_connect($servername, $serveruser, $serverpass);

     mysql_select_db($database,$link);

    $result = mysql_query("SELECT * FROM $table WHERE Username LIKE '$username'");
    
    $row = mysql_fetch_assoc($result);



    if ($row['Password'] == $password){
        mysql_close($link);
        $user=$username;
        
        session_start();
        
        ob_start();
        
        $_SESSION['user']=$user;
        $_SESSION['table']=$table;
        if($table == "owners_managers_list"){
            header('location: http://hsglobalinc.com/home/manager/home-manager.php');
        }
        else{
            header('location: http://hsglobalinc.com/home/employee/home.php');
        }
        
        exit();
    }
    else{
        echo("---");
        echo("<br>");
        echo($result);
        echo("<br>");
        echo("Incorrect password");
    }
    

    
   

    
?>
    