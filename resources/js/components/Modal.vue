<template>
  <div class="modal-mask" @click="close" v-show="show">
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
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.5s ease;
  z-index: 9998;
}

.modal-container {
  overflow: hidden;
  height: 95%;
  margin: 1rem;
  padding: 1rem;
  background-color: #fff;
  border-radius: 20px;
  transition: all 1s linear;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
