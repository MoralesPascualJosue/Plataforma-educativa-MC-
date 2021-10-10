<template>
  <div class="tab-pane-page">
    <div class="tab-pane-page-row">
      <div class="tab-pane-page-row-layout">
        <div class="tab-pane-row-section">
          <div class="tab-pane-row-section-card">
            <h5 role="button" class="tab-pane-row-section-card-header">
              Título
            </h5>
            <div class="tab-pane-row-section-card-body">
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Grosor fuente
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <a role="button" v-on:click="updatestatusweight('300')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                          light-text
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.fontWeight == 300,
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 34"
                        >
                          <g transform="translate(-191 -331)">
                            <g class="a" transform="translate(191 333)">
                              <rect class="d" width="33" height="32" rx="4" />
                              <rect
                                class="e"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(195.5 346.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(195.5 358.5)"
                            />
                            <text class="c" transform="translate(208 353)">
                              <tspan x="-8.677" y="0">T1</tspan>
                            </text>
                          </g>
                        </svg></span
                      >
                    </a>
                    <a role="button" v-on:click="updatestatusweight('600')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                          regular-text
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.fontWeight == 600,
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 34"
                        >
                          <g transform="translate(-244 -331)">
                            <g class="a" transform="translate(244 333)">
                              <rect class="d" width="33" height="32" rx="4" />
                              <rect
                                class="e"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(248.5 346.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(248.5 358.5)"
                            />
                            <text class="c" transform="translate(261 353)">
                              <tspan x="-10.63" y="0">T1</tspan>
                            </text>
                          </g>
                        </svg></span
                      >
                    </a>
                    <a role="button" v-on:click="updatestatusweight('900')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                          bold-text
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.fontWeight == 900,
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 34"
                        >
                          <g transform="translate(-297 -331)">
                            <g class="a" transform="translate(297 333)">
                              <rect class="d" width="33" height="32" rx="4" />
                              <rect
                                class="e"
                                x="0.5"
                                y="0.5"
                                width="32"
                                height="31"
                                rx="3.5"
                              />
                            </g>
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(301.5 346.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(301.5 358.5)"
                            />
                            <text class="c" transform="translate(314 353)">
                              <tspan x="-11.611" y="0">T1</tspan>
                            </text>
                          </g>
                        </svg></span
                      >
                    </a>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Color texto
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <div
                      class="
                        tab-pane-row-section-card-body-item-content-element-border
                      "
                    >
                      <div>
                        <input
                          type="color"
                          name="textcolor"
                          v-model="prosblockcontent.props.color"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Tamaño fuente
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <div
                      class="
                        tab-pane-row-section-card-body-item-content-element-counter
                      "
                    >
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatusfontsize(false)"
                      >
                        -
                      </button>
                      <div
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-container
                        "
                      >
                        <input
                          type="text"
                          :value="prosblockcontent.props.fontSize"
                          readonly
                        />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatusfontsize(true)"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Alineación texto
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <a role="button" v-on:click="updatestatusaling('left')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'left',
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-191 -229)">
                            <g class="a" transform="translate(191 229)">
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
                              x2="14"
                              transform="translate(195.5 236.5)"
                            />
                            <path
                              class="b"
                              d="M0,0H19"
                              transform="translate(195.5 240.5)"
                            />
                            <line
                              class="b"
                              x2="19"
                              transform="translate(195.5 244.5)"
                            />
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(195.5 242.5)"
                            />
                            <line
                              class="b"
                              x2="16"
                              transform="translate(195.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="12"
                              transform="translate(195.5 248.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(195.5 254.5)"
                            />
                          </g></svg
                      ></span>
                    </a>
                    <a role="button" v-on:click="updatestatusaling('center')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'center',
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-191 -229)">
                            <g class="a" transform="translate(191 229)">
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
                              x2="14"
                              transform="translate(200.5 236.5)"
                            />
                            <path
                              class="b"
                              d="M0,0H19"
                              transform="translate(198.5 240.5)"
                            />
                            <line
                              class="b"
                              x2="17"
                              transform="translate(199.5 244.5)"
                            />
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(195.5 242.5)"
                            />
                            <line
                              class="b"
                              x2="16"
                              transform="translate(199.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="12"
                              transform="translate(201.5 248.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(195.5 254.5)"
                            />
                          </g></svg
                      ></span>
                    </a>
                    <a role="button" v-on:click="updatestatusaling('right')">
                      <span
                        class="
                          tab-pane-row-section-card-body-item-content-element-item
                        "
                        :class="{
                          isselecteditem:
                            prosblockcontent.props.textAlign == 'right',
                        }"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 33 32"
                        >
                          <g transform="translate(-297 -229)">
                            <g class="a" transform="translate(297 229)">
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
                              x2="14"
                              transform="translate(311.5 236.5)"
                            />
                            <path
                              class="b"
                              d="M0,0H19"
                              transform="translate(306.5 240.5)"
                            />
                            <line
                              class="b"
                              x2="19"
                              transform="translate(306.5 244.5)"
                            />
                            <path
                              class="b"
                              d="M14,0"
                              transform="translate(301.5 242.5)"
                            />
                            <line
                              class="b"
                              x2="16"
                              transform="translate(309.5 252.5)"
                            />
                            <line
                              class="b"
                              x2="12"
                              transform="translate(313.5 248.5)"
                            />
                            <path
                              class="b"
                              d="M12,0"
                              transform="translate(301.5 254.5)"
                            />
                          </g></svg
                      ></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="tab-pane-row-section-card-body-item">
                <div class="tab-pane-row-section-card-body-item-content">
                  <div
                    class="tab-pane-row-section-card-body-item-content-label"
                  >
                    Tamaño linea
                  </div>
                  <div
                    class="tab-pane-row-section-card-body-item-content-element"
                  >
                    <div
                      class="
                        tab-pane-row-section-card-body-item-content-element-counter
                      "
                    >
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatuslineheight(false)"
                      >
                        -
                      </button>
                      <div
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-container
                        "
                      >
                        <input
                          type="text"
                          :value="prosblockcontent.props.lineHeight"
                          readonly
                        />
                      </div>
                      <button
                        class="
                          tab-pane-row-section-card-body-item-content-element-counter-button
                        "
                        v-on:click="updatestatuslineheight(true)"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propsblock: {
      type: Object,
      default: function () {
        return {
          propsContainer: {
            props: {
              color: "#a2a2a2",
              fontSize: "22px",
              fontWeight: "normal",
              lineHeight: "140%",
              textAlign: "left",
            },
            value: "Heading default tools",
          },
        };
      },
    },
  },
  computed: {
    prosblockcontent() {
      return this.propsblock.propsContainer;
    },
    fontSizec() {
      let fontSize = this.prosblockcontent.props.fontSize.split("p");
      return fontSize[0];
    },
    lineHeightc() {
      let lineHeight = this.prosblockcontent.props.lineHeight.split("%");
      return lineHeight[0];
    },
  },
  methods: {
    updatestatusweight(status) {
      this.prosblockcontent.props.fontWeight = status;
    },
    updatestatusaling(status) {
      this.prosblockcontent.props.textAlign = status;
    },
    updatestatusfontsize(status) {
      let newsize = Number(this.fontSizec);
      if (status) {
        newsize = newsize + 1;
      } else {
        newsize = newsize - 1;
      }

      if (newsize > 8 && newsize < 50) {
        this.prosblockcontent.props.fontSize = newsize + "px";
      }
    },
    updatestatuslineheight(status) {
      let newsize = Number(this.lineHeightc);
      if (status) {
        newsize = newsize + 10;
      } else {
        newsize = newsize - 10;
      }

      if (newsize > 99 && newsize < 500) {
        this.prosblockcontent.props.lineHeight = newsize + "%";
      }
    },
  },
};
</script>

<style scope>
.tab-pane-page {
  height: 100%;
  animation: 0.25s ease 0s 1 normal none running fadedrop;
}
.tab-pane-page-row {
  height: 100%;
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
.tab-pane-page-row-layout {
  height: 100%;
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
}
@media (min-width: 576px) {
  .tab-pane-page-row-layout {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
.tab-pane-row-section-card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  margin-bottom: 0.75rem;
  border: 0px !important;
  border-radius: 0px !important;
  background-color: transparent !important;
}
.tab-pane-row-section-card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  font-weight: 600;
  font-size: 12px;
  color: rgb(81, 97, 103);
  background-color: rgb(234, 234, 234);
  cursor: pointer;
  text-transform: uppercase;
  border-bottom: 0px !important;
  flex: 0 0 83.33333%;
  position: relative;
  width: 100%;
}
.tab-pane-row-section-card-header:first-child {
  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.tab-pane-row-section-card-body {
  padding: 15px 20px !important;
  flex: 1 1 auto;
}
.tab-pane-row-section-card-body-item {
  padding: 15px 0px;
  border-bottom: 1px solid rgb(225, 228, 231);
}
.tab-pane-row-section-card-body-item:first-child {
  padding-top: 0px;
}
.tab-pane-row-section-card-body-item-content {
  display: flex;
  flex-wrap: wrap;
  height: 100%;
  justify-content: space-between;
}
.tab-pane-row-section-card-body-item-content-label {
  display: flex;
  flex-flow: row wrap;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: justify;
  justify-content: space-between;
  color: rgb(143, 150, 153);
}
.tab-pane-row-section-card-body-item-content-element {
  text-align: right !important;
  position: relative;
  padding-right: 15px;
  padding-left: 15px;
}
.tab-pane-row-section-card-body-item-content-element-border {
  padding: 2px;
  background-color: rgb(255, 255, 255);
  border-radius: 5px;
  display: inline-block;
  cursor: pointer;
  border: 1px solid rgb(204, 204, 204);
  box-shadow: rgb(239 239 239) 0px 0px 0px 2px inset !important;
}
.tab-pane-row-section-card-body-item-content-element-border input {
  border: none;
  cursor: pointer;
  text-align: right !important;
}
.tab-pane-row-section-card-body-item-content-element-border:hover {
  color: rgb(85, 85, 85);
  border: 1px solid rgb(153, 153, 153);
}
.tab-pane-row-section-card-body-item-content-element-counter {
  color: rgb(55, 58, 60);
  background-color: rgb(255, 255, 255);
  border: 1px solid rgb(222, 225, 226);
  border-radius: 4px;
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  margin-top: 3px;
  margin-bottom: 3px;
  user-select: none;
}
.tab-pane-row-section-card-body-item-content-element-counter-button {
  cursor: pointer;
  cursor: pointer;
  display: inline-block;
  height: 30px;
  width: 30px;
  text-align: center;
  line-height: 30px;
  vertical-align: middle;
  background: unset;
  box-shadow: unset;
  border: unset;
  color: inherit;
  appearance: none !important;
}
.tab-pane-row-section-card-body-item-content-element-counter-button:hover {
  color: rgb(55, 58, 60);
  background-color: rgb(249, 249, 249);
  border: 1px solid rgb(153, 153, 153);
}
.tab-pane-row-section-card-body-item-content-element-counter-container {
  position: relative;
  display: inline-block;
}
.tab-pane-row-section-card-body-item-content-element-counter-container input {
  border-width: 0px 1px;
  border-top-style: initial;
  border-bottom-style: initial;
  border-top-color: initial;
  border-bottom-color: initial;
  border-image: initial;
  border-left-style: solid;
  border-left-color: rgb(222, 225, 226);
  border-right-style: solid;
  border-right-color: rgb(222, 225, 226);
  color: rgb(127, 127, 127);
  background-color: rgb(249, 249, 249);
  display: inline-block;
  height: 30px;
  width: 40px;
  text-align: center;
  line-height: 30px;
  padding: 0px;
  vertical-align: middle;
}
.tab-pane-row-section-card-body-item-content-element-counter-container
  input[type="number"]::-webkit-inner-spin-button,
.tab-pane-row-section-card-body-item-content-element-counter-container
  input[type="number"]::-webkit-outer-spin-button {
  display: none;
}
.tab-pane-row-section-card-body-item-content-element-item {
  display: inline-block;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: 100%;
  border-radius: 3px;
  margin-left: 4px;
  text-align: center;
  cursor: pointer;
  width: 35px;
  height: 35px;
  line-height: 35px;
  font-size: 20px;
  color: rgb(170, 170, 170);
  border: 1px solid rgb(222, 225, 226);
}
.tab-pane-row-section-card-body-item-content-element-item:hover {
  color: rgb(85, 85, 85);
  border: 1px solid rgb(153, 153, 153);
}

.light-text .a {
  fill: #fff;
}
.light-text .a,
.light-text .b {
  stroke: #707070;
}
.light-text .b,
.light-text .e {
  fill: none;
}
.light-text .b {
  stroke-width: 2px;
}
.light-text .c {
  fill: #707070;
  font-size: 20px;
  font-family: SegoeUI-Light, Segoe UI;
  font-weight: 300;
}
.light-text .d {
  stroke: none;
}
.regular-text .a {
  fill: #fff;
}
.regular-text .a,
.regular-text .b {
  stroke: #707070;
}
.regular-text .b,
.regular-text .e {
  fill: none;
}
.regular-text .b {
  stroke-width: 2px;
}
.regular-text .c {
  fill: #707070;
  font-size: 20px;
  font-family: SegoeUI, Segoe UI;
}
.regular-text .d {
  stroke: none;
}

.bold-text .a {
  fill: #fff;
}
.bold-text .a,
.bold-text .b {
  stroke: #707070;
}
.bold-text .b,
.bold-text .e {
  fill: none;
}
.bold-text .b {
  stroke-width: 2px;
}
.bold-text .c {
  fill: #707070;
  font-size: 20px;
  font-family: SegoeUI-Bold, Segoe UI;
  font-weight: 700;
}
.bold-text .d {
  stroke: none;
}
</style>