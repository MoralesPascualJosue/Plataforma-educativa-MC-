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

let editorck;

ClassicEditor.create(document.querySelector("#editorworkv"), {
    language: "es",
    color: "red",
    image: {
        styles: [
            "full", // This option is equal to a situation where no style is applied.
            "alignLeft", // This represents an image aligned to the left.
            "alignRight", // This represents an image aligned to the right.
            "side"
        ]
    },
    table: {
        contentToolbar: [
            "tableColumn",
            "tableRow",
            "mergeTableCells",
            "tableCellProperties",
            "tableProperties"
        ]
    },
    licenseKey: ""
}).then(editor2 => {
    editorck = editor2;
    editor2.isReadOnly = true;
});

$(".entregarev").on("click", function() {
    $(".seccionToggle").slideToggle();

    $("#btn-toggle")
        .css({ visibility: "visible" })
        .text("Cerrar");
    $(".content").css({
        visibility: "hidden"
    });

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
                $contenido =
                    $contenido +
                    "<hr><hr><br><h1>Entrega " +
                    element.entregas +
                    "</h1><br></br>" +
                    element.contenido;
            });

            editorck.setData($contenido);
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
        .focusin(function() {
            $(this).css("border", "1px solid blue");
        })
        .focus();
});
