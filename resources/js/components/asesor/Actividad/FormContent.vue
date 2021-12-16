<template>
  <div class="formcontent-layout">
    <button @click="showmenu = !showmenu" class="formcontent-bottom">
      <p v-show="!loading">
        Agregar contenido <span v-if="!showmenu">+</span><span v-else>-</span>
      </p>
      <p v-show="loading">Creando <span>...</span></p>
    </button>
    <transition name="menuslidedown">
      <div class="formcontent-menucontent" v-if="showmenu">
        <div class="formcontent-menucontent-option" @click="createactividad()">
          Agregar Actividad
        </div>
        <div class="formcontent-menucontent-option" @click="createtest()">
          Agregar prueba
        </div>
      </div>
    </transition>
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
  width: 50%;
}
.formcontent-bottom {
  width: 100%;
  border: none;
  background-color: #f1f1f1;
}
.formcontent-bottom p {
  font-weight: bold;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
.formcontent-bottom span {
  font-size: 30px;
}
.formcontent-bottom:hover {
  background-color: #fcb036;
}

.formcontent-menucontent {
  padding: 0.5rem;
  background-color: #fdc770;
  position: absolute;
  overflow: hidden;
  z-index: 1;
}
.formcontent-menucontent-option {
  padding: 0.6rem;
  width: 100%;
  cursor: pointer;
  font-size: 16px;
}

.formcontent-menucontent-option:hover {
  background-color: #fcb036;
  color: #fff;
}

.menuslidedown-enter-active {
  animation: menuslidedown 0.3s ease-out forwards;
}
.menuslidedown-leave-active {
  animation: menuslidedown 0.3s ease-out forwards reverse;
}
@keyframes menuslidedown {
  from {
    height: 0rem;
  }
  to {
    height: 6rem;
  }
}
</style>
