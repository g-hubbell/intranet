
   

   
   
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
      <h1>Create New Post</h1>
       <div class = "form">
        <form action="post.php" method="POST">
            <input type="radio" name = "posttype" id="alert" value ="alert"> New Alert <br>
            <input type="radio" name = "posttype" id="ccnotif" value ="ccnotif"> Center City Post <br>
            <input type="radio" name = "posttype" id="nenotif" value ="nenotif"> Northeast Post<br>
            <p>Username: <?php echo($username);?></p>
            <textarea name="post" id="post" class = "post" row = "10" col ="8" ></textarea><br>
            <input type="submit" value = "Submit">
        </form>
        </div>
        </div>
    </body>
</html>
	