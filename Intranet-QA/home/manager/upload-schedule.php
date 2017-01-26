<?php
    error_reporting(E_ALL);
    
   if ($_FILES["userFile"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["userFile"]["error"] . "<br>";
    }
    else
    {
        if(isset($_POST['submit1'])){
            if (file_exists("../../schedule.PNG"))
            {
                chmod('../../schedule.PNG',0644);
                unlink('../../schedule.PNG');
                $upload= move_uploaded_file($_FILES["userFile"]["tmp_name"], "../../schedule.PNG");
                if(!$upload){
                    echo('upload failed');
                }
                else{
                   header("location: http://vapeshop.direct/home/manager/home-manager.php"); 
                }
            }
            else{

                $upload= move_uploaded_file($_FILES["userFile"]["tmp_name"], "../../schedule.PNG");
                if(!$upload){
                    echo('upload failed');
                }
                else{
                   header("location: http://vapeshop.direct/home/manager/home-manager.php"); 
                }
            }
        }
        if(isset($_POST['submit2'])){
            if (file_exists("../../images/schedule2.PNG"))
            {
                chmod('../../schedule.PNG',0644);
                unlink('../../images/schedule2.PNG');
                $upload= move_uploaded_file($_FILES["userFile"]["tmp_name"], "../../images/schedule2.PNG");
                if(!$upload){
                    echo('upload failed');
                }
                else{
                   header("location: http://vapeshop.direct/home/manager/home-manager.php"); 
                }
            }
            else{

                $upload= move_uploaded_file($_FILES["userFile"]["tmp_name"], "../../images/schedule2.PNG");
                if(!$upload){
                    echo('upload failed');
                }
                else{
                   header("location: http://vapeshop.direct/home/manager/home-manager.php"); 
                }
            }
        }
    }



    
?>