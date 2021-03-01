<template>
  <div ref="list" :class="{ 'zoom-down-cursor': isPopoutCoverActive }">
    <slot :togglePopup="openPopup" />
    <xmodal v-model="ismodalOpen" :params="options" />
  </div>
</template>

<script>
import ModalCurso from "./ModalCurso";
export default {
  data() {
    return {
      isPopoutCoverActive: false,
      ismodalOpen: false,
      // basic modal options
      options: {
        component: ModalCurso,
        backgroundColor: "rgb(169 194 203)",
        opacity: "0.7",
        animation: "scaleIn",
      },
    };
  },
  methods: {
    openPopup(curso) {
      this.$store.commit("changecurso", curso);
      this.ismodalOpen = true;
    },
  },
};
</script>

<style>
</style>
