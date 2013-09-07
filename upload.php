<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>uploading...</title>
</head>
<body>
<?php
	if ($_FILES['userinfo']['error']>0) {
		echo 'problem:';
		switch ($_FILES['userinfo']['error']) {
			case 1:
				echo 'File exceeded upload_max_filesize';
				break;
			case 2:
				echo 'File exceeded max_file_size';
				break;
			case 3:
				echo 'File only partially uploaded';
				break;
			case 4:
				echo 'No file uploaded';
				break;
			case 6:
				echo 'Cannot upload file:No temp directory specified';
				break;
			case 7:
				echo 'Upload failed:Cannot write to disk';
				break;
		}
		exit;
	}

	if ($_FILES['userfile']['type'] != 'text/plain') {
		echo 'Problem:file is not plain text';
		exit;
		}	
	$upfile='./uploads/'.$_FILES['userfile']['name'];
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
			echo 'Problem:Could not move file to destination directory';
			exit;
		}
	}else{
		echo 'Problem: Possible file upload attack.Filename:';
		echo $_FILES['userfile']['name'];
		exit;
	}

	echo 'file uploaded successfully<br><br>';
	$contents=file_get_contents($upfile);
	$contents=strip_tags($contents);
	file_put_contents($_FILES['userfile']['name'], $contents);

	echo '<p>preview of uploaded file contents:<br><hr />';
	echo nl2br($contents);
	echo '<br /><hr />';

?>
</body>
</html>