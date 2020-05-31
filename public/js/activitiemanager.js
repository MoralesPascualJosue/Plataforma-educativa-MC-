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

/* Activities options */

$(document).on("click", ".delete", function(event) {
    $actividad = $(this);

    $.ajax({
        type: "DELETE",
        url: "../destroyaa/" + $actividad[0].id
    })
        .done(function(data) {
            window.location.replace("../scursoc/" + data["curso"]);
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

$(".activitie-namec")
    .focusin(function() {
        $(this).css("border-bottom", "1px solid orange");
    })
    .focusout(function() {
        $data["title"] = $(this)[0].textContent;

        $(this)
            .css("border", "none")
            .attr("contenteditable", "false");

        $(this).ajaxPostt(
            "../updateaa/" + $activitie[0].id,
            "#wrap100",
            $data,
            "PUT"
        );
    });

$(document).on("click", ".edit", function(event) {
    $activitie = $(this);

    $data = {
        visible: $("#visible").val(),
        intentos: $("#intentos").val(),
        fecha_inicio: $("#fecha_inicio").val(),
        fecha_final: $("#fecha_final").val()
    };

    $(".activitie-namec")
        .attr("contenteditable", "true")
        .focus();
});

$(document).on("click", ".save", function(event) {
    $activitie = $(this);

    $data = {
        title: $(".activitie-namec")[0].textContent,
        visible: $("#visible").val(),
        intentos: $("#intentos").val(),
        fecha_inicio: $("#fecha_inicio").val(),
        fecha_final: $("#fecha_final").val()
    };

    $(this)
        .css("border", "none")
        .attr("contenteditable", "false");

    $(this).ajaxPostt(
        "../updateaa/" + $activitie[0].id,
        "#wrap100",
        $data,
        "PUT"
    );
});

function handler(e) {
    $("#fecha_final").prop("min", $("#fecha_inicio").val());
}

$(document).on("click", "#add", function(event) {
    console.log("add");

    $data = "<div>agregate</div>";
    $(".content")
        //.empty()
        .append($data);
});
