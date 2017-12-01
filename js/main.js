$(document).ready(function(){
	// $('.open-navBtn').click(function(){
	// 	$('.responsive-nav').slideToggle(700);
	// 	$('.bg-cover').fadeToggle(698);
	// });

	$('.delete-btn').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).parent().submit();
	});

	// Edit Note code
	var hasChanged = false;
	var savedDesc = '';
	var description = $('#edit-form .todoDesc');
	var hasSaved = false;
	$('#edit-form .todoDesc').click(function(){
		
		if(hasChanged == false && hasSaved == false){
			savedDesc = $(this).html();
			hasSaved = true;
		}
	});

	$('#edit-form .todoDesc').change(function(){
		hasChanged = true;
		console.log(hasChanged);

		if(hasChanged == true){
			$('#edit-form .add-btn').fadeIn("fast");
			$('#edit-form .cancel-btn').fadeIn("fast");
		}
		else{
			$('#edit-form .add-btn').fadeOut("fast");
			$('#edit-form .cancel-btn').fadeOut("fast");
		}
	});



	$(description).keyup(function(){

		hasChanged = true;
		
		if(hasChanged == true){
			$('#edit-form .add-btn').fadeIn("fast");
			$('#edit-form .cancel-btn').fadeIn("fast");
		}
		else{
			$('#edit-form .add-btn').fadeOut("fast");
			$('#edit-form .cancel-btn').fadeOut("fast");
		}
	});

	$('#edit-form .cancel-btn').click(function(e){
		hasChanged = false;
		$(description).val(savedDesc);
		$(this).fadeOut("fast");
		$('#edit-form .add-btn').fadeOut("fast");
	});

	$('.back-btn').click(function(e){
		if(hasChanged == true){
			
			if(confirm("You are about to leave this page. Any unsaved changes will be lost.") == true){
				window.location.assign($(this).attr('href'));
			}
			else{
				e.preventDefault();
			}
		}
		

	});

	$('#edit-form').submit(function(e){
		e.preventDefault();
		if(hasChanged == true){
			var url = $(this).attr('action');
			var desc = $('#edit-form .todoDesc').val();
			var id = $('#updateId').val();
			var time = $('#updateTime').val();
			var data = {'description' : desc, 'update_id' : id, 'updatedTime' : time};
			$.ajax({
				data: data,
				url: "processes.php",
				type: "POST",
				success: function(result){
					alert();
					console.log(result);
					hasChanged = false;
					$('#edit-form .add-btn').fadeOut("fast");
					$('#edit-form .cancel-btn').fadeOut("fast");
				}
			});
		}
	});

	$('.my-row').click(function(e){
		window.location.assign($(this).children('.note').attr('href'));
		
	});
});