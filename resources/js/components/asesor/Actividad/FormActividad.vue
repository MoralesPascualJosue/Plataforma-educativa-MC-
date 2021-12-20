<template>
  <div>
    <div class="actividad-formactividad-layout">
      <form class="px-4 py-3 row" @submit="checkForm">
        <div class="col">
          <div class="actividad-formactividad-layout-formgroup">
            <label for="title">Nombre</label>
            <input
              type="text"
              class="form-control"
              id="title"
              v-model="title"
            />
          </div>
          <div class="actividad-formactividad-layout-formgroup">
            <label for="visible">Visible para los estudiantes</label>
            <input
              type="checkbox"
              class="form-control block-d"
              id="visible"
              v-model="visible"
            />
          </div>
          <div class="actividad-formactividad-layout-formgroup">
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
          <div class="actividad-formactividad-layout-formgroup">
            <label for="fechainicio">Fecha de inicio</label>
            <input
              type="date"
              class="form-control block-d"
              id="fechainicio"
              v-model="fechainicio"
            />
          </div>
          <div class="actividad-formactividad-layout-formgroup">
            <label for="fechafinal">Fecha final</label>
            <input
              type="date"
              class="form-control block-d"
              id="fechafinal"
              v-model="fechafinal"
            />
          </div>
          <button type="submit" class="actividad-formactividad-sumitbottom">
            <p class="line-d" v-if="!loading">Guardar cambios</p>
            <p class="line-d" v-if="loading">Actualizando...</p>
          </button>
        </div>
      </form>
      <button
        class="actividad-formactividad-restaurarvaloresa"
        @click="restaurarvaloresa()"
      >
        Restaurar valores
      </button>
    </div>
    <a href="javascript:void(0)" class="aside-link" @click="eliminarac()">
      <p v-if="this.actividad.num_takes >= 0">Eliminar prueba</p>
      <p v-else>Eliminar actividad</p>
    </a>
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
      return this.$store.getters["activities/actividadview"];
    },
  },
  created() {
    this.title = this.actividad.activitie.title;

    if (this.actividad.activitie.type != "activitie") {
      this.visible = this.actividad.activitie.visible;
      this.intentos = this.actividad.activitie.num_takes;
      this.fechainicio = this.actividad.activitie.fecha_inicio;
      this.fechafinal = this.actividad.activitie.fecha_final;
    } else {
      this.visible = this.actividad.activitie.visible;
      this.intentos = this.actividad.activitie.intentos;
      this.fechainicio = this.actividad.activitie.fecha_inicio;
      this.fechafinal = this.actividad.activitie.fecha_final;
    }

    jQuery(function ($) {
      $("#fechafinal").prop("min", $("#fechainicio").val());
    });
  },
  beforeUpdate() {
    jQuery(function ($) {
      $("#fechafinal").prop("min", $("#fechainicio").val());
    });
  },
  methods: {
    restaurarvaloresa() {
      if (this.actividad.num_takes >= 0) {
        this.title = this.actividad.title;
        this.visible = this.actividad.visible;
        this.intentos = this.actividad.num_takes;
        this.fechainicio = this.actividad.fecha_inicio;
        this.fechafinal = this.actividad.fecha_final;
      } else {
        this.title = this.actividad.activitie.title;
        this.visible = this.actividad.activitie.visible;
        this.intentos = this.actividad.activitie.intentos;
        this.fechainicio = this.actividad.activitie.fecha_inicio;
        this.fechafinal = this.actividad.activitie.fecha_final;
      }
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.title == "") {
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

      let url = "";
      if (this.actividad.num_takes >= 0) {
        url = "/updateat/" + this.actividad.id;
      } else {
        url = "/updateaa/" + this.actividad.activitie.id;
      }
      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.errorr = false;
          this.$store.commit("activities/updateactividad", response.data);
          flash("Contenido actualizado", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          this.errorr = true;
          flash(
            "Fallo la actualizacion del contenido: intentalo más tarde",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
    eliminarac() {
      let url = "";
      let mensaje = "";
      if (this.actividad.num_takes >= 0) {
        url = `/destroyat/${this.actividad.id}`;
        mensaje = "Eliminar prueba: ";
      } else {
        url = `/destroyaa/${this.actividad.activitie.id}`;
        mensaje = "Eliminar actividad: ";
      }

      const confirmacion = confirm(`${mensaje} ${this.title}`);

      if (confirmacion) {
        axios
          .delete(url)
          .then(() => {
            if (this.actividad.num_takes >= 0) {
              this.$store.commit(
                "activities/deleteteactividad",
                this.actividad
              );
              flash("Prueba Eliminada", "info");
            } else {
              this.$store.commit(
                "activities/deleteteactividad",
                this.actividad.activitie
              );
              flash("Actividad Eliminada", "info");
            }

            this.$emit("close");
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });
      }
    },
  },
};
</script>

<style>
.actividad-formactividad-layout {
  background-color: #fcd770;
  padding: 1rem;
  border-radius: 20px;
}
.actividad-formactividad-layout form {
  display: grid;
  grid-template-columns: 50% 50%;
}
.actividad-formactividad-layout-formgroup {
  padding: 0.5rem;
}
.actividad-formactividad-layout-formgroup label {
  display: block;
}
.actividad-formactividad-layout-formgroup input {
  height: 3rem;
  width: 100%;
  padding: 1rem;
  font-size: 15px;
}
.actividad-formactividad-sumitbottom {
  border: none;
  background-color: #f0f0f0;
  padding: 0.5rem;
  margin-top: 0.3rem;
  width: 100%;
}
.actividad-formactividad-sumitbottom:hover {
  background-color: #fcb036;
}
.actividad-formactividad-restaurarvaloresa {
  border: none;
  background-color: #f0f0f0;
  padding: 0.5rem;
  margin-top: 0.3rem;
}
.actividad-formactividad-restaurarvaloresa:hover {
  background-color: #fcb036;
}
@media only screen and (max-width: 1050px) {
  .actividad-formactividad-layout form {
    grid-template-columns: auto;
  }
}
</style>
