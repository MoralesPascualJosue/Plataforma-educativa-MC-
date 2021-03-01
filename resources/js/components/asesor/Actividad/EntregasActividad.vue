<template>
  <div class="actividad-entregas-container">
    <transition name="fade" mode="out-in">
      <div v-if="!calificando" key="lista">
        <div class="actividad-entregas-header">
          <div class="actividad-entregas-header-textleft">
            Recibidos
            <span>{{ numerodeentregas }}</span> de
            <span>{{ numeromatriculados }}</span>
          </div>
          <div class="actividad-entregas-header-textright">
            Para calificar
            <span>{{ porrevisar }}</span>
          </div>
        </div>
        <table class="actividad-entregas-contenttable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Calificacion</th>
              <th scope="col">Entregas</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(estudianteb, index) in estudiantes" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ estudianteb.name }}</td>
              <td>{{ estudianteb.qualificationqualification }}</td>
              <td
                v-if="estudianteb.qualificationestado == 1"
                class="pararevision"
                @click="calificar(index)"
              >
                Para revision
              </td>
              <td
                v-else-if="estudianteb.qualificationestado == 2"
                class="calificado"
                @click="calificar(index)"
              >
                Calificado
              </td>
              <td v-else class="na">{{ estudianteb.qualificationestado }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else key="calificar">
        <div v-if="type == 'activitie'">
          <div @click="regresaralista" class="backtolist">
            Regresar a la lista
          </div>
          <transition name="slide-fade">
            <div v-if="!loading">
              <div class="actividad-entregas-header">
                <div class="actividad-entregas-header-textleft">
                  Calificacion:
                  <span>
                    {{ estudiante.qualificationqualification }}
                    <span class="fsmall">
                      <FormCalificacion
                        v-bind:estudiante="estudiante"
                        v-bind:activitie="this.actividad.activitie.id"
                        @asignar-calificacion="asignarcalificacion"
                      />
                    </span>
                  </span>
                </div>
                <div class="actividad-entregas-header-textright">
                  Nombre:
                  <span>{{ estudiante.name }}</span>
                </div>
              </div>
              <div>
                <div
                  v-for="(contenido, indexc) in contenidos.contenidos"
                  :key="indexc"
                >
                  <table class="actividad-entregas-contenttable">
                    <thead>
                      <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Contenido</th>
                        <th scope="col">Fecha de entrega</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tr>
                      <td scope="row">{{ contenido.entregas }}</td>
                      <td
                        href="javascript:void(0)"
                        @click="openFileView(contenido.contenido)"
                      >
                        <a href="javascript:void(0)">Ver</a>
                      </td>
                      <td>{{ contenido.created_at }}</td>
                      <td></td>
                    </tr>
                    <tbody
                      id="contenidowork"
                      v-html="contenido.contenido"
                    ></tbody>
                  </table>
                </div>
              </div>
            </div>
          </transition>
          <FileShow
            :show="showModal"
            v-bind:recursos="recursos"
            @close="showModal = false"
          />
        </div>
        <div v-else>
          <div @click="regresaralista" class="backtolist">
            Regresar a la lista
          </div>
          <div class="actividad-entregas-header">
            <div class="actividad-entregas-header-textleft">
              Calificación:
              <span>{{ contenidos.calificacion }}</span>
            </div>
            <div class="actividad-entregas-header-textright">
              Nombre:
              <span>{{ estudiante.name }}</span>
            </div>
          </div>
          <hr />
          <div>
            <table class="actividad-entregas-contenttable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Pregunta</th>
                  <th scope="col"></th>
                  <th scope="col">Puntaje</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(question, indexq) in contenidos.questions"
                  :key="indexq"
                >
                  <th scope="row">{{ indexq + 1 }}</th>
                  <td colspan="2">
                    <h4>{{ question.question }}</h4>
                  </td>
                  <td>
                    <div
                      class="actividad-entregas-contenttable-respuestas"
                      v-for="(respuesta, indexr) in question.respuesta"
                      :key="indexr"
                    >
                      <div class="col-8">{{ respuesta.answer }}</div>
                      <div class="col-4">
                        Puntaje:
                        <input
                          class="w-50"
                          type="number"
                          v-model="puntajes[indexq].calificacion[indexr].valor"
                        />
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td>
                    <button class="btn btn-primary" @click="guardarpuntajes">
                      Guardar puntajes
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import FormCalificacion from "../Calificacion/FormCalificacion";
import FileShow from "./FileShow";
export default {
  data() {
    return {
      type: "",
      numeromatriculados: 0,
      numerodeentregas: 0,
      porrevisar: 0,
      estudiantes: [],
      calificando: false,
      estudiante: {
        id: -1,
      },
      loading: false,
      contenidos: [],
      showModal: false,
      recursos: [],
      puntajes: [],
    };
  },
  computed: {
    suma() {
      let suma = 0;
      this.puntajes.forEach((element) => {
        suma = suma + parseInt(element);
      });
      return suma;
    },
    actividad() {
      return this.$store.getters.actividadview;
    },
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  components: {
    FormCalificacion,
    FileShow,
  },
  created() {
    let url = "/trabajos/";

    if (this.actividad.activitie.type != "activitie") {
      url = "/test/trabajos/";
    }

    axios
      .get(url + this.actividad.activitie.id)
      .then((res) => {
        this.estudiantes = res.data.estudiantes;
        this.numeromatriculados = res.data.estudiantes.length;
        this.numerodeentregas = res.data.numeroentregas;
        this.porrevisar = res.data.enrevision;
        this.type = res.data.type;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    guardarpuntajes() {
      axios
        .post("test/puntajes/" + this.actividad.id + "/" + this.estudiante.id, {
          puntajes: this.puntajes,
        })
        .then((res) => {
          this.contenidos.calificacion = res.data.calificacion;
          let estudiante = this.estudiante;
          estudiante.qualificationestado = 2;
          estudiante.qualificationqualification = res.data.calificacion;

          const index = this.estudiantes.findIndex(
            (item) => item.id === estudiante.id
          );

          this.estudiantes[index] = estudiante;
          this.actividad.entregas--;
          this.porrevisar--;
          this.$store.commit("updateactividad", this.actividad);
          this.curso.entregas--;

          flash("Puntajes guardados", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Fallo el guardar puntajes: intenta mas tarde", "error");
        });
    },
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
    asignarcalificacion(value) {
      this.estudiante.qualificationqualification = value.qualification;

      const indexe = this.estudiantes.findIndex(
        (item) => item.id === value.estudiante_id
      );
      this.estudiantes[indexe].qualificationqualification = value.qualification;
      this.estudiantes[indexe].qualificationestado = value.estado;
      this.porrevisar--;
      this.actividad.activitie.entregas--;
      this.$store.commit("updateactividad", this.actividad.activitie);
      this.curso.entregas--;
    },
    calificar(value) {
      this.estudiante = this.estudiantes[value];
      this.calificando = true;
      this.loading = true;

      if (this.type == "activitie") {
        axios
          .get(
            "/showworks/" +
              this.actividad.activitie.id +
              "/" +
              this.estudiante.id
          )
          .then((res) => {
            this.loading = false;
            this.contenidos = res.data;
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
            this.loading = false;
          });
      } else {
        axios
          .get("test/showwork/" + this.actividad.id + "/" + this.estudiante.id)
          .then((res) => {
            this.loading = false;
            this.contenidos = res.data;

            res.data.questions.forEach((element) => {
              let respu = {
                question: element.id,
                calificacion: [],
              };
              element.respuesta.forEach((res) => {
                respu.calificacion.push({
                  pregunta: res.id,
                  valor: res.qualification,
                });
              });
              this.puntajes.push(respu);
            });
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
            this.loading = false;
          });
      }
    },
    regresaralista() {
      this.calificando = false;
    },
  },
};
</script>

<style>
.actividad-entregas-header {
  display: grid;
  grid-template-columns: auto auto auto auto;
}
.actividad-entregas-header span {
  font-weight: bold;
  font-size: 20px;
}
.actividad-entregas-header-textleft {
  grid-column: 2;
}
.actividad-entregas-header-textright {
  grid-column: 3;
  text-align: end;
}
.actividad-entregas-contenttable {
  width: 100%;
}
.actividad-entregas-contenttable th {
  text-align: left;
  background-color: #fcd770;
  padding: 0.5rem;
}
.actividad-entregas-contenttable tbody tr:hover {
  background-color: #fcb036;
}
.actividad-entregas-contenttable tbody td {
  padding: 0.2rem;
}
.actividad-entregas-contenttable-respuestas {
  padding: 0.5rem;
  display: grid;
  grid-template-columns: auto;
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
  background-color: #fcd770;
  padding: 0.5rem;
  float: right;
  border: 2px solid #fcd770;
  cursor: pointer;
}

.backtolist:hover {
  font-weight: bold;
  background-color: white;
}

@media only screen and (max-width: 1050px) {
  .backtolist {
    float: inherit;
  }
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
</style>
