<template>
  <div>
    <div
      v-if="cursodata.cover"
      class="curso-image"
      :style="{
        height: `${height}px`,
        backgroundImage: `url(${cursodata.cover})`,
      }"
      @click="openCurse"
    >
      <span v-if="cursodata.entregas > 0" class="curso-status">
        <img src="resources/icons/apilar.svg" alt="" />
        <span class="curso-status-text">{{ cursodata.entregas }}</span>
      </span>
    </div>
    <p class="listacursos-layout-listacursos-curso-title">
      {{ cursodata.title }}
    </p>
    <transition name="stretch">
      <div v-if="show" class="curso-tabs-content" id="curso-tabs-content">
        <TabsCurso @closetabs="closeCurse" @updatecurso="updateCurse" />
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
      cursodata: this.curso,
    };
  },
  methods: {
    openCurse() {
      this.show = true;
      this.$store.commit("changecurso", this.cursodata);
      let principalpane = document.getElementsByClassName("app-container")[0];
      principalpane.style.left = "-100%";
    },
    closeCurse() {
      this.show = false;
      let principalpane = document.getElementsByClassName("app-container")[0];
      principalpane.style.left = "0%";
    },
    updateCurse(curso) {
      this.cursodata = curso;
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
.curso-status {
  background-color: white;
  padding: 1rem;
  line-height: 3rem;
}
.curso-status img {
  width: 1.5rem;
  height: 1.5rem;
}
.curso-status-text {
  font-size: 14px;
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
