<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Prueba</div>
      <div class="section-content">
        <div class="section-content-tittle">Prueba</div>
        <div class="section-content-body">
          <div class="section-content-description">
            En la prueba como primer opcion se encuentra la vista del contenido.
            <br />
            <br />
            <p>En el cual podras registrar tus respuestas.</p>
          </div>
          <div class="section-content-resourceepa"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Entregas</div>
        <div class="section-content-body">
          <div class="section-content-resourceepb"></div>
          <div class="section-content-description">
            Como seguda opcion se encuentra la vista de entregas.
            <br />
            <br />
            <p>Donde podras revisar información sobre tu entrega.</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Detalles</div>
        <div class="section-content-body">
          <div class="section-content-resourceepc"></div>
          <div class="section-content-description">
            La tercer opcion es la vista de detalles, la cual contiene
            informacion acerca de la prueba.
            <br />
            <br />
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
.section-content-resourceepa {
  background-image: url("/resources/help/pruebae1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceepb {
  background-image: url("/resources/help/pruebae2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceepc {
  background-image: url("/resources/help/pruebae3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>