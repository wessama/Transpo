
window.onload = init;

//database search engine. Initiates on page load
//and again initiates everytime a new bootstrap-tags-input input box is added
function init(){
  var courses = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: url+'/get-courses?q=%QUERY%',
      wildcard: '%QUERY%'
    },

  });

  courses.initialize();

  $('.tags-input').tagsinput({
    itemValue: 'id',
    itemText: 'title',
    maxTags: 1,
    typeaheadjs: (
    {
     hint: true,
     highlight: true,
     minLength: 2,
   },
   {           
     source: courses.ttAdapter(),
     displayKey: 'title',
     limit: Infinity,
     templates: {
      empty: [
      '<div class="list-group"><div class="list-group-item">Nothing found.</div></div>'
      ],
      pending: [
      '<div class="list-group"><div class="list-group-item">Searching...</div></div>'
      ],
      header: [
      '<div class="list-group">'
      ],
      suggestion: function(data) {
        return '<div class="list-group-item">' + data.title + '</div></div>'
      }
    }
  })
  });

  $('.tags-input').on('beforeItemAdd', function(event){
    var items = $('.tags-input').tagsinput('items');

    items.forEach(function(master) { 

      master.forEach( function (item) { 

        if(item.id == event.item.id){
          event.cancel = true;
        }

      } 

      )} 

      );
    

  });


}


//UI logic
$('#btn-reset-form').on("click", function(){
  $('.tags-input').tagsinput('removeAll');
  document.getElementById("addCoursesForm").reset();
});


var count = $('.tags-input').length;
function addRow(button) {

  //check if course input count is less than maximum no. of allowed inputs for user
  //maxCount is defined in courses.blade.php for PHP value assignment
  if(count < maxCount){
    count += 1;
    var addPhone = '<div class="col-8"><label class="form-control-label">Course <small> '+ count +' <\/small><\/label><div class="input-group"><input data-role="tags-input" name="courses[]" class="form-control tags-input" id="tags-input" ><span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="removeRow(this);" ><span class="zmdi zmdi-close"><\/span><\/button><\/span><\/div><\/div>' + " \n";
    $(addPhone).insertBefore($(button).parent());
    init();
  }else{
    if($('.sufee-alert').length){
      reAdjust();
      return;
    }
    throwError("You may not add more than "+maxCount+" courses as per your academic program");   
  }
}
   
function removeRow(button) {
  if(count == 1){
    return;
  }else{
    $(button).parent().parent().parent().remove();
    count -=1;
  }
}

function throwError(errorText){
  var throwable = '<div class="col-lg-6"><div class="form-group"><div class="sufee-alert alert with-close alert-danger alert-dismissible fade show"><span class="fa fa-warning"><strong> '+ errorText +' <\/strong><\/span><button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true" class="zmdi zmdi-close"><\/span><\/button><\/div><\/div>';
  $(throwable).insertAfter($('#errorList')); 
}

function reAdjust(){
  $("html, body").animate({
    scrollTop: $(".main-content").offset().top
  });
}