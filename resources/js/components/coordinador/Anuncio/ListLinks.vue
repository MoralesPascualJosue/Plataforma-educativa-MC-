<template>
  <div class="listlinks-layout">
    <div
      class="listlinks-toolbar-menucreate"
      :class="{
        active: statusMenucreate,
      }"
    >
      <div class="listlinks-toolbar-menucreate-body">
        <p>Nombre para mostrar</p>
        <input type="text" name="nombre" id="nombre" v-model="newlink.name" />
        <p>Destino</p>
        <input
          type="url"
          name="destino"
          id="destino"
          v-model="newlink.source"
        />
      </div>
      <div class="listlinks-toolbar-menucreate-options">
        <div @click="cancelLink">Cancelar</div>
        <div @click="saveLink">Guardar</div>
      </div>
    </div>
    <div class="listlinks-toolbar">
      <div class="listlinks-toolbar-buttom" @click="onChangeStatusToolbar">
        +
      </div>
      <div class="listlinks-toolbar-options" v-show="statustoolbar">
        <div>
          Agregar
          <span>
            <p @click="addLink">+</p>
          </span>
        </div>
        <div>
          Ancho
          <span>
            <p @click="deleteColumnComponent(block)">-</p>
            <p @click="addColumnComponent(block)">+</p>
          </span>
        </div>
        <div>
          Largo
          <span>
            <p @click="deleteRowComponent(block)">-</p>
            <p @click="addRowComponent(block)">+</p>
          </span>
        </div>
        <div>
          Eliminar <span> <p @click="$emit('remove', indexb)">D</p></span>
        </div>
      </div>
    </div>
    <p class="listlinks-header">Enlaces</p>
    <div class="listlinks-body">
      <ul>
        <li v-for="(enlace, indexen) in listlinks" :key="indexen">
          <a :href="enlace.source"> {{ enlace.name }}</a>
          <span class="delete" v-on:click="removeLink(indexen)">
            <svg viewBox="0 0 33 32">
              <g transform="translate(-244 -385)">
                <path
                  class="b"
                  d="M5.194.029,4.97,3.019-2.036,1.412-.742-1.221Z"
                  transform="translate(261 388)"
                />
                <g class="b" transform="translate(252 399)">
                  <path
                    class="e"
                    d="M 7.706448078155518 12.35585021972656 L 5.19981861114502 11.88849830627441 L 3.938209772109985 11.29481887817383 L 0.1968925595283508 -0.4927387535572052 L 3.070948600769043 0.5523881912231445 L 3.135668516159058 0.5759181976318359 L 3.204338550567627 0.5810782313346863 L 8.064568519592285 0.946438193321228 L 8.101308822631836 0.9492081999778748 L 8.138058662414551 0.9465482234954834 L 13.19836807250977 0.5811882019042969 L 13.2415885925293 0.5780681967735291 L 13.28361892700195 0.567558228969574 L 16.83906936645508 -0.3212785422801971 L 13.42620372772217 11.01466369628906 L 10.68593978881836 12.14302539825439 L 7.706448078155518 12.35585021972656 Z"
                  />
                  <path
                    class="f"
                    d="M 0.9808139801025391 0.3243570327758789 L 4.348709106445313 10.93539428710938 L 5.354598999023438 11.40873908996582 L 7.734922409057617 11.85254096984863 L 10.5700159072876 11.65003108978271 L 13.01597690582275 10.64285469055176 L 16.10661125183105 0.3772163391113281 L 13.40487861633301 1.052628517150879 L 13.32079887390137 1.073648452758789 L 13.23435878753662 1.079888343811035 L 8.17405891418457 1.445248603820801 L 8.100568771362305 1.450558662414551 L 8.027088165283203 1.445037841796875 L 3.166858673095703 1.079678535461426 L 3.029508590698242 1.069348335266113 L 2.900068283081055 1.02227783203125 L 0.9808139801025391 0.3243570327758789 M -0.5870323181152344 -1.309842109680176 L 3.241818428039551 0.08248805999755859 L 8.102048873901367 0.4478483200073242 L 13.16234874725342 0.08248805999755859 L 17.57152938842773 -1.019771575927734 L 13.83642864227295 11.38647842407227 L 10.80187797546387 12.63601779937744 L 7.677978515625 12.85915851593018 L 5.045048713684082 12.36825847625732 L 3.527709007263184 11.65423774719238 L -0.5870323181152344 -1.309842109680176 Z"
                  />
                </g>
                <g class="a" transform="translate(244 385)">
                  <rect class="e" width="33" height="32" rx="4" />
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
                  x2="18"
                  y2="4"
                  transform="translate(253.5 388.5)"
                />
                <path
                  class="d"
                  d="M9.135,1.079h8.722"
                  transform="translate(268.424 394.51) rotate(104)"
                />
                <g class="c" transform="translate(251 395)">
                  <ellipse class="e" cx="9.5" cy="2.5" rx="9.5" ry="2.5" />
                  <ellipse class="g" cx="9.5" cy="2.5" rx="9" ry="2" />
                </g>
                <line class="d" y2="8" transform="translate(260.5 403.5)" />
                <line
                  class="d"
                  x2="1"
                  y2="8"
                  transform="translate(255.5 402.5)"
                />
                <path
                  class="c"
                  d="M1717.389,402c5.833,3.259,10,0,10,0"
                  transform="translate(-1461.889 8.449)"
                />
              </g></svg
          ></span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    indexb: Number,
    block: {
      type: Object,
      default: function () {
        return {
          type: "listlinks",
          source: [],
          width: 1,
          heigth: 1,
        };
      },
    },
  },
  data() {
    return {
      statustoolbar: false,
      statusMenucreate: false,
      newlink: {
        source: "/",
        name: "Nuevo enlace",
      },
    };
  },
  computed: {
    listlinks() {
      return this.block.source;
    },
  },
  methods: {
    onChangeStatusToolbar() {
      this.statustoolbar = !this.statustoolbar;
    },
    addLink() {
      this.statusMenucreate = true;
    },
    cancelLink() {
      this.statusMenucreate = false;
    },
    saveLink() {
      if (this.newlink.source == "" || this.newlink.name == "") {
        flash("Contenido vacio", "warning");
      } else {
        this.listlinks.push(this.newlink);
        this.statusMenucreate = false;
        this.newlink = {
          name: "Nuevo enlace",
          source: "/",
        };
        this.$emit("onchange");
      }
    },
    removeLink(value) {
      this.listlinks.splice(value, 1);
      this.$emit("onchange");
    },
    addColumnComponent(blockc) {
      blockc.width++;
      this.$emit("onchange");
    },
    deleteColumnComponent(blockc) {
      blockc.width--;
      this.$emit("onchange");
    },
    addRowComponent(blockc) {
      blockc.heigth++;
      this.$emit("onchange");
    },
    deleteRowComponent(blockc) {
      blockc.heigth--;
      this.$emit("onchange");
    },
  },
};
</script>

<style>
.listlinks-layout {
  height: 100%;
  width: 100%;
  position: relative;
  overflow: hidden;
}
.listlinks-toolbar {
  display: inline-block;
  position: absolute;
  right: 0;
  background-color: #fdc770;
}
.listlinks-toolbar-buttom {
  float: left;
  font-weight: bold;
  cursor: pointer;
  font-size: 20px;
  width: 2rem;
  text-align: center;
}
.listlinks-toolbar-buttom:hover {
  border: 1px solid #266fae;
}

.listlinks-toolbar-options {
  position: relative;
  float: left;
}
.listlinks-toolbar-options div {
  display: inline-block;
  cursor: pointer;
  padding-left: 0.5rem;
  color: #266fae;
  font-size: 12px;
  padding: 0.5rem;
}
.listlinks-toolbar-options div span {
  display: block;
  font-size: 14px;
  font-weight: bold;
  text-align: center;
}
.listlinks-toolbar-options div span p {
  width: 18px;
  height: 18px;
  display: inline-block;
  border-radius: 50%;
  background-size: cover;
  color: #000;
}
.listlinks-toolbar-options div span p:hover {
  background-color: #266fae;
}

.listlinks-toolbar-menucreate {
  overflow: hidden;
  position: absolute;
  inset: 0px 0px 0px auto;
  width: 0px;
  background-color: rgb(214, 217, 220);
  border-left: 1px solid rgb(214, 217, 220);
  border-right: 0px;
  z-index: 105;
  transition: width 0.3s ease 0s;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.listlinks-toolbar-menucreate.active {
  width: 100%;
}
.listlinks-toolbar-menucreate-body {
  background-color: #fff;
  padding: 0.5rem;
}
.listlinks-toolbar-menucreate-body input {
  padding: 0.5rem;
}
.listlinks-toolbar-menucreate-options {
  display: flex;
}
.listlinks-toolbar-menucreate-options div {
  background-color: #fff;
  width: 100%;
  padding: 0.5rem;
  cursor: pointer;
}
.listlinks-toolbar-menucreate-options div:hover {
  background-color: #fcb036;
}

.listlinks-header {
  font-size: 20px;
  font-weight: bold;
}

.listlinks-body {
  overflow: auto;
  height: 90%;
}
.listlinks-body ul {
  padding: 0.5rem;
  list-style: none;
}

.listlinks-body ul li {
  display: flex;
  align-items: flex-end;
  padding: 0.2rem;
  justify-content: space-evenly;
}
.listlinks-body ul li a {
  text-underline-position: under;
  font-size: 18px;
}

.delete {
  width: 25px;
  height: 25px;
  display: inline-block;
  position: relative;
}

.delete .a,
.delete .b,
.delete .f {
  fill: #707070;
}

.delete .b {
  stroke: #fff;
}

.delete .b,
.delete .c,
.delete .d {
  stroke-linecap: round;
  stroke-width: 1px;
}
.delete .c,
.delete .d,
.delete .g {
  fill: none;
}
.delete .c {
  stroke: #fff;
  stroke-dasharray: inherit;
}
.delete .d {
  stroke: #fff;
}
.delete .e,
.delete .f {
  stroke: #fff;
}

.delete:hover .a,
.delete:hover .b,
.delete:hover .f {
  fill: rgb(194, 40, 44);
}
.delete:hover .b {
  stroke: #fff;
}
.delete:hover .c {
  stroke: #fff;
}
</style>