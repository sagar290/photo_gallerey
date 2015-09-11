<?php 

//for delete image
  //check the image
  //unlink the file
  if (isset($_POST['check']) && !empty($_POST['check'])) {
       //find the file
      $file = $_POST['check'];
      //delete from directory
      if(is_file($file)){
          unlink($file);
          header('Location: gallery.php');
          echo $_POST['check']." has successfully deleted";
      }else{
          echo $_POST['check']." has not been found!";
      }
  } else{
  	header('Location: gallery.php');
    echo "Select any image for delete";
  }

 ?>