$('.edit_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/school_details/get_stream_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#edit_id').val(data['stream_id']);
				$('#stream_name').val(data['stream_name']);
				$('#stream_code').val(data['stream_code']);
				$('#status').val(data['status']);
			}
		});
	}
});

$('.delete_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/school_details/get_stream_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#delete_id').val(data['stream_id']);
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
