<template>
  <div class="d-inline-block">
    <div class="dropdown al">
      <a
        href="javascript:void(0);"
        id="dLabelut"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="aside-link"
      >
        <p class="line-d" v-if="!loading">Editar tema</p>
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
            <label for="exampleDropdownFormEmail1">Tema</label>
            <input type="text" class="form-control" id="exampleDropdownFormEmail1" v-model="name" />
          </div>
          <div class="form-group">
            <label for="exampleDropdownFormPassword1">categoria</label>
            <select v-model="categoria">
              <option disabled value>Selecciona una categoria</option>
              <option
                v-for="(categoria, indexcaf) in categorias"
                :key="indexcaf"
                :value="categoria.id"
              >{{categoria.name}}</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary btnig">Editar tema</button>
        </form>
        <button class="btn btn-warning btn-af btnig" @click="closeformut()">Cancelar</button>
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
      color: ""
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
    categorias() {
      return this.$store.getters.categoriasview;
    },
    discusion() {
      return this.$store.getters.discuview;
    }
  },
  created() {
    this.name = this.discusion.title;
    this.namecategoria = this.discusion.nameCategoria;
    this.color = this.discusion.colorCategoria;

    const indexa = this.categorias.findIndex(
      item => item.id === this.discusion.fcategoria
    );
    this.categoria = this.categorias.length - indexa;
  },
  methods: {
    closeformut() {
      $("#dLabelut").dropdown("toggle");
    },
    dropmenu() {
      $("#dLabelut").dropdown();
    },
    onChangeFileUpload() {
      this.file = this.$refs.file.files[0];
      this.previewimg = window.URL.createObjectURL(this.$refs.file.files[0]);
    },
    checkForm: function(e) {
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
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          $("#dLabelut").dropdown("toggle");
          this.errorr = false;
          this.$store.commit("changediscu", response.data);
          this.$store.commit("updatediscuss", response.data);
          flash("tema actualizado", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash(
            "Fallo la actualizacion del tema: revisa los campos solicitados.",
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
.btnig {
  width: 100px;
}
</style>