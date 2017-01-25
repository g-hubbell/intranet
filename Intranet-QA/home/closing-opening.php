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
    $date=date("m/d/Y");

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
         mysql_select_db($database,$link);
      
                    
    }
    else{
            header('location: http://vapeshop.direct');
            exit();

        
    }
    if(isset($_POST['submit1'])){
        $openclose=$_POST['openclose'];
        $store=$_POST['store'];
        $_SESSION['closeopen']=$openclose;
        $_SESSION['str']=$store;
        if($store == "CC"){
            if($openclose == "open"){
                header("location: http://vapeshop.direct/home/closing-opening.php#ccopen");
            }
            else{
                header("location: http://vapeshop.direct/home/closing-opening.php#ccclose");
            }
        }
        elseif ($store == "NE"){
            if($openclose == "open"){
                header("location: http://vapeshop.direct/home/closing-opening.php#neopen");
            }
            else{
                header("location: http://vapeshop.direct/home/closing-opening.php#neclose");
            }
        }
    }

    if(isset($_POST['submit2'])){
        $array = $_POST['ck_pst'];
        $openclose=$_SESSION['closeopen'];
        $store=$_SESSION['str'];
        if(count($array) < 7){
            echo("please fill out form entrirely");
        }
        $sql="INSERT INTO open_close_post (Date,Store,OpenClose,Username,Completed) VALUES ('$date','$store','$openclose','$username','Yes')";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
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
        <div class = "headerlogo">
            <a href="http://vapeshop.direct/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
        
        
        
        <div class="split">
            <form action="closing-opening.php" method="POST">
                <select id="openclose" name="openclose">
                    <option value="open">Open</option>
                    <option value="close">Close</option>
                </select>
                <select id="store" name="store">
                    <option value="CC">Center City</option>
                    <option value="NE">Northeast</option>
                </select>
                <input type="submit" value="Submit" id="submit1" name="submit1">
            </form>
        </div>
        
        
        
        <div class="page">
            <div class ="tar" id="ccopen">
               <h3>CC Open</h3>
                <form action="closing-opening.php" method="POST">
                   <p><?php echo($username); ?></p>
                   <p><?php echo($date);?></p>
                    <input type="checkbox" name="ck_pst[]" value="1">Turn Lights On<br>
                    <input type="checkbox" name="ck_pst[]" value="2">Turn Monitors On<br>
                    <input type="checkbox" name="ck_pst[]" value="3">Turn Tablets On<br>
                    <input type="checkbox" name="ck_pst[]" value="4">Turn Open Sign On<br>
                    <input type="checkbox" name="ck_pst[]" value="5">Turn Music On<br>
                    <input type="checkbox" name="ck_pst[]" value="6">Start Slideshow<br>
                    <input type="checkbox" name="ck_pst[]" value="7">Clock-In<br>
                    <input type="submit" value="Submit" name="submit2" id="submit2">
                </form>
            </div>
            <div class ="tar" id="neopen">
                <h3>NE Open</h3>
                <form action="closing-opening.php" method="POST">
                   <p><?php echo($username); ?></p>
                   <p><?php echo($date);?></p>
                    <input type="checkbox" name="ck_pst[]" value="1">Turn Lights On<br>
                    <input type="checkbox" name="ck_pst[]" value="2">Turn Monitors On<br>
                    <input type="checkbox" name="ck_pst[]" value="3">Turn Tablets On<br>
                    <input type="checkbox" name="ck_pst[]" value="4">Turn Open Sign On<br>
                    <input type="checkbox" name="ck_pst[]" value="5">Turn Music On<br>
                    <input type="checkbox" name="ck_pst[]" value="6">Start Slideshow<br>
                    <input type="checkbox" name="ck_pst[]" value="7">Clock-In<br>
                    <input type="submit" value="Submit" name="submit2" id="submit2">
                </form>
                
            </div>
            <div class ="tar"id="ccclose">
                <h3>CC Close</h3>
                <form action="closing-opening.php" method="POST">
                   <p><?php echo($username); ?></p>
                   <p><?php echo($date);?></p>
                    <input type="checkbox" name="ck_pst[]" value="1">Turn Lights Off<br>
                    <input type="checkbox" name="ck_pst[]" value="2">Turn Monitors Off<br>
                    <input type="checkbox" name="ck_pst[]" value="3">Turn Tablets Off<br>
                    <input type="checkbox" name="ck_pst[]" value="4">Turn Open Sign Off<br>
                    <input type="checkbox" name="ck_pst[]" value="5">Turn Music Off<br>
                    <input type="checkbox" name="ck_pst[]" value="6">Stop Slideshow<br>
                    <input type="checkbox" name="ck_pst[]" value="7">Clock-Out<br>
                    <input type="submit" value="Submit" name="submit2" id="submit2">
                </form>
            </div>
            <div class ="tar" id="neclose">
                <h3>NE Close</h3>
                <form action="closing-opening.php" method="POST">
                   <p><?php echo($username); ?></p>
                   <p><?php echo($date);?></p>
                    <input type="checkbox" name="ck_pst[]" value="1">Turn Lights Off<br>
                    <input type="checkbox" name="ck_pst[]" value="2">Turn Monitors Off<br>
                    <input type="checkbox" name="ck_pst[]" value="3">Turn Tablets Off<br>
                    <input type="checkbox" name="ck_pst[]" value="4">Turn Open Sign Off<br>
                    <input type="checkbox" name="ck_pst[]" value="5">Turn Music Off<br>
                    <input type="checkbox" name="ck_pst[]" value="6">Stop Slideshow<br>
                    <input type="checkbox" name="ck_pst[]" value="7">Clock-Out <br>
                    <input type="submit" value="Submit" name="submit2" id="submit2">
                </form>
            </div>
        </div>
    </body>
</html>