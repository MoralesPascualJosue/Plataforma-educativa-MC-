<template>
  <div>
    <form @submit.prevent="editarNota(nota)" v-if="modoEditar">
      <h3>Editar anuncio</h3>
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Nombre de la nota"
        v-model="nota.anuncio"
      />
      <button class="btn btn-warning" type="submit">Editar</button>
      <button class="btn btn-danger" type="submit" @click="cancelarEdicion">
        Cancelar
      </button>
    </form>
    <form @submit.prevent="agregar" v-else>
      <h3>Agregar anuncio</h3>
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Nombre de la nota"
        v-model="nota.anuncio"
      />
      <button class="btn btn-primary" type="submit">Agregar</button>
    </form>
    <hr />
    <h3>Lista de anuncios:</h3>
    <ul class="list-group">
      <li class="list-group-item" v-for="(item, index) in notas" :key="index">
        <span class="badge badge-primary float-right">{{
          item.updated_at
        }}</span>
        <p>{{ item.anuncio }}</p>
        <p class="btn-group btn-group-sm">
          <button class="btn btn-warning" @click="editarFormulario(item)">
            Editar
          </button>
          <button class="btn btn-danger" @click="eliminarNota(item, index)">
            Eliminar
          </button>
        </p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notas: [],
      modoEditar: false,
      nota: { anuncio: "" },
    };
  },
  created() {
    axios
      .get("/home")
      .then((res) => {
        this.notas = res.data;
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
  methods: {
    agregar() {
      if (this.nota.anuncio.trim() === "") {
        alert("Debes completar todos los campos antes de guardar");
        return;
      }
      const notaNueva = this.nota;
      this.nota = { anuncio: "" };
      axios
        .post("/storea", notaNueva)
        .then((res) => {
          const notaServidor = res.data;
          this.notas.unshift(notaServidor);
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });
    },
    editarFormulario(item) {
      this.nota.anuncio = item.anuncio;
      this.nota.id = item.id;
      this.modoEditar = true;
    },
    editarNota(nota) {
      const params = { anuncio: nota.anuncio };
      axios
        .put(`/updatea/${nota.id}`, params)
        .then((res) => {
          this.modoEditar = false;
          const index = this.notas.findIndex((item) => item.id === nota.id);
          this.notas[index] = res.data;
        })
        .catch((error) => {
          if (error.response.status === 401) {
            window.location.href = "login";
          }
        });
    },
    eliminarNota(nota, index) {
      const confirmacion = confirm(`Eliminar anuncio ${nota.anuncio}`);
      if (confirmacion) {
        axios
          .delete(`/destroya/${nota.id}`)
          .then(() => {
            this.notas.splice(index, 1);
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location.href = "login";
            }
          });
      }
    },
    cancelarEdicion() {
      this.modoEditar = false;
      this.nota = { anuncio: "" };
    },
  },
};
</script>