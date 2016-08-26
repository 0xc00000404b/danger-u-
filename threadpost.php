<?php
	function customError($errno, $errstr) {
  		 echo "<b>Error:</b> [$errno] $errstr";
  		 die();
	}

	set_error_handler("customError");
	$path = "thread/";
	$threadlist = scandir($path,1);
	$latestthread = (int)str_replace("thread/","",str_replace(".txt","",$path . $threadlist[0]));
	$latestthread += 1;

	$filepath = $path . (string)$latestthread . ".txt";
	
	try
	{
	$newthread_file = fopen($filepath,"w+");
	
	$title = strip_tags($_POST['title']);
	$body = htmlspecialchars(strip_tags($_POST['body']));

	fwrite($newthread_file, "|||" . $title . "\n");	
	fwrite($newthread_file, "||" . $body . "\n");
	fclose($newthread_file);

	header("Location: http://dangeru.rf.gd/index.php");
	die();	
	}	
	catch (Exception $e)
	{
		echo $e->getMessage();
	}	
?>