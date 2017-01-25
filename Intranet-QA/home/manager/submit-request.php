<?php
    session_start();
    error_reporting(E_ALL);
    date_default_timezone_set('America/New_York');
    
    $username = $_SESSION['user'];
    $tablename = $_SESSION['table'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "intranet_posts";

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
        mysql_select_db($database,$link);
    }
    else{
            header('location: http://vapeshop.direct');
            exit();

        
    }
    if(isset($_POST['submit1'])){
        $requesttype=$_POST['requesttype'];
        $storecode=$_POST['storecode'];
        $request=$_POST['request'];
        $table = "request_post";
        $date=date("m/d/Y");

  
        $sql="INSERT INTO $table (Date,Username,Storecode,Requesttype,Request)
        VALUES ('$date','$username','$storecode','$requesttype','$request')";


       $result= mysql_query($sql);


        if(!$result){
            echo(mysql_error());
        }
        else{
            
            if($requesttype == "restock" or $requesttype =="transfer"){
                $email_to="frank@hsglobalinc.com,rich@hsglobalinc.com";
                $email_subject="Product ".$requesttype." Request";
                $email_message="\n"."New ".$requesttype." Request"." \n";
                $email_message.="Store: ".$storecode."\n";
                $email_message.="Request: ".$request."\n";
                $email_from_site="portal@hsglobalinc.com";
                $headers = 'From: '.$email_from_site."\r\n".

                            'Reply-To: '.$email_from_site."\r\n" .

                            'X-Mailer: PHP/' . phpversion(). "\r\n".
                        'MIME-Version: 1.0'."\r\n".
                        'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                
                mail($email_to, $email_subject, $email_message, $headers);
                header("location: http://vapeshop.direct/home/manager/home-manager.php");
            }
            elseif($requesttype=="signage"){
                $email_to="taylor@hsglobalinc.com,heidi@hsglobalinc.com";
                $email_subject="Product ".$requesttype." Request";
                $email_message="\n"."New ".$requesttype." Request"." \n";
                $email_message.="Store: ".$storecode."\n";
                $email_message.="Request: ".$request."\n";
                $email_from_site="portal@hsglobalinc.com";
                $headers = 'From: '.$email_from_site."\r\n".

                            'Reply-To: '.$email_from_site."\r\n" .

                            'X-Mailer: PHP/' . phpversion(). "\r\n".
                        'MIME-Version: 1.0'."\r\n".
                        'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                
                mail($email_to, $email_subject, $email_message, $headers);
                header("location: http://vapeshop.direct/home/manager/home-manager.php");
            }
            
        }

    }
    

?>
   <html>
    <head>
        <link rel="stylesheet" type="text/css" href="/stylesheet.min.css" media="screen">
        <link href='//fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <style>
            body {
                font-family: 'Roboto';
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon"type="image/png" href="http://vapeshop.direct/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png" />
        <title>Holy Smokes Employee Portal</title>
    </head>
   <body>
    <div class = "headerlogo">
            <a href="http://vapeshop.direct/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
     <div class="login">
      <h1>Submit New Request</h1>
       <div class = "form">
        <form action="submit-request.php" method="POST">
            <input type="radio" name = "requesttype" id="product" value ="product"> New Product Request<br>
            <input type="radio" name = "requesttype" id="transfer" value ="transfer"> Product Transfer Request <br>
            <input type="radio" name = "requesttype" id="restock" value ="restock"> Re-Stock Request <br>
            <input type="radio" name = "requesttype" id="signage" value ="signage"> Signage Request <br>
            <input type="radio" name = "requesttype" id="time-off" value ="time-off"> Time-Off Request<br>
            <p>Username: <?php echo($username); ?></p>
            <select name="storecode" id="storecode">
                <option value="CC">Center City</option>
                <option value="NE">Northeast</option>
            </select><br>
            <textarea name="request" id = "request" class = "request" row = "5" col ="6" ></textarea><br>
            <input type="submit" value = "Submit" id="submit1" name="submit1">
        </form>
        </div>
        </div>
    </body>


</html>
   




