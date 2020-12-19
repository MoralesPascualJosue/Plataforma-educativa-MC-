<template>
  <div
    ref="imageWrapper"
    class="UncoverImage"
    @click="$emit('pop-image', objeto)"
  >
    <div
      v-if="objeto.colorCategoria"
      ref="image"
      class="categoria"
      :style="{
        height: `${height}px`,
      }"
    >
      <h3>{{ objeto.title }}</h3>
      <span class="stb">Respuestas: {{ objeto.answered }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    objeto: {
      type: Object,
    },
    height: {
      type: Number,
      default: 100,
    },
  },
};
</script>

<style lang="scss" scoped>
.categoria {
  background-position: center;
  background-size: cover;
  height: 100px;
  cursor: zoom-in;
}
.stb {
  color: black;
  font-size: 15px;
}
</style>