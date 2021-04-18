<template>
  <div
    :class="statusclass"
    :style="{ backgroundImage: `url(${block.source})` }"
    @mouseenter="statusenter"
    @mouseleave="statusleave"
  >
    <div v-if="status" class="blockcomponent-layout-grid-block-width">
      <div @click="deleteColumnComponent(block)">-</div>
      <div @click="addColumnComponent(block)">+</div>
    </div>
    <transition name="fade">
      <div v-if="status" class="anuncio-image-options">
        <div>
          <label>
            <input
              class="anuncio-image-file"
              type="file"
              v-on:change="onChangeFileUpload"
            />
            Cambiar</label
          >
        </div>
        <div @click="onDeleteFileUpload">eliminar</div>
      </div>
    </transition>
    <div v-if="status" class="blockcomponent-layout-grid-block-heigth">
      <div @click="deleteRowComponent(block)">-</div>
      <div @click="addRowComponent(block)">+</div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    block: {
      type: Object,
      default: function () {
        return {
          type: "image",
          source: "resources/logo/Logo%20comp%20orange.svg",
          width: 1,
          heigth: 1,
        };
      },
    },
  },
  data() {
    return {
      status: false,
      file: "",
      loading: false,
    };
  },
  computed: {
    statusclass() {
      if (this.status) {
        return "anuncio-imagen-layout dashedshow";
      }
      return "anuncio-imagen-layout";
    },
  },
  methods: {
    statusenter() {
      this.status = true;
    },
    statusleave() {
      this.status = false;
    },
    onChangeFileUpload(event) {
      let formData = new FormData();
      this.file = event.target.files[0];
      this.loading = true;
      if (this.file != "") {
        formData.append("fileToUpload", this.file);
      }

      axios
        .post("/uploadfilei", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.loading = false;
          this.block.source = response.data;
          this.$emit("onchange");
          flash("Imagen actualizada", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          this.loading = false;
          flash("Error al cambiar imagen:prueba mas tarde.", "error");
        });
    },
    onDeleteFileUpload() {
      this.block.source = "/resources/logo/Logo%20comp%20orange.svg";
      this.$emit("onchange");
    },
    addColumnComponent(blockc) {
      blockc.width++;
      this.$emit("onchange");
    },
    deleteColumnComponent(blockc) {
      blockc.width--;
      this.$emit("onchange");
    },
    addRowComponent(blockc) {
      blockc.heigth++;
      this.$emit("onchange");
    },
    deleteRowComponent(blockc) {
      blockc.heigth--;
      this.$emit("onchange");
    },
  },
};
</script>

<style>
.dashedshow {
  border: 0.5rem #266fae dashed;
}
.anuncio-image-file {
  display: none;
}
.anuncio-imagen-layout {
  width: 100%;
  height: 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
}
.anuncio-image-options {
  background: #266fae;
  left: 40%;
  top: 45%;
  position: relative;
  width: 20%;
  text-align: center;
  border-radius: 30px;
  overflow: hidden;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.anuncio-image-options div {
  padding: 0.5rem;
  cursor: pointer;
  font-weight: bold;
}
.anuncio-image-options div:hover {
  background-color: white;
}
.blockcomponent-layout-grid-block-width {
  cursor: pointer;
  float: right;
  padding: 0.5rem;
  margin: 0.5rem;
  background-color: #fcb036;
  text-align: center;
}
.blockcomponent-layout-grid-block-width div:hover {
  background-color: #266fae;
}
.blockcomponent-layout-grid-block-heigth {
  cursor: pointer;
  float: right;
  padding: 0.5rem;
  margin: 0rem 0.5rem;
  background-color: #fcb036;
  text-align: center;
}
.blockcomponent-layout-grid-block-width div {
  display: inline-block;
}
.blockcomponent-layout-grid-block-heigth div:hover {
  background-color: #266fae;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>