<?php

    session_start();
    ob_start();
    error_reporting(E_ALL);
    date_default_timezone_set('America/New_York');
    
    $posttype=$_POST['posttype'];
    $user=$_SESSION['user'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "intranet_posts";
    $post=$_POST['post'];
    $date=date('m/d/Y');
    $lastposted='';

        if($posttype == "alert"){
            $sql = "INSERT INTO alert_post (Date,Username, Post,LastPosted)
        VALUES ('$date','$user',' $post','$lastposted')"; 
        }
        elseif($posttype == "ccnotif"){
            $sql = "INSERT INTO cc_post (Date,Username, Post,LastPosted)
        VALUES ('$date','$user', '$post','$lastposted')"; 
        }
        elseif($posttype == "nenotif"){
            $sql = "INSERT INTO ne_post (Date,Username, Post,LastPosted)
        VALUES ('$date','$user', '$post','$lastposted')";
        }
        
    
        $link =  mysql_connect($servername, $serveruser, $serverpass);
        if(!$link){
            echo("conn not successful" . mysql_error());
        }
        mysql_select_db($database,$link);
        
       $result= mysql_query($sql);
        if(!$result){
            die("invalid query:" . mysql_error());
        }
        else{
            mysql_close($link);
            header("location: http://hsglobalinc.com/home/manager/home-manager.php");
            
            exit();
        }
        /*
        $email_to = ; 
 
        $email_subject = "Holy Smokes Intranet Update Notification";
        
        $email_message .= "Username: ".$username."\n\n";
  
        $email_message .= "Store Code: ".$storecode."\n\n";
	
	   $email_message .= "Request Type: ".$table"\n\n";
	
	   $email_message .= "Request: ".$request."\n\n";

    
        $headers = 'From: '.$email_from_site."\r\n".
 
            'Reply-To: '.$email_from_site."\r\n" .
 
            'X-Mailer: PHP/' . phpversion();

        mail($email_to, $email_subject, $email_message, $headers);  
        
        */ 
?>