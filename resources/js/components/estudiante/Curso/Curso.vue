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
    <p class="listacursos-layout-listacursos-curso-title">
      {{ curso.title }}
    </p>
    <transition name="stretch">
      <div v-if="show" class="curso-tabs-content" id="curso-tabs-content">
        <TabsCurso @closetabs="closeCurse" />
      </div>
    </transition>
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
      let principalpane = document.getElementsByClassName("app-container")[0];
      principalpane.style.left = "-100%";
    },
    closeCurse() {
      this.show = false;
      let principalpane = document.getElementsByClassName("app-container")[0];
      principalpane.style.left = "0%";
    },
  },
};
</script>

<style>
.app-container {
  position: relative;
  transition: left 0.5s ease-out;
  left: 0%;
}
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
  padding: 0.5rem;
  width: 100%;
  height: 100%;
}
.stretch-enter-active {
  animation: stretch 0.5s ease-out;
}
.stretch-leave-active {
  animation: stretch 0.5s reverse ease-in;
}
@keyframes stretch {
  from {
    left: 100%;
    width: 100%;
    height: 100%;
  }
  to {
    left: 0%;
    width: 100%;
    height: 100%;
  }
}
</style>
