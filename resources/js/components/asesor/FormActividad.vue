<template>
  <div>
    <div class="container">
      <form class="px-4 py-3 row" @submit="checkForm">
        <div class="col">
          <div class="form-group">
            <label for="title">Nombre de la actividad</label>
            <input type="text" class="form-control" id="title" v-model="title" />
          </div>
          <div class="form-group">
            <label for="visible">Visible para los estudiantes</label>
            <input type="checkbox" class="form-control block-d" id="visible" v-model="visible" />
          </div>
          <div class="form-group">
            <label for="intentosdisponibles">Intentos disponibless</label>
            <input
              type="number"
              class="form-control block-d"
              id="intentosdisponibles"
              v-model="intentos"
            />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="fechainicio">Fecha de inicio</label>
            <input type="date" class="form-control block-d" id="fechainicio" v-model="fechainicio" />
          </div>
          <div class="form-group">
            <label for="fechafinal">Fecha final</label>
            <input type="date" class="form-control block-d" id="fechafinal" v-model="fechafinal" />
          </div>
          <button type="submit" class="btn btn-primary">
            <p class="line-d" v-if="!loading">Editar actividad</p>
            <span
              class="spinner-border spinner-border-sm"
              role="status"
              aria-hidden="true"
              v-if="loading"
            ></span>
            <p class="line-d" v-if="loading">Actualizando...</p>
          </button>
        </div>
      </form>
      <button class="btn btn-warning" @click="restaurarvaloresa()">Restaurar valores</button>
    </div>
    <a href="javascript:void(0)" class="aside-link" @click="eliminarac()">Eliminar actividad</a>
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
      loading: false
    };
  },
  computed: {
    actividad() {
      return this.$store.getters.actividadview;
    }
  },
  created() {
    this.title = this.actividad.activitie.title;
    this.visible = this.actividad.activitie.visible;
    this.intentos = this.actividad.activitie.intentos;
    this.fechainicio = this.actividad.activitie.fecha_inicio;
    this.fechafinal = this.actividad.activitie.fecha_final;
    jQuery(function($) {
      $("#fechafinal").prop("min", $("#fechainicio").val());
    });
  },
  beforeUpdate() {
    jQuery(function($) {
      $("#fechafinal").prop("min", $("#fechainicio").val());
    });
  },
  methods: {
    restaurarvaloresa() {
      this.title = this.actividad.activitie.title;
      this.visible = this.actividad.activitie.visible;
      this.intentos = this.actividad.activitie.intentos;
      this.fechainicio = this.actividad.activitie.fecha_inicio;
      this.fechafinal = this.actividad.activitie.fecha_final;
    },
    checkForm: function(e) {
      e.preventDefault();

      if (this.title == "" || this.intentos == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      if (this.intentos < 1) {
        flash(
          "Numero de intentos disponibles mal establecido: prueba otra vez",
          "warning"
        );
        return "fail";
      }

      let formData = new FormData();

      formData.append("title", this.title);
      formData.append("visible", this.visible);
      formData.append("intentos", this.intentos);
      formData.append("fecha_inicio", this.fechainicio);
      formData.append("fecha_final", this.fechafinal);

      this.loading = true;

      axios
        .post("/updateaa/" + this.actividad.activitie.id, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.errorr = false;
          this.$store.commit("updateactividad", response.data);
          flash("Actividad actualizada", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash(
            "Fallo la actualizacion de la actividad: intentalo más tarde",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
    eliminarac() {
      const confirmacion = confirm(`Eliminar actividad: ${this.title}`);
      if (confirmacion) {
        axios.delete(`/destroyaa/${this.actividad.activitie.id}`).then(() => {
          this.$store.commit("deleteteactividad", this.actividad.activitie);
          flash("Actividad Eliminada", "info");
          this.$emit("close");
        });
      }
    }
  }
};
</script>

<style>
</style>