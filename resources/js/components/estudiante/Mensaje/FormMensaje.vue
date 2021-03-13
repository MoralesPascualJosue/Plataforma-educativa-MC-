<template>
  <div class="formmensaje-content" v-show="shownm">
    <div class="formmensaje-layout">
      <div class="formmensaje-header"></div>
      <form class="formmensaje-body" @submit="checkForm">
        <div class="formmensaje-form-group">
          <label for="asuntomensaje">Asunto</label>
          <input
            type="text"
            class="form-control"
            id="asuntomensaje"
            v-model="asunto"
          />
        </div>
        <div class="formmensaje-form-group">
          <label for="destino">Para:</label>
          <v-select
            multiple
            label="name"
            placeholder="Enviar a.."
            :reduce="(contact) => contact.user.id"
            :options="contactosdefault"
            :closeOnSelect="false"
            v-model="destino"
          ></v-select>
        </div>
        <div class="formmensaje-form-group">
          <label for="contenidomensaje">Contenido</label>
          <textarea
            type="text"
            class="form-control block-d"
            id="contenidomensaje"
            v-model="contenido"
          />
        </div>
        <button
          id="dLabelms"
          type="sumit"
          aria-haspopup="true"
          aria-expanded="false"
          class="formmensaje-enviar"
        >
          <p v-if="!loading">Enviar</p>
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
            v-if="loading"
          ></span>
          <p v-if="loading">Enviando...</p>
        </button>
        <a class="formmensaje-cancelar" @click="close">Cancelar</a>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    shownm: {
      type: Boolean,
      default: false,
    },
    contactosdefault: {
      type: Array,
      default() {
        return [{ name: "Sin contactos" }];
      },
    },
  },
  data() {
    return {
      asunto: "Asunto",
      contenido: "Contenido",
      errorr: false,
      info: "",
      loading: false,
      mensaje: [],
      destino: [],
    };
  },
  methods: {
    close: function () {
      this.$emit("crear-mensaje", { mensaje: [], cerrar: false });
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.asunto == "" || this.contenido == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      if (this.destino.length == 0) {
        flash("Mensaje sin  destino", "warning");
        return "fail";
      }

      this.loading = true;
      axios
        .post("/sendmensaje/" + this.$store.getters.cursoview.id, {
          destino: this.destino,
          asunto: this.asunto,
          body: this.contenido,
        })
        .then((response) => {
          this.errorr = false;
          this.mensaje = response.data;
          flash("Mensaje enviado", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          this.errorr = true;
          flash("Fallo el envio: intenta más tarde", "error");
        })
        .finally(() => {
          this.loading = false;
          this.$emit("crear-mensaje", { mensaje: this.mensaje, cerrar: false });
        });
    },
  },
};
</script>

<style>
.formmensaje-content {
  z-index: 1;
  position: fixed;
  background-color: #fdc770;
  border: 1px solid white;
  width: 50%;
  height: 50%;
  border-radius: 4px;
  overflow-y: auto;
  right: 1rem;
  top: 1rem;
}
.formmensaje-layout {
  padding: 0.5rem;
}
.formmensaje-header {
  background-color: #266fae;
  width: 100%;
  height: 2rem;
}
.formmensaje-body {
  padding: 0.5rem;
}
.formmensaje-form-group {
  margin-bottom: 0.5rem;
}
.formmensaje-form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-size: 1.3rem;
}
.formmensaje-form-group input {
  width: 100%;
  padding: 0.5rem;
}
.formmensaje-form-group textarea {
  width: 100%;
  padding: 0.5rem;
  min-height: 5rem;
}
.formmensaje-enviar {
  padding: 0.5rem;
  border: none;
  cursor: pointer;
}
.formmensaje-enviar:hover {
  background-color: #fcb036;
}
.formmensaje-cancelar {
  padding: 0.5rem;
  cursor: pointer;
  background-color: #ffffff;
}
.formmensaje-cancelar:hover {
  background-color: #fcb036;
}

@media (max-width: 1050px) {
  .formmensaje-content {
    width: 88%;
    height: 77%;
  }
}
</style>