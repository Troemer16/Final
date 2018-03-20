var table = $('#pro-data').DataTable();
table.column( 0 ).visible( false );



$(document).on('click', '#projects tr', function () {
    var id = $(this).attr('id');
    var link = $(location).attr('href');
    $.ajax({
        type: "POST",
        url: link,
        data: { id: id },
        success: function (data) {
            var project = data;
            $('#projectTitle').html(project.title);
            $('#projectDescript').html(project.description);
            $('#status input').each(function () {
                if ($(this).val() == project.status)
                    $(this).prop("checked", true);
            });
            $('#companyName').html("Name: " + project.companyName);
            $('#address').html("Address: " + project.address + " " + project.zipcode + " " + project.city + ", " + project.state);
            $('#siteUrl').attr("href", project.siteURL);
            $('#contactName').html("Name: " + project.contactName[0]);
            $('#contactTitle').html("Title: " + project.contactTitle[0]);
            $('#contactEmail').html("Email: " + project.email[0]);
            $('#contactPhone').html("Phone: " + project.phone[0]);
            $('#classes').empty();
            for(var i = 0; i < project.class.length; i++)
            {
                $('#classes').append('<tr>' +
                    '<td>'+project.class[i]+'</td>' +
                    '<td>'+project.instructor[i]+'</td>' +
                    '<td>'+project.quarter[i]+'</td>' +
                    '<td>'+project.year[i]+'</td>' +
                    '<td>'+project.notes[i]+'</td>' +
                    '</tr>');
            }
            $.magnificPopup.open({
                items: {
                    src: '#getProject'
                },
                type: 'inline'
            }, 0);

            $(document).on('click', '.portfolio-modal-dismiss', function(e) {
                e.preventDefault();
                $.magnificPopup.close();
            });
        },
        dataType:"json"
    });
});


$("#dialog").dialog({
    autoOpen: false
});


$("#login").on('click', function() {
    $("#dialog").dialog('open');
});