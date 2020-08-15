<template>
  <div class="modal">
    <button @click="close()">Close modal</button>
    <ListaActividades />
  </div>
</template>

<script>
import ListaActividades from "./ListaActividades";
export default {
  name: "myModal",
  components: { ListaActividades },
  computed: {
    curso() {
      return this.$store.state.curso;
    }
  },
  methods: {
    close() {
      // close disabled modal from component
      this.$xmodal.close();
    }
  }
};
</script>

<style>
.modal {
  position: relative;
  width: 90%;
  height: 95%;
  background: white;
  border-radius: 8px;
  margin: 0 0 10px 0;
  display: block;
  justify-content: center;
}
</style>
