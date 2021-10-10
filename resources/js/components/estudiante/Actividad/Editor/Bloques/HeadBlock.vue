<template>
  <div class="activitieeditor-heading-container">
    <div class="activitieeditor-heading-container-layout">
      <div class="activitieeditor-heading-content">
        <div
          class="activitieeditor-heading-content-body"
          :style="propsContainer.props"
        >
          {{ propsContainer.value }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isselecteddata: {
      type: Object,
      default: function () {
        return {
          isSelected: false,
        };
      },
    },
    propsContainerd: {
      type: Object,
      default: function () {
        return {
          props: {
            color: "#a2a2a2",
            fontSize: "22px",
            fontWeight: "300",
            lineHeight: "140%",
            textAlign: "left",
          },
          value: "¡Contenido por defecto bloque!",
        };
      },
    },
  },
  data() {
    return {
      type: "heading",
      propsContainer: this.propsContainerd,
    };
  },
};
</script>

<style>
</style>