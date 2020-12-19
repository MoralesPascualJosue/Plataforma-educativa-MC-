<template>
  <div v-show="show" class="poscu">
    <div class="m-3">
      <div>
        <form @submit="checkForm">
          <div class="col">
            <div class="form-group">
              <label for="bodycom">Mi comentario</label>
              <vue-editor v-model="content"></vue-editor>
            </div>
            <button type="submit" class="btn btn-primary">
              <p class="line-d" v-if="!loading">Actualizar</p>
              <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
                v-if="loading"
              ></span>
              <p class="line-d" v-if="loading">Comentando...</p>
            </button>
            <a class="btn btn-warning m-l-1" @click="close">Cancelar</a>
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
      body: "Mi comentario",
      visible: false,
      loading: false,
    };
  },
  components: {
    VueEditor,
  },
  computed: {
    discu() {
      return this.$store.getters.discuview;
    },
    comentario() {
      return this.$store.getters.comentarioview;
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

      if (this.body == "") {
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
.poscu {
  z-index: 1;
  position: fixed;
  background-color: white;
  border: 1px solid blue;
  width: 500px;
  border-radius: 4px;
  top: 10%;
  left: 2%;
  overflow-y: scroll;
  max-height: 85%;
}
#bodycom {
  min-height: 130px;
}
</style>