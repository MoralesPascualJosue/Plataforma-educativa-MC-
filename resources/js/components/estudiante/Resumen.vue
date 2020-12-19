<template>
  <div>
    <h3>Lista de actividades del curso</h3>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col"># Actividad</th>
            <th scope="col">Nombre</th>
            <th scope="col">{{ estudiante.name }}</th>
          </tr>
        </thead>
        <tbody class="tb-lc">
          <tr v-for="(actividad, index) in actividades" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ actividad.title }}</td>
            <td>
              <p v-if="calificaciones[index].estado == 1" class="bg-info cur-p">
                {{ calificaciones[index].qualification }}
              </p>
              <p
                v-else
                :class="{
                  'bg-warning': estadocalificacion(
                    calificaciones[index].qualification
                  ),
                  nacolor: calificaciones[index].qualification < 70,
                }"
              >
                {{ calificaciones[index].qualification }}
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    curso() {
      return this.$store.getters.cursoview;
    },
  },
  data() {
    return {
      actividades: [],
      estudiante: [],
      calificaciones: [],
    };
  },
  created() {
    axios
      .get("/calificaciones/" + this.curso.id)
      .then((res) => {
        this.actividades = res.data.actividades;
        this.calificaciones = res.data.calificaciones;
        this.estudiante = res.data.estudiante;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    estadocalificacion(value) {
      if (value == "NA") {
        return true;
      }

      return false;
    },
  },
};
</script>

<style>
.b-color {
  background-color: #c1d3d9;
}

.nacolor {
  color: red;
}

.tb-lc td:last-child {
  background-color: #c1d3d9;
}
</style>