<template>
  <div class="listamensajes-layout">
    <transition name="fade" mode="out-in">
      <div v-if="!showmensaje" key="listmensajes">
        <div class="listamensajes-layout-header">
          <div class="col-sm-3 col-md-2">
            <span v-if="nuevos > 0" class="text-muted">
              Nuevos:
              <b>{{ nuevos }}</b>
            </span>
          </div>
          <div class="col-sm-9 col-md-10">
            <div class="pull-right">
              Mensajes
              <span class="text-muted">
                <b v-if="activetab == 'home'">{{ recibidos }}</b>
                <b v-else>{{ enviados }}</b>
                of
                <b>{{ allmensajes }}</b>
              </span>
              <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default"></button>
                <button type="button" class=""></button>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <div class="listamensajes-layout-listamensajes">
          <div class="col-sm-3 col-md-2">
            <button
              type="button"
              aria-haspopup="true"
              aria-expanded="false"
              @click="nuevomensaje"
              class="listamensajes-layout-sendbottom"
            >
              Enviar mensaje
            </button>
            <transition name="enterformmsg">
              <FormMensaje
                v-if="shownm"
                :shownm="shownm"
                @crear-mensaje="createmensaje"
                v-bind:contactosdefault="mensajes.contacts"
              />
            </transition>
            <!-- Nav tabs -->
            <ul class="listamensajes-layout-menu">
              <li>
                <a
                  href="#inbox"
                  data-toggle="tab"
                  v-bind:class="{
                    active: activetab == 'home',
                    siactivo: activetab == 'home',
                  }"
                  @click="tab('home')"
                  >Inbox</a
                >
              </li>
              <li>
                <a
                  href="#enviados"
                  data-toggle="tab"
                  v-bind:class="{
                    active: activetab == 'enviados',
                    siactivo: activetab == 'enviados',
                  }"
                  @click="tab('enviados')"
                >
                  <span class="glyphicon glyphicon-user"></span>
                  Enviados
                </a>
              </li>
            </ul>
          </div>
          <div class="col-sm-9 col-md-10">
            <!-- Tab panes -->
            <div class="tab-content">
              <div
                v-show="activetab == 'home'"
                class="tab-pane"
                id="inbox"
                v-bind:class="{ active: activetab == 'home' }"
              >
                <div class="list-group text-left">
                  <a
                    href="javascript:void(0)"
                    class="list-group-item"
                    v-for="(mensaje, indexmn) in mensajes.chats"
                    :key="indexmn"
                    @click="abrirmensaje(mensaje)"
                    v-bind:class="{ read: mensaje.pivot.news == 0 }"
                  >
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span
                      class="name"
                      style="min-width: 120px; display: inline-block"
                      >{{ mensaje.user.name }}</span
                    >
                    <span class="text-muted" style="font-size: 14px"
                      >- {{ mensaje.asunto }}</span
                    >
                    <span class="badge float-right">{{
                      mensaje.created_at
                    }}</span>
                    <span class="pull-right">
                      <span class="glyphicon glyphicon-paperclip"></span>
                    </span>
                  </a>
                </div>
              </div>
              <div
                v-show="activetab == 'enviados'"
                class="tab-pane"
                id="enviados"
                v-bind:class="{ active: activetab == 'enviados' }"
              >
                <div class="list-group text-left">
                  <a
                    href="javascript:void(0)"
                    class="list-group-item"
                    v-for="(mensaje, indexmne) in mensajes.enviado"
                    :key="indexmne"
                    @click="abrirmensaje(mensaje)"
                  >
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span
                      class="name"
                      style="min-width: 120px; display: inline-block"
                      >{{ mensaje.user.name }}</span
                    >
                    <span class="text-muted" style="font-size: 14px"
                      >- {{ mensaje.asunto }}</span
                    >
                    <span class="badge float-right">{{
                      mensaje.created_at
                    }}</span>
                    <span class="pull-right">
                      <span class="glyphicon glyphicon-paperclip"></span>
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else key="viewmensaje">
        <div @click="regresaralista" class="listamensajes-showre">Regresar</div>
        <hr />
        <div class="listamensajes-layout-listamensajes">
          <div class="listamensajes-detalles">
            <a href="javascript:void(0)" class="h4 d-block">Detalles:</a>
            Enviado:
            <p>{{ mensaje.created_at }}</p>
            <a href="javascript:void(0)" @click="eliminarmensaje(mensaje.id)"
              >Eliminar</a
            >
          </div>
          <div class="listamensajes-body">
            <div class="text-left">
              <img :src="mensaje.user.image" class="avatar" />
              De:
              <span class="h4">{{ mensaje.user.name }}</span>
              <p class="for">
                Para:
                <span
                  class="address"
                  v-for="(destino, indexd) in mensaje.destino"
                  :key="indexd"
                  :id="destino.email"
                  >{{ destino.name }}</span
                >
              </p>
            </div>
            <h3>{{ mensaje.asunto }}</h3>
            <hr />
            <div class="container">
              <div
                class="listamensajes-mensaje-body"
                v-html="mensaje.body"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import FormMensaje from "./FormMensaje";
export default {
  data() {
    return {
      mensajes: [],
      showmensaje: false,
      mensaje: [],
      activetab: "home",
      allmensajes: 0,
      enviados: 0,
      recibidos: 0,
      shownm: false,
      nuevos: 0,
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  components: {
    FormMensaje,
  },
  created() {
    axios
      .get("/mensajes/" + this.curso.id)
      .then((res) => {
        this.mensajes = res.data;
        this.recibidos = res.data.chats.length;
        this.enviados = res.data.enviado.length;
        this.allmensajes = res.data.chats.length + res.data.enviado.length;
        this.nuevos = res.data.nuevos;

        this.$emit("set-mensajes", res.data.nuevos);
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    nuevomensaje() {
      this.shownm = true;
    },
    tab(value) {
      this.activetab = value;
    },
    createmensaje(mensaje) {
      if (mensaje.mensaje.id) {
        this.mensajes.enviado.unshift(mensaje.mensaje);
        this.enviados++;
        this.allmensajes++;
      }
      this.shownm = mensaje.cerrar;
    },
    abrirmensaje(m) {
      axios
        .get("/chatC/" + this.curso.id + "/" + m.id)
        .then((res) => {
          this.mensaje = res.data;
          this.showmensaje = true;
          if (res.data.leido) {
            const index = this.mensajes.chats.findIndex(
              (item) => item.id === m.id
            );

            if (index > -1) {
              this.mensajes.chats[index].pivot.news = 0;
              this.nuevos--;
              this.$emit("mensajes", false);
            }
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
          flash("Mensaje no disponible", "error");
        });
    },
    regresaralista() {
      this.showmensaje = false;
    },
    eliminarmensaje(value) {
      const confirmacion = confirm(`Eliminar mensaje`);
      if (confirmacion) {
        axios
          .delete(`/mensajes/destroyms/` + value)
          .then(() => {
            flash("Mensaje Eliminado", "info");
            const index = this.mensajes.chats.findIndex(
              (item) => item.id === value
            );

            if (this.mensajes.chats.splice(index, 1)) {
              this.recibidos--;
            }

            const indexe = this.mensajes.enviado.findIndex(
              (item) => item.id === value
            );
            if (this.mensajes.enviado.splice(indexe, 1)) {
              this.enviados--;
            }

            this.showmensaje = false;
            this.allmensajes--;
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });
      }
    },
  },
};
</script>

<style>
.listamensajes-layout {
  padding: 1rem;
  margin-top: 1rem;
}
.listamensajes-layout-header {
  display: grid;
  grid-template-columns: auto auto;
}
.listamensajes-layout-sendbottom {
  border: none;
  padding: 1rem;
  cursor: pointer;
}
.listamensajes-detalles {
  background-color: #fdc770;
  padding: 0.5rem;
}
.listamensajes-body {
  padding: 0.5rem;
}
.listamensajes-detalles a {
  display: block;
}
.listamensajes-layout-sendbottom:hover {
  background-color: white;
}
.listamensajes-layout-listamensajes {
  display: grid;
  grid-template-columns: 20% auto;
  padding: 1rem;
}
.list-group-item {
  display: block;
  padding: 1rem;
  background-color: #fcb036;
  margin: 0.5rem;
}
.list-group-item:hover {
  background-color: white;
}
.listamensajes-layout-menu {
  padding: 0.5rem;
}
.listamensajes-mensaje-body {
  padding: 1rem;
  background-color: #fdc770;
}
@media only screen and (max-width: 1050px) {
  .listamensajes-layout-listamensajes {
    grid-template-columns: 100%;
  }
}
.checkbox {
  display: inline-block;
}
.read {
  background-color: #f0f0f0;
}
.avatar {
  float: left;
  display: block;
  width: 3.5rem;
  margin-right: 1rem;
  border-radius: 50%;
}
.address {
  padding: 0.25rem 0.5rem;
  color: rgba(0, 0, 0, 0.5);
  font-size: small;
  font-weight: normal;
  background: lightblue;
  border-radius: 1rem;
  display: inline-block;
}
.siactivo {
  color: blue;
  font-size: 20px;
  font-weight: bolder;
}
.listamensajes-showre {
  background-color: #fcd770;
  padding: 0.5rem;
  float: right;
  border: 2px solid #fcd770;
  cursor: pointer;
}
.listamensajes-showre:hover {
  background-color: white;
}
@media only screen and (max-width: 1050px) {
  .listamensajes-showre {
    float: inherit;
  }
}
.enterformmsg-enter-active {
  animation: enterformmsg 0.5s ease-out;
}
.enterformmsg-leave-active {
  animation: enterformmsg 0.5s reverse ease-in;
}
@keyframes enterformmsg {
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

@keyframes enterformmsgmovil {
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
  .enterformmsg-enter-active {
    animation: enterformmsgmovil 0.5s ease-out;
  }
  .enterformmsg-leave-active {
    animation: enterformmsgmovil 0.5s reverse ease-in;
  }
}
</style>
