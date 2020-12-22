<template>
  <div>
    <!-- Contenedor Principal -->
    <div class="comments-container">
      <div
        :style="{
          backgroundColor: `${discu.colorCategoria}`,
        }"
        class="header-discu"
      >
        <div class="detalles-discu">
          <h5 class="op-3">{{ discu.nameCategoria }}</h5>
          <a href="javascript:void(0)">{{ discu.created_at }}</a>
          <p v-if="comentarios.discuss == 1">
            <a href="javascript:void(0)" @click="eliminart()">Eliminar tema</a>
            <a href="javascript:void(0)" class="ml-2">
              <FormDiscuUpdate />
            </a>
          </p>
        </div>
        <div class="tema-discu">
          <h1>
            {{ discu.title }}
          </h1>
        </div>
      </div>

      <ul id="comments-list" class="comments-list">
        <li>
          <div
            v-for="(comentario, indexco) in comentarios.fpost"
            :key="indexco"
          >
            <div class="comment-main-level" v-if="indexco == 0">
              <!-- Avatar -->
              <div class="comment-avatar">
                <img class="bg-white" :src="comentario.image" />
              </div>
              <!-- Contenedor del Comentario -->
              <div class="comment-box">
                <div class="comment-head">
                  <h6 class="comment-name by-author">
                    <a href="javascript:void(0)">{{
                      comentario.usuarioName
                    }}</a>
                  </h6>
                  <span>{{ tiempo(comentario.created_at) }}</span>
                  <i class="fa fa-reply"></i>
                  <i class="fa fa-heart"></i>
                  <div v-if="comentario.propiedad == 1">
                    <a
                      href="javascript:void(0)"
                      class="aside-link"
                      @click="editarc(comentario)"
                      >Editar</a
                    >
                    <a
                      href="javascript:void(0)"
                      class="aside-link"
                      @click="eliminarc(comentario.id)"
                      >Eliminar</a
                    >
                  </div>
                </div>
                <div class="comment-content" v-html="comentario.body"></div>
              </div>
            </div>
            <!-- Respuestas de los comentarios -->
            <ul class="comments-list reply-list" v-else>
              <li>
                <!-- Avatar -->
                <div class="comment-avatar">
                  <img class="bg-white" :src="comentario.image" alt />
                </div>
                <!-- Contenedor del Comentario -->
                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name">
                      <a href="javascript:void(0)">{{
                        comentario.usuarioName
                      }}</a>
                    </h6>
                    <span>{{ tiempo(comentario.created_at) }}</span>
                    <i class="fa fa-reply"></i>
                    <i class="fa fa-heart"></i>
                    <div v-if="comentario.propiedad == 1">
                      <a
                        href="javascript:void(0)"
                        class="aside-link"
                        @click="editarc(comentario)"
                        >Editar</a
                      >
                      <a
                        href="javascript:void(0)"
                        class="aside-link"
                        @click="eliminarc(comentario.id)"
                        >Eliminar</a
                      >
                    </div>
                  </div>
                  <div class="comment-content" v-html="comentario.body"></div>
                </div>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>

    <div class="modal-header">
      <p>
        Respuestas:
        <span>{{ respuestas }}</span>
      </p>
    </div>
    <div class="row justify-content-center bg-f7">
      <FormComentario @crear-comentario="createcomentario" />
    </div>
    <FormComentarioUpdate v-if="show" :show="show" @close="cerrarupdate" />
  </div>
</template>

<script>
import FormDiscuUpdate from "./FormDiscuUpdate";
import FormComentario from "./FormComentario";
import FormComentarioUpdate from "./FormComentarioUpdate";
export default {
  data() {
    return {
      comentarios: [],
      respuestas: 0,
      show: false,
    };
  },
  computed: {
    discu() {
      return this.$store.getters.discuview;
    },
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  components: {
    FormDiscuUpdate,
    FormComentario,
    FormComentarioUpdate,
  },
  created() {
    axios
      .get("/foro/" + this.curso.id + "/" + this.discu.id)
      .then((res) => {
        this.comentarios = res.data;
        this.respuestas = res.data.fpost.length;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    tiempo(fecha) {
      let fecha1 = new Date(fecha);
      let fecha2 = new Date();

      let resta = fecha2.getTime() - fecha1.getTime();
      return "hace " + Math.round(resta / (1000 * 60 * 60 * 24)) + " dias";
    },
    cerrarupdate(comentario) {
      if (comentario.comentario.id) {
        const indexcou = this.comentarios.fpost.findIndex(
          (item) => item.id === comentario.comentario.id
        );

        this.comentarios.fpost[indexcou] = comentario.comentario;
      }
      this.show = comentario.cerrar;
    },
    createcomentario(comentario) {
      if (comentario.id) {
        this.comentarios.fpost.push(comentario);
        this.respuestas++;
        this.$store.getters.discuview.answered++;
        this.$store.commit("updatediscuss", this.$store.getters.discuview);
      }
    },
    editarc(value) {
      this.$store.commit("changecomentario", value);
      this.show = true;
    },
    eliminarc(value) {
      const confirmacion = confirm(`Eliminar comentario`);
      if (confirmacion) {
        axios
          .delete("/foro/" + this.curso.id + "/eliminarco/" + value)
          .then((res) => {
            const index = this.comentarios.fpost.findIndex(
              (item) => item.id === value
            );
            this.comentarios.fpost.splice(index, 1);
            this.$store.getters.discuview.answered--;
            this.$store.commit("updatediscuss", this.$store.getters.discuview);
            this.respuestas--;
            flash("Comentario eliminado", "info");
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });
      }
    },
    eliminart() {
      const confirmacion = confirm(`Eliminar tema`);
      if (confirmacion) {
        axios
          .delete("/foro/" + this.curso.id + "/eliminardis/" + this.discu.id)
          .then((res) => {
            this.$store.commit("deletetema", this.discu);
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
}
.header-discu {
  display: grid;
  grid-template-columns: 25% 75%;
  border-radius: 4px;
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
  max-width: 768px;
  margin: 6px auto 15px;
}

.comments-container h1 {
  font-size: 36px;
  color: #283035;
  font-weight: 400;
}

.detalles-discu a {
  font-size: 18px;
  font-weight: 700;
  text-align: right;
}

.comments-list {
  margin-top: 30px;
  position: relative;
}

/**
 * Lineas / Detalles
 -----------------------*/
.comments-list:before {
  content: "";
  width: 2px;
  height: 100%;
  background: #c7cacb;
  position: absolute;
  left: 32px;
  top: 0;
}

.comments-list:after {
  content: "";
  position: absolute;
  background: #c7cacb;
  bottom: 0;
  left: 27px;
  width: 7px;
  height: 7px;
  border: 3px solid #dee1e3;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
}

.reply-list:before,
.reply-list:after {
  display: none;
}
.reply-list li:before {
  content: "";
  width: 60px;
  height: 2px;
  background: #c7cacb;
  position: absolute;
  top: 25px;
  left: -55px;
}

.comments-list li {
  margin-bottom: 15px;
  display: block;
  position: relative;
}

.comments-list li:after {
  content: "";
  display: block;
  clear: both;
  height: 0;
  width: 0;
}

.reply-list {
  padding-left: 88px;
  clear: both;
  margin-top: 15px;
}
/**
 * Avatar
 ---------------------------*/
.comments-list .comment-avatar {
  width: 65px;
  height: 65px;
  position: relative;
  float: left;
  border: 3px solid #fff;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.comments-list .comment-avatar img {
  width: 100%;
  height: 100%;
}

.reply-list .comment-avatar {
  width: 50px;
  height: 50px;
}

.comment-main-level:after {
  content: "";
  width: 0;
  height: 0;
  display: block;
  clear: both;
}
/**
 * Caja del Comentario
 ---------------------------*/
.comments-list .comment-box {
  width: 680px;
  float: right;
  position: relative;
  -webkit-box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075);
  -moz-box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075);
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.075);
}

.comments-list .comment-box:before,
.comments-list .comment-box:after {
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  display: block;
  border-width: 10px 12px 10px 0;
  border-style: solid;
  border-color: transparent #e0e0e2;
  top: 8px;
  left: -11px;
}

.comments-list .comment-box:before {
  border-width: 11px 13px 11px 0;
  border-color: transparent rgba(0, 0, 0, 0.05);
  left: -12px;
}

.reply-list .comment-box {
  width: 610px;
}
.comment-box .comment-head {
  background: #e0e0e2;
  padding: 10px 12px;
  border-bottom: 1px solid #e5e5e5;
  overflow: hidden;
  -webkit-border-radius: 4px 4px 0 0;
  -moz-border-radius: 4px 4px 0 0;
  border-radius: 4px 4px 0 0;
}

.comment-box .comment-head i {
  float: right;
  margin-left: 14px;
  position: relative;
  top: 2px;
  color: #a6a6a6;
  cursor: pointer;
  -webkit-transition: color 0.3s ease;
  -o-transition: color 0.3s ease;
  transition: color 0.3s ease;
}

.comment-box .comment-head i:hover {
  color: #03658c;
}

.comment-box .comment-name {
  color: #283035;
  font-size: 14px;
  font-weight: 700;
  float: left;
  margin-right: 10px;
}

.comment-box .comment-name a {
  color: #283035;
}

.comment-box .comment-head span {
  float: left;
  color: #999;
  font-size: 13px;
  position: relative;
  top: 1px;
}

.comment-box .comment-content {
  background: #f8f8f8;
  padding: 12px;
  font-size: 15px;
  color: #595959;
  -webkit-border-radius: 0 0 4px 4px;
  -moz-border-radius: 0 0 4px 4px;
  border-radius: 0 0 4px 4px;
}

.comment-box .comment-name.by-author,
.comment-box .comment-name.by-author a {
  color: #03658c;
}
.comment-box .comment-name.by-author:after {
  content: "Inicio";
  background: #03658c;
  color: #fff;
  font-size: 12px;
  padding: 3px 5px;
  font-weight: 700;
  margin-left: 10px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}

/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
  .comments-container {
    width: 480px;
  }

  .comments-list .comment-box {
    width: 390px;
  }

  .reply-list .comment-box {
    width: 320px;
  }

  .header-discu {
    display: inherit;
  }
}
</style>