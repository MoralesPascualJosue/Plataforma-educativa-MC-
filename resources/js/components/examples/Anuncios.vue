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
      <p @click="addAnuncio">Agregar anuncio</p>
      <p @click="deleteAnuncio(anuncio, indexshow)">Eliminar anuncio</p>
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
      <Blockcomponent
        :anuncio="anuncio"
        :changesdefault="changesdefault"
        :statusshow="statusShow"
        @changesn="changesAnuncio"
      />
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
      changesdefault: 0,
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
    changesAnuncio(operacion) {
      if (!operacion) {
        this.changesdefault = 0;
      } else {
        this.changesdefault++;
      }
    },
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
    addAnuncio() {
      const notaNueva = {
        anuncio: "Nuevo anuncio",
        heigthblock: 1,
        widthblock: 1,
        anuncioblock: {
          0: {
            type: "image",
            heigth: 1,
            width: 1,
            source: "resources/logo/Logo%20comp%20orange.svg",
          },
        },
      };
      axios
        .post("/storea", notaNueva)
        .then((res) => {
          this.anuncios.unshift(res.data);
          this.indexshow = 0;
          this.anuncio = this.anuncios[this.indexshow];
          this.changesdefault = 0;
          this.statusShow = true;
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });
    },
    deleteAnuncio(anuncio, index) {
      const confirmacion = confirm(`Eliminar anuncio`);
      if (confirmacion) {
        axios
          .delete(`/destroya/${anuncio.id}`)
          .then(() => {
            this.anuncios.splice(index, 1);
            if (index > 0) {
              this.indexshow--;
            }
            this.anuncio = this.anuncios[this.indexshow];
            this.changesdefault = 0;
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });
      }
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
  background-color: #fcb036;
  border-radius: 30px;
  padding: 0.5rem;
  cursor: pointer;
}
.anuncios-toolbar p:hover {
  background-color: white;
}
.anuncios-list {
  overflow-y: auto;
  height: 92%;
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
  background-color: white;
  margin-top: 1rem;
  border-radius: 4px;
  text-align: center;
  font-weight: bold;
  line-height: 2rem;
}
.anuncios-list p:hover {
  background-color: #266fae;
}
.anuncios-list .selected {
  background-color: #fcb036;
}
.anuncios-container {
  height: 92%;
  width: 100%;
  background-color: white;
  margin-top: 0.5rem;
  border-radius: 30px;
  padding: 1rem;
}
</style>