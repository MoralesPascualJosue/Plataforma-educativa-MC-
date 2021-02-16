<template>
  <div class="formcursoupdate-content">
      <a href="javascript:void(0);"@click="showmenu = !showmenu" class="formcursoupdate-botton">
        <div v-if="!loading">Editar curso <span v-if="!showmenu">+</span><span v-else>-</span></div>
        <div v-if="loading">Actualizando...</div>
      </a>
      <div class="formcursoupdate-layout" v-show="showmenu">
        <form class="formcursoupdate-form"  @submit="checkForm">
          <div class="formcursoupdate-formgroup">
            <label for="namecursou">Nombre del curso</label>
            <input class="formcursoupdate-formgroup-input" type="text" id="namecursou" v-model="name"/>
          </div>
          <div class="formcursoupdate-formgroup">
            <label for="descripcioncursou">Descripción o mensage</label>
            <input class="formcursoupdate-formgroup-input" type="text" id="descripcioncursou" v-model="description"/>
          </div>
          <div class="formcursoupdate-formgroup">
            <label>Imagen del curso</label>
            <input type="file" id="File" ref="file" v-on:change="onChangeFileUpload()"/>
            <img id="preview" alt="Imagen curso" class="preview-img" :src="previewimg"/>
          </div>
          <button type="submit" class="formcursoupdate-form-submitbottom">Guardar cambios</button>
        </form>
      </div>
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
.formcursoupdate-botton span{
  font-size: 20px;
  font-weight: bold;
}
.formcursoupdate-layout {
  padding: 0.5rem;
}
.formcursoupdate-form-submitbottom{
  background-color: #fdc770;
  padding: 0.5rem;
  width: 100%;
  margin-top: 1rem;
  border: none;
  cursor: pointer;
}
.formcursoupdate-formgroup label{
   font-size: 14px; 
   color: #a62b29;
}
.formcursoupdate-formgroup input{
 width: 100%;
}
.preview-img {
  width: 100%;
  height: 100px;
  border-radius: 8px;
  display: block;
  margin-top: 5px;
}
</style>
