<template>
  <div class="activitieeditor-container">
    <div class="activitieeditor-workspace">
      <div>
        <div
          class="activitieeditor-page"
          :class="{
            'activitieeditor-page-active': statusMenu,
          }"
        >
          <div class="activitieeditor-page-container">
            <div
              class="activitieeditor-page-body"
              :style="{
                backgroundColor: propsPage.backgroundColor,
                color: propsPage.textColor,
              }"
            >
              <div
                class="activitieeditor-page-body-layout"
                :class="{
                  'activitieeditor-page-body-layout-left': alignPage,
                }"
                :style="{ width: propsPage.widthPage + 'px' }"
              >
                <transition-group
                  name="list-complete-row"
                  tag="div"
                  mode="out-in"
                >
                  <div
                    v-for="(row, indexrow) in rows"
                    :key="indexrow + 'rowcontent'"
                    class="list-complete-row-item"
                  >
                    <row
                      :key="indexrow + 'row'"
                      :rowindex="indexrow"
                      :propsColumns="row"
                    />
                  </div>
                </transition-group>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Row from "./Rows/Row.vue";

export default {
  props: {
    contenidoinicial: {
      type: Object,
      default() {
        return {
          propsPage: {
            textColor: "#f0f0f0",
            backgroundColor: "#f2f2f2",
            widthPage: 600,
            alignPage: "center",
          },
          rows: [],
        };
      },
    },
  },
  components: {
    Row,
  },
  data() {
    return {
      minHeight: "800px",
      showblock: "tabpage",
      statusMenu: true,
      statusMenutools: true,
      propsPage: this.contenidoinicial.propsPage,
      rowsPage: 0,
      rows: this.contenidoinicial.rows,
      isSelectedBlock: false,
      statussave: false,
    };
  },
  computed: {
    alignPage() {
      return this.propsPage.alignPage != "center";
    },
    widthPage() {
      return this.propsPage.widthPage;
    },
  },
};
</script>

<style>
.tab-fade-enter-active {
  transition: all 0.2s;
}
.tab-fade-enter {
  transform: translateY(-30px);
}
.tab-fade-leave-active {
  transition: opacity 0.1s;
}
.tab-fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.activitieeditor-page-body-row {
  display: flex;
  flex-wrap: nowrap;
  margin-left: 0;
  margin-right: 0;
}
.activitieeditor-page-body-rowcontainer {
  width: 100%;
  padding-right: 0px;
  padding-left: 0px;
  margin-right: auto;
  margin-left: auto;
}
.activitieeditor-page-body-layout {
  margin: 0px auto;
}
.activitieeditor-page-body-layout-left {
  margin: 0px auto 0px 0px;
}
.activitieeditor-page-body {
  min-height: calc(100vh - 40px) !important;
  background-color: rgb(232, 212, 187);
  font-family: Montserrat, sans-serif;
  color: rgb(0, 0, 0);
  padding-top: 0.5rem;
}
.activitieeditor-toolsmenu-pane-tooltipped-colapse-tools-button:hover {
  opacity: 1;
}
.activitieeditor-toolsmenu-pane-tooltipped-colapse-tools-button {
  position: absolute;
  top: calc(50% - 37px);
  right: auto;
  left: -20px;
  width: 20px;
  padding: 0px 0px 0px 5px;
  height: 75px;
  background-color: rgb(73, 80, 87);
  text-align: center;
  font-size: 14px;
  border-width: 1px 0px 1px 1px;
  border-style: solid;
  border-color: rgb(73, 80, 87);
  border-image: initial;
  border-radius: 15px 0px 0px 15px;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  cursor: pointer;
  opacity: 0.5;
  color: rgb(214, 217, 220) !important;
  text-decoration: none;
}
.activitieeditor-toolsmenu-pane-tooltipped {
  display: inline;
}
.activitieeditor-toolsmenu-pane-contenttabs-header {
  background-color: rgb(255, 255, 255);
  border-bottom: 1px solid rgb(238, 238, 238);
  box-shadow: rgb(0 0 0 / 5%) 0px 1px 1px;
  padding-left: 15px;
}
.activitieeditor-toolsmenu-pane-contenttabs-header-layout {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
.activitieeditor-toolsmenu-pane-contenttabs-header-tittle {
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  flex: 0 0 33.33333%;
  max-width: 33.33333%;
  font-size: 12px;
  font-weight: 600;
  line-height: 45px;
  text-transform: uppercase;
  color: rgb(80, 86, 89);
}
.activitieeditor-toolsmenu-pane-contenttabs-header-options {
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  flex: 0 0 66.66667%;
  max-width: 66.66667%;
  text-align: right !important;
}
.activitieeditor-toolsmenu-pane-contenttabs-header-options div {
  display: inline;
}
.activitieeditor-toolsmenu-pane-contenttabs-header-options div button {
  background-color: transparent;
  font-size: 16px;
  display: inline-block;
  padding: 0px 10px;
  line-height: 45px;
  border-top: none;
  border-right: none;
  border-bottom: none;
  border-image: initial;
  border-left: 1px solid rgb(230, 230, 230);
  cursor: pointer;
  color: rgb(80, 86, 89) !important;
}
.activitieeditor-toolsmenu-pane-contenttabs-header-options div button:hover {
  background-color: rgb(80, 86, 89);
  color: rgb(255, 255, 255) !important;
}
.activitieeditor-toolsmenu-pane-contenttabs-header-options div .delete:hover {
  background-color: rgb(194, 40, 44);
}
.activitieeditor-toolsmenu-pane-contenttabs-pane {
  height: 100%;
  display: block;
  overflow: hidden;
}
.activitieeditor-toolsmenu-pane-contenttabs-pane-tools {
  width: 100%;
  height: 94.4%;
  top: 46px;
  bottom: 0px;
  right: 0px;
  overflow-y: auto;
}
.activitieeditor-toolsmenu-pane-navtabs-item-name {
  font-size: 13px;
  padding: 0px 4px;
}
.activitieeditor-toolsmenu-pane-navtabs-item-icon {
  font-size: 24px;
  line-height: 24px;
  height: 50px;
  margin-bottom: 8px;
  position: relative;
}
.activitieeditor-toolsmenu-pane-navtabs-item-active a {
  background-color: rgb(249, 249, 249);
  color: rgb(51, 51, 51);
}
.activitieeditor-toolsmenu-pane-navtabs-item a:hover {
  background-color: rgb(192, 197, 201);
  color: rgb(73, 80, 87);
}
.activitieeditor-toolsmenu-pane-navtabs-item a {
  text-decoration: none;
  padding: 0px;
  border: 0px;
  border-radius: 0px;
  overflow: hidden;
  height: 80px;
  width: 72px;
  overflow-wrap: break-word;
  text-overflow: ellipsis;
  color: rgb(73, 80, 87);
  text-align: center;
  display: flex;
  flex-direction: column;
  -webkit-box-pack: center;
  justify-content: center;
}
.activitieeditor-toolsmenu-pane-navtabs-item {
  margin-bottom: 5px;
  min-width: 100%;
  cursor: pointer;
}
.activitieeditor-toolsmenu-pane-contenttabs {
  display: block;
  box-sizing: border-box;
  flex: 1 1 0%;
  background-color: rgb(249, 249, 249);
  overflow: hidden auto;
  height: calc(100% - 50px);
}
.activitieeditor-toolsmenu-pane-navtabs {
  box-sizing: border-box;
  margin-top: 0;
  flex-wrap: wrap;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
  flex-direction: column !important;
  display: block;
  flex-shrink: 0;
  width: 72px;
  height: 100%;
  overflow: hidden auto;
  user-select: none;
  border-bottom: 0px !important;
}
.activitieeditor-toolsmenu-pane {
  position: absolute;
  top: 0px;
  width: 100%;
  z-index: 5;
  min-height: 100%;
  height: 100%;
  display: flex;
  background-color: rgb(214, 217, 220);
  flex-direction: row-reverse;
}
.activitieeditor-toolsmenu-pane-toolsblock {
  position: absolute;
  top: 0px;
  width: 100%;
  z-index: 5;
  min-height: 100%;
  height: 100%;
  display: flex;
  background-color: rgb(214, 217, 220);
  right: 0;
  transition: width 0.3s ease 0s;
}
.activitieeditor-toolsmenu-pane-toolsblock-active {
  width: 0px;
}
.activitieeditor-toolsmenu-active {
  width: 75px;
}
.activitieeditor-toolsmenu {
  position: absolute;
  inset: 0px 0px 0px auto;
  width: 425px;
  background-color: rgb(214, 217, 220);
  border-left: 1px solid rgb(214, 217, 220);
  border-right: 0px;
  z-index: 105;
  transition: width 0.3s ease 0s;
}
.activitieeditor-toolsmenu-active {
  width: 75px;
}
.activitieeditor-page {
  height: 100%;
  position: absolute;
}
.activitieeditor-page-active {
  inset: 0px 0px 0px 0px;
}
.activitieeditor-workspace {
  display: flex;
  width: 100%;
  height: 100%;
  position: relative;
}
.activitieeditor-tools {
  display: flex;
  position: sticky;
  top: 0;
  background-color: #efefef;
  padding: 0.5rem;
  justify-content: space-evenly;
}
.activitieeditor-container {
  min-height: 100%;
  height: 100%;
  width: 100%;
  border: 0px;
}

.a {
  fill: #fff;
}
.a,
.b,
.c,
.d {
  stroke: #707070;
}
.b,
.c,
.d,
.f {
  fill: none;
}
.b {
  stroke-width: 2px;
}
.c {
  stroke-dasharray: 1 1;
}
.e {
  stroke: none;
}

.icon-contenido .a {
  fill: #fff;
}
.icon-contenido .a,
.icon-contenido .ab,
.icon-contenido .b,
.icon-contenido .c,
.icon-contenido .d,
.icon-contenido .e {
  stroke: #707070;
  stroke-width: 1.5px;
}
.icon-contenido .b,
.icon-contenido .c,
.icon-contenido .d,
.icon-contenido .e,
.icon-contenido .g {
  stroke-width: 1.5px;
  fill: none;
}
.icon-contenido .b {
  stroke-linecap: round;
}
.icon-contenido .c {
  stroke-width: 2px;
}
.icon-contenido .d {
  stroke-width: 0.5px;
}
.icon-contenido .f {
  stroke: none;
}

.list-complete-row-enter-active,
.list-complete-row-leave-active {
  transition: opacity 0.3s ease;
}
.list-complete-row-enter, .list-complete-row-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.addcontentinto {
  opacity: 0;
  color: #707070;
  text-align: center;
  font-weight: 700;
  font-size: small;
  position: relative;
  border: 2px dashed rgb(47, 170, 222);
  text-align: right;
}
.addcontentinto div {
  position: absolute;
  width: 100%;
  height: 2px;
  color: black;
}

.addcontentintovacio {
  opacity: 1;
  min-height: 100px;
  font-size: x-large;
  line-height: 100px;
  text-align: center;
}
.addcontentintovacio div {
  right: inherit;
  position: relative;
  width: 100%;
  padding: 0.2rem;
  border-radius: 4px;
  background-color: #2faade38;
  height: inherit;
}

.drop-allowed {
  background-color: rgba(0, 255, 0, 0.2);
}
.addcontentinto.drop-allowed div {
  padding: 0.4rem;
  height: inherit;
}
.drop-forbidden {
  background-color: rgba(255, 0, 0, 0.2);
}
.drop-allowed.drop-in {
  opacity: 1;
}

.activitieeditor-toolsmenu-pane-toolsblock
  .activitieeditor-toolsmenu-pane-contenttabs-pane-tools {
  display: inherit;
  padding: 0 !important;
  overflow-x: hidden;
}

.isselecteditem {
  box-shadow: 0px -5px 0px -0.1rem #2faade, 0px 5px 0px -0.1rem #2faade;
}

@media only screen and (max-width: 1050px) {
  .activitieeditor-page {
    padding: 0 !important;
    inset: 0 0 0 0 !important;
    overflow: inherit !important;
  }
  .activitieeditor-toolsmenu {
    display: none !important;
  }
  .activitieeditor-page-body-layout {
    width: 100% !important;
  }
  .activitieeditor-page-body-row {
    display: inherit !important;
  }
  .activitieeditor-page-body-row div {
    width: 100% !important;
  }
}
</style>