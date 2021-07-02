<template>
  <div class="section-container">
    <div class="section-layout">
      <div class="section-tittle">Clases</div>
      <div class="section-content">
        <div class="section-content-tittle">Mis clases</div>
        <div class="section-content-body">
          <div class="section-content-description">
            En la seccion de clases se listaran todos los cursos que se hayan
            creado.
            <p>A los cuales podras acceder seleccionandolos.</p>
            <br />
            <br />
            Y podras vizualizar si hay entregas sin revisar mediante un icono en
            la parte superior izquierda.
          </div>
          <div class="section-content-resourceaca"></div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-tittle">Crear curso</div>
        <div class="section-content-body">
          <div class="section-content-resourceacb"></div>
          <div class="section-content-description">
            Para crear un curso selecciona la opcion en la parte superior y se
            desplegara un panel donde podras crearlo.
            <br />
            <br />
            <p>
              Al rellenar los campos solicitados seleccionamos la opcion crear y
              el nuevo curso se agregara a la lista.
            </p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-resourceacc"></div>
          <div class="section-content-description">
            Al ingresar al curso se podra comenzar a interactuar con sus
            opciones o agregar contenido seleccionando la opcion deseada.
            <br />
            <br />
            <p>
              Tambien se podra editar los datos del curso seleccionando la
              opcion correspondiente.
            </p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="section-content-body">
          <div class="section-content-description">
            Al ingresar a un curso se listara el contenido que se haya creado.
            <br />
            <br />
            <p>A los cuales podras acceder seleccionandolos.</p>
          </div>
          <div class="section-content-resourceacd"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.section-content-resourceaca {
  background-image: url("/resources/help/clasesa1.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceacb {
  background-image: url("/resources/help/clasesa2.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceacc {
  background-image: url("/resources/help/clasesa3.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
.section-content-resourceacd {
  background-image: url("/resources/help/clasesa4.png");
  width: 65%;
  height: 19rem;
  background-size: cover;
  border: solid #f0f0f0 0.5rem;
}
</style>