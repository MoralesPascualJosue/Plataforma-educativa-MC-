<template>
  <div class="example container">
    <div v-if="!loading">
      <div class="modal-header">
        <h3 v-if="type == 'activitie'">{{actividad.activitie.title}}</h3>
        <h3 v-else>{{actividad.title}}</h3>
      </div>
      <Block v-if="type == 'activitie'" v-bind:contenidoinicial="actividad.task" />
      <TestShow v-else @entregas="entregas" />
    </div>
    <div v-else>
      <span
        class="spinner-border width: 3rem; height: 3rem;-sm mt-3"
        role="status"
        aria-hidden="true"
      ></span>
    </div>
  </div>
</template>

<script>
import Block from "./Block";
import TestShow from "./TestShow";
export default {
  data() {
    return {
      type: "activitie",
      loading: true
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    }
  },
  components: {
    Block,
    TestShow
  },
  created() {
    let url = "/sactivitiec/";
    this.type = "activitie";
    if (this.actividad.activitie.type != "activitie") {
      url = "/test/show/";
      this.type = "test";
    }

    axios
      .get(url + this.actividad.activitie.id)
      .then(res => {
        this.$store.commit("changeactividad", res.data);
      })
      .finally(() => {
        this.loading = false;
      });
  },
  methods: {
    entregas(operacion) {
      this.$emit("entregas", operacion);
    }
  }
};
</script>

<style>
</style>