<template>
  <div>
    <div class="menuadddiscu">
      <button
        id="dLabeldis"
        type="button"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenuadddiscu()"
        class="buttonmenuadddiscu"
      >
        <p class="line-d creardiscu" v-if="!loading">Crear discusión</p>
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="loading"
        ></span>
        <p class="line-d creardiscu" v-if="loading">Creando...</p>
      </button>
      <div
        id="add-discus"
        class="display-n list-complete-item-f"
        :style="{
          backgroundColor: `${categoria.color}`,
        }"
      >
        <form class="px-4 py-3 discu-content" @submit="checkForm">
          <div class="form-group">
            <label for="newnamediscus">Tema</label>
            <input
              type="text"
              class="form-control"
              id="newnamediscus"
              v-model="name"
            />
          </div>
          <div class="form-group">
            <label>categoria</label>
            <select v-model="categoria">
              <option disabled value>Selecciona una categoria</option>
              <option
                v-for="(categoria, indexcaf) in categorias"
                :key="indexcaf"
                :value="categoria"
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
            <label for="namecategoriai">Nombre categoria</label>
            <input
              type="text"
              class="form-control"
              id="namecategoriai"
              v-model="namecategoria"
            />
            <label for="colorcategoria">Color:</label>
            <input
              type="color"
              name="colorcategoria"
              v-model="categoria.color"
            />
          </div>
          <button type="submit" class="btn-newdiscu">Crear discusión</button>
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
      categoria: {
        id: -1,
        color: "#b12525",
        name: "categoria",
      },
      nuevacategoria: false,
      namecategoria: "",
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
    dropmenuadddiscu() {
      $("#add-discus").toggleClass("display-n");
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
        formData.append("color", this.categoria.color);
      } else {
        formData.append("fcategoria", this.categoria.id);
        formData.append("nuevacategoria", "nuevano");
      }

      this.loading = true;
      axios
        .post("foro/" + this.curso.id + "/creartema", formData)
        .then((response) => {
          this.dropmenuadddiscu();
          this.errorr = false;
          this.discu = response.data;
          this.$emit("crear-d", {
            discusion: this.discu,
            nuevac: this.nuevacategoria,
          });
          flash("Discusión creada", "success");
        })
        .catch((error) => {
          if (error.response.status == 401 || error.response.status == 419) {
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
        });
    },
  },
};
</script>

<style>
.menuadddiscu {
  margin: 0 0 1rem;
  width: 100%;
  min-height: 1rem;
}
.buttonmenuadddiscu {
  width: 100%;
  height: 0.1rem;
  border: 8px solid #3490dc;
  background-color: #3490dc;
  border-radius: 4px;
  cursor: pointer;
}
.display-n {
  display: none;
}

#add-discus {
  text-align: left;
}

.creardiscu {
  flex-grow: 1;
  margin-top: -0.5rem;
  display: block;
  background-color: #3490dc;
  max-width: 8rem;
  border-radius: 4px;
  font-weight: 600;
  font-size: 15px;
  color: #ffffff;
  padding: 10px;
}

.discu-content .form-group input {
  padding: 0.3rem;
  border: none;
  border-bottom: 1px solid blue;
  height: 2rem;
}

.discu-content .form-group select {
  padding: 0.3rem;
  border: none;
  border-bottom: 1px solid blue;
  height: 2rem;
}

#newnamediscus {
  width: 85%;
}

.btn-newdiscu {
  background-color: #3490dc;
  font-size: 16px;
  color: black;
  font-weight: 800;
  padding: 0.5rem;
  border: none;
  border-radius: 20px;
}
.btn-newdiscu:hover {
  background-color: #fcb036;
  border: 1px solid blue;
}
</style>
