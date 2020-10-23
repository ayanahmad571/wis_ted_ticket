<?php
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}


if(isset($_GET['id']) and ctype_alnum($_GET['id'])){
	$sql = "SELECT * FROM `ted_usr_reg` t
	where t.tur_valid =1 and t.tur_approved = 1 and 
 md5(md5(sha1(sha1(md5(concat(tur_id, tur_dnt))))))= '".substr($_GET['id'],1,32)."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		

		?>




<!DOCTYPE html>
<html lang="en">
    
<!-- the maninvoice.htmlby ayan ahmad 07:31:27 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="img/logo.jpg">

        <title><?php echo $row['tur_fname'].' - '.$row['tur_lname'] ?></title>

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
                                    <img src="<?php echo $row['tur_image'] ?>" class="img-responsive"/>
                                    </div>
                                    <div align="center" class="col-md-4 col-xs-6">
										<p style="font-size:24px">First Name: <em><strong><?php echo $row['tur_fname'] ?></strong></em></p>
                                        <p style="font-size:24px">Last Name: <em><strong><?php echo $row['tur_lname'] ?></strong></em></p>
                                    </div>

                                </div>
                            

                                <div class="row">
                                    <div align="center" class="col-xs-12 ">
                                    <img   src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $_GET['id'] ?>&choe=UTF-8" title="ETICKETBARCODE" />
                                    <hr>
                        <p style="font-size:20px">Admissible: <em><strong><?php echo $row['tur_qty'] ?></strong></em></p>
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
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a onClick="window.print()" href="#" class="btn btn-inverse"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


    </body>

</html>
        <?php
    }
} else {
    echo "0 results".$conn->error;
}
}else{
	die('Give Id');
}

?>