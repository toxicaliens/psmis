<div class="form-horizontal form-label-left" novalidate>
  <div class="form-group">
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Type <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="address_type" class="select2_single form-control" disabled="disabled" style="width: 100%;">
        <option value="">--Choose Address Type--</option>
        <?php
          $add_types = $mf->getAllAdressTypes();
          if(count($add_types)){
            foreach($add_types as $add_type){
        ?>
        <option value="<?php echo $add_type['address_type_id']; ?>" <?php echo ($add_type['address_type_code'] === Main) ? 'selected': ''; ?>><?php echo $add_type['address_type_name']; ?>
        <?php }} ?>
      </select>
    </div>
  </div>
  <h4>Contact Details</h4>
  <hr/>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="number" id="phone_number" name="phone_number" required="required" class="form-control col-md-7 col-xs-12" placeholder="e.g. 0711524524" data-validate-length-range="6" data-validate-words="2" value="<?php echo $mf->get('phone_number'); ?>"/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email" id="lab_email">Email </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $mf->get('email'); ?>">
    </div>
  </div>

</div>