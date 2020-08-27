<template>
  <div>
    <p>
      <router-link :to="{ name: 'Inicio' }">Inicio</router-link>-
      <router-link :to="{ name: 'Clases' }">Clases registradas</router-link>-
      <router-link :to="{ name: 'Miinformacion' }">Mi información</router-link>
    </p>

    <div class="container">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style>
.router-link-active {
  color: blue;
  font-size: 20px;
}
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
</style>
