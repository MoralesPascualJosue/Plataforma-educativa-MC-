<template>
  <div class="example">
    <div class="page-title">Crear curso</div>
    <FormActividad />
    <UncoverList>
      <template slot-scope="{ togglePopup }">
        <div v-for="(curso, index) in cursos.data" :key="index" class="card">
          <h1>{{ curso.title }}</h1>

          <UncoverImage
            alt="example"
            :image-url="curso.cover"
            v-bind:height="168"
            @pop-image="togglePopup"
          />
          <div class="content">{{ curso.review }}</div>
        </div>
      </template>
    </UncoverList>
    <button v-if="more" class="page-title" @click="nextpage()">Más</button>
    <div class="bottom">Maestria en contruccion 2020</div>
    <flash class="alert-flash" message="Charged!"></flash>
  </div>
</template>

<script>
import UncoverList from "./Cursos";
import UncoverImage from "./Curso";
import FormActividad from "./FormActividad";
import Flash from "../Flash";

export default {
  data() {
    return {
      cursos: []
    };
  },
  components: {
    UncoverList,
    UncoverImage,
    FormActividad,
    Flash
  },
  computed: {
    more() {
      if (this.cursos.next_page_url) {
        return true;
      }
      return false;
    }
  },
  created() {
    axios.get("/inicio").then(res => {
      this.cursos = res.data;
    });
  },
  methods: {
    nextpage() {
      axios.get(this.cursos.next_page_url).then(res => {
        res.data.data.forEach(element => {
          this.cursos.data.push(element);
        });
        this.cursos.next_page_url = res.data.next_page_url;
      });
    },
    createcurse() {}
  }
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
  padding: 20px 0;
  border: 1px solid #eee;
  margin-bottom: 20px;
  border-radius: 4px;
}
.content {
  padding: 20px;
  text-align: justify;
}
h1 {
  text-align: left;
  font-size: 22px;
  padding: 0 20px;
}
.bottom {
  margin-bottom: 20px;
}
</style>
