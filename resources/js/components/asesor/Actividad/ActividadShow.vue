<template>
  <div class="actividadshow-layout">
    <div v-if="!loading">
      <div class="actividadshow-header">
        <h3 v-if="type == 'activitie'">{{ actividad.activitie.title }}</h3>
        <h3 v-else>{{ actividad.title }}</h3>
      </div>
      <activitie-editor
        v-if="type == 'activitie'"
        :contenidoinicial="actividad.task"
      />
      <TestShow v-else />
    </div>
    <div v-else>
      <span>Cargando ...</span>
    </div>
  </div>
</template>

<script>
import ActivitieEditor from "./Editor/ActivitieEditor.vue";
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
      return this.$store.getters["activities/actividadview"];
    },
  },
  components: {
    ActivitieEditor,
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
        this.$store.commit("activities/changeactividad", res.data);
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
};
</script>

<style>
.actividadshow-header {
  padding: 0.5rem;
  margin-bottom: 1rem;
}
.wm-100 {
  max-width: 100%;
}
</style>
