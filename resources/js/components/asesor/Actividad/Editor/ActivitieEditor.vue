<template>
  <div class="activitieeditor-container">
    <div class="activitieeditor-tools">
      <div>Herramientas</div>
      <div>Page Editor</div>
      <p v-on:click="saveDesign">Guardar contenido</p>
      <p></p>
    </div>
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
                <drop
                  class="addcontentinto"
                  :class="{
                    addcontentintovacio: rows.length == 0,
                  }"
                  @drop="addContenttobegin"
                  accepts-type="object"
                  :accepts-data="(element) => element.use === 'row'"
                >
                  <div>Agregar aquí</div>
                </drop>
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
                      v-on:addContenttab="addContent"
                      v-on:updatecolumncontent="updaterowcolumn"
                      v-on:onselectedblock="onselectedblock"
                      v-on:onselectedblockrepeat="onselectedblockrepeat"
                      v-on:onremoverow="onremoverow"
                    />
                    <drop
                      :indexrow="indexrow"
                      class="addcontentinto"
                      @drop="addContenttointo"
                      accepts-type="object"
                      :accepts-data="(element) => element.use === 'row'"
                    >
                      <div>Agregar aquí</div>
                    </drop>
                  </div>
                </transition-group>
              </div>
            </div>
          </div>
        </div>
        <div
          class="activitieeditor-toolsmenu"
          :class="{
            'activitieeditor-toolsmenu-active': statusMenu,
          }"
        >
          <div class="activitieeditor-toolsmenu-pane">
            <ul class="activitieeditor-toolsmenu-pane-navtabs">
              <li
                class="activitieeditor-toolsmenu-pane-navtabs-item"
                :class="{
                  'activitieeditor-toolsmenu-pane-navtabs-item-active':
                    showblock == 'tabcontenido' && !statusMenu,
                }"
              >
                <a role="button" v-on:click="changemenu('tabcontenido')"
                  ><span
                    class="
                      activitieeditor-toolsmenu-pane-navtabs-item-icon
                      icon-contenido
                    "
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 33 32"
                    >
                      <g transform="translate(-297 -281)">
                        <g class="a" transform="translate(297 281)">
                          <rect class="f" width="33" height="32" rx="4" />
                          <rect
                            class="g"
                            x="0.5"
                            y="0.5"
                            width="32"
                            height="31"
                            rx="3.5"
                          />
                        </g>
                        <line
                          class="b"
                          x2="9"
                          transform="translate(304.5 283.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.478H6"
                          transform="translate(305.978 283.5) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(313.5 283.5)"
                        />
                        <path
                          class="c"
                          d="M14,0"
                          transform="translate(301.5 294.5)"
                        />
                        <line
                          class="b"
                          x2="9"
                          transform="translate(304.5 289.5)"
                        />
                        <path
                          class="c"
                          d="M12,0"
                          transform="translate(301.5 306.5)"
                        />
                        <line
                          class="b"
                          x2="8"
                          transform="translate(315.5 292.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.46H5"
                          transform="translate(316.978 292.5) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="5"
                          transform="translate(323.5 292.5)"
                        />
                        <path
                          class="b"
                          d="M9.135,0H17"
                          transform="translate(306.497 297.5)"
                        />
                        <line
                          class="b"
                          x2="9"
                          transform="translate(304.5 300.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.46H5.842"
                          transform="translate(305.978 300.658) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(313.5 300.5)"
                        />
                        <line
                          class="b"
                          x2="9"
                          transform="translate(304.5 306.5)"
                        />
                        <line
                          class="b"
                          x2="6"
                          transform="translate(316.5 283.5)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(319.5 283.5)"
                        />
                        <line
                          class="b"
                          x2="9"
                          transform="translate(304.5 292.5)"
                        />
                        <line
                          class="b"
                          y2="5"
                          transform="translate(304.5 292.5)"
                        />
                        <line
                          class="b"
                          x2="9"
                          transform="translate(304.5 297.5)"
                        />
                        <line
                          class="b"
                          y1="5"
                          transform="translate(313.5 292.5)"
                        />
                        <g class="ab" transform="translate(306 293.5)">
                          <circle class="f" cx="1" cy="1" r="1" />
                          <circle class="g" cx="1" cy="1" r="0.5" />
                        </g>
                        <line
                          class="d"
                          x2="9"
                          transform="translate(304.5 296.5)"
                        />
                        <line
                          class="b"
                          x2="8"
                          transform="translate(315.5 300.5)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(315.5 300.5)"
                        />
                        <path
                          class="b"
                          d="M0,0H8"
                          transform="translate(315.5 306.5)"
                        />
                        <line
                          class="b"
                          y1="6"
                          transform="translate(323.5 300.5)"
                        />
                        <line
                          class="b"
                          y2="4"
                          transform="translate(318.5 301.5)"
                        />
                        <line
                          class="e"
                          x2="3"
                          y2="2"
                          transform="translate(318.5 301.5)"
                        />
                        <line
                          class="b"
                          y1="2"
                          x2="3"
                          transform="translate(318.5 303.5)"
                        />
                      </g></svg></span
                  ><span
                    class="activitieeditor-toolsmenu-pane-navtabs-item-name"
                    >Recurso</span
                  ></a
                >
              </li>
              <li
                class="activitieeditor-toolsmenu-pane-navtabs-item"
                :class="{
                  'activitieeditor-toolsmenu-pane-navtabs-item-active':
                    showblock == 'tabblocks' && !statusMenu,
                }"
              >
                <a role="button" v-on:click="changemenu('tabblocks')"
                  ><span
                    class="activitieeditor-toolsmenu-pane-navtabs-item-icon"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 33 32"
                    >
                      <g transform="translate(-244 -281)">
                        <g class="a" transform="translate(244 281)">
                          <rect class="c" width="33" height="32" rx="4" />
                          <rect
                            class="d"
                            x="0.5"
                            y="0.5"
                            width="32"
                            height="31"
                            rx="3.5"
                          />
                        </g>
                        <line
                          class="b"
                          x2="19"
                          transform="translate(251.5 283.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.46H5.363"
                          transform="translate(253.978 284.137) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(269.5 283.5)"
                        />
                        <path
                          class="b"
                          d="M14,0"
                          transform="translate(248.5 294.5)"
                        />
                        <line
                          class="b"
                          x2="19"
                          transform="translate(251.5 288.5)"
                        />
                        <path
                          class="b"
                          d="M12,0"
                          transform="translate(248.5 306.5)"
                        />
                        <line
                          class="b"
                          x2="19"
                          transform="translate(251.5 291.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.46H5.363"
                          transform="translate(253.978 292.137) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(269.5 291.5)"
                        />
                        <line
                          class="b"
                          x2="19"
                          transform="translate(251.5 296.5)"
                        />
                        <line
                          class="b"
                          x2="19"
                          transform="translate(251.5 299.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.46H5.363"
                          transform="translate(253.978 300.137) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="6"
                          transform="translate(269.5 299.5)"
                        />
                        <line
                          class="b"
                          x2="19"
                          transform="translate(251.5 304.5)"
                        />
                        <line
                          class="b"
                          y2="5"
                          transform="translate(258.5 299.5)"
                        />
                        <line
                          class="b"
                          y2="4"
                          transform="translate(262.5 292.5)"
                        />
                      </g></svg></span
                  ><span
                    class="activitieeditor-toolsmenu-pane-navtabs-item-name"
                    >Bloques</span
                  ></a
                >
              </li>
              <li
                class="activitieeditor-toolsmenu-pane-navtabs-item"
                :class="{
                  'activitieeditor-toolsmenu-pane-navtabs-item-active':
                    showblock == 'tabpage' && !statusMenu,
                }"
              >
                <a role="button" v-on:click="changemenu('tabpage')"
                  ><span
                    class="activitieeditor-toolsmenu-pane-navtabs-item-icon"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 33 32"
                    >
                      <g transform="translate(-191 -229)">
                        <g class="a" transform="translate(191 229)">
                          <rect class="e" width="33" height="32" rx="4" />
                          <rect
                            class="f"
                            x="0.5"
                            y="0.5"
                            width="32"
                            height="31"
                            rx="3.5"
                          />
                        </g>
                        <line
                          class="b"
                          x2="19"
                          transform="translate(198.5 231.5)"
                        />
                        <path
                          class="b"
                          d="M0,1.46H20.363"
                          transform="translate(200.978 232.137) rotate(90)"
                        />
                        <line
                          class="b"
                          y2="21"
                          transform="translate(216.5 231.5)"
                        />
                        <path
                          class="b"
                          d="M14,0"
                          transform="translate(195.5 242.5)"
                        />
                        <line
                          class="b"
                          x2="19"
                          transform="translate(198.5 252.5)"
                        />
                        <path
                          class="b"
                          d="M12,0"
                          transform="translate(195.5 254.5)"
                        />
                        <line
                          class="c"
                          x2="21"
                          transform="translate(197.5 254.5)"
                        />
                        <line
                          class="d"
                          y2="2"
                          transform="translate(197.5 253.5)"
                        />
                        <line
                          class="d"
                          y2="2"
                          transform="translate(218.5 253.5)"
                        />
                      </g></svg></span
                  ><span
                    class="activitieeditor-toolsmenu-pane-navtabs-item-name"
                    >Página</span
                  ></a
                >
              </li>
            </ul>
            <div class="activitieeditor-toolsmenu-pane-contenttabs">
              <div class="activitieeditor-toolsmenu-pane-contenttabs-pane">
                <transition name="tab-fade" mode="out-in">
                  <Tabpage
                    :propsPage="propsPage"
                    v-on:statuspage-change="statuspagechange"
                    v-if="showblock == 'tabpage'"
                  />
                  <Tabblocks v-if="showblock == 'tabblocks'" />
                  <Tabcontenido v-if="showblock == 'tabcontenido'" />
                </transition>
              </div>
            </div>
            <div class="activitieeditor-toolsmenu-pane-tooltipped">
              <a
                class="
                  activitieeditor-toolsmenu-pane-tooltipped-colapse-tools-button
                "
                v-on:click="cerrarmenu"
                >></a
              >
            </div>
          </div>
          <div
            class="activitieeditor-toolsmenu-pane-toolsblock"
            :class="{
              'activitieeditor-toolsmenu-pane-toolsblock-active':
                statusMenutools,
            }"
          >
            <Tabtools
              :selectedblock="selectedBlock"
              v-on:cerrarmenutools="cerrarmenutools"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Drop } from "vue-easy-dnd";
import Tabpage from "./Tabs/TabPage";
import Tabblocks from "./Tabs/TabBlocks";
import Tabcontenido from "./Tabs/TabContenido";
import Tabtools from "./Tabs/TabTools.vue";
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
    Drop,
    Tabpage,
    Tabblocks,
    Tabcontenido,
    Tabtools,
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
      selectedBlock: {
        block: {
          type: "Vacio",
        },
      },
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
    actividad() {
      return this.$store.getters["activities/actividadview"];
    },
  },
  methods: {
    saveDesign() {
      let update = this.actividad.activitie.id; //id actividad
      this.statussave = true;
      axios
        .put("../updateat/" + update, {
          contenido: {
            propsPage: JSON.parse(JSON.stringify(this.propsPage)),
            rows: JSON.parse(JSON.stringify(this.rows)),
          },
        })
        .then(function (data) {
          flash("Contenido guardado", "success");
        })
        .catch(function (data) {
          if (data.status == 401 || 419) {
            window.location.href = "login";
          }
          flash(
            "Fallo el guardado del contenido: intentalo mas tarde.",
            "error"
          );
        })
        .finally(() => {
          this.statussave = false;
        });
    },
    cerrarmenu() {
      this.statusMenutools = true;
      this.statusMenu = !this.statusMenu;
      if (this.isSelectedBlock) {
        this.selectedBlock.selection.isSelected = false;
        this.isSelectedBlock = false;
      }
    },
    cerrarmenutools() {
      this.statusMenutools = true;
      this.selectedBlock.selection.isSelected = false;
      this.isSelectedBlock = false;
    },
    statuspagechange(status) {
      let statusPage = Object.assign(this.propsPage, status);
      this.propsPage = statusPage;
    },
    changemenu(menu) {
      this.showblock = menu;
      this.statusMenu = false;
    },
    addContent() {
      this.showblock = "tabcontenido";
      this.statusMenu = false;
      this.statusMenutools = true;
    },
    addContenttobegin(rowadd) {
      let columnsnew = JSON.parse(JSON.stringify(rowadd.data.columns));
      let newrow = { rowpos: 0, columns: columnsnew };
      this.rows.splice(0, 0, newrow);
    },
    addContenttointo(rowadd) {
      let columnsnew = JSON.parse(JSON.stringify(rowadd.data.columns));
      let indexrow = rowadd.top.$attrs.indexrow + 1;
      let newrow = { rowpos: indexrow, columns: columnsnew };
      this.rows.splice(indexrow, 0, newrow);
    },
    updaterowcolumn(newcolumn) {
      this.rows[newcolumn.rowindex].columns.splice(
        newcolumn.columnindex,
        1,
        newcolumn
      );
    },
    onselectedblock(block) {
      if (this.isSelectedBlock) {
        this.selectedBlock.selection.isSelected = false;
      }
      this.isSelectedBlock = true;
      this.selectedBlock = block;
      this.statusMenu = false;
      this.statusMenutools = false;
    },
    onselectedblockrepeat(block) {
      this.selectedBlock.selection.isSelected = false;
      this.isSelectedBlock = false;
      this.statusMenutools = true;
    },
    onremoverow(rowindex) {
      if (confirm("Eliminar fila")) {
        this.rows.splice(rowindex, 1);

        if (this.selectedBlock.block.rowindex == rowindex) {
          this.selectedBlock.selection.isSelected = false;
          this.statusMenutools = true;
          this.isSelectedBlock = false;
        }
      }
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
  height: 93%;
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
  padding: 20px 30px;
  height: 100%;
  position: absolute;
  inset: 0px 425px 0px 0px;
  background-color: rgb(255, 255, 255);
  background-image: linear-gradient(
      45deg,
      rgb(247, 247, 247) 25%,
      transparent 25%
    ),
    linear-gradient(-45deg, rgb(247, 247, 247) 25%, transparent 25%),
    linear-gradient(45deg, transparent 75%, rgb(247, 247, 247) 75%),
    linear-gradient(-45deg, transparent 75%, rgb(247, 247, 247) 75%);
  background-size: 20px 20px;
  background-position: 0px 0px, 0px 10px, 10px -10px, -10px 0px;
  transition: right 0.3s ease 0s;
  overflow: scroll;
}
.activitieeditor-page-active {
  inset: 0px 75px 0px 0px;
}
.activitieeditor-workspace {
  display: flex;
  width: 100%;
  height: 95%;
  position: relative;
}
.activitieeditor-tools {
  display: flex;
  position: sticky;
  top: 0;
  background-color: #efefef;
  justify-content: space-evenly;
}
.activitieeditor-tools p {
  padding: 0.5rem;
  cursor: pointer;
}
.activitieeditor-tools div {
  padding: 0.5rem;
}
.activitieeditor-tools p:hover {
  background: #fcd770;
}
.activitieeditor-container {
  min-height: 87%;
  height: 87%;
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