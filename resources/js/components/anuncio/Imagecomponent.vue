<template>
  <div
    class="anuncio-imagen-layout"
    :style="{ backgroundImage: `url(${block.source})` }"
  ></div>
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
};
</script>

<style>
.anuncio-imagen-layout {
  width: 100%;
  height: 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
}
</style>