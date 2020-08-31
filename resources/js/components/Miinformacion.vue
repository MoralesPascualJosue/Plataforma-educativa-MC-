<template>
  <div class="row">
    <div class="background"></div>

    <div class="container-top">
      <div class="avatar-container">
        <div class="avatari" id="avatarImage">
          <img :src=" user.image" width="142px" />
        </div>
      </div>

      <div class="user-name-container">
        <span id="name-u">{{ user.name }}</span>
      </div>
      <div class="username-container">
        <span>{{ user.email }}</span>
      </div>
    </div>

    <div class="columns">
      <div class="column user-information">
        <section>
          <h2>Información básica</h2>
          <ul v-if="editando">
            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Imagen de perfil</span>
                <img id="preview" alt="Imagen curso" width="230px" height="230px" :src="previewimg" />
                <a class="data-value">
                  <input
                    class="file-i"
                    type="file"
                    id="Filecover"
                    ref="filecover"
                    v-on:change="onChangeFileUpload()"
                  />
                </a>
              </div>
            </li>
          </ul>
          <ul>
            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Nombre completo</span>
                <a class="data-value">
                  <div v-if="!editando" class="editable" id="editable-nombre">{{ user.name }}</div>
                  <input v-else type="text" name="nameu" id="nameu" v-model="nombre" />
                </a>
              </div>
            </li>

            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Dirección de correo electrónico</span>
                <a class="data-value">
                  <div class="editable" id="editable-correo">{{ user.email }}</div>
                </a>
              </div>
            </li>

            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Contraseña</span>
                <a class="data-value" href="/change-password">
                  <span>Cambiar contraseña</span>
                </a>
              </div>
            </li>
          </ul>
        </section>

        <section>
          <h2>Información adicional</h2>
          <ul>
            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Institucion</span>
                <a class="data-value">
                  <div
                    v-if="!editando"
                    class="editable"
                    id="editable-nombreinstituto"
                  >{{ perfil.institute }}</div>
                  <input
                    v-else
                    type="text"
                    name="institucionu"
                    id="institucionu"
                    v-model="institucion"
                  />
                </a>
              </div>
            </li>

            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Departamento</span>
                <a class="data-value">
                  <div
                    v-if="!editando"
                    class="editable"
                    id="editable-departamento"
                  >{{ perfil.department }}</div>
                  <input
                    v-else
                    type="text"
                    name="departamentu"
                    id="departamentu"
                    v-model="departamento"
                  />
                </a>
              </div>
            </li>
          </ul>
        </section>
      </div>

      <div class="column user-settings">
        <section>
          <h2>Opciones</h2>
        </section>

        <section>
          <br />
          <ul class="editar-perfil" v-if="!editando">
            <li class="data-row" @click="editarperfil()">
              <div class="data-container">
                <span class="data-title">Editar mi perfil</span>
                <a class="data-value">
                  <span>editar</span>
                </a>
              </div>
            </li>
          </ul>
          <ul class="guardar-perfil" v-if="editando">
            <li class="data-row" @click="guardarcambiosp()">
              <div class="data-container">
                <span class="data-title">Guardar mi perfil</span>
                <a class="data-value">
                  <span>Guardar cambios</span>
                </a>
              </div>
            </li>
          </ul>

          <ul class="editar-perfil" v-if="editando" @click="cancelaredicionperfil()">
            <li class="data-row">
              <div class="data-container">
                <span class="data-title">Cancelar</span>
                <a class="data-value">
                  <span>Cancelar cambios</span>
                </a>
              </div>
            </li>
          </ul>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      previewimg: "../resources/img-msg100.jpg",
      user: [],
      perfil: [],
      editando: false,
      file: "",
      nombre: "",
      institucion: "",
      departamento: ""
    };
  },
  created() {
    axios.get("/perfil").then(res => {
      this.user = res.data.user;
      this.perfil = res.data.perfil;
      this.nombre = res.data.user.name;
      this.institucion = res.data.perfil.institute;
      this.departamento = res.data.perfil.department;
    });
  },
  methods: {
    editarperfil() {
      this.editando = true;
    },
    cancelaredicionperfil() {
      this.editando = false;
    },
    onChangeFileUpload() {
      this.file = this.$refs.filecover.files[0];
      this.previewimg = window.URL.createObjectURL(
        this.$refs.filecover.files[0]
      );
    },
    guardarcambiosp() {
      if (
        this.nombre == "" ||
        this.institucion == "" ||
        this.departamento == ""
      ) {
        flash("Campos vacios", "warning");
        return "fail";
      }

      let formData = new FormData();
      if (this.file != "") {
        formData.append("image", this.file);
      }
      formData.append("name", this.nombre);
      formData.append("institute", this.institucion);
      formData.append("department", this.departamento);

      this.loading = true;
      axios
        .post("/updatePerfil", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.editando = false;
          this.user = response.data.user;
          this.perfil = response.data.perfil;
          flash("Información actualizada", "success");
        })
        .catch(response => {
          flash(
            "Fallo la actualizacion de informacion:prueba mas tarde.",
            "error"
          );
        })
        .finally(() => {});
    }
  }
};
</script>

<style>
.background {
  background: url("/resources/welcome1.jpg") no-repeat;
  background-position: 0;
  background-repeat: no-repeat;
  background-size: cover;
  height: 10.6875rem;
  position: relative;
  margin-bottom: -6.6875rem;
  padding: 0;
  width: 100%;
}

.container-top {
  text-align: center !important;
  position: relative;
}

.avatar-container {
  width: 8.75rem;
  height: 8.75rem;
  margin-left: 25%;
}

.avatari {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

.avatari:hover img {
  border: 3px solid orange;
}

.avatari img {
  width: 100%;
  height: 100%;
  background-color: orange;
  border-radius: 50%;
  box-shadow: 0 0 0 0.3125rem #f8f8f8;
}

.user-name-container {
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.5rem;
}

.columns {
  padding-left: 0.9375rem;
  padding-right: 0.9375rem;
  width: 100%;
  float: left;
}

.column {
  padding-left: 0.9375rem;
  padding-right: 0.9375rem;
  width: 50%;
  float: left;
}

.user-information {
  border-right: solid 0.0625rem #cdcdcd;
}

h2 {
  font-size: 1.125rem;
  font-weight: 600;
  margin: 0;
}

.data-row {
  padding: 1.25rem 0;
  align-items: center;
  background-color: #fff;
  color: #262626;
  display: flex;
  padding: 0.9375rem 0;
  position: relative;
  border: solid 0.0625rem #cdcdcd;
}

.data-container {
  margin: 0 1.25rem;
  margin-left: 1.25rem;
  margin-right: 3.1875rem;
  max-width: calc(100% - 4.4375rem);
}

.data-title {
  flex: 1;
  font-size: 0.875rem;
  font-weight: 700;
  margin-right: 1.25rem;
  overflow: hidden;
  word-wrap: break-word;
}

.data-value {
  flex: 1;
  font-size: 0.875rem;
  font-weight: 400;
  overflow: hidden;
  word-wrap: break-word;
  color: #1b396a;
}

/*------------------------------------------------------------------
[ Responsive columns]*/

@media (max-width: 1050px) {
  .avatar-container {
    padding-top: 10px;
  }

  .columns {
    padding-top: 10px;
  }
}

@media (max-width: 700px) {
  .columns {
    padding-left: 0rem;
    padding-right: 0rem;
    width: 100%;
    float: left;
  }
  .column {
    padding-left: 0rem;
    padding-right: 0rem;
    width: 100%;
  }
  .user-information {
    border-right: none;
  }
}

@media (max-width: 650px) {
  .data-tittle {
    display: block;
  }

  .data-value {
    display: block;
  }
}

.editar-perfil:hover {
  border: 1px solid #1b396a;
}

.guardar-perfil:hover {
  border: 1px solid #1b396a;
}

.editable {
  display: inherit;
  padding: 3px;
}
</style>