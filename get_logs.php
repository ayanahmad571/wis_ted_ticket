<?php
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}


if(!isset($_POST['check'])){
	$sql = "SELECT * FROM `ted_tck_t` t
	left join ted_usr_reg u on u.tur_id = t.tk_rel_tur_id
	where u.tur_valid =1 and u.tur_approved = 1 order by tk_dnt desc ";
$result = $conn->query($sql);

if ($result->num_rows >0) {
    // output data of each row
	$con = 1;
    while($row = $result->fetch_assoc()) {
	
	echo '<tr>
	<td>'.$con.'</td>
	<td>'.$row['tur_fname'].'</td>
	<td>'.$row['tur_lname'].'</td>
	<td>'.$row['tur_email'].'</td>
	<td>'.$row['tur_qty'].'</td>
	<td>'.$row['tk_ip'].'</td>
	
	<td>'.date('d-M-Y',$row['tk_dnt']).'</td>
	<td>'.date('h:i:s A',$row['tk_dnt']).'</td>
	</tr>';
	$con++;
	}
}else{
		
}

}

?>
	
	