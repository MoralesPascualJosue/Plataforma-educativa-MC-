<template>
  <div class="example page-tab">
    <div class="item1">
      <h1 :id="curso.id">{{ curso.title }}</h1>
      <div class="curse-img-header" :style="cursoimg"></div>
      <div class="curse-header text-right">
        <div class="user-name-header">
          <span id="name-u">{{ asesor.name }}</span>
        </div>
        <div class="username-header">
          <span>Asesor</span>
        </div>
      </div>
      <div>
        <div class="aside-header">Detalles y acciones</div>
        <a href="javascript:void(0)" @click="eliminarCurso">
          <div class="aside-link">Salir del curso</div>
        </a>
        <a href="javascript:void(0)" @click="$emit('ver-resumen')">
          <div class="aside-link">Resumen curso</div>
        </a>
      </div>
    </div>
    <div class="item2">
      <div class="row">
        <div class="col-md-5">
          <span class="text-muted">
            Actividades para la semana:
            <b>{{actividadessemana}}</b>
          </span>
        </div>
        <div class="col-md-4">
          <div class="pull-right">
            <span class="text-muted">
              Actividades para hoy:
              <b>{{actividadeshoy}}</b>
            </span>
          </div>
        </div>
      </div>
      <hr />
      <div class="container">
        <Actividades>
          <template slot-scope="{ togglePopup }">
            <transition-group name="list-complete" tag="p" mode="out-in">
              <div
                v-for="activitie in actividades.data"
                v-bind:key="activitie.id"
                class="actividad list-complete-item"
              >
                <Actividad
                  :alt="'A'+activitie.id"
                  v-bind:activitie="activitie"
                  @pop-image="togglePopup"
                />
              </div>
            </transition-group>
          </template>
        </Actividades>
        <button v-if="more" class="page-title" @click="nextpage()">Más</button>
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
      actividadessemana: 0
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
    }
  },
  components: {
    Actividades,
    Actividad
  },
  created() {
    axios.get("/scursoc/" + this.curso.id).then(res => {
      Array.prototype.push.apply(res.data.actividades.data, res.data.tests);
      res.data.actividades.data.sort(function(a, b) {
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
    });
  },
  methods: {
    eliminarCurso() {
      const confirmacion = confirm(
        `Deseas salir del curso:  ${this.curso.title}`
      );
      if (confirmacion) {
        axios.post(`/desmatricular/${this.curso.id}`).then(() => {
          this.$store.commit("deletecurso", this.curso);
          this.$xmodal.close();
          flash("Has salido del curso", "info");
        });
      }
    },
    nextpage() {
      let posy = window.scrollY;
      axios.get(this.actividades.next_page_url).then(res => {
        res.data.actividades.data.forEach(element => {
          this.actividades.data.push(element);
        });
        this.actividades.next_page_url = res.data.actividades.next_page_url;
        setTimeout(function() {
          window.scrollBy(0, -(window.scrollY - posy));
        }, 200);
      });
    }
  }
};
</script>

<style>
.page-tab {
  position: relative;
  padding: 20px;
  height: 97%;
  background: white;
  border-radius: 8px;
  margin: 0 0 10px 0;
  display: grid;
  grid-gap: 10px;
  grid-template-columns: repeat(5, 19%);
  grid-template-rows: repeat(4, 25%);
  justify-content: center;
}

.item1 {
  grid-column: 1 / 3;
  grid-row: 1 / 5;
}

.item2 {
  grid-column: 3 / 6;
  grid-row: 1 / 5;
  min-height: 57vh;
}

@media (max-width: 1050px) {
  .page-tab {
    grid-template-columns: repeat(1, 100%);
    grid-template-rows: inherit;
  }

  .item1 {
    grid-column: 1 / 1;
    grid-row: 1 / 2;
  }

  .item2 {
    grid-column: 1 / 1;
    grid-row: 3 / 5;
  }
}

.curse-img-header {
  height: 8.6875rem;
  position: relative;
  padding: 0;
  width: 100%;
  border-radius: 8px;
}

.curse-header {
  position: relative;
  display: block;
  margin-left: 5%;
}

.user-name-header {
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.5rem;
  padding-left: 1rem;
}

.username-header {
  margin-left: 50%;
}

.aside-link {
  text-align: left;
}

#dlabela {
  margin-bottom: 5px;
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
</style>