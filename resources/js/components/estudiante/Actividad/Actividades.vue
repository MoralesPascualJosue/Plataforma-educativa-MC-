<template>
  <div
    ref="list-actividades"
    class="list-actividades"
    :class="{ 'zoom-down-cursor': isPopoutCoverActiveA }"
  >
    <ModalActividad :show="showModal" @close="showModal = false" />
    <slot :togglePopup="openPopup" />
  </div>
</template>

<script>
import ModalActividad from "./ModalActividad";
export default {
  data() {
    return {
      isPopoutCoverActiveA: false,
      showModal: false,
    };
  },
  components: { ModalActividad },
  methods: {
    openPopup(actividad) {
      this.$store.commit("activities/changeactividad", {
        activitie: actividad,
      });
      this.showModal = true;
    },
  },
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