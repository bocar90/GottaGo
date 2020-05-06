<!DOCTYPE html>
<html>
<head>
	<title>Uploading a Photo</title>
</head>
<body>
<?php 
	/*
		$_FILES: An associative array of items uploaded to the current php file using POST
		$_FILES[?]['name']     : original name of the uploaded file
		$_FILES[?]['type']     : get the extension of the file
		$_FILES[?]['tmp_name'] : name of folder where the file is temporarily stored
		$_FILE[?]['error']     : errors when uploading the file
		check website for errors https://www.php.net/manual/en/features.file-upload.errors.php
		$_FILE[?]['size']      : get the size of the image in bytes
	*/

	if(isset($_POST["sendPhoto"])){
		var_dump($_FILES["photo"]);
		//check if the file is uploaded with sucess
		//echo $_FILES["photo"]["name"][0];
		if( isset( $_FILES["photo"]["type"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
			$target_dir = "images/"; //define folder to save the uploaded file
			//expect string "photos/minion.jpg"
			$target_file = $target_dir.basename($_FILES["photo"]["name"]);

			echo "<br><br>".$target_file."<br>";

			//getting extension of the uploaded file
			$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

			echo "Extension: $file_type<br>";
			$accepted = array("jpg", "JPG", "png", "gif", "jpeg", "JPEG");
			if( !in_array($file_type, $accepted)){
				echo "JPG only";
			}
			//move the uploaded file from temporary folder to project folder
			else if(!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))
			{
				echo "There was a problem uploading that photo".$_FILES["photo"]["error"];
			} else{
				echo "Thank you ".$_POST['visitorName']."<br>";
			}
		} else {
			//checking errors
			switch( $_FILES["photo"]["error"] ) {
 				case UPLOAD_ERR_INI_SIZE: //max size set up in php.ini
					$message = "The photo is larger than the server allows.";
 					break;
 				case UPLOAD_ERR_FORM_SIZE: //max size set up in html form
 					$message = "The photo is larger than the script allows.";
 					break;
 				case UPLOAD_ERR_NO_FILE:
 					$message = "No file was uploaded. Make sure you choose a file to upload.";
 					break;
 				default:
 					$message = "Please contact your server administrator for help.";
			} echo " Sorry, there was a problem uploading the image. ".$message;
		}
	}
?>
 		<h1>Uploading a Photo</h1>
 		<p>Please enter your name and choose a photo to upload, then click Send Photo.</p>
 		<form action="upload.php" method="post" enctype="multipart/form-data">
 			<div style="width: 30em;">
 				<p>
 					<!-- limit size of uploaded file <= 500000 Bytes or 500 KB -->
		 			<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
		 			<label for="visitorName">Your name</label>
		 			<input type="text" name="visitorName" id="visitorName" value="" />
 				</p>
 				<p>
		 			<label for="photo">Your photo</label>
		 			<input type="file" name="photo" id="photo" value="" />
		 		</p>
 			<div style="clear: both;">
 			<input type="submit" name="sendPhoto" value="Send Photo" />
 			</div>
 			</div>
 		</form>
</body>
</html>