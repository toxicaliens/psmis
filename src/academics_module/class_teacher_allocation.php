<?php
include_once('src/models/Academics.php');
$aca = new Academics();

set_title('Class Teacher Allocation');
set_layout('dt-layout.php');
set_js(array('src/js/class_teacher.js'));
?>

<div class="page-title">
  	<div class="title_left"><h3>Class Teacher Allocations <small>Allocate a class to a teacher</small>	</h3></div>
  	<?php include('src/search_box.php'); ?>
</div>
<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12"></a>
		<div class="x_panel">
				<div class="x_title">
					<h2>Class Teacher Allocation<small>Select a Teacher then choose the classes and their respective streams that he/she is to become the class teacher.</small></h2>
	                      
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
	                      <div class="">
		                      <form action="" method="post" id="attach_teacher">	
		                      		<button class="btn btn-sm btn-success"><i class="fa fa-tag"></i> Attach </button>	
		                      		<select class="form-control select2_single" required>
		                      			<option value="" selected>--Choose Teacher--</option>
		                      			<?php 
		                      				$rows = $aca->getAllTeachers();
		                      				if(count($rows)){
		                      					foreach($rows  as $row){
		                      			?>
		                      			<option value="<?php echo $row['mf_id']; ?>"><?php echo $row['surname'].' '.$row['firstname'].' '.$row['middlename']; ?></option>
		                      			<?php }} ?>
		                      		</select>
		                      		<p></p>
		                      		<?php echo $aca->loadFormsAndStreams();  ?> 
		                      		<button class="btn btn-sm btn-success"><i class="fa fa-tag"></i> Attach </button>
		                      </form>
	                      </div>
				</div>
		</div>
	</div>
</div>