<?php
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}


if(isset($_POST['check'])){
	$sql = "SELECT * FROM `ted_usr_reg` t
	where t.tur_valid =1 and t.tur_approved = 1 and 
 md5(md5(sha1(sha1(md5(concat(tur_id, tur_dnt))))))= '".substr($_POST['check'],1,32)."'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>

<div class="col-xs-12">
<p align="center"><?php echo $row['tur_fname']." ".$row['tur_lname']; ?></p>
<p align="center"><?php echo $row['tur_qty'] ?> Allowed</p>
<?php 
$checkused= getdatafromsql($conn , "select * from ted_tck_t where tk_rel_tur_id = ".$row['tur_id']." order by tk_dnt desc limit 1");
if(is_array($checkused)){
?>
<p align="center" style="color:rgba(255,0,4,1.00)">Expired (Scanned on <?php echo date('D, d-M-y @ H:i:s A', $checkused['tk_dnt']); ?>)</p>

<?php
}else{
?>
<p align="center" style="color:rgba(58,255,0,1.00)">Valid</p>

<?php
}
?>

<p align="center"><img src="<?php echo $row['tur_image']; ?>" class="img-responsive" /></p>
</div>
<?php
		if($conn->query("INSERT INTO `ted_tck_t`( `tk_rel_tur_id`, `tk_dnt`, `tk_ip`) VALUES (
		'".$row['tur_id']."',
		'".time()."',
		'".$_SERVER['REMOTE_ADDR']."'
		
		)")){
		}else{
			echo '-INSF-';
		}

	}


}else{
	
?>
<div class="col-xs-12">

<p align="center" style="color:rgba(255,0,4,1.00)">Invalid Ticket</p>
</div>	
<?php
}

}

?>
	
	