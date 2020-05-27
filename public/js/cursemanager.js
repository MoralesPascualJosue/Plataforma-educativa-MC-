$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

function ajaxRenderSection(url) {
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(data) {
            $("#wrap100")
                .empty()
                .append($(data));
        },
        error: function(data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function(i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

$.fn.ajaxPost = function(url, method, sectionToRender) {
    $.ajax({
        type: method,
        url: url,
        dataType: "json",
        success: function(data) {
            ajaxRenderSection(sectionToRender);
        },
        error: function(data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function(i) {
                    console.log(errors[i]);
                });
            }
        }
    });
};

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

$.fn.ajaxDelete = function(url, sectionToRender) {
    $.ajax({
        type: "DELETE",
        url: url
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

/* Side Panel  */

/* Cursos resources */

$(document).on("click", ".create", function(event) {
    $anuncio = $("#anuncio").val();

    $data = { anuncio: $anuncio };
    $(this).ajaxPostt("storea", "#anuncios", $data, "POST");
    $("#anuncio").val("");
});

$(document).on("click", ".delete", function(event) {
    $anuncio = $(this);
    $(this).ajaxDelete("destroya/" + $anuncio[0].id, "#anuncios");
});

$(".course-name")
    .focusin(function() {
        $(this).css("border-bottom", "1px solid orange");
    })
    .focusout(function() {
        $data["title"] = $(this)[0].textContent;

        $(this)
            .css("border", "none")
            .attr("contenteditable", "false");

        $(this).ajaxPostt(
            "../updateac/" + $curso[0].id,
            "#wrap100",
            $data,
            "PUT"
        );
    });

$(document).on("click", ".edit", function(event) {
    $curso = $(this);

    $data = {
        review: $(".curso-message")[0].textContent
    };

    $(".course-name")
        .attr("contenteditable", "true")
        .focus();
});

$(document).on("click", ".editm", function(event) {
    $curso = $(this);

    $data = {
        title: $(".course-name")[0].textContent
    };

    $(".cursoreview")
        .attr("contenteditable", "true")
        .focusin(function() {
            $(this).css("border-bottom", "1px solid orange");
        })
        .focus()
        .focusout(function() {
            $data["review"] = $(this)[0].textContent;

            $(this)
                .css("border", "none")
                .attr("contenteditable", "false");

            $(this).ajaxPostt(
                "../updateac/" + $curso[0].id,
                "#wrap100",
                $data,
                "PUT"
            );
        });
});

$(document).on("click", "#avatarImage", function(event) {
    var $avatarImage, $avatarInput, $avatarForm;

    $avatarImage = $("#avatarImage");
    $avatarInput = $("#avatarInput");
    $avatarForm = $("#avatarForm");

    $avatarInput.click();

    $avatarInput.on("change", function() {
        var formData = new FormData();
        formData.append("cover", $avatarInput[0].files[0]);

        $.ajax({
            url: $avatarForm.attr("action"),
            method: $avatarForm.attr("method"),
            data: formData,
            processData: false,
            contentType: false
        })
            .done(function(data) {
                $("#wrap100")
                    .empty()
                    .append($(data));
            })
            .fail(function() {
                alert("La imagen subida no tiene un formato correcto");
            });
    });
});

$(document).on("click", ".delete", function(event) {
    $curso = $(this);

    $.ajax({
        type: "DELETE",
        url: "../destroyac/" + $curso[0].id
    })
        .done(function(data) {
            window.location.replace("../inicio");
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
