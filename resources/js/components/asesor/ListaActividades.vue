<template>
  <div class="page-tab">
    <div class="item1">
      <h1 :id="curso.id">{{ curso.title }}</h1>
    </div>
    <div class="item2">
      <div class="container">
        <div class="page-title">Crear actividad</div>
        <Actividades>
          <template slot-scope="{ togglePopup }">
            <div v-for="(activitie, index) in activities" :key="index" class="actividad">
              <Actividad
                :alt="'A'+activitie.id"
                v-bind:activitie="activitie"
                @pop-image="togglePopup"
              />
            </div>
          </template>
        </Actividades>
        <flash class="alert-flash" message="Charged!"></flash>
      </div>
    </div>
  </div>
</template>

<script>
import Actividades from "./Actividades";
import Actividad from "./Actividad";
import Flash from "../Flash";

export default {
  data() {
    return {
      curso: [],
      activities: []
    };
  },
  components: {
    Actividades,
    Actividad,
    Flash
  },
  created() {
    axios.get("/scursoc/" + this.$store.state.curso.id).then(res => {
      this.curso = res.data.curso;
      this.activities = res.data.actividades.data;
    });
  }
};
</script>

<style>
.page-tab {
  overflow-y: scroll;
  position: relative;
  padding: 20px;
  height: 97%;
  background: white;
  border-radius: 8px;
  margin: 0 0 10px 0;
  display: grid;
  grid-gap: 10px;
  grid-template-columns: repeat(5, 19%);
  grid-template-rows: repeat(4, 25%);
  justify-content: center;
}

.item1 {
  grid-column: 1 / 3;
  grid-row: 1 / 5;
}

.item2 {
  grid-column: 3 / 6;
  grid-row: 1 / 5;
  min-height: 57vh;
}

@media (max-width: 1050px) {
  .page-tab {
    grid-template-columns: repeat(1, 100%);
    grid-template-rows: inherit;
  }

  .item1 {
    grid-column: 1 / 1;
    grid-row: 1 / 2;
  }

  .item2 {
    grid-column: 1 / 1;
    grid-row: 3 / 5;
  }
}
</style>