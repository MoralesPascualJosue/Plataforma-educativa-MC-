<template>
  <div>
    <button
      id="guardarcontenido"
      type="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      @click="guardarcontenido"
      class="btn btn-primary"
    >
      <p class="line-d" v-if="!loading">Guardar contenido</p>
      <span
        class="spinner-border spinner-border-sm"
        role="status"
        aria-hidden="true"
        v-if="loading"
      ></span>
      <p class="line-d" v-if="loading">Guardando...</p>
    </button>
    <div id="taskcontenido" v-html="contenido"></div>
    <div class="newblock">Agregar bloque</div>
  </div>
</template>

<script>
export default {
  props: {
    contenidoinicial: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      obj: {},
      loading: false
    };
  },
  computed: {
    contenido() {
      return this.contenidoinicial;
    },
    actividad() {
      return this.$store.getters.actividadview;
    }
  },
  beforeUpdate() {
    jQuery(function($) {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      });
      $(".block-s").removeClass("minh-n");
      $(".textb").attr("contenteditable", "true");

      jQuery.makeArray($(".list-r")).forEach(element => {
        let forme = `
        <form class='input-areafile' action='/uploadfile' method='post' enctype='multipart/form-data'>
            <div class='form-group'>
            <input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>
            <small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small>
            <button type='submit' class='btn-block'>Submit</button>
            <div class='progress'></div>
            </div>
        </form>
        `;
        let div = document.createElement("div");
        div.innerHTML = forme;

        if (element.nextElementSibling == null) {
          element.parentElement.append(div.children[0]);
        }
      });

      jQuery.makeArray($(".content-r")).forEach(element => {
        let ele = `<p class="remove-r">X</p><p class="editn-r">E</p>`;
        let divoptions = document.createElement("div");
        divoptions.classList.add("options-r");
        divoptions.innerHTML = ele;
        if (element.childElementCount == 2) {
          element.append(divoptions);
        }
      });

      /*	Click menu toggle */
      $(".toggle").on("click", function(e) {
        obj = this;
        if (flag) {
          if (!$(this).hasClass("minus")) {
            openMenu(this);
          } else {
            closeMenu(this);
          }
        }
      });
      /* Toggle menu options blocks  */
      $(".lock").on("click", function(e) {
        e.preventDefault();
        this.parentElement.parentElement.parentElement.remove();
      });

      $(".imageblock").off("click");
      $(".imageblock").on("click", function(e) {
        e.preventDefault();

        let elemento = `
         <form class='input-areaimage' action='/uploadfilei' method='post' enctype='multipart/form-data'>
        <div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>
        <small id='fileHelp' class='form-text text-muted'>Selecciona una imagen Tamaño máximo 2MB</small><button type='submit' class='btn-block'>Submit</button> </div></form>    
        `;
        let content = this.parentElement.parentElement.nextElementSibling;
        content.innerHTML = elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
      });

      $(".videoblock").on("click", function(e) {
        e.preventDefault();

        let elemento =
          " <form class='input-areavideo' action='/uploadfilev' method='post' enctype='multipart/form-data'>" +
          "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
          "<small id='fileHelp' class='form-text text-muted'>Selecciona un video Tamaño máximo 300MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
        let content = this.parentElement.parentElement.nextElementSibling;
        content.innerHTML = elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
      });

      $(".docblock").on("click", function(e) {
        e.preventDefault();

        let elemento =
          " <form class='input-areadoc' action='/uploadfiled' method='post' enctype='multipart/form-data'>" +
          "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
          "<small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
        let content = this.parentElement.parentElement.nextElementSibling;
        content.innerHTML = elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
      });

      $(".textblock").on("click", function(e) {
        e.preventDefault();
        let elemento = "<div class='textb' contenteditable id='30'></div>";
        let content = this.parentElement.parentElement.nextElementSibling;
        content.innerHTML = elemento;

        closeMenu(this.parentElement.parentElement.previousElementSibling);
      });

      $(".resourcesblock").on("click", function(e) {
        e.preventDefault();

        let elemento = `
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
        let content = this.parentElement.parentElement.nextElementSibling;
        content.innerHTML = elemento;
        closeMenu(this.parentElement.parentElement.previousElementSibling);
      });

      /*menu bottom  options */

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
          this.parentElement.parentElement.previousElementSibling.children[0]
            .id - 5;

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

      $(".addtextblock").on("click", function(e) {
        console.log("add text block");
      });

      $(".newblock").off("click");
      $(".newblock").on("click", function(e) {
        let block = `
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
        let div = document.createElement("div");
        div.classList.add("block-s");
        div.innerHTML = block;
        /* Registro de eventos para e nuevo block creado  */
        div.children[0].addEventListener(
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

        div.children[2].children[0].id = 30;

        div.children[1].children[0].children[0].addEventListener(
          "click",
          function(e) {
            e.preventDefault();
            this.parentElement.parentElement.parentElement.remove();
          }
        );

        div.children[1].children[0].children[1].addEventListener(
          "click",
          function(e) {
            e.preventDefault();

            let elemento =
              " <form class='input-areaimage' action='/uploadfilei' method='post' enctype='multipart/form-data'>" +
              "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
              "<small id='fileHelp' class='form-text text-muted'>Selecciona una imagen Tamaño máximo 2MB</small><button type='submit' class='btn-block'>Submit</button> </div></form>";
            let content = this.parentElement.parentElement.nextElementSibling;
            content.innerHTML = elemento;

            closeMenu(this.parentElement.parentElement.previousElementSibling);
          }
        );

        div.children[1].children[0].children[2].addEventListener(
          "click",
          function(e) {
            e.preventDefault();

            let elemento =
              " <form class='input-areavideo' action='/uploadfilev' method='post' enctype='multipart/form-data'>" +
              "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
              "<small id='fileHelp' class='form-text text-muted'>Selecciona un video Tamaño máximo 300MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
            let content = this.parentElement.parentElement.nextElementSibling;
            content.innerHTML = elemento;

            closeMenu(this.parentElement.parentElement.previousElementSibling);
          }
        );

        div.children[1].children[0].children[3].addEventListener(
          "click",
          function(e) {
            e.preventDefault();

            let elemento =
              " <form class='input-areadoc' action='/uploadfiled' method='post' enctype='multipart/form-data'>" +
              "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload' id='exampleInputFile'aria-describedby='fileHelp'>" +
              "<small id='fileHelp' class='form-text text-muted'>Selecciona un documento Tamaño máximo 30MB</small><button type='submit' class='btn-block'>Submit</button><div class='progress'></div></div></form>";
            let content = this.parentElement.parentElement.nextElementSibling;
            content.innerHTML = elemento;

            closeMenu(this.parentElement.parentElement.previousElementSibling);
          }
        );

        div.children[1].children[0].children[4].addEventListener(
          "click",
          function(e) {
            e.preventDefault();
            let elemento = "<div class='textb' contenteditable id='30'></div>";
            let content = this.parentElement.parentElement.nextElementSibling;
            content.innerHTML = elemento;

            closeMenu(this.parentElement.parentElement.previousElementSibling);
          }
        );

        div.children[1].children[0].children[5].addEventListener(
          "click",
          function(e) {
            e.preventDefault();

            let elemento = `
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
            let content = this.parentElement.parentElement.nextElementSibling;
            content.innerHTML = elemento;

            closeMenu(this.parentElement.parentElement.previousElementSibling);
          }
        );

        div.children[3].children[0].children[0].addEventListener(
          "click",
          function(e) {
            this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
              "left";
          }
        );

        div.children[3].children[0].children[1].addEventListener(
          "click",
          function(e) {
            this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
              "center";
          }
        );

        div.children[3].children[0].children[2].addEventListener(
          "click",
          function(e) {
            this.parentElement.parentElement.previousElementSibling.children[0].style.textAlign =
              "right";
          }
        );

        div.children[3].children[0].children[3].addEventListener(
          "click",
          function(e) {
            let sizef =
              this.parentElement.parentElement.previousElementSibling
                .children[0].id - 5;

            if (sizef > 19) {
              this.parentElement.parentElement.previousElementSibling.children[0].id = sizef;

              this.parentElement.parentElement.previousElementSibling.children[0].style.fontSize =
                sizef + "px";
            }
          }
        );

        div.children[3].children[0].children[4].addEventListener(
          "click",
          function(e) {
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
          }
        );

        $("#taskcontenido").append(div);
      });

      /*eventos sumit */
      //$(document).off("submit", ".input-areaimage");
      $(document).off("submit");
      $(document).on("submit", ".input-areaimage", function(e) {
        e.preventDefault();
        let form = this;

        const msgText = this.children[0].children[0].value;

        if (!msgText) return;

        var formData = new FormData(form);

        $.ajax({
          type: "POST",
          url: form.action,
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
        let bar = this.children[0].children[3];

        e.preventDefault();
        let form = this;

        const msgText = this.children[0].children[0].value;
        if (!msgText) return;

        var formData = new FormData(form);

        $.ajax({
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
              "progress",
              function(evt) {
                if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  bar.setAttribute(
                    "style",
                    "width:" + percentComplete * 100 + "%"
                  );
                  if (percentComplete === 1) {
                    bar.textContent = "procesando";
                    bar.classList.add("complete");
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
                  bar.setAttribute(
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
          url: form.action,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: data => {
            bar.classList.add("hide");
            bar.classList.remove("complete");
            this.parentElement.innerHTML =
              "<video id='preview-player_html5_api' preload='auto' controls class='vjs-tech wm-100' playsinline='playsinline' tabindex='-1' poster=''" +
              "src='" +
              data +
              "'></video>";
          },
          error: function(data) {
            bar.textContent = "";
            bar.classList.remove("complete");
            console.log(data);
          }
        });
      });

      $(document).on("submit", ".input-areadoc", function(e) {
        let bar = this.children[0].children[3];

        e.preventDefault();
        let form = this;

        const msgText = this.children[0].children[0].value;
        if (!msgText) return;

        var formData = new FormData(form);

        $.ajax({
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
              "progress",
              function(evt) {
                if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  bar.setAttribute(
                    "style",
                    "width:" + percentComplete * 100 + "%"
                  );
                  if (percentComplete === 1) {
                    bar.textContent = "procesando";
                    bar.classList.add("complete");
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
                  bar.setAttribute(
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
          url: form.action,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: data => {
            bar.classList.add("hide");
            bar.classList.remove("complete");

            this.parentElement.innerHTML =
              "<iframe class='wm-100'src='" +
              data +
              "' frameborder='0'></iframe>";
          },
          error: function(data) {
            bar.textContent = "";
            bar.classList.remove("complete");
            console.log(data);
          }
        });
      });

      $(document).on("submit", ".input-areafile", function(e) {
        let bar = this.children[0].children[3];

        e.preventDefault();
        let form = this;

        const msgText = this.children[0].children[0].value;
        if (!msgText) return;

        var formData = new FormData(form);

        $.ajax({
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
              "progress",
              function(evt) {
                if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  bar.setAttribute(
                    "style",
                    "width:" + percentComplete * 100 + "%"
                  );
                  if (percentComplete === 1) {
                    bar.textContent = "procesando";
                    bar.classList.add("complete");
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
                  bar.setAttribute(
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
          url: form.action,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: data => {
            bar.classList.add("hide");
            bar.classList.remove("complete");

            let ele = `
                <div class="img-r"><img src="../resources/icons/archivos.svg" alt="alt"></div>
                <a id="${data["url"]}" class="name-r" href="javascript:void(0);">${data["name"]}</a>
                <div class="options-r"><p class="remove-r">X</p><p class="editn-r">E</p></div>
            `;

            let nuevob = document.createElement("li");
            nuevob.classList.add("content-r");
            nuevob.innerHTML = ele;
            /* agregar eventos al elemento creado  */
            nuevob.children[2].children[0].addEventListener(
              "click",
              function(e) {
                eleHide(
                  $(this)
                    .parent()
                    .parent()
                );
              },
              false
            );

            nuevob.children[2].children[1].addEventListener(
              "click",
              function(e) {
                $(this)
                  .parent()
                  .prev()
                  .attr("contenteditable", "true")
                  .focus();
              },
              false
            );

            this.parentElement.children[0].children[0].append(nuevob);
          },
          error: function(data) {
            bar.textContent = "";
            bar.classList.remove("complete");
            console.log(data);
          }
        });
      });

      /**resourcecontent options **/
      $(".remove-r").click(function(e) {
        eleHide(
          $(this)
            .parent()
            .parent()
        );
      });

      $(".editn-r").click(function(e) {
        //error: no funciona
        $(this)
          .parent()
          .prev()
          .attr("contenteditable", "true")
          .focus();
      });
      /*end */
    });
  },
  methods: {
    guardarcontenido() {
      formatoparaguardarcontenido();
      let update = this.actividad.activitie.id; //id actividad
      this.loading = true;
      $.ajax({
        type: "put",
        url: "../updateat/" + update,
        data: {
          contenido: document.getElementById("taskcontenido").innerHTML
        },
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      })
        .done(function(data) {
          flash("Contenido guardado", "success");
        })
        .fail(function(data) {
          flash(
            "Fallo el guardado del contenido: intentalo mas tarde.",
            "error"
          );
        })
        .always(() => {
          this.loading = false;
        });
    }
  }
};

let obj;

function formatoparaguardarcontenido() {
  $(".block-s").addClass("minh-n");
  $(".textb").attr("contenteditable", "false");
  $(".options-r").remove();
  jQuery.makeArray($(".list-r")).forEach(element => {
    if (element.nextElementSibling != null) {
      element.nextElementSibling.remove();
    }
  });
}
// Animated element removal
function eleHide(el) {
  el.animate({ opacity: "0" }, 150, function() {
    el.animate({ height: "0px" }, 150, function() {
      el.remove();
    });
  });
}

// Menu options

var flag = true; // Prevent menu change while animating

function openMenu(ele) {
  let toggle = ele;
  let menu = ele.nextElementSibling;
  let content = menu.nextElementSibling;
  let menuoptions = content.nextElementSibling;
  flag = false;

  menu.classList.add("show");
  menuoptions.classList.add("show-s");

  // Update toggle
  toggle.classList.add("minus");
  toggle.children[1].classList.add("minus");
  setTimeout(function() {
    toggle.children[0].classList.add("stretch");
  }, 100);
  setTimeout(function() {
    toggle.children[0].classList.remove("stretch");
  }, 300);

  // Move content
  content.classList.add("bounce");
  setTimeout(function() {
    content.classList.remove("bounce");
    content.classList.add("open");
  }, 250);

  // Animate menu icons
  menu.children[0].children[0].classList.add("animate", "move");
  menu.children[0].children[1].classList.add("animate", "move");
  menu.children[0].children[2].classList.add("animate", "move");
  menu.children[0].children[3].classList.add("animate", "move");
  menu.children[0].children[4].classList.add("animate", "move");
  menu.children[0].children[5].classList.add("animate", "move");

  menuoptions.children[0].children[0].classList.add("animate", "move");
  menuoptions.children[0].children[1].classList.add("animate", "move");
  menuoptions.children[0].children[2].classList.add("animate", "move");
  menuoptions.children[0].children[3].classList.add("animate", "move");
  menuoptions.children[0].children[4].classList.add("animate", "move");
  menuoptions.children[0].children[5].classList.add("animate", "move");

  setTimeout(function() {
    menu.children[0].children[0].classList.add("color");
    menu.children[0].children[1].classList.add("color");
    menu.children[0].children[2].classList.add("color");
    menu.children[0].children[3].classList.add("color");
    menu.children[0].children[4].classList.add("color");
    menu.children[0].children[5].classList.add("color");

    menuoptions.children[0].children[0].classList.add("color");
    menuoptions.children[0].children[1].classList.add("color");
    menuoptions.children[0].children[2].classList.add("color");
    menuoptions.children[0].children[3].classList.add("color");
    menuoptions.children[0].children[4].classList.add("color");
    menuoptions.children[0].children[5].classList.add("color");
  }, 200);
  setTimeout(function() {
    flag = true;
  }, 400);
}

function closeMenu(ele) {
  let toggle = ele;
  let menu = ele.nextElementSibling;
  let content = menu.nextElementSibling;
  let menuoptions = content.nextElementSibling;
  flag = false;

  menu.classList.remove("show");
  menuoptions.classList.remove("show-s");
  // Update toggle
  toggle.classList.remove("minus");
  toggle.children[1].classList.remove("minus");
  toggle.children[0].classList.add("shrink");
  setTimeout(function() {
    toggle.children[0].classList.remove("shrink");
  }, 200);

  // Move content
  content.classList.remove("open");
  // Reset menu icons
  setTimeout(function() {
    menu.children[0].children[0].classList.remove("animate", "move", "color");
    menu.children[0].children[1].classList.remove("animate", "move", "color");
    menu.children[0].children[2].classList.remove("animate", "move", "color");
    menu.children[0].children[3].classList.remove("animate", "move", "color");
    menu.children[0].children[4].classList.remove("animate", "move", "color");
    menu.children[0].children[5].classList.remove("animate", "move", "color");

    menuoptions.children[0].children[0].classList.remove(
      "animate",
      "move",
      "color"
    );
    menuoptions.children[0].children[1].classList.remove(
      "animate",
      "move",
      "color"
    );

    menuoptions.children[0].children[2].classList.remove(
      "animate",
      "move",
      "color"
    );

    menuoptions.children[0].children[3].classList.remove(
      "animate",
      "move",
      "color"
    );

    menuoptions.children[0].children[4].classList.remove(
      "animate",
      "move",
      "color"
    );

    menuoptions.children[0].children[5].classList.remove(
      "animate",
      "move",
      "color"
    );

    flag = true;
  }, 300);
}
</script>

<style>
.block-s {
  margin-left: 2.5%;
  min-height: 300px;
  scrollbar-width: thin;
  grid-column: 1 / 3;
  text-align: center;
}

iframe {
  min-height: 500px;
  width: 100%;
}

.wm-100 {
  max-width: 100%;
}

/*	Device & Screen */
div.contentblock {
  height: 100%;
  width: 100%;
  background: white;
  -webkit-transition: all 250ms ease;
  -moz-transition: all 250ms ease;
  -ms-transition: all 250ms ease;
  -o-transition: all 250ms ease;
  transition: all 250ms ease;
}
div.contentblock.bounce {
  -webkit-transform: translate3d(70px, -65px, 0px);
  -moz-transform: translate3d(70px, -65px, 0px);
  -o-transform: translate3d(70px, -65px, 0px);
  transform: translate3d(70px, -65px, 0px);
}
div.contentblock.open {
  -webkit-transform: translate3d(60px, -55px, 0px);
  -moz-transform: translate3d(60px, -55px, 0px);
  -o-transform: translate3d(60px, -55px, 0px);
  transform: translate3d(60px, -55px, 0px);
}

/*	Toggle & Menu */
div.toggle {
  height: 39px;
  width: 47px;
  position: absolute;
  /* left: 24%; */
  z-index: 500;
  cursor: pointer;
  background-color: #262626;
}
div.x,
div.y {
  position: absolute;
  margin: auto;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  background: #fff;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -ms-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
}
div.x {
  height: 4px;
  width: 30px;
}
div.y {
  height: 30px;
  width: 4px;
}
div.x.stretch {
  width: 40px;
}
div.x.shrink {
  width: 15px;
}
div.y.minus {
  height: 0px;
}

div.menu {
  height: 22em;
  width: 40px;
  position: absolute;
  /* left: 24%; */
  overflow: hidden;
}

div.menu ul {
  list-style: none;
  padding: 0px;
  margin: 0px;
  height: 150px;
  width: 35px;
  position: absolute;
  top: 45px;
  left: 11px;
  z-index: -1;
}
div.menu ul li {
  margin-top: 10px;
}
div.menu ul li a {
  display: block;
  height: 31px;
  width: 31px;
  text-indent: -9999px;
  font-size: 0px;
  background: #375585 center center;
}
div.menu ul li.animate a {
  -webkit-transition: all 300ms ease-out;
  -moz-transition: all 300ms ease-out;
  -ms-transition: all 300ms ease-out;
  -o-transition: all 300ms ease-out;
  transition: all 300ms ease-out;
}
div.menu ul li.lock a {
  background-image: url("/resources/icons/am-delete.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, -30px, 0px);
  -moz-transform: translate3d(-50px, -30px, 0px);
  -o-transform: translate3d(-50px, -30px, 0px);
  transform: translate3d(-50px, -30px, 0px);
}
div.menu ul li.imageblock a {
  background-image: url("/resources/icons/am-image1.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 0px, 0px);
  -moz-transform: translate3d(-50px, 0px, 0px);
  -o-transform: translate3d(-50px, 0px, 0px);
  transform: translate3d(-50px, 0px, 0px);
}
div.menu ul li.videoblock a {
  background-image: url("/resources/icons/am-video.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.docblock a {
  background-image: url("/resources/icons/am-pdf.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.textblock a {
  background-image: url("/resources/icons/am-text.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.resourcesblock a {
  background-image: url("/resources/icons/coloeccion-box.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.color a {
  background-color: #f0f0f0;
}
div.menu ul li.move a {
  -webkit-transform: translate3d(0px, 0px, 0px);
  -moz-transform: translate3d(0px, 0px, 0px);
  -o-transform: translate3d(0px, 0px, 0px);
  transform: translate3d(0px, 0px, 0px);
}

/**/
div.menu-options {
  height: 35px;
  width: 70%;
  position: absolute;
  overflow: hidden;
  margin-top: -50px;
}

div.menu-options ul {
  list-style: none;
  padding: 0px;
  margin: 0px;
  position: absolute;
  left: 11px;
  z-index: -1;
  width: 100%;
  height: 35px;
  top: -15px;
}
div.menu-options ul li {
  margin-left: 10px;
  display: inline;
}
div.menu-options ul li a {
  display: inline-block;
  height: 31px;
  width: 31px;
  text-indent: -9999px;
  font-size: 0px;
  background: #375585 center center;
}

div.menu-options ul li.animate a {
  -webkit-transition: all 300ms ease-out;
  -moz-transition: all 300ms ease-out;
  -ms-transition: all 300ms ease-out;
  -o-transition: all 300ms ease-out;
  transition: all 300ms ease-out;
}

div.menu-options ul li.alingleft-option a {
  background-image: url("/resources/icons/text-aling-left.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}
div.menu-options ul li.alingcenter-option a {
  background-image: url("/resources/icons/text-aling-center.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.alingright-option a {
  background-image: url("/resources/icons/text-aling-right.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.downfont-option a {
  background-image: url("/resources/icons/font-down.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.upfont-option a {
  background-image: url("/resources/icons/font-up.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.addtextblock a {
  background-image: url("/resources/icons/edit-field-type-text.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.color a {
  background-color: #f0f0f0;
}
div.menu-options ul li.move a {
  -webkit-transform: translate3d(0px, 0px, 0px);
  -moz-transform: translate3d(0px, 0px, 0px);
  -o-transform: translate3d(0px, 0px, 0px);
  transform: translate3d(0px, 0px, 0px);
}

/**/

.newblock {
  width: 100%;
  border-radius: 8px;
  text-align: center;
  cursor: pointer;
  padding: 10px;
}

.newblock:hover {
  background-color: #f0f0f0;
  border: 1px solid #262626;
}

/* input */
.input-area {
  width: 100%;
  height: 100%;
  display: flex;
  background: white;
  align-items: center;
  padding: 2rem;
}

#taskcontenido .form-group {
  width: 100%;
  border: 5px dashed #262626;
  padding: 3rem 2rem;
  overflow: hidden;
}

#fileHelp {
  display: inherit;
}

.progress {
  background: red;
  display: block;
  height: 20px;
  text-align: center;
  transition: width 0.3s;
  width: 0;
  overflow: hidden;
  margin-top: 10px;
}

.complete {
  background-color: green;
  color: white;
}

.progress.hide {
  opacity: 0;
  transition: opacity 1.3s;
}

.btn-block {
  padding: 10px;
  font-size: 20px;
  border-radius: 8px;
  background-color: orange;
}

.btn-block:hover {
  background-color: #8292a2;
}

.textb {
  padding: 10px;
  min-width: 110px;
  min-height: 110px;
  font-size: x-large;
  font-weight: lighter;
  line-height: 1.2em;
  padding-bottom: 45px;
}

.textb:focus {
  background-color: white;
}

.btn-save {
  width: 100%;
  border-radius: 8px;
  background-color: orange;
  height: 35px;
}

.btn-save:hover {
  background-color: #8292a2;
}

#fecha_inicio,
#fecha_final {
  z-index: 5;
}

.green-b {
  background-color: #60e85e;
}

.red-b {
  background-color: red;
}

.show {
  z-index: 100;
}
.show-s {
  z-index: 99;
}
@media (max-width: 1050px) {
  .item1 {
    grid-column: 1 / 6;
  }
  .item2 {
    grid-column: 1 / 6;
  }
}

.name-r {
  display: inline-block;
  width: 75%;
}

.img-r {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: orange;
  margin-left: 50px;
  margin-top: -25px;
  display: inline-block;
}

.img-r img {
  width: 100%;
  height: 100%;
}

.content-r {
  background: white;
  list-style: none;
  width: 100%;
  display: inline-flex;
  border-top: 25px solid orange;
  margin-top: 10px;
}

.resources-r {
  border: 1px solid gray;
  padding: 10px;
}

.options-r {
  display: inline-flex;
  float: right;
  font-weight: 700;
}

.options-r p {
  padding: 5px;
  background-color: white;
  cursor: pointer;
  font-size: 20px;
}

.options-r p:hover {
  background-color: #8292a2;
}

.sweet-modal-box {
  height: 80%;
}

.sweet-modal-content {
  height: 100%;
}

.completo {
  width: 100%;
  height: 100%;
}

.editbutton {
  display: none;
}

.minh-n {
  min-height: inherit;
}
</style>