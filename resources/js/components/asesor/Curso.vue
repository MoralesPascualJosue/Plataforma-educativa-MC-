<template>
  <div
    ref="imageWrapper"
    class="UncoverImage"
    @click="
            $emit('pop-image', curso)
        "
  >
    <div
      v-if="curso.cover"
      ref="image"
      class="image"
      :style="{
                height: `${height}px`,
                backgroundImage: `url(${curso.cover})`
            }"
    />
    <span
      v-if="curso.entregas>0"
      class="badge badge-primary float-right fontct"
    >Entregas por revisar: {{curso.entregas}}</span>
  </div>
</template>

<script>
export default {
  props: {
    curso: {
      type: Object
    },
    height: {
      type: Number,
      default: 168
    }
  }
};
</script>

<style lang="scss" scoped>
.image {
  background-position: center;
  background-size: cover;
  height: 168px;
  cursor: zoom-in;
}
</style>
