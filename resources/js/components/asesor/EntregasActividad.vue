<template>
  <div class="container slideani">
    <transition name="fade" mode="out-in">
      <div v-if="!calificando" key="lista">
        <div class="row">
          <div class="col">
            Recibidos
            <span class="h3">{{numerodeentregas}}</span> de
            <span class="h3">{{numeromatriculados}}</span>
          </div>
          <div class="col">
            Para calificar
            <span class="h3">{{porrevisar}}</span>
          </div>
        </div>
        <table class="table table-hover">
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
              <th scope="row">{{index+1}}</th>
              <td>{{estudianteb.name}}</td>
              <td>{{estudianteb.qualificationqualification}}</td>
              <td
                v-if="estudianteb.qualificationestado == 1"
                class="pararevision"
                @click="calificar(index)"
              >Para revision</td>
              <td v-else-if="estudianteb.qualificationestado == 2" class="calificado">Calificado</td>
              <td v-else class="na">{{estudianteb.qualificationestado}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else key="calificar">
        <div @click="regresaralista" class="backtolist">Regresar a la lista</div>
        <transition name="slide-fade">
          <div v-if="!loading">
            <div class="row mt-3">
              <div class="col">
                Calificacion:
                <span class="h3">
                  {{estudiante.qualificationqualification}}
                  <span class="fsmall">
                    <FormCalificacion
                      v-bind:estudiante="estudiante"
                      v-bind:activitie=" this.actividad.activitie.id"
                      @asignar-calificacion="asignarcalificacion"
                    />
                  </span>
                </span>
              </div>
              <div class="col">
                Nombre:
                <span class="h3">{{estudiante.name}}</span>
              </div>
            </div>
            <div>
              <div v-for="(contenido, indexc) in contenidos.contenidos" :key="indexc">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">N°</th>
                      <th scope="col">Contenido</th>
                      <th scope="col">Fecha de entrega</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tr>
                    <td scope="row">{{contenido.entregas}}</td>
                    <td href="javascript:void(0)" @click="openFileView(contenido.contenido)">
                      <a href="javascript:void(0)">Ver</a>
                    </td>
                    <td>{{contenido.created_at}}</td>
                    <td></td>
                  </tr>
                  <tbody id="contenidowork" v-html="contenido.contenido"></tbody>
                </table>
                <hr />
              </div>
            </div>
          </div>
        </transition>
        <FileShow :show="showModal" v-bind:recursos="recursos" @close="showModal = false" />
      </div>
    </transition>
    <span
      class="spinner-border width: 3rem; height: 3rem;-sm mt-3"
      role="status"
      aria-hidden="true"
      v-if="loading"
    ></span>
  </div>
</template>

<script>
import FormCalificacion from "./FormCalificacion";
import FileShow from "./FileShow";
export default {
  data() {
    return {
      numeromatriculados: 0,
      numerodeentregas: 0,
      porrevisar: 0,
      estudiantes: [],
      calificando: false,
      estudiante: {
        id: -1
      },
      loading: false,
      contenidos: [],
      showModal: false,
      recursos: []
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    }
  },
  components: {
    FormCalificacion,
    FileShow
  },
  created() {
    axios.get("/trabajos/" + this.actividad.activitie.id).then(res => {
      this.estudiantes = res.data.estudiantes;
      this.numeromatriculados = res.data.estudiantes.length;
      this.numerodeentregas = res.data.numeroentregas;
      this.porrevisar = res.data.enrevision;
    });
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
          source: element.children[2].id
        });
      }
      this.recursos = recursos;
    },
    asignarcalificacion(value) {
      this.estudiante.qualificationqualification = value.qualification;

      const indexe = this.estudiantes.findIndex(
        item => item.id === value.estudiante_id
      );
      this.estudiantes[indexe].qualificationqualification = value.qualification;
      this.estudiantes[indexe].qualificationestado = value.estado;
      this.porrevisar--;
      this.actividad.activitie.entregas--;
      this.$store.commit("updateactividad", this.actividad.activitie);
    },
    calificar(value) {
      this.estudiante = this.estudiantes[value];
      this.calificando = true;
      this.loading = true;
      axios
        .get(
          "/showworks/" + this.actividad.activitie.id + "/" + this.estudiante.id
        )
        .then(res => {
          this.loading = false;
          this.contenidos = res.data;
        })
        .catch(res => {
          console.log(error);
        });
    },
    regresaralista() {
      this.calificando = false;
    }
  }
};
</script>

<style>
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
</style>