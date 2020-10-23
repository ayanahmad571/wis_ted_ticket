<?php
if(include('../include.php')){
}else{
die('##errMASTERofUSErERROR');
}

if((count($_POST) > 0)  or (count($_GET) > 0)){
	if((count($_POST) > 0)){
		if(isset($_SERVER['HTTP_REFERER'])){
		}else{
			die('Refferer Not Found');
		}
		if((strpos($_SERVER['HTTP_REFERER'],'http://stilewell.ddns.net') == '0') or (strpos($_SERVER['HTTP_HOST'],'http://localhost/') == '0') or (strpos($_SERVER['HTTP_REFERER'],'http://192.168.1.') == '0'))
	{
	  //only process operation here
	}else{
		die('Only tld process are allowed');
	}
	}

}else{
	
	die(header('Location: master-action.php'));
	
}

/*
var_dump($_POST);
var_dump($_FILES);

foreach($_POST as $pkey=>$pval){	
	echo '
	#---------------------------------------<br>
		if(isset($_POST[\''.$pkey.'\'])){<br>
		&nbsp;&nbsp;if(!is_string($_POST[\''.$pkey.'\'])){<br>
		&nbsp;&nbsp;die(\'Invalid Characters used in '.$pkey.'\');
		&nbsp;&nbsp;}<br>
		&nbsp;&nbsp;else{}<br>
		}else{<br>
		&nbsp;&nbsp;die(\'Enter '.$pkey.'\');<br>
		}<br>
	';
}
*/

if(isset($_POST['from_email']) and isset($_POST['from_name']) and isset($_POST['subj_ml']) and isset($_POST['message_ml'])){
	
	$email = $_POST['from_email'];
	$name = $_POST['from_name'];
	$subject = $_POST['subj_ml'];
	$message = $_POST['message_ml'];
	$hash = md5(sha1($_SERVER['REMOTE_ADDR']));
	$ip = $_SERVER['REMOTE_ADDR'];
	$timest = time();	
	
	
$sql = "INSERT INTO `mun_mails`(`ml_from_email`, `ml_from_name`, `ml_subject`, `ml_body`, `ml_hash`, `ml_from_ip`, `mun_time`) VALUES (
'".$email."',
'".$name."',
'".$subject."',
'".$message."',
'".$hash."',
'".$ip."',
'".$timest."'
)";

if ($conn->query($sql) === TRUE) {
    header('Location: home.php?mailsent');
} else {
  die('#ERRMASTACT1');
}

	
}


if(isset($_POST['usr_email']) and isset($_POST['usr_fname'])  and isset($_POST['usr_qty']) and isset($_POST['usr_lname']) and is_array($_FILES['ch_img'])){

if(!is_email($_POST['usr_email'])){
  die('Invalid Characters used in email, re-submit the form with valid values');   
}


if((trim($_FILES['ch_img']['tmp_name'])) == ''){
	die("Re-Load image");
}
        $maxDim = 500;
        list($width, $height, $type, $attr) = getimagesize( $_FILES['ch_img']['tmp_name'] );
        if ( $width > $maxDim || $height > $maxDim ) {
			$path_parts = pathinfo($_FILES["ch_img"]["name"]);
			$extension = $path_parts['extension'];
            $target_filename = "../usr_images/".md5(microtime().uniqid().$_FILES['ch_img']['tmp_name']).".".$extension;
            $fn = $_FILES['ch_img']['tmp_name'];
            $size = getimagesize( $fn );
            $ratio = $size[0]/$size[1]; // width/height
            if( $ratio > 1) {
                $width = $maxDim;
                $height = $maxDim/$ratio;
            } else {
                $width = $maxDim*$ratio;
                $height = $maxDim;
            }
            $src = imagecreatefromstring( file_get_contents( $fn ) );
            $dst = imagecreatetruecolor( $width, $height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
            imagedestroy( $src );
            imagepng( $dst, $target_filename ); // adjust format as needed
            imagedestroy( $dst );
        }else{
						$path_parts = pathinfo($_FILES["ch_img"]["name"]);
			$extension = $path_parts['extension'];
            $target_filename = "../usr_images/".md5(microtime().uniqid().$_FILES['ch_img']['tmp_name']).".".$extension;
            $fn = $_FILES['ch_img']['tmp_name'];
            $size = getimagesize( $fn );

			            $src = imagecreatefromstring( file_get_contents( $fn ) );
            $dst = imagecreatetruecolor( $width, $height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
            imagedestroy( $src );
            imagepng( $dst, $target_filename ); // adjust format as needed
            imagedestroy( $dst );

		}

$sql = "


INSERT INTO `ted_usr_reg`(`tur_fname`, `tur_lname`, `tur_email`, `tur_qty`, `tur_image`, `tur_dnt`, `tur_ip`) 
VALUES (
'".$_POST['usr_fname']."',
'".$_POST['usr_lname']."',
'".$_POST['usr_email']."',
'".$_POST['usr_qty']."',
'".substr($target_filename,3)."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."'

)";

if($conn->query($sql)){
	header('Location: usr_self_reg.php?success');
}else{
	die("Fatal Error Uploding image");}

}









?>







