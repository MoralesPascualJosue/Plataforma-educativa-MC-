<template>
  <div
    class="lista-actividades-actividad"
    :class="{
      'lista-actividades-actividad-week': towwek,
      'lista-actividades-actividad-today': today,
    }"
  >
    <div class="lista-actividades-actividad-date">
      <h1>{{ month }}</h1>
    </div>
    <div
      class="lista-actividades-actividad-details"
      @click="$emit('pop-image', activitie)"
    >
      <div class="lista-actividades-actividad-details-date">
        {{ daydategroup(activitie.fecha_inicio) }}
      </div>
      <div class="lista-actividades-actividad-detail-info">
        <img
          v-if="activitie.type != 'activitie'"
          :src="iconprueba"
          alt="Prueba"
        />
        <img v-else :src="iconactividad" alt="Actividad" />
        <div class="lista-actividades-actividad-detail-info-data">
          <p v-if="activitie.type != 'activitie'">Prueba agregada</p>
          <p v-else>Actividad agregada</p>
          <p
            :class="{
              'lista-actividades-actividad-detail-info-data-week': towwek,
              'lista-actividades-actividad-detail-info-data-today': today,
            }"
          >
            Fecha limite de entrega: {{ activitie.fecha_final }}
          </p>
          <div>{{ activitie.title }}</div>
        </div>
        <span
          v-if="activitie.entregas > 0"
          class="lista-actividades-actividad-detail-tips"
          >Pendientes: {{ activitie.entregas }}</span
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      iconactividad: "../resources/icons/home-work-c.svg",
      iconprueba: "../resources/icons/test.svg",
    };
  },
  props: {
    activitie: Object,
    month: String,
  },
  computed: {
    today() {
      var dateg = this.activitie.fecha_final.split("-");
      var dategd = new Date(`${dateg[0]}/${dateg[1]}/${dateg[2]}`);
      var todaydate = new Date();
      todaydate.setHours(0, 0, 0, 0);
      dategd.setHours(0, 0, 0, 0);
      if (todaydate.getTime() == dategd.getTime()) {
        return true;
      } else {
        return false;
      }
    },
    towwek() {
      var dateg = this.activitie.fecha_final.split("-");
      var dategd = new Date(`${dateg[0]}/${dateg[1]}/${dateg[2]}`);
      var todaydate = new Date();
      todaydate.setHours(0, 0, 0, 0);
      dategd.setHours(0, 0, 0, 0);
      if (
        dategd.getFullYear() == todaydate.getFullYear() &&
        this.getWeekNumber(dategd) == this.getWeekNumber(todaydate)
      ) {
        return true;
      } else {
        return false;
      }
    },
  },
  methods: {
    getWeekNumber(date) {
      var d = new Date(date); //Creamos un nuevo Date con la fecha de "this".
      d.setHours(0, 0, 0, 0); //Nos aseguramos de limpiar la hora.
      d.setDate(d.getDate() + 4 - (d.getDay() || 6)); // Recorremos los días para asegurarnos de estar "dentro de la semana"
      //Finalmente, calculamos redondeando y ajustando por la naturaleza de los números en JS:
      return Math.ceil(
        ((d - new Date(d.getFullYear(), 0, 1)) / 8.64e7 + 1) / 7
      );
    },
    yeardategoup(fechai) {
      var dateg = fechai.split("-");
      return dateg[0];
    },
    daydategroup(fechai) {
      var dateg = fechai.split("-");
      var dategd = new Date(`${dateg[0]}/${dateg[1]}/${dateg[2]}`);
      return dategd.toLocaleString("default", {
        day: "2-digit",
        weekday: "short",
      });
    },
  },
};
</script>
<style>
.lista-actividades-actividad {
  padding-left: 60px;
  display: flex;
  flex-direction: column;
  position: relative;
}
.lista-actividades-actividad-date {
  display: flex;
  text-transform: uppercase;
}
.lista-actividades-actividad-details {
  padding: 0.5rem;
  margin: 0rem 0rem 0rem 5rem;
  display: flex;
  align-items: center;
  cursor: pointer;
  position: relative;
}
.lista-actividades-actividad-details:hover {
  background-color: #fdc770;
}
.lista-actividades-actividad-details-date {
  margin-right: 1rem;
  width: 4rem;
}
.lista-actividades-actividad-detail-info {
  display: flex;
  align-items: flex-start;
}
.lista-actividades-actividad-detail-info img {
  padding-top: 0.4rem;
  width: 30px;
}
.lista-actividades-actividad-detail-info-data {
  padding-left: 0.5rem;
}
.lista-actividades-actividad-detail-info-data p,
.lista-actividades-actividad-detail-info-data div {
  padding-left: 0.5rem;
}
.lista-actividades-actividad-detail-tips {
  position: absolute;
  right: 1rem;
}

.lista-actividades-actividad:before {
  content: "";
  width: 8px;
  height: 100%;
  background: #fcb036;
  position: absolute;
  left: 32px;
  top: 20px;
}
.lista-actividades-actividad:after {
  content: "";
  position: absolute;
  background: #fcd770;
  bottom: 74%;
  left: 24px;
  width: 15px;
  height: 15px;
  border: 5px solid #fcb036;
  border-radius: 50%;
}

.lista-actividades-actividad-detail-info-data-week {
  background-color: #ffff00;
  border-radius: 20px;
  color: black;
}
.lista-actividades-actividad-week:after {
  content: "";
  position: absolute;
  background: #ffff00;
  bottom: 74%;
  left: 24px;
  width: 15px;
  height: 15px;
  border: 5px solid #fcb036;
  border-radius: 50%;
}

.lista-actividades-actividad-detail-info-data-today {
  background-color: #84b145;
  border-radius: 20px;
  color: black;
}

.lista-actividades-actividad-today:after {
  content: "";
  position: absolute;
  background: #84b145;
  bottom: 74%;
  left: 24px;
  width: 15px;
  height: 15px;
  border: 5px solid #fcb036;
  border-radius: 50%;
}

@media only screen and (max-width: 1050px) {
  .lista-actividades-actividad-detail-info img {
    display: none;
  }
  .lista-actividades-actividad-date {
    font-size: 8px;
  }
  .lista-actividades-actividad-details {
    margin: 0rem 0rem 0rem 1rem;
  }
}
</style>