<template>
  <div class="activitieeditor-page-body-rowcontainer">
    <div class="activitieeditor-page-body-row">
      <column
        v-for="(column, index) in columns"
        :key="index + 'column' + rowindex"
        :class="column.width"
        :columnindex="index"
        :propsColumn="column"
      />
    </div>
  </div>
</template>

<script>
import Column from "./Column";
export default {
  components: {
    Column,
  },
  props: {
    rowindex: {
      type: Number,
      default: 0,
    },
    propsColumns: {
      type: Object,
      default: function () {
        return {
          rowpos: 0,
          columns: [
            {
              column: 0,
              type: "Vacio",
              width: "activitieeditor-column-100",
              propsContainer: {
                props: {
                  color: "#a2a2a2",
                  fontSize: "22px",
                  fontWeight: "normal",
                  lineHeight: "140%",
                  textAlign: "left",
                },
                value: "¡Contenido no encontrado fila!",
              },
            },
          ],
        };
      },
    },
  },
  computed: {
    columns() {
      return this.propsColumns.columns;
    },
  },
};
</script>

<style>
.activitieeditor-column-100 {
  width: 100%;
}
.activitieeditor-column-50 {
  width: 50%;
}
.activitieeditor-column-33 {
  width: 33.33%;
}
.activitieeditor-column-66 {
  width: 66.67%;
}
.activitieeditor-page-body-rowcontainer-tools {
  width: 100%;
  height: 0%;
  position: relative;
}
.activitieeditor-page-body-rowcontainer-tools div {
  position: absolute;
  height: 6rem;
  width: 0rem;
  inset: -1rem 0px 0rem -4.7rem;
  transition: width 0.3s ease 0s;
  overflow: hidden;
  display: flex;
  align-items: center;
}
.activitieeditor-page-body-rowcontainer-tools div a {
  position: inherit;
  padding: 0.5rem;
  background-color: #2faade;
  color: white;
  font-weight: 600;
  cursor: pointer;
}
.activitieeditor-page-body-rowcontainer-tools div a:hover {
  background-color: rgb(194, 40, 44);
}
.activitieeditor-page-body-rowcontainer:hover
  .activitieeditor-page-body-rowcontainer-tools
  div {
  width: 5rem;
}
</style>