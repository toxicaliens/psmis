$('.edit_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/masterfile_module/get_contactdetails.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#edit_id').val(data['contact_type_id']);
				$('#contact_type_name').val(data['contact_type_name']);
				$('#contact_type_code').val(data['contact_type_code']);
				if(data['status'] == 't'){
					$('#status').val(1);
				}else{
					$('#status').val(0);
				}
			}
		});
	}
});

$('.delete_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/masterfile_module/get_contactdetails.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#delete_id').val(data['contact_type_id']);
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
