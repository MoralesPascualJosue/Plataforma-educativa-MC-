$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$.fn.ajaxPosttReload = function(url, location, data, method) {
    $.ajax({
        method: method,
        url: url,
        data: data
    })
        .done(function(data) {
            window.location.replace(location + data);
        })
        .fail(function(data) {
            var errors = data.responseJSON["errors"];
            if (errors) {
                $.each(errors, function(i) {
                    alert(errors[i]);
                });
            }
        });
};

$(".entregarev").on("click", function() {
    $(".seccionToggle").slideToggle();
    $("#btn-toggle")
        .css({ visibility: "visible" })
        .text("Cerrar");
    $(".content").css({
        visibility: "hidden"
    });

    $(".vista").empty();

    $activitie = $(".activitie-name")[0].id;
    $es = $(this)[0].id;

    $.ajax({
        method: "get",
        url: "../showworks/" + $activitie + "/" + $es
    })
        .done(function(data) {
            $contenido = "";

            $(".observaciones")
                .empty()
                .append(data["detalles"].observaciones)
                .prop("id", data["estudiante"]);

            $(".calificacion")
                .empty()
                .append(data["detalles"].qualification);

            data["contenidos"].forEach(element => {
                $(".vista").append(
                    "<h1>Entrega " + element["entregas"] + "</h1><br></br>"
                );
                $(".vista").append(element["contenido"]);
            });
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

$("#btn-toggle").on("click", function() {
    $(".seccionToggle").slideToggle();

    $(this).css({ visibility: "hidden" });
    $(".content").css({
        visibility: "visible"
    });
});

$("#saves").on("click", function() {
    $data = {
        calificacion: $(".calificacion")[0].textContent,
        estudiante: $(".observaciones")[0].id,
        observaciones: $(".observaciones")[0].value
    };

    $(this).ajaxPosttReload(
        "../updateaw/" + $activitie,
        "../trabajos/",
        $data,
        "post"
    );
});

$(".calificacion").on("click", function() {
    $activitie = $(this)[0].id;

    $(".calificacion")
        .attr("contenteditable", "true")
        .empty()
        .focusin(function() {
            $(this).css("border", "1px solid blue");
        })
        .focus();
});
