<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Actividad</div>
      <div class="section-content">
        <div class="section-content-tittle">Actividad</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Ingresando a una actividad como primer opcion se encuentra la vista
            del contenido.
            <br />
            <br />
            <p>Contenido.</p>
          </div>
          <div class="section-content-resourceeaa"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Entregas</div>
        <div class="section-content-body">
          <div class="section-content-resourceeab"></div>
          <div class="section-content-description">
            Como seguda opcion se encuentra la vista de entregas la cual
            contiene un listado de las entregas que has realizado.
            <p>Tambien se visualiza detalles de las entregas.</p>
            <br />
            <br />
            Ademas el apartado donde puedes subir el contenido de tu entrega.
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Detalles</div>
        <div class="section-content-body">
          <div class="section-content-resourceeac"></div>
          <div class="section-content-description">
            La tercer opcion es la vista de detalles, la cual contiene
            informacion acerca de la actividad.
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
.section-content-resourceeaa {
  background-image: url("/resources/help/actividade1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceeab {
  background-image: url("/resources/help/actividade2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceeac {
  background-image: url("/resources/help/actividade3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>