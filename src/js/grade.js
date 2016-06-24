$('.edit_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/academics_module/get_grade_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#edit_id').val(data['grading_id']);
				$('#form').val(data['form']);
				$('#subject').val(data['subject_id']);
				$('#min').val(data['min']);
				$('#max').val(data['max']);
				$('#grade').val(data['grade']);
			}
		});
	}
});

$('.delete_btn').on('click', function(){
	var edit_id = $(this).attr('edit-id');
	var data = { 'edit_id': edit_id};

	if(edit_id != ''){
		$.ajax({
			url: 'src/academics_module/get_grade_details.php',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(data){
				$('#delete_id').val(data['grading_id']);
			}
		});
	}
});
