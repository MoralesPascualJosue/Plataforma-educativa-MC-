<template>
  <div
    ref="list-actividades"
    class="list-actividades"
    :class="{ 'zoom-down-cursor': isPopoutCoverActive }"
  >
    <slot :togglePopup="openPopup" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      isPopoutCoverActive: false
    };
  },
  beforeCreate() {
    // this.isPopout = false;
  },
  methods: {
    openPopup() {
      //this.$store.commit("changecurso", { id: 77, title: "77" });
      //this.$xmodal.open();
    }
  }
};
</script>

<style lang="scss" scoped>
.list-actividades {
  position: relative;
  width: 100%;
  display: inline-block;
  &.zoom-down-cursor {
    cursor: zoom-out;
  }
}
</style>