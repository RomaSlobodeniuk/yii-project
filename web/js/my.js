var arguments = [
  'First', 'Second', 'Third'
];

$(document).ready(initiation(arguments));

function initiation(aaa) {
    $('.carousel').carousel();
    console.log('Initiation');

    $('#my_button').on('click', function (event) {
        event.preventDefault();
        var href = $(this).attr('href');
        aaa.forEach(function (item) {
            alert(item);
        });
    });
}
