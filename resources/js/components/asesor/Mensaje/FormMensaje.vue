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
          <VueTrix
            class="form-control block-d contentmsg"
            inputId="editor1"
            v-model="editorContent"
            placeholder="enter your content..."
            @trix-attachment-add="handleAttachmentChanges"
            @trix-attachment-remove="handleAttachmentRemove"
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
import VueTrix from "vue-trix";

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
      editorContent: "<h1>Editor contents</h1>",
    };
  },
  components: {
    VueTrix,
  },
  methods: {
    handleAttachmentRemove(event) {
      // 1. get file object
      let file = event.attachment;
      let path = file.attachment.attributes.array[11];

      // 2. remove file to remote server with FormData
      let formData = new FormData();
      formData.append("path", path);
      axios
        .post(`/remove/file`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          flash("Archivo eliminado", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Error al eliminar", "error");
        });
    },
    handleAttachmentChanges(event) {
      // 1. get file object
      let file = event.attachment.file;

      // 2. upload file to remote server with FormData
      let formData = new FormData();
      formData.append("fileToUpload", file);

      axios
        .post("/uploadfile", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          let attributes = {
            url: response.data.path,
            href: response.data.path,
            patchs: response.data.path,
          };
          event.attachment.setAttributes(attributes);
          event.attachment.setUploadProgress(100);
          flash("Archivo subido", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Error a subir archivo", "error");
        });

      // 3. if upload success, set back the attachment's URL attribute
      // @param object data from remote server response data after upload.
      this.updateEditorContent("update");
    },
    updateEditorContent(value) {
      // Update new content into the database via state mutations.
      this.contenido = document.querySelector("trix-editor").innerHTML;
    },
    close: function () {
      this.$emit("crear-mensaje", { mensaje: [], cerrar: false });
    },
    checkForm: function (e) {
      e.preventDefault();

      let sendContacts;
      this.updateEditorContent("save");
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
        .post("/sendmensaje/" + this.$store.getters["cursos/cursoview"].id, {
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
  watch: {
    editorContent: {
      handler: "updateEditorContent",
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
  overflow-y: auto;
  height: 93% !important;
}
.trix-content {
  min-height: 93% !important;
}
.trix-button-row {
  flex-wrap: wrap !important;
}
.contentmsg p {
  font-size: inherit;
  color: inherit;
}
.form-content-msg {
  height: 68%;
  overflow-y: auto;
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
