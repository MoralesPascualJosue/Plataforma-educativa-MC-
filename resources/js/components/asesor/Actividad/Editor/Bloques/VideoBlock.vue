<template>
  <div class="activitieeditor-image-container">
    <div class="activitieeditor-image-container-layout">
      <div class="activitieeditor-image-content" :style="propsContainer.props">
        <video
          preload="auto"
          controls=""
          class="video-js wm-100"
          data-setup="{}"
          :src="propsContainer.src.url"
          :width="propsContainer.src.width"
          :height="propsContainer.src.height"
        ></video>
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
            backgroundColor: "#ffffff",
          },
          src: {
            url: "/resources/icons/video-vacio.svg",
            height: "350",
          },
        };
      },
    },
  },
  data() {
    return {
      type: "video",
      propsContainer: this.propsContainerd,
    };
  },
};
</script>

<style>
</style>