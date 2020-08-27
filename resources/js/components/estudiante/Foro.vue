<template>
  <div class="example container">
    <flash />
    <FormDiscu @crear-d="creatediscuss" />
    <div class="row">
      <div class="col-3">
        <h2>Categorias</h2>
        <p class="badge ml-2" v-for="(categoria, indexc) in categorias" :key="indexc">
          <a href="javascript:void(0)" @click="categoriasea(indexc)">
            {{categoria.name}}
            <span
              :style="{
                backgroundColor: categoria.color
            }"
              class="circlecolor"
            ></span>
          </a>
        </p>
      </div>
      <UncoverList class="col-8">
        <template slot-scope="{ togglePopup }">
          <transition-group name="list-complete" tag="div" class="d-content">
            <blockquote
              v-for="discu in discuss.discuss"
              v-bind:key="discu.id"
              class="list-complete-item"
            >
              <UncoverImage
                alt="example"
                v-bind:height="50"
                v-bind:objeto="discu"
                @pop-image="togglePopup"
              />
              <footer
                class="blockquote-footer"
                :style="{
                borderBottom: `1px solid ${discu.colorCategoria}`,
                borderLeft: `10px solid ${discu.colorCategoria}`
            }"
              >
                Propuesto por:
                <cite title="Source Title">{{ discu.usuarioName }}</cite>
              </footer>
            </blockquote>
          </transition-group>
        </template>
      </UncoverList>
      <button v-if="more" class="page-title" @click="nextpage()">Más</button>
    </div>
  </div>
</template>

<script>
import UncoverList from "./Discuss";
import UncoverImage from "./Discu";
import FormDiscu from "./FormDiscu";
import Flash from "../Flash";

export default {
  components: {
    UncoverList,
    UncoverImage,
    FormDiscu,
    Flash
  },
  computed: {
    more() {
      if (this.discuss.next_page_url) {
        return true;
      }
      return false;
    },
    curso() {
      return this.$store.getters.cursoview;
    },
    categorias() {
      return this.$store.getters.categoriasview;
    },
    discuss() {
      return this.$store.getters.discussview;
    }
  },
  created() {
    axios.get("/foro/" + this.curso.id).then(res => {
      this.$store.commit("changecategorias", res.data.categorias);
      this.$store.commit("changediscuss", res.data);
    });
  },
  methods: {
    creatediscuss(discu) {
      this.discuss.discuss.unshift(discu.discusion.discusion);
      if (discu.nuevac) {
        this.categorias.unshift(discu.discusion.categoria);
      }
    },
    nextpage() {
      let posy = window.scrollY;
      axios.get(this.discuss.next_page_url).then(res => {
        res.data.data.forEach(element => {
          this.discuss.data.push(element);
        });
        this.discu.next_page_url = res.data.next_page_url;
        setTimeout(function() {
          window.scrollBy(0, -(window.scrollY - posy));
        }, 200);
      });
    }
  }
};
</script>

<style>
.circlecolor {
  position: absolute;
  width: 10px;
  height: 10px;
  border-radius: 100%;
}
.foro-c {
  margin-bottom: inherit;
  padding: inherit;
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
.d-content {
  display: contents;
}
</style>