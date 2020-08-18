<template>
  <div>
    <div class="modal-header">
      <h3>{{actividad.activitie.title}}</h3>
    </div>
    <Block v-bind:contenidoinicial="actividad.task" />
  </div>
</template>

<script>
import Block from "./Block";
export default {
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    }
  },
  components: {
    Block
  },
  created() {
    axios.get("/sactivitiec/" + this.actividad.activitie.id).then(res => {
      this.$store.commit("changeactividad", res.data);
    });
  }
};
</script>

<style>
</style>