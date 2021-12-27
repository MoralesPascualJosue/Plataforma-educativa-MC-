<template>
  <div class="descriptioncomponent-layout">
    <div class="descriptioncomponent-toolbar">
      <div
        class="descriptioncomponent-toolbar-buttom"
        @click="onChangeStatusToolbar"
      >
        +
      </div>
      <div class="descriptioncomponent-toolbar-options" v-show="statustoolbar">
        <div>
          Tamaño
          <span
            ><p
              :style="{ backgroundImage: `url(resources/icons/arrowUp.svg)` }"
              @click="onUparrow"
            ></p>
            {{ block.size }}
            <p
              :style="{ backgroundImage: `url(resources/icons/arrowDown.svg)` }"
              @click="onDownarrow"
            ></p
          ></span>
        </div>
        <div>
          Alineacion
          <span>
            <p
              :style="{
                backgroundImage: `url(resources/icons/text-aling-left.svg)`,
              }"
              @click="onChangeTextaling('left')"
            ></p>
            <p
              :style="{
                backgroundImage: `url(resources/icons/text-aling-center.svg)`,
              }"
              @click="onChangeTextaling('center')"
            ></p>
            <p
              :style="{
                backgroundImage: `url(resources/icons/text-aling-right.svg)`,
              }"
              @click="onChangeTextaling('right')"
            ></p>
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

    <div
      class="descriptioncomponent-body"
      :style="{ fontSize: `${block.size}`, textAlign: `${block.align}` }"
      contenteditable="true"
      @blur="inputText"
      v-html="block.source"
    ></div>
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
          type: "description",
          source: "Descriocion component",
          width: 1,
          heigth: 1,
          size: 14,
          align: "inherit",
        };
      },
    },
  },
  data() {
    return {
      statustoolbar: false,
    };
  },
  methods: {
    inputText(e) {
      var src = e.target.innerHTML;
      if (src != this.block.source) {
        this.block.source = src;
        this.$emit("onchange");
      }
    },
    onChangeStatusToolbar() {
      this.statustoolbar = !this.statustoolbar;
    },
    onUparrow() {
      this.block.size += 4;
      this.$emit("onchange");
    },
    onDownarrow() {
      this.block.size -= 4;
      this.$emit("onchange");
    },
    onChangeTextaling(value) {
      this.block.align = value;
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
.descriptioncomponent-layout {
  height: 100%;
  width: 100%;
  position: relative;
}
.descriptioncomponent-toolbar {
  display: inline-block;
  position: absolute;
  right: 0;
  background-color: #fdc770;
}
.descriptioncomponent-toolbar-buttom {
  float: left;
  font-weight: bold;
  cursor: pointer;
  font-size: 20px;
  width: 2rem;
  text-align: center;
}
.descriptioncomponent-toolbar-buttom:hover {
  border: 1px solid #266fae;
}
.descriptioncomponent-toolbar-options {
  position: relative;
  float: left;
}
.descriptioncomponent-toolbar-options div {
  display: inline-block;
  cursor: pointer;
  padding-left: 0.5rem;
  color: #266fae;
  font-size: 12px;
  padding: 0.5rem;
}
.descriptioncomponent-toolbar-options div span {
  display: block;
  font-size: 14px;
  font-weight: bold;
  text-align: center;
}
.descriptioncomponent-toolbar-options div span p {
  width: 18px;
  height: 18px;
  display: inline-block;
  border-radius: 50%;
  background-size: cover;
  color: #000;
}
.descriptioncomponent-toolbar-options div span p:hover {
  background-color: #266fae;
}
.descriptioncomponent-body {
  height: 100%;
  overflow: hidden;
}
.descriptioncomponent-body::first-letter {
  margin-left: 2rem;
  font-weight: bold;
  line-height: 2rem;
}
.blockcomponentd-layout-grid-block-width {
  cursor: pointer;
  float: right;
  padding: 0.5rem;
  margin: 0.5rem;
  background-color: #fcb036;
  text-align: center;
}
.blockcomponentd-layout-grid-block-width div:hover {
  background-color: #266fae;
}

.blockcomponentd-layout-grid-block-width div {
  display: inline-block;
}
</style>