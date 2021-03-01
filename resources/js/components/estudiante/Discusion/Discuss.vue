<template>
  <div ref="list" :class="{ 'zoom-down-cursor': isPopoutCoverActive }">
    <ModalDiscu :show="showModal" @close="showModal = false" />
    <slot :togglePopup="openPopup" />
  </div>
</template>

<script>
import ModalDiscu from "./ModalDiscu";
export default {
  data() {
    return {
      isPopoutCoverActive: false,
      showModal: false
    };
  },
  components: {
    ModalDiscu
  },
  methods: {
    openPopup(discu) {
      this.$store.commit("changediscu", discu);
      this.showModal = true;
    }
  }
};
</script>

<style lang="scss" scoped>
.listf {
  position: relative;
  width: 100%;
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(2, 48.5%);
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
    grid-template-columns: repeat(2, 33%);
  }
}

@media (max-width: 800px) {
  .list {
    grid-template-columns: repeat(1, 100%);
  }
}
</style>