$('#cClient').change(function () {
    var id = $(this).val();
    var link = $(location).attr('href');
    $.ajax({
        type: "POST",
        url: link,
        data: { id: id },
        success: function (data) {
            var client = data;
            // $('#projectTitle').html(client[0]);
            // $('#projectDescript').html(client[1]);
            // $('#status input').each(function () {
            //     if ($(this).val() == project[2])
            //         $(this).prop("checked", true);
            // });
        },
        dataType:"json"
    });
});