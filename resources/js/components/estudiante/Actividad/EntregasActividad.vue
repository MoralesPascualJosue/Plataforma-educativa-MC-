<template>
  <div class="container slideani entregasactividad-layout">
    <transition name="fade" mode="out-in">
      <div v-if="this.actividad.activitie" key="lista">
        <div class="entregasactividad-header">
          <div class="leftcontent">
            Entregas realizadas
            <span>{{ actividad.entrega }}</span> de
            <span>{{ actividad.activitie.intentos }}</span>
          </div>
          <div class="rightcontent">
            Calificacion
            <span>{{ actividad.qualification.qualification }}</span>
          </div>
        </div>

        <table
          class="table table-hover"
          v-for="(work, index) in actividad.works"
          :key="index"
        >
          <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Contenido</th>
              <th scope="col">Fecha de entrega</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tr>
            <td scope="row">{{ work.entregas }}</td>
            <td href="javascript:void(0)" @click="openFileView(work.contenido)">
              <a href="javascript:void(0)">Ver</a>
            </td>
            <td>{{ work.created_at }}</td>
            <td></td>
          </tr>
          <tbody v-html="work.contenido"></tbody>
        </table>

        <div v-if="actividad.entrega < actividad.activitie.intentos">
          <h3>Realizar entrega</h3>

          <div class="row">
            <UploadFile />
          </div>

          <table class="table table-hover mtb-40">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">
                  Asegurate de cargar tus todos tus archivos antes de entregar.
                </th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">
                  <button class="btn-registrarentrega" @click="entregar()">
                    Entregar
                  </button>
                </th>
              </tr>
            </thead>
            <!-- <tbody id="tbe"></tbody> -->
          </table>
        </div>
        <div v-else>
          <h3>Has alcando el limite de intentos.</h3>
        </div>
        <FileShow
          :show="showModal"
          v-bind:recursos="recursos"
          @close="showModal = false"
        />
      </div>
      <div v-else>
        <div class="entregasprueba-layout" v-if="actividad.estado">
          <div class="col">
            Entrega realizada el:
            <span>{{ actividad.result[0].taken_date }}</span>
          </div>
          <div class="col">
            Calificacion
            <span>{{ actividad.calificacion }}</span>
          </div>
        </div>
        <div v-else class="entregasprueba-layout">
          <div class="col">
            <h2>Sin entregas</h2>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import FileShow from "./FileShow";
import UploadFile from "../../subcomponents/UploadFile";

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
        autoProcessQueue: false,
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

          sumitButtom.addEventListener("click", function () {
            myDropzone.processQueue();
          });

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
            $("#tbe").append(
              "<tr >" +
                "<td><img width='30px' heigth='30px'  src='../" +
                response.icon +
                "'></td><td>" +
                response.name +
                "</td><td id='../" +
                response.url +
                "' name=" +
                response.name +
                "></td></tr>"
            );
          });
        },
      },
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  components: {
    FileShow,
    UploadFile,
  },
  created() {
    this.loading = true;
  },
  methods: {
    openFileView(value) {
      this.showModal = true;
      let recursos = [];
      let elementod = document.createElement("tbody");
      elementod.innerHTML = value;

      for (let index = 0; index < elementod.children.length; index++) {
        const element = elementod.children[index];
        recursos.push({
          name: element.children[1].textContent,
          source: element.children[2].id,
        });
      }
      this.recursos = recursos;
    },
    entregar() {
      let contenidoe = document.getElementById("tbe");
      let formData = new FormData();

      contenidoe.childNodes.forEach((element) => {
        element.firstChild.remove();
      });

      if (contenidoe.innerHTML == "") {
        flash("Entrega vacia", "warning");
        return "fail;";
      }
      formData.append("contenido", contenidoe.innerHTML);

      this.loading = true;
      axios
        .post("/storeaw/" + this.actividad.activitie.id, formData)
        .then((response) => {
          this.errorr = false;
          this.actividad.entrega++;
          this.actividad.works.push(response.data);
          flash("Entrega realizada", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          this.errorr = true;
          flash("Fallo la entrega: intenta mas tarde.", "error");
        })
        .finally(() => {
          contenidoe.innerHTML = "";
          if (this.actividad.entrega < this.actividad.activitie.intentos) {
            document.getElementById("numarchivos").textContent = "0";
          }
          this.loading = false;
        });
    },
  },
};
</script>

<style>
.entregasprueba-layout {
  padding: 1rem;
  font-size: 18px;
}

.entregasprueba-layout .col {
  margin-top: 0.5rem;
  background-color: #fcd770;
  border-radius: 20px;
  padding: 1rem;
}

.entregasprueba-layout span {
  background-color: white;
  padding: 0.5rem;
}

.entregasactividad-layout table {
  margin: 1rem;
  padding: 0.5rem;
  width: 100%;
}

.entregasactividad-layout thead {
  background-color: #fcd770;
  padding: 0.5rem;
}

.entregasactividad-layout td {
  text-align: center;
}

.entregasactividad-header {
  padding: 0.5rem;
}

.entregasactividad-header .leftcontent {
  float: left;
}

.entregasactividad-header .rightcontent {
  float: right;
}

.entregasactividad-header span {
  font-weight: bold;
}

.vistaa {
  background-color: blue;
}
.fsmall {
  font-size: 15px;
}
.scrollspybody {
  position: relative;
}
.backtolist {
  border-bottom: 1px solid blue;
  padding: 3px;
}

.backtolist:hover {
  font-weight: bold;
  border-bottom: 2px solid blue;
  padding: 5px;
}
.slideani {
  overflow-x: hidden;
}
.pararevision {
  background-color: #c1d3d9;
  cursor: pointer;
}
.pararevision:hover {
  border: 1px solid blue;
}
.na {
  color: red;
}
.calificado {
  color: green;
}
/*fade animation */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
/*slide-fade animation */
.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}

/* */

.archivo-e {
  background-color: #f0f0f0;
  height: 100px;
  display: inline-flex;
  border-radius: 8px;
  width: 100%;
}

.archivo-e img {
  width: 100px;
  height: 100px;
}

.archivo img {
  height: 100px;
}

.center {
  text-align: center;
  grid-column: 1 / 3;
}

.filetype {
  border-radius: 100%;
  overflow: hidden;
}

.filename {
  padding: 5px;
  align-self: center;
}

.fileoption {
  align-self: center;
}

.optionf {
  background-color: #f0f0f0;
  margin: 10px;
  border-radius: 8px;
}

.optionf:hover {
  background-color: #8292a2;
  border: 1px solid orange;
}

.optionfd {
  background-image: url("/resources/icons/icon-view.svg");
  background-size: cover;
  background-position: center;
  display: inline-block;
  width: 30px;
  height: 30px;
  padding: 10px;
}

.optionfe {
  background-image: url("/resources/icons/cerrar.svg");
  background-size: cover;
  background-position: center;
  display: inline-block;
  width: 10px;
  height: 10px;
  padding: 10px;
}

.mtb-40 {
  margin-bottom: 40px;
  margin-top: 40px;
}

.btn-registrarentrega {
  border: none;
  margin: 0.5rem;
  padding: 0.5rem;
  background-color: #fcd770;
}

.btn-registrarentrega:hover {
  background-color: white;
}
</style>