<template>
  <div class="activitieeditor-page-body-column-container">
    <div
      class="activitieeditor-page-body-column-layout"
      :style="{ padding: padding }"
    >
      <component
        v-bind:is="propsColumnm.type"
        :propsContainerd="propsColumnm.propsContainer"
      ></component>
    </div>
  </div>
</template>

<script>
import Heading from "../Bloques/HeadBlock.vue";
import Textblock from "../Bloques/TextBlock.vue";
import Imageblock from "../Bloques/ImageBlock.vue";
import Docpdf from "../Bloques/PdfBlock.vue";
import Videoblock from "../Bloques/VideoBlock.vue";
import Archivoblock from "../Bloques/ArchivoBlock.vue";
import Vacio from "../Bloques/VacioBlock.vue";

export default {
  components: {
    Heading,
    Textblock,
    Imageblock,
    Docpdf,
    Videoblock,
    Archivoblock,
    Vacio,
  },
  props: {
    columnindex: {
      type: Number,
      default: 0,
    },
    propsColumn: {
      type: Object,
      default: function () {
        return {
          column: 0,
          type: "Heading",
          width: "activitieeditor-column-100",
          propsContainer: {
            props: {
              color: "#a2a2a2",
              fontSize: "22px",
              fontWeight: "normal",
              lineHeight: "140%",
              textAlign: "left",
            },
            value: "¡Contenido no encontrado columna!",
          },
        };
      },
    },
  },
  computed: {
    propsColumnm() {
      return this.propsColumn;
    },
  },
  data() {
    return {
      padding: "10px",
    };
  },
};
</script>

<style>
.activitieeditor-page-body-column-container {
  width: 100%;
}
.activitieeditor-page-body-column-layout .drop-allowed.drop-in {
  box-shadow: 0 0 0px 5px rgb(47, 170, 222);
  opacity: 1;
}

.activitieeditor-page-body-column-container-selected {
  box-shadow: 0px -15px 0px -0.1rem #2faade, 0px 15px 0px -0.1rem #2faade;
  transition: box-shadow 0.3s ease 0s;
}
</style>