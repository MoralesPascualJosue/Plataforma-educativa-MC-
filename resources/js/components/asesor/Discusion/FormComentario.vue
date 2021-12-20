<template>
  <div class="contcom">
    <div class="container">
      <form class="px-4 py-3 row" @submit="checkForm">
        <div class="col">
          <label for="bodycom" class="header-com">{{ header }}</label>
          <div class="form-group bg-white">
            <vue-editor v-model="content"></vue-editor>
          </div>
          <button type="submit" class="formcomentario-comentar">
            <p class="line-d" v-if="!loading">Comentar</p>
            <span
              class="spinner-border spinner-border-sm"
              role="status"
              aria-hidden="true"
              v-if="loading"
            ></span>
            <p class="line-d" v-if="loading">Comentando...</p>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
// Basic Use - Covers most scenarios
import { VueEditor } from "vue2-editor";

export default {
  props: {
    parentc: {
      type: Number,
      default: -1,
    },
    header: {
      type: String,
      default: "Mi comentario",
    },
  },
  data() {
    return {
      visible: false,
      loading: false,
      comentario: [],
      content: "<p>Mi comentario</p>",
    };
  },
  computed: {
    discu() {
      return this.$store.getters["foro/discuview"];
    },
  },
  components: {
    VueEditor,
  },
  methods: {
    checkForm: function (e) {
      e.preventDefault();
      if (this.content == "") {
        flash("Comentario vacio", "warning");
        return "fail";
      }

      let formData = new FormData();
      formData.append("body", this.content);
      if (this.parentc > -1) {
        formData.append("parent", this.parentc);
      }
      this.loading = true;
      axios
        .post("/foro/comentar/" + this.discu.id, formData)
        .then((response) => {
          this.errorr = false;
          this.comentario = response.data;
          this.content = "<h1>Mi comentario</h1>";
          flash("Comentario agregado", "success");
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
          this.$emit("crear-comentario", this.comentario);
        });
    },
  },
};
</script>
<style>
.header-com {
  width: 100%;
  position: relative;
  display: block;
  background-color: #e0e0e2;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-bottom: none;
}
.bodycom {
  text-align: center;
}
.contcom {
  text-align: center;
  width: 80%;
  left: 10%;
  height: 30%;
  position: relative;
  margin-bottom: 13rem;
}
.formcomentario-comentar {
  border: none;
  font-size: 1rem;
  padding: 0.5rem;
  cursor: pointer;
  background-color: #e0e0e2;
}
.formcomentario-comentar:hover {
  background-color: #fcb036;
}
@media (max-width: 1050px) {
  .contcom {
    margin-bottom: 22rem;
    width: 100%;
    left: 0%;
  }
}
</style>