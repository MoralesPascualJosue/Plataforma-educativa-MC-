<template>
  <div class="listlinks-layout">
    <p class="listlinks-header">Enlaces</p>
    <div class="listlinks-body">
      <ul>
        <li v-for="(enlace, indexen) in listlinks" :key="indexen">
          <a :href="enlace.source" target="_blank"> {{ enlace.name }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    block: {
      type: Object,
      default: function () {
        return {
          type: "listlinks",
          source: [],
          width: 1,
          heigth: 1,
        };
      },
    },
  },
  computed: {
    listlinks() {
      return this.block.source;
    },
  },
};
</script>

<style>
.listlinks-layout {
  height: 100%;
  width: 100%;
  position: relative;
  overflow: hidden;
}

.listlinks-header {
  font-size: 20px;
  font-weight: bold;
}

.listlinks-body {
  overflow: auto;
  height: 90%;
}
.listlinks-body ul {
  padding: 0.5rem;
  list-style: none;
}

.listlinks-body ul li {
  display: flex;
  align-items: flex-end;
  padding: 0.2rem;
  justify-content: space-evenly;
}
.listlinks-body ul li a {
  text-underline-position: under;
  font-size: 18px;
}
</style>