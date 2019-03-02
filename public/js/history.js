
function withSelected(e){
	document.getElementById('actionValue').value = e.target.value;
	$('#btn-masshandle').prop("disabled", false);
}

function selectAll(e){
	$('.ch-checkbox').prop('checked', e.checked);
}


$('.classAction').change(function(){

	var row = $(this).closest("tr");

	var statusIndicator = row.find("#status");

	var action = this.value;

	var class_id = $(this).attr('data-class');


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	$.ajax({	
		url: url+'/handle/individual',
		type: 'POST',
		data: { action: action, id: class_id },
		success: function(data){

			statusIndicator.text(data.message);

			statusIndicator.removeClass('pending absent attended cancelled').addClass(data.indicator);
		},
		fail: function(data){

			$("#throwableText").html(data.errors);
			$("#handleThrowable").show();
			setTimeout(function() {
				$("#handleThrowable").hide('slow')
			}, 5000);
		}


	});
});
