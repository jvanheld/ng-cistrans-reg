<?php

// Define a destination
$targetFolder = $_POST["target-project"] . "/data";
$nameProject = $_POST["name-project"];

//$verifyToken = md5('unique_salt' . $_POST['timestamp']);

//if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
if (!empty($_FILES)) {
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    $filesBaseName = $fileParts['basename'];

	$tempFile = $_FILES['Filedata']['tmp_name'];
    $md5sumFile = md5_file($tempFile);
	//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetPath = $targetFolder;
    $oldmask = umask(0);
    //mkdir(rtrim($targetPath,'/') . '/' . $fileParts['filename'],0777);
    mkdir(rtrim($targetPath,'/') . '/' .$md5sumFile,0777);
    umask($oldmask);
    //$targetFile = rtrim($targetPath,'/') . '/' . $fileParts['filename'] . '/' . $_FILES['Filedata']['name'];
    $targetFile = rtrim($targetPath,'/') . '/' . $md5sumFile . '/' . $_FILES['Filedata']['name'];

	// Validate the file type
	$fileTypes = array('bam'); // File extensions

	if (in_array($fileParts['extension'],$fileTypes)) {
        $db = new SQLite3($_POST["target-project"] . "/" . $nameProject . ".db");// open the project database

        $db->exec("INSERT INTO files (md5sum, name) VALUES ('$md5sumFile','$filesBaseName')");//request to insert a new line who correspond to the new file uploaded
        move_uploaded_file($tempFile,$targetFile);
        rename($targetFile, rtrim($targetPath,'/') . '/' . $md5sumFile . '/' . $md5sumFile);


	} else {
		echo 'Invalid file type.';
	}
}
?>

