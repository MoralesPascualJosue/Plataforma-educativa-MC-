<template>
  <div class="card">
    <div class="formcurso-layout">
      <p>Agregar curso</p>
      <div class="dropdown-menu">
        <form class="px-4 py-3" @submit="checkForm">
          <div class="form-group">
            <label for="namecurso">Ingresa el codigo del curso</label>
            <input
              type="text"
              class="form-control"
              id="namecurso"
              v-model="name"
            />
          </div>
          <button type="submit" class="btn-agregarcurso">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "Código",
      errorr: false,
      info: "",
      loading: false,
      curso: {},
    };
  },
  methods: {
    dropmenu() {
      $("#dLabel").dropdown();
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.name == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      let formData = new FormData();
      formData.append("title", this.name);

      this.loading = true;
      axios
        .post("/matricular", formData)
        .then((response) => {
          $("#dLabel").dropdown("toggle");
          this.errorr = false;
          this.curso = response.data;
          flash("Curso registrado", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash("Fallo el registroo: intenta mas tarde.", "error");
        })
        .finally(() => {
          this.loading = false;
          this.$emit("crear-curso", this.curso);
        });
    },
  },
};
</script>

<style>
.block-d {
  display: block;
}

.preview-img {
  width: 326px;
  height: 100px;
  border-radius: 8px;
  display: block;
  margin-top: 5px;
}

.file-i {
  font-size: smaller;
  background: #f8fafc;
}

.line-d {
  display: inline;
}

.formcurso-layout {
  padding: 1rem;
}

.formcurso-layout input {
  padding: 0.5rem;
  margin: 0.5rem;
}

.btn-agregarcurso {
  border: none;
  padding: 0.5rem;
}

.btn-agregarcurso:hover {
  background-color: white;
}
</style>