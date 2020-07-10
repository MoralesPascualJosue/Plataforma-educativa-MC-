const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerChat = get(".msger-chat");
const msgerPart = get(".participantes");

let object;

const PERSON_IMG = $("#usr-img").attr("src");
const BOT_NAME = "BOT";
const PERSON_NAME = $(".name-user").text();

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
    $(".conversaciones").css("display", "none");
    $(".messages").css("visibility", "visible");
    $(".msger-chat").empty();
    $(".msger-header-title").text("contenido");

    $url = "/chatC/" + $(this)[0]["id"];
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
            data["participantes"].forEach(element => {
                const msgHTML = `
                    <div class="participante">
                        <div class="msg-info-name">${element["name"]}</div>
                    </div>
                `;

                msgerPart.insertAdjacentHTML("beforeend", msgHTML);
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

msgerForm.addEventListener("submit", event => {
    event.preventDefault();

    const msgText = msgerInput.value;
    if (!msgText) return;

    appendMessage(PERSON_NAME, PERSON_IMG, "right", msgText);
    msgerInput.value = "";

    $.ajax({
        type: "post",
        url: msgerForm.action,
        data: {
            body: msgText
        }
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

function chargingMessage(name, img, side, text, date) {
    //   Simple solution for small apps
    const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-img" style="background-image: url(../${img})"></div>

      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">${name}</div>
          <div class="msg-info-time">${date}</div>
        </div>

        <div class="msg-text">${text}</div>
      </div>
    </div>
  `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTop += 500;
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
    msgerChat.scrollTop += 500;
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
