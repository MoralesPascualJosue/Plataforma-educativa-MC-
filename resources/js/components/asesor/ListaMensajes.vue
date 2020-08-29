<template>
  <div class="container">
    <transition name="fade" mode="out-in">
      <div v-if="!showmensaje" key="listmensajes">
        <div class="row">
          <div class="col-sm-3 col-md-2"></div>
          <div class="col-sm-9 col-md-10">
            <div class="pull-right">
              <span class="text-muted">
                <b v-if="activetab == 'home'">{{recibidos}}</b>
                <b v-else>{{enviados}}</b>
                of
                <b>{{allmensajes}}</b>
              </span>
              <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </button>
                <button type="button" class="btn btn-default">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-sm-3 col-md-2">
            <button
              type="button"
              aria-haspopup="true"
              aria-expanded="false"
              @click="nuevomensaje"
              class="btn btn-danger btn-sm btn-block"
            >Enviar mensaje</button>
            <FormMensaje
              v-if="shownm"
              :shownm="shownm"
              @crear-mensaje="createmensaje"
              v-bind:contactosdefault="mensajes.contacts"
            />
            <hr />
            <!-- Nav tabs -->
            <ul class="nav flex-column nav-pills">
              <li>
                <a
                  href="#inbox"
                  data-toggle="tab"
                  v-bind:class=" {active: activetab=='home', siactivo: activetab=='home'}"
                  @click="tab('home')"
                >Inbox</a>
              </li>
              <li>
                <a
                  href="#enviados"
                  data-toggle="tab"
                  v-bind:class=" {active: activetab=='enviados', siactivo: activetab=='enviados'}"
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
              <div class="tab-pane" id="inbox" v-bind:class=" {active: activetab=='home'}">
                <div class="list-group text-left">
                  <a
                    href="javascript:void(0)"
                    class="list-group-item"
                    v-for="(mensaje,indexmn) in mensajes.chats"
                    :key="indexmn"
                    @click="abrirmensaje(mensaje)"
                    v-bind:class="{'read': mensaje.pivot.news == 0}"
                  >
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span
                      class="name"
                      style="min-width: 120px;
                                        display: inline-block;"
                    >{{mensaje.user.name}}</span>
                    <span class="text-muted" style="font-size: 14px;">- {{mensaje.asunto}}</span>
                    <span class="badge float-right">{{mensaje.created_at}}</span>
                    <span class="pull-right">
                      <span class="glyphicon glyphicon-paperclip"></span>
                    </span>
                  </a>
                </div>
              </div>
              <div class="tab-pane" id="enviados" v-bind:class=" {active: activetab=='enviados'}">
                <div class="list-group text-left">
                  <a
                    href="javascript:void(0)"
                    class="list-group-item"
                    v-for="(mensaje,indexmne) in mensajes.enviado"
                    :key="indexmne"
                    @click="abrirmensaje(mensaje)"
                  >
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span
                      class="name"
                      style="min-width: 120px;
                                        display: inline-block;"
                    >{{mensaje.user.name}}</span>
                    <span class="text-muted" style="font-size: 14px;">- {{mensaje.asunto}}</span>
                    <span class="badge float-right">{{mensaje.created_at}}</span>
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
        <div @click="regresaralista" class="backtolist">Regresar</div>
        <hr />
        <div class="row">
          <div class="col-sm-3 col-md-2">
            <a href="javascript:void(0)" class="h4 d-block">Detalles:</a>
            Enviado:
            <p>{{mensaje.created_at}}</p>
            <a href="javascript:void(0)" @click="eliminarmensaje(mensaje.id)">Eliminar</a>
          </div>
          <div class="col-sm-9 col-md-10">
            <div class="text-left">
              <img :src="mensaje.user.image" class="avatar" />
              De:
              <span class="h4">{{mensaje.user.name}}</span>
              <p class="for">
                Para:
                <span
                  class="address"
                  v-for="(destino,indexd) in mensaje.destino"
                  :key="indexd"
                  :id="destino.email"
                >{{destino.name}}</span>
              </p>
            </div>
            <h3>{{mensaje.asunto}}</h3>
            <hr />
            <div class="container">
              <div class="row" v-html="mensaje.body"></div>
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
      shownm: false
    };
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    }
  },
  components: {
    FormMensaje
  },
  created() {
    axios.get("/mensajes/" + this.curso.id).then(res => {
      this.mensajes = res.data;
      this.recibidos = res.data.chats.length;
      this.enviados = res.data.enviado.length;
      this.allmensajes = res.data.chats.length + res.data.enviado.length;
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
        .then(res => {
          this.mensaje = res.data;
          this.showmensaje = true;

          if (res.data.leido) {
            const index = this.mensajes.chats.findIndex(
              item => item.id === m.id
            );
            this.mensajes.chats[index].pivot.news = 0;
          }
        })
        .catch(err => {
          flash("Mensaje no disponible", "error");
        });
    },
    regresaralista() {
      this.showmensaje = false;
    },
    eliminarmensaje(value) {
      const confirmacion = confirm(`Eliminar mensaje`);
      if (confirmacion) {
        axios.delete(`/mensajes/destroyms/` + value).then(() => {
          flash("Mensaje Eliminado", "info");
          const index = this.mensajes.chats.findIndex(
            item => item.id === value
          );

          if (this.mensajes.chats.splice(index, 1)) {
            this.recibidos--;
          }

          const indexe = this.mensajes.enviado.findIndex(
            item => item.id === value
          );
          if (this.mensajes.enviado.splice(indexe, 1)) {
            this.enviados--;
          }

          this.showmensaje = false;
          this.allmensajes--;
        });
      }
    }
  }
};
</script>

<style>
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
</style>