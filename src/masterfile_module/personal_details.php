<div class="form-horizontal form-label-left" novalidate>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="role" id="role" class="form-control col-md-7 col-xs-12 required">
        <option value="">--Choose Role--</option>
        <?php
          $roles = $mf->getAllRoles();
          if(count($roles)){
            foreach ($roles as $role) {
        ?>
        <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
        <?php }} ?>
      </select>
    </div>
  </div>
  <div class="item form-group" id="title_div" style="display: none;">
  	<label for="title" class="control-label col-md-3 col-sm-3 col-xs-12" id="title_lab">Title</label>
	 <div class="col-md-6 col-sm-6 col-xs-12">
	  	<select name="title" id="title" class="form-control single_select2">
	  		<option value="">--Choose Title--</option>
	  		<?php 
	  			$titles = $mf->getAllTitles();
	  			if(count($titles)){
	  				foreach ($titles as $title){
	  		?>
	  		<option value="<?php echo $title['title_id']; ?>"><?php echo $title['title_name']; ?></option>
	  		<?php
	  				}
	  			}
	  		?>
	  	</select>
	  </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_no" id="lab_adm">Adm No <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="id_no" name="id_no" required="required" value="<?php echo $mf->get('id_no'); ?>" class="form-control col-md-7 col-xs-12">
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lab_dob">Date of Birth <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="date" required="required" id="dob" name="dob" class="form-control" placeholder="Date of Birth" aria-describedby="inputSuccess2Status" value="<?php echo $mf->get('dob'); ?>">
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration Date <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
      <input type="text" name="reg_date" required="required" class="form-control has-feedback-left" id="single_cal4" placeholder="Registration Date" aria-describedby="inputSuccess2Status" value="<?php echo (isset($_POST['reg_date'])) ? $mf->get('reg_date') : date('m/d/Y'); ?>">
      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
      <span id="inputSuccess2Status" class="sr-only">(success)</span>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Surname <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" name="surname" required="required" value="<?php echo $mf->get('surname'); ?>" class="form-control col-md-7 col-xs-12">
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">First Name <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="fname" name="fname" value="<?php echo $mf->get('fname'); ?>" required="required" class="form-control col-md-7 col-xs-12">
    </div>
  </div>
  <div class="form-group">
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="mname" value="<?php echo $mf->get('mname'); ?>">
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div id="gender" class="btn-group" data-toggle="buttons">
        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
          <input type="radio" name="gender" value="Male"> &nbsp; Male &nbsp;
        </label>
        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
          <input type="radio" name="gender" value="Female"> Female
        </label>
      </div>
    </div>
  </div>
  <hr/>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guardian" id="lab_guardian">Guardian <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="guardian" id="guardian" class="form-control col-md-7 col-xs-12 select2_single required" style="width: 100%;">
        <option value="">--Choose Guardian--</option>
        <?php
          $guardians = $mf->getAllGuardians();
          if(count($guardians)){
            foreach($guardians as $guardian){
        ?>
        <option value="<?php echo $guardian['mf_id']; ?>"
        <?php
        	if(isset($_POST['guardian']))
        		if($mf->get('guardian') == $guardian['mf_id'])	echo 'selected';
        ?>
        ><?php echo $guardian['guardian_name']; ?></option>
        <?php }} ?>
      </select>
    </div>
  </div>
   <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form" id="lab_form">Class <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="class_id" id="form" class="select2_single form-control col-md-7 col-xs-12 required ">
        <option value="">--Choose Class--</option>
        <?php
          $classes = $mf->getAllClasses();
          if(count($classes)){
            foreach($classes as $class){
        ?>
        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['class_name']; ?></option>
        <?php }} ?>
      </select>
    </div>
  </div>
   <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stream" id="lab_stream">Stream <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="stream_id" id="stream" class="form-control col-md-7 col-xs-12 required">
        <option value="">--Choose Form Stream--</option>
      </select>
    </div>
  </div>
</div>