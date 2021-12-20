<template>
  <div class="lista-actividades-layout">
    <div class="lista-actividades-cursoinfo">
      <div class="lista-actividades-cursooptions">
        <div class="lista-actividades-cursooptions-textheader">
          Detalles y acciones
        </div>
        <a href="javascript:void(0)" @click="eliminarCurso">
          <div>Salir del curso</div>
        </a>
        <a href="javascript:void(0)" @click="$emit('ver-resumen')">
          <div>Resumen curso</div>
        </a>
        <div>
          Actividades para la semana:
          <p class="weekcolor">{{ actividadessemana }}</p>
        </div>
        <div>
          Actividades para hoy:
          <p class="diacolor">{{ actividadeshoy }}</p>
        </div>
      </div>
      <div class="lista-actividades-cursoinfo-imgheader" :style="cursoimg">
        <div class="lista-actividades-cursoinfo-textheader">
          <div class="lista-actividades-cursoinfo-textheader-username">
            {{ asesor.name }}
          </div>
          <div class="lista-actividades-cursoinfo-textheader-account">
            Asesor
          </div>
          <div class="lista-actividades-cursoinfo-textheader-review">
            {{ curso.review }}
          </div>
        </div>
      </div>
    </div>
    <div class="lista-actividades-listaactividades">
      <div class="lista-actividades-listaactividades-layout">
        <Actividades>
          <template slot-scope="{ togglePopup }">
            <transition-group name="list-complete" tag="div" mode="out-in">
              <div
                v-for="activitie in actividades.data"
                :key="activitie.type + activitie.id"
                class="list-complete-item"
              >
                <Actividad
                  :alt="'A' + activitie.id"
                  v-bind:activitie="activitie"
                  @pop-image="togglePopup"
                  v-bind:month="monthgroup(activitie.fecha_inicio, 'long')"
                />
              </div>
            </transition-group>
          </template>
        </Actividades>
        <button v-if="more" class="listacursos-nextpage" @click="nextpage()">
          Más
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Actividades from "./Actividades";
import Actividad from "./Actividad";

export default {
  data() {
    return {
      asesor: [],
      loading: false,
      errorr: false,
      actividadeshoy: 0,
      actividadessemana: 0,
    };
  },
  computed: {
    more() {
      if (this.actividades.next_page_url) {
        return true;
      }
      return false;
    },
    curso() {
      return this.$store.getters["cursos/cursoview"];
    },
    cursoimg() {
      return (
        "background: url(" + this.curso.cover + "); background-size: cover"
      );
    },
    actividades() {
      return this.$store.getters["activities/actividadesview"];
    },
  },
  components: {
    Actividades,
    Actividad,
  },
  created() {
    this.lastmonth = -1;
    axios
      .get("/scursoc/" + this.curso.id)
      .then((res) => {
        Array.prototype.push.apply(
          res.data.actividades.data,
          res.data.tests.data
        );
        res.data.actividades.data.sort(function (a, b) {
          if (a.fecha_inicio < b.fecha_inicio) {
            return 1;
          }
          if (a.fecha_inicio > b.fecha_inicio) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });

        this.asesor = res.data.curso.asesor;
        this.actividadeshoy = res.data.actividadeshoy;
        this.actividadessemana = res.data.actividadessemana;
        this.$store.commit(
          "activities/changeactividades",
          res.data.actividades
        );

        if (res.data.actividades.next_page_url) {
          this.actividades.next_page_url = res.data.actividades.next_page_url;
        } else {
          this.actividades.next_page_url = res.data.tests.next_page_url;
        }
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    monthgroup(fechai, mformat) {
      var dateg = fechai.split("-");
      var dategm = new Date(`${dateg[0]}/${dateg[1]}/${dateg[2]}`);

      if (this.lastmonth == dategm.getMonth()) {
        return " ";
      } else {
        this.lastmonth = dategm.getMonth();
      }

      return dategm.toLocaleString("default", {
        month: mformat,
        year: "numeric",
      });
    },
    eliminarCurso() {
      const confirmacion = confirm(
        `Deseas salir del curso:  ${this.curso.title}`
      );
      if (confirmacion) {
        axios
          .post(`/desmatricular/${this.curso.id}`)
          .then(() => {
            this.$store.commit("cursos/deletecurso", this.curso);
            this.$xmodal.close();
            flash("Has salido del curso", "info");
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });
      }
    },
    nextpage() {
      axios
        .get(this.actividades.next_page_url)
        .then((res) => {
          Array.prototype.push.apply(
            res.data.actividades.data,
            res.data.tests.data
          );
          res.data.actividades.data.sort(function (a, b) {
            if (a.fecha_inicio < b.fecha_inicio) {
              return 1;
            }
            if (a.fecha_inicio > b.fecha_inicio) {
              return -1;
            }
            // a must be equal to b
            return 0;
          });

          res.data.actividades.data.forEach((element) => {
            this.actividades.data.push(element);
          });

          if (res.data.actividades.next_page_url) {
            this.actividades.next_page_url = res.data.actividades.next_page_url;
          } else {
            this.actividades.next_page_url = res.data.tests.next_page_url;
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });
    },
  },
};
</script>

<style>
.lista-actividades-layout {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  padding: 0.5rem;
}

.lista-actividades-cursoinfo {
  display: flex;
  padding: 0.5rem;
}
.lista-actividades-cursoinfo-imgheader {
  height: 12.6875rem;
  position: relative;
  width: 100%;
  border-radius: 8px;
  display: flex;
  align-items: flex-end;
}
.lista-actividades-cursoinfo-textheader {
  width: 100%;
  top: 1rem;
  background-color: white;
  padding: 0.5rem;
  border-radius: 20px;
  margin-left: 5rem;
  position: relative;
}
.lista-actividades-cursoinfo-textheader-username {
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.5rem;
  padding-left: 1rem;
}
.lista-actividades-cursoinfo-textheader-account {
  padding-left: 1rem;
}
.lista-actividades-cursoinfo-textheader-review {
  padding: 1rem;
  text-align: justify;
}

.lista-actividades-listaactividades {
  padding: 1rem;
}

.lista-actividades-cursooptions a {
  text-align: left;
  width: max-content;
  display: block;
}
.list-complete-item {
  transition: all 1s;
}
.list-complete-enter, .list-complete-leave-to
/* .list-complete-leave-active for <2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.list-complete-leave-active {
  position: absolute;
}
.diacolor {
  padding: 0.5rem;
  background-color: #84b145;
}
.weekcolor {
  padding: 0.5rem;
  background-color: #ffff00;
}

@media only screen and (max-width: 1050px) {
  .lista-actividades-cursoinfo-textheader {
    margin-left: 0rem;
  }
}
</style>