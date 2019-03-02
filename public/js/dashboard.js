
function withSelected(e){
	document.getElementById('actionValue').value = e.target.value;
	$('#btn-masshandle').prop("disabled", false);
}

function selectAll(e){
	$('.ch-checkbox').prop('checked', e.checked);
}


$('.roundAction').change(function(){

	var row = $(this).closest("tr");

	var round = this.value;

	var day = $(this).attr('data-class');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	$.ajax({	
		url: url+'/save',
		type: 'POST',
		data: { round: round, day: day },
		success: function(data){

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
