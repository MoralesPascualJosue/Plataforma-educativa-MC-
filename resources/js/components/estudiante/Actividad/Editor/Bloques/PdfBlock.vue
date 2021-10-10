<template>
  <div class="activitieeditor-docpdf-container">
    <div class="activitieeditor-docpdf-container-layout">
      <div class="activitieeditor-docpdf-content" :style="propsContainer.props">
        <iframe
          :src="propsContainer.src.url"
          frameborder="0"
          width="100%"
          :height="propsContainer.src.height"
        ></iframe>
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
            backgroundColor: "#f2f2f2",
          },
          src: {
            url: "/resources/icons/document-vacio.svg",
            height: "650",
          },
        };
      },
    },
  },
  data() {
    return {
      type: "Docpdf",
      propsContainer: this.propsContainerd,
    };
  },
};
</script>

<style>
.activitieeditor-docpdf-content {
  border: 1px solid #707070;
  padding-top: 20px;
}
.activitieeditor-docpdf-content iframe {
  background: white;
}
</style>