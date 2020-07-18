// const msgerForm = get(".msger-inputarea");
// const msgerInput = get(".msger-input");
// const msgerChat = get(".msger-chat");
const msgerChat = get(".out");
// const msgerPart = get(".participantes");

let object;

const PERSON_IMG = $(".avatar").attr("src");
const BOT_NAME = "BOT";
// const PERSON_NAME = $(".name-user").text();

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

$(document).on("click", ".newmessage", function(event) {
    $(".conversaciones").css("display", "none");
    $(".messages").css("visibility", "visible");
    $(".msger-chat").empty();
    $(".msger-header-title").text("contenido");

    $url = "/chat/" + $(this)[0]["id"];
    $.ajax({
        type: "get",
        url: $url
    })
        .done(function(data) {
            msgerForm.action = "/chats/chat/message/" + data["chat"].id;
            $(".msger").attr("id", data["chat"].id);
            data["messages"].forEach(element => {
                let position = "left";
                if (data["i"] == element["send"]) {
                    position = "right";
                }

                chargingMessage(
                    element["usuarioName"],
                    element["usuarioImage"],
                    position,
                    element["body"],
                    element["created_at"]
                );
            });

            if (data["state"] == "new") {
                const seccion = `
                <div class="chat" id="${data["chat"]["id"]}">
                    <div class="chat-name" id="${data["chat"]["curso_id"]}/${data["chat"]["id"]}">${data["chat"]["name"]}</div>
                    <div class="eliminarc" id="${data["chat"]["id"]}">X</div>
                </div>
                `;

                $(".conversaciones").append(seccion);
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

$(document).on("click", ".chat-name", function(event) {
    $(".active").removeClass("active");
    this.classList.add("active");
    $(".out").empty();
    $(".out").css("display", "block");
    $(".email-list").animate({ flex: "0%" });
    $(".cerrarms").css("display", "inherit");

    $url = "/chatC/" + $(this)[0]["id"];
    $.ajax({
        type: "get",
        url: $url
    })
        .done(function(data) {
            if (data["messages"].length == 0) {
                const msgHTML = `<div class="no-messages">
                            <i class="fa fa-file-o"> No tienes mensages.</i>
                        </div>`;

                msgerChat.insertAdjacentHTML("beforeend", msgHTML);
            } else {
                data["messages"].forEach(element => {
                    let position = 0;

                    if (data["participantes"][0].user_id == element["send"]) {
                        position = 1;
                    }
                    chargingMessage(
                        element["user"],
                        element["usuarioImage"],
                        position,
                        data["participantes"][position],
                        element["body"],
                        element["created_at"]
                    );
                });
            }
            data["participantes"].forEach(element => {
                const msgHTML = `
                    <div class="participante">
                        <div class="msg-info-name">${element["name"]}</div>
                    </div>
                `;

                // msgerPart.insertAdjacentHTML("beforeend", msgHTML);
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

$(document).on("click", ".eliminarc", function(event) {
    object = $(this).parent();
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
    object.remove();

    $.ajax({
        type: "DELETE",
        url: "destroycs/" + object[0].id
    })
        .done(function(data) {})
        .fail(function(data) {
            var errors = data.responseJSON["errors"];
            if (errors) {
                $.each(errors, function(i) {
                    alert(errors[i]);
                });
            }
        });
});

$(document).on("click", ".addchat", function(event) {
    console.log($(this)[0]["id"]);
    console.log($(".msger")[0]["id"]);

    $url = "chat/agregate/" + $(this)[0]["id"];
    $.ajax({
        type: "post",
        url: $url,
        data: {
            participante: $(this)[0]["id"],
            chat: $(".msger")[0]["id"]
        }
    })
        .done(function(data) {
            if (data["event"] == "agregadoc") {
                $(".conversaciones").css("display", "inherit");
                $(".messages").css("visibility", "hidden");
                $(".msger-chat").empty();
                $(".msger-header-title").text("Conversaciones");
                $(".participantes").empty();
                $(".msger").attr("id", "0");

                alert("agregadodo");
                const seccion = `
                <div class="chat" id="${data["chat"]["id"]}">
                    <div class="chat-name" id="${data["chat"]["curso_id"]}/${data["chat"]["id"]}">${data["chat"]["name"]}</div>
                    <div class="eliminarc" id="${data["chat"]["id"]}">X</div>
                </div>
                `;

                $(".conversaciones").append(seccion);
            }

            if (data["event"] == "agregado") {
                const msgHTML = `
                    <div class="participante">
                        <div class="msg-info-name">${data["participante"]["name"]}</div>
                    </div>
                `;

                msgerPart.insertAdjacentHTML("beforeend", msgHTML);
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

// msgerForm.addEventListener("submit", event => {
//     event.preventDefault();

//     const msgText = msgerInput.value;
//     if (!msgText) return;

//     appendMessage(PERSON_NAME, PERSON_IMG, "right", msgText);
//     msgerInput.value = "";

//     $.ajax({
//         type: "post",
//         url: msgerForm.action,
//         data: {
//             body: msgText
//         }
//     })
//         .done(function(data) {})
//         .fail(function(data) {
//             var errors = data.responseJSON["errors"];
//             if (errors) {
//                 $.each(errors, function(i) {
//                     alert(errors[i]);
//                 });
//             }
//         });
// });

function chargingMessage(user, img, side, to, text, date) {
    //   Simple solution for small apps
    $asset = "../";
    const msgHTML = `
    <div class='message'>
        <div>
        <ul class='message-actions'>
        <li><a class='button' href='' title='Reply'><i class='fa fa-reply fa-fw'></i></a></li >
        <li><a class='button' href='' title='Forward'><i class='fa fa-share fa-fw'></i></a></li>
        <li><a class='button' href='' title='Delete'><i class='fa fa-trash fa-fw'></i></a></li>
        </ul><span class='date'>${date}</span>
        <img class='avatar' src='${$asset +
            img}' alt='avatar'/><h3 class='from'>${
        user["name"]
    }</h3><p><span class='address'>${to.name}</span></p>
        <h2 class='subject'>active email subject</h2><p class='ng-binding'></p><p class='ng-binding'>${text}</p></div></div>
  `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
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
    $(".active").removeClass("active");
});

$(document).on("click", ".addadress", function(event) {
    $("#panel").slideToggle("slow");
});

$(document).on("click", ".sumitmse", function(event) {
    event.preventDefault();

    const msgText = $(".contentms")[0].innerHTML;
    const to = $(".para")
        .children()
        .toArray();

    if (!msgText) return;

    $(".contentms")[0].innerHTML = "";
    $(".nuevoms").fadeOut();

    to.forEach(element => {
        $url = "/chat/" + element.id;

        $.ajax({
            type: "post",
            url: $url,
            data: {
                body: msgText
            }
        })
            .done(function(data) {
                $(".email-list").empty();
                data.forEach(element => {
                    const msgHTML = `
                    <li class="chat-name" id="${element.curso_id}/${element.id}">
                <span class="date">${element["last"].created_at}</span>
                <h3 class="from m-b-5"></h3>
                <h2 class="subject">email subject</h2>
                <p class="message-snippet">${element["last"].body}</p>
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
});

$(document).on("click", ".updatems", function(event) {
    event.preventDefault();

    $url = "/chats?en=" + this.id;

    $.ajax({
        type: "get",
        url: $url
    })
        .done(function(data) {
            $(".email-list").empty();
            data.forEach(element => {
                const msgHTML = `
                    <li class="chat-name" id="${element.curso_id}/${element.id}">
                <span class="date">${element["last"].created_at}</span>
                <h3 class="from m-b-5"></h3>
                <h2 class="subject">email subject</h2>
                <p class="message-snippet">${element["last"].body}</p>
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

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("Text", ev.target.id);
}

function drop(ev) {
    var data = ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));
    ev.preventDefault();
}

$(document).ready(function() {
    var busqueda = $("#busqueda"),
        titulo = $("ul li h2");

    $(titulo).each(function() {
        var li = $(this);
        //si presionamos la tecla
        $(busqueda).keyup(function() {
            //cambiamos a minusculas
            this.value = this.value.toLowerCase();
            //
            var clase = $(".search i");
            if ($(busqueda).val() != "") {
                $(clase).attr("class", "fa fa-times");
            } else {
                $(clase).attr("class", "fa fa-search");
            }
            if ($(clase).hasClass("fa fa-times")) {
                $(clase).click(function() {
                    //borramos el contenido del input
                    $(busqueda).val("");
                    //mostramos todas las listas
                    $(li)
                        .parent()
                        .show();
                    //volvemos a añadir la clase para mostrar la lupa
                    $(clase).attr("class", "fa fa-search");
                });
            }
            //ocultamos toda la lista
            $(li)
                .parent()
                .hide();
            //valor del h3
            var txt = $(this).val();
            //si hay coincidencias en la búsqueda cambiando a minusculas
            if (
                $(li)
                    .text()
                    .toLowerCase()
                    .indexOf(txt) > -1
            ) {
                //mostramos las listas que coincidan
                $(li)
                    .parent()
                    .show();
            }
        });
    });
});
