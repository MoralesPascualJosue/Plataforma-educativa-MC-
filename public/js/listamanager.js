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
    $(".vista").empty();
    $(".seccionToggle").slideDown();
    $(".list-wrap").addClass("hidden-l");

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
    $(".seccionToggle").slideUp();
    $(this).css({ visibility: "hidden" });
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

$(document).ready(function() {
    var jobCount = $("#list .in").length;
    $(".list-count").text(jobCount + " encontrados");

    $("#search-text").keyup(function() {
        //$(this).addClass('hidden');

        var searchTerm = $("#search-text").val();
        var listItem = $("#list").children("li");

        var searchSplit = searchTerm.replace(/ /g, "'):containsi('");

        //extends :contains to be case insensitive
        $.extend($.expr[":"], {
            containsi: function(elem, i, match, array) {
                return (
                    (elem.textContent || elem.innerText || "")
                        .toLowerCase()
                        .indexOf((match[3] || "").toLowerCase()) >= 0
                );
            }
        });

        $("#list li")
            .not(":containsi('" + searchSplit + "')")
            .each(function(e) {
                $(this)
                    .addClass("hiding out")
                    .removeClass("in");
                setTimeout(function() {
                    $(".out").addClass("hidden");
                }, 300);
            });

        $("#list li:containsi('" + searchSplit + "')").each(function(e) {
            $(this)
                .removeClass("hidden out")
                .addClass("in");
            setTimeout(function() {
                $(".in").removeClass("hiding");
            }, 1);
        });

        var jobCount = $("#list .in").length;
        $(".list-count").text(jobCount + " encontrados");

        //shows empty state text when no jobs found
        if (jobCount == "0") {
            $("#list").addClass("empty");
        } else {
            $("#list").removeClass("empty");
        }
    });

    /*  
     An extra! This function implements
     jQuery autocomplete in the searchbox.
     Uncomment to use :)*/

    function searchList() {
        //array of list items
        var listArray = [];

        $("#list li p").each(function() {
            var listText = $(this)
                .text()
                .trim();
            listArray.push(listText);
        });

        $("#search-text").autocomplete({
            source: listArray
        });
    }

    searchList();
});

$(document).on("click", ".optionfd", function(event) {
    $contenido = `<iframe class="completo" src='${this.id}'></iframe>`;
    $name = this.getAttribute("name");
    console.log($name);

    $.sweetModal({
        title: $name,
        width: "98%",
        margimtop: "-432.4px",
        content: $contenido,
        clases: ["rwgular"]
    });
});

$(".back-c").on("click", function() {
    $(".seccionToggle").slideUp();
    $(".vista").empty();
    $(".list-wrap").removeClass("hidden-l");
});
