<template>
  <div class="blockcomponent-layout">
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
          <Imagecomponent :block="block" />
        </div>
        <div v-else-if="block.type == 'listlinks'">
          <Listlinks :block="block" />
        </div>
        <div v-else>
          <Descriptioncomponent :block="block" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Imagecomponent from "./Imagecomponent";
import Descriptioncomponent from "./Descriptioncomponent";
import Listlinks from "./ListLinks.vue";
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
  },
  components: {
    Imagecomponent,
    Descriptioncomponent,
    Listlinks,
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
  },
};
</script>
<style>
.blockcomponent-layout {
  height: 100%;
  width: 100%;
}
.blockcomponent-fecha {
  z-index: 1;
  right: 0;
  position: absolute;
  margin: 2.5rem;
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

.blockcomponent-layout-grid {
  display: grid;
  height: 100%;
  width: 100%;
}
@media (max-width: 980px) {
  .blockcomponent-layout-grid {
    display: inherit;
    overflow-y: auto;
  }
}
</style>