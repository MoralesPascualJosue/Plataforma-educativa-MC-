let object;
const msgerChat = get(".out");
const PERSON_IMG = $(".avatar").attr("src");

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

$.fn.ajaxPosttalert = function(url, sectionToRender, data, method) {
    $.ajax({
        method: method,
        url: url,
        data: data
    })
        .done(function(data) {
            alert(data);
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

$(document).on("click", ".cerrarchat", function(event) {
    $(".conversaciones").css("display", "inherit");
    $(".messages").css("visibility", "hidden");
    $(".msger-chat").empty();
    $(".msger-header-title").text("Conversaciones");
    $(".participantes").empty();
    $(".msger").attr("id", "0");
});

$(document).on("click", ".chat-name", function(event) {
    $(".active-ms").removeClass("active-ms");
    this.classList.add("active-ms");
    $(".out").empty();
    $(".out").css("display", "block");
    $(".email-list").animate({ flex: "0%" });
    $(".cerrarms").css("display", "inherit");
    $curso = $("#curso").val();

    $url = "/chatC/" + $curso + "/" + $(this)[0]["id"];
    $.ajax({
        type: "get",
        url: $url
    })
        .done(function(data) {
            if (data.length == 0) {
                const msgHTML = `<div class="no-messages">
                            <i class="fa fa-file-o"> No tienes mensages.</i>
                        </div>`;

                msgerChat.insertAdjacentHTML("beforeend", msgHTML);
            } else {
                chargingMessage(
                    data["id"],
                    data["user"],
                    data["asunto"],
                    data["destino"],
                    data["body"],
                    data["created_at"],
                    data["cursoName"]
                );
            }
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

$(document).on("click", ".deletems", function(event) {
    object = $(this)
        .parent()
        .parent()
        .parent()
        .parent();
    object.css("visibility", "hidden");

    $(".menud").css("visibility", "visible");
    $(".menud-option-confirmar").attr("id", $(this)[0]["id"]);
    $(".box").css("opacity", "0.4");
});

$(document).on("click", ".menud-option-cancel", function(event) {
    $(".menud").css("visibility", "hidden");
    $(".box").css("opacity", "1");
    object.css("visibility", "visible");
});

$(document).on("click", ".menud-option-confirmar", function(event) {
    $(".menud").css("visibility", "hidden");
    $(".box").css("opacity", "1");

    $.ajax({
        type: "DELETE",
        url: "destroyms/" + object[0].id
    })
        .done(function(data) {
            object.remove();
            $(".email-list li[id='" + object[0].id + "']").remove();
            $(".out").fadeOut();
            $(".email-list").animate({ flex: "100%" });
            $(".active-ms").removeClass("active-ms");
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

function chargingMessage(id, user, asunto, to, text, date, curso) {
    //   Simple solution for small apps
    $asset = "../";
    const msgHTML = `
    <div class='message' id='${id}'>
        <div>
        <ul class='message-actions'>
        <li><a class='button' href='' title='Reply'></a></li >
        <li><p class='button deletems'>x</p></li>
        <li><a class='button' href='' title='Delete'></i></a></li>
        </ul><span class='date'>${date}</span>
        <img class='avatar' src='${$asset +
            user["image"]}' alt='avatar'/><h3 class='from'>${
        user["name"]
    }</h3><p id="for"></p>
        <h2 class='subject'>${asunto}</h2><p class='ng-binding'></p><p class='ng-binding'>${text}</p></div>
        <div class="subject" style="width: 50%;border-top-style: dashed;font-size: smaller;opacity: 0.5;">${
            curso.title
        }</div>
        </div>                
  `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);

    to.forEach(element => {
        const fromhtml = `
        <span class="address" id="${element.email}">
            ${element.name}
        </span>`;
        $("#for").append(fromhtml);
    });
    msgerChat.scrollTop -= 500;
}

function appendMessage(name, img, side, text) {
    const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-img" style="background-image: url(${img})"></div>

      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">${name}</div>
          <div class="msg-info-time">${formatDate(new Date())}</div>
        </div>

        <div class="msg-text">${text}</div>
      </div>
    </div>
  `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTop -= 500;
}

// Utils
function get(selector, root = document) {
    return root.querySelector(selector);
}

function formatDate(date) {
    const h = "0" + date.getHours();
    const m = "0" + date.getMinutes();

    return `${h.slice(-2)}:${m.slice(-2)}`;
}

$(document).on("click", ".nuevomso", function(event) {
    $(".nuevoms").fadeIn();
});

$(document).on("click", ".sumitmsc", function(event) {
    $(".nuevoms").fadeOut();
});

$(document).on("click", ".cerrarms", function(event) {
    $(".out").fadeOut();
    $(".email-list").animate({ flex: "100%" });
    $(".active-ms").removeClass("active-ms");
});

$(document).on("click", ".addadress", function(event) {
    $("#panel-contacts").slideToggle("slow");
});

$(document).on("click", ".sumitmse", function(event) {
    event.preventDefault();

    const msgText = $(".contentms")[0].innerHTML;
    const mssubject = $(".subjectms")[0].textContent;
    const curso = $("#curso").val();
    const destino = [];

    const to = $(".para")
        .children()
        .toArray();

    if (!msgText) return;

    $(".contentms")[0].innerHTML = "";
    $(".nuevoms").fadeOut();

    to.forEach(element => {
        destino.push(element.id);
    });

    $url = "/sendmensaje/" + curso;

    $.ajax({
        type: "post",
        url: $url,
        data: {
            body: msgText,
            asunto: mssubject,
            destino: destino
        }
    })
        .done(function(element) {
            const msgHTML = `
                    <li class="chat-name" id="${element.id}">
                <span class="date">${element.created_at}</span>
                <h3 class="from m-b-5"><img src="../${element["user"].image}" class="avatar-min"
                        alt="">${element["user"].name}</h3>
                <h2 class="subject">${element.asunto}</h2>
                </li>
                `;
            $(".email-list").prepend(msgHTML);
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

$(document).on("click", ".updatems", function(event) {
    event.preventDefault();
    $(".orange-b").removeClass("orange-b");
    $url = this.id;
    this.classList.add("orange-b");

    $.ajax({
        type: "get",
        url: $url
    })
        .done(function(data) {
            $(".email-list").empty();
            data.forEach(element => {
                const msgHTML = `
                    <li class="chat-name" id="${element.id}">
                <span class="date">${element.created_at}</span>
                <h3 class="from m-b-5"><img src="../${element["user"].image}" class="avatar-min"
                        alt="">${element["user"].name}</h3>
                <h2 class="subject">${element.asunto}</h2>
                </li>
                `;
                $(".email-list").append(msgHTML);
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

$("#grupo").change(function() {
    let contact = $("#panel-contacts").children();
    let destino = $("#panel-contacts-destino").children();

    if (this.checked) {
        $("#panel-contacts-destino").append(contact);
    } else {
        $("#panel-contacts").append(destino);
    }
});

$(function() {
    var $contacts = $("#panel-contacts"),
        $destino = $("#panel-contacts-destino");

    $("span", $contacts).draggable({
        cancel: "a.ui-icon",
        revert: "invalid",
        containment: "document",
        helper: "clone",
        cursor: "move"
    });

    $destino.droppable({
        accept: "#panel-contacts > span",
        activeClass: "ui-state-highlight",
        drop: function(event, ui) {
            restorecontact(ui.draggable);
        }
    });

    $contacts.droppable({
        accept: "#panel-contacts-destino span",
        activeClass: "custom-state-active",
        drop: function(event, ui) {
            movecontac(ui.draggable);
        }
    });

    function restorecontact($item) {
        $item.fadeOut(function() {
            var $list = $($destino).appendTo($destino);
            $item.appendTo($list).fadeIn();
        });
    }

    function movecontac($item) {
        $item.fadeOut(function() {
            $item.appendTo($contacts).fadeIn();
        });
    }
});

$(document).ready(function() {
    //si presionamos la tecla
    $("#busqueda").keyup(function() {
        var searchTerm = $("#busqueda").val();
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

        $("ul li h2")
            .not(":containsi('" + searchSplit + "')")
            .each(function(e) {
                $(this.parentElement)
                    .addClass("hiding outb")
                    .removeClass("in");
                setTimeout(function() {
                    $(".outb").addClass("hidden");
                }, 300);
            });

        $("ul li h2:containsi('" + searchSplit + "')").each(function(e) {
            $(this.parentElement)
                .removeClass("hidden outb")
                .addClass("in");
            setTimeout(function() {
                $(".in").removeClass("hiding");
            }, 300);
        });
    });
});

$(document).on("click", ".clear-b", function(event) {
    $("#busqueda").val("");
    $("ul li h2").each(function(e) {
        $(this.parentElement)
            .removeClass("hidden outb")
            .addClass("in");
        setTimeout(function() {
            $(".in").removeClass("hiding");
        }, 300);
    });
});
