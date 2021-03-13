<template>
  <div class="formcontent-layout">
    <button @click="showmenu = !showmenu" class="formcontent-bottom">
      <p v-show="!loading">
        Agregar contenido <span v-if="!showmenu">+</span><span v-else>-</span>
      </p>
      <p v-show="loading">Creando...</p>
    </button>
    <div class="formcontent-menucontent" v-if="showmenu">
      <div class="formcontent-menucontent-option" @click="createactividad()">
        Agregar Actividad
      </div>
      <div class="formcontent-menucontent-option" @click="createtest()">
        Agregar prueba
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showmenu: false,
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
    createactividad() {
      this.loading = true;
      axios
        .post("/storeaa/" + this.curso.id)
        .then((response) => {
          this.errorr = false;
          this.showmenu = false;
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
          this.showmenu = false;
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
.formcontent-layout {
  padding-bottom: 1rem;
}
.formcontent-bottom {
  width: 100%;
  border: none;
  background-color: #fdc770;
}
.formcontent-bottom p {
  height: 40px;
}
.formcontent-bottom span {
  font-size: 30px;
}
.formcontent-menucontent {
  padding: 0.5rem;
  background-color: #fdc770;
}
.formcontent-menucontent-option {
  padding: 0.5rem;
  width: 100%;
}

.formcontent-menucontent-option:hover {
  background-color: white;
  padding: 0.5rem;
}
</style>
