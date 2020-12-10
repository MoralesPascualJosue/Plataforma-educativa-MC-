<template>
  <div>
    <div id="taskcontenido" v-html="contenido"></div>
  </div>
</template>

<script>
export default {
  props: {
    contenidoinicial: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      obj: {},
      loading: false,
    };
  },
  computed: {
    contenido() {
      return this.contenidoinicial;
    },
    actividad() {
      return this.$store.getters.actividadview;
    },
  },
  methods: {},
};
</script>

<style>
.block-s {
  margin-left: 2.5%;
  min-height: 300px;
  scrollbar-width: thin;
  grid-column: 1 / 3;
  text-align: center;
  background-color: white;
  padding: 1px;
}

iframe {
  min-height: 500px;
  width: 100%;
}

.wm-100 {
  max-width: 100%;
}

/*	Device & Screen */
div.contentblock {
  height: 100%;
  width: 100%;
  background: white;
  -webkit-transition: all 250ms ease;
  -moz-transition: all 250ms ease;
  -ms-transition: all 250ms ease;
  -o-transition: all 250ms ease;
  transition: all 250ms ease;
}
div.contentblock.bounce {
  -webkit-transform: translate3d(70px, -65px, 0px);
  -moz-transform: translate3d(70px, -65px, 0px);
  -o-transform: translate3d(70px, -65px, 0px);
  transform: translate3d(70px, -65px, 0px);
}
div.contentblock.open {
  -webkit-transform: translate3d(60px, -55px, 0px);
  -moz-transform: translate3d(60px, -55px, 0px);
  -o-transform: translate3d(60px, -55px, 0px);
  transform: translate3d(60px, -55px, 0px);
}

/*	Toggle & Menu */
div.toggle {
  height: 39px;
  width: 47px;
  position: absolute;
  /* left: 24%; */
  z-index: 500;
  cursor: pointer;
  background-color: #262626;
  display: none;
}
div.x,
div.y {
  position: absolute;
  margin: auto;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  background: #fff;
  -webkit-transition: all 200ms ease-out;
  -moz-transition: all 200ms ease-out;
  -ms-transition: all 200ms ease-out;
  -o-transition: all 200ms ease-out;
  transition: all 200ms ease-out;
}
div.x {
  height: 4px;
  width: 30px;
}
div.y {
  height: 30px;
  width: 4px;
}
div.x.stretch {
  width: 40px;
}
div.x.shrink {
  width: 15px;
}
div.y.minus {
  height: 0px;
}

div.menu {
  height: 22em;
  width: 40px;
  position: absolute;
  /* left: 24%; */
  overflow: hidden;
}

div.menu ul {
  list-style: none;
  padding: 0px;
  margin: 0px;
  height: 150px;
  width: 35px;
  position: absolute;
  top: 45px;
  left: 11px;
  z-index: -1;
}
div.menu ul li {
  margin-top: 10px;
}
div.menu ul li a {
  display: block;
  height: 31px;
  width: 31px;
  text-indent: -9999px;
  font-size: 0px;
  background: #375585 center center;
}
div.menu ul li.animate a {
  -webkit-transition: all 300ms ease-out;
  -moz-transition: all 300ms ease-out;
  -ms-transition: all 300ms ease-out;
  -o-transition: all 300ms ease-out;
  transition: all 300ms ease-out;
}
div.menu ul li.lock a {
  background-image: url("/resources/icons/am-delete.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, -30px, 0px);
  -moz-transform: translate3d(-50px, -30px, 0px);
  -o-transform: translate3d(-50px, -30px, 0px);
  transform: translate3d(-50px, -30px, 0px);
}
div.menu ul li.imageblock a {
  background-image: url("/resources/icons/am-image1.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 0px, 0px);
  -moz-transform: translate3d(-50px, 0px, 0px);
  -o-transform: translate3d(-50px, 0px, 0px);
  transform: translate3d(-50px, 0px, 0px);
}
div.menu ul li.videoblock a {
  background-image: url("/resources/icons/am-video.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.docblock a {
  background-image: url("/resources/icons/am-pdf.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.textblock a {
  background-image: url("/resources/icons/am-text.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.resourcesblock a {
  background-image: url("/resources/icons/coloeccion-box.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-50px, 30px, 0px);
  -moz-transform: translate3d(-50px, 30px, 0px);
  -o-transform: translate3d(-50px, 30px, 0px);
  transform: translate3d(-50px, 30px, 0px);
}

div.menu ul li.color a {
  background-color: #f0f0f0;
}
div.menu ul li.move a {
  -webkit-transform: translate3d(0px, 0px, 0px);
  -moz-transform: translate3d(0px, 0px, 0px);
  -o-transform: translate3d(0px, 0px, 0px);
  transform: translate3d(0px, 0px, 0px);
}

/**/
div.menu-options {
  height: 35px;
  width: 70%;
  position: absolute;
  overflow: hidden;
  margin-top: -50px;
}

div.menu-options ul {
  list-style: none;
  padding: 0px;
  margin: 0px;
  position: absolute;
  left: 11px;
  z-index: -1;
  width: 100%;
  height: 35px;
  top: -15px;
}
div.menu-options ul li {
  margin-left: 10px;
  display: inline;
}
div.menu-options ul li a {
  display: inline-block;
  height: 31px;
  width: 31px;
  text-indent: -9999px;
  font-size: 0px;
  background: #375585 center center;
}

div.menu-options ul li.animate a {
  -webkit-transition: all 300ms ease-out;
  -moz-transition: all 300ms ease-out;
  -ms-transition: all 300ms ease-out;
  -o-transition: all 300ms ease-out;
  transition: all 300ms ease-out;
}

div.menu-options ul li.alingleft-option a {
  background-image: url("/resources/icons/text-aling-left.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}
div.menu-options ul li.alingcenter-option a {
  background-image: url("/resources/icons/text-aling-center.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.alingright-option a {
  background-image: url("/resources/icons/text-aling-right.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.downfont-option a {
  background-image: url("/resources/icons/font-down.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.upfont-option a {
  background-image: url("/resources/icons/font-up.png");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.addtextblock a {
  background-image: url("/resources/icons/edit-field-type-text.svg");
  background-size: cover;
  background-position: center;
  -webkit-transform: translate3d(-45px, 30px, 0px);
  -moz-transform: translate3d(-45px, 30px, 0px);
  -o-transform: translate3d(-45px, 30px, 0px);
  transform: translate3d(-45px, 30px, 0px);
}

div.menu-options ul li.color a {
  background-color: #f0f0f0;
}
div.menu-options ul li.move a {
  -webkit-transform: translate3d(0px, 0px, 0px);
  -moz-transform: translate3d(0px, 0px, 0px);
  -o-transform: translate3d(0px, 0px, 0px);
  transform: translate3d(0px, 0px, 0px);
}

/**/

.newblock {
  width: 100%;
  border-radius: 8px;
  text-align: center;
  cursor: pointer;
  padding: 10px;
}

.newblock:hover {
  background-color: #f0f0f0;
  border: 1px solid #262626;
}

/* input */
.input-area {
  width: 100%;
  height: 100%;
  display: flex;
  background: white;
  align-items: center;
  padding: 2rem;
}

#taskcontenido .form-group {
  width: 100%;
  border: 5px dashed #262626;
  padding: 3rem 2rem;
  overflow: hidden;
}

#fileHelp {
  display: inherit;
}

.progress {
  background: red;
  display: block;
  height: 20px;
  text-align: center;
  transition: width 0.3s;
  width: 0;
  overflow: hidden;
  margin-top: 10px;
}

.complete {
  background-color: green;
  color: white;
}

.progress.hide {
  opacity: 0;
  transition: opacity 1.3s;
}

.btn-block {
  padding: 10px;
  font-size: 20px;
  border-radius: 8px;
  background-color: orange;
}

.btn-block:hover {
  background-color: #8292a2;
}

.textb {
  padding: 10px;
  min-width: 110px;
  min-height: 110px;
  font-size: x-large;
  font-weight: lighter;
  line-height: 1.2em;
  padding-bottom: 45px;
}

.textb:focus {
  background-color: white;
}

.btn-save {
  width: 100%;
  border-radius: 8px;
  background-color: orange;
  height: 35px;
}

.btn-save:hover {
  background-color: #8292a2;
}

#fecha_inicio,
#fecha_final {
  z-index: 5;
}

.green-b {
  background-color: #60e85e;
}

.red-b {
  background-color: red;
}

.show {
  z-index: 100;
}
.show-s {
  z-index: 99;
}
@media (max-width: 1050px) {
  .item1 {
    grid-column: 1 / 6;
  }
  .item2 {
    grid-column: 1 / 6;
  }
}

.name-r {
  display: inline-block;
  width: 75%;
}

.img-r {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: orange;
  margin-left: 50px;
  margin-top: -25px;
  display: inline-block;
}

.img-r img {
  width: 100%;
  height: 100%;
}

.content-r {
  background: white;
  list-style: none;
  width: 100%;
  display: inline-flex;
  border-top: 25px solid orange;
  margin-top: 10px;
}

.resources-r {
  border: 1px solid gray;
  padding: 10px;
}

.options-r {
  display: inline-flex;
  float: right;
  font-weight: 700;
}

.options-r p {
  padding: 5px;
  background-color: white;
  cursor: pointer;
  font-size: 20px;
}

.options-r p:hover {
  background-color: #8292a2;
}

.sweet-modal-box {
  height: 80%;
}

.sweet-modal-content {
  height: 100%;
}

.completo {
  width: 100%;
  height: 100%;
}

.editbutton {
  display: none;
}

.minh-n {
  min-height: inherit;
}
</style>