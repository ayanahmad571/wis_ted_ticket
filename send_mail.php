<?php
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('mailer/src/Exception.php');
require('mailer/src/PHPMailer.php');
require('mailer/src/SMTP.php');



if(isset($_GET['id']) and ctype_alnum($_GET['id'])){
	$sql = "SELECT * FROM `ted_usr_reg` t
	where t.tur_valid =1 and t.tur_approved = 1 and 
 md5(md5(sha1(sha1(md5(concat(tur_id, tur_dnt))))))= '".substr($_GET['id'],1,32)."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		



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
    $mail->setFrom('tedxwis@gmail.com', 'TEDx Wellington International School - E-Ticket');
    $mail->addAddress($row['tur_email'], $row['tur_fname']. ' '.$row['tur_lname'] );     // Add a recipient
    $mail->addBCC('ayanahmad.ahay@gmail.com', 'Copy AyAN');     // Add a recipient
    $mail->addBCC('tedxwis@gmail.com', 'Copy School');     // Add a recipient
    $mail->addReplyTo('tedxwis@gmail.com', 'Information');

/*    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
*/
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Thank you for your TEDx WIS ticket purchase ';
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

					Dear '.$row['tur_fname'].' '.$row['tur_lname'].',
<br><br>
Thank you for your purchase of a <strong>TEDxWIS 2019 </strong>Ticket!<br> Below you will find your Ticket which will have a QR code, please present this to the helpful staff at the entrance of the PHT Auditorium. <br>It is advisable to take a screenshot of the QR code.
<br>
<br>

            <div >

                <div class="row">
                
                    <div class="col-md-12">

				
					
<div style="background-color:black; margin:0">
	<p style="font-size:36px; color:white; text-align:center"><strong style="color:rgba(255,54,58,1.00)">TEDx</strong> <strong style="color:rgba(255,255,255,1.00)">WIS</strong> E-TICKET 	</p>
</div>
                        <div style="padding-left:70px !important;padding-right:70px !important" class="panel panel-default">

                            <div class="panel-body">
                                <div class="row">

                                    <div align="center" class="col-md-8 col-xs-6">
                                    <img src="http://accounts.tedxwis.org/'.$row['tur_image'].'" class="img-responsive"/>
                                    </div>
                                    <div align="center" class="col-md-4 col-xs-6">
										<p style="font-size:24px">First Name: <em><strong>'.$row['tur_fname'].'</strong></em></p>
                                        <p style="font-size:24px">Last Name: <em><strong>'.$row['tur_lname'].'</strong></em></p>
                                    </div>

                                </div>
                            

                                <div class="row">
                                    <div align="center" class="col-xs-12 ">
                                    <img   src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$_GET['id'].'&choe=UTF-8" title="ETICKETBARCODE" />
                                    <hr>
                        <p style="font-size:20px">Admissible: <em><strong>'.$row['tur_qty'].'</strong></em></p>
<hr>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                	<div align="left" class="col-xs-12">
        <p style="font-size:14px">Terms and Conditions:</p>
        <p style="font-size:10px">
        	<ol>
            	<li style="font-size:10px">This ticket is only valid on 13th of February.</li>
                <li style="font-size:10px">The QR code must be presented at the time of entry.</li>
            </ol>
        </p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

<br><Br>
Please ensure you are seated at least 30 minutes before the show starts in order to have a pleasant viewing experience.
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
    $mail->AltBody = 'The complete mail couldn\'t be loaded, please visit http://accounts.tedxwis.org/view_ticket.php?id='.$_GET['id'];

    $mail->send();
header('Location: sw_payments.php?done');
die();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
	  

?>

        <?php
    }
} else {
    echo "0 results".$conn->error;
}
}else{
	die('Give Id');
}

?>