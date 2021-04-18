<template>
  <div class="contentcomponents">
    <h1>Primer elemento</h1>
    <div class="componente"><UploadFile /></div>
    <h1>Segundo Elemento</h1>
    <div class="componente"><PortadaSelected /></div>
    <h2>Tercer elemento</h2>
    <div class="componete"><PanelNavegacion /></div>
    <h2>Cuarto elemento</h2>
    <div class="componente">
      <SwideConponent
        @status="testCallback"
        :width="200"
        :height="40"
        textSize="15px"
        text="Desliza para confirmar"
        successText="Confirmado"
        background="#fcd770"
        progressBarBg="#fcb036"
        handlerbg="#266fae"
      />
    </div>
    <h2>Quinto elemento</h2>
    <div class="componente">
      <ConfirmationComponent
        cancelText="Cancelar"
        titleText="Seguro de salir ?"
        confirmText="Salir"
      />
    </div>
    <h2>Sexto elemento</h2>
    <div class="componente">
      <Imagecomponent
        source="resources/logo/Logo%20comp%20orange.svg"
        @changeimage="changeimage"
      />
    </div>
    <h2>Septimo componente</h2>
    <div class="componente">
      <Descriptioncomponent
        :options="{ align: 'center', size: 14 }"
        source="Este es mi contenido"
      />
    </div>
    <h2>Octavo componente</h2>
    <div class="componente">
      <Blockcomponent />
    </div>
    <h2>Noveno componente</h2>
    <div class="componente">
      <Anuncios />
    </div>
  </div>
</template>
<script>
import UploadFile from "./UploadFile";
import PortadaSelected from "./PortadaSelected";
import PanelNavegacion from "./PanelNavegacion";
import SwideConponent from "./Swipecomponent";
import ConfirmationComponent from "./ConfirmationComponent";
import Imagecomponent from "./Imagecomponent";
import Descriptioncomponent from "./Descriptioncomponent";
import Blockcomponent from "./Blockcomponent";
import Anuncios from "./Anuncios";
export default {
  components: {
    UploadFile,
    PortadaSelected,
    PanelNavegacion,
    SwideConponent,
    ConfirmationComponent,
    Imagecomponent,
    Descriptioncomponent,
    Blockcomponent,
    Anuncios,
  },
  methods: {
    testCallback(values) {
      console.log("test callback: " + values);
    },
    changeimage(value) {
      console.log(value);
    },
    guardarAnuncio() {
      console.log("Anuncio guardado");
    },
  },
};
</script>
<style>
body {
  background-color: olivedrab;
}
.componente {
  border: 1px solid green;
  background-color: burlywood;
}
.contentcomponents {
  padding-left: 255px;
  position: relative;
  width: 100%;
}
@media (max-width: 992px) {
  .contentcomponents {
    padding-left: inherit;
    position: relative;
    width: inherit;
  }
}
</style>
