<template>
  <div class="anuncios-layout">
    <div></div>
    <div class="anuncios-toolbar">
      <p @click="statusShow = !statusShow">
        <span v-if="statusShow">start</span><span v-else>stop</span>
      </p>
      <p>
        <span @click="beforeAnuncio">Anterior</span> {{ numberAnuncio }} de
        {{ anunciosSize }}
        <span @click="nextAnuncio">Siguiente</span>
      </p>
    </div>
    <div class="anuncios-list">
      <p
        v-for="(anuncio, indexaa) in anuncios"
        :key="indexaa"
        @click="showAnuncio(anuncio, indexaa)"
        :class="{ selected: isSelected(indexaa) }"
      >
        {{ indexaa + 1 }}
      </p>
    </div>
    <div class="anuncios-container">
      <Blockcomponent :anuncio="anuncio" :statusshow="statusShow" />
    </div>
  </div>
</template>

<script>
import Blockcomponent from "./Blockcomponent";
export default {
  components: {
    Blockcomponent,
  },
  data() {
    return {
      anuncios: [],
      anuncio: { updated_at: "--Hoy", anuncioblock: {}, anuncio: "" },
      indexshow: -1,
      statusShow: false,
    };
  },
  computed: {
    anunciosSize() {
      return Object.keys(this.anuncios).length;
    },
    numberAnuncio() {
      return this.indexshow + 1;
    },
  },
  created() {
    axios
      .get("/home")
      .then((res) => {
        this.anuncios = res.data.anuncios;
        this.anuncio = this.anuncios[0];
        this.indexshow = 0;
        this.$emit("updateuserdata", res.data.user);
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  mounted() {
    this.changeAnuncio();
  },
  methods: {
    changeAnuncio: function () {
      var v = this;
      setTimeout(function () {
        if (!v.statusShow && v.anunciosSize > 0) {
          v.indexshow++;
          if (v.indexshow == v.anunciosSize) {
            v.indexshow = 0;
          }
          v.anuncio = v.anuncios[v.indexshow];
          v.changesdefault = 0;
        }
        v.changeAnuncio();
      }, 6000);
    },
    nextAnuncio() {
      this.indexshow++;
      if (this.indexshow == this.anunciosSize) {
        this.indexshow = 0;
      }
      this.anuncio = this.anuncios[this.indexshow];
      this.changesdefault = 0;
    },
    beforeAnuncio() {
      this.indexshow--;
      if (this.indexshow < 0) {
        this.indexshow = this.anunciosSize - 1;
      }
      this.anuncio = this.anuncios[this.indexshow];
      this.changesdefault = 0;
    },
    isSelected(value) {
      if (value == this.indexshow) {
        return true;
      }
      return false;
    },
    showAnuncio(anuncio, index) {
      this.anuncio = anuncio;
      this.indexshow = index;
      this.statusShow = true;
      this.changesdefault = 0;
    },
  },
};
</script>

<style>
.anuncios-layout {
  padding: 1rem;
  display: grid;
  grid-template-columns: 5% auto;
  grid-template-rows: 6% auto;
  height: 100%;
}
.anuncios-toolbar {
  display: inline-block;
}
.anuncios-toolbar p {
  display: inline-block;
  background-color: #fdc770;
  border-radius: 30px;
  padding: 0.4rem;
  cursor: pointer;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.anuncios-toolbar p:hover {
  background-color: white;
}
.anuncios-list {
  overflow-y: auto;
  height: 100%;
  margin-top: 0.5rem;
}
/* Hide scrollbar for Chrome, Safari and Opera */
.anuncios-list::-webkit-scrollbar {
  display: none;
}
/* Hide scrollbar for IE, Edge and Firefox */
.anuncios-list {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
.anuncios-list p {
  cursor: pointer;
  height: 2rem;
  width: 2rem;
  background-color: #f0f0f0;
  margin-top: 1rem;
  border-radius: 4px;
  text-align: center;
  font-weight: bold;
  line-height: 2rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.anuncios-list p:hover {
  background-color: #266fae;
}
.anuncios-list .selected {
  background-color: #fcb036;
}
.anuncios-container {
  height: 100%;
  width: 100%;
  background-color: #f0f0f0;
  margin-top: 0.5rem;
  border-radius: 30px;
  padding: 1rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
@media (max-width: 980px) {
  .anuncios-list {
    display: none;
  }
  .anuncios-layout {
    display: inherit;
    padding: inherit;
  }
  .anuncios-toolbar p {
    font-size: 12px;
  }
  .anuncios-container {
    height: 90%;
  }
}
</style>