<template>
  <div>
    <p class="slidemenu">
      <router-link :to="{ name: 'Inicio' }">
        <p class="icon">🏠</p>
        <span>Inicio</span></router-link
      >
      <router-link :to="{ name: 'Clases' }">
        <p class="icon">✍</p>
        <span>Clases</span></router-link
      >
      <router-link :to="{ name: 'Miinformacion' }"
        ><p class="icon">🎓</p>
        <span>Mi información</span></router-link
      >
    </p>

    <div class="container">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>
<script>
</script>
<style>
.fade-enter-active,
.fade-leave-active {
  transition-duration: 0.2s;
  transition-property: opacity;
  transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}
/**nuevos ajustes */

.slidemenu {
  max-width: 25rem;
  overflow: hidden;
  margin-top: -3.2rem;
  margin-left: 8rem;
}

.slidemenu a {
  width: 30%;
  text-align: center;
  display: block;
  float: left;
  color: #3490dc;
  opacity: 0.4;
}

.slidemenu a:hover {
  cursor: pointer;
  color: #666;
}

.slidemenu a span {
  padding: 0px;
}

.slidemenu a .icon {
  font-size: 20px;
  border: solid 2px #3490dc;
  text-align: center;
  height: 30px;
  width: 30px;
  display: block;
  margin: 0 auto;
  line-height: 28px;
  border-radius: 50%;
}

/*Animations*/
.slidemenu a {
  transition: all 500ms ease-in-out;
  -webkit-transition: all 500ms ease-in-out;
  -moz-transition: all 500ms ease-in-out;
}

/*Toggle*/
.slidemenu .router-link-active {
  opacity: 0.9;
}

@media (max-width: 767px) {
  .slidemenu {
    margin-left: 3rem;
  }
}
</style>
