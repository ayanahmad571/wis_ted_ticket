<?php
die();
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('mailer/src/Exception.php');
require('mailer/src/PHPMailer.php');
require('mailer/src/SMTP.php');

		



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tedxwis@gmail.com';                 // SMTP username
    $mail->Password = 'Wellington2016';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('tedxwis@gmail.com', 'TEDx Event Reminder');

   $sql = "SELECT * FROM `ted_usr_reg` t
	where tur_valid =1 and tur_approved = 1
	order by tur_dnt desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$checkpay = getdatafromsql($conn, "select * from sw_payments where pt_rel_tur_id = ".$row['tur_id']);

	if(is_array($checkpay)){
   $mail->addAddress($row['tur_email'], $row['tur_fname']. ' '.$row['tur_lname'] );     // Add a recipient

	}
	
   
    }
}

    $mail->addBCC('ayanahmad.ahay@gmail.com', 'Copy AyAN');     // Add a recipient
    $mail->addBCC('tedxwis@gmail.com', 'Copy School');     // Add a recipient
    $mail->addReplyTo('tedxwis@gmail.com', 'Information');

/*    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
*/
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'TEDx WIS Reminder';
	$content =  '
	
	
<!DOCTYPE html>
<html lang=\"en\">
    
<head>

        <link rel="shortcut icon" href="img/logo.jpg">


        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />


        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
      <style>
   

   hr {
	   color:#000;
	   border-color:#000;
   }
   td {
	   padding:3px !important;
   }

body{ 
    zoom: 0.9; 
    -moz-transform: scale(0.9); 
    -moz-transform-origin: 0 0;
}    </style>



    </head>


    <body style="max-width:600px; min-width:450px;">

					Dear User,
<br><br>
Thank you for your purchase of a <strong>TEDxWIS 2019 </strong>Ticket!<br>
This email is a friendly reminder for the upcoming TEDx event on 13th February.<br>

<br>
<br>

            <div >


<br><Br>
Please ensure you present the ticket sent to your registered email address upon arrival to ensure smooth entry.

<br>
<br>

How to get to the event: <br>

<strong>Address: Al Sufouh 1 - Dubai<br>
<a style="color:rgba(0,76,253,1.00)" href="https://goo.gl/maps/6cNffUcqziF2">Google Maps Link</a><br>
Time of event: 6:00PM<br>
Suggested Time Of Arrival: 5:15PM<br>
Date: 13th February 2019<br>

</strong>

<br>
Please visit our website to keep updated <a style="color:rgba(0,76,253,1.00)" href="http://tedxwis.org">http://tedxwis.org </a>.
<br><br>
Regards,<br>
The ever smiling TEDx team.
	
    </body>

</html>
	
	';
	
    $mail->Body    = $content;
    $mail->send();
header('Location: efer.php?done');
die();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
	  

?>
