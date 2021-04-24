<template>
  <div class="modal-mask" @click="close" v-if="show">
    <div class="modal-container" @click.stop>
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    close: function () {
      this.$emit("close");
    },
  },
};
</script>

<style>
.modal-mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9998;
  animation: stretchm 0.5s ease-out;
}

.modal-container {
  position: relative;
  overflow: hidden;
  height: 95%;
  margin: 1rem;
  padding: 1rem;
  background-color: #fff;
  border-radius: 20px;
}

@keyframes stretchm {
  from {
    top: -100%;
  }
  to {
    top: 0%;
  }
}
</style>
