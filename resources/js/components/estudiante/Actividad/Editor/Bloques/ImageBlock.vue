<template>
  <div class="activitieeditor-image-container">
    <div class="activitieeditor-image-container-layout">
      <div class="activitieeditor-image-content" :style="propsContainer.props">
        <img
          :src="propsContainer.src.url"
          :width="propsContainer.src.width"
          :height="propsContainer.src.height"
          alt="Image"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propsContainerd: {
      type: Object,
      default: function () {
        return {
          props: {
            textAlign: "center",
            backgroundColor: "#ffffff",
          },
          src: {
            url: "/resources/icons/imagen-vacio.svg",
            height: "100",
            width: "179",
          },
        };
      },
    },
  },
  data() {
    return {
      type: "image",
      propsContainer: this.propsContainerd,
    };
  },
};
</script>

<style>
</style>