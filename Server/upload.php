<?PHP
if(isset($_POST['image'])){
	$lock = fopen("lockinfo","r");
	while(!flock($lock,LOCK_EX,$blocked)){
		usleep(10);
	}
	$time_start = microtime(true);
	$now = DateTime::createFromFormat('U.u',microtime(true));
	$id = $now->format('YmdHisu');

	$upload_folder = "darknet/data";
	$path = "$upload_folder/$id.jpeg";
	$image = $_POST['image'];
	$send_folder = "darknet";
	$back_path = "$send_folder/boxresults.txt";
	$back_indi = "$send_folder/boxReady";//
	$cmd = "./yolo.sh data/$id.jpeg";
	//$cmd = "./nothing.sh dog.jpg";
	if(file_put_contents($path, base64_decode($image)) != false){
		if(file_exists($back_indi)){
		    unlink($back_indi);
		}
		while (!file_exists($path)){//img is not ready
			usleep(10);
		}
		shell_exec($cmd);
		while (!file_exists($back_indi)){//results is not ready
			usleep(1);
		}
		//$context=stream_context_create(array('http' => array('header'=>"Host: www.google.com\r\n")));
		
		//$imagedata =  file_get_contents($back_path, false, $context);
		//$imagedata = file_get_contents($back_path);
		echo "uploaded_success";
		//$imagestring = base64_encode($imagedata);
		/*$split = str_split($imagestring, 10000);
		foreach ($split as $s) echo $s;*/
		$myfile = fopen($back_path, "r") or die("Unable to open file!");
		echo fread($myfile,filesize($back_path));
		echo "?";
		$time_end = microtime(true);
		echo $time_end - $time_start;
		fclose($myfile);
		//echo base64_encode($imagedata);
		if(file_exists($path)){
		    unlink($path);
		}
		flock($lock,LOCK_UN);
		fclose($lock);
		exit;
	}
	else{
		echo "uploaded_failed";
		echo $image;
		flock($lock,LOCK_UN);
		fclose($lock);
		exit;
	}
}
else{
	/*$time1 = microtime(true);
	$cmd = "export PATH=/usr/local/cuda/bin:$PATH;export LD_LIBRARY_PATH=/usr/local/cuda/lib64:$LD_LIBRARY_PATH;cd darknet;./darknet detector test cfg/voc.data cfg/tiny-yolo-voc.cfg tiny-yolo-voc.weights data/haoliang.jpeg; 2>&1";
	echo shell_exec($cmd);
	echo "image_not_in";
	$time2 = microtime(true);
	echo 'script execution time: ' . ($time2 - $time1);*/
	//$data = "data/dog.jpg";
	//$cmd = "./test.sh $data";
	//shell_exec($cmd);
	//echo shell_exec('whoami');
        shell_exec("./yolo.sh data/dog.jpg");
	$send_folder = "darknet";
	$back_path = "$send_folder/boxresults.txt";
	$myfile = fopen($back_path, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($back_path));
	fclose($myfile);
	exit;
}

?>
