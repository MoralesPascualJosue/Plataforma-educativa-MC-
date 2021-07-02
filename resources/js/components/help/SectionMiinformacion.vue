<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Mi información</div>
      <div class="section-content">
        <div class="section-content-tittle">Información de la cuenta</div>
        <div class="section-content-body">
          <div class="section-content-description">
            En el apartado de información se encuentran los datos que se
            ingresaron al momento de crear la cuenta.
            <br />
            <br />
            <p>
              Algunos pueden ser modificados desde este apartado, Seleccionando
              la opcion editar.
            </p>
          </div>
          <div class="section-content-resourcemia"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Editar información</div>
        <div class="section-content-body">
          <div class="section-content-resourcemib"></div>
          <div class="section-content-description">
            Al seleccionar editar, se visualizaran los apartados que pueden ser
            modificados.
            <br />
            <br />
            <p>
              Al terminar se pueden guardar o cancelar los cambios seleccionando
              la ópcion correspondiente.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-content-resourcemia {
  background-image: url("/resources/help/miinformacion1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourcemib {
  background-image: url("/resources/help/miinformacion2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>