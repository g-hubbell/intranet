<?php
    session_start();
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
       
        <div class = "headerlogo">
            <a href="http://vapeshop.direct/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
        
        <?php 
            $dir = "../download/";
            $files = scandir($dir);
            $i=0;
            while($i < count($files)){
                echo("<a href ='".$dir.$files[$i]."' target='_blank'>".$files[$i]."</a>");
                $i++;
            }
        
        
        
        ?>
        
        
        
        
        
        
    </body>
</html>