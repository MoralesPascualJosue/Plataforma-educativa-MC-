<template>
  <div class="example containeri">
    <div class="first">
      <div class="info-content">
        <div class="info-content-top"></div>
        <div class="info-content-top-text">Clave</div>
        <div class="info-content-bottom">{{ cursoinfo.curso }}</div>
      </div>

      <div class="info-content">
        <div class="info-content-top"></div>
        <div class="info-content-top-text">Matriculados</div>
        <div class="info-content-bottom">{{ cursoinfo.matriculados }}</div>
      </div>

      <div class="info-content">
        <div class="info-content-top"></div>
        <div class="info-content-top-text">Actividades</div>
        <div class="info-content-bottom">{{ cursoinfo.tactividades }}</div>
      </div>
    </div>

    <div class="second">
      <line-chart
        :chart-data="datacollection"
        :styles="myStyles"
        :options="chartOptions"
      ></line-chart>
    </div>
    <div class="third">
      <bar-chart
        :chart-data="datacollectionb"
        :styles="myStyles"
        :options="chartOptionsb"
      ></bar-chart>
    </div>
    <div class="border-b">
      <img :src="curso.cover" alt />
    </div>
    <div>
      <div class="info-content">
        <div class="info-content-top"></div>
        <div class="info-content-top-text">Promedio del curso</div>
        <div class="info-content-bottom">{{ promedio }}</div>
      </div>
    </div>
    <div></div>
    <div>
      <h3>Creado en:</h3>
      {{ curso.created_at }}
    </div>
  </div>
</template>

<script>
import LineChart from "./LineChart.js";
import BarChart from "./BarChart.js";

export default {
  components: {
    LineChart,
    BarChart,
  },
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
    myStyles() {
      return {
        height: `100%`,
        width: `90%`,
        position: "relative",
      };
    },
  },
  data() {
    return {
      datacollection: {
        datasets: [
          {
            label: "Entregas por actividad",
            backgroundColor: ["rgba(252, 176, 54, 1)"],
            pointBackgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderWidth: 1,
          },
        ],
      },
      datacollectionb: {
        datasets: [
          {
            label: "Aprovechamiento",
            backgroundColor: ["rgba(252, 176, 54, 1)"],
            pointBackgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderWidth: 1,
          },
        ],
      },
      chartOptions: {
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                stepSize: 1,
              },
            },
          ],
        },
      },
      chartOptionsb: {
        maintainAspectRatio: false,
      },
      cursoinfo: [],
      promedio: 0,
    };
  },
  created() {
    axios
      .get("/informacion/" + this.curso.id)
      .then((res) => {
        this.cursoinfo = res.data;
        let p = res.data.promedio;
        this.promedio = ~~p;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  mounted() {
    this.fillData();
  },
  methods: {
    truncateWithEllipses(text, max) {
      return text.substr(0, max - 1) + (text.length > max ? "..." : "");
    },
    fillData() {
      axios
        .get("/informacionActividades/" + this.curso.id)
        .then((res) => {
          res.data.forEach((element) => {
            this.datacollection.labels.push(
              this.truncateWithEllipses(element["title"], 20)
            );
            this.datacollection.datasets.forEach((dataset) => {
              dataset.data.push(element["works"]);
            });
          });
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });

      axios
        .get("/informacionCursop/" + this.curso.id)
        .then((res) => {
          let label = ["Alto", "Medio", "Bajo"];
          let datos = [0, 0, 0];
          res.data.forEach((element) => {
            if (element["qualification"] > 90) {
              datos[0] += 1;
            } else if (element["qualification"] > 75) {
              datos[1] += 1;
            } else if (element["qualification"] > 69) {
              datos[2] += 1;
            }
          });

          this.datacollectionb.labels.push(label[0]);
          this.datacollectionb.datasets.forEach((dataset) => {
            dataset.data.push(datos[0]);
          });

          this.datacollectionb.labels.push(label[1]);
          this.datacollectionb.datasets.forEach((dataset) => {
            dataset.data.push(datos[1]);
          });

          this.datacollectionb.labels.push(label[2]);
          this.datacollectionb.datasets.forEach((dataset) => {
            dataset.data.push(datos[2]);
          });
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });
    },
    getRandomInt() {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
    },
  },
};
</script>

<style>
.containeri {
  min-height: 84vh;
  display: grid;
  grid-template-columns: auto auto auto;
}

.containeri > div {
  text-align: center;
  border-radius: 8px;
}

.containeri > div > img {
  max-width: 300px;
  width: 100%;
}

.chart-container {
  position: relative;
  margin: auto;
  width: 100%;
  height: 100%;
}

.chart-container2 {
  position: relative;
  margin: auto;
  width: 100%;
  height: 100%;
}

.first {
  grid-column-start: 1;
  grid-column-end: 1;
  grid-row-start: 1;
  grid-row-end: 1;
}

.first > div {
  color: white;
  border-radius: 8px;
}

.second {
  padding: 10px;
  grid-column-start: 2;
  grid-column-end: 4;
  grid-row-start: 1;
  grid-row-end: 1;
}

.third {
  padding: 10px;
  grid-row-start: 2;
  grid-row-end: 4;
  grid-column-start: 1;
  grid-column-end: 2;
}

.info-content {
  text-align: center;
  border-radius: 8px;
  position: relative;
  background: #fcb036;
  min-width: 200px;
  height: 150px;
  margin: 0 auto;
  margin-top: 10px;
  max-width: 90%;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}

.info-content-top {
  border-radius: 8px;
  position: absolute;
  width: 100%;
  height: 75px;
  margin: 0 auto;
}

.info-content-top-text {
  position: absolute;
  margin: 0 auto;
  left: 10px;
  top: 5px;
  font-size: 25px;
  color: white;
  user-select: none;
}

.info-content-bottom {
  position: absolute;
  background: white;
  width: 80%;
  height: 2rem;
  z-index: 99;
  bottom: 1rem;
  left: 2rem;
  border-radius: 8px;
  font-size: 22px;
  color: black;
}

.border-b {
  padding: 10px;
}

.border-b img {
  border: 10px solid #fcb036;
  border-radius: 8px;
  box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 10%);
}

@media (max-width: 1050px) {
  .containeri {
    display: block;
    padding: 0px;
  }
  .chart-container,
  .chart-container2 {
    width: 300px;
    height: 500px;
  }
  .containeri:first-child {
    width: 99%;
    margin-top: 5px;
  }
}
</style>
