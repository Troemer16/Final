var table = $('#pro-data').DataTable();
table.column( 0 ).visible( false );

// (function($) {
//     "use strict"; // Start of use strict
//     // Modal popup$(function () {
//     // From an element with ID #popup
//     $('tbody').magnificPopup({
//         items: {
//             src: '#getProject',
//             type: 'inline'
//         }
//     });
//
//     $(document).on('click', '.portfolio-modal-dismiss', function(e) {
//         e.preventDefault();
//         $.magnificPopup.close();
//     });
// })(jQuery);

$(document).on('click', 'tr', function () {
    var id = $(this).attr('id');
    $.post($(location).attr('href'), 'id=' + id, function (data) {
        //if time permits come back and use json encode/decode
        var project = data.split('<@>');
        $('#projectTitle').html(project[0]);
        $('#projectDescript').html(project[1]);
        $('#status input').each(function () {
            if ($(this).val() == project[2])
                $(this).prop("checked", true);
        });
        $.magnificPopup.open({
            items: {
                src: '#getProject'
            },
            type: 'inline'

            // You may add options here, they're exactly the same as for $.fn.magnificPopup call
            // Note that some settings that rely on click event (like disableOn or midClick) will not work here
        }, 0);

        $(document).on('click', '.portfolio-modal-dismiss', function(e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    })
        .fail(function () {
            alert("Error");
        })
});

$("#dialog").dialog({
    autoOpen: false
});

$("#login").on('click', function() {
    $("#dialog").dialog('open');
});

// $(function() {
//     var params = {
// // Request parameters
//     };
//
//     $.ajax({
//         url: "https://www.haloapi.com/metadata/h5/metadata/campaign-missions?" + $.param(params),
//         type: "GET",
// // Request body
//         data: "this.val()",
//     })
//         .done(function(data) {
//             $.each(data, function (index, mission) {
//                 $("#name").append("<h1>"+ mission.name + "</h1>");
//                 $("#name").append("<h3>Mission Number: "+ mission.missionNumber +
//                     "&emsp; Team Type: "+ mission.type + "</h3>");
//                 $("#name").append("<p>" + mission.description + "</p>");
//                 $("#name").append('<img src="'+ mission.imageUrl +'" width="500"><hr>' );
//             });
//         })
//         .fail(function() {
//             alert("Error");
//         });
// });