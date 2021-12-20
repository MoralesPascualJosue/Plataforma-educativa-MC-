<template>
  <div v-show="show" class="formcomentarioupdate-layout">
    <div class="formcomentarioupdate-header">
      <label>Mi comentario</label>
    </div>
    <div class="formcomentarioupdate-body">
      <div>
        <form @submit="checkForm">
          <div class="col">
            <div class="form-group">
              <vue-editor v-model="content"></vue-editor>
            </div>
            <button type="submit" class="formcomentarioupdate-actualizar">
              <p class="line-d" v-if="!loading">Actualizar</p>
              <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
                v-if="loading"
              ></span>
              <p class="line-d" v-if="loading">Comentando...</p>
            </button>
            <a class="formcomentarioupdate-cancelar" @click="close">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
// Basic Use - Covers most scenarios
import { VueEditor } from "vue2-editor";
export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      content: "<h1>Mi comentario</h1>",
      visible: false,
      loading: false,
    };
  },
  components: {
    VueEditor,
  },
  computed: {
    discu() {
      return this.$store.getters["foro/discuview"];
    },
    comentario() {
      return this.$store.getters["foro/comentarioview"];
    },
  },
  created() {
    this.content = this.comentario.body;
  },
  methods: {
    dropmenu() {
      $("#dLabelcomu").dropdown();
    },
    close: function () {
      this.$emit("close", { comentario: [], cerrar: false });
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.content == "") {
        flash("Comentario vacio", "warning");
        return "fail";
      }

      let formData = new FormData();

      formData.append("body", this.content);

      this.loading = true;

      axios
        .post("/foro/modificarco/" + this.comentario.id, formData)
        .then((response) => {
          this.errorr = false;
          flash("Comentario actualizado", "success");
          this.$emit("close", { comentario: response.data, cerrar: false });
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash("Fallo el comentario: intentalo más tarde", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
<style>
.formcomentarioupdate-layout {
  z-index: 1;
  padding: 0.5rem;
  position: fixed;
  background-color: white;
  width: 500px;
  border-radius: 4px;
  top: 10%;
  left: 2%;
  overflow-y: scroll;
  max-height: 85%;
  border: 1px solid #7f7f7f;
}
.formcomentarioupdate-header {
  background-color: #e0e0e2;
  width: 100%;
  height: 2rem;
  padding: 0.5rem;
}
.formcomentarioupdate-header label {
  font-weight: bold;
}
.formcomentarioupdate-actualizar {
  border: none;
  font-size: 1rem;
  padding: 0.5rem;
  cursor: pointer;
  background-color: #fdc770;
  width: 7rem;
}
.formcomentarioupdate-actualizar:hover {
  background-color: #fcb036;
}
.formcomentarioupdate-cancelar {
  width: 7rem;
  border: none;
  font-size: 1rem;
  padding: 0.5rem;
  cursor: pointer;
  background-color: #e0e0e2;
}
.formcomentarioupdate-cancelar:hover {
  background-color: #fcb036;
}
#bodycom {
  min-height: 130px;
}

@media only screen and (max-width: 766px) {
  .formcomentarioupdate-layout {
    width: 100%;
  }
}
</style>