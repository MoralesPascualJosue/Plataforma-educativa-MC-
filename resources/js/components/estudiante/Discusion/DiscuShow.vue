<template>
  <div>
    <!-- Contenedor Principal -->
    <div class="comments-container">
      <div
        class="header-discu"
        :style="{ backgroundColor: `${discu.colorCategoria}` }"
      >
        <div class="detalles-discu">
          <h5 class="op-3">{{ discu.nameCategoria }}</h5>
          <a href="javascript:void(0)">{{ discu.created_at }}</a>
          <p v-if="editable.editabled == 1">
            <a href="javascript:void(0)" @click="eliminart()">Eliminar tema</a>
            <a href="javascript:void(0)"> <FormDiscuUpdate /> </a>
          </p>
        </div>
        <div class="tema-discu">
          <h1>{{ discu.title }}</h1>
        </div>
      </div>

      <div
        v-for="(comentario, indexcomd) in comentarios"
        :key="indexcomd"
        class="espacio"
      >
        <Comentario
          :initialComentario="comentario"
          :initialEditable="editable.editablec"
          @cerrarupdate="cerrarupdate"
          @eliminarc="eliminarc"
        />
      </div>
    </div>

    <div class="modal-header">
      <p>
        Respuestas:<span>{{ respuestas }}</span>
      </p>
    </div>
    <div class="comments-comment">
      <FormComentario @crear-comentario="createcomentario" />
    </div>
  </div>
</template>

<script>
import Comentario from "./Comentario";
import FormDiscuUpdate from "./FormDiscuUpdate";
import FormComentario from "./FormComentario";
export default {
  data() {
    return {
      comentarios: [],
      editable: 0,
      respuestas: 0,
      show: false,
    };
  },
  computed: {
    discu() {
      return this.$store.getters["foro/discuview"];
    },
    // comentarios() {
    //   return this.$store.getters["foro/comentariosview"];
    // },
    curso() {
      return this.$store.getters["cursos/cursoview"];
    },
  },
  components: {
    Comentario,
    FormDiscuUpdate,
    FormComentario,
  },
  created() {
    axios
      .get("/foro/" + this.curso.id + "/" + this.discu.id)
      .then((res) => {
        //this.$store.commit("foro/changecomentarios", res.data.fpost);
        this.comentarios = res.data.fpost;
        this.editable = {
          editabled: res.data.discuss,
          editablec: res.data.permisos,
        };
        this.respuestas = res.data.fpost.length;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    createcomentario(comentario) {
      if (comentario.id) {
        this.comentarios.push(comentario);
        this.respuestas++;
        this.$store.getters["foro/discuview"].answered++;
        this.$store.commit(
          "foro/updatediscuss",
          this.$store.getters["foro/discuview"]
        );
      }
    },
    eliminart() {
      const confirmacion = confirm(`Eliminar tema`);
      if (confirmacion) {
        axios
          .delete("/foro/" + this.curso.id + "/eliminardis/" + this.discu.id)
          .then((res) => {
            this.$store.commit("foro/deletetema", this.discu);
            flash("Discusion eliminada", "info");
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });

        this.$emit("close");
      }
    },
    cerrarupdate(comentario) {
      if (comentario.comentario.id) {
        const indexcou = this.comentarios.findIndex(
          (item) => item.id === comentario.comentario.id
        );
        this.comentarios[indexcou] = comentario.comentario;
      }
      this.show = comentario.cerrar;
    },
    eliminarc(value) {
      axios
        .delete("/foro/" + this.curso.id + "/eliminarco/" + value)
        .then((res) => {
          // const index = this.comentarios.findIndex((item) => item.id === value);
          // this.comentarios.splice(index, 1);

          flash("Comentario eliminado", "info");
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });
    },
  },
};
</script>

<style>
.tema-discu {
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075) !important;
  min-height: 5rem;
  text-align: left;
  padding: 10px;
  margin: 2rem;
}
.header-discu {
  display: grid;
  grid-template-columns: 25% 75%;
  border-radius: 4px;
  margin-bottom: 1rem;
}
.detalles-discu {
  text-align: center;
  padding: 1rem;
}
.op-3 {
  opacity: 0.3;
}
.bg-f7 {
  background-color: #f7f7f7;
}
* {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
a {
  color: #03658c;
  text-decoration: none;
}
ul {
  list-style-type: none;
}
/** ====================
 * Lista de Comentarios
 =======================*/
.comments-container {
  margin-top: 3rem;
  padding: 1rem;
  max-width: 75%;
  position: relative;
  left: 11.5%;
}
.comments-container h1 {
  font-size: 36px;
  color: #283035;
  font-weight: 400;
}
.detalles-discu a {
  font-size: 18px;
  font-weight: 700;
}

.espacio {
  margin-bottom: 2rem;
}

/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
  .comments-container {
    left: 0;
    margin-top: inherit;
    max-width: 100%;
  }
  .header-discu {
    display: inherit;
  }
}
</style>
