$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(document).on("click", ".savebutton", function(event) {
    $activitie = $(this);
    console.log("stprage");

    $.ajax({
        method: "post",
        url: "/storeaw/" + $activitie[0].id,
        data: { contenido: editorck.getData() }
    })
        .done(function(data) {
            window.location.replace("../sactivitiec/" + data);
        })
        .fail(function(data) {
            var errors = data.responseJSON["errors"];
            if (errors) {
                $.each(errors, function(i) {
                    alert(errors[i]);
                });
            }
        });
});
