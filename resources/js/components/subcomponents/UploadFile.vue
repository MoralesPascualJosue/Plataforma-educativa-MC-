<template>
  <div class="contentfiles">
    <div class="top">
      Carga tus archivos aqui:
      <span id="numarchivos">0</span> archivos
    </div>
    <vue-dropzone
      ref="myVueDropzone"
      id="dropzone"
      :options="dropzoneOptions"
    ></vue-dropzone>
    <hr />
    <tbody id="tbe"></tbody>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  data() {
    return {
      carga: false,
      calificando: false,
      estudiante: {
        id: -1,
      },
      loading: false,
      contenidos: {},
      showModal: false,
      recursos: [],
      dropzoneOptions: {
        url: "/uploadfilee",
        dictDefaultMessage: "Selecciona o arrastra tus archivos aqui.",
        autoProcessQueue: true,
        addRemoveLinks: true,
        parallelUploads: 4,
        //acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 30, // MB,
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
            .content,
        },

        init: function () {
          var sumitButtom = document.querySelector("#sumit-all");
          let myDropzone = this;

          // sumitButtom.addEventListener("click", function () {
          //   myDropzone.processQueue();
          // });

          this.on("complete", function (data) {
            // if (
            //     this.getQueuedFiles().length == 0 &&
            //     this.getUploadingFiles().length == 0
            // ) {
            var _this = this;
            _this.removeFile(data);
            // }
          });

          this.on("success", function (file, response) {
            let numarchivos = document.getElementById("numarchivos")
              .textContent;
            var elementotr = document.createElement("tr");
            var elementotd = document.createElement("td");
            var elementotdm = document.createElement("td");
            var elementotdr = document.createElement("td");
            var elementotddata = document.createElement("td");

            elementotr.classList.add("fileitem");
            elementotd.classList.add("remover");
            elementotdr.classList.add("filename");
            elementotddata.id = "../" + response.url;
            elementotddata.setAttribute("name", response.name);

            elementotd.append("X");
            elementotdm.innerHTML =
              "<img width='30px' heigth='30px'  src='../" +
              response.icon +
              "'></td>";
            elementotdr.append(response.name);

            elementotd.addEventListener("click", function () {
              axios
                .post("/remove/" + "file", {
                  path: response.url,
                })
                .then((response) => {
                  this.parentElement.remove();
                  document.getElementById(
                    "numarchivos"
                  ).textContent = document.getElementById(
                    "tbe"
                  ).childElementCount;
                })
                .catch((error) => {
                  if (
                    error.response.status === 401 ||
                    error.response.status === 419
                  ) {
                    window.location.href = "login";
                  }
                  this.errorr = true;
                  flash("Error: intenta más tarde", "error");
                });
            });

            elementotr.append(elementotd);
            elementotr.append(elementotdm);
            elementotr.append(elementotdr);
            elementotr.append(elementotddata);

            $("#tbe").append(elementotr);
            document.getElementById(
              "numarchivos"
            ).textContent = document.getElementById("tbe").childElementCount;
          });
        },
      },
    };
  },
  components: {
    vueDropzone: vue2Dropzone,
  },
};
</script>

<style>
#tbe {
  display: block;
  padding: 1rem;
}
.contentfiles {
  background-color: white;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
  width: 100%;
  /* height: 300px; */
  border-radius: 8px;
  padding: 10px;
}

.filename {
  overflow-x: hidden;
  max-width: 193px;
}

#numarchivos {
  font-weight: 800;
}

.remover {
  padding: 4px;
  font-weight: 800;
  font-size: 20px;
  cursor: pointer;
}
.remover:hover {
  background-color: red;
}
.fileitem {
  padding: 4px;
}

.fileitem:hover {
  background-color: #f0f0f0;
}
</style>