<template>
  <div>
    <div class="dropdown m-3">
      <button
        id="dLabel"
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="btn btn-primary"
      >
        <p class="line-d" v-if="!loading">Agregar curso</p>
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="loading"
        ></span>
        <p class="line-d" v-if="loading">Creando...</p>
      </button>
      <div class="dropdown-menu">
        <form class="px-4 py-3" @submit="checkForm">
          <div class="form-group">
            <label for="namecurso">Codigo del curso</label>
            <input
              type="text"
              class="form-control"
              id="namecurso"
              v-model="name"
            />
          </div>
          <button type="submit" class="btn btn-primary">Agregar</button>
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
        .catch((response) => {
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
</style>