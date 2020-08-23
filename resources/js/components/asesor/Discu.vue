<template>
  <div
    ref="imageWrapper"
    class="UncoverImage"
    @click="
            $emit('pop-image', objeto)
        "
  >
    <div
      v-if="objeto.colorCategoria"
      ref="image"
      class="categoria"
      :style="{
                height: `${height}px`,
                backgroundColor: `${objeto.colorCategoria}`
            }"
    >
      <span class="badge badge-light">VER</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    objeto: {
      type: Object
    },
    height: {
      type: Number,
      default: 100
    }
  }
};
</script>

<style lang="scss" scoped>
.categoria {
  background-position: center;
  background-size: cover;
  height: 100px;
  cursor: zoom-in;
}
</style>