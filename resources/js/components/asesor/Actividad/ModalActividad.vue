<template>
  <div>
    <modal :show="show" @close="close">
      <button class="modalactividad-closebottom" @click="close()">X</button>
      <div class="modal-body">
        <TabsActividad v-if="show" @close="close" />
      </div>
    </modal>
  </div>
</template>

<script>
import Modal from "../../Modal";
import TabsActividad from "./TabsActividad";
export default {
  props: {
    show: {
      type: Boolean,
      default: false
    }
  },
  components: {
    Modal,
    TabsActividad
  },
  methods: {
    close: function() {
      this.$emit("close");
    }
  }
};
</script>

<style>
.modalactividad-closebottom {
  z-index: 1;
  padding: 0.7rem;
  position: absolute;
  font-weight: bolder;
  font-size: 20px;
  border: none;
}
@media only screen and (max-width: 1050px) {
  .modalactividad-closebottom {
    right: inherit;   
  }
}
.modalactividad-closebottom:hover {
  background-color: #fcb036;
}
.modal-body {
 position: relative;
 overflow-y: auto;
 height: 100%;
}
</style>
