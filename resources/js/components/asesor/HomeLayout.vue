<template>
  <div class="home-layout">
    <div class="colum-left">
      <div class="home-infouser">
          <div class="home-avatarcontainer">
              <img :src="user.image" />
          </div>
          <div class="home-userdetails">
            <h2>{{ user.name }}</h2
            <span>{{ user.email }}</span>
          </div>
      </div>
      <div class="home-imagehome">
        <div class="background"></div>
      </div>
    </div>
    <div class="colum-right">
     <div class="home-date">
     	<div class="dia">{{ fecha }}</div>
     </div>
     <Anuncio @updateuserdata="updateuser" />
    </div>
  </div>
</template>

<script>
import Anuncio from "../Anuncio";
export default {
  components: {
    Anuncio,
  },
  data() {
    return {
      user: {
        name: "Default name",
        email: "default@email.com",
        image: "resources/users/user-default.svg",
      },
    };
  },
computed:{
    fecha(){	
	return new Date().toDateString();
	},
 },
  methods: {
    updateuser(data) {
      this.user = data;
    },
  },
};
</script>

<style>
.home-layout{
 display: grid;
 grid-template-columns: 39% 59%;
 padding: 1rem;
 min-height: 100%;
}

.home-infouser {
 height: 6rem;
 background-color: #fdc770;
 border-radius: 20px;
 padding: 0.5rem;
}

.home-avatarcontainer {
 width: 5rem;
 height: 5rem;
 border-radius: 50%;
 float: left;
 overflow: hidden;
}

.home-avatarcontainer img{
 width: 100%;
 height: 100%;
}

.home-userdetails {
 padding-top: 1rem;
 padding-left: 6rem;
 max-width: 367px;
}

.home-userdetails h2 {
 font-weight: bold;
}

.home-imagehome {
  border-radius: 20px;
  overflow: hidden;
  height: 10.6875rem;
  margin-top: 1rem;
  border: 1px solid #fdc770;
}

.home-date {
 height: 6rem;
 font-size: 30px;
 text-align: end;
 color: white;
}

@media (max-width: 1050px) {
 .home-layout {
 display: inherit;
 }

  .home-infouser {
    display: none;
  }
}
</style>
