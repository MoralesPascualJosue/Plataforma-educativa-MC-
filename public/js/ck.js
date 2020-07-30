let obj;

$(document).ready(function() {
    //Código que se ejecutará al cargar la página
    $(".textb").attr("contenteditable", "true");

    jQuery.makeArray($(".list-r")).forEach(element => {
        $forme = `
        <form class='input-areafile' action='/uploadfile' method='post' enctype='multipart/form-data'>
            <div class='form-group'>
            <input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>
            <small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small>
            <button type='submit' class='btn-block'>Submit</button>
            <div class='progress'></div>
            </div>
        </form>
        `;
        $div = document.createElement("div");
        $div.innerHTML = $forme;

        if (element.nextElementSibling == null) {
            element.parentElement.append($div.children[0]);
        }
    });

    jQuery.makeArray($(".content-r")).forEach(element => {
        $ele = `<p class="remove-r">X</p><p class="editn-r">E</p>`;
        $divoptions = document.createElement("div");
        $divoptions.classList.add("options-r");
        $divoptions.innerHTML = $ele;
        element.append($divoptions);
    });
});

/*spinner input */
(function() {
    "use strict";

    function ctrls() {
        var _this = this;

        this.counter = $(".ctrl__counter-num").text();
        this.els = {
            decrement: document.querySelector(".ctrl__button--decrement"),
            counter: {
                container: document.querySelector(".ctrl__counter"),
                num: document.querySelector(".ctrl__counter-num"),
                input: document.querySelector(".ctrl__counter-input")
            },
            increment: document.querySelector(".ctrl__button--increment")
        };

        this.decrement = function() {
            var counter = _this.getCounter();
            var nextCounter = _this.counter > 1 ? --counter : counter;
            _this.setCounter(nextCounter);
        };

        this.increment = function() {
            var counter = _this.getCounter();
            var nextCounter = counter < 10 ? ++counter : counter;
            _this.setCounter(nextCounter);
        };

        this.getCounter = function() {
            return _this.counter;
        };

        this.setCounter = function(nextCounter) {
            _this.counter = nextCounter;
        };

        this.debounce = function(callback) {
            setTimeout(callback, 100);
        };

        this.render = function(hideClassName, visibleClassName) {
            _this.els.counter.num.classList.add(hideClassName);

            setTimeout(function() {
                _this.els.counter.num.innerText = _this.getCounter();
                _this.els.counter.input.value = _this.getCounter();
                _this.els.counter.num.classList.add(visibleClassName);
            }, 100);

            setTimeout(function() {
                _this.els.counter.num.classList.remove(hideClassName);
                _this.els.counter.num.classList.remove(visibleClassName);
            }, 200);
        };

        this.ready = function() {
            _this.els.decrement.addEventListener("click", function() {
                _this.debounce(function() {
                    _this.decrement();
                    _this.render("is-decrement-hide", "is-decrement-visible");
                });
            });

            _this.els.increment.addEventListener("click", function() {
                _this.debounce(function() {
                    _this.increment();
                    _this.render("is-increment-hide", "is-increment-visible");
                });
            });

            _this.els.counter.input.addEventListener("input", function(e) {
                var parseValue = parseInt(e.target.value);
                if (!isNaN(parseValue) && parseValue >= 0) {
                    _this.setCounter(parseValue);
                    _this.render();
                }
            });

            _this.els.counter.input.addEventListener("focus", function(e) {
                _this.els.counter.container.classList.add("is-input");
            });

            _this.els.counter.input.addEventListener("blur", function(e) {
                _this.els.counter.container.classList.remove("is-input");
                _this.render();
            });
        };
    }

    // init
    var controls = new ctrls();
    document.addEventListener("DOMContentLoaded", controls.ready);
})();

$(document).on("click", ".savebutton", function(event) {
    let saveb = this;
    $(".textb").attr("contenteditable", "false");
    $(".options-r").remove();

    jQuery.makeArray($(".list-r")).forEach(element => {
        if (element.nextElementSibling != null) {
            element.nextElementSibling.remove();
        }
    });

    $update = $(".edit")["0"].id;
    $.ajax({
        type: "put",
        url: "../updateat/" + $update,
        data: {
            contenido: $(".content")[0].innerHTML
        }
    })
        .done(function(data) {
            saveb.classList.add("green-b");
            setTimeout(function heythere() {
                saveb.classList.remove("green-b");
                $(".textb").attr("contenteditable", "true");
            }, 1000);
        })
        .fail(function(data) {
            var errors = data.responseJSON["errors"];
            if (errors) {
                $.each(errors, function(i) {
                    alert(errors[i]);
                });
            }

            saveb.classList.add("red-b");
        });
});

/* eventos inputs cargados  */
$(document).on("submit", ".input-areadoc", function(e) {
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
                        console.log(percentComplete);
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
            $bar.classList.add("hide");
            $bar.classList.remove("complete");

            this.parentElement.innerHTML =
                "<iframe class='wm-100'src='" +
                data +
                "' frameborder='0'></iframe>";
        },
        error: function(data) {
            $bar.textContent = "";
            $bar.classList.remove("complete");
            console.log(data);
        }
    });
});

$(document).on("submit", ".input-areaimage", function(e) {
    e.preventDefault();
    $form = this;

    const msgText = this.children[0].children[0].value;

    if (!msgText) return;

    var formData = new FormData($form);

    $.ajax({
        type: "POST",
        url: $form.action,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: data => {
            this.parentElement.innerHTML =
                "<img src='" + data + "' alt='img'class='wm-100'>";
        },
        error: function(data) {
            console.log(data);
        }
    });
});

$(document).on("submit", ".input-areavideo", function(e) {
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
                        console.log(percentComplete);
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
            $bar.classList.add("hide");
            $bar.classList.remove("complete");
            this.parentElement.innerHTML =
                "<video id='preview-player_html5_api' preload='auto' controls class='vjs-tech wm-100' playsinline='playsinline' tabindex='-1' poster=''" +
                "src='" +
                data +
                "'></video>";
        },
        error: function(data) {
            $bar.textContent = "";
            $bar.classList.remove("complete");
            console.log(data);
        }
    });
});

$(document).on("submit", ".input-areafile", function(e) {
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
                        console.log(percentComplete);
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
            $bar.classList.add("hide");
            $bar.classList.remove("complete");

            $ele = `
                <div class="img-r"><img src="../resources/icons/archivos.svg" alt="alt"></div>
                <a href="${data["url"]}" class="name-r">${data["name"]}</a>
                <div class="options-r"><p class="remove-r">X</p><p class="editn-r">E</p></div>
            `;

            $nuevob = document.createElement("li");
            $nuevob.classList.add("content-r");
            $nuevob.innerHTML = $ele;

            this.parentElement.children[0].children[0].append($nuevob);
        },
        error: function(data) {
            $bar.textContent = "";
            $bar.classList.remove("complete");
            console.log(data);
        }
    });
});
/*	Click menu toggle */
$(".toggle").on("click", function(e) {
    obj = this;
    if (flag) {
        if (!$(this).hasClass("minus")) {
            //openMenu();
            openMenu(this);
        } else {
            closeMenu(this);
        }
    }
});

$(".lock").on("click", function(e) {
    e.preventDefault();
    this.parentElement.parentElement.parentElement.remove();
});

$(".imageblock").on("click", function(e) {
    e.preventDefault();

    $elemento =
        " <form class='input-areaimage' action='/uploadfilei' method='post' enctype='multipart/form-data'>" +
        "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
        "<small id='fileHelp' class='form-text text-muted'>Selecciona una imagen Tamaño máximo 2MB</small><button type='submit' class='btn-block'>Submit</button> </div></form>";
    $content = this.parentElement.parentElement.nextElementSibling;
    $content.innerHTML = $elemento;

    closeMenu(this.parentElement.parentElement.previousElementSibling);
});

$(".videoblock").on("click", function(e) {
    e.preventDefault();

    $elemento =
        " <form class='input-areavideo' action='/uploadfilev' method='post' enctype='multipart/form-data'>" +
        "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
        "<small id='fileHelp' class='form-text text-muted'>Selecciona un video Tamaño máximo 300MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
    $content = this.parentElement.parentElement.nextElementSibling;
    $content.innerHTML = $elemento;

    closeMenu(this.parentElement.parentElement.previousElementSibling);
});

$(".docblock").on("click", function(e) {
    e.preventDefault();

    $elemento =
        " <form class='input-areadoc' action='/uploadfiled' method='post' enctype='multipart/form-data'>" +
        "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
        "<small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
    $content = this.parentElement.parentElement.nextElementSibling;
    $content.innerHTML = $elemento;

    closeMenu(this.parentElement.parentElement.previousElementSibling);
});

$(".textblock").on("click", function(e) {
    e.preventDefault();
    $elemento = "<div class='textb' contenteditable id='30'></div>";
    $content = this.parentElement.parentElement.nextElementSibling;
    $content.innerHTML = $elemento;

    closeMenu(this.parentElement.parentElement.previousElementSibling);
});

$(".resourcesblock").on("click", function(e) {
    e.preventDefault();

    $elemento = `
    <div class="list-r">
        <ul class="resources-r"></ul>
    </div>
    <form class='input-areafile' action='/uploadfile' method='post' enctype='multipart/form-data'>
        <div class='form-group'>
            <input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>
            <small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small>
            <button type='submit' class='btn-block'>Submit</button>
            <div class='progress'></div>
        </div>
    </form>
        `;
    $content = this.parentElement.parentElement.nextElementSibling;
    $content.innerHTML = $elemento;
    closeMenu(this.parentElement.parentElement.previousElementSibling);
});

/*menu options */

$(".alingleft-option").on("click", function(e) {
    this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
        "left";
});

$(".alingcenter-option").on("click", function(e) {
    this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
        "center";
});

$(".alingright-option").on("click", function(e) {
    this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
        "right";
});

$(".downfont-option").on("click", function(e) {
    let sizef =
        this.parentElement.parentElement.previousElementSibling.children[0].id -
        5;

    if (sizef > 19) {
        this.parentElement.parentElement.previousElementSibling.children[0].id = sizef;

        this.parentElement.parentElement.previousElementSibling.children[0].style.fontSize =
            sizef + "px";
    }
});

$(".upfont-option").on("click", function(e) {
    let sizef =
        parseInt(
            this.parentElement.parentElement.previousElementSibling.children[0]
                .id,
            10
        ) + 5;

    if (sizef < 111) {
        this.parentElement.parentElement.previousElementSibling.children[0].id = sizef;

        this.parentElement.parentElement.previousElementSibling.children[0].style.fontSize =
            sizef + "px";
    }
});

$(".addtextblock").on("click", function(e) {});

/**resourcecontent options **/

$(document).on("click", ".remove-r", function(event) {
    eleHide(
        $(this)
            .parent()
            .parent()
    );
});

$(document).on("click", ".editn-r", function(event) {
    $(this)
        .parent()
        .prev()
        .attr("contenteditable", "true")
        .focus();
});

$(document).on("focusout", ".name-r", function(event) {
    $(this)
        .css("border", "none")
        .attr("contenteditable", "false");
});

$(document).on("focusin", ".name-r", function(event) {
    $(this).css("border", "1px solid blue");
});

var flag = true; // Prevent menu change while animating

function openMenu(ele) {
    $toggle = ele;
    $menu = ele.nextElementSibling;
    $content = $menu.nextElementSibling;
    $menuoptions = $content.nextElementSibling;
    flag = false;

    $menu.classList.add("show");
    $menuoptions.classList.add("show-s");

    // Update toggle
    $toggle.classList.add("minus");
    $toggle.children[1].classList.add("minus");
    setTimeout(function() {
        $toggle.children[0].classList.add("stretch");
    }, 100);
    setTimeout(function() {
        $toggle.children[0].classList.remove("stretch");
    }, 300);

    // Move content
    $content.classList.add("bounce");
    setTimeout(function() {
        $content.classList.remove("bounce");
        $content.classList.add("open");
    }, 250);

    // Animate menu icons
    $menu.children[0].children[0].classList.add("animate", "move");
    $menu.children[0].children[1].classList.add("animate", "move");
    $menu.children[0].children[2].classList.add("animate", "move");
    $menu.children[0].children[3].classList.add("animate", "move");
    $menu.children[0].children[4].classList.add("animate", "move");
    $menu.children[0].children[5].classList.add("animate", "move");

    $menuoptions.children[0].children[0].classList.add("animate", "move");
    $menuoptions.children[0].children[1].classList.add("animate", "move");
    $menuoptions.children[0].children[2].classList.add("animate", "move");
    $menuoptions.children[0].children[3].classList.add("animate", "move");
    $menuoptions.children[0].children[4].classList.add("animate", "move");
    $menuoptions.children[0].children[5].classList.add("animate", "move");

    setTimeout(function() {
        $menu.children[0].children[0].classList.add("color");
        $menu.children[0].children[1].classList.add("color");
        $menu.children[0].children[2].classList.add("color");
        $menu.children[0].children[3].classList.add("color");
        $menu.children[0].children[4].classList.add("color");
        $menu.children[0].children[5].classList.add("color");

        $menuoptions.children[0].children[0].classList.add("color");
        $menuoptions.children[0].children[1].classList.add("color");
        $menuoptions.children[0].children[2].classList.add("color");
        $menuoptions.children[0].children[3].classList.add("color");
        $menuoptions.children[0].children[4].classList.add("color");
        $menuoptions.children[0].children[5].classList.add("color");
    }, 200);
    setTimeout(function() {
        flag = true;
    }, 400);
}

function closeMenu(ele) {
    $toggle = ele;
    $menu = ele.nextElementSibling;
    $content = $menu.nextElementSibling;
    $menuoptions = $content.nextElementSibling;
    flag = false;

    $menu.classList.remove("show");
    $menuoptions.classList.remove("show-s");
    // Update toggle
    $toggle.classList.remove("minus");
    $toggle.children[1].classList.remove("minus");
    $toggle.children[0].classList.add("shrink");
    setTimeout(function() {
        $toggle.children[0].classList.remove("shrink");
    }, 200);

    // Move content
    $content.classList.remove("open");
    // Reset menu icons
    setTimeout(function() {
        $menu.children[0].children[0].classList.remove(
            "animate",
            "move",
            "color"
        );
        $menu.children[0].children[1].classList.remove(
            "animate",
            "move",
            "color"
        );
        $menu.children[0].children[2].classList.remove(
            "animate",
            "move",
            "color"
        );
        $menu.children[0].children[3].classList.remove(
            "animate",
            "move",
            "color"
        );
        $menu.children[0].children[4].classList.remove(
            "animate",
            "move",
            "color"
        );
        $menu.children[0].children[5].classList.remove(
            "animate",
            "move",
            "color"
        );

        $menuoptions.children[0].children[0].classList.remove(
            "animate",
            "move",
            "color"
        );
        $menuoptions.children[0].children[1].classList.remove(
            "animate",
            "move",
            "color"
        );

        $menuoptions.children[0].children[2].classList.remove(
            "animate",
            "move",
            "color"
        );

        $menuoptions.children[0].children[3].classList.remove(
            "animate",
            "move",
            "color"
        );

        $menuoptions.children[0].children[4].classList.remove(
            "animate",
            "move",
            "color"
        );

        $menuoptions.children[0].children[5].classList.remove(
            "animate",
            "move",
            "color"
        );

        flag = true;
    }, 300);
}

$(".newblock").on("click", function(e) {
    $block = `
    <div class='toggle'><div class='x'></div><div class='y'></div></div>
    <div class='menu'>
    <ul>
    <li class='lock'><a href='javascript:void(0);'>Eliminar</a></li>
    <li class='imageblock'><a href='javascript:void(0);'>Imagen</a></li>
    <li class='videoblock'><a href='javascript:void(0);'>Video</a></li>
    <li class='docblock'><a href='javascript:void(0);'>Doc</a></li>
    <li class='textblock'><a href='javascript:void(0);'>Text</a></li>
    <li class='resourcesblock'><a href='javascript:void(0);'>Resources</a></li>
    </ul>
    </div>    
    <div class='contentblock'><div class='textb' contenteditable style="font-size: 30px;"></div></div>
    <div class='menu-options'>
    <ul>
    <li class='alingleft-option'><a href='javascript:void(0);'>Eliminar</a></li>
    <li class='alingcenter-option'><a href='javascript:void(0);'>Imagen</a></li>
    <li class='alingright-option'><a href='javascript:void(0);'>Video</a></li>
    <li class='downfont-option'><a href='javascript:void(0);'>Doc</a></li>
    <li class='upfont-option'><a href='javascript:void(0);'>Text</a></li>
    <li class='addtextblock'><a href='javascript:void(0);'>addText</a></li>
    </ul>
    </div>
    `;
    $div = document.createElement("div");
    $div.classList.add("block-s");
    $div.innerHTML = $block;

    $div.children[0].addEventListener(
        "click",
        function(e) {
            obj = this;
            if (flag) {
                if (!$(this).hasClass("minus")) {
                    //openMenu();
                    openMenu(this);
                } else {
                    closeMenu(this);
                }
            }
        },
        false
    );

    $div.children[2].children[0].id = 30;

    $div.children[1].children[0].children[0].addEventListener("click", function(
        e
    ) {
        e.preventDefault();
        this.parentElement.parentElement.parentElement.remove();
    });

    $div.children[1].children[0].children[1].addEventListener("click", function(
        e
    ) {
        e.preventDefault();

        $elemento =
            " <form class='input-areaimage' action='/uploadfilei' method='post' enctype='multipart/form-data'>" +
            "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
            "<small id='fileHelp' class='form-text text-muted'>Selecciona una imagen Tamaño máximo 2MB</small><button type='submit' class='btn-block'>Submit</button> </div></form>";
        $content = this.parentElement.parentElement.nextElementSibling;
        $content.innerHTML = $elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
    });

    $div.children[1].children[0].children[2].addEventListener("click", function(
        e
    ) {
        e.preventDefault();

        $elemento =
            " <form class='input-areavideo' action='/uploadfilev' method='post' enctype='multipart/form-data'>" +
            "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
            "<small id='fileHelp' class='form-text text-muted'>Selecciona un video Tamaño máximo 300MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
        $content = this.parentElement.parentElement.nextElementSibling;
        $content.innerHTML = $elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
    });

    $div.children[1].children[0].children[3].addEventListener("click", function(
        e
    ) {
        e.preventDefault();

        $elemento =
            " <form class='input-areadoc' action='/uploadfiled' method='post' enctype='multipart/form-data'>" +
            "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
            "<small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
        $content = this.parentElement.parentElement.nextElementSibling;
        $content.innerHTML = $elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
    });

    $div.children[1].children[0].children[4].addEventListener("click", function(
        e
    ) {
        e.preventDefault();
        $elemento = "<div class='textb' contenteditable id='30'></div>";
        $content = this.parentElement.parentElement.nextElementSibling;
        $content.innerHTML = $elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
    });

    $div.children[1].children[0].children[5].addEventListener("click", function(
        e
    ) {
        e.preventDefault();

        $elemento = `
    <div class="list-r">
        <ul class="resources-r"></ul>
    </div>
    <form class='input-areafile' action='/uploadfile' method='post' enctype='multipart/form-data'>
        <div class='form-group'>
            <input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>
            <small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small>
            <button type='submit' class='btn-block'>Submit</button>
            <div class='progress'></div>
        </div>
    </form>
        `;
        $content = this.parentElement.parentElement.nextElementSibling;
        $content.innerHTML = $elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
    });

    $div.children[3].children[0].children[0].addEventListener("click", function(
        e
    ) {
        this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
            "left";
    });

    $div.children[3].children[0].children[1].addEventListener("click", function(
        e
    ) {
        this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
            "center";
    });

    $div.children[3].children[0].children[2].addEventListener("click", function(
        e
    ) {
        this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
            "right";
    });

    $div.children[3].children[0].children[3].addEventListener("click", function(
        e
    ) {
        let sizef =
            this.parentElement.parentElement.previousElementSibling.children[0]
                .id - 5;

        if (sizef > 19) {
            this.parentElement.parentElement.previousElementSibling.children[0].id = sizef;

            this.parentElement.parentElement.previousElementSibling.children[0].style.fontSize =
                sizef + "px";
        }
    });

    $div.children[3].children[0].children[4].addEventListener("click", function(
        e
    ) {
        let sizef =
            parseInt(
                this.parentElement.parentElement.previousElementSibling
                    .children[0].id,
                10
            ) + 5;

        if (sizef < 111) {
            this.parentElement.parentElement.previousElementSibling.children[0].id = sizef;

            this.parentElement.parentElement.previousElementSibling.children[0].style.fontSize =
                sizef + "px";
        }
    });

    $(".content").append($div);
});

// Animated element removal
function eleHide(el) {
    el.animate({ opacity: "0" }, 150, function() {
        el.animate({ height: "0px" }, 150, function() {
            el.remove();
        });
    });
}
