<template>
  <div class="example">
    <UncoverList>
      <template slot-scope="{ togglePopup }">
        <transition-group name="list-complete" tag="div" class="list">
          <FormCurso @crear-curso="createcurso" v-bind:key="-1" />
          <div
            v-for="curso in cursos.data"
            v-bind:key="curso.id"
            class="card list-complete-item"
          >
            <UncoverImage
              alt="example"
              v-bind:height="220"
              v-bind:curso="curso"
              @pop-image="togglePopup"
            />
            <h1>{{ curso.title }}</h1>
          </div>
        </transition-group>
      </template>
    </UncoverList>
    <button v-if="more" class="page-title" @click="nextpage()">Más</button>
    <div class="bottom">Maestria en contruccion 2020</div>
  </div>
</template>

<script>
import UncoverList from "./Cursos";
import UncoverImage from "./Curso";
import FormCurso from "./FormCurso";

export default {
  components: {
    UncoverList,
    UncoverImage,
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
body {
  margin: 0;
  font-size: 15px;
  text-align: center;
  color: #4a4a4a;
}
.page-title {
  margin: 40px 20px 15px 20px;
  font-size: 16px;
  font-weight: 500;
  border: 1px solid #4a4a4a;
  border-radius: 6px;
  display: inline-block;
  padding: 3px 14px;
  cursor: pointer;
}
.repo {
  display: block;
  margin-bottom: 20px;
  font-size: 16px;
  color: #6b9db9;
}
.example {
  max-width: 1020px;
  margin: 0 auto;
}
.card {
  position: initial;
  border: 1px solid #eee;
  border-radius: 4px;
  height: 300px;
  overflow: hidden;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}
.content {
  text-align: justify;
  padding: 0 11px;
  font-size: 12px;
}
h1 {
  color: #000000;
  text-align: left;
  font-weight: 600;
  font-size: 16px;
  padding: 5px 15px;
}
.bottom {
  margin-bottom: 20px;
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
</style>

