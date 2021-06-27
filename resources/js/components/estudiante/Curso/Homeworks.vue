<template>
  <div class="homework-layout">
    <div class="homeworks-navegationinfo">
      <div class="homeworks-title">
        <p>
          Tienes <span>{{ entregas }}</span> Actividades para el
          <span>{{ fecha }}</span>
        </p>
      </div>
    </div>
    <div v-for="curso in cursos" v-bind:key="curso.id">
      <div v-if="curso.dataB.length + curso.dataA.length > 0">
        <h2>{{ curso.title }}</h2>
        <div class="curso-activities-cards">
          <div
            v-for="test in curso.dataB"
            v-bind:key="test.id"
            class="card-activitie"
          >
            <h4>
              {{ test.title }}
              <p v-if="test.entregas == 0">Sin respuestas</p>
              <p v-else>Contestado</p>
            </h4>
            <div
              class="card-activitie-status"
              :class="{ 'card-activitie-status-a': test.entregas > 0 }"
            ></div>
          </div>

          <div
            v-for="activitie in curso.dataA"
            v-bind:key="activitie.id"
            class="card-activitie"
          >
            <h4>
              {{ activitie.title }}
              <p>
                {{ activitie.entregas }} de {{ activitie.intentos }} intentos
              </p>
            </h4>
            <div
              class="card-activitie-status"
              :class="{ 'card-activitie-status-a': activitie.entregas > 0 }"
            ></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-activitie" v-if="entregas == 0">
      <h4>Sin Actividades para hoy</h4>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cursos: [],
      fecha: "",
      entregas: 0,
    };
  },
  created() {
    axios
      .get("/homework")
      .then((res) => {
        this.fecha = res.data.fecha;
        this.cursos = res.data.cursos;
        this.entregas = res.data.entregas;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
};
</script>

<style>
.homeworks-title {
  margin: 0.5rem;
  background-color: #fcb036;
  border-radius: 20px;
  padding: 0.5rem;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}
.homeworks-title p {
  padding: 0.4rem;
  color: black;
}
.curso-activities-cards {
  display: flex;
  flex-wrap: wrap;
}
.card-activitie {
  display: grid;
  grid-template-columns: auto 15%;
  background-color: white;
  margin: 0.5rem;
  width: 48%;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
  border-radius: 8px;
  overflow: hidden;
}
.card-activitie h4 {
  padding: 1rem;
}
.card-activitie-status {
  background-color: #ee0a0a;
}
.card-activitie-status-a {
  background-color: #09af09;
}
</style>