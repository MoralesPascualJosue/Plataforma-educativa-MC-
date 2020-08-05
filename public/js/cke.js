$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(document).on("submit", ".input-area", function(e) {
    $bar = this.children[0].children[3];

    e.preventDefault();
    $form = this;

    const msgText = this.children[0].children[0].value;
    if (!msgText) return;

    var formData = new FormData($form);

    $.ajax({
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
                "progress",
                function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        $bar.setAttribute(
                            "style",
                            "width:" + percentComplete * 100 + "%"
                        );
                        if (percentComplete === 1) {
                            $bar.textContent = "procesando";
                            $bar.classList.add("complete");
                        }
                    }
                },
                false
            );
            xhr.addEventListener(
                "progress",
                function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        $bar.setAttribute(
                            "style",
                            "width:" + percentComplete * 100 + "%"
                        );
                    }
                },
                false
            );
            return xhr;
        },
        type: "POST",
        url: $form.action,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: data => {
            $bar.classList.remove("complete");
            $bar.classList.add("procesando");
            $(".work").append(
                "<div class='archivo-e'><div class='filetype'><img class='wm-100'src='" +
                    data["icon"] +
                    "'></div><div class='filename'><p>" +
                    data["name"] +
                    "</p></div><div class='fileoption'> <p class='optionf optionfd' id='" +
                    data["url"] +
                    "' name=" +
                    data["name"] +
                    "></p><a class='optionf optionfe' href='javascript:void(0);'></a></div></div>"
            );
            setTimeout(function heythere() {
                $bar.textContent = "";
                $bar.setAttribute("style", "width:0%");
                $bar.classList.remove("procesando");
            }, 1000);
        },
        error: function(data) {
            $bar.textContent = "";
            $bar.classList.remove("complete");
        }
    });
});

$(document).on("click", ".savebuttone", function(event) {
    $activitie = $(this);

    $(".optionfe").remove();

    $.ajax({
        method: "post",
        url: "/storeaw/" + $activitie[0].id,
        data: {
            contenido: $(".work")[0].innerHTML
        }
    })
        .done(function(data) {
            window.location.replace("../sactivitiec/" + data);
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

$(document).on("click", ".optionfe", function(event) {
    $archive = this.parentElement.parentElement;
    $archive.remove();
});

$(document).on("click", ".optionfd", function(event) {
    $contenido = `<iframe class="completo" src='${this.id}'>Descargar</a></p>"></iframe>`;
    $name = this.getAttribute("name") + " > Entrega";

    $.sweetModal({
        title: $name,
        width: "98%",
        margimtop: "-432.4px",
        content: $contenido,
        clases: ["rwgular"]
    });
});

$(document).on("click", ".name-r", function(event) {
    $contenido = `<iframe class="completo" src='${this.id}'></iframe>`;
    $name = this.textContent;
    console.log($name);

    $.sweetModal({
        title: $name,
        width: "98%",
        margimtop: "-432.4px",
        content: $contenido,
        clases: ["rwgular"]
    });
});

//Dropzone.autoDiscover = false;
Dropzone.options.zonedrop = {
    autoProcessQueue: false,
    addRemoveLinks: true,
    //acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    //paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 30, // MB

    init: function() {
        var sumitButtom = document.querySelector("#sumit-all");
        myDropzone = this;

        sumitButtom.addEventListener("click", function() {
            myDropzone.processQueue();
        });

        this.on("complete", function(data) {
            // if (
            //     this.getQueuedFiles().length == 0 &&
            //     this.getUploadingFiles().length == 0
            // ) {
            var _this = this;
            _this.removeFile(data);
            // }
        });

        this.on("success", function(file, response) {
            $(".work").append(
                "<div class='archivo-e'><div class='filetype'><img class='wm-100'src='../" +
                    response.icon +
                    "'></div><div class='filename'><p>" +
                    response.name +
                    "</p></div><div class='fileoption'> <p class='optionf optionfd' id='../" +
                    response.url +
                    "' name=" +
                    response.name +
                    "></p><a class='optionf optionfe' href='javascript:void(0);'></a></div></div>"
            );
        });
    }
};
