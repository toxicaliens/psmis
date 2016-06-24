<div class="form-horizontal form-label-left" novalidate>
  <h4>Login Details</h4>
  <hr/>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="username" name="username" required="required" value="<?php echo $mf->get('username'); ?>" class="form-control col-md-7 col-xs-12"/>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email" id="lab_email">Password <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="password" name="password" data-validate-length-range="8" required="required" readonly value="<?php echo uniqid(); ?>" class="form-control col-md-7 col-xs-12" />
    </div>
  </div> 
  <h4>Profile Picture(<i><small>Optional</small></i>)</h4>
  <hr/>
  <div class="item form-group">
    <label for="system_logo" class="control-label col-md-3 col-sm-3 col-xs-12">Photo:<span class="required">*</span></label>
    <div class="fileupload fileupload-new" data-provides="fileupload">
       <div class="fileupload-new thumbnail" style="width: 130px; height: 130px;">
          <img src="crap/photo.jpg" alt="" />
       </div>
       <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 130px; max-height: 130px; line-height: 20px;"></div>
       <div>
          <span class="btn btn-file"><span class="fileupload-new">Select logo</span>
          <span class="fileupload-exists">Change</span>
          <input type="file" class="default" name="photo" accept="image/*" /></span>
          <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
       </div>
    </div>
  </div>
</div>
<!-- hidden fields -->
<input type="hidden" name="action" value="add_masterfile"/>