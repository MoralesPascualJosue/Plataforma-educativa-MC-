<template>
  <div>
    <p>
      <router-link :to="{ name: 'Inicio' }">Inicio</router-link>|
      <router-link :to="{ name: 'Clases' }">Clases creadas</router-link>
    </p>

    <div class="container">
      <router-view></router-view>
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
</style>
