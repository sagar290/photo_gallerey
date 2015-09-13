<?php
//upload image
//check the file is selected
if (isset($_FILES["file"]["name"])) {
  //
  $name = $_FILES['file']['name'];
  $type = strtolower($_FILES['file']['type']);
  $tmp_name = $_FILES['file']['tmp_name'];


  if (isset($name)) {
    if (!empty($name)) {
      //extention
      if (($type=='image/jpg')||($type=='image/jpeg')||($type=='image/gif')) {
        $location = 'photos/';

        if(move_uploaded_file($tmp_name, 'photos/'.$name)) {
          echo $name.' is uploaded';

        }
      }else {
        echo 'file must be jpg or jpeg ';
      }


    }else {
      echo 'please choose a file';
    }
  }
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Photo gallery</title>

    <style type="text/css">
        ul {
          list-style-type: none;
        }
      li {
        float: left;
        padding: 10px;
        margin: 10px;
        font: bold 10px Verdana, sans-serif;
      }
      img {
        display: block;
        border: 1px solid #333300;
        margin-bottom: 5px;
      }
    </style>

  </head>
  <body>
    <h2>Photo gallery</h2>
    
      <form action="gallery.php" method="POST" enctype="multipart/form-data">
      Upload Image:
      <input type="file" name="file"><br><br>
      <input type="submit" value="Click here to Upload">
    </form>


    <br><br>
    <form action="remove.php" method="POST" >
            <input type="submit" name="remove" value="Select image and Delete">
      <ul>
        
<?php


    //define location of photo image
    $photosDir = './photos';

    //define which file extention are images
    $photosExt = array('gif','jpg','jpeg','tif','tiff','bmp','png');

    //initialize array to hold filenames of images found
    $photoList = array();

    //read directory contents
    //build photo list
    if (file_exists($photosDir)) {
      $dp = opendir($photosDir) or die('Error: cannot open file');
      while ($file =  readdir($dp)) {
        if ($file != '.' && $file != '..') {
          $fileData = pathinfo($file);
          if (in_array($fileData['extension'], $photosExt)) {
            $photoList[] = "$photosDir/$file"; // file includes as an array
          }
        }
      }
      
      closedir($dp);
    }else {
      die('ERROR: directory dosent exists');
    }

    //itarate over photo list
    //display each image and file name
    if (count($photoList)>0) {
      for ($x=0; $x <count($photoList) ; $x++) {
        ?>

        <li>
          <input type="checkbox" name="check" value="<?php echo $photoList[$x] ?>">
          <img src="<?php echo $photoList[$x]; ?>" height="150" width="200"/>
          <?php echo basename($photoList[$x]); ?><br>
          <?php echo round(filesize($photoList[$x])/1024) . 'KB'; ?>
        </li>

        <?php
      }
    } else {
      die('ERROR: No image found');
    }




    
?>

    
    </ul>
  </form>
  </body>
</html>
