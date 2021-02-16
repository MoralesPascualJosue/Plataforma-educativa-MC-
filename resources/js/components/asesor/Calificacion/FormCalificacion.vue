<template>
  <div class="actividad-entregas-formcalificacion-layout">
    <a
      href="javascript:void(0);"
      @click="showmenu = !showmenu"
    >
      <p v-if="!loadingc">Calificar <span v-show="!showmenu">+</span><span v-show="showmenu">-</span></p>
      <p v-if="loadingc">Actualizando...</p>
    </a>
    <div v-show="showmenu" class="actividad-entregas-formcalificacion-menu">
      <form class="actividad-entregas-formcalificacion-form" @submit="checkForm">
        <div class="actividad-entregas-formcalificacion-formgroup">
          <label for="calificacion">Calificación</label>
          <input type="number" id="calificacion" v-model="calificacion"/>
        </div>
        <button type="submit" class="actividad-entregas-formcalificacion-form-sumitbottom">Calificar</button>
      </form>
      <button class="actividad-entregas-formcalificacion-cancelbottom" @click="showmenu = false">
        Cancelar
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    estudiante: {
      id: 0,
    },
    activitie: {
      type: Number,
      default: -1,
    },
  },
  data() {
    return {
      showmenu: false, 
      calificacion: this.estudiante.qualificationqualification,
      errorrc: false,
      loadingc: false,
    };
  },
  methods: {
    checkForm: function (e) {
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
        .then((response) => {
          this.showmenu = false;
          this.errorrc = false;
          flash("Calificacion actualizada", "success");

          this.$emit("asignar-calificacion", response.data);
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorrc = true;
          flash(
            "Fallo la asignacion de calificacion: intenta mas tarde.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style>
.actividad-entregas-formcalificacion-menu {
  position: absolute;
  background-color: #fcd770;
  padding: 0.5rem;
  border-radius: 20px;
}
.actividad-entregas-formcalificacion-formgroup label{
  display: block;
}
.actividad-entregas-formcalificacion-form-sumitbottom {
  border: none;
  padding: 0.5rem;
  background-color: #f0f0f0;
  width: 100%;
  margin-top: 0.2rem;
  cursor: pointer;
}
.actividad-entregas-formcalificacion-form-sumitbottom:hover {
  background-color: #fcb036;
}
.actividad-entregas-formcalificacion-cancelbottom {
  border:none;
  padding: 0.5rem;
  background-color: #f0f0f0;
  width: 100%;
  margin-top:0.2rem;
  cursor: pointer;
}
.actividad-entregas-formcalificacion-cancelbottom:hover {
  background-color: #fcb036;
}
</style>
