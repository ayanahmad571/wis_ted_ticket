<?php
include('include.php');
if(!isset($_SERVER['HTTP_REFERER'])){
	header('Location: page_that_gives_model_popups_to_pages.php');
}
?>
<?php

if(isset($_SESSION['SESS_WIS_USR_LOG_MS_VIEW_MD5_ID']) and trim($_SESSION['SESS_WIS_USR_LOG_MS_VIEW_MD5_ID']) != ''){
}else{
	die('Login to continue <a href="login.php">Login	</a>');
}

?><?php
if(isset($_POST['admin_prod_get'])){
	$msql = "SELECT * FROM `sw_products_raw`
where pr_valid =1 and pr_visible =1 and  md5(pr_id)= '".$_POST['admin_prod_get']."'";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
		echo '
<form action="master_action.php" method="post">
<div class="row">
	<div class="col-xs-2 col-xs-offset-5"><img class="img-responsive" src="'.$mrw['pr_img'].'" /></div>
</div><br>
<p>
'.$mrw['pr_code'].'-'.$mrw['pr_name'].'
</p>
<br>
<div class="col-sm-6">
<div class="form-group">
	<label>Product Name: </label>
	<input required  name="edit_product_name" type="text" class="form-control" value="'.$mrw['pr_name'].'"/>
</div>

</div>
<div class="col-sm-6">

<div class="form-group">
	<label>Cost: </label>
	<input required  name="edit_product_cost" type="number" step="0.01" class="form-control" value="'.$mrw['pr_price'].'"/>
</div>

</div>
<div class="form-group">
	<label>Description: </label>
	<textarea name="edit_product_desc" class="form-control" rows="9">'.$mrw['pr_desc'].'</textarea>
</div>






<div class="row">
	<div class="col-xs-6">
	<input required  type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['pr_id'].'f2fkjwiuef0rjigbter 24rfgr324frgtr3f 3gr32fgr32f4gr')))))).'" name="edit_product_hash" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="edit_product" value="Save">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
		        <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
	';
	
	#first loop ends
    }
} else {
    echo "0 results";
}
}
if(isset($_POST['admin_prod_img_get'])){
	if(ctype_alnum(trim($_POST['admin_prod_img_get']))){
	}
$modalsql = "SELECT * FROM `sw_products_raw` where pr_valid = 1 and pr_visible =1 and md5(pr_id) = '".$_POST['admin_prod_img_get']."'";
$modalres = $conn->query($modalsql);

if ($modalres->num_rows > 0) {
    // output data of each row
    while($modalrw = $modalres->fetch_assoc()) {
		#firts loop begins
		echo '
<div class="row">
<div class="col-xs-4 col-xs-offset-4">
	<img class="img-resposive" width="100%" src="'.$modalrw['pr_img'].'"/>
</div>
</div>

<div class="row">
	<form action="img_change_inven.php" method="post" enctype="multipart/form-data">
		<input required type="hidden" name="inven_id" value="'.md5(md5(sha1(md5(sha1($modalrw['pr_id']))))).'"/>
		<input type="file" name="filer" onChange="" accept="image/*"/>
		<input type="submit" value="Update" name="updt_img" class="btn btn-danger" />
	</form>
	<div class="row">
		<div class="col-xs-offset-4 col-xs-4">
			<img class="img-responsive" id="output"/>
		</div>
	</div>
</div>


	';
	
	#first loop ends
    }
} else {
    echo "0 results";
}
}
if(isset($_POST['add_prod_give_modal'])){
?>        <form action="master_action.php" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-xs-2 col-xs-offset-5"><input type="file" name="add_product_img" accept="image/*"/></div>
		</div><br>

<div class="row">
        <div class="col-sm-4">
    <div class="form-group">
    <label>Product Name: </label>
    <input required  name="add_product_name" type="text" class="form-control" placeholder="Name"/>
    </div>
        </div>
        <div class="col-sm-4">
    <div class="form-group">
    <label>Code: </label>
    <input required  name="add_product_code" type="text" class="form-control" placeholder="Code"/>
    </div>
        </div>
        <div class="col-sm-4">
    <div class="form-group">
    <label>Cost: </label>
    <input required  name="add_product_cost" type="text" class="form-control" placeholder="only value no unit"/>
    </div>
    </div>
</div>

<div class="row">
        <div class="col-sm-6">
    <div class="form-group">
	<label>Product Type: </label>
    <select class="form-control" name="add_product_type" required>
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
    </select></div>

        </div>
        <div class="col-sm-6">
<div class="form-group">
	<label>Supplier: </label>
    <select class="form-control" name="add_product_supplier" required>
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
</div>    </div>
</div>
<div class="row">
        <div class="col-sm-6">
  <div class="form-group">
	<label>Invoice Reference: </label>
	<input required  name="add_product_invoice_ref" type="text" class="form-control" placeholder="Reference"/>
</div>
        </div>
        <div class="col-sm-6">
    <div class="form-group">
	<label>Quantity: </label>
	<input required  name="add_product_qty" type="text" class="form-control" placeholder="qty no unit"/>
</div>
        </div>
</div>








<div class="row">
<div class="form-group">
	<label>Description: </label>
    <p class="text-muted">|newline| = New Line <br>|bold| and |.bold| will make text bold<br>|italics| and |.italics| will make text slant</p>
	<textarea required name="add_product_desc" class=" form-control" rows="9"></textarea>
</div>
</div>







<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_product" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>

	<?php
}
if(isset($_POST['add_prodqty_give_modal'])){
	$msql = "SELECT * FROM `sw_products_raw`
where pr_valid =1 and pr_visible = 1 and  md5(pr_id)= '".$_POST['add_prodqty_give_modal']."'";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
?>
<form action="master_action.php" method="post">
<p>
<?php $mrw['pr_code'].'-'.$mrw['pr_name']; ?>
</p>
<br>
<div class="col-sm-6">
<div class="form-group">
	<label>Invoice Ref: </label>
	<input required  name="add_invref_prod" type="text" class="form-control" />
</div>

</div>
<div class="col-sm-6">

<div class="form-group">
	<label>Qty: </label>
	<input required  name="add_qty_prod" type="text" class="form-control" />
</div>

</div>






<div class="row">
	<div class="col-xs-6">
	<input required  type="hidden" value="<?php echo md5(md5(sha1(sha1(md5(md5($mrw['pr_id'].'24rfgr324frgtr3f 3gr32fgr32f4gr')))))) ?>" name="add_qty_product_hash" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_qty_product" value="Save">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>

	<?php
	
	#first loop ends
    }
} else {
    echo "0 results";
}
}
if(isset($_POST['admin_prod_get_qty'])){
	$msql = "SELECT * FROM `sw_products_raw`
where pr_valid =1 and pr_visible =1 and  md5(pr_id)= '".$_POST['admin_prod_get_qty']."'";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
		echo '
<form action="master_action.php" method="post">
<div class="row">
	<div class="col-xs-2 col-xs-offset-5"><img class="img-responsive" src="'.$mrw['pr_img'].'" /></div>
</div><br>
<p>
'.$mrw['pr_code'].'-'.$mrw['pr_name'].'
</p>
<br>
	';
	
	$sql = "SELECT * FROM sw_products_qty where pq_rel_pr_id = '".$mrw['pr_id']."'  and pq_valid =1 order by pq_dnt desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
		echo '
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Invoice Reference</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
			';
while($row = $result->fetch_assoc()) {
	echo '
	<tr>
		<td>'.$row['pq_ref'].'</td>
		<td>'.$row['pq_qty'].'</td>
	</tr>';
}
			echo '
		</tbody> 
</table>		
		';
} else {
    echo "0 results";
}


	#first loop ends
    }
} else {
    echo "0 results";
}
}
/*-------------------------------------------*/
if(isset($_POST['get_inv_show'])){
	$msql = "
SELECT * FROM `sw_products_list_show` sh 
left join sw_products_list pl on sh.sh_rel_pr_id = pl.pr_id 
left join sw_showrooms sw on sh.sh_rel_shw_id = sw.shw_id 
WHERE pl.pr_valid = 1 and sh.sh_valid=1 and  md5(sh.sh_id)= '".$_POST['get_inv_show']."'
 ";
$mres = $conn->query($msql );

if ($mres->num_rows == 1) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
		echo '
<form action="master_action.php" method="post">
<div class="form-group">
	<label>Quantity: </label>
	<input required  name="edit_showroomproduct_qty" type="number" step="0.01" class="form-control" value="'.$mrw['sh_qty'].'"/>
</div>

<div class="row">
	<div class="col-xs-6">
	<input required  type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['sh_id'].'ws f2fkjwiuef0rjigbter 24rfgr324frgtr3f 3gr32fgr32f4gr')))))).'" name="edit_showroomproduct_hash" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="edit_showroomproduct" value="Save">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>

	';
	
	#first loop ends
    }
} else {
    echo "0 results";
}
}
if(isset($_POST['get_mock_modal'])){
	$msql = "
SELECT * FROM `sw_mockups` where md5(mock_id) = '".$_POST['get_mock_modal']."'
 ";
$mres = $conn->query($msql );

if ($mres->num_rows == 1) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
		echo '
<form action="master_action.php" method="post">
<div class="form-group">
	<label>Given Qty: </label>
	<input required  name="edit_mock_qty" type="number" step="0.01" class="form-control" value="'.$mrw['mock_qty'].'"/>
</div>
<div class="form-group">
	<label>Returned: </label>
<select class="form-control" required name="edit_mock_returned">
		'.($mrw['mock_returned'] == 0 ? '<option value="0" selected>No</option> <option value="1">Yes</option>':'<option value="0">No</option><option selected value="1">Yes</option>').'
	</select>
</div>
<div class="form-group">
	<label>Remarks: </label>
	<input required  name="edit_mock_remarks" type="text" class="form-control" value="'.$mrw['mock_remarks'].'"/>
</div>

<div class="row">
	<div class="col-xs-6">
	<input required  type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['mock_id'].'dedws f2fkjwiuef0rjigbter 24rfgr324frgtr3f 3gr32fgr32f4gr')))))).'" name="edit_mock_hash" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="edit_mock" value="Save">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>

	';
	
	#first loop ends
    }
} else {
    echo "0 results";
}
}
/*-------------------------------------------*/
if(isset($_POST['mockup_warehouse_old'])){
?>        <form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-xs-6">
        <div class="form-group">
            <label>Product: </label>
            <select class="form-control mobsel" name="add_mockup_warehouse_old_product_hash" required>
            <option>Select Product</option>
                <?php
                $sql = "SELECT * FROM sw_products_list where pr_valid=1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('iueriowenejgvjioe'.$row['pr_id']))).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
            </div>
	<div class="col-xs-6">
        <div class="form-group">
            <label>Client: </label>
            <select class="form-control mobsel" name="add_mockup_warehouse_old_client_hash" required>
            <option>Select Client</option>
                <?php
                $sql = "SELECT * FROM sw_clients where cli_valid =1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('3oiwjf3oihegnr ikjn fm'.$row['cli_id']))).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
	</div>
</div>


<div class="row">
	<div class="col-xs-12">
        <div class="form-group">
            <label>Quantity: </label>
            <input required  name="add_mockup_warehouse_old_qty" type="text" class="form-control" placeholder="Qty"/>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_mockup_warehouse_old_client" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobsel').mobileSelect();
    } );
</script>

	<?php
}
if(isset($_POST['mockup_warehouse_new'])){
?>        <form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-xs-4">
        <div class="form-group">
            <label>Product: </label><br>

            <select class="form-control mobsel" name="add_mockup_warehouse_new_product_hash" required>
            <option>Select Product</option>
                <?php
                $sql = "SELECT * FROM sw_products_list where pr_valid=1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('iueriowenejgvjioe'.$row['pr_id']))).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
        <div class="col-xs-8">
            <div class="form-group">
                <label>Quantity: </label>
                <input required  name="add_mockup_warehouse_new_qty" type="text" class="form-control" placeholder="Qty"/>
            </div>
        </div>
</div>
<div class="row">

            
<div class="col-xs-12">
            <label>Client: </label>

        <div class="form-group">
<div class="row">
    <div class="col-xs-4"><p>Name:<input required class="form-control "  name="add_mockup_warehouse_new_client_name" type="text" placeholder="Alpha Beta" /></p></div>
    <div class="col-xs-4"><p>Code:<input required class="form-control "  name="add_mockup_warehouse_new_client_code" type="text" placeholder="AB" /></p></div>
    <div class="col-xs-4"><p>Desc: <input required class="form-control "  name="add_mockup_warehouse_new_client_desc" type="text" placeholder="Description of the client" value="-" /></p></div>
</div>
<div class="row">
    <div class="col-xs-6"><p>Email: <input required  class="form-control" name="add_mockup_warehouse_new_client_email" type="email" placeholder="abc@example.com"  /></p></div>
    <div class="col-xs-6"><p>Phone:<input required class="form-control "  name="add_mockup_warehouse_new_client_phone" type="text" placeholder="With International Code and seperated with comma ," /></p></div>
</div>
<div class="row">
    <div class="col-xs-6"><p>Billing Address: <textarea name="add_mockup_warehouse_new_client_bill_addr" class="wysihtml5 form-control" rows="9"></textarea></p></div>
    <div class="col-xs-6"><p>Shipping Address:<textarea name="add_mockup_warehouse_new_client_ship_addr" class="wysihtml5 form-control" rows="9"></textarea></p></div>
</div>
<div class="row">
    <div class="col-xs-4"><p>Tax Code:<input required class="form-control "  name="add_mockup_warehouse_new_client_tax_code" type="text" placeholder="Code" /></p></div>
    <div class="col-xs-4"><p>Bank Details:<input required class="form-control "  name="add_mockup_warehouse_new_client_bank_details" type="text" placeholder="Details" /></p></div>
    <div class="col-xs-4"><p>Payment Terms: <input required  class="form-control" name="add_mockup_warehouse_new_client_pay_terms" type="text" placeholder='50,40,10' value="50,50" /></p> 
    </div>
</div> 

        </div>
</div>
</div>


<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_mockup_warehouse_new" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobsel').mobileSelect();
    } );
</script>

	<?php
}
if(isset($_POST['mockup_showroom_old'])){
?>        
<form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-xs-6">
        <div class="form-group">
            <label>Product: </label><br>
            <select class="form-control mobsel" name="add_mockup_showwroom_old_product_hash" required>
            <option>Select Product</option>
                <?php
                $sql = "SELECT * FROM `sw_products_list_show` s 
left join sw_products_list p on s.sh_rel_pr_id = p.pr_id
left join sw_showrooms ss on s.sh_rel_shw_id = ss.shw_id
where s.sh_valid =1 and p.pr_valid =1 and ss.shw_valid =1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('20i94joefwnd'.$row['pr_id']))).'">'.$row['pr_code'].'-'.$row['pr_name'].' from '.$row['shw_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
            </div>
	<div class="col-xs-6">
        <div class="form-group">
            <label>Client: </label><br>
            <select class="form-control mobsel" name="add_mockup_showroom_old_client_hash" required>
            <option>Select Client</option>
                <?php
                $sql = "SELECT * FROM sw_clients where cli_valid =1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('2094uihwornjds ikjn fm'.$row['cli_id']))).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
	</div>
</div>


<div class="row">
	<div class="col-xs-12">
        <div class="form-group">
            <label>Quantity: </label>
            <input required  name="add_mockup_showroom_old_qty" type="text" class="form-control" placeholder="Qty"/>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_mockup_showroom_old_client" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobsel').mobileSelect();
    } );
</script>

	<?php
}
if(isset($_POST['mockup_showroom_new'])){
?>        <form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-xs-4">
        <div class="form-group">
            <label>Product: </label><br>

            <select class="form-control mobsel" name="add_mockup_showroom_new_product_hash" required>
            <option>Select Product</option>
                <?php
                $sql = "SELECT * FROM `sw_products_list_show` s 
left join sw_products_list p on s.sh_rel_pr_id = p.pr_id
left join sw_showrooms ss on s.sh_rel_shw_id = ss.shw_id
where s.sh_valid =1 and p.pr_valid =1 and ss.shw_valid =1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('0uijrwno0gj3iow'.$row['pr_id']))).'">'.$row['pr_code'].'-'.$row['pr_name'].' from '.$row['shw_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
        <div class="col-xs-8">
            <div class="form-group">
                <label>Quantity: </label>
                <input required  name="add_mockup_showroom_new_qty" type="text" class="form-control" placeholder="Qty"/>
            </div>
        </div>
</div>
<div class="row">

            
<div class="col-xs-12">
            <label>Client: </label>

        <div class="form-group">
<div class="row">
    <div class="col-xs-4"><p>Name:<input required class="form-control "  name="add_mockup_showroom_new_client_name" type="text" placeholder="Alpha Beta" /></p></div>
    <div class="col-xs-4"><p>Code:<input required class="form-control "  name="add_mockup_showroom_new_client_code" type="text" placeholder="AB" /></p></div>
    <div class="col-xs-4"><p>Desc: <input required class="form-control "  name="add_mockup_showroom_new_client_desc" type="text" placeholder="Description of the client" value="-" /></p></div>
</div>
<div class="row">
    <div class="col-xs-6"><p>Email: <input required  class="form-control" name="add_mockup_showroom_new_client_email" type="email" placeholder="abc@example.com"  /></p></div>
    <div class="col-xs-6"><p>Phone:<input required class="form-control "  name="add_mockup_showroom_new_client_phone" type="text" placeholder="With International Code and seperated with comma ," /></p></div>
</div>
<div class="row">
    <div class="col-xs-6"><p>Billing Address: <textarea name="add_mockup_showroom_new_client_bill_addr" class="wysihtml5 form-control" rows="9"></textarea></p></div>
    <div class="col-xs-6"><p>Shipping Address:<textarea name="add_mockup_showroom_new_client_ship_addr" class="wysihtml5 form-control" rows="9"></textarea></p></div>
</div>
<div class="row">
    <div class="col-xs-4"><p>Tax Code:<input required class="form-control "  name="add_mockup_showroom_new_client_tax_code" type="text" placeholder="Code" /></p></div>
    <div class="col-xs-4"><p>Bank Details:<input required class="form-control "  name="add_mockup_showroom_new_client_bank_details" type="text" placeholder="Details" /></p></div>
    <div class="col-xs-4"><p>Payment Terms: <input required  class="form-control" name="add_mockup_showroom_new_client_pay_terms" type="text" placeholder='50,40,10' value="50,50" /></p> 
    </div>
</div> 

        </div>
</div>
</div>


<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_mockup_showroom_new" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobsel').mobileSelect();
    } );
</script>

	<?php
}
if(isset($_POST['mockup_supplier_old'])){
?>        <form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-xs-4">
        <div class="form-group">
            <label>Client: </label><br>
            <select class="form-control mobsel" name="add_mockup_supplier_old_client_hash" required>
            <option>Select Client</option>
                <?php
                $sql = "SELECT * FROM sw_clients where cli_valid =1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.md5(sha1(md5('3oiwjf3oihegnr ikjn fm'.$row['cli_id']))).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
            }
        } else {
        }
                ?>
            </select>
        </div>
	</div>	
    <div class="col-xs-4">
        <div class="form-group">
            <label>Invoice Ref: </label>
            <input required  name="add_mockup_supplier_old_ref_qty" type="text" class="form-control" placeholder="Invoice Ref"/>
        </div>
	</div>
    <div class="col-xs-4">
        <div class="form-group">
            <label>Quantity: </label>
            <input required  name="add_mockup_supplier_old_qty" type="text" class="form-control" placeholder="Qty"/>
        </div>
	</div>


	<div class="col-xs-12">
        <div class="form-group">
            <label>Product: </label>
		<div class="row">
			<div class="col-xs-2"><input type="file" name="add_mockup_supplier_old_product_img" accept="image/*"/></div>
		</div><br>
<div class="row">
<div class="col-xs-4">

<div class="form-group">
	<label>Product Name: </label>
	<input required  name="add_mockup_supplier_old_product_name" type="text" class="form-control" placeholder="Name"/>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
	<label>Code: </label>
	<input required  name="add_mockup_supplier_old_product_code" type="text" class="form-control" placeholder="Code"/>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
	<label>Product Type: </label><br>
    <select class="form-control mobsel" name="add_mockup_supplier_old_product_type" required>
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
</div>
<div class="form-group">
	<label>Supplier: </label><br>
    <select class="form-control mobsel" name="add_mockup_supplier_old_product_supplier" required>
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


<div class="form-group">
	<label>Description: </label>
	<textarea name="add_mockup_supplier_old_product_desc" class="wysihtml5 form-control" rows="9">-</textarea>
</div>


<div class="form-group">
	<label>Cost: </label>
	<input required  name="add_mockup_supplier_old_product_cost" type="text" class="form-control" placeholder="No Unit"/>
</div>

            
            
            
            
            
            
            
            
        </div>
            </div>
</div>


<div class="row">
</div>

<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_mockup_supplier_old" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobsel').mobileSelect();
    } );
</script>

	<?php
}
if(isset($_POST['mockup_supplier_new'])){
?>        <form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
<div  style="border-right:1px solid #D4D1D1" class="col-xs-6">
            <label>Client: </label>

        <div class="form-group">
<div class="row">
    <div class="col-xs-4"><p>Name:<input required class="form-control "  name="add_mockup_supplier_new_client_name" type="text" placeholder="Alpha Beta" /></p></div>
    <div class="col-xs-4"><p>Code:<input required class="form-control "  name="add_mockup_supplier_new_client_code" type="text" placeholder="AB" /></p></div>
    <div class="col-xs-4"><p>Desc: <input required class="form-control "  name="add_mockup_supplier_new_client_desc" type="text" placeholder="Description of the client" value="-" /></p></div>
</div>
<div class="row">
    <div class="col-xs-6"><p>Email: <input required  class="form-control" name="add_mockup_supplier_new_client_email" type="email" placeholder="abc@example.com"  /></p></div>
    <div class="col-xs-6"><p>Phone:<input required class="form-control "  name="add_mockup_supplier_new_client_phone" type="text" placeholder="With International Code and seperated with comma ," /></p></div>
</div>
<div class="row">
    <div class="col-xs-6"><p>Billing Address: <textarea name="add_mockup_supplier_new_client_bill_addr" class="wysihtml5 form-control" rows="9"></textarea></p></div>
    <div class="col-xs-6"><p>Shipping Address:<textarea name="add_mockup_supplier_new_client_ship_addr" class="wysihtml5 form-control" rows="9"></textarea></p></div>
</div>
<div class="row">
    <div class="col-xs-4"><p>Tax Code:<input required class="form-control "  name="add_mockup_supplier_new_client_tax_code" type="text" placeholder="Code" /></p></div>
    <div class="col-xs-4"><p>Bank Details:<input required class="form-control "  name="add_mockup_supplier_new_client_bank_details" type="text" placeholder="Details" /></p></div>
    <div class="col-xs-4"><p>Payment Terms: <input required  class="form-control" name="add_mockup_supplier_new_client_pay_terms" type="text" placeholder='50,40,10' value="50,50" /></p> 
    </div>
</div> 

        </div>
        <div class="form-group">
            <label>Invoice Ref: </label>
            <input required  name="add_mockup_supplier_new_ref_qty" type="text" class="form-control" placeholder="Invoice Number"/>
        </div>
        <div class="form-group">
            <label>Quantity: </label>
            <input required  name="add_mockup_supplier_new_qty" type="text" class="form-control" placeholder="Qty"/>
        </div>

</div>    


	<div class="col-xs-6">
        <div class="form-group">
            <label>Product: </label>
		<div class="row">
			<div class="col-xs-2"><input type="file" name="add_mockup_supplier_new_product_img" accept="image/*"/></div>
		</div><br>
<div class="row">
<div class="col-xs-4">

<div class="form-group">
	<label>Product Name: </label>
	<input required  name="add_mockup_supplier_new_product_name" type="text" class="form-control" placeholder="Name"/>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
	<label>Code: </label>
	<input required  name="add_mockup_supplier_new_product_code" type="text" class="form-control" placeholder="Code"/>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
	<label>Product Type: </label><br>
    <select class="form-control mobsel" name="add_mockup_supplier_new_product_type" required>
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
</div>
<div class="form-group">
	<label>Supplier: </label><br>
    <select class="form-control mobsel" name="add_mockup_supplier_new_product_supplier" required>
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


<div class="form-group">
	<label>Description: </label>
	<textarea name="add_mockup_supplier_new_product_desc" class="wysihtml5 form-control" rows="9">-</textarea>
</div>


<div class="form-group">
	<label>Cost: </label>
	<input required  name="add_mockup_supplier_new_product_cost" type="text" class="form-control" placeholder="No Unit"/>
</div>

            
            
            
            
            
            
            
            
        </div>
            </div>
</div>

<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_mockup_supplier_new" value="Add">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml5").wysihtml5();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.mobsel').mobileSelect();
    } );
</script>

	<?php
}
/*-------------------------------------------*/
if(isset($_POST['quote_detailed_view'])){
	if(ctype_alnum($_POST['quote_detailed_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_quotes
	left join sw_currency on qo_rel_cur_id = cur_id
	left join sw_clients on qo_rel_cli_id = cli_id
	 where md5(qo_id)= '".$_POST['quote_detailed_view']."' and qo_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No Quote Found for this hash');
	}
	?>
	<div class="row">
    <div class="col-xs-4">
        <p><div class="text-muted">Quote Ref:</div><?php echo $getqoid['qo_ref']; ?></p>
        <p><div class="text-muted">Date:</div><?php echo date('d-m-Y',$getqoid['qo_dnt']); ?></p>
        <p><div class="text-muted">Currency:</div><?php echo $getqoid['cur_name']; ?></p>
    </div>
    <div class="col-xs-4">
        <p><div class="text-muted">Project:</div><?php echo $getqoid['qo_proj_name']; ?></p>
        <p><div class="text-muted">Sub:</div><?php echo $getqoid['qo_subj']; ?></p>
	    </div>
    
    <div class="col-xs-4">
        <p><div class="text-muted">Billing Address:</div><br><?php echo '<strong>'.$getqoid['cli_name'].'</strong><br>'.$getqoid['cli_bill_addr']; ?></p>
    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div  class="row">
                                        <hr>

                                    <table id="datatable_in" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Img</th>
                                                    <th>Name</th>
                                                   <?php if(($_SESSION['STWL_LUM_TU_ID'] ==1) or ($_SESSION['STWL_LUM_TU_ID'] ==2)){ ?>  <th>Cost AED <br>per Unit</th><?php }?>                                                    
                                                   <?php if(($_SESSION['STWL_LUM_TU_ID'] ==1) or ($_SESSION['STWL_LUM_TU_ID'] ==2)){ ?> <th>Markup</th><?php }?>
                                                    <th>Sale Price AED<br>per Unit </th>
                                                    <th>Qty</th>
                                                    <th></th>
                                                    <th>Total <?php echo $getqoid['cur_name'] ?></th>
                                                    <th>-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_quotes_items` q 
left join sw_products_list p on q.qi_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.qi_rel_qo_id =".$getqoid['qo_id']."  and qi_valid =1 and p.pr_valid =1
and t.prty_valid =1
order by pr_code asc

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		$init = round(($boxrw['qi_qty'] * $boxrw['qi_price'] * $getqoid['qo_cur_rate']),2);
		echo '
		<tr>
<td>'.$cc.'</td>
<td>'.$boxrw['pr_code'].'</td>
<td><img src="'.($boxrw['qi_pr_main_img'] == '-' ? $boxrw['pr_img'] : $boxrw['qi_pr_main_img']).'" class="img-responsive" width="200px" /><br>Image is for illustration purpose only</td>
<td>'.$boxrw['pr_name'].'<br>'.convert_desc($boxrw['qi_desc']).'</td>
'; if(($_SESSION['STWL_LUM_TU_ID'] ==1) or ($_SESSION['STWL_LUM_TU_ID'] ==2)){ echo '<td>AED '.$boxrw['qi_cost'].'</td>'; }echo'
'; if(($_SESSION['STWL_LUM_TU_ID'] ==1) or ($_SESSION['STWL_LUM_TU_ID'] ==2)){ echo '<td>'.round((($boxrw['qi_price']/$boxrw['qi_cost'])),3).'</td>'; }echo'
<td>AED '.$boxrw['qi_price'].'</td>
<td>'.($boxrw['qi_qty'] * $boxrw['prty_conv_formula']).' '.$boxrw['prty_conv_unit'].'</td>
<td></td>
<td>'.$getqoid['cur_name'].' '.number_format($init,2).'</td>
<td>'.($boxrw['prty_pr_hidden'] == '1' ? '<i style="color:red">This product will not be visible in the print view. <br> And total will not be added in the Sub-Total</i>' : '').'</td>
</tr>';




if(($boxrw['qi_img_1'] == '0') and ($boxrw['qi_img_2'] == '0') and ($boxrw['qi_img_3'] == '0') and ($boxrw['qi_img_4'] == '0') and ($boxrw['qi_img_5'] == '0') ){
}else{
	echo '<tr>
<td>'.$cc.'</td>
	<td>'.$boxrw['pr_code'].'-EXTRA</td>
';

for($i = 1; $i <6; $i++){
	if($boxrw['qi_img_'.$i] !== '0'){ ?>
<td><img src="<?php echo  $boxrw['qi_img_'.$i] ?>" class="img-responsive" width="200px" /></td>
	 <?php }else{
		 ?><td></td><?php
	 }

}
if(($_SESSION['STWL_LUM_TU_ID'] ==1) or ($_SESSION['STWL_LUM_TU_ID'] ==2)){ ?> <td></td><td></td><?php }
echo '
<td></td>
<td></td>
	
	</tr>';
}

	$cc++;
	#first loop ends
	if($boxrw['prty_pr_hidden'] == '0'){
	$total = $total + ($init);
	}
	
    }
} else {
    echo "0 results";
}
 ?>                       

 						                          
                                            </tbody>
                                        </table>
                                        
                                        <?php 
							echo '<h4 align="right">'.$getqoid['cur_name'].' '.number_format(($total),2).'</h4>'; 
							echo '<h4 align="right">'.$getqoid['cur_name'].' '.strtoupper(convert_number_to_words(($total))).'</h4>'; 
							
							?>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
                                     </div>
                                </div>
                                <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_in').dataTable();
    } );
</script>
                                <?php
}
if(isset($_POST['quote_edit'])){
	if(ctype_alnum($_POST['quote_edit'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "
	select * from sw_quotes 
	left join sw_currency on qo_rel_cur_id = cur_id 
	left join sw_clients on qo_rel_cli_id = cli_id 
	where md5(qo_revision_id)= '".$_POST['quote_edit']."' and qo_valid =1 order by qo_revision desc  limit 1
	");
	if(is_array($getqoid)){
	}else{
		die('No Quote Found for this hash');
	}
	?>
<form action="master_action.php" method="post" enctype="multipart/form-data">
	<div class="row">
		<h5 align="center" style="color:red">All Data has been picked from the latest Quotation</h5>
<div class="col-xs-4">
<input required type="hidden" name="add_revision_q_hash" value="<?php echo md5($getqoid['qo_id']); ?>" />
            
            
    <p>
        <div class="text-muted">Currency:</div>
            <?php echo $getqoid['cur_name'] .'<br> Rate:'.$getqoid['qo_cur_rate'] ?>
    </p>
</div>

<div class="col-xs-4">
    <p>
    	<div class="text-muted">Project:</div>
        <input type="text" class="form-control" name="add_revision_quote_proj_name" value="<?php echo $getqoid['qo_proj_name']; ?>" required />
    </p>
    
    <p>
        <div class="text-muted">Sub:</div>
        <input type="text" class="form-control" name="add_revision_quote_subj" value="<?php echo $getqoid['qo_subj']; ?>" required />
    </p>
    
</div>
    
<div class="col-xs-4">
	<p>
    	<div class="text-muted">Billing Address:</div>
        <br>Will Be Picked from the account of <?php echo  $getqoid['cli_code'].'-'.$getqoid['cli_name']; ?>
	</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div  class="row">
<hr>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th  style="width:25%">Product</th>
                <th style="width:30%">Product Desc</th>
                <th style="width:12%">Cost Price</th>
                <th style="width:12%">Sale Price</th>
                <th style="width:12%">Qty</th>
                <th style="width:9%"></th>
            </tr>
        </thead>
        <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_quotes_items` q 
left join sw_products_list p on q.qi_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.qi_rel_qo_id =".$getqoid['qo_id']."  and qi_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		
		#firts loop begins
		echo '


<tr>
	<td><select id="selold'.$cc.'" class="form-control " name="add_revision_quote_product_already_'.$cc.'">';
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
 where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
 order by pr_code,pr_name asc";
 echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	   if($row['pr_id'] == $boxrw['qi_rel_pr_id']){
		   echo '<option data-id="'.$row['pr_id'].'" selected value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }else{
		   echo '<option data-id="'.$row['pr_id'].'"  value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }
	}
} else {
	echo "0 results";
}
echo '</select></td>
	
	
	<td>
	<textarea required class=" form-control" name="add_revision_quote_desc_already_'.$cc.'" id="rqda'.$cc.'">'.$boxrw['qi_desc'].'</textarea></td>
	<td><input id="rqca'.$cc.'" name="add_revision_quote_cost_already_'.$cc.'" type="number" step="0.01" class="form-control" required value="'.$boxrw['qi_cost'].'" /></td>
	<td><input name="add_revision_quote_price_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['qi_price'].'" /></td>
	<td><input name="add_revision_quote_qty_already_'.$cc.'" type="number" step="0.01" class="form-control" required value="'.$boxrw['qi_qty'].'" /></td>
	';
	?>
    
<script type="text/javascript">
$(document).ready(function() {
	$('#selold<?php echo $cc; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#rqda<?php echo $cc; ?>").val(result.desc);
					$("#rqca<?php echo $cc; ?>").val(result.cost);
				});
	} );
} );
		
		
</script>

	<td><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>
	<?php echo'
</tr>
';
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>
        <tr id="add1" class="clonedInput">
            <td><select class="form-control add_revision_quote_product_a" id="add_revision_quote_product_a" name="add_revision_quote_product_a">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
            <td><textarea name="add_revision_quote_desc_a" class="form-control add_revision_quote_desc_a" id="add_revision_quote_desc_a" required>-</textarea></td>
            <td><input name="add_revision_quote_cost_a"  type="number" step="0.01" class="form-control add_revision_quote_cost_a" id="add_revision_quote_cost_a" required value="0" placeholder="Cost Price"  /></td>
            <td><input name="add_revision_quote_price_a"  type="number" step="0.01" class="form-control add_revision_quote_price_a" id="add_revision_quote_price_a" required value="0" placeholder="Sale Price"  /></td>
            <td><input name="add_revision_quote_qty_a"  type="number" step="0.01" class="form-control add_revision_quote_qty_a" id="add_revision_quote_qty_a" required value="0" placeholder="Qty"  /></td>
            <td><div class="add_revision_quote_script" id="add_revision_quote_script"></div></td>

	    </tr>
        
        
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_revision_quote_product_a').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_revision_quote_desc_a").val(result.desc);
					$("#add_revision_quote_cost_a").val(result.cost);
				});
	} );
} );
		
</script>
<div class="row">
    <div align="center" class=" col-xs-12 ">
        <div id="addDelButtons">
          <input style="border-radius:10px" type="button" id="btnAdd" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel" value="Remove" class="btn btn-danger">
        </div> 
    </div><br>

    <div class="col-xs-12">
    	<input align="" type="submit" class="btn btn-success" value="Revise" name="add_revision"  />
        <input required  value="1" id="rev_nos" class="form-control" type="hidden" name="rev_nos"  />

    </div>
</div> 
                                        
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
		</div>
	</div>
</div>
</form>


<?php /*
<script>
$(document).ready(function(){
		  $(".1wysihtml5").wysihtml5();
});
</script>

*/ ?>
<script type="text/javascript">
    $(document).ready(function() {
    } );
</script>
<script>
function myFunct(val) {
	if(val ==2){
		y = '';
	}else{
		y =(val-1);
	}
}

</script>



<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>

                                <?php
}
if(isset($_POST['add_quote_warehouse'])){
	?>
     <form action="master_action.php" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label>Quote Ref: </label>
	Auto Generated
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label>Currency: </label>
            <select class="form-control" name="add_quote_currency" required>
                <?php
                $sql = "SELECT * FROM sw_currency";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if(trim($row['cur_id']) == 1){
                echo '<option selected value="'.md5($row['cur_id']).'">'.$row['cur_name'].'</option>';
                }else{
                echo '<option value="'.md5($row['cur_id']).'">'.$row['cur_name'].'</option>';
                }
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
    
            <label>Currency Rate: </label>
            <input required type="text" name="add_quote_cur_rate" class="form-control" placeholder="Multiplied by AED" value="1"/>
        </div>
    </div>
</div>

<div class="form-group">
	<label>Client: </label>
    <select class="form-control" name="add_quote_client" required>
    	<?php
		$sql = "SELECT * FROM sw_clients where cli_valid =1";
$result = $conn->query($sql);
?>
<option selected>Select Client</option>
 <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<option value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
    }
} else {
}
		?>
    </select>
</div>

<div class="form-group">
	<label>Project Name: </label>
	<input required  name="add_quote_project_name" type="text" class="form-control" placeholder="---"/>
</div>

<div class="form-group">
	<label>Subject Name: </label>
	<input required  name="add_quote_subject_name" type="text" class="form-control" placeholder="---"/>
</div>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width:20%">Product</th>
                <th style="width:19%">Extra Images</th>
                <th style="width:29%">Product Desc</th>
                <th style="width:9%">Cost Price</th>
                <th style="width:9%">Sale Price</th>
                <th style="width:9%">Qty</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
<tr id="quoteadd1" class="twoclonedInput">
            <td><select class="form-control add_quote_product" id="add_quote_product" name="add_quote_product">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
<td>
	<input name="add_quote_product_images_1_a" type="file" accept="image/*" class="form-control add_quote_product_images_1_a" id="add_quote_product_images_1_a" />
	<input name="add_quote_product_images_2_a" type="file" accept="image/*" class="form-control add_quote_product_images_2_a" id="add_quote_product_images_2_a" />
	<input name="add_quote_product_images_3_a" type="file" accept="image/*" class="form-control add_quote_product_images_3_a" id="add_quote_product_images_3_a" /><br>
	<input name="add_quote_product_images_4_a" type="file" accept="image/*" class="form-control add_quote_product_images_4_a" id="add_quote_product_images_4_a" />
	<input name="add_quote_product_images_5_a" type="file" accept="image/*" class="form-control add_quote_product_images_5_a" id="add_quote_product_images_5_a" />
</td>
<td><textarea name="add_quote_product_desc" class="form-control add_quote_product_desc" id="add_quote_product_desc" required>-</textarea></td>
<td><input name="add_quote_product_cost"  type="number" step="0.01" class="form-control add_quote_product_cost" id="add_quote_product_cost" required value="0" placeholder="Cost Price"  /></td>
<td><input name="add_quote_product_price"  type="number" step="0.01" class="form-control add_quote_product_price" id="add_quote_product_price" required value="0" placeholder="Sale Price"  /></td>
<td><input name="add_quote_product_qty"  type="number" step="0.01" class="form-control add_quote_product_qty" id="add_quote_product_qty" required value="0" placeholder="Qty"  /></td>
<td><div class="add_quote_product_script" id="add_quote_product_script"></div></td>

	    </tr>
        
        </tbody>
</table>
<hr>
<div class="row">
    <div align="left" class=" col-xs-12 ">
        <div id="addDelButtons2">
          <input style="border-radius:10px" type="button" id="btnAdd2" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel2" value="Remove" class="btn btn-danger">
        </div> 
    </div>
        <input required  value="1" id="qot_nos" class="form-control" type="hidden" name="qot_nos"  />
</div> 

<hr>




<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_quote" value="Add Quote">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_quote_product').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_quote_product_desc").val(result.desc);
					$("#add_quote_product_cost").val(result.cost);
				});
	} );
} );
		
</script>
    <?php
}
if(isset($_POST['add_quote_quote'])){
	if(is_string($_POST['add_quote_quote'])){
	}else{
		die('Quotation Invalid');
	}
	
$getquote = getdatafromsql($conn,"select * from sw_quotes where qo_ref = '".strtoupper($_POST['add_quote_quote'])."' and qo_valid = 1");
if(is_array($getquote)){
}else{
	die('Quotation Not Found in Database');
}
	?>
     <form action="master_action.php" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label>Quote Ref: </label>
	Auto Generated
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label>Currency: </label>
            <select class="form-control" name="add_quote_currency" required>
                <?php
                $cursql = "SELECT * FROM sw_currency";
        $cursql = $conn->query($cursql);
        
        if ($cursql->num_rows > 0) {
            // output data of each row
            while($cursqlrow = $cursql->fetch_assoc()) {
                if(trim($cursqlrow['cur_id']) == $getquote['qo_rel_cur_id']){
                echo '<option selected value="'.md5($cursqlrow['cur_id']).'">'.$cursqlrow['cur_name'].'</option>';
                }else{
                echo '<option value="'.md5($cursqlrow['cur_id']).'">'.$cursqlrow['cur_name'].'</option>';
                }
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
    
            <label>Currency Rate: </label>
            <input required type="text" name="add_quote_cur_rate" class="form-control" placeholder="Multiplied by AED" value="<?php echo $getquote['qo_cur_rate']; ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
	<label>Client: </label>
    <select class="form-control" name="add_quote_client" required>
    	<?php
		$sql = "SELECT * FROM sw_clients where cli_valid =1";
$result = $conn->query($sql);
?>
 <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
if($row['cli_id'] == $getquote['qo_rel_cli_id']){
	echo '<option selected value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
}else{
	echo '<option value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
}
    }
} else {
}
		?>
    </select>
</div>

<div class="form-group">
	<label>Project Name: </label>
	<input required  name="add_quote_project_name" type="text" class="form-control" placeholder="---" value="<?php echo $getquote['qo_proj_name']; ?>"/>
</div>

<div class="form-group">
	<label>Subject Name: </label>
	<input required  name="add_quote_subject_name" type="text" class="form-control" placeholder="---" value="<?php echo $getquote['qo_subj']; ?>"/>
</div>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width:20%">Product</th>
                <th style="width:19%">Extra Images</th>
                <th style="width:29%">Product Desc</th>
                <th style="width:9%">Cost Price</th>
                <th style="width:9%">Sale Price</th>
                <th style="width:9%">Qty</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
<?php 

$getprod = "SELECT * from sw_quotes_items where qi_rel_qo_id = ".$getquote['qo_id']." and qi_valid =1";
$getprod = $conn->query($getprod);

if ($getprod->num_rows > 0) {
    // output data of each row
	$loopid =1 ;
    while($getprodrow = $getprod->fetch_assoc()) {

if($loopid == '1'){
	$num = '';
}else{
	$num = $loopid;
}
 ?>

<tr id="quoteadd<?php echo $loopid; ?>" class="twoclonedInput">
            <td><select class="form-control add_quote_product" id="add_quote_product<?php echo $num; ?>" name="add_quote_product<?php echo $num; ?>">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
if($row['pr_id'] == $getprodrow['qi_rel_pr_id']){
echo '<option selected  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
}else{
echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
}
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
<td>
<input name="add_quote_product_images_1_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_1_a" id="add_quote_product_images_1_a<?php echo $num; ?>" />
<input name="add_quote_product_images_2_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_2_a" id="add_quote_product_images_2_a<?php echo $num; ?>" />
<input name="add_quote_product_images_3_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_3_a" id="add_quote_product_images_3_a<?php echo $num; ?>" /><br>
<input name="add_quote_product_images_4_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_4_a" id="add_quote_product_images_4_a<?php echo $num; ?>" />
<input name="add_quote_product_images_5_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_5_a" id="add_quote_product_images_5_a<?php echo $num; ?>" />
</td>

<td><textarea name="add_quote_product_desc<?php echo $num; ?>" class="form-control add_quote_product_desc" id="add_quote_product_desc<?php echo $num; ?>"  required><?php echo $getprodrow['qi_desc']; ?></textarea></td>
<td><input name="add_quote_product_cost<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_quote_product_cost" id="add_quote_product_cost<?php echo $num; ?>" required value="<?php echo $getprodrow['qi_cost']; ?>" placeholder="Cost Price"  /></td>
<td><input name="add_quote_product_price<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_quote_product_price" id="add_quote_product_price<?php echo $num; ?>" required value="<?php echo $getprodrow['qi_price']; ?>" placeholder="Sale Price"  /></td>
<td><input name="add_quote_product_qty<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_quote_product_qty" id="add_quote_product_qty<?php echo $num; ?>" required value="<?php echo $getprodrow['qi_qty']; ?>" placeholder="Qty"  /></td>
<td><div class="add_quote_product_script" id="add_quote_product_script">
<script type="text/javascript">
$(document).ready(function() {
	$('#add_quote_product<?php echo $num; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_quote_product_desc<?php echo $num; ?>").val(result.desc);
					$("#add_quote_product_cost<?php echo $num; ?>").val(result.cost);
				});
	} );
} );
		
</script>
</div><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>


	    </tr>
        
        
        
        <?php
	$loopid++;	
    }
} else {
    echo "No Products in Quote";
} ?>
        </tbody>
</table>
<hr>
<div class="row">
    <div align="left" class=" col-xs-12 ">
        <div id="addDelButtons2">
          <input style="border-radius:10px" type="button" id="btnAdd2" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel2" value="Remove" class="btn btn-danger">
        </div> 
    </div>
        <input required  value="<?php echo ($loopid-1); ?>" id="qot_nos" class="form-control" type="hidden" name="qot_nos"  />
</div> 

<hr>




<div class="row">
	<div class="col-xs-6">
    <input type="hidden" name="fromquote" value="-" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_quote" value="Add Quote">
	</div>
</div>
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>




    <?php
}
if(isset($_POST['quote_edit_img'])){
	if(ctype_alnum($_POST['quote_edit_img'])){
	}else{
		die('Quotation Invalid');
	}
	
$getquote = getdatafromsql($conn,"select * from sw_quotes
left join sw_currency on qo_rel_cur_id = cur_id 
	left join sw_clients on qo_rel_cli_id = cli_id  where md5(qo_id) = '".trim($_POST['quote_edit_img'])."' and qo_valid = 1");
if(is_array($getquote)){
}else{
	die('Quotation Not Found in Database');
}
	?>
     <form action="master_action.php" method="post" enctype="multipart/form-data">

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <label>Currency: </label>
    <p><?php echo $getquote['cur_name']; ?><p>
    <p>Multiplying Factor: <?php echo $getquote['qo_cur_rate']; ?><p>
</div>
    </div>
</div>

<div class="form-group">
	<label>Client: </label>
    <p><?php echo $getquote['cli_name']; ?><p>
</div>



<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Main Image</th>
                <th>Extra Images</th>
                <th>Cost Price</th>
                <th>Sale Price</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
<?php 

$getprod = "SELECT * from sw_quotes_items left join sw_products_list on qi_rel_pr_id = pr_id  where pr_valid =1 and qi_rel_qo_id = ".$getquote['qo_id']." and qi_valid =1";
$getprod = $conn->query($getprod);

if ($getprod->num_rows > 0) {
    // output data of each row
	$loopid =1 ;
    while($getprodrow = $getprod->fetch_assoc()) {
 ?>
<tr>
	<td><?php echo $getprodrow['pr_name'].'<br>'.convert_desc($getprodrow['qi_desc']); ?></td>
	<td><input type="file" accept="image/*" name="product_main_img_<?php echo $getprodrow['qi_id']; ?>" /></td>
	<td><?php 
	for($rrr = 1; $rrr <6;$rrr++){
		?>
        <input type="file" accept="image/*" name="product_extra_img_<?php echo $getprodrow['qi_id']; ?>_<?php echo $rrr ?>" />
        <?php
	}
	?></td>
	<td><?php echo $getprodrow['qi_cost']; ?></td>
	<td><?php echo $getprodrow['qi_price']; ?></td>
	<td><?php echo $getprodrow['qi_qty']; ?></td>
</tr>
        <?php
	$loopid++;	
    }
} else {
    echo "No Products in Quote";
} ?>
        </tbody>
</table>
<hr>

<hr>




<div class="row">
	<div class="col-xs-6">
    <input type="hidden" name="edit_quote_img_hash" value="<?php echo md5($getquote['qo_id']) ?>" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="edit_quote_img" value="Edit Images">
	</div>
</div>
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>




    <?php
}
if(isset($_POST['add_quote_quote_merge'])){
	if(is_string($_POST['add_quote_quote_merge'])){
	}else{
		die('Quotation Invalid');
	}
	
$pos = strpos($_POST['add_quote_quote_merge'], ',');
if ($pos === false) {
    die('Provide quotations which are coma seperated');
} 
$str = trim($_POST['add_quote_quote_merge']);

$str = explode(',',$str);
$swqref = array();
$swqid = array();
foreach($str as $qo){
	$swqref[] = trim($qo);
	$getquote = getdatafromsql($conn,"select * from sw_quotes where qo_ref = '".strtoupper($qo)."' and qo_valid = 1");
	if(is_array($getquote)){
	$swqid[] = $getquote['qo_id'];
	}else{
		die('Quotation with ref '.$qo.' Not Found in Database');
	}
	
}


	?>
     <form action="master_action.php" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label>Quote Ref: </label>
	Auto Generated
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label>Currency: </label>
            <select class="form-control" name="add_quote_currency" required>
                <?php
                $cursql = "SELECT * FROM sw_currency";
        $cursql = $conn->query($cursql);
        
        if ($cursql->num_rows > 0) {
            // output data of each row
            while($cursqlrow = $cursql->fetch_assoc()) {
                if(trim($cursqlrow['cur_id']) == $getquote['qo_rel_cur_id']){
                echo '<option selected value="'.md5($cursqlrow['cur_id']).'">'.$cursqlrow['cur_name'].'</option>';
                }else{
                echo '<option value="'.md5($cursqlrow['cur_id']).'">'.$cursqlrow['cur_name'].'</option>';
                }
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
    
            <label>Currency Rate: </label>
            <input required type="text" name="add_quote_cur_rate" class="form-control" placeholder="Multiplied by AED" value="<?php echo $getquote['qo_cur_rate']; ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
	<label>Client: </label>
    <select class="form-control" name="add_quote_client" required>
    <option>Select Supplier</option>
    	<?php
		$sql = "SELECT * FROM sw_clients where cli_valid =1";
$result = $conn->query($sql);
?>
 <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
if($row['cli_id'] == $getquote['qo_rel_cli_id']){
	echo '<option selected value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
}else{
	echo '<option value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
}
    }
} else {
}
		?>
    </select>
</div>

<div class="form-group">
	<label>Project Name: </label>
	<input required  name="add_quote_project_name" type="text" class="form-control" placeholder="---" value="<?php echo $getquote['qo_proj_name']; ?>"/>
</div>

<div class="form-group">
	<label>Subject Name: </label>
	<input required  name="add_quote_subject_name" type="text" class="form-control" placeholder="---" value="<?php echo $getquote['qo_subj']; ?>"/>
</div>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width:20%">Product</th>
                <th style="width:19%">Extra Images</th>
                <th style="width:29%">Product Desc</th>
                <th style="width:9%">Cost Price</th>
                <th style="width:9%">Sale Price</th>
                <th style="width:9%">Qty</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
<?php 
$totalqids = implode(',',$swqid);
$getprod = "SELECT * from sw_quotes_items where qi_rel_qo_id in  ( ".$totalqids." ) and qi_valid =1";
$getprod = $conn->query($getprod);

if ($getprod->num_rows > 0) {
    // output data of each row
	$loopid =1 ;
    while($getprodrow = $getprod->fetch_assoc()) {

if($loopid == '1'){
	$num = '';
}else{
	$num = $loopid;
}
 ?>

<tr id="quoteadd<?php echo $loopid; ?>" class="twoclonedInput">
            <td><select class="form-control add_quote_product" id="add_quote_product<?php echo $num; ?>" name="add_quote_product<?php echo $num; ?>">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
if($row['pr_id'] == $getprodrow['qi_rel_pr_id']){
echo '<option selected  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
}else{
echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
}
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
<td>
<input name="add_quote_product_images_1_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_1_a" id="add_quote_product_images_1_a<?php echo $num; ?>" />
<input name="add_quote_product_images_2_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_2_a" id="add_quote_product_images_2_a<?php echo $num; ?>" />
<input name="add_quote_product_images_3_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_3_a" id="add_quote_product_images_3_a<?php echo $num; ?>" /><br>
<input name="add_quote_product_images_4_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_4_a" id="add_quote_product_images_4_a<?php echo $num; ?>" />
<input name="add_quote_product_images_5_a<?php echo $num; ?>" type="file" accept="image/*" class="add_quote_product_images_5_a" id="add_quote_product_images_5_a<?php echo $num; ?>" />
</td>

<td><textarea name="add_quote_product_desc<?php echo $num; ?>" class="form-control add_quote_product_desc" id="add_quote_product_desc<?php echo $num; ?>"  required><?php echo $getprodrow['qi_desc']; ?></textarea></td>
<td><input name="add_quote_product_cost<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_quote_product_cost" id="add_quote_product_cost<?php echo $num; ?>" required value="<?php echo $getprodrow['qi_cost']; ?>" placeholder="Cost Price"  /></td>
<td><input name="add_quote_product_price<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_quote_product_price" id="add_quote_product_price<?php echo $num; ?>" required value="<?php echo $getprodrow['qi_price']; ?>" placeholder="Sale Price"  /></td>
<td><input name="add_quote_product_qty<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_quote_product_qty" id="add_quote_product_qty<?php echo $num; ?>" required value="<?php echo $getprodrow['qi_qty']; ?>" placeholder="Qty"  /></td>
<td><div class="add_quote_product_script" id="add_quote_product_script">
<script type="text/javascript">
$(document).ready(function() {
	$('#add_quote_product<?php echo $num; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_quote_product_desc<?php echo $num; ?>").val(result.desc);
					$("#add_quote_product_cost<?php echo $num; ?>").val(result.cost);
				});
	} );
} );
		
</script>
</div><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>


	    </tr>
        
        
        
        <?php
	$loopid++;	
    }
} else {
    echo "No Products in Quote";
} ?>
        </tbody>
</table>
<hr>
<div class="row">
    <div align="left" class=" col-xs-12 ">
        <div id="addDelButtons2">
          <input style="border-radius:10px" type="button" id="btnAdd2" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel2" value="Remove" class="btn btn-danger">
        </div> 
    </div>
        <input required  value="<?php echo ($loopid-1); ?>" id="qot_nos" class="form-control" type="hidden" name="qot_nos"  />
</div> 

<hr>




<div class="row">
	<div class="col-xs-6">
    <input type="hidden" name="fromquote" value="-" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_quote" value="Add Quote">
	</div>
</div>
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>



    <?php
}
if(isset($_POST['quotes_print_view'])){
		if(ctype_alnum($_POST['quotes_print_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_quotes
	left join sw_currency on qo_rel_cur_id = cur_id
	left join sw_clients on qo_rel_cli_id = cli_id
	 where md5(qo_id)= '".$_POST['quotes_print_view']."' and qo_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No Quote Found for this hash');
	}
	
	$login=1;
$_USER = array();
$_USER = make_user_ar($conn,$_SESSION['TICKET_LUM_DB_ID'],$login);


	?>
    
    
    <div class="row">
<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Extra Price <br> (Will be added to total)</th>
                    <th>Footer</th>
                    <th>Extra</th>
                    <th>Before Total</th>
                    <th>After Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT * FROM sw_quotes_gen where qog_rel_qo_id = ".$getqoid['qo_id'] ." order by qog_id desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$row['qog_discount'].'</td>
	   	<td>'.$row['qog_vat'].'%</td>
	   	<td>'.$row['qog_extra_price'].'</td>
	   	<td>'.$row['qog_footer'].'</td>
	   	<td>'.$row['qog_extra'].'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['qog_before_total'])).'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['qog_after_total'])).'</td>
		<td><a href="sw_quote_print.php?id='.md5($row['qog_id']).'"><button class="btn btn-md btn-info">View</button></a></td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

    </div>

<hr><br>    
    
<form action="master_action.php" method="post" enctype="multipart/form-data">
<h3>Generate New</h3>
<input type="hidden" name="add_quote_gen_hash" value="<?php echo md5($_POST['quotes_print_view']); ?>" />

<div class="col-xs-4">
    <div class="form-group">
        <label>Discount: </label>
        <input required  name="add_quote_gen_discount"  type="number" step="0.01" class="form-control" value="0" placeholder="10"/>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>VAT: </label>
        <input required  name="add_quote_gen_vat"  type="number" step="0.01" class="form-control" value="5" placeholder="5"/>
    </div>
</div>
<div class="col-xs-4">
    <div class="form-group">
        <label>Extra Price (Will be added to subtotal): </label>
        <input required  name="add_quote_extra_price"  type="number" step="0.01" class="form-control" value="0" placeholder="5"/>
    </div>
</div>
<textarea style="height:200px" name="add_quote_regards" required class="form-control hidden">
<b>Best Regards </b><br>
Tanweer Ahmad <br>
+9710504523770<br>
&nbsp;&nbsp;tanweer@stilewell.com
</textarea>
<div class="col-xs-6">
    <div class="form-group">
        <label>Regards: </label>
        <textarea style="height:200px" name="add_quote_regards2" required class="wysihtml54 form-control"><b>Best Regards </b><br><?php echo $_USER['usr_fname'].' '.$_USER['usr_lname']; ?><br><?php echo $_USER['tu_desc']; ?><br>Tel: +971-<?php echo $_USER['usr_contact_no']; ?><br>Email: <?php echo $_USER['lum_email']; ?></textarea>
    </div>
</div>
<div class="col-xs-6">
    <div class="form-group">
        <label>Address to be shown: </label>
        <textarea style="height:200px" name="add_quote_address" required class="wysihtml54 form-control"><?php echo $getqoid['cli_bill_addr'] ?></textarea>
    </div>
</div>
<div class="col-xs-6">
    <div class="form-group">
        <label>Extra(Before Quotation Starts): </label>
        <textarea style="height:500px" name="add_quote_gen_extra" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>

<div class="col-xs-6">
    <div class="form-group">
        <label>Footer(Before Quotation Starts): </label>
        <textarea style="height:500px" name="add_quote_gen_footer" required class="wysihtml54 form-control"><?php echo $stwl['termsandconditions'] ?></textarea>
    </div>
</div>



<div class="col-xs-12">
<div class="form-group">
	<label>Before Total Heads: </label>
</div>    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="quotegen1" class="threeclonedInput">
<td><input name="add_quote_gen_bf_head" type="text" class="form-control add_quote_gen_bf_head" id="add_quote_gen_bf_head" required value="-" placeholder="Advance 14%"  /></td>
<td><input name="add_quote_gen_bf_head_val" type="number" step="0.01" class="form-control add_quote_gen_bf_head_val" id="add_quote_gen_bf_head_val" required value="0" placeholder="10000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons3">
              <input style="border-radius:10px" type="button" id="btnAdd3" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel3" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="before_head_nos" class="form-control" type="hidden" name="before_head_nos"  />
    </div> 
    
    <hr>
    
</div>
    
<div class="col-xs-12">
<div class="form-group">
	<label>After Total Heads: </label>
</div>
    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="quotepen1" class="fourclonedInput">
<td><input name="add_quote_gen_af_head" type="text" class="form-control add_quote_gen_af_head" id="add_quote_gen_af_head" required value="-" placeholder="Excess Duty"  /></td>
<td><input name="add_quote_gen_af_head_val" type="text" class="form-control add_quote_gen_af_head_val" id="add_quote_gen_af_head_val" required value="-" placeholder="15000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons4">
              <input style="border-radius:10px" type="button" id="btnAdd4" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel4" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="after_head_nos" class="form-control" type="hidden" name="after_head_nos"  />
    </div> 
    
    <hr>
    
</div>
    
    
    <div class="row">
        <div class="col-xs-6">
            <input required  style="float:right" type="submit" class="btn btn-success" name="add_quote_gen" value="Generate Quote">
        </div>
        <div class="col-xs-6">
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
    
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml54").wysihtml5();
});
</script>
    <?php
}
/*---------------------------------------------*/
if(isset($_POST['proforma_detailed_view'])){
	if(ctype_alnum($_POST['proforma_detailed_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_proformas
	left join sw_currency on po_rel_cur_id = cur_id
	left join sw_clients on po_rel_cli_id = cli_id
	 where md5(po_id)= '".$_POST['proforma_detailed_view']."' and po_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No proforma Found for this hash');
	}
	?>
	<div class="row">
    <div class="col-xs-4">
        <p><div class="text-muted">Proforma Ref:</div><?php echo $getqoid['po_ref']; ?></p>
        <p><div class="text-muted">Date:</div><?php echo date('d-m-Y',$getqoid['po_dnt']); ?></p>
        <p><div class="text-muted">Currency:</div><?php echo $getqoid['cur_name']; ?></p>
    </div>
    <div class="col-xs-4">
        <p><div class="text-muted">Project:</div><?php echo $getqoid['po_proj_name']; ?></p>
        <p><div class="text-muted">Sub:</div><?php echo $getqoid['po_subj']; ?></p>
	    </div>
    
    <div class="col-xs-4">
        <p><div class="text-muted">Billing Address:</div><br><?php echo '<strong>'.$getqoid['cli_name'].'</strong><br>'.$getqoid['cli_bill_addr']; ?></p>
    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div  class="row">
                                        <hr>

                                    <table id="datatable_in" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <?php if($_SESSION['STWL_LUM_TU_ID'] ==1){ ?><th>Cost AED <br>per Unit</th><?php }?>                                                   <?php if($_SESSION['STWL_LUM_TU_ID'] ==1){ ?> <th>Markup</th><?php }?>
                                                    <th>Sale Price AED<br>per Unit </th>
                                                    <th>Qty</th>
                                                    <th>Total</th>
                                                    <th>-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_proformas_items` q 
left join sw_products_list p on q.pi_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.pi_rel_po_id =".$getqoid['po_id']."  and pi_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		$init = round(($boxrw['pi_qty'] * $boxrw['pi_price'] * $getqoid['po_cur_rate']),2);
		echo '
		<tr>
<td>'.$cc.'</td>
<td>'.$boxrw['pr_code'].'</td>
<td>'.$boxrw['pr_name'].'<br>
'.convert_desc($boxrw['pi_desc']).'</td>
'; if($_SESSION['STWL_LUM_TU_ID'] ==1){ echo '<td>AED '.$boxrw['pi_cost'].'</td>'; }echo'
'; if($_SESSION['STWL_LUM_TU_ID'] ==1){ echo '<td>'.round((($boxrw['pi_price']/$boxrw['pi_cost'])),3).'</td>'; }echo'
<td>AED '.$boxrw['pi_price'].'</td>
<td>'.$boxrw['pi_qty'].' '.$boxrw['prty_unit'].'</td>
<td>'.$getqoid['cur_name'].' '.number_format($init,2).'</td>
<td>'.($boxrw['prty_pr_hidden'] == '1' ? '<i style="color:red">This product will not be visible in the print view. <br> And total will not be added in the Sub-Total</i>' : '').'</td>

</tr>';
	$cc++;
	#first loop ends
	if($boxrw['prty_pr_hidden'] == '0'){
	$total = $total + ($init);
	}
    }
} else {
    echo "0 results";
}
 ?>                       

 						                          
                                            </tbody>
                                        </table>
                                        
                                        <?php 
							echo '<h4 align="right"> '.$getqoid['cur_name'].' '.number_format(($total),2).' </h4>'; 
							echo '<h4 align="right"> '.$getqoid['cur_name'].' '.strtoupper(convert_number_to_words(($total))).' </h4>'; 
							
							?>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
                                     </div>
                                </div>
                                <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_in').dataTable();
    } );
</script>
                                <?php
}
if(isset($_POST['proforma_edit'])){
	if(ctype_alnum($_POST['proforma_edit'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "
	select * from sw_proformas 
	left join sw_currency on po_rel_cur_id = cur_id 
	left join sw_clients on po_rel_cli_id = cli_id 
	where md5(po_revision_id)= '".$_POST['proforma_edit']."' and po_valid =1 order by po_revision desc  limit 1
	");
	if(is_array($getqoid)){
	}else{
		die('No proforma Found for this hash');
	}
	?>
<form action="master_action.php" method="post" enctype="multipart/form-data">
	<div class="row">
		<h5 align="center" style="color:red">All Data has been picked from the latest Proforma</h5>
<div class="col-xs-4">
<input type="hidden" name="add_revision_p_hash" value="<?php echo md5($getqoid['po_id']); ?>" />
            
            
    <p>
        <div class="text-muted">Currency:</div>
            <?php echo $getqoid['cur_name'] .'<br> Rate:'.$getqoid['po_cur_rate'] ?>
    </p>
</div>

<div class="col-xs-4">
    <p>
    	<div class="text-muted">Project:</div>
        <input type="text" class="form-control" name="add_revision_proforma_proj_name" value="<?php echo $getqoid['po_proj_name']; ?>" required />
    </p>
    
    <p>
        <div class="text-muted">Sub:</div>
        <input type="text" class="form-control" name="add_revision_proforma_subj" value="<?php echo $getqoid['po_subj']; ?>" required />
    </p>
    
</div>
    
<div class="col-xs-4">
	<p>
    	<div class="text-muted">Billing Address:</div>
        <br>Will Be Picked from the account of <?php echo  $getqoid['cli_code'].'-'.$getqoid['cli_name']; ?>
	</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div  class="row">
<hr>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th  style="width:25%">Product</th>
                <th style="width:30%">Product Desc</th>
                <th style="width:12%">Cost Price</th>
                <th style="width:12%">Sale Price</th>
                <th style="width:12%">Qty</th>
                <th style="width:9%"></th>
            </tr>
        </thead>
        <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_proformas_items` q 
left join sw_products_list p on q.pi_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.pi_rel_po_id =".$getqoid['po_id']."  and pi_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		
		#firts loop begins
		echo '


<tr>
	<td><select id="selold'.$cc.'" class="form-control " name="add_revision_proforma_product_already_'.$cc.'">';
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
 where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
 order by pr_code,pr_name asc";
 echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	   if($row['pr_id'] == $boxrw['pi_rel_pr_id']){
		   echo '<option data-id="'.$row['pr_id'].'" selected value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }else{
		   echo '<option data-id="'.$row['pr_id'].'"  value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }
	}
} else {
	echo "0 results";
}
echo '</select></td>
	
	
	<td>
	<textarea class=" form-control" name="add_revision_proforma_desc_already_'.$cc.'" id="rqda'.$cc.'">'.$boxrw['pi_desc'].'</textarea></td>
	<td><input id="rqca'.$cc.'" name="add_revision_proforma_cost_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['pi_cost'].'" /></td>
	<td><input name="add_revision_proforma_price_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['pi_price'].'" /></td>
	<td><input name="add_revision_proforma_qty_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['pi_qty'].'" />
	<input name="add_revision_proforma_sup_already_'.$cc.'"  type="hidden" required value="'.$boxrw['pi_rel_sup_id'].'" />
	</td>
	';
	?>
    
<script type="text/javascript">
$(document).ready(function() {
	$('#selold<?php echo $cc; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#rqda<?php echo $cc; ?>").val(result.desc);
					$("#rqca<?php echo $cc; ?>").val(result.cost);
				});
	} );
} );
		
		
</script>

	<td><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>
	<?php echo'
</tr>
';
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>
        <tr id="addrevpro1" class="PoFclonedInput">
            <td><select class="form-control add_revision_proforma_product_a" id="add_revision_proforma_product_a" name="add_revision_proforma_product_a">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
            <td><textarea name="add_revision_proforma_desc_a" class="form-control add_revision_proforma_desc_a" id="add_revision_proforma_desc_a" required>-</textarea></td>
            <td><input name="add_revision_proforma_cost_a"  type="number" step="0.01" class="form-control add_revision_proforma_cost_a" id="add_revision_proforma_cost_a" required value="0" placeholder="Cost Price"  /></td>
            <td><input name="add_revision_proforma_price_a"  type="number" step="0.01" class="form-control add_revision_proforma_price_a" id="add_revision_proforma_price_a" required value="0" placeholder="Sale Price"  /></td>
            <td><input name="add_revision_proforma_qty_a"  type="number" step="0.01" class="form-control add_revision_proforma_qty_a" id="add_revision_proforma_qty_a" required value="0" placeholder="Qty"  /></td>
            <td><div class="add_revision_proforma_script" id="add_revision_proforma_script"></div></td>

	    </tr>
        
        
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_revision_proforma_product_a').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_revision_proforma_desc_a").val(result.desc);
					$("#add_revision_proforma_cost_a").val(result.cost);
				});
	} );
} );
		
</script>
<div class="row">
    <div align="center" class=" col-xs-12 ">
        <div id="addDelButtons">
          <input style="border-radius:10px" type="button" id="btnAdd7" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel7" value="Remove" class="btn btn-danger">
        </div> 
    </div><br>

    <div class="col-xs-12">
    	<input align="" type="submit" class="btn btn-success" value="Revise" name="add_revision_proforma"  />
        <input required  value="1" id="pro_nos" class="form-control" type="hidden" name="pro_nos"  />

    </div>
</div> 
                                        
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
		</div>
	</div>
</div>
</form>


<?php /*
<script>
$(document).ready(function(){
		  $(".1wysihtml5").wysihtml5();
});
</script>

*/ ?>
<script type="text/javascript">
    $(document).ready(function() {
    } );
</script>
<script>
function myFunct(val) {
	if(val ==2){
		y = '';
	}else{
		y =(val-1);
	}
}

</script>



<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>

                                <?php
}
if(isset($_POST['add_proforma_warehouse'])){
	?>
     <form action="master_action.php" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label>Proforma Invoice Ref: </label>
	Auto Generated
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label>Currency: </label>
            <select class="form-control" name="add_proforma_currency" required>
                <?php
                $sql = "SELECT * FROM sw_currency";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if(trim($row['cur_id']) == 1){
                echo '<option selected value="'.md5($row['cur_id']).'">'.$row['cur_name'].'</option>';
                }else{
                echo '<option value="'.md5($row['cur_id']).'">'.$row['cur_name'].'</option>';
                }
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
    
            <label>Currency Rate: </label>
            <input required type="text" name="add_proforma_cur_rate" class="form-control" placeholder="Multiplied by AED" value="1"/>
        </div>
    </div>
</div>

<div class="form-group">
	<label>Client: </label>
    <select class="form-control" name="add_proforma_client" required>
    <option>Select Supplier</option>
    	<?php
		$sql = "SELECT * FROM sw_clients where cli_valid =1";
$result = $conn->query($sql);
?>
<option selected>Select Client</option>
 <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<option value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
    }
} else {
}
		?>
    </select>
</div>

<div class="form-group">
	<label>Project Name: </label>
	<input required  name="add_proforma_project_name" type="text" class="form-control"  value="-"/>
</div>

<div class="form-group">
	<label>Subject Name: </label>
	<input required  name="add_proforma_subject_name" type="text" class="form-control" value="-"/>
</div>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width:30%">Product</th>
                <th style="width:29%">Product Desc</th>
                <th style="width:10%">Cost Price</th>
                <th style="width:10%">Sale Price</th>
                <th style="width:10%">Qty</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
<tr id="proformaadd1" class="PerfclonedInput">
            <td><select class="form-control add_proforma_product" id="add_proforma_product" name="add_proforma_product">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
            <td><textarea name="add_proforma_product_desc" class="form-control add_proforma_product_desc" id="add_proforma_product_desc" required>-</textarea></td>
            <td><input name="add_proforma_product_cost"  type="number" step="0.01" class="form-control add_proforma_product_cost" id="add_proforma_product_cost" required value="0" placeholder="Cost Price"  /></td>
            <td><input name="add_proforma_product_price" type="text" class="form-control add_proforma_product_price" id="add_proforma_product_price" required value="0" placeholder="Sale Price"  /></td>
            <td><input name="add_proforma_product_qty" type="text" class="form-control add_proforma_product_qty" id="add_proforma_product_qty" required value="0" placeholder="Qty"  /></td>
            <td><div class="add_proforma_product_script" id="add_proforma_product_script"></div></td>

	    </tr>
        
        </tbody>
</table>
<hr>
<div class="row">
    <div align="left" class=" col-xs-12 ">
        <div id="addDelButtons6">
          <input style="border-radius:10px" type="button" id="btnAdd6" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel6" value="Remove" class="btn btn-danger">
        </div> 
    </div>
        <input required  value="1" id="per_nos" class="form-control" type="hidden" name="per_nos"  />
</div> 

<hr>




<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_proforma" value="Add proforma">
	</div>
</div>
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_proforma_product').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_proforma_product_desc").val(result.desc);
					$("#add_proforma_product_cost").val(result.cost);
				});
	} );
} );
		
</script>
    <?php
}
if(isset($_POST['add_proforma_quotation'])){
	?>
<div class="form-group">
	<label>Proforma Invoice Ref: </label>
	Auto Generated
</div>
<table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Ref</th>
                <th>Client Code</th>
                <th>Client</th>
                <th>Currency</th>
                <th>Items</th>
                <th>Dated</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php 
$sql = "SELECT * FROM sw_quotes 
where qo_revision =0 and qo_valid=1 order by qo_ref desc ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	$wkjrrngiuergn =1;
	while($row = $result->fetch_assoc()) {
		   $getmax = getdatafromsql($conn,"select * from sw_quotes left join sw_clients on qo_rel_cli_id = cli_id 
left join sw_currency on qo_rel_cur_id = cur_id
 where qo_valid =1 and qo_revision_id = '".$row['qo_id']."' order by qo_revision desc limit 1 ");
		   if(!is_array($getmax)){
			   die('Non Expected error');
		   }
		   $checkdupe = getdatafromsql($conn,"select * from sw_proformas left join sw_quotes on po_rel_qo_id = qo_id where 
		   qo_revision_id = ".$row['qo_id']." and qo_valid = 1 and  po_valid =1");
		   if(!is_array($checkdupe)){
			   ?>
           <tr>
               <td><?php echo $wkjrrngiuergn; ?></td>        
            <td><?php echo $getmax['qo_ref']; ?></td>
            <td><?php echo $getmax['cli_code']; ?></td>
            <td><?php echo $getmax['cli_name']; ?></td>
            <td><?php echo $getmax['cur_name']; ?></td>
            <td><?php 
			$geti = getdatafromsql($conn,"select count(*) as quu from sw_quotes_items where qi_rel_qo_id = ".$getmax['qo_id']." and qi_valid =1");
			
if(is_array($geti)){
	echo $geti['quu'];
}else{
	echo 'No Items Added';
}

			 ?></td>
            <td><?php echo date('j/n/Y',$getmax['qo_dnt']); ?></td>
            <td>
			<form action="master_action.php" method="post"><input type="hidden" name="add_proforma_quotation_hash" value="<?php echo md5($getmax['qo_id']); ?>" /><input type="submit" class="btn btn-success" name="add_proforma_quotation" value="Generate" /></form>
			</td>


           </tr>   <?php
	$wkjrrngiuergn++;	   
                       
		   }
		   ?>
           

           <?php
		   
	}
} else {
	echo "0 results";
}
?>
        
        </tbody>
</table>
<hr>


<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
} );
		
</script>
    <?php
}
if(isset($_POST['add_proforma_proforma'])){
		if(is_string($_POST['add_proforma_proforma'])){
	}else{
		die('Proforma Invalid');
	}
	
$getprof = getdatafromsql($conn,"select * from sw_proformas where po_ref = '".strtoupper($_POST['add_proforma_proforma'])."' and po_valid = 1");
if(is_array($getprof)){
}else{
	die('Proforma Not Found in Database');
}
	?>
     <form action="master_action.php" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label>Proforma Invoice Ref: </label>
	Auto Generated
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label>Currency: </label>
            <select class="form-control" name="add_proforma_currency" required>
                <?php
                $sql = "SELECT * FROM sw_currency";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if(trim($row['cur_id']) == $getprof['po_rel_cur_id']){
                echo '<option selected value="'.md5($row['cur_id']).'">'.$row['cur_name'].'</option>';
                }else{
                echo '<option value="'.md5($row['cur_id']).'">'.$row['cur_name'].'</option>';
                }
            }
        } else {
        }
                ?>
            </select>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
    
            <label>Currency Rate: </label>
            <input required type="text" name="add_proforma_cur_rate" class="form-control" placeholder="Multiplied by AED" value="<?php echo $getprof['po_cur_rate'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
	<label>Client: </label>
    <select class="form-control" name="add_proforma_client" required>
    <option>Select Supplier</option>
    	<?php
		$sql = "SELECT * FROM sw_clients where cli_valid =1";
$result = $conn->query($sql);
?>
<option selected>Select Client</option>
 <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
if($row['cli_id'] == $getprof['po_rel_cli_id']){
	echo '<option selected value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
}else{
	echo '<option value="'.md5($row['cli_id']).'">'.$row['cli_code'].'-'.$row['cli_name'].'</option>';
}
    }
} else {
}
		?>
    </select>
</div>

<div class="form-group">
	<label>Project Name: </label>
	<input required  name="add_proforma_project_name" type="text" value="<?php echo $getprof['po_proj_name'] ?>" class="form-control" placeholder="---"/>
</div>

<div class="form-group">
	<label>Subject Name: </label>
	<input required  name="add_proforma_subject_name" type="text" value="<?php echo $getprof['po_subj'] ?>" class="form-control" placeholder="---"/>
</div>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Product Desc</th>
                <th>Cost Price</th>
                <th>Sale Price</th>
                <th>Qty</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 

$getprod = "SELECT * from sw_proformas_items where pi_rel_po_id = ".$getprof['po_id']." and pi_valid =1";
$getprod = $conn->query($getprod);

if ($getprod->num_rows > 0) {
    // output data of each row
	$loopid =1 ;
    while($getprodrow = $getprod->fetch_assoc()) {

if($loopid == '1'){
	$num = '';
}else{
	$num = $loopid;
}
 ?>

<tr id="proformaadd<?php echo $loopid; ?>" class="PerfclonedInput">
            <td><select class="form-control add_proforma_product" id="add_proforma_product<?php echo $num; ?>" name="add_proforma_product<?php echo $num; ?>">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
if($row['pr_id'] == $getprodrow['pi_rel_pr_id']){
echo '<option selected  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
}else{
echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
}
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
<td><textarea name="add_proforma_product_desc<?php echo $num; ?>" class="form-control add_proforma_product_desc" id="add_proforma_product_desc<?php echo $num; ?>" required><?php echo $getprodrow['pi_desc']; ?></textarea></td>
<td><input name="add_proforma_product_cost<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_proforma_product_cost" id="add_proforma_product_cost<?php echo $num; ?>" required value="<?php echo $getprodrow['pi_cost']; ?>" placeholder="Cost Price"  /></td>
<td><input name="add_proforma_product_price<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_proforma_product_price" id="add_proforma_product_price<?php echo $num; ?>" required value="<?php echo $getprodrow['pi_price']; ?>" placeholder="Sale Price"  /></td>
<td><input name="add_proforma_product_qty<?php echo $num; ?>"  type="number" step="0.01" class="form-control add_proforma_product_qty" id="add_proforma_product_qty<?php echo $num; ?>" required value="<?php echo $getprodrow['pi_qty']; ?>" placeholder="Qty"  /></td>
<td><div class="add_proforma_product_script" id="add_proforma_product_script<?php echo $num; ?>">

<script type="text/javascript">
$(document).ready(function() {
	$('#add_proforma_product<?php echo $num; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_proforma_product_desc<?php echo $num; ?>").val(result.desc);
					$("#add_proforma_product_cost<?php echo $num; ?>").val(result.cost);
				});
	} );
} );
		
</script>
</div>
<button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>

	    </tr>
        
        
        
        <?php
	$loopid++;	
    }
} else {
    echo "No Products in Prof";
} ?>
        </tbody>
</table>
<hr>
<div class="row">
    <div align="left" class=" col-xs-12 ">
        <div id="addDelButtons6">
          <input style="border-radius:10px" type="button" id="btnAdd6" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel6" value="Remove" class="btn btn-danger">
        </div> 
    </div>
        <input required  value="<?php echo ($loopid-1); ?>" id="per_nos" class="form-control" type="hidden" name="per_nos"  />
</div> 

<hr>




<div class="row">
	<div class="col-xs-6">
		<input required  style="float:right" type="submit" class="btn btn-success" name="add_proforma" value="Add proforma">
	</div>
</div>
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_proforma_product').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_proforma_product_desc").val(result.desc);
					$("#add_proforma_product_cost").val(result.cost);
				});
	} );
} );
		
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
} );
		
</script>
<?php
}
if(isset($_POST['edit_proforma_supplier'])){
		if(is_string($_POST['edit_proforma_supplier'])){
	}else{
		die('Proforma Invalid');
	}
$getprof = getdatafromsql($conn,"select * from sw_proformas where md5(po_revision_id) = '".$_POST['edit_proforma_supplier']."' and po_valid = 1 order by po_revision desc limit 1");
if(is_array($getprof)){
}else{
	die('Proforma Not Found in Database');
}
	?>
     <form action="master_action.php" method="post">

<?php 
echo 'Editing Suppliers for items in Proforma Ref: '.$getprof['po_ref'];
?>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Cost Price</th>
                <th>Sale Price</th>
                <th>Qty</th>
                <th>Current Supplier</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
        <?php 

$getprod = "SELECT * from sw_proformas_items 
left join sw_products_list on pi_rel_pr_id = pr_id
left join sw_prod_types on pr_rel_prty_id = prty_id
left join sw_suppliers on pi_rel_sup_id = sup_id
where pi_rel_po_id = ".$getprof['po_id']." and pr_valid =1 and pi_valid =1";
$getprod = $conn->query($getprod);

if ($getprod->num_rows > 0) {
    // output data of each row
	$loopid =1 ;
    while($getprodrow = $getprod->fetch_assoc()) {

if($loopid == '1'){
	$num = '';
}else{
	$num = $loopid;
}
 ?>
<tr>
	<td><?php echo $getprodrow['pr_name']; ?><br><?php echo convert_desc($getprodrow['pi_desc']); ?></td>
    <td><?php echo $getprodrow['pi_cost']; ?></td>
    <td><?php echo $getprodrow['pi_price']; ?></td>
    <td><?php echo $getprodrow['pi_qty']; ?> <?php echo $getprodrow['prty_unit'] ?></td>
    <td><?php echo $getprodrow['sup_name']; ?></td>
    <?php
	#($getprodrow['pr_id'] == '150') or ($getprodrow['pr_id'] == '151') or ($getprodrow['pr_id'] == '153') or ($getprodrow['pr_id'] == '154')
	 if(1==1){ ?>
        <td>
        <select name="change_proformaitem_supplier_<?php echo $getprodrow['pi_id']; ?>" class="form-control">
        	<option selected value="1.1">Select Supplier to Change</option>
            <?php
$supfsql = "SELECT * FROM sw_suppliers where sup_valid = 1";
$supfsql = $conn->query($supfsql);

if ($supfsql->num_rows > 0) {
    // output data of each row
    while($supfsqlrw = $supfsql->fetch_assoc()) {
		?>
        <option value="<?php echo $supfsqlrw['sup_id'];  ?>"><?php echo $supfsqlrw['sup_name'];  ?></option>
        <?php
    }
} else {
} 
			?>
        </select>
        </td>
    <?php }else{?>
        <td></td>
    <?php } ?>
</tr>
        <?php
	$loopid++;	
    }
} else {
    echo "No Products in Prof";
} ?>
        </tbody>
</table>
<hr>

<div class="row">
	<div class="col-xs-6">
    	<input type="hidden" name="edit_profrma_hash" value="<?php echo md5($getprof['po_id']); ?>" />
		<input required  style="float:right" type="submit" class="btn btn-success" name="edit_proforma_supplier" value="Edit Item Supplier">
	</div>
</div>
	</form>
<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
} );
		
</script>
<?php
}
if(isset($_POST['proformas_print_view'])){
		if(ctype_alnum($_POST['proformas_print_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_proformas
	left join sw_currency on po_rel_cur_id = cur_id
	left join sw_clients on po_rel_cli_id = cli_id
	 where md5(po_id)= '".$_POST['proformas_print_view']."' and po_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No proforma Found for this hash');
	}

$login=1;
$_USER = array();
$_USER = make_user_ar($conn,$_SESSION['TICKET_LUM_DB_ID'],$login);

	?>
    
    
    <div class="row">
<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Extra Price <br>(Will be added to total)</th>
                    <th>Footer</th>
                    <th>Extra</th>
                    <th>Before Total</th>
                    <th>After Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT * FROM sw_proformas_gen where pog_rel_po_id = ".$getqoid['po_id'] ." order by pog_id desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$row['pog_discount'].'</td>
	   	<td>'.$row['pog_vat'].'%</td>
	   	<td>'.$row['pog_extra_price'].'</td>
	   	<td>'.$row['pog_footer'].'</td>
	   	<td>'.$row['pog_extra'].'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['pog_before_total'])).'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['pog_after_total'])).'</td>
		<td><a href="sw_proforma_print.php?id='.md5($row['pog_id']).'"><button class="btn btn-md btn-info">View</button></a></td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

    </div>

<hr><br>    
    
<form action="master_action.php" method="post" enctype="multipart/form-data">
<h3>Generate New</h3>
<input type="hidden" name="add_proforma_gen_hash" value="<?php echo md5($_POST['proformas_print_view']); ?>" />

<div class="col-xs-2">
    <div class="form-group">
        <label>Discount: </label>
        <input required  name="add_proforma_gen_discount"  type="number" step="0.01" class="form-control" value="0" placeholder="10"/>
    </div>
</div>

<div class="col-xs-2">
    <div class="form-group">
        <label>VAT: </label>
        <input required  name="add_proforma_gen_vat"  type="number" step="0.01" class="form-control" value="5" placeholder="5"/>
    </div>
</div>
<div class="col-xs-2">
    <div class="form-group">
        <label>Extra Price (Will be added to subtotal): </label>
        <input required  name="add_proforma_extra_price"  type="number" step="0.01" class="form-control" value="0" placeholder="5"/>
    </div>
</div>
<div class="col-xs-3">
    <div class="form-group">
        <label>LPO Reference:</label>
        <input required  name="add_proforma_gen_lpo" type="text" class="form-control" placeholder="35488"/>
    </div>
</div>
<div class="col-xs-3">
    <div class="form-group">
        <label>Payment Terms: </label>
        <input required  name="add_proforma_gen_payment_t" type="text" class="form-control" value="<?php echo $getqoid['cli_pay_terms'] ?>" placeholder="5"/>
    </div>
</div>
<div class="col-xs-4">
    <div class="form-group">
        <label>Address to be shown: </label>
        <textarea style="height:200px" name="add_proforma_address" required class="wysihtml54 form-control"><?php echo $getqoid['cli_bill_addr'] ?></textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Extra(Before Proforma Starts): </label>
        <textarea style="height:200px" name="add_proforma_gen_extra" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Footer(After Proforma ends): </label>
        <textarea style="height:200px" name="add_proforma_gen_footer" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>



<div class="col-xs-12">
<div class="form-group">
	<label>Before Total Heads: </label>
</div>    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="proformagen1" class="eleclonedInput">
<td><input name="add_proforma_gen_bf_head" type="text" class="form-control add_proforma_gen_bf_head" id="add_proforma_gen_bf_head" required value="-" placeholder="Advance 14%"  /></td>
<td><input name="add_proforma_gen_bf_head_val" type="number" step="0.01" class="form-control add_proforma_gen_bf_head_val" id="add_proforma_gen_bf_head_val" required value="0" placeholder="10000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons11">
              <input style="border-radius:10px" type="button" id="btnAdd11" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel11" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="before_head_pro_nos" class="form-control" type="hidden" name="before_head_pro_nos"  />
    </div> 
    
    <hr>
    
</div>
    
<div class="col-xs-12">
<div class="form-group">
	<label>After Total Heads: </label>
</div>
    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="proformapen1" class="tenclonedInput">
<td><input name="add_proforma_gen_af_head" type="text" class="form-control add_proforma_gen_af_head" id="add_proforma_gen_af_head" required value="-" placeholder="Excess Duty"  /></td>
<td><input name="add_proforma_gen_af_head_val" type="text" class="form-control add_proforma_gen_af_head_val" id="add_proforma_gen_af_head_val" required value="-" placeholder="15000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons10">
              <input style="border-radius:10px" type="button" id="btnAdd10" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel10" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="after_head_pro_nos" class="form-control" type="hidden" name="after_head_pro_nos"  />
    </div> 
    
    <hr>
    
</div>
    
    
    <div class="row">
        <div class="col-xs-6">
            <input required  style="float:right" type="submit" class="btn btn-success" name="add_proforma_gen" value="Generate Proforma">
        </div>
        <div class="col-xs-6">
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
    
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml54").wysihtml5();
});
</script>
    <?php
}
/*-----------------------------------------------*/
if(isset($_POST['salesinvoice_detailed_view'])){
	if(ctype_alnum($_POST['salesinvoice_detailed_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_salesinvoices
	left join sw_currency on so_rel_cur_id = cur_id
	left join sw_clients on so_rel_cli_id = cli_id
	 where md5(so_id)= '".$_POST['salesinvoice_detailed_view']."' and so_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No salesinvoice Found for this hash');
	}
	?>
	<div class="row">
    <div class="col-xs-4">
        <p><div class="text-muted">Salesinvoice Ref:</div><?php echo $getqoid['so_ref']; ?></p>
        <p><div class="text-muted">Date:</div><?php echo date('d-m-Y',$getqoid['so_dnt']); ?></p>
        <p><div class="text-muted">Currency:</div><?php echo $getqoid['cur_name']; ?></p>
    </div>
    <div class="col-xs-4">
        <p><div class="text-muted">Project:</div><?php echo $getqoid['so_proj_name']; ?></p>
        <p><div class="text-muted">Sub:</div><?php echo $getqoid['so_subj']; ?></p>
	    </div>
    
    <div class="col-xs-4">
        <p><div class="text-muted">Billing Address:</div><br><?php echo '<strong>'.$getqoid['cli_name'].'</strong><br>'.$getqoid['cli_bill_addr']; ?></p>
    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div  class="row">
                                        <hr>

                                    <table id="datatable_in" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                   <?php if($_SESSION['STWL_LUM_TU_ID'] ==1){ ?> <th>Cost AED <br>per Unit</th><?php }?>
												   <?php if($_SESSION['STWL_LUM_TU_ID'] ==1){ ?> <th>Markup</th><?php }?>
                                                    <th>Sale Price AED<br>per Unit </th>
                                                    <th>Qty</th>
                                                    <th>Total</th>
                                                    <th>-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_salesinvoices_items` q 
left join sw_products_list p on q.si_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.si_rel_so_id =".$getqoid['so_id']."  and si_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		$init = round(($boxrw['si_qty'] * $boxrw['si_price'] * $getqoid['so_cur_rate']),2);
		echo '
		<tr>
		<td>'.$cc.'</td>
<td>'.$boxrw['pr_code'].'</td>
<td>'.$boxrw['pr_name'].'
<br>'.convert_desc($boxrw['si_desc']).'</td>
'; if($_SESSION['STWL_LUM_TU_ID'] ==1){ echo '<td>AED '.$boxrw['si_cost'].'</td>'; }echo'
'; if($_SESSION['STWL_LUM_TU_ID'] ==1){ echo '<td>'.round((($boxrw['si_price']/$boxrw['si_cost'])),3).'</td>'; }echo'
<td>AED '.$boxrw['si_price'].'</td>
<td>'.$boxrw['si_qty'].' '.$boxrw['prty_unit'].'</td>
<td>'.$getqoid['cur_name'].' '.number_format($init,2).'</td>
<td>'.($boxrw['prty_pr_hidden'] == '1' ? '<i style="color:red">This product will not be visible in the print view. <br> And total will not be added in the Sub-Total</i>' : '').'</td>

</tr>';
	$cc++;
	#first loop ends
	if($boxrw['prty_pr_hidden'] == '0'){
	$total = $total + ($init);
	}
    }
} else {
    echo "0 results";
}
 ?>                       

 						                          
                                            </tbody>
                                        </table>
                                        
                                        <?php 
							echo '<h4 align="right">'.$getqoid['cur_name'].' '.number_format(($total),2).'</h4>'; 
							echo '<h4 align="right">'.$getqoid['cur_name'].' '.strtoupper(convert_number_to_words(($total))).' </h4>'; 
							
							?>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
                                     </div>
                                </div>
                                <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_in').dataTable();
    } );
</script>
                                <?php
}
if(isset($_POST['salesinvoice_edit'])){
	if(ctype_alnum($_POST['salesinvoice_edit'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "
	select * from sw_salesinvoices 
	left join sw_currency on so_rel_cur_id = cur_id 
	left join sw_clients on so_rel_cli_id = cli_id 
	where md5(so_revision_id)= '".$_POST['salesinvoice_edit']."' and so_valid =1 order by so_revision desc  limit 1
	");
	if(is_array($getqoid)){
	}else{
		die('No salesinvoice Found for this hash');
	}
	?>
<form action="master_action.php" method="post" enctype="multipart/form-data">
	<div class="row">
		<h5 align="center" style="color:red">All Data has been picked from the latest Sales Invoice</h5>
<div class="col-xs-4">
<input type="hidden" name="add_revision_s_hash" value="<?php echo md5($getqoid['so_id']); ?>" />
            
            
    <p>
        <div class="text-muted">Currency:</div>
            <?php echo $getqoid['cur_name'] .'<br> Rate:'.$getqoid['so_cur_rate'] ?>
    </p>
</div>

<div class="col-xs-4">
    <p>
    	<div class="text-muted">Project:</div>
        <input type="text" class="form-control" name="add_revision_salesinvoice_proj_name" value="<?php echo $getqoid['so_proj_name']; ?>" required />
    </p>
    
    <p>
        <div class="text-muted">Sub:</div>
        <input type="text" class="form-control" name="add_revision_salesinvoice_subj" value="<?php echo $getqoid['so_subj']; ?>" required />
    </p>
    
</div>
    
<div class="col-xs-4">
	<p>
    	<div class="text-muted">Billing Address:</div>
        <br>Will Be Picked from the account of <?php echo  $getqoid['cli_code'].'-'.$getqoid['cli_name']; ?>
	</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div  class="row">
<hr>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th  style="width:25%">Product</th>
                <th style="width:30%">Product Desc</th>
                <th style="width:12%">Cost Price</th>
                <th style="width:12%">Sale Price</th>
                <th style="width:12%">Qty</th>
                <th style="width:9%"></th>
            </tr>
        </thead>
        <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_salesinvoices_items` q 
left join sw_products_list p on q.si_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.si_rel_so_id =".$getqoid['so_id']."  and si_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		
		#firts loop begins
		echo '


<tr>
	<td><select id="selold'.$cc.'" class="form-control " name="add_revision_salesinvoice_product_already_'.$cc.'">';
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
 where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
 order by pr_code,pr_name asc";
 echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	   if($row['pr_id'] == $boxrw['si_rel_pr_id']){
		   echo '<option data-id="'.$row['pr_id'].'" selected value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }else{
		   echo '<option data-id="'.$row['pr_id'].'"  value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }
	}
} else {
	echo "0 results";
}
echo '</select></td>
	
	
	<td>
	<textarea class=" form-control" name="add_revision_salesinvoice_desc_already_'.$cc.'" id="rqda'.$cc.'">'.$boxrw['si_desc'].'</textarea></td>
	<td><input id="rqca'.$cc.'" name="add_revision_salesinvoice_cost_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['si_cost'].'" /></td>
	<td><input name="add_revision_salesinvoice_price_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['si_price'].'" /></td>
	<td><input name="add_revision_salesinvoice_qty_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['si_qty'].'" /></td>
	';
	?>
    
<script type="text/javascript">
$(document).ready(function() {
	$('#selold<?php echo $cc; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#rqda<?php echo $cc; ?>").val(result.desc);
					$("#rqca<?php echo $cc; ?>").val(result.cost);
				});
	} );
} );
		
		
</script>

	<td><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>
	<?php echo'
</tr>
';
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>
        <tr id="addrevsi1" class="SoclonedInput">
            <td><select class="form-control add_revision_salesinvoice_product_a" id="add_revision_salesinvoice_product_a" name="add_revision_salesinvoice_product_a">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
            <td><textarea name="add_revision_salesinvoice_desc_a" class="form-control add_revision_salesinvoice_desc_a" id="add_revision_salesinvoice_desc_a" required>-</textarea></td>
            <td><input name="add_revision_salesinvoice_cost_a"  type="number" step="0.01" class="form-control add_revision_salesinvoice_cost_a" id="add_revision_salesinvoice_cost_a" required value="0" placeholder="Cost Price"  /></td>
            <td><input name="add_revision_salesinvoice_price_a"  type="number" step="0.01" class="form-control add_revision_salesinvoice_price_a" id="add_revision_salesinvoice_price_a" required value="0" placeholder="Sale Price"  /></td>
            <td><input name="add_revision_salesinvoice_qty_a"  type="number" step="0.01" class="form-control add_revision_salesinvoice_qty_a" id="add_revision_salesinvoice_qty_a" required value="0" placeholder="Qty"  /></td>
            <td><div class="add_revision_salesinvoice_script" id="add_revision_salesinvoice_script"></div></td>

	    </tr>
        
        
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_revision_salesinvoice_product_a').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_revision_salesinvoice_desc_a").val(result.desc);
					$("#add_revision_salesinvoice_cost_a").val(result.cost);
				});
	} );
} );
		
</script>
<div class="row">
    <div align="center" class=" col-xs-12 ">
        <div id="addDelButtons13">
          <input style="border-radius:10px" type="button" id="btnAdd13" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel13" value="Remove" class="btn btn-danger">
        </div> 
    </div><br>

    <div class="col-xs-12">
    	<input align="" type="submit" class="btn btn-success" value="Revise" name="add_revision_salesinvoice"  />
        <input required  value="1" id="si_nos" class="form-control" type="hidden" name="si_nos"  />

    </div>
</div> 
                                        
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
		</div>
	</div>
</div>
</form>


<?php /*
<script>
$(document).ready(function(){
		  $(".1wysihtml5").wysihtml5();
});
</script>

*/ ?>
<script type="text/javascript">
    $(document).ready(function() {
    } );
</script>
<script>
function myFunct(val) {
	if(val ==2){
		y = '';
	}else{
		y =(val-1);
	}
}

</script>



<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>

                                <?php
}
if(isset($_POST['salesinvoice_edit_date'])){
	if(ctype_alnum($_POST['salesinvoice_edit_date'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "
	select * from sw_salesinvoices 
	left join sw_currency on so_rel_cur_id = cur_id 
	left join sw_clients on so_rel_cli_id = cli_id 
	where md5(so_revision_id)= '".$_POST['salesinvoice_edit_date']."' and so_valid =1 order by so_revision desc  limit 1
	");
	if(is_array($getqoid)){
	}else{
		die('No salesinvoice Found for this hash');
	}
	?>
<form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-xs-4">
        <p>  New Due Date:
        <input type="text" class="form-control" name="edit_salei_date_d" value="" placeholder="dd-mm-yyyy" required />
        </p>
        <br>
        <input type="hidden" value="<?php echo $_POST['salesinvoice_edit_date'] ;?>" name="edit_salei_date_d_hash" />
        <input type="submit" class="btn btn-success" value="Edit Date" name="edit_salei_date" />
    </div>
</div>
</form>


<?php /*
<script>
$(document).ready(function(){
		  $(".1wysihtml5").wysihtml5();
});
</script>

*/ ?>
<script type="text/javascript">
    $(document).ready(function() {
    } );
</script>
<script>
function myFunct(val) {
	if(val ==2){
		y = '';
	}else{
		y =(val-1);
	}
}

</script>



<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>

                                <?php
}
if(isset($_POST['add_salesinvoice_proforma'])){
	?>
<div class="form-group">
	<label>Salesinvoice Invoice Ref: </label>
	Auto Generated
</div>
<table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Ref</th>
                <th>Client Code</th>
                <th>Client</th>
                <th>Currency</th>
                <th>Items</th>
                <th>Dated</th>
                <th>Payment<br>Due Date <br>Default = +2 Days</th>
            </tr>
        </thead>
        <tbody>
<?php 
$sql = "SELECT * FROM sw_proformas 
where po_revision =0 and po_valid=1 order by po_ref desc ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	$wjen = 1;
	while($row = $result->fetch_assoc()) {
		   $getmax = getdatafromsql($conn,"select * from sw_proformas left join sw_clients on po_rel_cli_id = cli_id 
left join sw_currency on po_rel_cur_id = cur_id
 where po_valid =1 and po_revision_id = '".$row['po_id']."' order by po_revision desc limit 1 ");
		   if(!is_array($getmax)){
			   die('Non Expected error');
		   }
		   $checkdupe = getdatafromsql($conn,"select * from sw_salesinvoices left join sw_proformas on so_rel_po_id = po_id
		   where po_revision_id = ".$row['po_id']." and so_valid =1");
		   if(!is_array($checkdupe)){
			   ?>
           
           <tr>
                       
            <td><?php echo $wjen; ?></td>
            <td><?php echo $getmax['po_ref']; ?></td>
            <td><?php echo $getmax['cli_code']; ?></td>
            <td><?php echo $getmax['cli_name']; ?></td>
            <td><?php echo $getmax['cur_name']; ?></td>
            <td><?php 
			$geti = getdatafromsql($conn,"select count(*) as quu from sw_proformas_items where pi_rel_po_id = ".$getmax['po_id']." and pi_valid =1");
			
if(is_array($geti)){
	echo $geti['quu'];
}else{
	echo 'No Items Added';
}

			 ?></td>
            <td><?php echo date('j/n/Y',$getmax['po_dnt']); ?></td>
            <td>
            <form action="master_action.php" method="post"><input type="hidden" name="add_salesinvoice_proforma_hash" value="<?php echo md5($getmax['po_id']); ?>" />      
<input class="form-control" name="add_sales_due_date" placeholder="dd-mm-yyyy" value="<?php echo date('d',(time() +172800)); ?>-<?php echo date('m',time() +172800); ?>-<?php echo date('Y',time() +172800); ?>" />
            
<input type="submit" class="btn btn-success" name="add_salesinvoice_proforma" value="Generate" />
            </form>
             </td>
            
           


           </tr>
                          <?php
						  $wjen++;
		   }
		   ?>
           

           <?php
		   
		   
	}
} else {
	echo "0 results";
}
?>
        
        </tbody>
</table>
<hr>


<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
} );
		
</script>
    <?php
}
if(isset($_POST['salesinvoices_print_view'])){
		if(ctype_alnum($_POST['salesinvoices_print_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_salesinvoices
	left join sw_currency on so_rel_cur_id = cur_id
	left join sw_clients on so_rel_cli_id = cli_id
	 where md5(so_id)= '".$_POST['salesinvoices_print_view']."' and so_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No salesinvoice Found for this hash');
	}

$login=1;
$_USER = array();
$_USER = make_user_ar($conn,$_SESSION['TICKET_LUM_DB_ID'],$login);

	?>
    
    
    <div class="row">
<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Extra Price <br>(Will be added to total)</th>
                    <th>Footer</th>
                    <th>Extra</th>
                    <th>Before Total</th>
                    <th>After Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT * FROM sw_salesinvoices_gen where sog_rel_so_id = ".$getqoid['so_id']." order by sog_id desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$row['sog_discount'].'</td>
	   	<td>'.$row['sog_vat'].'%</td>
	   	<td>'.$row['sog_extra_price'].'</td>
	   	<td>'.$row['sog_footer'].'</td>
	   	<td>'.$row['sog_extra'].'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['sog_before_total'])).'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['sog_after_total'])).'</td>
		<td><a href="sw_salesinvoice_print.php?id='.md5($row['sog_id']).'"><button class="btn btn-md btn-info">View</button></a></td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

    </div>

<hr><br>    
 <?php
 if($_SESSION['STWL_LUM_TU_ID'] !==3){ ?>   
<form action="master_action.php" method="post" enctype="multipart/form-data">
<h3>Generate New</h3>
<input type="hidden" name="add_salesinvoice_gen_hash" value="<?php echo md5($_POST['salesinvoices_print_view']); ?>" />

<div class="col-xs-2">
    <div class="form-group">
        <label>Discount: </label>
        <input required  name="add_salesinvoice_gen_discount"  type="number" step="0.01" class="form-control" value="0" placeholder="10" />
    </div>
</div>

<div class="col-xs-2">
    <div class="form-group">
        <label>VAT: </label>
        <input required  name="add_salesinvoice_gen_vat"  type="number" step="0.01" class="form-control" value="5" placeholder="5"/>
    </div>
</div>
<div class="col-xs-2">
    <div class="form-group">
        <label>Extra Price (Will be added to subtotal): </label>
        <input required  name="add_salesinvoice_extra_price"  type="number" step="0.01" class="form-control" value="0" placeholder="5"/>
    </div>
</div>
<div class="col-xs-3">
    <div class="form-group">
        <label>LPO Reference:</label>
        <input required  name="add_salesinvoice_gen_lpo" type="text" class="form-control" placeholder="35488"/>
    </div>
</div>
<div class="col-xs-3">
    <div class="form-group">
        <label>Payment Terms: </label>
        <input required  name="add_salesinvoice_gen_payment_t" type="text" class="form-control" value="<?php echo $getqoid['cli_pay_terms'] ?>" placeholder="5"/>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Address to be shown: </label>
        <textarea style="height:200px" name="add_salesinvoice_address" required class="wysihtml54 form-control"><?php echo $getqoid['cli_bill_addr'] ?></textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Extra(Before salesinvoice Starts): </label>
        <textarea style="height:200px" name="add_salesinvoice_gen_extra" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Footer(After salesinvoice ends): </label>
        <textarea style="height:200px" name="add_salesinvoice_gen_footer" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>



<div class="col-xs-12">
<div class="form-group">
	<label>Before Total Heads: </label>
</div>    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="salesinvoicegen1" class="fteclonedInput">
<td><input name="add_salesinvoice_gen_bf_head" type="text" class="form-control add_salesinvoice_gen_bf_head" id="add_salesinvoice_gen_bf_head" required value="-" placeholder="Advance 14%"  /></td>
<td><input name="add_salesinvoice_gen_bf_head_val"  type="number" step="0.01" class="form-control add_salesinvoice_gen_bf_head_val" id="add_salesinvoice_gen_bf_head_val" required value="0" placeholder="10000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons11">
              <input style="border-radius:10px" type="button" id="btnAdd14" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel14" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="before_head_si_nos" class="form-control" type="hidden" name="before_head_si_nos"  />
    </div> 
    
    <hr>
    
</div>
    
<div class="col-xs-12">
<div class="form-group">
	<label>After Total Heads: </label>
</div>
    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="salesinvoicepen1" class="ffteclonedInput">
<td><input name="add_salesinvoice_gen_af_head" type="text" class="form-control add_salesinvoice_gen_af_head" id="add_salesinvoice_gen_af_head" required value="-" placeholder="Excess Duty"  /></td>
<td><input name="add_salesinvoice_gen_af_head_val"  type="number" step="0.01" class="form-control add_salesinvoice_gen_af_head_val" id="add_salesinvoice_gen_af_head_val" required value="0" placeholder="15000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons10">
              <input style="border-radius:10px" type="button" id="btnAdd15" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel15" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="after_head_si_nos" class="form-control" type="hidden" name="after_head_si_nos"  />
    </div> 
    
    <hr>
    
</div>
    
    
    <div class="row">
        <div class="col-xs-6">
            <input required  style="float:right" type="submit" class="btn btn-success" name="add_salesinvoice_gen" value="Generate Invoice">
        </div>
        <div class="col-xs-6">
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
    
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml54").wysihtml5();
});
</script>


<?php 
}
?>
    <?php
}
/*-----------------------------------------------*/
if(isset($_POST['deliveryorder_detailed_view'])){
	if(ctype_alnum($_POST['deliveryorder_detailed_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_deliveryorders
	left join sw_currency on do_rel_cur_id = cur_id
	left join sw_clients on do_rel_cli_id = cli_id
	 where md5(do_id)= '".$_POST['deliveryorder_detailed_view']."' and do_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No deliveryorder Found for this hash');
	}
	?>
	<div class="row">
    <div class="col-xs-4">
        <p><div class="text-muted">Delivery Order Ref:</div><?php echo $getqoid['do_ref']; ?></p>
        <p><div class="text-muted">Date:</div><?php echo date('d-m-Y',$getqoid['do_dnt']); ?></p>
        <p><div class="text-muted">Currency:</div><?php echo $getqoid['cur_name']; ?></p>
    </div>
    <div class="col-xs-4">
        <p><div class="text-muted">Project:</div><?php echo $getqoid['do_proj_name']; ?></p>
        <p><div class="text-muted">Sub:</div><?php echo $getqoid['do_subj']; ?></p>
	    </div>
    
    <div class="col-xs-4">
        <p><div class="text-muted">Billing Address:</div><br><?php echo '<strong>'.$getqoid['cli_name'].'</strong><br>'.$getqoid['cli_bill_addr']; ?></p>
    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div  class="row">
                                        <hr>
                                    <table id="datatable_in" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Desc</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_deliveryorders_items` q 
left join sw_products_list p on q.di_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.di_rel_do_id =".$getqoid['do_id']."  and di_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins


		echo '
		<tr>
<td>'.$cc.'</td>
<td>'.$boxrw['pr_code'].'</td>
<td>'.$boxrw['pr_name'].'
<br>'.convert_desc($boxrw['di_desc']).'</td>
<td>'.$boxrw['di_qty'].' '.$boxrw['prty_unit'].'</td>
</tr>';
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>                       

 						                          
                                            </tbody>
                                        </table>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
                                     </div>
                                </div>
                                <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_in').dataTable();
    } );
</script>
                                <?php
}
if(isset($_POST['deliveryorder_edit'])){
	if(ctype_alnum($_POST['deliveryorder_edit'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "
	select * from sw_deliveryorders 
	left join sw_currency on do_rel_cur_id = cur_id 
	left join sw_clients on do_rel_cli_id = cli_id 
	where md5(do_revision_id)= '".$_POST['deliveryorder_edit']."' and do_valid =1 order by do_revision desc  limit 1
	");
	if(is_array($getqoid)){
	}else{
		die('No deliveryorder Found for this hash');
	}
	?>
<form action="master_action.php" method="post" enctype="multipart/form-data">
	<div class="row">
		<h5 align="center" style="color:red">All Data has been picked from the latest Sales Invoice</h5>
<div class="col-xs-4">
<input type="hidden" name="add_revision_d_hash" value="<?php echo md5($getqoid['do_id']); ?>" />
            
            
    <p>
        <div class="text-muted">Currency:</div>
            <?php echo $getqoid['cur_name'] .'<br> Rate:'.$getqoid['do_cur_rate'] ?>
    </p>
</div>

<div class="col-xs-4">
    <p>
    	<div class="text-muted">Project:</div>
        <input type="text" class="form-control" name="add_revision_deliveryorder_proj_name" value="<?php echo $getqoid['do_proj_name']; ?>" required />
    </p>
    
    <p>
        <div class="text-muted">Sub:</div>
        <input type="text" class="form-control" name="add_revision_deliveryorder_subj" value="<?php echo $getqoid['do_subj']; ?>" required />
    </p>
    
</div>
    
<div class="col-xs-4">
	<p>
    	<div class="text-muted">Billing Address:</div>
        <br>Will Be Picked from the account of <?php echo  $getqoid['cli_code'].'-'.$getqoid['cli_name']; ?>
	</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div  class="row">
<hr>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th  style="width:25%">Product</th>
                <th style="width:30%">Product Desc</th>
                <th style="width:12%">Cost Price</th>
                <th style="width:12%">Sale Price</th>
                <th style="width:12%">Qty</th>
                <th style="width:9%"></th>
            </tr>
        </thead>
        <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_deliveryorders_items` q 
left join sw_products_list p on q.di_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.di_rel_do_id =".$getqoid['do_id']."  and di_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		
		#firts loop begins
		echo '


<tr>
	<td><select id="selold'.$cc.'" class="form-control " name="add_revision_deliveryorder_product_already_'.$cc.'">';
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
 where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
 order by pr_code,pr_name asc";
 echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	   if($row['pr_id'] == $boxrw['di_rel_pr_id']){
		   echo '<option data-id="'.$row['pr_id'].'" selected value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }else{
		   echo '<option data-id="'.$row['pr_id'].'"  value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }
	}
} else {
	echo "0 results";
}
echo '</select></td>
	
	
	<td>
	<textarea class=" form-control" name="add_revision_deliveryorder_desc_already_'.$cc.'" id="rqda'.$cc.'">'.$boxrw['di_desc'].'</textarea></td>
	<td><input id="rqca'.$cc.'" name="add_revision_deliveryorder_cost_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['di_cost'].'" /></td>
	<td><input name="add_revision_deliveryorder_price_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['di_price'].'" /></td>
	<td><input name="add_revision_deliveryorder_qty_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['di_qty'].'" /></td>
	';
	?>
    
<script type="text/javascript">
$(document).ready(function() {
	$('#selold<?php echo $cc; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#rqda<?php echo $cc; ?>").val(result.desc);
					$("#rqca<?php echo $cc; ?>").val(result.cost);
				});
	} );
} );
		
		
</script>

	<td><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>
	<?php echo'
</tr>
';
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>
        <tr id="addrevdo1" class="DoclonedInput">
            <td><select class="form-control add_revision_deliveryorder_product_a" id="add_revision_deliveryorder_product_a" name="add_revision_deliveryorder_product_a">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
            <td><textarea name="add_revision_deliveryorder_desc_a" class="form-control add_revision_deliveryorder_desc_a" id="add_revision_deliveryorder_desc_a" required>-</textarea></td>
            <td><input name="add_revision_deliveryorder_cost_a"  type="number" step="0.01" class="form-control add_revision_deliveryorder_cost_a" id="add_revision_deliveryorder_cost_a" required value="0" placeholder="Cost Price"  /></td>
            <td><input name="add_revision_deliveryorder_price_a"  type="number" step="0.01" class="form-control add_revision_deliveryorder_price_a" id="add_revision_deliveryorder_price_a" required value="0" placeholder="Sale Price"  /></td>
            <td><input name="add_revision_deliveryorder_qty_a"  type="number" step="0.01" class="form-control add_revision_deliveryorder_qty_a" id="add_revision_deliveryorder_qty_a" required value="0" placeholder="Qty"  /></td>
            <td><div class="add_revision_deliveryorder_script" id="add_revision_deliveryorder_script"></div></td>

	    </tr>
        
        
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_revision_deliveryorder_product_a').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_revision_deliveryorder_desc_a").val(result.desc);
					$("#add_revision_deliveryorder_cost_a").val(result.cost);
				});
	} );
} );
		
</script>
<div class="row">
    <div align="center" class=" col-xs-12 ">
        <div id="addDelButtons13">
          <input style="border-radius:10px" type="button" id="btnAdd20" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel20" value="Remove" class="btn btn-danger">
        </div> 
    </div><br>

    <div class="col-xs-12">
    	<input align="" type="submit" class="btn btn-success" value="Revise" name="add_revision_deliveryorder"  />
        <input required  value="1" id="di_nos" class="form-control" type="hidden" name="di_nos"  />

    </div>
</div> 
                                        
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
		</div>
	</div>
</div>
</form>


<?php /*
<script>
$(document).ready(function(){
		  $(".1wysihtml5").wysihtml5();
});
</script>

*/ ?>
<script type="text/javascript">
    $(document).ready(function() {
    } );
</script>
<script>
function myFunct(val) {
	if(val ==2){
		y = '';
	}else{
		y =(val-1);
	}
}

</script>



<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>

                                <?php
}
if(isset($_POST['add_deliveryorder_proforma'])){
	?>
<div class="form-group">
	<label>Delivery Order Ref: </label>
	Auto Generated
</div>
<table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
            	<th>#</th>
                <th>Ref</th>
                <th>Client Code</th>
                <th>Client</th>
                <th>Currency</th>
                <th>Items</th>
                <th>Dated</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php 
$sql = "SELECT * FROM sw_proformas 
where po_revision =0 and po_valid=1 order by po_ref desc ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	$wye = 1;
	while($row = $result->fetch_assoc()) {
		   $getmax = getdatafromsql($conn,"select * from sw_proformas left join sw_clients on po_rel_cli_id = cli_id 
left join sw_currency on po_rel_cur_id = cur_id
 where po_valid =1 and po_revision_id = '".$row['po_id']."' order by po_revision desc limit 1 ");
		   if(!is_array($getmax)){
			   die('Non Expected error');
		   }
		   $checkdupe = getdatafromsql($conn,"select * from sw_deliveryorders left join sw_proformas on  do_rel_po_id = po_id 
		    where po_revision_id = ".$row['po_id']." and do_valid =1");
		   if(!is_array($checkdupe)){
			   ?>
           
           <tr>
                       
            <td><?php echo $wye; ?></td>
            <td><?php echo $getmax['po_ref']; ?></td>
            <td><?php echo $getmax['cli_code']; ?></td>
            <td><?php echo $getmax['cli_name']; ?></td>
            <td><?php echo $getmax['cur_name']; ?></td>
            <td><?php 
			$geti = getdatafromsql($conn,"select count(*) as quu from sw_proformas_items where pi_rel_po_id = ".$getmax['po_id']." and pi_valid =1");
			
if(is_array($geti)){
	echo $geti['quu'];
}else{
	echo 'No Items Added';
}

			 ?></td>
            <td><?php echo date('j/n/Y',$getmax['po_dnt']); ?></td>
            <td>
			<form action="master_action.php" method="post"><input type="hidden" name="add_deliveryorder_proforma_hash" value="<?php echo md5($getmax['po_id']); ?>" /><input type="submit" class="btn btn-success" name="add_deliveryorder_proforma" value="Generate" /></form>
			</td>


           </tr>
                          <?php
						  $wye++;
		   }
		   ?>
           

           <?php
		   
		   
	}
} else {
	echo "0 results";
}
?>
        
        </tbody>
</table>
<hr>


<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
} );
		
</script>
    <?php
}
if(isset($_POST['deliveryorders_print_view'])){
		if(ctype_alnum($_POST['deliveryorders_print_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_deliveryorders
	left join sw_currency on do_rel_cur_id = cur_id
	left join sw_clients on do_rel_cli_id = cli_id
	 where md5(do_id)= '".$_POST['deliveryorders_print_view']."' and do_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No deliveryorder Found for this hash');
	}

$login=1;
$_USER = array();
$_USER = make_user_ar($conn,$_SESSION['TICKET_LUM_DB_ID'],$login);

	?>
    
    
    <div class="row">
<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Footer</th>
                    <th>Extra</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT * FROM sw_deliveryorders_gen where dog_rel_do_id = ".$getqoid['do_id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$row['dog_footer'].'</td>
	   	<td>'.$row['dog_extra'].'</td>
		<td><a href="sw_del_or_print.php?id='.md5($row['dog_id']).'"><button class="btn btn-md btn-info">View</button></a></td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

    </div>

<hr><br>    
    
<form action="master_action.php" method="post" enctype="multipart/form-data">
<h3>Generate New</h3>
<input type="hidden" name="add_deliveryorder_gen_hash" value="<?php echo md5($_POST['deliveryorders_print_view']); ?>" />

<div class="col-xs-6">
    <div class="form-group">
        <label>LPO Reference:</label>
        <input required  name="add_deliveryorder_gen_lpo" type="text" class="form-control" placeholder="35488"/>
    </div>
</div>
<div class="col-xs-6">
    <div class="form-group">
        <label>Payment Terms: </label>
        <input required  name="add_deliveryorder_gen_payment_t" type="text" class="form-control" value="<?php echo $getqoid['cli_pay_terms'] ?>" placeholder="5"/>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Address to be shown: </label>
        <textarea style="height:200px" name="add_deliveryorder_address" required class="wysihtml54 form-control"><?php echo $getqoid['cli_bill_addr'] ?></textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Extra(Before Delivery Order Starts): </label>
        <textarea style="height:200px" name="add_deliveryorder_gen_extra" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Footer(After Delivery Order Ends): </label>
        <textarea style="height:200px" name="add_deliveryorder_gen_footer" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>



    
    
    <div class="row">
        <div class="col-xs-6">
            <input required  style="float:right" type="submit" class="btn btn-success" name="add_deliveryorder_gen" value="Generate Invoice">
        </div>
        <div class="col-xs-6">
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
    
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml54").wysihtml5();
});
</script>
    <?php
}
/*-----------------------------------------------*/
if(isset($_POST['purchaseorder_detailed_view'])){
	if(ctype_alnum($_POST['purchaseorder_detailed_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_purchaseorders
	left join sw_currency on pco_rel_cur_id = cur_id
	left join sw_suppliers on pco_rel_sup_id = sup_id
	 where md5(pco_id)= '".$_POST['purchaseorder_detailed_view']."' and pco_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No purchaseorder Found for this hash');
	}
	?>
	<div class="row">
    <div class="col-xs-4">
        <p><div class="text-muted">Purchase Order Ref:</div><?php echo $getqoid['pco_ref']; ?></p>
        <p><div class="text-muted">Date:</div><?php echo date('d-m-Y',$getqoid['pco_dnt']); ?></p>
        <p><div class="text-muted">Currency:</div><?php echo $getqoid['cur_name']; ?></p>
    </div>
    <div class="col-xs-4">
        <p><div class="text-muted">Project:</div><?php echo $getqoid['pco_proj_name']; ?></p>
        <p><div class="text-muted">Sub:</div><?php echo $getqoid['pco_subj']; ?></p>
	    </div>
    
    <div class="col-xs-4">
        <p><div class="text-muted">Billing Address:</div><br><?php echo '<strong>'.$getqoid['sup_name'].'</strong><br>'.$getqoid['sup_bill_addr']; ?></p>
    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div  class="row">
                                    <table id="datatable_in" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Desc</th>
                                                    <th>Price AED<br>per Unit </th>
                                                    <th>Qty</th>
                                                    <th>Total <?php echo $getqoid['cur_name'] ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_purchaseorders_items` q 
left join sw_products_list p on q.pci_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.pci_rel_pco_id =".$getqoid['pco_id']."  and pci_valid =1 and p.pr_valid =1
and t.prty_valid =1

";

$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		$init = round(($boxrw['pci_qty'] * $boxrw['pci_cost'] * $getqoid['pco_cur_rate']),2);
		echo '
		<tr>
<td>'.$cc.'</td>
<td>'.$boxrw['pr_code'].'</td>
<td>'.$boxrw['pr_name'].'</td>
<td>'.convert_desc($boxrw['pci_desc']).'</td>
<td>AED '.$boxrw['pci_cost'].'</td>
<td>'.$boxrw['pci_qty'].' '.$boxrw['prty_unit'].'</td>
<td>'.$getqoid['cur_name'].' '.number_format($init,2).' </td>
</tr>';
	$cc++;
	#first loop ends
	$total = $total + ($init);
    }
} else {
    echo "0 results";
}
 ?>                       

 						                          
                                            </tbody>
                                        </table>
                                        
                                        <?php 
							echo '<h4 align="right">'.$getqoid['cur_name'].' '.number_format(($total),2).'</h4>'; 
							echo '<h4 align="right">'.$getqoid['cur_name'].' '.strtoupper(convert_number_to_words(($total))).'</h4>'; 
							
							?>
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                    <hr>
                                     </div>
                                </div>
                                <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_in').dataTable();
    } );
</script>
                                <?php
}
if(isset($_POST['purchaseorder_edit'])){
	if(ctype_alnum($_POST['purchaseorder_edit'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "
	select * from sw_purchaseorders 
	left join sw_currency on pco_rel_cur_id = cur_id 
	left join sw_suppliers on pco_rel_sup_id = sup_id 
	where md5(pco_revision_id)= '".$_POST['purchaseorder_edit']."' and pco_valid =1 order by pco_revision desc  limit 1
	");
	if(is_array($getqoid)){
	}else{
		die('No purchaseorder Found for this hash');
	}
	?>
<form action="master_action.php" method="post" enctype="multipart/form-data">
	<div class="row">
		<h5 align="center" style="color:red">All Data has been picked from the latest Sales Invoice</h5>
<div class="col-xs-4">
<input type="hidden" name="add_revision_po_hash" value="<?php echo md5($getqoid['pco_id']); ?>" />
            
            
    <p>
        <div class="text-muted">Currency:</div>
            <?php echo $getqoid['cur_name'] .'<br> Rate:'.$getqoid['pco_cur_rate'] ?>
    </p>
</div>

<div class="col-xs-4">
    <p>
    	<div class="text-muted">Project:</div>
        <input type="text" class="form-control" name="add_revision_purchaseorder_proj_name" value="<?php echo $getqoid['pco_proj_name']; ?>" required />
    </p>
    
    <p>
        <div class="text-muted">Sub:</div>
        <input type="text" class="form-control" name="add_revision_purchaseorder_subj" value="<?php echo $getqoid['pco_subj']; ?>" required />
    </p>
    
</div>
    
<div class="col-xs-4">
	<p>
    	<div class="text-muted">Billing Address:</div>
        <br>Will Be Picked from the account of <?php echo  $getqoid['sup_code'].'-'.$getqoid['sup_name']; ?>
	</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div  class="row">
<hr>
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th  style="width:35%">Product</th>
                <th  style="width:35%">Product Desc</th>
                <th  style="width:10%">Cost</th>
                <th  style="width:10%">Qty</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                                                
<?php

$boxsql = "SELECT * FROM `sw_purchaseorders_items` q 
left join sw_products_list p on q.pci_rel_pr_id = p.pr_id
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where q.pci_rel_pco_id =".$getqoid['pco_id']."  and pci_valid =1 and p.pr_valid =1
and t.prty_valid =1

";
$boxres = $conn->query($boxsql);
$total = 0;
if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		
		#firts loop begins
		echo '


<tr>
	<td><select id="selold'.$cc.'" class="form-control " name="add_revision_purchaseorder_product_already_'.$cc.'">';
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
 where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
 order by pr_code,pr_name asc";
 echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	   if($row['pr_id'] == $boxrw['pci_rel_pr_id']){
		   echo '<option data-id="'.$row['pr_id'].'" selected value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }else{
		   echo '<option data-id="'.$row['pr_id'].'"  value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	   }
	}
} else {
	echo "0 results";
}
echo '</select></td>
	
	
	<td>
	<textarea class=" form-control" name="add_revision_purchaseorder_desc_already_'.$cc.'" id="rqda'.$cc.'">'.$boxrw['pci_desc'].'</textarea></td>
	<td><input id="rqca'.$cc.'" name="add_revision_purchaseorder_cost_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['pci_cost'].'" /></td>
	<td><input name="add_revision_purchaseorder_qty_already_'.$cc.'"  type="number" step="0.01" class="form-control" required value="'.$boxrw['pci_qty'].'" /></td>
	';
	?>
    
<script type="text/javascript">
$(document).ready(function() {
	$('#selold<?php echo $cc; ?>').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#rqda<?php echo $cc; ?>").val(result.desc);
					$("#rqca<?php echo $cc; ?>").val(result.cost);
				});
	} );
} );
		
		
</script>

	<td  style="width:10%"><button type="button" class="btn btn-danger" onClick="$(this).closest('tr').remove();">Delete</button></td>
	<?php echo'
</tr>
';
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>
        <tr id="addrevpci1" class="PcoclonedInput">
            <td><select class="form-control add_revision_purchaseorder_product_a" id="add_revision_purchaseorder_product_a" name="add_revision_purchaseorder_product_a">
<?php 
$sql = "SELECT * FROM sw_products_list p
left join sw_prod_types t on p.pr_rel_prty_id = t.prty_id
where p.pr_valid =1 and t.prty_valid=1 and p.pr_id 
order by pr_code,pr_name asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo '<option data-id="0" value="0">Select Product </option>';
	while($row = $result->fetch_assoc()) {
		   echo '<option  data-id="'.$row['pr_id'].'" value="'.md5($row['pr_id']).'">'.$row['pr_code'].'-'.$row['pr_name'].'</option>';
	}
} else {
	echo "0 results";
}
?>
            </select></td>
            
            <td><textarea name="add_revision_purchaseorder_desc_a" class="form-control add_revision_purchaseorder_desc_a" id="add_revision_purchaseorder_desc_a" required>-</textarea></td>
            <td><input name="add_revision_purchaseorder_cost_a"  type="number" step="0.01" class="form-control add_revision_purchaseorder_cost_a" id="add_revision_purchaseorder_cost_a" required value="0" placeholder="Cost Price"  /></td>
            <td><input name="add_revision_purchaseorder_qty_a"  type="number" step="0.01" class="form-control add_revision_purchaseorder_qty_a" id="add_revision_purchaseorder_qty_a" required value="0" placeholder="Qty"  /></td>
            <td><div class="add_revision_purchaseorder_script" id="add_revision_purchaseorder_script"></div></td>

	    </tr>
        
        
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$('#add_revision_purchaseorder_product_a').change(function(){
		var tx = $(this).children('option:selected').data('id');
				$.post("master_action.php", {prid: tx}, function(result){
					result = $.parseJSON( result );
					$("#add_revision_purchaseorder_desc_a").val(result.desc);
					$("#add_revision_purchaseorder_cost_a").val(result.cost);
				});
	} );
} );
		
</script>
<div class="row">
    <div align="center" class=" col-xs-12 ">
        <div id="addDelButtons25">
          <input style="border-radius:10px" type="button" id="btnAdd25" value="Add More" class="btn btn-info" >
          <input style="border-radius:10px" type="button" id="btnDel25" value="Remove" class="btn btn-danger">
        </div> 
    </div><br>

    <div class="col-xs-12">
    	<input align="" type="submit" class="btn btn-success" value="Revise" name="add_revision_purchaseorder"  />
        <input required  value="1" id="pci_nos" class="form-control" type="hidden" name="pci_nos"  />

    </div>
</div> 
                                        
                                        <!-- -->

                               
 
 
                                        
                                 
                                        <!-- -->
		</div>
	</div>
</div>
</form>


<?php /*
<script>
$(document).ready(function(){
		  $(".1wysihtml5").wysihtml5();
});
</script>

*/ ?>
<script type="text/javascript">
    $(document).ready(function() {
    } );
</script>
<script>
function myFunct(val) {
	if(val ==2){
		y = '';
	}else{
		y =(val-1);
	}
}

</script>



<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>

                                <?php
}
if(isset($_POST['add_purchaseorder_proforma'])){
	?>
<div class="form-group">
	<label>Purchase Order Ref: </label>
	Auto Generated
</div>

<table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Ref</th>
                <th>Client Code</th>
                <th>Client</th>
                <th>Currency</th>
                <th>Items</th>
                <th>Suppliers</th>
                <th>Dated</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php 
$sql = "SELECT * FROM sw_proformas 
where po_revision =0 and po_valid=1 order by po_ref desc ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	
	$wjhsf =1;
	while($row = $result->fetch_assoc()) {
		   $getmax = getdatafromsql($conn,"select * from sw_proformas left join sw_clients on po_rel_cli_id = cli_id 
left join sw_currency on po_rel_cur_id = cur_id
 where po_valid =1 and po_revision_id = '".$row['po_id']."' order by po_revision desc limit 1 ");
		   if(!is_array($getmax)){
			   die('Non Expected error');
		   }
		   $checkdupe = getdatafromsql($conn,"select * from sw_purchaseorders left join sw_proformas on  pco_rel_po_id = po_id 
		   where po_revision_id = ".$getmax['po_id']." and pco_valid =1");
		   if(!is_array($checkdupe)){
			   ?>
           <tr>
                       
            <td><?php echo $wjhsf; ?></td>
            <td><?php echo $getmax['po_ref']; ?></td>
            <td><?php echo $getmax['cli_code']; ?></td>
            <td><?php echo $getmax['cli_name']; ?></td>
            <td><?php echo $getmax['cur_name']; ?></td>
            <td><?php 
			$geti = getdatafromsql($conn,"select count(*) as quu from sw_proformas_items where pi_rel_po_id = ".$getmax['po_id']." and pi_valid =1");
			
if(is_array($geti)){
	echo $geti['quu'];
}else{
	echo 'No Items Added';
}

			 ?></td>
            <td><?php 
			$gets = getdatafromsql($conn,"select count(distinct(pi_rel_sup_id)) as iui from sw_proformas_items i
where pi_rel_po_id = ".$getmax['po_id']." and pi_valid =1 ");
			
if(is_array($gets)){
	echo $gets['iui'];
}else{
	echo 'No Suppliers Added';
}

			 ?></td>
            <td><?php echo date('j/n/Y',$getmax['po_dnt']); ?></td>
            <td>
            			<form action="master_action.php" method="post">

            <label>Currency: </label>
            <select class="form-control" name="add_purchaseorder_proforma_cur" required>
                <?php
                $sqlc = "SELECT * FROM sw_currency";
        $sqlc = $conn->query($sqlc);
        
        if ($sqlc->num_rows > 0) {
            // output data of each row
            while($cu = $sqlc->fetch_assoc()) {
                if(trim($cu['cur_id']) == 1){
                echo '<option selected value="'.md5($cu['cur_id']).'">'.$cu['cur_name'].'</option>';
                }else{
                echo '<option value="'.md5($cu['cur_id']).'">'.$cu['cur_name'].'</option>';
                }
            }
        } else {
        }
                ?>
            </select>
<br>
    
            <label>Currency Rate: </label>
            <input required type="text" name="add_purchaseorder_proforma_cur_rate" class="form-control" placeholder="Multiplied by AED" value="1"/>
             
<br>

            <input type="hidden" name="add_purchaseorder_proforma_hash" value="<?php echo md5($getmax['po_id']); ?>" />
            <input type="submit" class="btn btn-success" name="add_purchaseorder_proforma" value="Generate" />
                        </form>

			</td>


           </tr>
                          <?php
						  $wjhsf++;
		   }
		   ?>
           

           <?php
		   
		   
	}
} else {
	echo "0 results";
}
?>
        
        </tbody>
</table>
<hr>


<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
} );
		
</script>
    <?php
}
if(isset($_POST['purchaseorders_print_view'])){
		if(ctype_alnum($_POST['purchaseorders_print_view'])){
	}else{
		die('Invalid Hash Is Being Passed');
	}
	$getqoid  = getdatafromsql($conn, "select * from sw_purchaseorders
	left join sw_currency on pco_rel_cur_id = cur_id
	left join sw_suppliers on pco_rel_sup_id = sup_id
	 where md5(pco_id)= '".$_POST['purchaseorders_print_view']."' and pco_valid =1");
	if(is_array($getqoid)){
	}else{
		die('No purchaseorder Found for this hash');
	}

$login=1;
$_USER = array();
$_USER = make_user_ar($conn,$_SESSION['TICKET_LUM_DB_ID'],$login);

	?>
    
    
    <div class="row">
<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Extra Price <br>(Will be added to total)</th>
                    <th>Footer</th>
                    <th>Extra</th>
                    <th>Before Total</th>
                    <th>After Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT * FROM sw_purchaseorders_gen where pcog_rel_pco_id = ".$getqoid['pco_id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$row['pcog_discount'].'</td>
	   	<td>'.$row['pcog_vat'].'%</td>
	   	<td>'.$row['pcog_extra_price'].'</td>
	   	<td>'.$row['pcog_footer'].'</td>
	   	<td>'.$row['pcog_extra'].'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['pcog_before_total'])).'</td>
	   	<td>'.str_replace('|=|=|=|=|=|','=',str_replace('||||||||||.||||||||||','<br>',$row['pcog_after_total'])).'</td>
		<td><a href="sw_purchaseorder_print.php?id='.md5($row['pcog_id']).'"><button class="btn btn-md btn-info">View</button></a></td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

    </div>

<hr><br>    
    
<form action="master_action.php" method="post" enctype="multipart/form-data">
<h3>Generate New</h3>
<input type="hidden" name="add_purchaseorder_gen_hash" value="<?php echo md5($_POST['purchaseorders_print_view']); ?>" />

<div class="col-xs-2">
    <div class="form-group">
        <label>Discount: </label>
        <input required  name="add_purchaseorder_gen_discount"  type="number" step="0.01" class="form-control" value="0" placeholder="10"/>
    </div>
</div>

<div class="col-xs-2">
    <div class="form-group">
        <label>VAT: </label>
        <input required  name="add_purchaseorder_gen_vat"  type="number" step="0.01" class="form-control" value="5" placeholder="5"/>
    </div>
</div>
<div class="col-xs-2">
    <div class="form-group">
        <label>Extra Price (Will be added to subtotal): </label>
        <input required  name="add_purchaseorder_extra_price"  type="number" step="0.01" class="form-control" value="0" placeholder="5"/>
    </div>
</div>
<div class="col-xs-3">
    <div class="form-group">
        <label>LPO Reference:</label>
        <input required  name="add_purchaseorder_gen_lpo" type="text" class="form-control" placeholder="35488"/>
    </div>
</div>
<div class="col-xs-3">
    <div class="form-group">
        <label>Payment Terms: </label>
        <input required  name="add_purchaseorder_gen_payment_t" type="text" class="form-control" value="<?php echo $getqoid['sup_pay_terms'] ?>" placeholder="5"/>
    </div>
</div>


<div class="col-xs-4">
    <div class="form-group">
        <label>Address to be shown: </label>
        <textarea style="height:200px" name="add_purchaseorder_address" required class="wysihtml54 form-control"><?php echo $getqoid['sup_bill_addr'] ?></textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Extra(Before Purchaseorder Starts): </label>
        <textarea style="height:200px" name="add_purchaseorder_gen_extra" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>

<div class="col-xs-4">
    <div class="form-group">
        <label>Footer(After Purchaseorder Ends): </label>
        <textarea style="height:200px" name="add_purchaseorder_gen_footer" required class="wysihtml54 form-control">-</textarea>
    </div>
</div>



<div class="col-xs-12">
<div class="form-group">
	<label>Before Total Heads: </label>
</div>    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="purchaseordergen1" class="26clonedInput">
<td><input name="add_purchaseorder_gen_bf_head" type="text" class="form-control add_purchaseorder_gen_bf_head" id="add_purchaseorder_gen_bf_head" required value="-" placeholder="Advance 14%"  /></td>
<td><input name="add_purchaseorder_gen_bf_head_val" type="number" step="0.01" class="form-control add_purchaseorder_gen_bf_head_val" id="add_purchaseorder_gen_bf_head_val" required value="0" placeholder="Some Value"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons11">
              <input style="border-radius:10px" type="button" id="btnAdd26" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel26" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="before_head_pci_nos" class="form-control" type="hidden" name="before_head_pci_nos"  />
    </div> 
    
    <hr>
    
</div>
    
<div class="col-xs-12">
<div class="form-group">
	<label>After Total Heads: </label>
</div>
    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
    <tr id="purchaseorderpen1" class="27clonedInput">
<td><input name="add_purchaseorder_gen_af_head" type="text" class="form-control add_purchaseorder_gen_af_head" id="add_purchaseorder_gen_af_head" required value="-" placeholder="Excess Duty"  /></td>
<td><input name="add_purchaseorder_gen_af_head_val" type="text" class="form-control add_purchaseorder_gen_af_head_val" id="add_purchaseorder_gen_af_head_val" required value="-" placeholder="15000"  /></td>
    
            </tr>
            
            </tbody>
    </table>
    <hr>
    <div class="row">
        <div align="left" class=" col-xs-12 ">
            <div id="addDelButtons10">
              <input style="border-radius:10px" type="button" id="btnAdd27" value="Add More" class="btn btn-info" >
              <input style="border-radius:10px" type="button" id="btnDel27" value="Remove" class="btn btn-danger">
            </div> 
        </div>
            <input required  value="1" id="after_head_pci_nos" class="form-control" type="hidden" name="after_head_pci_nos"  />
    </div> 
    
    <hr>
    
</div>
    
    
    <div class="row">
        <div class="col-xs-6">
            <input required  style="float:right" type="submit" class="btn btn-success" name="add_purchaseorder_gen" value="Generate Invoice">
        </div>
        <div class="col-xs-6">
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
    
	</form>
<script type="text/javascript"  src="assets/clone/clone-form-td.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script>
$(document).ready(function(){
		  $(".wysihtml54").wysihtml5();
});
</script>
    <?php
}
/*-----------------------------------------------*/
if(isset($_POST['purchaseorder_add_update'])){
	$getpo  = getdatafromsql($conn,"select * from sw_purchaseorders where pco_valid =1 and md5(pco_id) = '".$_POST['purchaseorder_add_update']."'");
	if(!is_array($getpo)){
		die('No Purchase Order Found');
	}
	?>
    
    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Total Qty</th>
                    <th>Qty Recieved</th>
                    <th>Qty Left</th>
                    <th>Add Recieved</th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			
			
$sql = "select * from sw_purchaseorders_items
left join sw_products_list on pci_rel_pr_id= pr_id
where pci_rel_pco_id = ".$getpo['pco_id']." and pci_valid = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			$getordersumqtyrecieved = getdatafromsql($conn,"select ifnull(sum(pcu_qty),0) as qty from sw_purchaseorder_updation where pcu_rel_pco_id = ".$row['pci_rel_pco_id']." and pcu_rel_pci_id = ".$row['pci_id']." and pcu_valid =1");
       echo '
	   <tr>
	   	<td>'.$row['pr_name'].'<br>'.$row['pci_desc'].'</td>
	   	<td>'.$row['pci_qty'].'</td>
	   	<td>'.$getordersumqtyrecieved['qty'].'</td>
	   	<td>'.($row['pci_qty'] - $getordersumqtyrecieved['qty']).'</td>
		<td>';
		?>
        <form action="master_action.php" method="post" enctype="multipart/form-data">
        <input  type="number" step="0.01"  name="update_purchaseorder_qty" max="<?php echo ($row['pci_qty'] - $getordersumqtyrecieved['qty']) ?>" min="1" value="0" class="form-control" placeholder="Enter Qty"/>
        <input type="hidden"  name="update_purchaseorder_pci_hash" class="form-control" value="<?php echo md5($row['pci_id']) ?>"/>
        <input type="submit"  name="update_purchaseorder" class="btn btn-success" value="Add Qty"/>
	</form>

        <?php
		 echo'</td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

    <?php
}
if(isset($_POST['purchaseorder_view_update'])){
		$getpo  = getdatafromsql($conn,"select * from sw_purchaseorders where pco_valid =1 and md5(pco_id) = '".$_POST['purchaseorder_view_update']."'");
	if(!is_array($getpo)){
		die('No Purchase Order Found');
	}

	?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Total Qty</th>
                    <th>Qty Recieved</th>
                    <th>Qty Left</th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			
			
$sql = "select * from sw_purchaseorders_items
left join sw_products_list on pci_rel_pr_id= pr_id
where pci_rel_pco_id = ".$getpo['pco_id']." and pci_valid = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			$getordersumqtyrecieved = getdatafromsql($conn,"select ifnull(sum(pcu_qty),0) as qty from sw_purchaseorder_updation where pcu_rel_pco_id = ".$row['pci_rel_pco_id']." and pcu_rel_pci_id = ".$row['pci_id']." and pcu_valid =1");
       echo '
	   <tr>
	   	<td>'.$row['pr_name'].'<br>'.$row['pci_desc'].'</td>
	   	<td>'.$row['pci_qty'].'</td>
	   	<td>'.$getordersumqtyrecieved['qty'].'</td>
	   	<td>'.($row['pci_qty'] - $getordersumqtyrecieved['qty']).'</td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Generated</td></tr>";
}
			
			?>
            </tbody>
</table>

<hr>
<p>Updation Tracking</p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Qty Recieved</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			
			
$gsql = "SELECT * FROM `sw_purchaseorder_updation` 
left join sw_purchaseorders_items i on `pcu_rel_pci_id` = i.pci_id
left join sw_products_list l on i.pci_rel_pr_id = l.pr_id
WHERE l.pr_valid=1 and i.pci_valid=1 and  `pcu_rel_pco_id` = ".$getpo['pco_id']." order by pcu_dnt desc";
$gsql = $conn->query($gsql);

if ($gsql->num_rows > 0) {
    // output data of each row
    while($grow = $gsql->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$grow['pr_name'].'</td>
	   	<td>'.$grow['pcu_qty'].'</td>
	   	<td>'.date('D, j/n/y @ H:i:s',$grow['pcu_dnt']).'</td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='7'> None Added</td></tr>";
}
			
			?>
            </tbody>
</table>

    <?php
}
/*-----------------------------------------------*/
if(isset($_POST['costing_add'])){
	$getpo  = getdatafromsql($conn,"select * from sw_proformas where po_valid =1 and md5(po_id) = '".$_POST['costing_add']."'");
	if(!is_array($getpo)){
		die('No Purchase Order Found');
	}
	?>

<form action="master_action.php" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-xs-6">
        <label>Cost Reason</label>
        <input type="text"  name="costing_head" value="-" class="form-control" placeholder="Labour Food"/>
    </div>
    <div class="col-xs-6">                
        <label>Cost Value(AED)</label>
        <input  type="number" step="0.01"  name="costing_value" value="0" class="form-control" placeholder="Enter AED"/>
    </div>
</div>
<div class="row"><br>

    <input type="hidden"  name="costing_hash" class="form-control" value="<?php echo md5($getpo['po_id']) ?>"/>
    <input type="submit"  name="add_costing" class="btn btn-success" value="Add Addition Cost"/>

</div>
</form>



    <?php
}
if(isset($_POST['costing_view'])){
		$getpro  = getdatafromsql($conn,"select * from sw_proformas where po_valid =1 and md5(po_id) = '".$_POST['costing_view']."'");
	if(!is_array($getpro)){
		die('No Proforma Found');
	}

	?>
<p>Costing Tracking</p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Cost Name</th>
                    <th>Cost Value</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			
			
$gsql = "SELECT * FROM `sw_costing` 
WHERE cost_valid =1 and `cost_rel_po_id` = ".$getpro['po_id']." order by cost_dnt desc";
$gsql = $conn->query($gsql);

if ($gsql->num_rows > 0) {
    // output data of each row
    while($grow = $gsql->fetch_assoc()) {
       echo '
	   <tr>
	   	<td>'.$grow['cost_name'].'</td>
	   	<td>'.$grow['cost_val'].'</td>
	   	<td>'.date('D, j/n/y @ H:i:s',$grow['cost_dnt']).'</td>
	   </tr>
	   
	   
	   ';
    }
} else {
    echo "<tr><td colspan='3'> None Added</td></tr>";
}
			
			?>
            </tbody>
</table>

    <?php
}
/*-----------------------------------------------*/
if(isset($_POST['payment_view'])){
	if(!ctype_alnum($_POST['payment_view'])){
		die('Proforma Not Found');
	}
		$getpro  = getdatafromsql($conn,"select * from sw_proformas
		left join sw_currency on po_rel_cur_id = cur_id
 where po_valid =1 and md5(po_id) = '".$_POST['payment_view']."' ");
	if(!is_array($getpro)){
		die('No Proforma Found');
	}

	?>
<p>Currency and Rate: <strong><?php echo $getpro['cur_name'] ?> @ <?php echo $getpro['po_cur_rate'] ?></strong></p>
                                    <table id="datatable9" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client </th>
                                                    <th>Method</th>
                                                    <th>Cheque Number</th>
                                                    <th>Cheque Dated</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
$bproductsql = "SELECT * FROM `sw_payments`
left join sw_payments_methods on pt_rel_method_id = method_id 
left join sw_proformas on pt_rel_po_id = po_id
left join sw_clients on po_rel_cli_id = cli_id
WHERE po_valid=1 and pt_rel_po_id = ".$getpro['po_id']."
order by pt_dnt desc
";
$bproductsql = $conn->query($bproductsql);

/*
select * from sw_purchaseorders where pco_valid =1 and pco_revision_id = '".$_POST['add_salesinvoice_proforma_hash']."' order by pco_revision desc limit 1 
*/
if ($bproductsql->num_rows > 0) {
	//'.md5(md5(sha1(md5($productrw['pr_id'])))).'_primga output data of each row
	$con = 1;
	while($prodrow = $bproductsql->fetch_assoc()) {
		echo '<tr>
	<td>'.$con.'</td>
	<td>'.$prodrow['cli_name'].'</td>
	<td>'.$prodrow['method_name'].'</td>
	<td>'.($prodrow['method_id'] =='2' ? '-': $prodrow['pt_cheque_number']).'</td>
	<td>'.($prodrow['method_id'] =='2' ? '-': date('j-n-Y',$prodrow['pt_cheque_date'])).'</td>
	<td>'.$getpro['cur_name'].' '.number_format(($prodrow['pt_val'] * $getpro['po_cur_rate']),2).'</td>
	</tr>';
	$con++;
	}

} else {
}?>
                        </tbody>
                                        </table>
                                        <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable9').dataTable();
    } );
</script>


    <?php
}
if(isset($_POST['past_pay'])){
				$foryesterday = "SELECT t.*, p.po_ref, c.cli_name FROM 
sw_payments t
left join sw_proformas p on pt_rel_po_id = po_id
left join sw_clients c on po_rel_cli_id = cli_id 
WHERE pt_valid = 1 and cli_valid =1 and po_valid =1 and
 ((from_unixtime(`pt_cheque_date`, '%d') *1 )  = ".(date('j',(time()-86400))).") and 
 ((from_unixtime(`pt_cheque_date`, '%m') *1 )  = ".(date('n',(time()-86400))).") and 
 ((from_unixtime(`pt_cheque_date`, '%Y') *1 )  = ".(date('Y',(time()-86400))).")";

?>
                    <table id="datatable2" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Proforma Ref</th>
                          <th>Client </th>
                          <th>Cheque Number</th>
                          <th>Cheque Dated</th>
                          <th>Value</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$foryesterday = $conn->query($foryesterday);

if ($foryesterday->num_rows > 0) {
    // output data of each row
    while($foryesterdayrow = $foryesterday->fetch_assoc()) {
		echo '<tr>
		<td>'.$foryesterdayrow['po_ref'].'</td>
		<td>'.$foryesterdayrow['cli_name'].'</td>
		<td>'.$foryesterdayrow['pt_cheque_number'].'</td>
		<td>'.date('j-n-Y',$foryesterdayrow['pt_cheque_date']).'</td>
		<td>'.$foryesterdayrow['pt_val'].'</td>
		</tr>';
    }
} else {
    echo "0 results";
}
?>
</tbody></table>
<?php
}

if(isset($_POST['today_pay'])){

			$fortoday ="SELECT t.*, p.po_ref, c.cli_name FROM 
sw_payments t
left join sw_proformas p on pt_rel_po_id = po_id
left join sw_clients c on po_rel_cli_id = cli_id 
WHERE pt_valid = 1 and cli_valid =1 and po_valid =1 and
 ((from_unixtime(`pt_cheque_date`, '%d') *1 )  = ".(date('j',(time()))).") and 
 ((from_unixtime(`pt_cheque_date`, '%m') *1 )  = ".(date('n',(time()))).") and 
 ((from_unixtime(`pt_cheque_date`, '%Y') *1 )  = ".(date('Y',(time()))).")";
?>
                    <table id="datatable2" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Proforma Ref</th>
                          <th>Client </th>
                          <th>Cheque Number</th>
                          <th>Cheque Dated</th>
                          <th>Value</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$fortoday = $conn->query($fortoday);

if ($fortoday->num_rows > 0) {
    // output data of each row
    while($foryesterdayrow = $fortoday->fetch_assoc()) {
		echo '<tr>
		<td>'.$foryesterdayrow['po_ref'].'</td>
		<td>'.$foryesterdayrow['cli_name'].'</td>
		<td>'.$foryesterdayrow['pt_cheque_number'].'</td>
		<td>'.date('j-n-Y',$foryesterdayrow['pt_cheque_date']).'</td>
		<td>'.$foryesterdayrow['pt_val'].'</td>
		</tr>';
    }
} else {
    echo "0 results";
}
?>
</tbody></table>
<?php

}
if(isset($_POST['tomorrow_pay'])){

			$fortom = "SELECT t.*, p.po_ref, c.cli_name FROM 
sw_payments t
left join sw_proformas p on pt_rel_po_id = po_id
left join sw_clients c on po_rel_cli_id = cli_id 
WHERE pt_valid = 1 and cli_valid =1 and po_valid =1 and
 ((from_unixtime(`pt_cheque_date`, '%d') *1 )  = ".(date('j',(time()+86400))).") and 
 ((from_unixtime(`pt_cheque_date`, '%m') *1 )  = ".(date('n',(time()+86400))).") and 
 ((from_unixtime(`pt_cheque_date`, '%Y') *1 )  = ".(date('Y',(time()+86400))).")";
?>
                    <table id="datatable2" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Proforma Ref</th>
                          <th>Client </th>
                          <th>Cheque Number</th>
                          <th>Cheque Dated</th>
                          <th>Value</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$fortom = $conn->query($fortom);

if ($fortom->num_rows > 0) {
    // output data of each row
    while($foryesterdayrow = $fortom->fetch_assoc()) {
		echo '<tr>
		<td>'.$foryesterdayrow['po_ref'].'</td>
		<td>'.$foryesterdayrow['cli_name'].'</td>
		<td>'.$foryesterdayrow['pt_cheque_number'].'</td>
		<td>'.date('j-n-Y',$foryesterdayrow['pt_cheque_date']).'</td>
		<td>'.$foryesterdayrow['pt_val'].'</td>
		</tr>';
    }
} else {
    echo "0 results";
}
?>
</tbody></table>
<?php

}
if(isset($_POST['dayaftertomorrow_pay'])){
			$fordayaftertom = "SELECT t.*, p.po_ref, c.cli_name FROM 
sw_payments t
left join sw_proformas p on pt_rel_po_id = po_id
left join sw_clients c on po_rel_cli_id = cli_id 
WHERE pt_valid = 1 and cli_valid =1 and po_valid =1 and
 ((from_unixtime(`pt_cheque_date`, '%d') *1 )  = ".(date('j',(time()+(86400*2)))).") and 
 ((from_unixtime(`pt_cheque_date`, '%m') *1 )  = ".(date('n',(time()+(86400*2)))).") and 
 ((from_unixtime(`pt_cheque_date`, '%Y') *1 )  = ".(date('Y',(time()+(86400*2)))).")";
 
?>
                    <table id="datatable2" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Proforma Ref</th>
                          <th>Client </th>
                          <th>Cheque Number</th>
                          <th>Cheque Dated</th>
                          <th>Value</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$fordayaftertom = $conn->query($fordayaftertom);

if ($fordayaftertom->num_rows > 0) {
    // output data of each row
    while($foryesterdayrow = $fordayaftertom->fetch_assoc()) {
		echo '<tr>
		<td>'.$foryesterdayrow['po_ref'].'</td>
		<td>'.$foryesterdayrow['cli_name'].'</td>
		<td>'.$foryesterdayrow['pt_cheque_number'].'</td>
		<td>'.date('j-n-Y',$foryesterdayrow['pt_cheque_date']).'</td>
		<td>'.$foryesterdayrow['pt_val'].'</td>
		</tr>';
    }
} else {
    echo "0 results";
}
?>
</tbody></table>
<?php
 
 
 
}
/*-------------------------------*/
if(isset($_POST['home_qty_sold'])){
	if(!ctype_alnum($_POST['home_qty_sold'])){
		die('Product Not Found');
	}
		$getpro  = getdatafromsql($conn,"select * from sw_products_list where md5(pr_id) = '".$_POST['home_qty_sold']."' ");
	if(!is_array($getpro)){
		die('No Product Found');
	}

	?>

<?php 

}
if(isset($_POST['home_qty_stored'])){
	if(!ctype_alnum($_POST['home_qty_stored'])){
		die('Product Not Found');
	}
		$getwarehouse  = getdatafromsql($conn,"select * from sw_products_list where md5(concat(123, pr_id)) = '".$_POST['home_qty_stored']."' ");
	if(!is_array($getwarehouse)){
		die('No Product Found');
	}
/*
		$getmockup  = getdatafromsql($conn,"select * from sw_mockups where mock_rel_pr_id = '".$getwarehouse['pr_id']."' ");
	if(!is_array($getmockup)){
		die('No Product Found');
	}

*/
	?>
    <div class="row">
    	<div style="border:1px solid black " class="col-lg-6 col-md-6 col-xs-12">
        <h4 align="center">Samples Sent for Approval</h4>
      <table class="table">
		<thead>
			<tr>
				<th>Client Name</th>
				<th>Sent From</th>
				<th>Address</th>
				<th>Qty</th>
			</tr>
		</thead>
		<tbody>
<?php	
$showroommock =array();	
$clisql = "select *, sum(mock_qty) as qty  from sw_mockups 
left join sw_clients on mock_rel_cli_id = cli_id
left join sw_showrooms on mock_rel_shw_id = shw_id
left join sw_suppliers on mock_rel_sup_id = sup_id
where mock_rel_pr_id = ".$getwarehouse['pr_id']." and mock_returned =0
group by mock_rel_cli_id";
$clisql = $conn->query($clisql);
	$mqty = 0;
if ($clisql->num_rows > 0) {
    // output data of each row
	
    while($clisqlrow = $clisql->fetch_assoc()) {
		$mocksqty = $clisqlrow['qty'];
		
		
if($clisqlrow['mock_rel_shw_id'] > 0){
	if(isset($showroommock[$clisqlrow['mock_rel_shw_id']])){
		$showroommock[$clisqlrow['mock_rel_shw_id']] = $showroommock[$clisqlrow['mock_rel_shw_id']] + $clisqlrow['qty'];	
	}else{
		$showroommock[$clisqlrow['mock_rel_shw_id']] = $clisqlrow['qty'];	
	}
}


       ?>
<tr>
	<td><?php echo $clisqlrow['cli_name']; ?></td>

<?php

if($clisqlrow['mock_rel_shw_id'] > 0){
	echo '<td>'.$clisqlrow['shw_name'].' Showroom</td>';
}else if($clisqlrow['mock_rel_sup_id'] > 0){
	echo '<td>'.$clisqlrow['sup_name'].' Supplier</td>';
}else{
	echo '<td>Warehouse</td>';
}

?>	
	<td><?php echo $clisqlrow['cli_bill_addr']; ?></td>

	<td><?php echo $mocksqty; ?></td>
</tr>
       <?php
		$mqty = $mqty +$mocksqty;
    }
} else {
    echo "<tr><td colspan='3'>No Mockups</td></tr>";
}		
?>


</tbody>
</table>
        </div>
    	<div style="border:1px solid black " class="col-lg-6 col-md-6 col-xs-12">
        <h4 align="center">Showroom</h4>
      <table class="table">
		<thead>
			<tr>
				<th>Showroom Name</th>
				<th>Qty</th>
			</tr>
		</thead>
		<tbody>
<?php		
$shwsql = "select * , sum(sh_qty) as qty from sw_products_list_show left join sw_showrooms on sh_rel_shw_id = shw_id where sh_rel_pr_id = '".$getwarehouse['pr_id']."' group by shw_id ";
$shwsql = $conn->query($shwsql);
	$shqty = 0;
if ($shwsql->num_rows > 0) {
    // output data of each row
    while($shwsqlrow = $shwsql->fetch_assoc()) {
				$showroomqty = $shwsqlrow['qty'];

	if(isset($showroommock[$shwsqlrow['sh_rel_shw_id']])){
		$showroomqty = $showroomqty - $showroommock[$shwsqlrow['sh_rel_shw_id']] ;	
	}

		

       ?>
<tr>
	<td><?php echo $shwsqlrow['shw_name']; ?></td>
	<td><?php echo $showroomqty; ?></td>
</tr>
       <?php
		$shqty = $shqty +$showroomqty;
    }
} else {
    echo "<tr><td colspan='2'>No Showroom Product</td></tr>";
}		
?>



</tbody>
</table></div>
    	<div style="border:1px solid black " class="col-lg-6 col-md-12 col-xs-12">
<h4 align="center">Sold</h4>
<?php 
echo '
      <table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Sales Invoice Ref</th>
				<th>Client Name</th>
				<th>Qty</th>
				';if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<th>Cost</th>';} echo '
				<th>Price</th>
				';if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<th>Markup</th>';}
				echo '
			</tr>
		</thead>
		<tbody>
		
		
		';

		
			$innersql = "SELECT a.*
FROM (select * from sw_proformas_items left join sw_proformas on pi_rel_po_id = po_id where po_valid =1 and pi_valid =1) a
LEFT OUTER JOIN (select * from sw_proformas_items left join sw_proformas on pi_rel_po_id = po_id where po_valid =1 and pi_valid =1) b
    ON a.po_revision_id = b.po_revision_id AND a.po_revision < b.po_revision
WHERE b.po_revision_id IS NULL
and a.pi_rel_pr_id =".$getwarehouse['pr_id'];

			$innersql = "SELECT a.*
FROM (select * from sw_salesinvoices_items left join sw_salesinvoices on si_rel_so_id = so_id where so_valid =1 and si_valid =1) a
LEFT OUTER JOIN (select * from sw_salesinvoices_items left join sw_salesinvoices on si_rel_so_id = so_id where so_valid =1 and si_valid =1) b
    ON a.so_revision_id = b.so_revision_id AND a.so_revision < b.so_revision
WHERE b.so_revision_id IS NULL
and a.si_rel_pr_id =".$getwarehouse['pr_id'];

			$inneres = $conn->query($innersql);
				$ttqty = 0;

			if ($inneres->num_rows > 0) {
			// output data of each row
			$placce = 1;
			while($innerw = $inneres->fetch_assoc()) {
								$proformaqty = $innerw['si_qty'];

			#2nd loop start

				$getclient = getdatafromsql($conn,"SELECT * from sw_clients where cli_valid =1 and cli_id='".$innerw['so_rel_cli_id']."'");


if(!is_array($getclient)){
	die('No Client Found');
}
								
								echo '<tr>';
								echo '
								<td>'.$placce.'</td>
								<td>'.$innerw['so_ref'].'</td>
								<td>'.$getclient['cli_name'].'</td>
								<td>'.$proformaqty.'</td>';
								if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<td>AED '.$innerw['si_cost'].'</td>';}
								echo '
								<td>AED '.$innerw['si_price'].'</td>';
								
								if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'
								<td>'.round($innerw['si_price']/$innerw['si_cost'],4).'</td>
									';}
								echo '</tr>';
		$ttqty = $ttqty + $proformaqty;
						$placce++;
	
			
			
		#2nd loop end	
			}
		} else {
			echo "<tr><td colspan='4'>No Orders</td></tr>";
		}
		
	
	echo '
	</tbody>
	</table>
 ';
?></div>



<div style="border:1px solid black " class="col-lg-6 col-md-12 col-xs-12">
<h4 align="center">Items in Proformas not Sold </h4>
<?php 
echo '
      <table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Sales Invoice Ref</th>
				<th>Client Name</th>
				<th>Qty</th>
				';if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<th>Cost</th>';} echo '
				<th>Price</th>
				';if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<th>Markup</th>';}
				echo '
			</tr>
		</thead>
		<tbody>
		
		
		';

		
			$abcinnersql = "SELECT a.*
FROM (select * from sw_proformas_items left join sw_proformas on pi_rel_po_id = po_id where po_valid =1 and pi_valid =1) a
LEFT OUTER JOIN (select * from sw_proformas_items left join sw_proformas on pi_rel_po_id = po_id where po_valid =1 and pi_valid =1) b
    ON a.po_revision_id = b.po_revision_id AND a.po_revision < b.po_revision
WHERE b.po_revision_id IS NULL
and a.pi_rel_pr_id =".$getwarehouse['pr_id'];


			$abcinneres = $conn->query($abcinnersql);
				$ptqty = 0;

			if ($abcinneres->num_rows > 0) {
			// output data of each row
			$abcplacce = 1;
			while($abcinnerw = $abcinneres->fetch_assoc()) {
				$getsalesinvoices= getdatafromsql($conn,"SELECT * from sw_salesinvoices where so_rel_po_id = '".$abcinnerw['po_id']."' and so_valid =1 LIMIT 1");


if(!is_array($getsalesinvoices)){


								$proformaqtys = $abcinnerw['pi_qty'];

			#2nd loop start

				$abcgetclient = getdatafromsql($conn,"SELECT * from sw_clients where cli_valid =1 and cli_id='".$abcinnerw['po_rel_cli_id']."'");


if(!is_array($abcgetclient)){
	die('No Client Found');
}

				
								
								echo '<tr>';
								echo '
								<td>'.$abcplacce.'</td>
								<td>'.$abcinnerw['po_ref'].'</td>
								<td>'.$abcgetclient['cli_name'].'</td>
								<td>'.$proformaqtys.'</td>';
								if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<td>AED '.$abcinnerw['pi_cost'].'</td>';}
								echo '
								<td>AED '.$abcinnerw['pi_price'].'</td>';
								
								if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'
								<td>'.round($abcinnerw['pi_price']/$abcinnerw['pi_cost'],4).'</td>
									';}
								echo '</tr>';
		$ptqty = $ptqty + $proformaqtys;
						$abcplacce++;
	
			
			
		#2nd loop end	
	}
		}
		} else {
			echo "<tr><td colspan='4'>No Standalone Proformas</td></tr>";
		}
		
	
	echo '
	</tbody>
	</table>
 ';
?></div>




    	<div style="border:1px solid black" class="col-xs-12">
		<?php $totalbusy = $mqty + $shqty +$ttqty; ?>
<h4 align="center">Qty Additions</h4>
      <table class="table">
		<thead>
			<tr>
				<th>Invoice Ref</th>
				<th>Qty</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
        
        <?php 
		
		$abc = "SELECT * FROM sw_products_qty where pq_valid =1 and pq_rel_pr_id = ".$getwarehouse['pr_id'];
$abc = $conn->query($abc);

if ($abc->num_rows > 0) {
    // output data of each row
    while($abca = $abc->fetch_assoc()) {
        ?>
        <tr>
        	<td><?php echo $abca['pq_ref']; ?></td>
        	<td><?php echo $abca['pq_qty']; ?></td>
        	<td><?php echo date('D, j M, Y',$abca['pq_dnt']); ?></td>
        </tr>
        <?php
    }
} else {
    echo "0 results";
}
		?>
<tr>
	<td colspan="3">Qty Left Including Unsold Proforma Items :<?php echo '('.$getwarehouse['pr_qty'].' - '.$mqty.' - '.$shqty.' - '.$ttqty.'- '.$ptqty.')=' ?><br><h3 style="color:#002ACC"><?php echo $getwarehouse['pr_qty'] - $totalbusy-$ptqty; ?></h3></td>
</tr>
<tr>
	<td colspan="3">Qty Left :<?php echo '('.$getwarehouse['pr_qty'].' - '.$mqty.' - '.$shqty.' - '.$ttqty.')=' ?><br><h3 style="color:red"><?php echo $getwarehouse['pr_qty'] - $totalbusy; ?></h3></td>
</tr>

</tbody>
</table>

</div>
</div>



<?php

}
/*if(isset($_POST['home_qty_stored_sp'])){
	if(!ctype_alnum($_POST['home_qty_stored_sp'])){
		die('Product Not Found');
	}
		$getwarehouse  = getdatafromsql($conn,"select * from sw_products_list where md5(concat(123, pr_id)) = '".$_POST['home_qty_stored_sp']."' ");
	if(!is_array($getwarehouse)){
		die('No Product Found');
	}
/*
		$getmockup  = getdatafromsql($conn,"select * from sw_mockups where mock_rel_pr_id = '".$getwarehouse['pr_id']."' ");
	if(!is_array($getmockup)){
		die('No Product Found');
	}


	?>
    
<div class="row">
	<div style="border:1px solid black " class="col-lg-7 col-md-12 col-xs-12">
		<h4 align="center">Sold</h4>
<?php 
echo '
      <table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Sales Invoice Ref</th>
				<th>Client Name</th>
				<th>Qty</th>
				';if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<th>Cost</th>';} echo '
				<th>Price</th>
				';if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<th>Markup</th>';}
				echo '
			</tr>
		</thead>
		<tbody>
		
		
		';

		
			$innersql = "SELECT a.*
FROM (select * from sw_proformas_items left join sw_proformas on pi_rel_po_id = po_id where po_valid =1 and pi_valid =1) a
LEFT OUTER JOIN (select * from sw_proformas_items left join sw_proformas on pi_rel_po_id = po_id where po_valid =1 and pi_valid =1) b
    ON a.po_revision_id = b.po_revision_id AND a.po_revision < b.po_revision
WHERE b.po_revision_id IS NULL
and a.pi_rel_pr_id =".$getwarehouse['pr_id'];


			$inneres = $conn->query($innersql);
				$ttqty = 0;

			if ($inneres->num_rows > 0) {
			// output data of each row
			$placce = 1;
			while($innerw = $inneres->fetch_assoc()) {
				$getsalesinvoice= getdatafromsql($conn,"SELECT * from sw_salesinvoices where so_rel_po_id = '".$innerw['po_id']."' and so_valid =1 LIMIT 1");


if(!is_array($getsalesinvoice)){


								$proformaqty = $innerw['pi_qty'];

			#2nd loop start

				$getclient = getdatafromsql($conn,"SELECT * from sw_clients where cli_valid =1 and cli_id='".$innerw['po_rel_cli_id']."'");


if(!is_array($getclient)){
	die('No Client Found');
}

				
								
								echo '<tr>';
								echo '
								<td>'.$placce.'</td>
								<td>'.$innerw['po_ref'].'</td>
								<td>'.$getclient['cli_name'].'</td>
								<td>'.$proformaqty.'</td>';
								if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'<td>AED '.$innerw['pi_cost'].'</td>';}
								echo '
								<td>AED '.$innerw['pi_price'].'</td>';
								
								if($_SESSION['STWL_LUM_TU_ID'] == '1'){echo'
								<td>'.round($innerw['pi_price']/$innerw['pi_cost'],4).'</td>
									';}
								echo '</tr>';
		$ttqty = $ttqty + $proformaqty;
						$placce++;
	
			
			
		#2nd loop end	
	}
		}
		} else {
			echo "<tr><td colspan='4'>No Standalone Proformas</td></tr>";
		}
		
	
	echo '
	</tbody>
	</table>
 ';
?></div>
    </div>
    <div class="row">
<tr>
	<td colspan="3"><br>Total In orders: <h3 style="color:green"><?php echo $ttqty ; ?></h3></td>
</tr>
</tbody>
</table>

</div>
    </div>





<?php

}




























*/





if(isset($_POST['payment_add'])){
	$getpo  = getdatafromsql($conn,"select * from ted_usr_reg where tur_valid =1 and md5(tur_id) = '".$_POST['payment_add']."'");
	if(!is_array($getpo)){
		die('No user Found');
	}
	?>

                    <hr><br>
<form action="master_action.php" method="post">
<input type="hidden" value="<?php echo $_POST['payment_add'] ?>" name="payment_add_hash"/>  
<div class="row">
    <div class="col-xs-6">
        <label>Method</label>
        <select name="payment_add_method" class="form-control" onchange="getval(this);">
<?php
$sql = "SELECT * from sw_payments_methods";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.md5($row['method_id']).'">'.$row['method_name'].'</option>';
    }
} else {
}


?>
        </select>
    </div>
    <div class="col-xs-6 tohide">                
        <label>Cheque Number</label>
        <input type="text"  name="payment_add_c_no"  value="0" class="form-control" placeholder="Enter Cheque Number"/>
    </div>
    <div class="col-xs-6 tohide">                
        <label>Cheque Date(Enter 0 if not cheque)</label>
        <input type="text"  name="payment_add_date" placeholder="" value="0" class="form-control">
        <span class="help-inline">dd-mm-yyyy</span>
    </div>
    <div class="col-xs-6">                
        <label>Payment Value For <?php echo $getpo['tur_qty'] ?> @ (35 AED)</label>
        <input  type="number" step="0.01"  name="payment_add_val"  value="<?php echo 35*$getpo['tur_qty'] ?>"  class="form-control" placeholder="Enter AED"/>
    </div>
</div>
<div class="row"><br>

    <input type="submit"  name="payment_add" class="btn btn-success" value="Add Payment"/>

</div>
</form>
<script>
function getval(sel)
{
    if((sel.value) == 'c81e728d9d4c2f636f067f89cc14862c'){
		$(".tohide").hide();
	}else{
		$(".tohide").show();
	}
}
</script>
        <script src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>


    <?php
}




?>