let editorck = [];

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$.fn.ajaxPostt = function(url, sectionToRender, data, method) {
    $.ajax({
        method: method,
        url: url,
        data: data
    })
        .done(function(data) {
            $(sectionToRender)
                .empty()
                .append($(data));
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

var editorD = function(element) {
    if (editorck.state == "ready") {
    } else {
        ClassicEditor.create(document.querySelector(element), {
            toolbar: {
                items: [
                    "heading",
                    "|",
                    "fontFamily",
                    "bold",
                    "italic",
                    "fontSize",
                    "fontColor",
                    "highlight",
                    "bulletedList",
                    "numberedList",
                    "|",
                    "alignment",
                    "indent",
                    "outdent",
                    "horizontalLine",
                    "subscript",
                    "superscript",
                    "underline",
                    "|",
                    "link",
                    "imageUpload",
                    "blockQuote",
                    "insertTable",
                    "mediaEmbed",
                    "undo",
                    "redo"
                ]
            },
            language: "es",
            color: "red",
            ckfinder: {
                uploadUrl:
                    "/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json"
            },
            image: {
                // You need to configure the image toolbar, too, so it uses the new style buttons.
                toolbar: [
                    "imageTextAlternative",
                    "|",
                    "imageStyle:alignLeft",
                    "imageStyle:full",
                    "imageStyle:alignRight"
                ],
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
            }
        })
            .then(editor => {
                editorck = editor;
            })
            .catch(err => {
                console.error(err);
            });
    }
};

$(document).on("click", ".nuevotema", function(event) {
    if (editorck.state == "ready") {
    } else {
        $("#new_discussion")
            .css("display", "inherit")
            .css("z-index", "0");
        editorD("#body");
    }
});

$(document).on("click", "#cancel_discussion", function(event) {
    $("#new_discussion").css("display", "none");
    $("#new_comentario").css("display", "none");
    $("#edit_comentario").css("display", "none");
    editorck.destroy();
});

$(document).on("click", ".discuss", function(event) {
    $di = $(this)["0"].id;
    $url = "/foro/" + $di;

    $(this).ajaxPostt($url, "#wrap100", [], "get");
    history.pushState(null, "", $url);
});

$(document).on("click", ".edit", function(event) {
    $disc = $(this)["0"].id;

    $("#new_discussion")
        .css("display", "inherit")
        .css("z-index", "0");

    $.ajax({
        method: "get",
        url: "discusion/" + $disc
    })
        .done(function(data) {
            $("#title")
                .empty()
                .val(data["title"]);

            $("#body")
                .empty()
                .val(data["body"]);

            $("#category_id").val(data["fcategoria"]);

            editorD("#body");
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

$(document).on("click", ".editarcomentario", function(event) {
    $disc = $(this)["0"].id;

    $("#edit_comentario")
        .css("display", "inherit")
        .css("z-index", "0");

    $.ajax({
        method: "get",
        url: "comentario/" + $disc
    })
        .done(function(data) {
            $("#bodyeditcomentario")
                .empty()
                .val(data["body"]);

            $("#comentario").val(data["id"]);

            editorD("#bodyeditcomentario");
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

$(document).on("click", ".nuevocomentario", function(event) {
    if (editorck.state == "ready") {
    } else {
        $("#new_comentario").css("display", "inherit");

        editorD("#bodycomentario");
    }
});

$(document).on("click", ".eliminarcomentario", function(event) {
    let el = this.parentElement.parentElement;
    $.ajax({
        method: "delete",
        url: "eliminarco/" + this.id
    })
        .done(function(data) {
            el.remove();
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

$(document).on("click", ".delete", function(event) {
    $.ajax({
        method: "post",
        url: "eliminardis/" + this.id
    })
        .done(function(data) {
            $("#wrap100")
                .empty()
                .append($(data));
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
