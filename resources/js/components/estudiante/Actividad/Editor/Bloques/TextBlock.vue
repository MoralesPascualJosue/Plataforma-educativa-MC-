<template>
  <div class="activitieeditor-text-container">
    <div class="activitieeditor-text-container-layout">
      <div
        class="activitieeditor-text-content"
        :style="{
          textAlign: propsContainer.props.textAlign,
          color: propsContainer.props.color,
          fontSize: propsContainer.props.fontSize,
          lineHeight: propsContainer.props.lineHeight,
        }"
        v-html="propsContainer.value"
      >
        <p class="activitieeditor-text-content-body"></p>
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
            fontSize: "14px",
            lineHeight: "140%",
            color: "#000000",
            textAlign: "left",
          },
          value: "i´m a text default",
        };
      },
    },
  },
  data() {
    return {
      type: "text",
      propsContainer: this.propsContainerd,
    };
  },
};
</script>

<style>
.activitieeditor-text-content p {
  color: inherit;
}
</style>