$( "#add-input" ).click(function() {
    event.preventDefault();
    $( ".form-for-add-input" ).append( '<input class="form-control mb-4" type="text" name="answers[]" placeholder="Ответ">' );
});