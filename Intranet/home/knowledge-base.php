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
            header('location: http://hsglobalinc.com');
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
        <link rel="icon"type="image/png" href="http://hsglobalinc.com/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png" />
        <SCRIPT LANGUAGE="javascript">
            function click() {
                if (event.button==2) {
                    alert('Sorry, this function is disabled.')
                }
            }
            document.onMouseDown=click
        </SCRIPT>
        <title>Holy Smokes Employee Portal</title>
    </head>
    <body>
       <div class = "headerlogo">
            <a href="http://hsglobalinc.com/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
       <div class="acctinfo">
            <h3>Acct Info</h3>
            <h5>Username: <?php  echo($username);?> </h5>
            
               
            
                <h5>Account Type: <?php if($tablename == "employee_list"){
                                            echo("Employee");
                                        }
                                        else{
                                            echo("Manager");
                                        }
                                    ?>
                </h5>
            
        </div>
        <div class="kbsearch">
            <form action="knowledge-base.php" method ="POST">
                <input type="text" placeholder="Search" name="query" id="query">
                <input type ="submit" value ="Search" id="submit" name ="submit">
            </form>
        </div>
        <br>
        <br>
        <div class ="kbsearchoutput">
           <?php
            
            if(isset($_POST['query']) and $_POST['query'] !== ""){
                $query=strtolower($_POST['query']);
                $dir = "../docs/";
                $files = scandir($dir);
                $i=0;
                $j=0;
                while($i < count($files)){
                    $handle = fopen($dir.$files[$i],'r');
                    while($buffer = fgets($handle)){
                        $buffer=strtolower($buffer);
                        $filecompare=strtolower($files[$i]);
                       
                        if(strpos($filecompare, $query) !== false and strpos($buffer,$query) !== false){
                            echo("<a href = 'http://hsglobalinc.com/home/doc-view.php?linkval=".$j."&filen=".$files[$i]."'>".$files[$i]."</a>");
                            echo("<br><p>");
                            echo("Name found in link");
                            echo("</p><br>");
                            $j++;
                            break;
                        }
                        elseif(strpos($filecompare, $query) !== false){
                            echo("<a href = 'http://hsglobalinc.com/home/doc-view.php?linkval=".$j."&filen=".$files[$i]."'>".$files[$i]."</a>");
                            echo("<br><p>");
                            echo("Name found in link");
                            echo("</p><br>");
                            $j++;
                            break;
                        }
                        
                        elseif(strpos($buffer,$query) !== false) {
                        
                            echo("<a href = 'http://hsglobalinc.com/home/doc-view.php?linkval=".$j."&filen=".$files[$i]."'>".$files[$i]."</a>");
                            echo("<br><p>");
                            echo($buffer);
                            echo("</p><br>");
                            $j++;

                        }
                        
                        }
                
                    
                    $i++;
                    $j=0;
                }
                
            $_SESSION['query1'] = $query;
            }
            elseif(isset($_POST['query']) and $_POST['query'] == ""){
                echo("<h3 class = 'emptysearch'>Please enter valid query </h3> ");
            }
            else{
                echo("<h3 class ='emptysearch'>Please enter a search </h3>");
            }
            ?>
            
        </div>
        
    </body>
</html>