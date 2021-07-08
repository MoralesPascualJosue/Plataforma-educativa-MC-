<template>
  <div class="formcurso-layout">
    <button @click="dropmenu()" class="formcurso-menubuttom">
      <p class="formcurso-menubuttom-text" v-if="!loading">
        {{ msgmenubuttom }}
      </p>
      <p class="formcurso-menubuttom-text" v-if="loading">Creando...</p>
    </button>
    <transition name="menuslidedownfc">
      <div class="formcurso-menucontent" v-if="showmenucontent">
        <form class="formcurso-form" @submit="checkForm">
          <div class="formcurso-formgroup">
            <label for="namecurso">Nombre del curso</label>
            <input type="text" id="namecurso" v-model="name" />
          </div>
          <div class="formcurso-formgroup">
            <label for="descripcion">Descripción o mensage</label>
            <input type="text" id="descripcion" v-model="description" />
          </div>
          <div
            class="formcurso-formgroup"
            :style="{
              backgroundImage: `url(${previewimg})`,
              backgroundSize: `contain`,
              backgroundPosition: `center`,
              height: `60%`,
              backgroundRepeat: `no-repeat`,
              paddingTop: `1rem`,
            }"
          >
            <label>Imagen del curso 4mb max.</label>
            <input
              ref="filecover"
              class="formcurso-file"
              type="file"
              id="filecover"
              v-on:change="onChangeFileUpload()"
            />
            <label for="filecover">{{ statusimgpreview }}</label>
          </div>
          <button type="submit" class="formcurso-sumit">Crear</button>
        </form>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showmenucontent: false,
      previewimg: "../resources/mc4.jpg",
      name: "Nombre",
      description: "Descripcion",
      filecover: "",
      errorr: false,
      info: "",
      loading: false,
      curso: {},
      statusimgpreview: "Elegir  imagen",
    };
  },
  computed: {
    msgmenubuttom() {
      if (this.showmenucontent) {
        return "Cancelar";
      }
      return "Crear curso";
    },
  },
  methods: {
    dropmenu() {
      if (this.showmenucontent) {
        this.showmenucontent = false;
      } else {
        this.showmenucontent = true;
      }
    },
    onChangeFileUpload() {
      this.filecover = this.$refs.filecover.files[0];
      this.previewimg = window.URL.createObjectURL(
        this.$refs.filecover.files[0]
      );
      this.statusimgpreview = "Seleccionada";
    },
    checkForm: function (e) {
      e.preventDefault();

      if (this.name == "" || this.description == "") {
        flash("Campos vacios", "warning");
        return "fail";
      }

      if (this.filecover == "") {
        flash("Imagen no seleccionada", "warning");
        return "fail";
      }

      let formData = new FormData();
      formData.append("cover", this.filecover);
      formData.append("title", this.name);
      formData.append("review", this.description);

      this.loading = true;
      axios
        .post("/storeac", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          $("#dLabel").dropdown("toggle");
          this.errorr = false;
          this.curso = response.data;
          flash("Curso creado", "success");
          this.showmenucontent = false;
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }

          this.errorr = true;
          flash(
            "Fallo la creacion del curso: revisa los campos solicitados.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
          this.$emit("crear-curso", this.curso);
        });
    },
  },
};
</script>

<style>
.formcurso-layout {
  border-radius: 20px;
  overflow: hidden;
}
.formcurso-menubuttom {
  background-color: #fcb036;
  border: 1px solid #fcb036;
  padding: 0.6rem;
  border-radius: 20px;
  letter-spacing: 0.1rem;
}
.formcurso-menubuttom:hover {
  border: 2px solid #266fae;
}
.formcurso-menucontent {
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
.formcurso-form {
  position: relative;
}
.formcurso-formgroup {
  float: left;
  margin: 0.5rem;
  padding: 0.1rem;
  border-bottom: 0.2rem solid #266fae;
  min-width: 220px;
  width: 100%;
}
.formcurso-formgroup label {
  display: block;
  padding: 0.1rem;
  font-size: 14px;
}
.formcurso-formgroup input {
  background: none;
  padding: 0.3rem;
  border: none;
  width: 100%;
  font-size: 16px;
  background-color: white;
}
.formcurso-formgroup input:focus {
  background-color: #fcb036;
}
.formcurso-file {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.formcurso-file + label {
  font-size: 2.25em;
  font-weight: 700;
  color: black;
  background-color: #fdc770;
  border-radius: 20px;
}
.formcurso-file:focus + label,
.formcurso-file + label:hover {
  background-color: #266fae;
}
.formcurso-sumit {
  background-color: #266fae;
  padding: 0.5rem;
  border: none;
  border-radius: 20px;
  color: #fbfbfb;
  letter-spacing: 1px;
  font-size: 2rem;
}
.formcurso-sumit:hover {
  border: 1px solid #266fae;
  background-color: #fdc770;
}
@media (max-width: 1050px) {
  .formcurso-menucontent {
    justify-content: inherit;
  }
  .formcurso-menucontent {
    width: 80%;
  }
}
.menuslidedownfc-enter-active {
  animation: menuslidedownfc 0.5s ease-out;
}
.menuslidedownfc-leave-active {
  animation: menuslidedownfc 0.5s reverse ease-in;
}
@keyframes menuslidedownfc {
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

@keyframes menuslidedownfcmovil {
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
  .menuslidedownfc-enter-active {
    animation: enterformmsgmovil 0.5s ease-out;
  }
  .menuslidedownfc-leave-active {
    animation: enterformmsgmovil 0.5s reverse ease-in;
  }
}
</style>
