<template>
  <div class="actividadshow-layout">
    <div v-if="!loading">
      <div class="actividadshow-header">
        <h3 v-if="type == 'activitie'">{{ actividad.activitie.title }}</h3>
        <h3 v-else>{{ actividad.title }}</h3>
      </div>
      <Block
        v-if="type == 'activitie'"
        v-bind:contenidoinicial="actividad.task"
      />
      <TestShow v-else @entregas="entregas" />
    </div>
    <div v-else>
      <span>Cargando...</span>
    </div>
  </div>
</template>

<script>
import Block from "./Block";
import TestShow from "../Prueba/TestShow";
export default {
  data() {
    return {
      type: "activitie",
      loading: true,
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  components: {
    Block,
    TestShow,
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
      .then((res) => {
        this.$store.commit("changeactividad", res.data);
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      })
      .finally(() => {
        this.loading = false;
      });
  },
  methods: {
    entregas(operacion) {
      this.$emit("entregas", operacion);
    },
  },
};
</script>

<style>
.actividadshow-header {
  padding: 0.5rem;
  margin-bottom: 1rem;
}
</style>