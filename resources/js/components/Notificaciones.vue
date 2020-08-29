<template>
  <div>
    <div class="dropdown m-3">
      <button
        id="dLabelnoti"
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="btn btn-primary"
      >
        <p class="line-d" v-if="!loading">
          Notificaciones
          <span
            class="badge badge-light float-right stb"
          >{{notificaciones.notificacionesnum}}</span>
        </p>
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="loading"
        ></span>
        <p class="line-d" v-if="loading">Cargando...</p>
      </button>
      <div class="dropdown-menu noti">
        <li
          v-for="notificacion in notificaciones.notificaciones"
          :key="notificacion.id"
          class="notic"
        >
          <a href="javascript:void(0)">
            <p class="notih">
              Nueva actividad publicada
              <span
                class="badge badge-primary float-right fontct"
              >limite: {{notificacion.data.fecha_final}}</span>
            </p>
            {{notificacion.data.title}}
            <p class="notif">En {{notificacion.data.cursoname}}</p>
          </a>
        </li>
        <li v-if="notificaciones.notificacionesnum <1" class="notic">
          <a href="#" class="data-n">Sin notificaciones</a>
        </li>
        <li v-if="notificaciones.notificacionesnum>0">
          <button class="btn btn-primary marread" @click="marcarleidas">Marcar leidas</button>
        </li>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errorr: false,
      info: "",
      loading: false,
      curso: {},
      notificaciones: []
    };
  },
  created() {
    axios.get("/notificaciones").then(res => {
      this.notificaciones = res.data;
    });
  },
  mounted() {
    Echo.channel("channel-activities").listen("ActivitieEvent", e => {
      this.notificaciones.notificaciones.push({
        data: {
          activitie: e.activitie.id,
          title: e.activitie.title,
          fecha_final: e.activitie.fecha_final,
          cursoname: e.curso.title
        }
      });
      this.notificaciones.notificacionesnum++;

      this.$toast(" Tienes una nueva actividad del curso: " + e.curso.title, {
        position: "top-left",
        timeout: 5000,
        closeOnClick: true,
        pauseOnFocusLoss: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: false,
        closeButton: "button",
        icon: true,
        rtl: true
      });
    });
  },
  methods: {
    dropmenu() {
      $("#dLabelnoti").dropdown();
    },
    marcarleidas() {
      axios.get("/leernotificaciones").then(res => {
        this.notificaciones.notificaciones = [];
        this.notificaciones.notificacionesnum = 0;
        flash("Notificaciones leidas", "info");
      });
    }
  }
};
</script>

<style>
.fontct {
  font-size: 14px;
}
.noti {
  width: 300px;
  background-color: #f8fafc;
  max-height: 85vh;
  overflow-y: auto;
}
.notic {
  padding: 5px;
  border: 1px solid #f5f0ff;
  margin-bottom: 2px;
  background-color: white;
}
.notih {
  font-weight: 700;
  border-bottom: 1px solid;
}
.notif {
  font-weight: 700;
}
.marread {
  padding: 5px;
  width: 100%;
}
</style>