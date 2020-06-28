const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerChat = get(".msger-chat");

const BOT_MSGS = [
    "Hi, how are you?",
    "Ohh... I can't understand what you trying to say. Sorry!",
    "I like to play games... But I don't know how to play!",
    "Sorry if my answers are not relevant. :))",
    "I feel sleepy! :("
];

// Icons made by Freepik from www.flaticon.com
const BOT_IMG = "https://image.flaticon.com/icons/svg/327/327779.svg";
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

let object;

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
    console.log($(this));
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

    //botResponse();
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
    //   Simple solution for small apps
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

function botResponse() {
    const r = random(0, BOT_MSGS.length - 1);
    const msgText = BOT_MSGS[r];
    const delay = msgText.split(" ").length * 1000;

    setTimeout(() => {
        appendMessage(BOT_NAME, BOT_IMG, "left", msgText);
    }, delay);
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

function random(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}
