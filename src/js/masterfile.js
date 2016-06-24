// personal details
$('#role').on('change', function(){
  var role_id = $(this).val();
  var data = { 'role_id': role_id };

  $.ajax({
	  url: 'src/masterfile_module/get_titles.php',
	  type: 'POST',
	  data: data,
	  dataType: 'json',
	  success: function(data){
		  var html = '<option value="">--Choose Title--</option>';
		  for(var i = 0; i < data.length; i++)
			  html += '<option value="'+ data[i].title_id +'">'+ data[i].title_name +'</option>';
		  $('#title').html(html);;
	  }
  });
  
  $.ajax({
    url: 'src/masterfile_module/get_role_codes.php',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: function(data){
      // alert(data['role_code']);
      if(data['role_code'] == 'GUARDIAN' || data['role_code'] == 'TEACHER' || data['role_code'] == 'SS'){
        // labels
        $('label#lab_adm').text('ID Number/Passport *');
        $('label#lab_guardian').text('Guardian ');
        $('label#lab_form').text('Form ');
        $('label#lab_stream').text('Stream ');
        $('label#lab_dob').text('Date of Birth ');

        // fields
        $('select#guardian').attr('disabled', 'disabled').removeAttr('required');
        $('select#form').attr('disabled', 'disabled').removeAttr('required');
        $('select#stream').attr('disabled', 'disabled').removeAttr('required');

        $('input#phone_number').removeAttr('disabled').attr('required');
        $('input#dob').attr('disabled', 'disabled').removeAttr('required');
        $('input#username').attr('required', 'required').removeAttr('disabled');       
        $('input#email').removeAttr('disabled');
      }else if(data['role_code'] == 'PUPIL'){
        // labels
        $('label#lab_adm').text('Adm. No *');
        $('label#lab_guardian').text('Guardian *');
        $('label#lab_form').text('Form *');
        $('label#lab_stream').text('Stream *');
        $('label#lab_dob').text('Date of Birth *');

        // fields
        $('select#guardian').removeAttr('disabled').attr('required', 'required');
        $('select#form').removeAttr('disabled').attr('required', 'required');
        $('input#dob').removeAttr('disabled').attr('required', 'required');

        // disabled fields
        $('input#phone_number').attr('disabled', 'disabled').removeAttr('required');
        $('input#email').attr('disabled', 'disabled').removeAttr('required');
        $('input#username').attr('disabled', 'disabled').removeAttr('required');
      }
      
      if(data['role_code'] == 'TEACHER' || data['role_code'] == 'SS'){
    	  $('#title').attr('required', 'required').addClass('required');
    	  $('#title_lab').text('Title * ');
    	  $('#title_div').slideDown('slow');
      }else{
    	  $('#title').removeAttr('required').removeClass('required');
    	  $('#title_div').slideUp('slow');
      }
    }
  });
});

$('#form').on('change', function(){
  var form_id = $(this).val();
  var data = { 'form_id': form_id };

  $.ajax({
    url: 'src/masterfile_module/get_streams.php',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: function(data){
      var html = '<option value="">--Choose Form Stream--</option>';
      for (var i = 0; i < data.length; i++) {
        html += "<option value=\""+data[i].stream_id+"\">"+data[i].stream_name+"</option>";
      }
      $('#stream').html(html);
    }
  });
});

// address details
$('#county').on('change', function(){
  var county_id = $(this).val();
  var data = { 'county_id': county_id };

  $.ajax({
    url: 'src/masterfile_module/get_constituencies.php',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: function(data){
      var html = '<option value="">--Choose Constituency-</option>';
      for (var i = 0; i < data.length; i++) {
        html += "<option value=\""+data[i].constituency_id+"\">"+data[i].constituency_name+"</option>";
      }
      $('#const').html(html);
    }
  });
});

// login details
$('#password').on('click', function(){
  $(this).select();
});

// --  Edit the masterfile js
$('.edit_btn').on('click', function(){
	var mf_id = $(this).attr('edit-id');
	var data = { 'edit-id': mf_id };
	
//	get the selected record details and populates the edit modal box
	$.ajax({
		url: 'src/masterfile_module/get_masterfile_details.php',
		type: 'POST',
		data: data,
		dataType: 'json',
		success: function(data){
			// populate the edit modal with json data
			$('#role').val(data['role_id']);
			$('#title').val(data['title_id']);
			$('#id_no').val(data['id_no']);
			$('#dob').val(data['dob']);
			$('#reg_date').val(data['reg_date']);
			$('#surname').val(data['surname']);
			$('#fname').val(data['firstname']);
			$('#mname').val(data['middlename']);
			$('#gender').val(data('gender'));
			$('#guardian').val(data('gurdian_mf_id'));
			$('#class_id').val(data('class_id'));
			$('#stream_id').val(data('stream_id'));
		}
	});
});