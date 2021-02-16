<template>
  <div>
    <h1>Primer elemento</h1>
    <div class="componente"><UploadFile /> </div>
    <h1>Segundo Elemento</h1>
    <div class="componente"><PortadaSelected /></div>
    <h2>Tercer elemento</h2>
    <div class="componete"><PanelNavegacion /></div>
    <h2>Cuarto elemento</h2>
    <div class="componente">
     <SwideConponent @status="testCallback" :width="200" :height="40" textSize="15px" text="Desliza para confirmar" successText="Confirmado" background="#fcd770" progressBarBg="#fcb036" handlerbg="#266fae"/>
    </div>
	<h2>Quinto elemento</h2>
	<div class="componente">
		<ConfirmationComponent cancelText="Cancelar" titleText="Seguro de salir ?" confirmText="Salir"/>
	</div>
  </div>
</template>
<script>
import UploadFile from "./UploadFile";
import PortadaSelected from "./PortadaSelected";
import PanelNavegacion from "./PanelNavegacion";
import SwideConponent from "./Swipecomponent";
import ConfirmationComponent from "./ConfirmationComponent";
export default {
  components: {
    UploadFile,
    PortadaSelected,
    PanelNavegacion,
    SwideConponent,
	ConfirmationComponent,
  },
  methods:{
    testCallback(values){
	console.log("test callback: "+values);
    }
  }
};
</script>
<style>
.componente {
 border: 1px solid green;
}
</style>
