<template>
  <div class="blockcomponent-layout">
    <div class="blockcomponent-options-toolbar" v-if="anuncio.id && statusshow">
      <p @click="addColumn"><span>Agregar columna</span></p>
      {{ anuncio.widthblock }}
      <p @click="deleteColumn"><span>Eliminar columna</span></p>
      <p @click="addRow"><span>Agregar fila</span></p>
      {{ anuncio.heigthblock }}
      <p @click="deleteRow"><span>Eliminar fila</span></p>
      <p>
        <span @click="onChangeStatusToolbar">Agregar elemento</span>
      </p>
      <p v-if="statustoolbar" class="blockcomponent-options-toolbar-options">
        <span @click="addComponent('image')">imagen</span>
        <span @click="addComponent('description')">descripcion</span>
      </p>
      <p
        v-if="changesdefault > 0"
        class="blockcomponent-options-toolbar-save"
        @click="editAnuncio"
      >
        <span>{{ changesdefault }}</span
        >Guardar cambios
      </p>
    </div>
    <div class="blockcomponent-fecha">
      <p class="blockcomponent-fecha-mes">{{ mes }}</p>
      <p class="blockcomponent-fecha-dia">{{ dia[2] }}</p>
    </div>
    <div
      class="blockcomponent-layout-grid"
      :style="{
        gridTemplateColumns: `repeat(${anuncio.widthblock},${
          100 / anuncio.widthblock
        }%)`,
        gridTemplateRows: `repeat(${anuncio.heigthblock},${
          100 / anuncio.heigthblock
        }%)`,
      }"
    >
      <div
        v-for="(block, indexblock) in anuncio.anuncioblock"
        :key="indexblock"
        :style="{
          gridColumnEnd: `span ${block.width}`,
          gridRowEnd: `span ${block.heigth}`,
        }"
      >
        <div v-if="block.type == 'image'">
          <Imagecomponent :block="block" @onchange="addchangen" />
        </div>
        <div v-else>
          <Descriptioncomponent :block="block" @onchange="addchangen" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Imagecomponent from "./Imagecomponent";
import Descriptioncomponent from "./Descriptioncomponent";
export default {
  props: {
    anuncio: {
      type: Object,
      default: function () {
        return { updated_at: "--Hoy" };
      },
    },
    statusshow: {
      type: Boolean,
      default: false,
    },
    changesdefault: {
      type: Number,
      default: 0,
    },
  },
  components: {
    Imagecomponent,
    Descriptioncomponent,
  },
  data() {
    return {
      statustoolbar: false,
    };
  },
  computed: {
    dia() {
      return this.anuncio.updated_at.split("-");
    },
    mes() {
      let meses = {
        "01": "Ene",
        "02": "Feb",
        "03": "Mar",
        "04": "Abr",
        "05": "May",
        "06": "Jun",
        "07": "Jul",
        "08": "Ago",
        "09": "Sep",
        10: "Oct",
        11: "Nov",
        12: "Dic",
      };
      return meses[this.dia[1]];
    },
  },
  methods: {
    onChangeStatusToolbar() {
      this.statustoolbar = !this.statustoolbar;
    },
    addchangen() {
      this.$emit("changesn", true);
    },
    addColumn() {
      this.anuncio.widthblock++;
      this.$emit("changesn", true);
    },
    deleteColumn() {
      this.anuncio.widthblock--;
      this.$emit("changesn", true);
    },
    addRow() {
      this.anuncio.heigthblock++;
      this.$emit("changesn", true);
    },
    deleteRow() {
      this.anuncio.heigthblock--;
      this.$emit("changesn", true);
    },
    addComponent(value) {
      let nextblock = Object.keys(this.anuncio.anuncioblock).length;
      if (value == "image") {
        this.anuncio.anuncioblock[nextblock] = {
          type: "image",
          source: "resources/logo/Logo%20comp%20orange.svg",
          heigth: 1,
          width: 1,
        };
      } else {
        this.anuncio.anuncioblock[nextblock] = {
          type: "description",
          source: "contenido",
          heigth: 1,
          width: 1,
          size: 14,
          align: "inherit",
        };
      }
      this.$emit("changesn", true);
      this.statustoolbar = false;
    },
    editAnuncio() {
      const params = {
        anuncio: "Anuncio update",
        anuncioblock: this.anuncio.anuncioblock,
        widthblock: this.anuncio.widthblock,
        heigthblock: this.anuncio.heigthblock,
      };
      axios
        .put(`/updatea/${this.anuncio.id}`, params)
        .then((res) => {
          this.$emit("changesn", false);
          flash("Cambios guardados", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("No se han podido guardar los cambios", "error");
        });
    },
  },
};
</script>
<style>
.blockcomponent-layout {
  height: 100%;
  width: 100%;
}
.blockcomponent-fecha {
  right: 0;
  position: absolute;
  margin: 1rem;
  background: orange;
  border-radius: 30px;
  padding: 0.5rem;
  text-align: center;
}
.blockcomponent-fecha-dia {
  color: black;
  font-weight: bold;
  letter-spacing: 2pt;
}
.blockcomponent-fecha-mes {
  font-weight: bold;
}
.blockcomponent-options-toolbar p span {
  background-color: #fcb036;
  border-radius: 30px;
  padding: 0.5rem;
  color: white;
  font-weight: bold;
  cursor: pointer;
}
.blockcomponent-options-toolbar p span:hover {
  background-color: #266fae;
}
.blockcomponent-options-toolbar-save {
  padding: 0.5rem;
  background-color: #fcb036;
  color: white;
  font-weight: bold;
  cursor: pointer;
}
.blockcomponent-options-toolbar-save:hover {
  background-color: #266fae;
}
.blockcomponent-layout-grid {
  display: grid;
  height: 100%;
  width: 100%;
}
.blockcomponent-options-toolbar p {
  display: inline-block;
  font-size: 12px;
  padding: 0.5rem;
}
.blockcomponent-options-toolbar-options {
  position: relative;
}
</style>