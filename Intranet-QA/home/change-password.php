<?php  
    session_start();
    error_reporting(E_ALL);
    date_default_timezone_set('America/New_York');
   $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "user-db";
    $user = $_SESSION['user'];
    $table = $_SESSION['table'];

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
        mysql_select_db($database,$link);
    }
    if(isset($_POST['submit'])){
        $servername = "localhost:3306";
        $serveruser = "manager-intra";
        $serverpass = "Genie2222";
        $newpass = $_POST['newpass'];
        $repeat = $_POST['repeat'];
    

       

       if($newpass != $repeat){
            echo("passwords do not match");
        }
        else{
           $repass = hash('sha512',$newpass);
            $sql = "UPDATE $table SET Password = '$repass' WHER E Username ='$user' ";
            $result = mysql_query($sql);
            if(!$result){
                echo(mysql_error());
            }
            else{
                if($table == "owners_managers_list"){
                    header('location: http://vapeshop.direct/home/manager/home-manager.php');
                }
                else{
                    header('location: http://vapeshop.direct/home/employee/home.php');
                }
            }
        }
    
            
    }
    



?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/stylesheet.min.css">
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
       <div class="login">
       <h1>Change Password</h1>
        <form action='change-password.php' method="POST">
            <p>Username: <?php echo($user);?></p>
            <input type = 'password'placeholder="New Password" id ="newpass"name="newpass">
            <input type = 'password' placeholder = "Repeat Password" id='repeat' name = 'repeat'><br>
            <input type = 'submit' value ="Submit" id='submit' name='submit'>
            
        </form>
        </div>
    </body>
</html>