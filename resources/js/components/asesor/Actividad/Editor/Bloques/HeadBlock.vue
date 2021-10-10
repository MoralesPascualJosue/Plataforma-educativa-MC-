<template>
  <div class="activitieeditor-heading-container">
    <div class="activitieeditor-heading-container-layout">
      <div class="activitieeditor-heading-content">
        <div
          class="activitieeditor-heading-content-body"
          ref="contentheader"
          :style="propsContainer.props"
          contenteditable
          @blur="onEdit"
          @keydown.enter="endEdit"
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
          value: "Heading default",
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
  methods: {
    onEdit(evt) {
      var src = evt.target.innerHTML;
      this.propsContainerd.value = src;
    },
    endEdit() {
      this.$refs.contentheader.blur();
    },
  },
};
</script>

<style>
</style>