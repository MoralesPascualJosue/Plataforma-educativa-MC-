<template>
  <div class="contcom">
    <div class="container">
      <form class="px-4 py-3 row" @submit="checkForm">
        <div class="col">
          <div class="form-group">
            <label for="bodycom">Nombre de la actividad</label>
            <textarea type="text" class="form-control" id="bodycom" v-model="body" />
          </div>
          <button type="submit" class="btn btn-primary">
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
export default {
  data() {
    return {
      body: "Mi comentario",
      visible: false,
      loading: false,
      comentario: []
    };
  },
  computed: {
    discu() {
      return this.$store.getters.discuview;
    }
  },
  methods: {
    checkForm: function(e) {
      e.preventDefault();

      if (this.body == "") {
        flash("Comentario vacio", "warning");
        return "fail";
      }

      let formData = new FormData();

      formData.append("body", this.body);

      this.loading = true;

      axios
        .post("/foro/comentar/" + this.discu.id, formData)
        .then(response => {
          this.errorr = false;
          this.comentario = response.data;
          flash("Comentario agregado", "success");
        })
        .catch(response => {
          this.errorr = true;
          flash("Fallo el comentario: intentalo más tarde", "error");
        })
        .finally(() => {
          this.loading = false;
          this.$emit("crear-comentario", this.comentario);
        });
    }
  }
};
</script>
<style>
.contcom {
  width: 100%;
  max-width: 500px;
}
</style>