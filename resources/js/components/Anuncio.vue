<template>
  <div class="anuncios-layout">
    <h3 class="anuncios-header">Anuncios</h3>
    <ul class="anuncios-listgroup">
      <li class="anuncios-listgroup-item" v-for="(item, index) in notas" :key="index">
	<p class="anuncio-header">Anuncio<span class="anuncios-listgroup-item-fecha">
          {{ item.updated_at }}
        </span></p>
        <p class="anuncio-msg">{{ item.anuncio }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notas: [],
    };
  },
  created() {
    axios
      .get("/home")
      .then((res) => {
        this.notas = res.data.anuncios;
        this.$emit("updateuserdata", res.data.user);
      })
      .catch((error) => {
        if (error.response.status === 401) {
          window.location.href = "login";
        }
      });
  },
};
</script>

<style>
.anuncios-layout {
 padding: 0.5rem;
}

.anuncios-header {
 color: white;
 font-weight: 500;
 text-align: center;
}

.anuncios-listgroup {
 padding-bottom: 2rem;
}

.anuncios-listgroup-item {
 background-color: #fdc770;
 margin-top: 0.5rem;
 min-height: 2rem;
 line-height: 2rem;
 padding-left: 0.5rem;
 padding-right: 0.5rem;
}

.anuncio-header {
 font-weight: 600;
 font-size: 14px;
}

.anuncios-listgroup-item-fecha {
 float: right;
 position: relative;
 font-size: smaller;
 color: #040404;
}

.anuncio-msg {
 font-size: 14px;
}
</style>
