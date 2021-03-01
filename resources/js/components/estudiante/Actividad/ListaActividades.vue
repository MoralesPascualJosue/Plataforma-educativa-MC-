<template>
  <div class="lista-actividades-layout">
    <div class="lista-actividades-cursoinfo">
      <h1 :id="curso.id" class="lista-actividades-cursoinfo-title">
        {{ curso.title }}
      </h1>
      <div
        class="lista-actividades-cursoinfo-imgheader"
        :style="cursoimg"
      ></div>
      <div class="lista-actividades-cursoinfo-textheader">
        <div class="lista-actividades-cursoinfo-textheader-username">
          {{ asesor.name }}
        </div>
        <div class="lista-actividades-cursoinfo-textheader-account">Asesor</div>
        <div class="lista-actividades-cursoinfo-textheader-review">
          {{ curso.review }}
        </div>
      </div>
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
      </div>
    </div>

    <div class="lista-actividades-listaactividades">
      <div class="lista-actividades-listaactividades-header">
        <div>
          Actividades para la semana:
          <p>{{ actividadessemana }}</p>
        </div>
        <div>
          Actividades para hoy:
          <p>{{ actividadeshoy }}</p>
        </div>
      </div>

      <div class="lsita-actividades-listaactividades-layout">
        <Actividades>
          <template slot-scope="{ togglePopup }">
            <transition-group name="list-complete" tag="div" mode="out-in">
              <div
                v-for="activitie in actividades.data"
                v-bind:key="activitie.type + activitie.id"
                class="list-complete-item"
              >
                <Actividad
                  :alt="'A' + activitie.id"
                  v-bind:activitie="activitie"
                  @pop-image="togglePopup"
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
      return this.$store.getters.cursoview;
    },
    cursoimg() {
      return (
        "background: url(../" + this.curso.cover + "); background-size: contain"
      );
    },
    actividades() {
      return this.$store.getters.actividadesview;
    },
  },
  components: {
    Actividades,
    Actividad,
  },
  created() {
    axios
      .get("/scursoc/" + this.curso.id)
      .then((res) => {
        Array.prototype.push.apply(
          res.data.actividades.data,
          res.data.tests.data
        );
        res.data.actividades.data.sort(function (a, b) {
          if (a.created_at < b.created_at) {
            return 1;
          }
          if (a.created_at > b.created_at) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });

        this.asesor = res.data.curso.asesor;
        this.actividadeshoy = res.data.actividadeshoy;
        this.actividadessemana = res.data.actividadessemana;
        this.$store.commit("changeactividades", res.data.actividades);

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
    eliminarCurso() {
      const confirmacion = confirm(
        `Deseas salir del curso:  ${this.curso.title}`
      );
      if (confirmacion) {
        axios
          .post(`/desmatricular/${this.curso.id}`)
          .then(() => {
            this.$store.commit("deletecurso", this.curso);
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
      let posy = window.scrollY;
      axios
        .get(this.actividades.next_page_url)
        .then((res) => {
          Array.prototype.push.apply(
            res.data.actividades.data,
            res.data.tests.data
          );
          res.data.actividades.data.sort(function (a, b) {
            if (a.fecha_final < b.fecha_final) {
              return 1;
            }
            if (a.fecha_final > b.fecha_final) {
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
          setTimeout(function () {
            window.scrollBy(0, -(window.scrollY - posy));
          }, 200);
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
  padding: 1rem;
  width: 100%;
  height: 100%;
  display: grid;
  grid-gap: 1rem;
  grid-template-columns: 39% 59%;
  justify-content: center;
}
@media (max-width: 1050px) {
  .lista-actividades-layout {
    grid-template-columns: repeat(1, 100%);
    grid-template-rows: inherit;
  }
}
.lista-actividades-cursoinfo-imgheader {
  height: 8.6875rem;
  position: relative;
  padding: 0;
  width: 100%;
  border-radius: 8px;
}
.lista-actividades-cursoinfo-textheader {
  position: relative;
  display: block;
  margin-left: 5%;
}
.lista-actividades-cursoinfo-textheader-username {
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.5rem;
  padding-left: 1rem;
}
.lista-actividades-cursoinfo-textheader-account {
  margin-left: 50%;
}
.lista-actividades-cursoinfo-textheader-review {
  padding: 0.5rem;
  text-align: justify;
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
.lista-actividades-listaactividades-header {
  padding: 0.5rem;
  display: grid;
  grid-template-columns: auto auto;
}
</style>