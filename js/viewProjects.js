var table = $('#pro-data').DataTable();
table.column( 0 ).visible( false );

function login(location) {
    if($('#login').attr('href') == 'login'){
        $("#dialog").dialog('open');
        $(document).on('click', '#dialog button', function (e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "http://troemer.greenriverdev.com/328/Final/loginproc.php",
                data: { location: location, username: $('#username').val(), password: $('#password').val() },
                success: function (data) {
                    if(data == -1)
                        alert("Error: Invalid username or password");
                    else
                        window.location.href = location;
                },
                error: function(xhr, status, error) {
                    alert(error);
                },
                dataType:"json"
            });
        });
    } else {
        $.ajax({
            type: "POST",
            url: "http://troemer.greenriverdev.com/328/Final/loginproc.php",
            data: { location: location },
            success: function (data) {
                if(data == -1)
                    alert("Error: Invalid username or password");
                else
                    window.location.href = location;
            },
            error: function(xhr, status, error) {
                alert(error);
            },
            dataType:"json"
        });
    }
}

$(document).on('click', '#login', function (e) {
    e.preventDefault();
    login("http://troemer.greenriverdev.com/328/Final/");
});

$(document).on('click', '#edit', function () {
    if($('#login').attr('href') == 'logout')
        window.location.href = "http://troemer.greenriverdev.com/328/Final/edit/" + $(this).val();
    else{
        var id = $(this).val();
        $.magnificPopup.close();
        login("http://troemer.greenriverdev.com/328/Final/edit/" + id);
    }

});

$(document).on('click', '#newProject', function (e) {
    if($('#login').attr('href') == 'login'){
        e.preventDefault();
        login("http://troemer.greenriverdev.com/328/Final/" + $(this).attr('href'));
    }
});

$("#projects tr a").click(function(e) {
    e.stopPropagation();
});

$(document).on('click', '#projects tr', function () {
    var id = $(this).attr('id');
    var link = $(location).attr('href');
    $('#status label').hide();
    $.ajax({
        type: "POST",
        url: link,
        data: { id: id },
        success: function (data) {
            var project = data;
            var header = project.title + " - ";
            if(project.links[2] !== null && project.links[2] !== "" && project.links[2] !== undefined)
                header += "<a href='"+project.links[2]+"'><i class='fab fa-github-square'></i></a>";
            if(project.links[1] !== null && project.links[1] !== "" && project.links[1] !== undefined)
                header += "<a href='"+project.links[1]+"'><i class='fab fa-trello'></i></a>";
            header += "<a href='"+project.links[0]+"'><i class='fab fa-edge'></i></a>";

            $('button#edit').val(id);
            $('#projectTitle').html(header);
            $('#projectDescript').html(project.description);
            $('#status label').each(function () {
                if ($(this).attr('value') == project.status)
                    $(this).show();
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