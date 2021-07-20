<template>
  <div class="notificaciones-contenedor">
    <h2 class="notificaciones-head">
      Actividad reciente: <span>{{ notificaciones.notificacionesnum }}</span
      ><span class="notificaciones-option" @click="marcarleidas"
        >Eliminar todo</span
      >
    </h2>
    <div class="notificaciones-lista">
      <transition-group name="list-complete" tag="div" mode="out-in">
        <div
          class="notificaciones-notificacion list-complete-item"
          v-for="notificacion in notificaciones.notificaciones"
          :key="notificacion.id"
        >
          <div class="notificaciones-icon">
            <img
              v-if="notificacion.data.type == 'actividad'"
              src="resources/icons/home-work-c.svg"
              :alt="notificacion.data.type"
            />
            <img
              v-else
              src="resources/icons/test.svg"
              :alt="notificacion.data.type"
            />
          </div>
          <div class="notificaciones-detalles">
            <div class="notificacion-detalles-head">
              {{ notificacion.data.cursoname }}
              <span
                class="notificacion-detalles-head-right badge badge-light float-right"
                >Limite: {{ notificacion.data.fecha_final }}</span
              >
            </div>
            <div class="notificacion-detalles-contenido">
              {{ notificacion.data.title }}
            </div>
            <div class="notification-option" @click="marcarleida(notificacion)">
              x
            </div>
          </div>
        </div>
      </transition-group>
      <div
        v-if="notificaciones.notificacionesnum < 1"
        class="notificaciones-notificacion"
      >
        <div class="notificaciones-icon">
          <img src="resources/icons/cafe.png" alt="limpio" />
        </div>
        <div class="notificaciones-detalles">
          <div class="notificacion-detalles-head">...</div>
          <div class="notificacion-detalles-contenido">
            Sin actividad reciente
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      notificaciones: [],
    };
  },
  created() {
    axios
      .get("/notificaciones")
      .then((res) => {
        this.notificaciones = res.data;
      })
      .catch((response) => {
        if (res.response.status === 401 || res.response.status === 419) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    marcarleidas() {
      const confirmacion = confirm(`Eliminar toda actividad`);
      if (confirmacion) {
        axios
          .get("/leernotificaciones")
          .then((res) => {
            this.notificaciones.notificaciones = [];
            this.notificaciones.notificacionesnum = 0;
            flash("Actividad eliminada", "info");
          })
          .catch((error) => {
            if (error.response.status === 401 || res.response.status === 419) {
              window.location.href = "login";
            }
          });
      }
    },
    marcarleida(notificacion) {
      const confirmacion = confirm(`Eliminar`);
      if (confirmacion) {
        axios
          .post("/leernotificacion", { id: notificacion.id })
          .then((res) => {
            const index = this.notificaciones.notificaciones.findIndex(
              (item) => item.id === res.data.id
            );
            this.notificaciones.notificaciones.splice(index, 1);
            this.notificaciones.notificacionesnum--;

            flash("Actividad eliminada", "info");
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
.notificaciones-contenedor {
  width: 100%;
  height: 100%;
}
.list-complete-item {
  transition: all 1s;
}
.list-complete-enter, .list-complete-leave-to
/* .list-complete-leave-active for <2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.list-complete-leave-active {
  position: absolute;
}
.notificaciones-head {
  font-size: 16px;
  padding: 1rem;
}
.notificaciones-notificacion {
  text-align: left;
  margin-bottom: 0.5rem;
  padding: 0.5rem;
  background-color: #fdc770 !important;
}

.notificaciones-icon {
  width: 50px;
  height: 50px;
  float: left;
}
.notificaciones-icon img {
  width: 100%;
  height: 100%;
  padding: 0.5rem;
}
.notificaciones-detalles {
  padding: 0.5rem;
}
.notificacion-detalles-head {
  color: #878686;
  font-weight: 500;
}
.notificacion-detalles-head-right {
  font-size: 12px;
  color: #878686;
  font-weight: lighter;
}
.notificacion-detalles-contenido {
  font-size: 12px;
  font-weight: 600;
}
.notification-option {
  float: right;
  padding: 3px;
  background-color: #dee2e6;
  border-radius: 50%;
  width: 1rem;
  height: 1rem;
  font-weight: 700;
  line-height: 0.5rem;
  cursor: pointer;
  text-align: center;
}
.notification-option:hover {
  background-color: red;
  color: white;
}
.notificaciones-option {
  font-size: small;
  font-weight: normal;
  padding-left: 0.5rem;
  text-decoration: underline;
  cursor: pointer;
}
.notificaciones-option:hover {
  color: red;
}
.notificaciones-lista {
  overflow-y: auto;
  height: 84%;
}
</style>