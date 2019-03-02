
   $('#location').on('change', function(){
      $('#meeting_point').empty();
      var id = $('#location').val();
      $('#meeting_point').html('<option select="selected" value="">Please wait...</option>');
      $.ajax({
         url: url+'/get-meeting-points/'+id,
         type: "GET",
         dataType: "json",
         success:function(data){
            $('#meeting_point').html('<option selected="selected" value="">Please select</option>');
            $.each(data, function(key, value){
               $('#meeting_point').append('<option value="'+value+'">'+key+'</option>');
            });
        }
    });
  });
