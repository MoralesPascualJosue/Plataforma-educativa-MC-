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

            data.forEach(element => {
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
