<template>
  <div class="modal">
    <button class="backbtn" @click="close()">X</button>
    <TabsCurso />
  </div>
</template>

<script>
import TabsCurso from "./TabsCurso";
export default {
  name: "curso-modal",
  components: { TabsCurso },
  methods: {
    close() {
      // close disabled modal from component
      this.$xmodal.close();
    },
  },
};
</script>

<style>
.modal {
  padding: 5px;
  position: relative;
  width: 93%;
  height: 95%;
  background: white;
  border-radius: 8px;
  margin: 0 0 10px 0;
  display: block;
  justify-content: center;
}

.backbtn {
  z-index: 1;
  position: absolute;
  left: 0;
  font-weight: bolder;
  font-size: 20px;
  width: 45px;
  background-color: red;
}
</style>
