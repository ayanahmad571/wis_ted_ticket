<?php 
include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
?>

<?php

if($login == 1){
	if(trim($_USER['lum_ad']) == 1){
		$admin = 1;
	}else{
		$admin = 0;
	}
}else{
	$admin = 0;
	die('Login to View this page <a href="login.php"><button>Login</button></a>');
}

?>
<?php
$checkusereligibility = "SELECT * FROM `sw_modules` WHERE mo_valid =1 and FIND_IN_SET(".$_SESSION['STWL_LUM_TU_ID'].", mo_for) > 0 and mo_href = '".trim(basename($_SERVER['PHP_SELF']))."'";
if(is_array(getdatafromsql($conn,$checkusereligibility))){
}else{
	$cue1 = "SELECT * FROM `sw_submod` WHERE sub_valid =1 and sub_href = '".trim(basename($_SERVER['PHP_SELF']))."'";
	$cue1 = getdatafromsql($conn,$cue1);
	if(is_array($cue1)){
		$cue = "SELECT * FROM `sw_modules` WHERE mo_valid =1 and FIND_IN_SET(".$_SESSION['STWL_LUM_TU_ID'].", mo_for) > 0 and
		 mo_id = '".$cue1['sub_mo_rel_mo_id']."'";
		if(is_array(getdatafromsql($conn,$cue))){
		}else{
			die('<h1>503</h1><br>
			Access Denied');
		
		}
	}else{
		die('<h1>503</h1><br>
	Access Denied');
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
<link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
<link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />  
        
    </head>


    <body>

        <!-- Aside Start-->
        <aside class="left-panel">

            
        <?php
		give_brand();
		?>
            <?php 
			get_modules($conn,$login,$admin);
			?>
                
        </aside>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">
                    

                    <!-- Right navbar -->
                    <?php
                    if($login==1){
						include('ifloginmodalsection.php');
					}
					?>
                    
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">

                <div class="row">
                    

                    <div class="col-lg-12	">

                        <div class="panel panel-default"><!-- /primary heading -->
                            <div class="portlet-heading">
      
                            <div class="panel-heading">
                                <h3 class="panel-title">Defaulters</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div style=" overflow:auto;
 position:relative;" class="row">
                                    <table id="datatable1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%">#</th>
                                                    <th style="width:15%">First Name</th>
                                                    <th style="width:15%">Last Name</th>
                                                    <th style="width:15%">Email</th>
                                                    <th style="width:10%">Qty</th>
                                                    <th style="width:10%">Date</th>                                                    
													<th style="width:10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

	$productsql = "SELECT * FROM `ted_usr_reg` t
	where tur_valid =1 and tur_approved = 1
	order by tur_dnt desc

";
$productres = $conn->query($productsql);

if ($productres->num_rows > 0) {
	//'.md5(md5(sha1(md5($productrw['pr_id'])))).'_primga output data of each row
	$con = 1;
	while($productrw = $productres->fetch_assoc()) {
	$checkpay = getdatafromsql($conn, "select * from sw_payments where pt_rel_tur_id = ".$productrw['tur_id']);

	if(!is_array($checkpay)){
 
		echo '<tr>
	<td>'.$con.'</td>
	<td>'.$productrw['tur_fname'].'</td>
	<td>'.$productrw['tur_lname'].'</td>
	<td>'.$productrw['tur_email'].'</td>
	<td>'.$productrw['tur_qty'].'</td>
	
	<td>'.date('d-M-Y',$productrw['tur_dnt']).'</td>
	<td><h3 style="color:red">Not Paid</h3>	</td>
	</tr>';


	}
	unset($checkpay);
	$con++;
	}

} else {
	echo "0 results";
}?>
                        </tbody>
                                        </table>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
<div class="row">
	<?php
	$gettotalpaif = getdatafromsql($conn, "select sum(pt_val) as pt from sw_payments where pt_val != 0");
	
	echo '<h3> Revenue: '.$gettotalpaif['pt'].'</h3>';
	echo '<h3> Qty Sold: '.($gettotalpaif['pt']/35).'</h3>';
	?>
</div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    
                </div> <!-- End row -->


            </div> <!-- End row -->

            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            


<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-full modal-dialog"> 
     <div class="modal-content">  
   
        <div class="modal-header"> 
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
           <h4 class="modal-title">
           <i class="glyphicon glyphicon-user"></i>Quotations</h4> 
        </div> 
            
        <div class="modal-body">                     
           <div id="modal-loader-b" style="display: none; text-align: center;">
           <!-- ajax loader -->
           <img width="100px" src="img/ajax-loader.gif">
           </div>
                            
           <!-- mysql data will be load here -->                          
           <div id="dynamic-content-b"></div>
        </div> 
                        
        <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
        </div> 
                        
    </div> 
  </div>
</div>


            
<!-- Footer Start -->
<footer class="footer">
	<?php auto_copyright(); // Current year?>

    Aforty
</footer>
<!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
  


      <?php  
	  get_end_script();
	  ?>   
<script src="assets/datatables/jquery.dataTables.min.js"></script>
<script src="assets/datatables/dataTables.bootstrap.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
		$('.mobileSelectSpecial').mobileSelect({
			onClose: function(){
				var txt = $(this).val();
				$.post("master_action.php", {prname: txt}, function(result){
					result = $.parseJSON( result );
					$("#chageqty").html(result.qty);
					$("#chageprname").html(result.prname);
				});
			}
		});
    } );
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobileSelect').mobileSelect();
    } );
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable1').dataTable();
    } );
</script>




<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
           </body>

</html>
