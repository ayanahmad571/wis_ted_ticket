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
                                <h3 class="panel-title">Purchase Orders</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div style=" overflow:auto;
 position:relative;" class="row">
                                    <table id="datatable1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ref</th>
                                                    <th>Proforma Ref</th>
                                                    <th>Subject</th>
                                                    <th>Supplier Name</th>
                                                    <th>Supplier Contact </th>
                                                    <th>Supplier Billing </th>
                                                    <th>Supplier Payment Terms</th>
                                                    <th>Currency</th>
                                                    <th>Revisons</th>
                                                    <th>Detailed View</th>
                                                    <th>Print View</th>                                                    
                                                    <th>Date</th>                                                    
													<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
$productsql = "SELECT * FROM `sw_purchaseorders` p
left join sw_proformas pf on p.pco_rel_po_id = pf.po_id
left join sw_suppliers c on p.pco_rel_sup_id = c.sup_id
left join sw_currency y on p.pco_rel_cur_id = y.cur_id
WHERE p.pco_revision = 0 and p.pco_valid =1 and c.sup_valid =1
and pf.po_valid=1
";
$productres = $conn->query($productsql);

if ($productres->num_rows > 0) {
	//'.md5(md5(sha1(md5($productrw['pr_id'])))).'_primga output data of each row
	$con = 1;
	while($productrw = $productres->fetch_assoc()) {
		unset($getallrevisions);
		unset($getrevision);
		unset($getrevisions);

	$getallrevisions = getdatafromsql($conn,"SELECT count(pco_id) as revs FROM `sw_purchaseorders` WHERE pco_revision_id =".$productrw['pco_id']." and pco_revision > 0");

		echo '<tr>
	<td>'.$con.'</td>
	<td>'.$productrw['pco_ref'].'</td>
	<td>'.$productrw['po_ref'].'</td>
	<td>'.$productrw['pco_subj'].'</td>
	<td>'.$productrw['sup_code'].'-'.$productrw['sup_name'].'</td>
	<td>'.$productrw['sup_contact_no'].'<br>'.$productrw['sup_email'].'</td>
	<td>'.$productrw['sup_bill_addr'].'</td>
	<td>'.$productrw['sup_pay_terms'].'</td>
	<td>1 '.$productrw['cur_name'].' = '.$productrw['pco_cur_rate'].' AED</td>
	<td>'.(is_array($getallrevisions) ? $getallrevisions['revs'] : '0').'</td>
	<td>';
	$getrevisions = "SELECT * FROM sw_purchaseorders where pco_revision_id = ".$productrw['pco_id']." and pco_valid =1";
$getrevisions = $conn->query($getrevisions);

if ($getrevisions->num_rows > 0) {
    // output data of each row
    while($getrevision = $getrevisions->fetch_assoc()) {

if($getrevision['pco_revision'] == 0){	echo'
<button id="getDetailedView" data-toggle="modal" data-target="#view-modal" data-id="'.md5($getrevision['pco_id']).'" class="btn btn-sm btn-info">Main</button>
';}else{
	echo'
<hr>
<button id="getDetailedView" data-toggle="modal" data-target="#view-modal" data-id="'.md5($getrevision['pco_id']).'" class="btn btn-sm btn-info">R'.$getrevision['pco_revision'].' </button>
';
}

    }
} else {
    echo "Error";
}

	echo '</td>
	<td>';
	$getrevisions = "SELECT * FROM sw_purchaseorders where pco_revision_id = ".$productrw['pco_id']." and pco_valid =1";
$getrevisions = $conn->query($getrevisions);

if ($getrevisions->num_rows > 0) {
    // output data of each row
    while($getrevision = $getrevisions->fetch_assoc()) {

if($getrevision['pco_revision'] == 0){	echo'
<button id="getPrintView" data-toggle="modal" data-target="#view-modal" data-id="'.md5($getrevision['pco_id']).'" class="btn btn-sm btn-info">Main</button>
';}else{
	echo'<hr>

<button id="getPrintView" data-toggle="modal" data-target="#view-modal" data-id="'.md5($getrevision['pco_id']).'" class="btn btn-sm btn-info">R'.$getrevision['pco_revision'].' </button>
';
}

    }
} else {
    echo "Error";
}

	echo '</td>	
	<td>'.date('d-M-Y',$productrw['pco_dnt']).'</td>
	<td>
<button id="getPoEdit" data-toggle="modal" data-target="#view-modal" data-id="'.md5($productrw['pco_id']).'" class="btn btn-sm btn-warning">Revise</button>
	</td>
	</tr>';

	$con++;
	}

} else {
}?>
                        </tbody>
                                        </table>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
<div class="row">
    <div class="col-xs-3">
        <div class="row">
            <h4 align="center">Generate Purchase Order From Proforma</h4>
            <div class="row">
    <div align="center" class="col-xs-12"><button data-toggle="modal" data-target="#view-modal" id="getModalForQuoteProAdd" class="btn btn-warning" data-id="getit">Generate</button></div>
            </div>
        </div>
        
    </div>
    <div class="col-xs-9">
        <div class="row"><h3 >&nbsp; Add Product</h3></div>
        <div class="row">
            <div class="row">
<?php 
/*--*/
?>

<form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
        <div class="form-group">
            <label>Product: </label>
		<div class="row">
			<div class="col-xs-2"><input type="file" name="add_snippet_product_img" accept="image/*"/></div>
		</div><br>
<div class="col-xs-4">

<div class="form-group">
	<label>Product Name: </label>
	<input required  name="add_snippet_product_name" type="text" class="form-control" placeholder="Name"/>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
	<label>Code: </label>
	<input required  name="add_snippet_product_code" type="text" class="form-control" placeholder="Code"/>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
	<label>Product Type: </label><br>
    <select class="form-control mobsel" name="add_snippet_product_type" required>
    <option>Select Product Type</option>
    	<?php
		$sql = "SELECT * FROM sw_prod_types where prty_valid =1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<option value="'.md5(sha1(md5('iuergejgvjioe'.$row['prty_id']))).'">'.$row['prty_name'].'</option>';
    }
} else {
}
		?>
    </select>
</div>
</div>
<div class="col-xs-4">
    <div class="form-group">
        <label>Supplier: </label><br>
        <select class="form-control mobsel" name="add_snippet_product_supplier" required>
        <option>Select Supplier</option>
            <?php
            $sql = "SELECT * FROM sw_suppliers where sup_valid =1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.md5(sha1(md5('iuergeirjgvjioe'.$row['sup_id']))).'">'.$row['sup_code'].'-'.$row['sup_name'].'</option>';
        }
    } else {
    }
            ?>
        </select>
    </div>
</div>

    <div class="col-xs-4">
        <div class="form-group">
            <label>Quantity: </label>
            <input required  name="add_snippet_product_qty" type="text" class="form-control" placeholder="Qty"/>
        </div>
	</div>
    <div class="col-xs-4">
        <div class="form-group">
		<label>Cost: </label>
		<input required  name="add_snippet_product_cost" type="text" class="form-control" placeholder="No Unit"/>
        </div>
	</div>
    


<div class="col-xs-12">
    <div class="form-group">
        <label>Description: </label>
        <textarea name="add_snippet_product_desc" class="form-control" rows="9">-</textarea>
    </div>
</div>


            
            
            
            
            
            
            
            
        </div>
</div>
		<input required  name="add_snippet_href" type="hidden" value="<?php echo htmlentities(basename(($_SERVER['PHP_SELF']))); ?>"/>

<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_snippet_product" value="Add Product">
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<?php 
/* --*/
?>
            </div>
        </div>
        
    </div>
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
           <h4 class="modal-title">purchaseorder</h4> 
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
		$('.mobileSelect').mobileSelect();
    } );
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable1').dataTable();
    } );
</script>
<script>
$(document).ready(function(){

$(document).on('click', '#getModalForQuoteProAdd', function(e){  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content-b').html(''); // leave this div blank
     $('#modal-loader-b').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'page_that_gives_modal_popups_to_pages.php',
          type: 'POST',
          data: 'add_purchaseorder_proforma='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content-b').html(''); // blank before load.
          $('#dynamic-content-b').html(data); // load here
          $('#modal-loader-b').hide(); // hide loader  
     })
     .fail(function(){
          $('#dynamic-content-b').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader-b').hide();
     });

    });
});
</script>
<script>
$(document).ready(function(){

$(document).on('click', '#getPoEdit', function(e){  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content-b').html(''); // leave this div blank
     $('#modal-loader-b').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'page_that_gives_modal_popups_to_pages.php',
          type: 'POST',
          data: 'purchaseorder_edit='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content-b').html(''); // blank before load.
          $('#dynamic-content-b').html(data); // load here
          $('#modal-loader-b').hide(); // hide loader  
     })
     .fail(function(){
          $('#dynamic-content-b').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader-b').hide();
     });

    });
});
</script>
<script>
$(document).ready(function(){

$(document).on('click', '#getPrintView', function(e){  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content-b').html(''); // leave this div blank
     $('#modal-loader-b').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'page_that_gives_modal_popups_to_pages.php',
          type: 'POST',
          data: 'purchaseorders_print_view='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content-b').html(''); // blank before load.
          $('#dynamic-content-b').html(data); // load here
          $('#modal-loader-b').hide(); // hide loader  
     })
     .fail(function(){
          $('#dynamic-content-b').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader-b').hide();
     });

    });
});
</script>
<script>
$(document).ready(function(){

$(document).on('click', '#getDetailedView', function(e){  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content-b').html(''); // leave this div blank
     $('#modal-loader-b').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'page_that_gives_modal_popups_to_pages.php',
          type: 'POST',
          data: 'purchaseorder_detailed_view='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content-b').html(''); // blank before load.
          $('#dynamic-content-b').html(data); // load here
          $('#modal-loader-b').hide(); // hide loader  
     })
     .fail(function(){
          $('#dynamic-content-b').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader-b').hide();
     });

    });
});
</script>



     <script>
$(document).ready(function(e) {
    $('.thistoh').addClass('hidden');
	var iddf =$('#select_can').val();
	var pela =document.getElementById(iddf);
	$(pela).removeClass('hidden');
});
$('#select_can').change(function(e) {

	$('.thistoh').addClass('hidden');
	var ider = $(this).val();
	var pel =document.getElementById(ider);
	$(pel).removeClass('hidden');

});
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