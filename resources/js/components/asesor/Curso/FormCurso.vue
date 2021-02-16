<template>
  <div class="formcurso-layout">
      <button
        @click="dropmenu()" class="formcurso-menubuttom">
        <p class="formcurso-menubuttom-text" v-if="!loading">{{ msgmenubuttom  }}</p>
        <p class="formcurso-menubuttom-text" v-if="loading">Creando...</p>
      </button>

      <div class="formcurso-menucontent" v-if="showmenucontent">
        <form class="formcurso-form" @submit="checkForm">
          <div class="formcurso-formgroup">
            <label for="namecurso">Nombre del curso</label>
            <input
              type="text"
              id="namecurso"
              v-model="name"
            />
          </div>
          <div class="formcurso-formgroup">
            <label for="descripcion">Descripción o mensage</label>
            <input
              type="text"
              id="descripcion"
              v-model="description"
            />
          </div>
          <div class="formcurso-formgroup" :style="{
                backgroundImage: `url(${previewimg})`,
                backgroundSize: `cover`,
                backgroundPosition: `center`,
               }">
            <label for="filecover">Imagen del curso</label>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      showmenucontent: false,
      previewimg: "../resources/img-msg100.jpg",
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
  computed:{
    msgmenubuttom(){
	if (this.showmenucontent) {
          return "Cancelar";
	}
  	  return "Crear curso";
    }
  },
  methods: {
    dropmenu() {
	if (this.showmenucontent) {
	 this.showmenucontent = false;		
	}else{
	 this.showmenucontent = true; 
	}
    },
    onChangeFileUpload() {
      this.filecover = this.$refs.filecover.files[0];
      this.previewimg = window.URL.createObjectURL(
        this.$refs.filecover.files[0]
      );
      this.statusimgpreview = "Ok";
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
 margin-bottom: 0.5rem;
 background-color: #fdc770;
 border-radius: 20px;
 padding: 0.5rem;
}
.formcurso-menubuttom {
 background-color: #fcb036;
 border: 1px solid #fcb036;
 padding: 0.4rem;
 border-radius: 20px;
 letter-spacing: 0.1rem;
}
.formcurso-menubuttom:hover {
 border: 2px solid #266fae;
}
.formcurso-menucontent {
 display: flex;
 justify-content: space-evenly;
}
.formcurso-formgroup {
 float: left;
 margin: 0.5rem;
 padding: 0.1rem;
 border-bottom: 0.2rem solid #266fae;
 border-radius: 4px;
 min-width: 220px;
}
.formcurso-formgroup label {
 display:block;
 padding: 0.1rem;
 font-size: 14px;
 opacity: 0.5;
}
.formcurso-formgroup input {
 background: none;
 padding: 0.3rem;
 border: none;
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
    font-size: 1.25em;
    font-weight: 700;
    color: black;
    background-color: #fdc770;
    display: inline-block;
    border-radius: 20px;
}
.formcurso-file:focus + label,
.formcurso-file + label:hover {
    background-color: #266fae ;
}
.formcurso-sumit {
 background-color: #266fae;
 padding: 0.5rem;
 border: none;
 border-radius: 20px;
 color: #fbfbfb;
 letter-spacing: 1px;
}
.formcurso-sumit:hover {
 border: 2px solid #fcb036;
}
@media (max-width: 1050px) {
 .formcurso-menucontent{
   justify-content: inherit;
 }
}
</style>
