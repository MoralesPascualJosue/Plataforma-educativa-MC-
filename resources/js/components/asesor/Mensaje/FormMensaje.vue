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
          <span class="send-right">
            <input
              type="checkbox"
              name="markall"
              id="markall"
              v-model="markall"
            />
            Enviar a todos</span
          >
          <label for="destino">Para: </label>
          <v-select
            multiple
            label="name"
            placeholder="Enviar a.."
            :reduce="(contact) => contact.user.id"
            :options="contactosdefault"
            :closeOnSelect="false"
            :disabled="markall"
            v-model="destino"
          ></v-select>
        </div>
        <div class="formmensaje-form-group form-content-msg">
          <label for="contenidomensaje">Contenido</label>
          <vue-editor
            class="form-control block-d contentmsg"
            id="contenidomensaje"
            v-model="contenido"
          ></vue-editor>
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
import { VueEditor } from "vue2-editor";

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
      customToolbar: [[]],
      markall: false,
    };
  },
  components: {
    VueEditor,
  },
  methods: {
    close: function () {
      this.$emit("crear-mensaje", { mensaje: [], cerrar: false });
    },
    checkForm: function (e) {
      e.preventDefault();

      let sendContacts;
      if (this.asunto == "" || this.contenido == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      if (this.markall && this.contactosdefault[0].name) {
        sendContacts = this.contactosdefault.map((c) => c.user_id);
      } else {
        sendContacts = this.destino;
      }

      if (sendContacts.length == 0) {
        flash("Mensaje sin  destino", "warning");
        return "fail";
      }

      this.loading = true;
      axios
        .post("/sendmensaje/" + this.$store.getters.cursoview.id, {
          destino: sendContacts,
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
  background-color: #fcb036;
  border: 1px solid white;
  width: 50%;
  height: 95%;
  overflow-y: auto;
  right: 1rem;
  top: 1rem;
  border-radius: 20px;
}
.formmensaje-layout {
  padding: 0.5rem;
}
.formmensaje-header {
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
  height: 55%;
  max-width: 100%;
  min-width: 100%;
}
.send-right {
  float: right;
  padding: 0.3rem;
  display: flex;
  align-items: center;
}
.send-right input {
  height: 1.4rem;
  width: 1.4rem;
  margin-right: 0.3rem;
}
.formmensaje-enviar {
  padding: 0.5rem;
  border: none;
  cursor: pointer;
  width: 7rem;
  background-color: #fdc770;
}
.formmensaje-enviar:hover {
  border: 2px solid #266fae;
}
.formmensaje-cancelar {
  padding: 0.5rem;
  cursor: pointer;
  background-color: #ffffff;
}
.formmensaje-cancelar:hover {
  border: 2px solid #266fae;
}
.contentmsg {
  background-color: white;
}
.contentmsg p {
  font-size: inherit;
  color: inherit;
}
.form-content-msg {
  padding-bottom: 7.5rem;
  height: 69%;
}

@media (max-width: 1050px) {
  .formmensaje-enviar {
    width: 5rem;
  }
  .formmensaje-content {
    width: 80%;
  }
}

.vs__dropdown-toggle {
  background-color: white;
}
</style>
