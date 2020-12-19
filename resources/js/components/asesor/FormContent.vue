<template>
  <div>
    <div class="dropdown m-3">
      <button
        id="dLabelcontent"
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="btn btn-primary"
      >
        <p class="line-d" v-if="!loading">Agregar contenido</p>
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="loading"
        ></span>
        <p class="line-d" v-if="loading">Creando...</p>
      </button>
      <div class="dropdown-menu">
        <div class="px-2 py-1">
          <div class="px-2 py-2 option">
            <a href="javascript:void(0)" @click="createactividad()"
              >Agregar Actividad</a
            >
          </div>
          <div class="px-2 py-2 option">
            <div>
              <a href="javascript:void(0)" @click="createtest()"
                >Agregar prueba</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errorr: false,
      info: "",
      loading: false,
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  methods: {
    dropmenu() {
      $("#dLabelcontent").dropdown();
    },
    createactividad() {
      this.loading = true;
      axios
        .post("/storeaa/" + this.curso.id)
        .then((response) => {
          this.errorr = false;
          flash("Actividad creada", "success");
          this.$emit("crear-actividad", response.data);
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash(
            "Fallo la creacion del la actividad:prueba mas tarde.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
    createtest() {
      this.loading = true;
      axios
        .post("/test/create/" + this.curso.id)
        .then((response) => {
          let actividad = {
            id: response.data.id,
            visible: response.data.visible,
            title: response.data.title,
            fecha_inicio: response.data.fecha_inicio,
            fecha_final: response.data.fecha_final,
            entregas: 0,
            num_takes: 1,
            type: "test",
          };
          this.errorr = false;
          flash("Prueba creada", "success");
          this.$emit("crear-actividad", actividad);
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash("Fallo la creacion del la prueba:Intenta mas tarde.", "error");
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style>
.option:hover {
  background-color: #f0f0f0;
  padding: 2px;
}
</style>