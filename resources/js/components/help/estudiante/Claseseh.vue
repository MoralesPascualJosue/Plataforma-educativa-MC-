<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Clases</div>
      <div class="section-content">
        <div class="section-content-tittle">Mis clases</div>
        <div class="section-content-body">
          <div class="section-content-description">
            En la seccion de clases se listaran todos los cursos que se hayan
            agregado.
            <br />
            <br />
            <p>A los cuales podras acceder seleccionandolos.</p>
          </div>
          <div class="section-content-resourceeca"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Agregar curso</div>
        <div class="section-content-body">
          <div class="section-content-resourceecb"></div>
          <div class="section-content-description">
            Para agregar un curso en la opcion que aparece como primer elemento
            de la lista debes ingresar el codigo del curso, que te puede ser
            proporcionado por el asesor que haya creado el curso.
            <br />
            <br />
            <p>
              Debe ser un codigo de curso existente para que puedas ser
              matriculado en tal curso.
            </p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-description">
            Al ingresar al curso se podra comenzar a interactuar con su
            contenido disponible.
            <br />
            <br />
            <p>
              Como las actividades y las demas opciones disponibles en el panel
              de navegación.
            </p>
          </div>
          <div class="section-content-resourceecc"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-content-resourceeca {
  background-image: url("/resources/help/clasese1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceecb {
  background-image: url("/resources/help/clasese2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceecc {
  background-image: url("/resources/help/clasese3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>