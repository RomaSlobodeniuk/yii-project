$(document).ready(function () {
    $("form.comments button[type='submit']").on('click', function(event){
        event.preventDefault();

        var ajaxUrl = window.location.origin + '/ajax/index';
        var commentsForm = $('form.comments');
        var formData = commentsForm.serialize();
        var commentsBlock = $('.comments-block');

        $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.result) {
                    commentsBlock.prepend(response.html);
                }
            }
        });
    });
});
