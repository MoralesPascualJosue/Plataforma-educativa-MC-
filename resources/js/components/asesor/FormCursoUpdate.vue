<template>
  <div>
    <div class="dropdown al">
      <a
        href="javascript:void(0);"
        id="dLabelu"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="aside-link"
      >
        <p class="line-d" v-if="!loading">Editar curso</p>
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="loading"
        ></span>
        <p class="line-d" v-if="loading">Actualizando...</p>
      </a>
      <div class="dropdown-menu">
        <form class="px-4 py-3" @submit="checkForm">
          <div class="form-group">
            <label for="exampleDropdownFormEmail1">Nombre del curso</label>
            <input type="text" class="form-control" id="exampleDropdownFormEmail1" v-model="name" />
          </div>
          <div class="form-group">
            <label for="exampleDropdownFormPassword1">Descripción o mensage</label>
            <input
              type="text"
              class="form-control block-d"
              id="exampleDropdownFormPassword1"
              v-model="description"
            />
          </div>
          <div class="form-group">
            <label>Imagen del curso</label>
            <input
              class="file-i"
              type="file"
              id="File"
              ref="file"
              v-on:change="onChangeFileUpload()"
            />
            <img id="preview" alt="Imagen curso" class="preview-img" :src="previewimg" />
          </div>
          <button type="submit" class="btn btn-primary af">Editar</button>
        </form>
        <button class="btn btn-warning btn-af" @Click="closeform()">Cancear</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "Mi curso",
      description: "Descripción",
      previewimg: "../resources/img-msg100.jpg",
      file: "",
      errorr: false,
      info: "",
      loading: false
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    }
  },
  created() {
    this.name = this.curso.title;
    this.description = this.curso.review;
    this.previewimg = this.curso.cover;
  },
  methods: {
    closeform() {
      $("#dLabelu").dropdown("toggle");
    },
    dropmenu() {
      $(".dropdown-toggle").dropdown();
    },
    onChangeFileUpload() {
      this.file = this.$refs.file.files[0];
      this.previewimg = window.URL.createObjectURL(this.$refs.file.files[0]);
    },
    checkForm: function(e) {
      e.preventDefault();

      if (this.name == "" || this.description == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      let formData = new FormData();

      if (this.file != "") {
        formData.append("cover", this.file);
      }
      formData.append("title", this.name);
      formData.append("review", this.description);

      this.loading = true;
      axios
        .post("/updateac/" + this.curso.id, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          $("#dLabelu").dropdown("toggle");
          this.errorr = false;
          this.$store.commit("changecurso", response.data);
          this.$store.commit("updatecurso", response.data);
          flash("Curso actualizado", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash(
            "Fallo la actualizacion del curso: revisa los campos solicitados.",
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
.al {
  text-align: left;
}

.af {
  width: 75px;
}

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

.btn-af {
  width: 75px;
  margin-left: 23px;
}
</style>
