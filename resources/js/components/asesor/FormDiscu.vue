<template>
  <div>
    <div class="dropdown m-3">
      <button
        id="dLabeldis"
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="btn btn-primary"
      >
        <p class="line-d" v-if="!loading">Crear discusión</p>
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
            <label for="exampleDropdownFormEmail1">Tema</label>
            <input
              type="text"
              class="form-control"
              id="exampleDropdownFormEmail1"
              v-model="name"
            />
          </div>
          <div class="form-group">
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
          <div class="form-group">
            <input type="checkbox" id="checkbox" v-model="nuevacategoria" />
            <label for="checkbox">crear categoria</label>
          </div>
          <div class="form-group" v-if="nuevacategoria">
            <label for="namecategoria">Nombre categoria</label>
            <input
              type="text"
              class="form-control"
              id="namecategoria"
              v-model="namecategoria"
            />
            <label for="colorcategoria">Color:</label>
            <input type="color" name="colorcategoria" v-model="color" />
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
      name: "Nombre del tema",
      errorr: false,
      info: "",
      loading: false,
      discu: [],
      categoria: 0,
      nuevacategoria: false,
      namecategoria: "",
      color: "#b12525",
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
    categorias() {
      return this.$store.getters.categoriasview;
    },
  },
  methods: {
    dropmenu() {
      $("#dLabeldis").dropdown();
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

      if (this.nuevacategoria) {
        formData.append("nuevacategoria", "nuevasi");
        formData.append("categoria", this.namecategoria);
        formData.append("color", this.color);
      } else {
        formData.append("fcategoria", this.categoria);
        formData.append("nuevacategoria", "nuevano");
      }

      this.loading = true;
      axios
        .post("foro/" + this.curso.id + "/creartema", formData)
        .then((response) => {
          $("#dLabeldis").dropdown("toggle");
          this.errorr = false;
          this.discu = response.data;
          flash("Discusión creada", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash(
            "Fallo la creacion de la discusión: intenta mas tarde.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
          this.$emit("crear-d", {
            discusion: this.discu,
            nuevac: this.nuevacategoria,
          });
        });
    },
  },
};
</script>

<style>
</style>