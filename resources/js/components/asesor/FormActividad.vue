<template>
  <div>
    <div class="dropdown">
      <button
        id="dLabel"
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="dropmenu()"
        class="page-title"
      >Crear curso</button>
      <div class="dropdown-menu">
        <form class="px-4 py-3" @submit="checkForm">
          <div class="form-group">
            <label for="exampleDropdownFormEmail1">Nombre del curso</label>
            <input
              type="email"
              class="form-control"
              id="exampleDropdownFormEmail1"
              placeholder="email@example.com"
            />
          </div>
          <div class="form-group">
            <label for="exampleDropdownFormPassword1">Descripción o mensage</label>
            <input
              type="password"
              class="form-control"
              id="exampleDropdownFormPassword1"
              placeholder="Password"
            />
          </div>
          <div class="form-group">
            <label>Imagen del curso</label>
            <input type="file" id="File" ref="file" v-on:change="onChangeFileUpload()" />
            <img id="preview" alt="Imagen curso" width="100" height="100" :src="previewimg" />
          </div>
          <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      previewimg: "../resources/welcome1.jpg",
      name: "name",
      description: "description",
      file: ""
    };
  },
  methods: {
    crearactividad() {
      // Close the menu and (by passing true) return focus to the toggle button
      this.$refs.dropdown.hide(true);
    },
    dropmenu() {
      $(".dropdown-toggle").dropdown();
    },
    onChangeFileUpload() {
      this.file = this.$refs.file.files[0];
      this.previewimg = window.URL.createObjectURL(this.$refs.file.files[0]);
    },
    checkForm: function(e) {
      e.preventDefault();

      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("name", this.name);
      formData.append("description", this.description);
      axios
        .post("/storeac", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
