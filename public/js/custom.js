//when the dom is ready
$( function() {
    $( "#datepicker" ).datepicker();

    $('#summernote').summernote({
        height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote
    });

    if($("#categories").length){
        $("#categories").select2({
            placeholder: 'Select Categories'
        })
    }

    //allow users to create new tags
    if($("#tags").length){
        $("#tags").select2({
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);
                var count = 0
                var existsVar = false;
                if($('#tags-outer option').length > 0){
                    $('#tags-outer option').each(function(){
                        if ($(this).text().toUpperCase() == term.toUpperCase()) {
                            existsVar = true
                            return false;
                        }else{
                            existsVar = false
                        }
                    });
                    if(existsVar){
                        return null;
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    }
                }else{
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    }
                }
            },
            maximumInputLength: 20, // only allow terms up to 20 characters long
            closeOnSelect: true
        })
    }

});
        
        