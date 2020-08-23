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
        <FormCursoUpdate />
        <a href="#" @click="eliminarCurso">
          <div class="aside-link">Eliminar curso</div>
        </a>
      </div>
    </div>
    <div class="item2">
      <div class="container">
        <button
          id="dlabela"
          type="button"
          aria-haspopup="true"
          aria-expanded="false"
          @click="createactividad()"
          class="btn btn-primary float-right"
        >
          <p class="line-d" v-if="!loading">Crear actividad</p>
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
            v-if="loading"
          ></span>
          <p class="line-d" v-if="loading">Creando...</p>
        </button>
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
import FormCursoUpdate from "./FormCursoUpdate";

export default {
  data() {
    return {
      asesor: [],
      loading: false,
      errorr: false
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
    Actividad,
    FormCursoUpdate
  },
  created() {
    axios.get("/scursoc/" + this.curso.id).then(res => {
      this.asesor = res.data.curso.asesor;
      this.$store.commit("changeactividades", res.data.actividades);
    });
  },
  methods: {
    eliminarCurso() {
      const confirmacion = confirm(`Eliminar anuncio ${this.curso.title}`);
      if (confirmacion) {
        axios.delete(`/destroyac/${this.curso.id}`).then(() => {
          this.$store.commit("deletecurso", this.curso);
          this.$xmodal.close();
          flash("Curso Eliminado", "info");
        });
      }
    },
    createactividad() {
      axios
        .post("/storeaa/" + this.curso.id)
        .then(response => {
          this.errorr = false;
          this.actividades.data.unshift(response.data);
          flash("Actividad creada", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash(
            "Fallo la creacion del la actividad:prueba mas tarde.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
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