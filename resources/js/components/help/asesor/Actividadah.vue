<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Actividad</div>
      <div class="section-content">
        <div class="section-content-tittle">Mis actividades</div>
        <div class="section-content-body">
          <div class="section-content-description">
            Creando una actividad se agregara a la lista de contenido del curso y
            podras ingresar a ella seleccionandola.
            <br />
            <br />
            <p>
              Al ingresar a la actividad podras navegar entre sus opciones con
              su panel de navegacion superior.
            </p>
          </div>
          <div class="section-content-resourceaaa"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Actividad</div>
        <div class="section-content-body">
          <div class="section-content-resourceaab"></div>
          <div class="section-content-description">
            En la actividad como primer opcion se encuentra la vista del
            contenido, el cual puede ser modificado por medio de un formato de
            bloques.
            <br />
            <br />
            <p>
              Al terminar de editar el contenido se selecciona guardar contenido
              en la parte superior, para que este sea guardado.
            </p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Entregas</div>
        <div class="section-content-body">
          <div class="section-content-resourceaac"></div>
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
          <div class="section-content-resourceaad"></div>
          <div class="section-content-description">
            La tercer opcion es la vista de detalles, la cual contiene
            informacion acerca de la actividad y tambien permite modificarla o
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
.section-content-resourceaaa {
  background-image: url("/resources/help/actividada1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceaab {
  background-image: url("/resources/help/actividada2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceaac {
  background-image: url("/resources/help/actividada3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceaad {
  background-image: url("/resources/help/actividada4.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>