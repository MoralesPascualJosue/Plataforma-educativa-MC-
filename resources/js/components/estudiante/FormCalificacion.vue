<template>
  <div class="dropdown m-3 d-inline-block">
    <a
      href="javascript:void(0);"
      id="dLabelqc"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      @click="dropmenuqc()"
      class="aside-link"
    >
      <p class="line-d" v-if="!loadingc">Calificar</p>
      <span
        class="spinner-border spinner-border-sm"
        role="status"
        aria-hidden="true"
        v-if="loadingc"
      ></span>
      <p class="line-d" v-if="loadingc">Actualizando...</p>
    </a>
    <div class="dropdown-menu">
      <form class="px-4 py-3" @submit="checkForm">
        <div class="form-group">
          <label for="calificacion">Calificación</label>
          <input type="number" class="form-control" id="calificacion" v-model="calificacion" />
        </div>
        <button type="submit" class="btn btn-primary af">Calificar</button>
      </form>
      <button class="btn btn-warning btn-af" @click="closeformqc()">Cancelar</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    estudiante: {
      id: 0
    },
    activitie: {
      type: Number,
      default: -1
    }
  },
  data() {
    return {
      calificacion: this.estudiante.qualificationqualification,
      errorrc: false,
      loadingc: false
    };
  },
  methods: {
    closeformqc() {
      $("#dLabelqc").dropdown("toggle");
    },
    dropmenuqc() {
      $("#dLabelqc").dropdown();
    },
    checkForm: function(e) {
      e.preventDefault();

      if (this.calificacion == "") {
        flash("Calificacion vacia", "warning");
        return "fail";
      }

      let formData = new FormData();

      formData.append("calificacion", this.calificacion);
      formData.append("estudiante", this.estudiante.id);

      this.loading = true;
      axios
        .post("/updateaw/" + this.activitie, formData)
        .then(response => {
          $("#dLabelqc").dropdown("toggle");
          this.errorrc = false;
          flash("Calificacion actualizada", "success");

          this.$emit("asignar-calificacion", response.data);
        })
        .catch(response => {
          this.errorrc = true;
          flash(
            "Fallo la asignacion de calificacion: intenta mas tarde.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>

<style>
</style>