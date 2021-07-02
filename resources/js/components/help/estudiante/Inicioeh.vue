<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Inicio</div>
      <div class="section-content">
        <div class="section-content-tittle">Pantalla de inicio</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Al ingresar a la plataforma se te direcciona a la pagina de inicio
            donde se encuentra el panel de navegacion y el de avisos.
            <br />
            <br />
            <p>
              Donde podras visualizar los avisos recientes y navegar hacia otra
              sección.
            </p>
          </div>
          <div class="section-content-resourceei"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-resourceein"></div>
          <div class="section-content-description">
            Puedes navegar entre los avisos mediate sus botones de navegación.
            <p>O desplazarte mediante su acceso rapido de la izquierda.</p>
            <br />
            <br />
            Ademas de vizualizar si hay nuevo contenido en la seccion de
            actividad reciente.
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
.section-content-resourceei {
  background-image: url("/resources/help/inicioe1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceein {
  background-image: url("/resources/help/inicioe2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>