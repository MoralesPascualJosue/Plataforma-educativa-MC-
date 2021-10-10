<template>
  <div class="activitieeditor-image-container">
    <div class="activitieeditor-image-container-layout">
      <div
        class="activitieeditor-image-content"
        :style="{
          fontSize: propsContainer.props.fontSize,
          textAlign: propsContainer.props.textAlign,
        }"
      >
        <div class="activitieeditor-archivos-header">
          <p>Archivos disponibles</p>
        </div>

        <ul class="activitieeditor-archivos-body">
          <li
            v-for="(archivo, itemablock) in archivos"
            :key="archivo.name + itemablock"
            :style="{
              borderTopColor: propsContainer.props.backgroundColor,
            }"
          >
            <div
              class="activitieeditor-archivos-body-icon"
              :style="{
                backgroundColor: propsContainer.props.backgroundColor,
              }"
            >
              <img :src="archivo.icon" alt="alt" width="100%" height="100%" />
            </div>
            <div class="name-r">
              <a
                rel="noopener noreferrer"
                target="_blank"
                :id="archivo.name"
                :href="archivo.url"
                >{{ archivo.name }}</a
              >
            </div>
            <div></div>
          </li>
          <li v-if="archivos.length == 0">
            <a type="button" class="name-r">Sin archivos disponibles.</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propsContainerd: {
      type: Object,
      default: function () {
        return {
          props: {
            fontSize: "18px",
            textAlign: "center",
            backgroundColor: "#2faade",
          },
          archivos: [
            {
              icon: "../resources/icons/work.svg",
              url: "/resources/icons/imagen-vacio.svg",
              name: "imagen-vacio.svg",
              type: "svg",
            },
          ],
        };
      },
    },
  },
  computed: {
    archivos() {
      return this.propsContainerd.archivos;
    },
  },
  data() {
    return {
      type: "archivo",
      propsContainer: this.propsContainerd,
    };
  },
};
</script>

<style>
.activitieeditor-archivos-body {
  border: 1px solid gray;
  padding: 10px;
}
.activitieeditor-archivos-body li {
  background: white;
  list-style: none;
  width: 100%;
  display: inline-flex;
  border-top: 25px solid orange;
  margin-top: 10px;
}
.activitieeditor-archivos-body-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: orange;
  margin-left: 10%;
  margin-top: -25px;
  display: inline-block;
  margin-right: 0.5rem;
}
.activitieeditor-archivos-header {
  width: 100%;
}
.activitieeditor-archivos-header p {
  background-color: #2faade;
  color: white;
  font-weight: 600;
  font-size: 15px;
  display: inline-block;
  width: 11rem;
  padding-right: 0.5rem;
  padding-left: 0.5rem;
}

.name-r a {
  border-radius: 8px;
  padding: 0.5rem;
}
.name-r a:hover {
  background-color: #c5c5c578;
}
</style>