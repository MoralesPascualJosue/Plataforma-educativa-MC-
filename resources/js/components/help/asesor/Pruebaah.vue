<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Prueba</div>
      <div class="section-content">
        <div class="section-content-tittle">Mis pruebas</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Creando una prueba se agregara a la lista de contenido del curso y
            podras ingresar a ella seleccionandola.
            <br />
            <br />
            <p>
              Al ingresar a la prueba podras navegar entre sus opciones con su
              panel de navegacion superior.
            </p>
          </div>
          <div class="section-content-resourceapa"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Prueba</div>
        <div class="section-content-body">
          <div class="section-content-resourceapb"></div>
          <div class="section-content-description">
            En la prueba como primer opcion se encuentra la vista del contenido,
            el cueal puede ser modificado por medio de un formato de bloques.
            <br />
            <br />
            <p>
              Al agregar una pregunta esta se guarda directamente y se vizualiza
              de acuerdo al tipo que se haya seleccionado.
            </p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Entregas</div>
        <div class="section-content-body">
          <div class="section-content-resourceapc"></div>
          <div class="section-content-description">
            Como seguda opcion se encuentra la vista de entregas la cual
            contiene un listado de los estudiantes matriculados en el curso.
            <br />
            <br />
            <p>Tambien se visualiza detalles de las entregas.</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Detalles</div>
        <div class="section-content-body">
          <div class="section-content-resourceapd"></div>
          <div class="section-content-description">
            La tercer opcion es la vista de detalles, la cual contiene
            informacion acerca de la prueba y tambien permite modificarla o
            eliminarla.
            <br />
            <br />
            <p>Recuerda guardar los cambios que realices.</p>
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
.section-content-resourceapa {
  background-image: url("/resources/help/pruebaa1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceapb {
  background-image: url("/resources/help/pruebaa2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceapc {
  background-image: url("/resources/help/pruebaa3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceapd {
  background-image: url("/resources/help/actividada4.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>