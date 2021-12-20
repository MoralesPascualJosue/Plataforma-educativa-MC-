<template>
  <div class="listacursos-layout">
    <div class="listacursos-toolsbar">
      <div class="listacursos-toolsbar-right">
        <div class="search-clear" v-if="search != ''" @click="search = ''">
          X
        </div>
        <input type="text" v-model="search" placeholder="Buscar curso.." />
      </div>
    </div>
    <transition-group name="list-complete" tag="div" class="list">
      <FormCurso
        v-if="search == ''"
        @crear-curso="createcurso"
        v-bind:key="-1"
      />
      <div
        v-for="curso in filteredList"
        v-bind:key="curso.id"
        class="card list-complete-item"
      >
        <Curso alt="curso" v-bind:height="220" v-bind:curso="curso" />
        <p class="listacursos-layout-listacursos-curso-title">
          {{ curso.title }}
        </p>
      </div>
    </transition-group>
    <button
      v-if="more && search == ''"
      class="btn-nextpage"
      @click="nextpage()"
    >
      Más
    </button>
    <div class="bottom">Maestria en contruccion 2020</div>
  </div>
</template>

<script>
import Curso from "./Curso";
import FormCurso from "./FormCurso";

export default {
  components: {
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
      return this.$store.getters["cursos/cursosview"];
    },
    filteredList() {
      return this.cursos.data.filter((curso) => {
        return curso.title.toLowerCase().includes(this.search.toLowerCase());
      });
    },
  },
  data() {
    return { search: "" };
  },
  created() {
    axios
      .get("/perfil")
      .then((res) => {
        this.$store.commit("changelogin", {
          email: res.data.user.email,
          image: res.data.user.image,
          name: res.data.user.name,
        });
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });

    axios
      .get("/inicio")
      .then((res) => {
        this.$store.commit("cursos/changecursos", res.data);
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
.listacursos-layout {
  padding: 0.5rem;
}
.list {
  position: relative;
  width: 100%;
  display: grid;
  grid-gap: 1.5rem;
  justify-content: center;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
}
.card {
  position: initial;
  border-radius: 1rem;
  height: 265px;
  overflow: hidden;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
  background-color: #fdc770;
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
  color: black;
}
.listacursos-toolsbar {
  display: flex;
  justify-content: flex-end;
  background-color: #fdc770;
  border-radius: 20px;
  margin-bottom: 0.5rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.listacursos-toolsbar-right {
  padding: 0.2rem;
}
.listacursos-toolsbar-right input {
  padding: 0.4rem;
  font-size: 1.3rem;
  background-color: #fcb036;
  border: none;
  display: inline-block;
  margin-right: 0.5rem;
}
.search-clear {
  color: #666666;
  font-weight: 700;
  display: inline-block;
  font-size: 1.3rem;
  margin-right: 0.5rem;
  background-color: #fcb036;
  border-radius: 50%;
  width: 2rem;
  text-align: center;
  cursor: pointer;
}
.search-clear:hover {
  border: 2px solid #266fae;
  padding: 0.1rem;
  width: 2.1rem;
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
@media (max-width: 800px) {
  .card {
    margin-top: 0.5rem;
  }
}
.listacursos-nextpage {
  background-color: #fdc770;
  padding: 0.5rem;
  width: 100%;
  margin-top: 1rem;
  border: none;
  cursor: pointer;
}

.btn-nextpage {
  margin-top: 1rem;
  width: 100%;
  border: none;
  padding: 0.5rem;
  background-color: #fcb036;
}

.btn-nextpage:hover {
  background-color: white;
}
</style>

