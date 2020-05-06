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

	if(isset($_POST["sendDocument"])){
		//var_dump($_FILES["document"]);
		//check if the file is uploaded with sucess
		//echo $_FILES["photo"]["name"][0];
		if( isset( $_FILES["document"]["type"]) && $_FILES["document"]["error"] == UPLOAD_ERR_OK) {
			$target_dir = "documents/"; //define folder to save the uploaded file
			//expect string "photos/minion.jpg"
			$target_file = $target_dir.basename($_FILES["document"]["name"]);

			//echo "<br><br>".$target_file."<br>";

			//getting extension of the uploaded file
			$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

			//echo "Extension: $file_type<br>";
			$accepted = array("jpg", "JPG", "png", "gif", "jpeg", "JPEG", "pdf");
			if( !in_array($file_type, $accepted)){
				echo "JPG, GIF, JPEG and PDF only supported";
			}
			//move the uploaded file from temporary folder to project folder
			else if(!move_uploaded_file($_FILES["document"]["tmp_name"], $target_file))
			{
				echo "There was a problem uploading that document".$_FILES["document"]["error"];
			}
			header("Location: driver-profile.php");
			exit(); 
		} else {
			//checking errors
			switch( $_FILES["document"]["error"] ) {
 				case UPLOAD_ERR_INI_SIZE: //max size set up in php.ini
					$message = "The document is larger than the server allows.";
 					break;
 				case UPLOAD_ERR_FORM_SIZE: //max size set up in html form
 					$message = "The document is larger than the script allows.";
 					break;
 				case UPLOAD_ERR_NO_FILE:
 					$message = "No file was uploaded. Make sure you choose a file to upload.";
 					break;
 				default:
 					$message = "Please contact your server administrator for help.";
			} echo " Sorry, there was a problem uploading the document. ".$message;
		}
	}elseif (isset($_POST["sendPicture"])) {
		if( isset( $_FILES["document"]["type"]) && $_FILES["document"]["error"] == UPLOAD_ERR_OK) {
			$target_dir = "images/"; //define folder to save the uploaded file
			//expect string "photos/minion.jpg"
			$target_file = $target_dir.basename($_FILES["document"]["name"]);

			//echo "<br><br>".$target_file."<br>";

			//getting extension of the uploaded file
			$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

			//echo "Extension: $file_type<br>";
			$accepted = array("jpg", "JPG", "png", "gif", "jpeg", "JPEG", "pdf");
			if( !in_array($file_type, $accepted)){
				echo "JPG, GIF, JPEG and PDF only supported";
			}
			//move the uploaded file from temporary folder to project folder
			else if(!move_uploaded_file($_FILES["document"]["tmp_name"], $target_file))
			{
				echo "There was a problem uploading that document".$_FILES["document"]["error"];
			}
			header("Location: driver-profile.php");
			exit(); 
		}
	}
?>