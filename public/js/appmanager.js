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
            //location.reload();
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

$(document).on("click", "#perfil-nav-a", function(event) {
    $url = "perfil";
    $(this).ajaxPost($url, "get", $url);

    history.pushState(null, "", $url);

    $(".w--current").removeClass("w--current");
    $(this).addClass("w--current");
});

$(document).on("click", "#home-nav-a", function(event) {
    $url = "home";
    $(this).ajaxPost($url, "get", $url);

    $(".w--current").removeClass("w--current");
    $(this).addClass("w--current");

    history.pushState(null, "", $url);
});

$(document).on("click", "#clases-nav-a", function(event) {
    $url = "inicio";
    $(this).ajaxPost($url, "get", $url);

    $(".w--current").removeClass("w--current");
    $(this).addClass("w--current");

    history.pushState(null, "", $url);
});

$(document).on("click", ".page-link", function(event) {
    //paginate
    $url = this.name;
    $(this).ajaxPost($url, "get", $url);

    history.pushState(null, "", $url);
});

/* Anuncios resources */

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

$(document).on("click", ".edit", function(event) {
    $anuncio = $(this);
    $("#at-" + $anuncio[0].id)
        .attr("contenteditable", "true")
        .focusin(function() {
            $(this).css("border", "1px solid orange");
        })
        .focus()
        .focusout(function() {
            $(this)
                .css("border", "none")
                .attr("contenteditable", "false");
            $(this).ajaxPostt(
                "updatea/" + $anuncio[0].id,
                "#anuncios",
                { anuncio: $(this)[0].textContent },
                "PUT"
            );
        });
});

$(document).on("click", ".create-cl", function(event) {
    $anuncio = $(this);

    $(this).ajaxPostt("storeac", "#wrap100", { top: "top" }, "POST");
});

$(document).on("click", ".editar-perfil", function(event) {
    $(this).attr("style", "visibility: hidden");
    $(".guardar-perfil").attr("style", "visibility: visible");
    $(".cancelar-perfil").attr("style", "visibility: visible");
    $(".editable")
        .attr("contenteditable", "true")
        .css("border", "1px solid orange");
});

$(document).on("click", ".guardar-perfil", function(event) {
    $perfil = $(this);

    $data = {
        name: $("#editable-nombre")[0].textContent,
        email: $("#editable-correo")[0].textContent,
        telephone: $("#editable-numero")[0].textContent,
        institute: $("#editable-nombreinstituto")[0].textContent,
        department: $("#editable-departamento")[0].textContent,
        bio: "description"
    };

    $(this).attr("style", "visibility: hidden");

    $(".editar-perfil").attr("style", "visibility: visible");

    $(".editable")
        .attr("contenteditable", "false")
        .css("border", "none");

    $(this).ajaxPostt("updatePerfil", "#wrap100", $data, "PUT");
});

$(document).on("click", ".cancelar-perfil", function(event) {
    $url = "perfil";
    $(this).ajaxPost($url, "get", $url);
});

$(document).on("click", "#avatarImage", function(event) {
    var $avatarImage, $avatarInput, $avatarForm;

    $avatarImage = $("#avatarImage");
    $avatarInput = $("#avatarInput");
    $avatarForm = $("#avatarForm");

    $avatarInput.click();

    $avatarInput.on("change", function() {
        var formData = new FormData();
        formData.append("image", $avatarInput[0].files[0]);

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
