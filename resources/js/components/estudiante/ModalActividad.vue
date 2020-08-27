<template>
  <div>
    <modal :show="show" @close="close">
      <button class="btn btn-primary backbtna" @click="close()">X</button>
      <div class="modal-body">
        <!-- Form fields removed for brevity -->
        <TabsActividad v-if="show" @close="close" />
      </div>

      <div class="modal-footer text-right"></div>
    </modal>
  </div>
</template>

<script>
import Modal from "../Modal";
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
.backbtna {
  z-index: 1;
  width: 45px;
  border-radius: 100%;
  position: absolute;
  right: 4%;
  font-weight: bolder;
  font-size: 20px;
}
</style>