<template>
  <div class="d-inline-block">
    <div class="dropdown al">
      <a
        href="javascript:void(0);"
        id="dLabelut"
        @click="showmenu = !showmenu"
        class="aside-link"
      >
        <p class="line-d" v-if="!loading">Editar tema</p>
        <p class="line-d" v-if="loading">Actualizando...</p>
      </a>
      <div v-if="showmenu" class="formdiscuupdate-menucontent">
        <form class="px-4 py-3" @submit="checkForm">
          <div class="formcommentupdate-formgroup">
            <label for="exampleDropdownFormEmail1">Tema</label>
            <input
              type="text"
              class="form-control"
              id="exampleDropdownFormEmail1"
              v-model="name"
            />
          </div>
          <div class="formcommentupdate-formgroup">
            <label for="exampleDropdownFormPassword1">categoria</label>
            <select v-model="categoria">
              <option disabled value>Selecciona una categoria</option>
              <option
                v-for="(categoria, indexcaf) in categorias"
                :key="indexcaf"
                :value="categoria.id"
              >
                {{ categoria.name }}
              </option>
            </select>
          </div>
          <button type="submit" class="formcommentupdate-editar">
            Editar tema
          </button>
        </form>
        <button class="formcommentupdate-cancelar" @click="closeformut()">
          Cancelar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showmenu: false,
      name: "Nombre del tema",
      errorr: false,
      info: "",
      loading: false,
      discu: [],
      categoria: 0,
      nuevacategoria: false,
      namecategoria: "",
      color: "",
    };
  },
  computed: {
    curso() {
      return this.$store.getters["cursos/cursoview"];
    },
    categorias() {
      return this.$store.getters["foro/categoriasview"];
    },
    discusion() {
      return this.$store.getters["foro/discuview"];
    },
  },
  created() {
    this.name = this.discusion.title;
    this.namecategoria = this.discusion.nameCategoria;
    this.color = this.discusion.colorCategoria;
    this.categoria = this.discusion.fcategoria;
  },
  methods: {
    closeformut() {
      this.showmenu = false;
    },
    onChangeFileUpload() {
      this.file = this.$refs.file.files[0];
      this.previewimg = window.URL.createObjectURL(this.$refs.file.files[0]);
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.name == "") {
        flash("El nombre del tema no puede estar vacío", "warning");
        return "fail";
      }

      if (this.nuevacategoria) {
        if (this.namecategoria == "") {
          flash("Falta nombre de la nueva categoria", "warning");
          return "fail";
        }
      } else if (this.categoria == "") {
        flash("Selecciona o crea una categoria categoria", "warning");
        return "fail";
      }

      let formData = new FormData();
      formData.append("title", this.name);
      formData.append("color", this.color);

      if (this.nuevacategoria) {
        formData.append("nuevacategoria", "nuevasi");
        formData.append("categoria", this.namecategoria);
      } else {
        formData.append("fcategoria", this.categoria);
        formData.append("nuevacategoria", "nuevano");
      }

      this.loading = true;
      axios
        .post("/foro/update/" + this.discusion.id, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.errorr = false;
          this.showmenu = false;
          this.$store.commit("foro/changediscu", response.data);
          this.$store.commit("foro/updatediscuss", response.data);
          flash("tema actualizado", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash(
            "Fallo la actualizacion del tema: revisa los campos solicitados.",
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
.formcommentupdate-formgroup {
  margin-bottom: 0.5rem;
}
.formcommentupdate-formgroup label {
  display: block;
}
.formcommentupdate-formgroup input {
  padding: 0.5rem;
  width: 100%;
}
.formcommentupdate-formgroup select {
  padding: 0.5rem;
  width: 100%;
}
.formcommentupdate-editar {
  border: none;
  font-size: 1rem;
  padding: 0.5rem;
  cursor: pointer;
  background-color: #fdc770;
  width: 7rem;
}
.formcommentupdate-editar:hover {
  background-color: #fcb036;
}
.formcommentupdate-cancelar {
  width: 7rem;
  border: none;
  font-size: 1rem;
  padding: 0.5rem;
  cursor: pointer;
  background-color: #e0e0e2;
}
.formcommentupdate-cancelar:hover {
  background-color: #fcb036;
}
.btnig {
  width: 100px;
}
</style>
