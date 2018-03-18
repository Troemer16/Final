var table = $('#pro-data').DataTable();
table.column( 0 ).visible( false );

$(document).on('click', 'tr', function () {
    var id = $(this).attr('id');
    var link = $(location).attr('href');
    $.ajax({
        type: "POST",
        url: link,
        data: { id: id },
        success: function (data) {
            var project = data;
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