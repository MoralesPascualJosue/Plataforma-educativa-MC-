<template>
  <div>
    <div
      v-if="curso.cover"
      class="curso-image"
      :style="{
        height: `${height}px`,
        backgroundImage: `url(${curso.cover})`,
      }"
      @click="openCurse"
    ></div>

    <div v-if="show" class="curso-tabs-content" id="curso-tabs-content">
      <TabsCurso @closetabs="closeCurse" />
    </div>
  </div>
</template>

<script>
import TabsCurso from "./TabsCurso";
export default {
  components: {
    TabsCurso,
  },
  props: {
    curso: {
      type: Object,
    },
    height: {
      type: Number,
      default: 168,
    },
  },
  data() {
    return {
      show: false,
    };
  },
  methods: {
    openCurse() {
      this.show = true;
      this.$store.commit("changecurso", this.curso);
    },
    closeCurse() {
      this.show = false;
    },
  },
};
</script>

<style>
.curso-image {
  background-position: center;
  background-size: cover;
  height: 200px;
  cursor: pointer;
  overflow: hidden;
}
.curso-tabs-content {
  position: fixed;
  left: 0;
  top: 0;
  padding: 1rem;
  animation-name: stretch;
  animation-duration: 0.5s;
  animation-timing-function: ease-out;
  animation-fill-mode: forwards;
}
@keyframes stretch {
  from {
    width: 0%;
    height: 100%;
  }
  to {
    width: 100%;
    height: 100%;
  }
}
</style>
