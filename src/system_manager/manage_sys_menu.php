<div class="x_content">
	<?php if(isset($_SESSION['mes3'])){
    echo "<p style='color:#f00; font-size:16px;'>".$_SESSION['mes3']."</p>";
    unset($_SESSION['mes3']); } ?>
	<br />
<form action="" method="post" id="manage_menu" data-parsley-validate class="form-horizontal form-label-left">
 <table id="datatable-buttons" class="table table-striped table-bordered" style="width: 100%">
   <thead>
      <tr>
	  	<th>MENU ID</th>
		<th>MENU ITEM</th>
		<th>SEQUENCE</th>
		<th>PARENT</th>
		<th>EDIT</th>
	  </tr>
    </thead>
    <tbody>
    <?php manageMenu(null); ?>
    </tbody>
 </table>
<input name="action" type="hidden" value="manage_menu" />
<div class="ln_solid"></div>
	<div class="form-group">
	    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		<?php
			viewActions($_GET['num'], $_SESSION['role_id']);
		?>
		</div>
	</div>
</form>
</div>