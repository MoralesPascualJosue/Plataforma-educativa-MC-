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
        <p class="line-d" v-if="!loading">Crear curso</p>
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
            <label for="namecurso">Nombre del curso</label>
            <input type="text" class="form-control" id="namecurso" v-model="name" />
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción o mensage</label>
            <input type="text" class="form-control block-d" id="descripcion" v-model="description" />
          </div>
          <div class="form-group">
            <label>Imagen del curso</label>
            <input
              class="file-i"
              type="file"
              id="Filecover"
              ref="filecover"
              v-on:change="onChangeFileUpload()"
            />
            <img id="preview" alt="Imagen curso" class="preview-img" :src="previewimg" />
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      previewimg: "../resources/img-msg100.jpg",
      name: "Nombre",
      description: "Descripcion",
      filecover: "",
      errorr: false,
      info: "",
      loading: false,
      curso: {}
    };
  },
  methods: {
    dropmenu() {
      $("#dLabel").dropdown();
    },
    onChangeFileUpload() {
      this.filecover = this.$refs.filecover.files[0];
      this.previewimg = window.URL.createObjectURL(
        this.$refs.filecover.files[0]
      );
    },
    checkForm: function(e) {
      e.preventDefault();

      if (this.name == "" || this.description == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      if (this.file == "") {
        flash("Selecciona una imagen", "warning");
        return "fail";
      }

      let formData = new FormData();
      formData.append("cover", this.filecover);
      formData.append("title", this.name);
      formData.append("review", this.description);

      this.loading = true;
      axios
        .post("/storeac", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          $("#dLabel").dropdown("toggle");
          this.errorr = false;
          this.curso = response.data;
          flash("Curso creado", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash(
            "Fallo la creacion del curso: revisa los campos solicitados.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
          this.$emit("crear-curso", this.curso);
        });
    }
  }
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