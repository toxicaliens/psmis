$('.edit_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/academics_module/get_subject_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#edit_id').val(data['subject_id']);
				$('#subject_name').val(data['subject_name']);
				$('#subject_code').val(data['subject_code']);
				if(data['subject_status'] == 't'){
					$('#subject_status').val(1);
				}else{
					$('#subject_status').val(0);
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
			url: 'src/academics_module/get_subject_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#delete_id').val(data['subject_id']);
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
