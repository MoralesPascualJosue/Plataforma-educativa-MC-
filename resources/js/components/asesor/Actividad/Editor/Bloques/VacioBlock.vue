<template>
  <div class="activitieeditor-vacio-container">
    <div class="activitieeditor-vacio-container-layout">
      <div class="activitieeditor-vacio-content">
        <div class="activitieeditor-vacio-content-body">
          <div>Sin contenido.</div>
          <div
            class="activitieeditor-vacio-content-body-button"
            v-on:click="opencontentpage"
          >
            <a role="button">Agregar</a>
          </div>
        </div>
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
            fontSize: "14px",
            lineHeight: "140%",
            color: "#000000",
            textAlign: "left",
          },
          value: "i´m a text default",
        };
      },
    },
  },
  data() {
    return {
      type: "Vacion",
      propsContainer: this.propsContainerd,
    };
  },
  methods: {
    opencontentpage() {
      this.$emit("addContenttab");
    },
  },
};
</script>

<style>
.activitieeditor-vacio-content-body {
  background-color: rgba(222, 242, 250, 0.85);
  outline: #2faade dashed 1px;
  min-height: 100px;
  font-size: 13px;
  color: #2faade;
  padding: 20px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  flex-direction: column;
}
.activitieeditor-vacio-content-body-button a {
  display: inline-block;
  padding: 5px 10px;
  margin-top: 10px;
  cursor: pointer;
  background-color: rgb(47, 170, 222);
  color: rgb(255, 255, 255);
  text-decoration: none;
}
.activitieeditor-vacio-content-body-button a:hover {
  background-color: rgb(47, 106, 131);
}
</style>