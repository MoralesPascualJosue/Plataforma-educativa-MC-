<template>
  <div class="foro-layout">
      <div class="foro-layout-categorias">
        <h2>Categorias</h2>
        <p class="foro-layout-categorias-item" v-bind:key="-1">
          <a href="javascript:void(0)" @click="categoriasea('Todo')">
            Todo
            <span
              :style="{
                backgroundColor: 'black',
              }"
              class="circlecolor"
            ></span>
          </a>
        </p>
        <p
          class="foro-layout-categorias-item"
          v-for="(categoria, indexc) in categorias"
          :key="indexc" 
        >
          <a href="javascript:void(0)" @click="categoriasea(categoria.name)">
            {{ categoria.name }}
            <span
              :style="{
                backgroundColor: categoria.color,
              }"
              class="circlecolor"
            ></span>
          </a>
        </p>
      </div>
      <UncoverList class="foro-layout-discuss">
        <template slot-scope="{ togglePopup }">
          <transition-group name="list-complete" tag="div" class="d-content">
            <FormDiscu @crear-d="creatediscuss" v-bind:key="-1" />
            <blockquote
              v-for="discu in discuss.discuss"
              v-bind:key="discu.id"
              class="list-complete-item-f"
              :style="{
                backgroundColor: `${discu.colorCategoria}`,
              }"
              v-show="discu.nameCategoria == categoria || categoria == 'Todo'"
            >
              <div class="discu-content">
                <UncoverImage
                  alt="example"
                  v-bind:height="50"
                  v-bind:objeto="discu"
                  @pop-image="togglePopup"
                />
                <footer class="blockquote-footer l-t">
                  Propuesto por:
                  <cite title="Source Title">{{ discu.usuarioName }}</cite>
                </footer>
              </div>
            </blockquote>
          </transition-group>
        </template>
      </UncoverList>
      <button v-if="more" class="page-title" @click="nextpage()">Más</button>
  </div>
</template>

<script>
import UncoverList from "./Discuss";
import UncoverImage from "./Discu";
import FormDiscu from "./FormDiscu";

export default {
  data() {
    return {
      categoria: "Todo",
    };
  },
  components: {
    UncoverList,
    UncoverImage,
    FormDiscu,
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
    },
  },
  created() {
    axios
      .get("/foro/" + this.curso.id)
      .then((res) => {
        this.$store.commit("changecategorias", res.data.categorias);
        this.$store.commit("changediscuss", res.data);
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    categoriasea(cate) {
      this.categoria = cate;
    },
    creatediscuss(discu) {
      this.discuss.discuss.unshift(discu.discusion.discusion);
      if (discu.nuevac) {
        this.categorias.unshift(discu.discusion.categoria);
      }
    },
    nextpage() {
      let posy = window.scrollY;
      axios
        .get(this.discuss.next_page_url)
        .then((res) => {
          res.data.data.forEach((element) => {
            this.discuss.data.push(element);
          });
          this.discu.next_page_url = res.data.next_page_url;
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
.foro-layout {
 display: grid;
 grid-template-columns: 25% auto;
 padding: 1rem;
 height: 100%;
 overflow-y: auto;
}
.foro-layout-categorias-item {
 display: inline-flex;
 padding: 0.2rem;
 line-height: 2rem;
}
.foro-layout-categorias-item a {
 background-color: #fdc770;
 padding:0.2rem;
}
.l-t {
  text-align: right;
}

.circlecolor {
  display: inline-block;
  width: 10px;
  height: 10px;
  border-radius: 100%;
}
.foro-c {
  margin-bottom: inherit;
  padding: inherit;
}

.discu-content {
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075) !important;
  min-height: 5rem;
  text-align: left;
  padding: 10px;
}

.list-complete-item-f {
  transition: all 0.5s;
  border-radius: 4px;
  padding-left: 20%;
  margin-bottom: 0.5rem;
}
.list-complete-item-f:hover {
 padding-left:0;
}
#add-discus{
 padding-left:20% !important;
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

@media (max-width: 1050px) {
 .foro-layout{
    grid-template-columns: 100%;
  }  
}
</style>
