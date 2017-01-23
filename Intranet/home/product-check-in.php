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
            header('location: http://hsglobalinc.com');
            exit();

    }

    if(isset($_POST['submit1'])){
        $sku = $_POST['sku'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $sql="INSERT INTO new_product_post (CreatedProductUser,CreatedProductDate,SKU,Description,Price,CreatedProduct) VALUES ('$username','$date','$sku','$desc','$price','Yes')";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
        }
        else{
            $sql="INSERT INTO alert_post (Date,Username,Post) VALUES ('$date','$username','New Products Ordered! Look for the reviews soon!')";
            $result=mysql_query($sql);
            if(!$result){
                echo(mysql_error());
            }
            else{
                mysql_select_db('portal_messages',$link);
                
                $email_to="craig@hsglobalinc.com, grant@hsglobalinc.com";
                $email_subject="New Product Created!";
                $email_message="\n"."New Product Info: \n";
                $email_message.="SKU: ".$sku."\n";
                $email_message.="Description: ".$desc."\n";
                $email_message.="Price: $".$price."\n";
                $email_message.="Reveiew to come soon!";
                $email_from_site="portal@hsglobalinc.com";
                $headers = 'From: '.$email_from_site."\r\n".

                            'Reply-To: '.$email_from_site."\r\n" .

                            'X-Mailer: PHP/' . phpversion(). "\r\n".
                        'MIME-Version: 1.0'."\r\n".
                        'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                
                
                
                $sql="INSERT INTO messages (Date,Sender,Recipient,Subject,Message,Readyet) VALUES ('$date','SYSTEM','cr2','New Product Posted','$email_message','')";
                $result=mysql_query($sql);
                if(!$result){
                    echo(mysql_error());
                }
                else{
                    $sql="INSERT INTO messages (Date,Sender,Recipient,Subject,Message,Readyet) VALUES ('$date','SYSTEM','grh2','New Product Posted','$email_message','')";
                    $result=mysql_query($sql);
                    if(!$result){
                        echo(mysql_error());
                    }
                    else{
                        echo("New Product Created!");
                        mysql_select_db($database,$link);
                        mail($email_to, $email_subject, $email_message, $headers);
                    }
                }
                
                
            }
        }
    }


    if(isset($_POST['submit2'])){
        $sku=$_POST['skuselect'];
        $review=$_POST['review'];
        $dir="../docs/";
        $file=fopen($dir."review".$sku.".txt","a");
        $sql = "UPDATE new_product_post SET CreatedReviewUser = '$username', CreatedReviewDate = '$date', Review ='$review', Reviewed = 'Yes' WHERE SKU = '$sku'";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
        }
        else{
            $filetext="<h4>In-Hand Review Notes</h4> \n";
            $filetext.="<p>".$review."</p> \n";
            fwrite($file,$filetext);
            fclose($file);
            $sql="INSERT INTO alert_post (Date,Username,Post) VALUES ('$date','$username','New First Look Posted! Check out the New Product Page!')";
            $result=mysql_query($sql);
            if(!$result){
                echo(mysql_error());
            }
            else{
                $email_to="craig@hsglobalinc.com, grant@hsglobalinc.com";
                $email_subject="New Product Review Addition!";
                $email_message="\n"."Updated Review Link: \n";
                $email_message.="SKU: ".$sku."\n";
                $email_message.="<a href='http://hsglobalinc.com/home/product-check-in.php#viewreview'>Review</a>"."\n";
                $email_message.="Look for product in store soon!";
                $email_from_site="portal@hsglobalinc.com";
                $headers = 'From: '.$email_from_site."\r\n".

                            'Reply-To: '.$email_from_site."\r\n" .

                            'X-Mailer: PHP/' . phpversion(). "\r\n".
                        'MIME-Version: 1.0'."\r\n".
                        'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                
                mail($email_to, $email_subject, $email_message, $headers);
                echo("New Impression Submitted!");
            }
        }
    }


    if(isset($_POST['submit3'])){
        $sku = $_POST['sku'];
        $checkin = $_POST['check'];
        $sql = "UPDATE new_product_post SET ProductCheckIn = '$checkin' WHERE SKU ='$sku'";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
        }
        else{
            echo("product checked in!");
        }
    }

    if(isset($_POST['submit4'])){
        $sku=$_POST['skuselect2'];
        $dir="../docs/";
        $file=fopen($dir."review".$sku.".txt","w");
        $reviewimg1=$_POST['reviewimg1'];
        $reviewimg2=$_POST['reviewimg2'];
        $reviewimg3=$_POST['reviewimg3'];
        $pros=$_POST['pros'];
        $cons=$_POST['cons'];
        $overall=$_POST['overall'];
        $sellingpts=$_POST['sellingpts'];
        
        
        $filetext= "<h2>".$sku."</h2>";
        $filetext.="<img src='".$reviewimg1."'> \n";
        $filetext.="<img src='".$reviewimg2."'> \n";
        $filetext.="<img src='".$reviewimg3."'> \n";
        $filetext.="<h4>Pros</h4>
                <p>".$pros."</p> \n";
        $filetext.="<h4>Cons</h4>
                <p>".$cons."</p> \n";
        $filetext.="<h4>Overall</h4>
                <p>".$overall."</p> \n";
        $filetext.="<h4>Selling Points</h4>
                <p>".$sellingpts."</p> \n";
        fwrite($file,$filetext);
        fclose($file);
        $sql = "UPDATE new_product_post SET  InDepthReview ='Yes' WHERE SKU = '$sku'";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
        }
        else{
                $email_to="craig@hsglobalinc.com, grant@hsglobalinc.com";
                $email_subject="New Product Review!";
                $email_message="\n"."New Review Link: \n";
                $email_message.="SKU: ".$sku."\n";
                $email_message.="<a href='http://hsglobalinc.com/home/product-check-in.php#viewreview'>Review</a>"."\n";
                $email_message.="Look for product in store soon!";
                $email_from_site="portal@hsglobalinc.com";
                $headers = 'From: '.$email_from_site."\r\n".

                            'Reply-To: '.$email_from_site."\r\n" .

                            'X-Mailer: PHP/' . phpversion(). "\r\n".
                        'MIME-Version: 1.0'."\r\n".
                        'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                
                mail($email_to, $email_subject, $email_message, $headers);
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
        <link rel="icon"type="image/png" href="http://hsglobalinc.com/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png" />
        <title>Holy Smokes Employee Portal</title>
    </head>
    <body>
        <div class = "headerlogo">
            <a href="http://hsglobalinc.com/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
        <div class="splitpage">
            <ul>
               <li> <a class="left" href="#default">Basic info </a></li>
              <li>  <a class="center" href="#indepthreview">In-Depth Review</a></li>
              <li> <a class = 'right' href='#viewreview'>View Reviewed Products</a></li>
            </ul>
        </div>
        
        <div class="page">
        <a id="default">
        
        <?php echo("<div class='createnewproduct");
            if($tablename !=="owners_managers_list"){
                echo(" hidden'>");
            }
            else{
                echo("'>");
            }
        ?>
           <h3>Create New Product</h3>
            <form action ="product-check-in.php" method="POST">
                <p>Username: <?php echo($username);?></p>
                <p>Date: <?php echo($date);?></p>
                <input type="text" placeholder="SKU" id="sku" name="sku"><br>
                <input type="text" placeholder="Description" id="desc" name="desc"><br>
                <input type="text" placeholder="Price" id="price" name="price"><br>
                <input type="submit" value ="Submit" name="submit1" id="submit1">
            </form>
        <?php echo("</div>");?>
        
        <?php echo("<div class ='uploadnewproductreview");
            if($tablename !=="owners_managers_list"){
                echo(" hidden'>");
            }
            else{
                echo("'>");
            }
        ?>
           <h3>New Product Impression</h3>
            <form action = "product-check-in.php" method="POST">
                <p>Username: <?php echo($username);?></p>
                <p>Date: <?php echo($date);?></p>
                <select name="skuselect" id="skuselect">
                   <?php
                        $sql="SELECT * FROM new_product_post WHERE CreatedProduct ='Yes' AND InDepthReview = 'Yes' AND Reviewed !='Yes'";
                        $result=mysql_query($sql);
                        if(!$result){
                            echo(mysql_error());
                        }
                        while($row=mysql_fetch_assoc($result)){
                            echo("<option value='".$row['SKU']."'>".$row['SKU']."</option>");
                        }
                    ?>
                </select><br> 
                <textarea class ="newproductreview" name="review" id="review"></textarea><br>
                <input type ="submit" value="Submit" id="submit2" name="submit2">
            </form>
        
        
        
        <?php echo("</div>");?>    
        <div class ="check-in">
            <h3>Product Check-In</h3>
                <form action = 'product-check-in.php' method='POST'>
                    <table class = 'posttable'>
                        <tr>
                           <th>SKU: </th>
                            <th>Created On: </th>
                            <th>Reviewed On: </th>
                            <th>Check In: </th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM new_product_post WHERE CreatedProduct = 'Yes' AND Reviewed = 'Yes' AND InDepthReview = 'Yes'";
                            $result = mysql_query($sql);
                            while($row = mysql_fetch_assoc($result)){
                                if($row['ProductCheckIn'] == 'Yes'){
                                    echo ("<tr><td>".$row["SKU"]."</td><td>".$row["CreatedProductDate"]."</td><td>".$row["CreatedReviewDate"]."</td><td>".$row["ProductCheckIn"]."</td></tr>");
                                }
                                else{
                                    echo ("<tr><td>".$row["SKU"]."</td><td>".$row["CreatedProductDate"]."</td><td>".$row["CreatedReviewDate"]."</td><td><input type='checkbox' value='Yes' name='check' id='check'></td></tr>");
                                    echo("<input type='hidden' value='".$row['SKU']."' id='sku' name='sku'>");
                                }
                                
                                }
                            
                            
                            
                            
                        
                    
                    ?>
                    </table>
                    <input type ='submit' value ='Submit' name = 'submit3' id='submit3'>
            </form>
        </div>
      </a>
      <a id="indepthreview">
          <div class = "reviewsection">
             <h3>In-Depth Review</h3>
              <form action = "product-check-in.php" method="POST" enctype="multipart/form-data">
                    <p>Username: <?php echo($username);?></p>
                    <p>Date: <?php echo($date);?></p>
                    <select name="skuselect2" id="skuselect2">
                        <?php
                            $sql = "SELECT * FROM new_product_post WHERE CreatedProduct = 'Yes' AND Reviewed != 'Yes' AND InDepthReview != 'Yes'";
                            $result=mysql_query($sql);
                            if(!$result){
                                echo(mysql_error());
                            }
                            while($row=mysql_fetch_assoc($result)){
                                echo("<option value='".$row['SKU']."'>".$row['SKU']."</option>");
                            }
                        ?>
                    </select><br><br>
                    <h4>Image Links: </h4>
                    <input type="text" name="reviewimg1" id="reviewimg1"><br>
                    <input type="text" name="reviewimg2" id="reviewimg2"><br>
                    <input type="text" name="reviewimg3" id="reviewimg3"><br>
                    <h4>Pros: </h4>
                    <textarea id="pros" name="pros"></textarea><br>
                    <h4>Cons: </h4>
                    <textarea id="cons" name="cons"></textarea><br>
                    <h4>Overall Review: </h4>
                    <textarea id="overall" name="overall"></textarea><br>
                    <h4>Selling Points: </h4>
                    <textarea id="sellingpts" name="sellingpts"></textarea><br>
                    <input type="submit" value="Submit" name="submit4" id="submit4">
              </form>
          </div>
      </a>
      <a id="viewreview">
          <div class ="viewreview">
             <?php
                $dir="../docs/";
                $files=scandir($dir);
                $i = 0;
                while($i < count($files)){
                  if(strpos($files[$i],"review") !== false){
                    $handle = fopen($dir.$files[$i],'r');
                    echo("<div class ='products'>");
                    while($buffer = fgets($handle)){
                        
                        echo($buffer);
                    }
                    echo("</div>");
                  }
                  $i++;
              }
              
              ?>
              
          </div>
      </a>
    </div>
     
      
      
      
    </body>
</html>