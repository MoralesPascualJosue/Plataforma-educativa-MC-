<template>
  <div class="formcursoupdate-content">
    <a
      href="javascript:void(0);"
      @click="showmenu = !showmenu"
      class="formcursoupdate-botton"
    >
      <div v-if="!loading">
        Editar curso <span v-if="!showmenu">+</span><span v-else>-</span>
      </div>
      <div v-if="loading">Actualizando...</div>
    </a>
    <transition name="menuslidedownfcu">
      <div class="formcursoupdate-layout" v-show="showmenu">
        <form class="formcursoupdate-form" @submit="checkForm">
          <div class="formcursoupdate-formgroup">
            <label for="namecursou">Nombre del curso</label>
            <input type="text" id="namecursou" v-model="name" />
          </div>
          <div class="formcursoupdate-formgroup">
            <label for="descripcioncursou">Descripción o mensage</label>
            <textarea
              name="descripcioncursou"
              id="descripcioncursou"
              v-model="description"
            ></textarea>
          </div>
          <div
            class="formcursoupdate-formgroup"
            :style="{
              backgroundImage: `url(${previewimg})`,
              backgroundSize: `contain`,
              backgroundPosition: `center`,
              height: `60%`,
              backgroundRepeat: `no-repeat`,
              marginTop: `2rem`,
            }"
          >
            <label class="label-filecover">Imagen del curso 4mb max.</label>
            <input
              type="file"
              id="file"
              ref="file"
              class="formcursoupdate-file"
              v-on:change="onChangeFileUpload()"
            />
            <label for="file">Elegir</label>
          </div>
          <button type="submit" class="formcursoupdate-sumit">
            Guardar cambios
          </button>
        </form>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showmenu: false,
      name: "Mi curso",
      description: "Descripción",
      previewimg: "../resources/img-msg100.jpg",
      file: "",
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
  created() {
    this.name = this.curso.title;
    this.description = this.curso.review;
    this.previewimg = this.curso.cover;
  },
  methods: {
    onChangeFileUpload() {
      this.file = this.$refs.file.files[0];
      this.previewimg = window.URL.createObjectURL(this.$refs.file.files[0]);
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.name == "" || this.description == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      let formData = new FormData();

      if (this.file != "") {
        formData.append("cover", this.file);
      }
      formData.append("title", this.name);
      formData.append("review", this.description);
      this.loading = true;
      axios
        .post("/updateac/" + this.curso.id, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.showmenu = false;
          this.errorr = false;
          this.$store.commit("changecurso", response.data);
          this.$store.commit("updatecurso", response.data);
          this.$emit("cursoupdate", response.data);
          flash("Curso actualizado", "success");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          this.errorr = true;
          flash(
            "Fallo la actualizacion del curso: revisa los campos solicitados.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
<style>
.formcursoupdate-content {
  overflow: hidden;
}
.formcursoupdate-botton span {
  font-size: 20px;
  font-weight: bold;
}
.formcursoupdate-layout {
  z-index: 1;
  position: fixed;
  width: 50%;
  height: 95%;
  right: 1rem;
  top: 1rem;
  border-radius: 20px;
  overflow-y: auto;
  background-color: #fcb036;
  border: 1px solid white;
  padding: 1rem;
}
.formcursoupdate-form {
  position: relative;
}
.formcursoupdate-formgroup {
  float: left;
  margin: 0.5rem;
  padding: 0.1rem;
  border-bottom: 0.2rem solid #266fae;
  min-width: 220px;
  width: 100%;
}
.formcursoupdate-formgroup label {
  display: block;
  padding: 0.1rem;
  font-size: 14px;
}
.formcursoupdate-formgroup input {
  background: none;
  padding: 0.5rem;
  border: none;
  width: 100%;
  font-size: x-large;
  background-color: #fdc770;
}
.formcursoupdate-formgroup textarea {
  font-size: 1.2rem;
  margin: 0px;
  width: 100%;
  height: 8rem;
  background-color: #fdc770;
  padding: 0.5rem;
  font-family: "Poppins";
  resize: none;
}
.formcursoupdate-formgroup input:focus {
  background-color: #fdc770;
}
.label-filecover {
  margin-top: -1.5rem;
}
.formcursoupdate-file {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.formcursoupdate-file + label {
  font-size: 2.25em;
  font-weight: 700;
  color: black;
  background-color: #fdc770;
  border-radius: 20px;
  width: 7rem;
}
.formcursoupdate-file:focus + label,
.formcursoupdate-file + label:hover {
  background-color: #266fae;
}

.formcursoupdate-sumit {
  background-color: #266fae;
  padding: 0.5rem;
  border: none;
  border-radius: 20px;
  color: #fbfbfb;
  letter-spacing: 1px;
  font-size: 2rem;
}
.formcursoupdate-sumit:hover {
  border: 1px solid #266fae;
  background-color: #fdc770;
}

.menuslidedownfcu-enter-active {
  animation: menuslidedownfcu 0.5s ease-out;
}
.menuslidedownfcu-leave-active {
  animation: menuslidedownfcu 0.5s reverse ease-in;
}
@keyframes menuslidedownfcu {
  from {
    left: 100%;
    width: 50%;
    height: 95%;
  }
  to {
    left: 50%;
    width: 50%;
    height: 95%;
  }
}

@keyframes menuslidedownfcumovil {
  from {
    left: 100%;
    width: 80%;
    height: 95%;
  }
  to {
    left: 20%;
    width: 80%;
    height: 95%;
  }
}

@media (max-width: 1050px) {
  .menuslidedownfcumovil-enter-active {
    animation: enterformmsgmovil 0.5s ease-out;
  }
  .menuslidedownfcumovil-leave-active {
    animation: enterformmsgmovil 0.5s reverse ease-in;
  }
  .formcursoupdate-layout {
    width: 80%;
  }
}
</style>
