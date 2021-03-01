<template>
  <div>
    <div class="detallesactividad-layout">
      <div class="col">
        <div class="form-group">
          <label for="title">Nombre</label>
          <p class="form-control" id="title" v-text="title"></p>
        </div>
        <div class="form-group">
          <label for="intentosdisponibles">Intentos disponibless</label>
          <p
            class="form-control block-d"
            id="intentosdisponibles"
            v-text="intentos"
          ></p>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="fechainicio">Fecha de inicio</label>
          <p
            class="form-control block-d"
            id="fechainicio"
            v-text="fechainicio"
          ></p>
        </div>
        <div class="form-group">
          <label for="fechafinal">Fecha final</label>
          <p
            class="form-control block-d"
            id="fechafinal"
            v-text="fechafinal"
          ></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Mi actividad",
      visible: false,
      intentos: 1,
      fechainicio: "",
      fechafinal: "",
      loading: false,
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  created() {
    this.title = this.actividad.activitie.title;

    if (this.actividad.activitie.type != "activitie") {
      this.visible = this.actividad.activitie.result_release;
      this.intentos = this.actividad.activitie.num_takes;
      this.fechainicio = this.actividad.activitie.fecha_inicio;
      this.fechafinal = this.actividad.activitie.fecha_final;
    } else {
      this.visible = this.actividad.activitie.visible;
      this.intentos = this.actividad.activitie.intentos;
      this.fechainicio = this.actividad.activitie.fecha_inicio;
      this.fechafinal = this.actividad.activitie.fecha_final;
    }
  },
};
</script>

<style>
.detallesactividad-layout {
  background-color: #fcd770;
  margin-top: 1rem;
  padding: 1rem;
  display: grid;
  grid-template-columns: auto auto;
}
.detallesactividad-layout .form-group label {
  padding: 0.5rem;
  border-radius: 20px;
}

.detallesactividad-layout .form-group p {
  padding: 0.5rem;
  font-size: 18px;
  background-color: white;
}

@media only screen and (max-width: 1050px) {
  .detallesactividad-layout {
    display: inherit;
  }
}
</style>