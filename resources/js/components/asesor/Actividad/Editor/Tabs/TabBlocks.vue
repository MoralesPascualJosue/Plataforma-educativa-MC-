<template>
  <div class="tab-pane-blocks">
    <div class="tab-pane-blocks-row">
      <div class="tab-pane-blocks-row-layout">
        <div class="tab-pane-blocks-row-section">
          <div class="tab-pane-blocks-row-section-tittle">Bloques</div>
          <div class="tab-pane-blocks-row-section-block-container">
            <drag key="block100" class="drag" :data="rowa" :type="typeof rowa">
              <div class="tab-pane-blockk-row-section-block-layout">
                <div class="tab-pane-blocks-row-section-block">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
              </div>
            </drag>
          </div>
          <div class="tab-pane-blocks-row-section-block-container">
            <drag key="block5050" class="drag" :data="rowb" :type="typeof rowb">
              <div class="tab-pane-blockk-row-section-block-layout">
                <div class="tab-pane-blocks-row-section-block-column">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
                <div class="tab-pane-blocks-row-section-block-column">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
              </div>
            </drag>
          </div>
          <div class="tab-pane-blocks-row-section-block-container">
            <drag
              key="block333333"
              class="drag"
              :data="rowc"
              :type="typeof rowc"
            >
              <div class="tab-pane-blockk-row-section-block-layout">
                <div class="tab-pane-blocks-row-section-block-column-a">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
                <div class="tab-pane-blocks-row-section-block-column-a">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
                <div class="tab-pane-blocks-row-section-block-column-a">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
              </div>
            </drag>
          </div>
          <div class="tab-pane-blocks-row-section-block-container">
            <drag key="block3366" class="drag" :data="rowd" :type="typeof rowd">
              <div class="tab-pane-blockk-row-section-block-layout">
                <div class="tab-pane-blocks-row-section-block-column-a">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
                <div class="tab-pane-blocks-row-section-block-column-b">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
              </div>
            </drag>
          </div>
          <div class="tab-pane-blocks-row-section-block-container">
            <drag key="block6633" class="drag" :data="rowe" :type="typeof rowe">
              <div class="tab-pane-blockk-row-section-block-layout">
                <div class="tab-pane-blocks-row-section-block-column-b">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
                <div class="tab-pane-blocks-row-section-block-column-a">
                  <div class="tab-pane-blocks-row-section-block-content"></div>
                </div>
              </div>
            </drag>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Drag } from "vue-easy-dnd";
export default {
  components: {
    Drag,
  },
  data() {
    return {
      rowa: {
        use: "row",
        rowpos: -1,
        columns: [
          {
            column: 0,
            type: "Vacio",
            width: "activitieeditor-column-100",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 100",
            },
          },
        ],
      },
      rowb: {
        use: "row",
        rowpos: -1,
        columns: [
          {
            column: 0,
            type: "Vacio",
            width: "activitieeditor-column-50",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 50",
            },
          },
          {
            column: 1,
            type: "Vacio",
            width: "activitieeditor-column-50",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 50",
            },
          },
        ],
      },
      rowc: {
        use: "row",
        rowpos: -1,
        columns: [
          {
            column: 0,
            type: "Vacio",
            width: "activitieeditor-column-33",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 33",
            },
          },
          {
            column: 1,
            type: "Vacio",
            width: "activitieeditor-column-33",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 33",
            },
          },
          {
            column: 2,
            type: "Vacio",
            width: "activitieeditor-column-33",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 33",
            },
          },
        ],
      },
      rowd: {
        use: "row",
        rowpos: -1,
        columns: [
          {
            column: 0,
            type: "Vacio",
            width: "activitieeditor-column-33",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 33",
            },
          },
          {
            column: 1,
            type: "Vacio",
            width: "activitieeditor-column-66",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 66",
            },
          },
        ],
      },
      rowe: {
        use: "row",
        rowpos: -1,
        columns: [
          {
            column: 0,
            type: "Vacio",
            width: "activitieeditor-column-66",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 66",
            },
          },
          {
            column: 1,
            type: "Vacio",
            width: "activitieeditor-column-33",
            propsContainer: {
              props: {
                fontSize: "22px",
                fontWeight: "normal",
                lineHeight: "140%",
              },
              value: "vacio 33",
            },
          },
        ],
      },
    };
  },
};
</script>

<style>
.tab-pane-blocks {
  height: 100%;
  display: block;
}
.tab-pane-blocks-row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
  height: 100%;
}
.tab-pane-blocks-row-layout {
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  flex: 0 0 100%;
  max-width: 100%;
  height: 100%;
}
.tab-pane-blocks-row-section-tittle {
  font-size: 12px;
  color: rgb(143, 150, 153);
  height: 24px;
  line-height: 24px;
  padding: 0px 20px;
  margin-top: 15px;
  margin-bottom: 5px;
  display: flex;
}
.tab-pane-blocks-row-section-container {
  position: relative;
}
.tab-pane-blockk-row-section-block-layout {
  margin: 0px 20px 8px;
  display: flex;
  opacity: 0.8;
  cursor: -webkit-grab;
}
.tab-pane-blockk-row-section-block-layout:hover {
  opacity: 1;
  box-shadow: rgb(0 0 0 / 35%) 0px 1px 5px;
}
.tab-pane-blocks-row-section-block {
  position: relative;
  width: 100%;
  flex: 0 0 100%;
  max-width: 100%;
  background-color: rgb(238, 238, 238);
  height: 50px;
  padding: 0px;
}
.tab-pane-blocks-row-section-block::after {
  content: " ";
  z-index: 100;
  position: absolute;
  inset: 1px;
  outline: rgb(204, 204, 204) solid 2px;
}
.tab-pane-blocks-row-section-block-column {
  position: relative;
  width: 100%;
  flex: 0 0 50%;
  max-width: 50%;
  background-color: rgb(238, 238, 238);
  height: 50px;
  padding: 0px;
}
.tab-pane-blocks-row-section-block-column-a {
  position: relative;
  width: 100%;
  flex: 0 0 33.33333%;
  max-width: 33.33333%;
  background-color: rgb(238, 238, 238);
  height: 50px;
  padding: 0px;
}
.tab-pane-blocks-row-section-block-column-b {
  position: relative;
  width: 100%;
  flex: 0 0 66.66667%;
  max-width: 66.66667%;
  background-color: rgb(238, 238, 238);
  height: 50px;
  padding: 0px;
}
.tab-pane-blocks-row-section-block-column::after,
.tab-pane-blocks-row-section-block-column-a::after,
.tab-pane-blocks-row-section-block-column-b::after {
  content: " ";
  z-index: 100;
  position: absolute;
  inset: 1px;
  outline: rgb(204, 204, 204) solid 2px;
}

.tab-pane-blocks-row-section-block-content {
  height: 100%;
}
</style>