<template>
  <div class="listacursos-layout">
    <FormCurso @crear-curso="createcurso" v-bind:key="-1" />
    <!--    <Cursos>
      <template slot-scope="{ togglePopup }">-->
    <transition-group name="list-complete" tag="div" class="list">
      <div
        v-for="curso in cursos.data"
        v-bind:key="curso.id"
        class="card list-complete-item"
      >
        <Curso alt="curso" v-bind:height="200" v-bind:curso="curso" />
      </div>
    </transition-group>
    <!-- </template>
    /Cursos>-->
    <button v-if="more" class="listacursos-nextpage" @click="nextpage()">
      Más
    </button>
  </div>
</template>

<script>
//import Cursos from "./Cursos";
import Curso from "./Curso";
import FormCurso from "./FormCurso";

export default {
  components: {
    //    Cursos,
    Curso,
    FormCurso,
  },
  computed: {
    more() {
      if (this.cursos.next_page_url) {
        return true;
      }
      return false;
    },
    cursos() {
      return this.$store.getters.cursosview;
    },
  },
  created() {
    axios
      .get("/inicio")
      .then((res) => {
        this.$store.commit("changecursos", res.data);
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    createcurso(curso) {
      if (curso.id) {
        this.cursos.data.unshift(curso);
      }
    },
    nextpage() {
      let posy = window.scrollY;
      axios
        .get(this.cursos.next_page_url)
        .then((res) => {
          res.data.data.forEach((element) => {
            this.cursos.data.push(element);
          });
          this.cursos.next_page_url = res.data.next_page_url;
          /*          setTimeout(function () {
            window.scrollBy(0, -(window.scrollY - posy));
          }, 200);*/
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
.listacursos-layout {
  padding: 0.5rem;
}
.list {
  position: relative;
  width: 100%;
  display: grid;
  grid-gap: 1rem 0.5rem;
  grid-template-columns: repeat(4, 24%);
  justify-content: center;
}
.card {
  position: initial;
  border-radius: 1rem;
  height: 265px;
  overflow: hidden;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
  background-color: #fcb036;
}
.listacursos-layout-listacursos-curso-title {
  font-size: 16px;
  padding: 0.5rem;
  text-align: justify;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 62px;
}
.list-complete-item {
  transition: all 0.5s;
}
.list-complete-enter, .list-complete-leave-to
/* .list-complete-leave-active for <2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.list-complete-leave-active {
  position: absolute;
}
.cover {
  height: 100vh;
  width: 100vw;
  background-color: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  z-index: 999;
  left: 0;
}
.fade-enter-active {
  transition: opacity 0.25s;
}
.fade-leave-active {
  transition: opacity 0.25s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}

@media (max-width: 1050px) {
  .list {
    grid-template-columns: repeat(3, 33%);
  }
}
@media (max-width: 800px) {
  .list {
    grid-template-columns: repeat(1, 100%);
  }
  .card {
    margin-top: 0.5rem;
  }
}
.listacursos-nextpage {
  background-color: #fcb036;
  padding: 0.5rem;
  width: 100%;
  margin-top: 1rem;
  border: none;
  cursor: pointer;
}
.listacursos-nextpage:hover {
  background-color: white;
}
.btn-nextpage {
  margin-top: 1rem;
  width: 100%;
  border: none;
  padding: 0.5rem;
  background-color: #fdc770;
}

.btn-nextpage:hover {
  background-color: white;
}
</style>

