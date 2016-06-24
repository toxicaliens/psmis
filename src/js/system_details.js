$('.edit_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/system_manager/get_system_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#edit_id').val(data['setting_id']);
				$('#setting_name').val(data['setting_name']);
				$('#setting_code').val(data['setting_code']);
				$('#setting_value').val(data['setting_value']);
			}
		});
	}
});

$('.delete_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/system_manager/get_system_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#delete_id').val(data['setting_id']);
			}
		});
	}
});

// for bulk action
$('#delete_selected').on('click', function(){
	var delete_ids = '';
	$('td .icheckbox_flat-green.checked input').each(function(){
		var delete_id = $(this).val();
		delete_ids += delete_id+", ";
	});
	$('#delete_ids').val(delete_ids);
});