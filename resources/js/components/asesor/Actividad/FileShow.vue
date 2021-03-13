<template>
  <div>
    <modal :show="show" @close="close">
      <button class="modalactividad-closebottom" @click="close()">X</button>
      <div class="actividad-entregas-fileshow">
        <!-- Form fields removed for brevity -->
        <div v-if="show" class="example">
          <div
            v-for="(archivo, indexa) in recursos"
            :key="indexa"
            class="sourcea"
          >
            <div v-if="tipo(archivo.source) != 'otro'">
              <h4>{{ archivo.name }}</h4>
              <iframe
                v-if="tipo(archivo.source) == 'archivo'"
                :src="archivo.source"
                frameborder="0"
              ></iframe>
              <img
                v-else-if="tipo(archivo.source) == 'imagen'"
                :src="archivo.source"
                alt
                width="100%"
              />
              <video
                v-else-if="tipo(archivo.source) == 'multimedia'"
                :src="archivo.source"
                width="100%"
                controls
              ></video>
            </div>
            <a v-else :href="archivo.source">{{ archivo.name }} Descargar</a>
          </div>
        </div>
      </div>

      <div class="modal-footer text-right"></div>
    </modal>
  </div>
</template>

<script>
import Modal from "../../Modal";
export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
    recursos: {
      type: Array,
      default: [],
    },
  },
  components: {
    Modal,
  },
  methods: {
    close: function () {
      this.$emit("close");
    },
    tipo(origen) {
      let llave = "otro";
      let tiposarchivos = ["pdf"];
      let tiposimage = ["jpg", "png", "jpeg"];
      let tiposmultimedia = ["mp4"];

      var fileName = origen;
      var ext = fileName.split(".");

      ext = ext[ext.length - 1];

      let indexa = tiposarchivos.indexOf(ext);
      let indexi = tiposimage.indexOf(ext);
      let indexm = tiposmultimedia.indexOf(ext);

      if (indexa >= 0) {
        llave = "archivo";
      }

      if (indexi >= 0) {
        llave = "imagen";
      }

      if (indexm >= 0) {
        llave = "multimedia";
      }

      return llave;
    },
  },
};
</script>

<style>
.actividad-entregas-fileshow {
  position: relative;
  height: 100%;
  overflow-y: auto;
}
.sourcea {
  padding: 10px;
  border: 1px solid gray;
  margin-bottom: 10px;
  width: 60%;
  left: 20%;
  position: relative;
}

@media only screen and (max-width: 1050px) {
  .sourcea {
    width: 90%;
    left: 5%;
  }
}
</style>
