<template>
  <div class="descriptioncomponent-layout">
    <div
      class="descriptioncomponent-body"
      :style="{ fontSize: `${block.size}`, textAlign: `${block.align}` }"
      v-html="block.source"
    ></div>
  </div>
</template>

<script>
export default {
  props: {
    block: {
      type: Object,
      default: function () {
        return {
          type: "description",
          source: "Descriocion component",
          width: 1,
          heigth: 1,
          size: 14,
          align: "inherit",
        };
      },
    },
  },
};
</script>

<style>
.descriptioncomponent-layout {
  height: 100%;
  width: 100%;
  cursor: pointer;
}
.descriptioncomponent-body {
  height: 100%;
  overflow: hidden;
}
.descriptioncomponent-body::first-letter {
  margin-left: 2rem;
  font-weight: bold;
  line-height: 2rem;
}
</style>