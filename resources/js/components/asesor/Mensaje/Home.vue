<template>
  <div class="mensaje-layout">
    <div class="mensaje-layout-cabezera">
      <div class="mensaje-layout-cabezera-user">
        <img :src="user.image" alt="user" />
        <div class="mensaje-layout-cabezera-user-details">
          <p>{{ user.name }}</p>
          <span>{{ user.email }}</span>
        </div>
      </div>
      <div class="mensaje-layout-cabezera-title">
        <h3>Mensajes</h3>
        <span v-if="nuevos > 0" class="text-muted">
          Nuevos:
          <b>{{ nuevos }}</b>
        </span>
      </div>
    </div>
    <div class="mensaje-layout-container">
      <div class="mensaje-layout-container-paneltool">
        <div
          class="mensaje-layout-container-paneltool-item"
          v-bind:class="{
            'mensaje-layout-container-paneltool-item-active':
              activetab == 'home',
          }"
          @click="tab('home')"
        >
          <div
            class="
              mensaje-layout-container-paneltool-item-icon
              mensaje-layout-container-paneltool-item-icon-all
            "
          >
            <svg viewBox="0 0 34 32">
              <g transform="translate(-190 -489)">
                <g class="a" transform="translate(190 489)">
                  <path
                    class="c"
                    d="M 32 31.5 L 2 31.5 C 1.172899961471558 31.5 0.5 30.82710075378418 0.5 30 L 0.5 2 C 0.5 1.172899961471558 1.172899961471558 0.5 2 0.5 L 32 0.5 C 32.82709884643555 0.5 33.5 1.172899961471558 33.5 2 L 33.5 30 C 33.5 30.82710075378418 32.82709884643555 31.5 32 31.5 Z"
                  />
                  <path
                    class="d"
                    d="M 2 1 C 1.448600769042969 1 1 1.448600769042969 1 2 L 1 30 C 1 30.55139923095703 1.448600769042969 31 2 31 L 32 31 C 32.55139923095703 31 33 30.55139923095703 33 30 L 33 2 C 33 1.448600769042969 32.55139923095703 1 32 1 L 2 1 M 2 0 L 32 0 C 33.10456848144531 0 34 0.8954296112060547 34 2 L 34 30 C 34 31.10457038879395 33.10456848144531 32 32 32 L 2 32 C 0.8954315185546875 32 0 31.10457038879395 0 30 L 0 2 C 0 0.8954296112060547 0.8954315185546875 0 2 0 Z"
                  />
                </g>
                <path
                  class="b"
                  d="M1631.914,499.876,1644,496.282l12.091,3.595L1644,504v12.878L1631.914,512Z"
                  transform="translate(-1436)"
                />
                <path
                  class="b"
                  d="M1644,516.672,1655.473,512l.24-12.045h-23.446L1644,504l-11.732,8"
                  transform="translate(-1436)"
                />
              </g>
            </svg>
          </div>
          <div
            class="
              mensaje-layout-container-paneltool-item-details
              mensaje-layout-container-paneltool-item-details-all
            "
          >
            <p>Todos</p>
            <span>Ver todos los mensajes</span>
          </div>
        </div>
        <div
          class="mensaje-layout-container-paneltool-item"
          v-bind:class="{
            'mensaje-layout-container-paneltool-item-active':
              activetab == 'send',
          }"
          @click="tab('send')"
        >
          <div
            class="
              mensaje-layout-container-paneltool-item-icon
              mensaje-layout-container-paneltool-item-icon-send
            "
          >
            <svg viewBox="0 0 33 32">
              <g transform="translate(-244 -541)">
                <g class="a" transform="translate(244 541)">
                  <path
                    class="c"
                    d="M 31.0588207244873 31.5 L 1.941179990768433 31.5 C 1.146510004997253 31.5 0.5 30.82710075378418 0.5 30 L 0.5 2 C 0.5 1.172899961471558 1.146510004997253 0.5 1.941179990768433 0.5 L 31.0588207244873 0.5 C 31.85349082946777 0.5 32.5 1.172899961471558 32.5 2 L 32.5 30 C 32.5 30.82710075378418 31.85349082946777 31.5 31.0588207244873 31.5 Z"
                  />
                  <path
                    class="d"
                    d="M 1.941179275512695 1 C 1.422210693359375 1 1 1.448600769042969 1 2 L 1 30 C 1 30.55139923095703 1.422210693359375 31 1.941179275512695 31 L 31.0588207244873 31 C 31.57778930664063 31 32 30.55139923095703 32 30 L 32 2 C 32 1.448600769042969 31.57778930664063 1 31.0588207244873 1 L 1.941179275512695 1 M 1.941179275512695 0 L 31.0588207244873 0 C 32.13090133666992 0 33 0.8954296112060547 33 2 L 33 30 C 33 31.10457038879395 32.13090133666992 32 31.0588207244873 32 L 1.941179275512695 32 C 0.8690910339355469 32 0 31.10457038879395 0 30 L 0 2 C 0 0.8954296112060547 0.8690910339355469 0 1.941179275512695 0 Z"
                  />
                </g>
                <path
                  class="b"
                  d="M1686.213,565.418h20.216V552h-20.216Z"
                  transform="translate(-1436 -2)"
                />
                <path
                  class="b"
                  d="M1686.213,552l9.729,6.769L1706.518,552"
                  transform="translate(-1436 -2)"
                />
              </g>
            </svg>
          </div>
          <div
            class="
              mensaje-layout-container-paneltool-item-details
              mensaje-layout-container-paneltool-item-details-send
            "
          >
            <p>Enviados</p>
            <span>Ver mensajes enviados</span>
          </div>
        </div>
        <div
          class="mensaje-layout-container-paneltool-item"
          v-bind:class="{
            'mensaje-layout-container-paneltool-item-active':
              activetab == 'inbox',
          }"
          @click="tab('inbox')"
        >
          <div
            class="
              mensaje-layout-container-paneltool-item-icon
              mensaje-layout-container-paneltool-item-icon-inbox
            "
          >
            <svg viewBox="0 0 34 32">
              <g transform="translate(-190 -541)">
                <g class="a" transform="translate(190 541)">
                  <path
                    class="c"
                    d="M 32 31.5 L 2 31.5 C 1.172899961471558 31.5 0.5 30.82710075378418 0.5 30 L 0.5 2 C 0.5 1.172899961471558 1.172899961471558 0.5 2 0.5 L 32 0.5 C 32.82709884643555 0.5 33.5 1.172899961471558 33.5 2 L 33.5 30 C 33.5 30.82710075378418 32.82709884643555 31.5 32 31.5 Z"
                  />
                  <path
                    class="d"
                    d="M 2 1 C 1.448600769042969 1 1 1.448600769042969 1 2 L 1 30 C 1 30.55139923095703 1.448600769042969 31 2 31 L 32 31 C 32.55139923095703 31 33 30.55139923095703 33 30 L 33 2 C 33 1.448600769042969 32.55139923095703 1 32 1 L 2 1 M 2 0 L 32 0 C 33.10456848144531 0 34 0.8954296112060547 34 2 L 34 30 C 34 31.10457038879395 33.10456848144531 32 32 32 L 2 32 C 0.8954315185546875 32 0 31.10457038879395 0 30 L 0 2 C 0 0.8954296112060547 0.8954315185546875 0 2 0 Z"
                  />
                </g>
                <path
                  class="b"
                  d="M1639.621,557v11h3.6V557Z"
                  transform="translate(-1436.223)"
                />
                <path
                  class="b"
                  d="M1649.305,553.681v-7.687H1652V544h-4.7v9.681Z"
                  transform="translate(-1436)"
                />
                <path
                  class="b"
                  d="M1648.431,548.861H1633.6v9.032h21.644v-9.032h-4.98"
                  transform="translate(-1437 -0.893)"
                />
              </g>
            </svg>
          </div>
          <div
            class="
              mensaje-layout-container-paneltool-item-details
              mensaje-layout-container-paneltool-item-details-inbox
            "
          >
            <p>Recibidos</p>
            <span>Ver mensajes pendientes</span>
          </div>
        </div>
        <div
          class="mensaje-layout-container-paneltool-item"
          v-bind:class="{
            'mensaje-layout-container-paneltool-item-active':
              activetab == 'today',
          }"
          @click="tab('today')"
        >
          <div
            class="
              mensaje-layout-container-paneltool-item-icon
              mensaje-layout-container-paneltool-item-icon-today
            "
          >
            <svg viewBox="0 0 33 32">
              <g transform="translate(-297 -541)">
                <g class="a" transform="translate(297 541)">
                  <path
                    class="e"
                    d="M 31.0588207244873 31.5 L 1.941179990768433 31.5 C 1.146510004997253 31.5 0.5 30.82710075378418 0.5 30 L 0.5 2 C 0.5 1.172899961471558 1.146510004997253 0.5 1.941179990768433 0.5 L 31.0588207244873 0.5 C 31.85349082946777 0.5 32.5 1.172899961471558 32.5 2 L 32.5 30 C 32.5 30.82710075378418 31.85349082946777 31.5 31.0588207244873 31.5 Z"
                  />
                  <path
                    class="fo"
                    d="M 1.941179275512695 1 C 1.422210693359375 1 1 1.448600769042969 1 2 L 1 30 C 1 30.55139923095703 1.422210693359375 31 1.941179275512695 31 L 31.0588207244873 31 C 31.57778930664063 31 32 30.55139923095703 32 30 L 32 2 C 32 1.448600769042969 31.57778930664063 1 31.0588207244873 1 L 1.941179275512695 1 M 1.941179275512695 0 L 31.0588207244873 0 C 32.13090133666992 0 33 0.8954296112060547 33 2 L 33 30 C 33 31.10457038879395 32.13090133666992 32 31.0588207244873 32 L 1.941179275512695 32 C 0.8690910339355469 32 0 31.10457038879395 0 30 L 0 2 C 0 0.8954296112060547 0.8690910339355469 0 1.941179275512695 0 Z"
                  />
                </g>
                <g class="b" transform="translate(303 549)">
                  <path
                    class="e"
                    d="M 19 19.53491592407227 L 2 19.53491592407227 C 1.172899961471558 19.53491592407227 0.5 18.70184516906738 0.5 17.67786598205566 L 0.5 2.357046127319336 C 0.5 1.33306610584259 1.172899961471558 0.4999960660934448 2 0.4999960660934448 L 19 0.4999960660934448 C 19.82710075378418 0.4999960660934448 20.5 1.33306610584259 20.5 2.357046127319336 L 20.5 17.67786598205566 C 20.5 18.70184516906738 19.82710075378418 19.53491592407227 19 19.53491592407227 Z"
                  />
                  <path
                    class="f"
                    d="M 2 0.9999961853027344 C 1.457939147949219 0.9999961853027344 1 1.62144660949707 1 2.357046127319336 L 1 17.67786598205566 C 1 18.41346549987793 1.457939147949219 19.03491592407227 2 19.03491592407227 L 19 19.03491592407227 C 19.54206085205078 19.03491592407227 20 18.41346549987793 20 17.67786598205566 L 20 2.357046127319336 C 20 1.62144660949707 19.54206085205078 0.9999961853027344 19 0.9999961853027344 L 2 0.9999961853027344 M 2 -3.814697265625e-06 L 19 -3.814697265625e-06 C 20.10457038879395 -3.814697265625e-06 21 1.055286407470703 21 2.357046127319336 L 21 17.67786598205566 C 21 18.9796257019043 20.10457038879395 20.03491592407227 19 20.03491592407227 L 2 20.03491592407227 C 0.8954296112060547 20.03491592407227 0 18.9796257019043 0 17.67786598205566 L 0 2.357046127319336 C 0 1.055286407470703 0.8954296112060547 -3.814697265625e-06 2 -3.814697265625e-06 Z"
                  />
                </g>
                <path
                  class="c"
                  d="M1740,548.295s-.691,3.922,1.119,3.017a5.324,5.324,0,0,0,2.413-3.017s-2.338-1.508-2.413-.377,2.413,3.545,3.545,3.394c.37-.049,1.894-2.107,2.338-3.017.511-1.011-1.252-1.286-1.81-.83-.83.679-1.508,1.584-.528,3.469s2.715,0,4.978-1.659-.887-3.394-1.641-.98,3.828,5.44,4.809,1.358-1.207-2.187-1.81-.905,1.961,2.876,3.168,2.564,4.347-4.525,1.834-3.846-.1,4.158,1.183,3.846,2.187-6.863,1.433-3.017,2.112,3.017,2.112,3.017"
                  transform="translate(-1436)"
                />
                <text class="d" transform="translate(313 562)">
                  <tspan x="-6.535" y="0">Día</tspan>
                </text>
              </g>
            </svg>
          </div>
          <div
            class="
              mensaje-layout-container-paneltool-item-details
              mensaje-layout-container-paneltool-item-details-today
            "
          >
            <p>Hoy</p>
            <span>Ver mensajes recibidos de hoy</span>
          </div>
        </div>
      </div>
      <div class="mensaje-layout-container-cabezera">
        <div
          class="mensaje-layout-container-cabezera-nuevo"
          @click="nuevomensaje"
        >
          <ButtonMessage />
        </div>
        <transition name="enterformmsg">
          <FormMensaje
            v-if="shownm"
            :shownm="shownm"
            @crear-mensaje="createmensaje"
            v-bind:contactosdefault="mensajes.contacts"
          />
        </transition>
        <div></div>
      </div>
      <transition name="fade" mode="out-in">
        <div
          class="mensaje-layout-content"
          v-if="!showmensaje"
          key="listmensajes"
        >
          <div
            class="mensaje-mask"
            v-for="(mensaje, indexmn) in messages"
            :key="indexmn"
            @click="abrirmensaje(mensaje)"
          >
            <MessageItem :mensaje="mensaje" />
          </div>
        </div>
        <div v-else key="viewmensaje" class="mensaje-layout-content">
          <div @click="regresaralista" class="backtolist-est">Regresar</div>
          <hr />
          <div class="listamensajes-body">
            <div class="listamensajes-layout-listamensajes">
              <div class="listamensajes-detalles">
                <a href="javascript:void(0)" class="h4 d-block">Detalles:</a>
                Enviado:
                <p>{{ mensaje.created_at }}</p>
                <a
                  href="javascript:void(0)"
                  @click="eliminarmensaje(mensaje.id)"
                  >Eliminar</a
                >
              </div>
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
            </div>
            <h3>{{ mensaje.asunto }}</h3>
            <hr />
            <div class="container">
              <div
                class="listamensajes-mensaje-body trix-content"
                v-html="mensaje.body"
              ></div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import ButtonMessage from "./ButtonMessage.vue";
import MessageItem from "./MessageItem.vue";
import FormMensaje from "./FormMensaje";
export default {
  components: {
    ButtonMessage,
    MessageItem,
    FormMensaje,
  },
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
    user() {
      return this.$store.getters.loginview;
    },
    curso() {
      return this.$store.getters["cursos/cursoview"];
    },
    messages() {
      if (this.activetab == "send") {
        return this.mensajes.enviado;
      } else if (this.activetab == "today") {
        return this.mensajes.chats.filter((msg) => {
          var fechauno = new Date();
          var fechados = new Date(msg.updated_at);
          fechauno.setHours(0, 0, 0, 0);
          fechados.setHours(0, 0, 0, 0);
          return fechauno.getTime() === fechados.getTime();
        });
      } else if (this.activetab == "inbox") {
        return this.mensajes.chats.filter((msg) => {
          return msg.pivot.news != 0;
        });
      } else {
        return this.mensajes.chats;
      }
    },
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
    tab(value) {
      this.activetab = value;
      this.showmensaje = false;
    },
    nuevomensaje() {
      this.shownm = true;
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
  },
};
</script>

<style>
.mensaje-layout-container-paneltool-item-icon-all .a {
  fill: none;
}
.mensaje-layout-container-paneltool-item-icon-all .a,
.mensaje-layout-container-paneltool-item-icon-all .b {
  stroke-linejoin: bevel;
}
.mensaje-layout-container-paneltool-item-icon-all .b {
  fill: none;
  stroke: #000;
  stroke-linecap: square;
}
.mensaje-layout-container-paneltool-item-icon-all .c,
.mensaje-layout-container-paneltool-item-icon-all .d {
  stroke: none;
}
.mensaje-layout-container-paneltool-item-icon-all .d {
  fill: none;
}

.mensaje-layout-container-paneltool-item-icon-send .a {
  fill: none;
  stroke-linejoin: bevel;
}
.mensaje-layout-container-paneltool-item-icon-send .b {
  fill: none;
  stroke: #000;
}
.mensaje-layout-container-paneltool-item-icon-send .c,
.mensaje-layout-container-paneltool-item-icon-send .d {
  stroke: none;
}
.mensaje-layout-container-paneltool-item-icon-send .d {
  fill: none;
}

.mensaje-layout-container-paneltool-item-icon-inbox .a {
  fill: none;
  stroke-linejoin: bevel;
}
.mensaje-layout-container-paneltool-item-icon-inbox .b {
  fill: none;
  stroke: #000;
}
.mensaje-layout-container-paneltool-item-icon-inbox .c,
.mensaje-layout-container-paneltool-item-icon-inbox .d {
  stroke: none;
}
.mensaje-layout-container-paneltool-item-icon-inbox .d {
  fill: none;
}

.mensaje-layout-container-paneltool-item-icon-today .a,
.mensaje-layout-container-paneltool-item-icon-today .b {
  fill: none;
}
.mensaje-layout-container-paneltool-item-icon-today .a {
  stroke-linejoin: bevel;
}
.mensaje-layout-container-paneltool-item-icon-today .c {
  fill: none;
}
.mensaje-layout-container-paneltool-item-icon-today .c,
.mensaje-layout-container-paneltool-item-icon-today .d {
  stroke: #000;
}
.mensaje-layout-container-paneltool-item-icon-today .d,
.mensaje-layout-container-paneltool-item-icon-today .f {
  fill: #000;
}
.mensaje-layout-container-paneltool-item-icon-today .d {
  stroke-width: 0.5px;
  font-size: 9px;
  font-family: SegoeUI, Segoe UI;
}
.mensaje-layout-container-paneltool-item-icon-today .e,
.mensaje-layout-container-paneltool-item-icon-today .f {
  stroke: none;
}

.mensaje-layout {
  background-color: white;
  border-radius: 20px;
  display: flex;
  flex-direction: column;
  height: 100%;
}
.mensaje-layout-cabezera {
  height: 10%;
  display: grid;
  grid-template-columns: 25% auto;
  margin: 0.5rem;
}
.mensaje-layout-cabezera-user {
  padding: 0.5rem;
  display: flex;
}
.mensaje-layout-cabezera-user img {
  height: 4rem;
  width: 4rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
  border-radius: 20px;
}
.mensaje-layout-cabezera-user-details {
  display: flex;
  flex-direction: column;
  margin-left: 1rem;
  align-items: flex-start;
  justify-content: space-around;
}
.mensaje-layout-cabezera-user-details p {
  margin: 0;
  font-size: 18px;
  font-weight: bolder;
}
.mensaje-layout-cabezera-user-details span {
  font-size: 14px;
}
.mensaje-layout-container {
  display: grid;
  grid-template-columns: 20% auto;
  grid-template-rows: 70px auto;
  height: 89%;
}

.mensaje-layout-container-paneltool {
  padding: 0.5rem;
  grid-row: span 2;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-left: 0.5rem;
}
.mensaje-layout-container-paneltool div:first-child {
  border-radius: 8px 8px 0px 0px;
}
.mensaje-layout-container-paneltool div:last-child {
  border-radius: 0px 0px 8px 8px;
}
.mensaje-layout-container-paneltool-item {
  display: flex;
  align-items: center;
  background-color: #fdc770;
  width: 100%;
  padding: 0.5rem;
  cursor: pointer;
}
.mensaje-layout-container-paneltool-item:hover,
.mensaje-layout-container-paneltool-item-active {
  background-color: #fcb036;
}
.mensaje-layout-container-paneltool-item-icon {
  width: 5rem;
}
.mensaje-layout-container-paneltool-item-details {
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: flex-start;
  margin-left: 1rem;
}
.mensaje-layout-container-paneltool-item-details p {
  font-size: 18px;
  color: #03658c;
}

.mensaje-layout-cabezera-title {
  display: flex;
  align-items: center;
  justify-content: space-around;
}

.mensaje-layout-container-cabezera {
  display: flex;
  margin-left: 0.7rem;
  margin-right: 0.7rem;
  justify-content: space-between;
}
.mensaje-layout-container-cabezera-nuevo {
  display: flex;
  padding: 0.5rem;
  width: 20%;
}
.mensaje-layout-content {
  margin-left: 0.7rem;
  margin-right: 0.7rem;
  padding: 0.5rem;
  overflow-y: auto;
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

.listamensajes-layout-listamensajes {
  display: grid;
  grid-template-columns: 15% auto;
  padding: 1rem;
}
.list-group-item {
  display: block;
  padding: 1rem;
  background-color: #fcb036;
  margin: 0.5rem;
}
.listamensajes-layout-menu {
  padding: 0.5rem;
}
.listamensajes-mensaje-body {
  padding: 0.5rem;
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
  height: 3.5rem;
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
.backtolist-est {
  background-color: #fdc770;
  min-width: 85px;
  position: absolute;
  right: 2rem;
  cursor: pointer;
  padding: 0.5rem;
}
.backtolist-est:hover {
  background-color: #fcb036;
}

@media only screen and (max-width: 1050px) {
  .mensaje-layout-container-paneltool-item {
    overflow: hidden;
  }
  .mensaje-layout-container-paneltool-item-details {
    display: none;
  }
}
</style>

