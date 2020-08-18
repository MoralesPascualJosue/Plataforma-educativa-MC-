<template>
  <div ref="list" class="list" :class="{ 'zoom-down-cursor': isPopoutCoverActive }">
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
        animation: "scaleIn"
      }
    };
  },
  methods: {
    openPopup(curso) {
      this.$store.commit("changecurso", curso);
      //this.$xmodal.open();
      // this.$xmodal.save("curso-modal", {
      //   component: Modal,
      //   backgroundColor: "#000000",
      //   opacity: "0.7",
      //   animation: "scaleIn"
      // });
      // this.$xmodal.openFromStore("curso-modal");
      this.ismodalOpen = true;
    }
  }
};
</script>

<style lang="scss" scoped>
.list {
  position: relative;
  width: 100%;
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(4, 23.5%);
  &.zoom-down-cursor {
    cursor: zoom-out;
  }
}
.cover {
  height: 100vh;
  width: 100vw;
  background-color: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  z-index: 999;
  left: 0;
}
.fade-enter-active {
  transition: opacity 0.25s;
}
.fade-leave-active {
  transition: opacity 0.25s;
  .cover-close {
    display: none;
  }
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}

@media (max-width: 1050px) {
  .list {
    grid-template-columns: repeat(3, 33%);
  }
}

@media (max-width: 800px) {
  .list {
    grid-template-columns: repeat(1, 100%);
  }
}
</style>
