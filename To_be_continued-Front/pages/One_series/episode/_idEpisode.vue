<template>
  <div>
    <Sidebar :log="bool" />
    <div class="info_episodes">

    <h3>{{ dataEpisode.title }}</h3>
    <br>
    <h4>
      Saison {{ dataEpisode.season }} // Episode {{ dataEpisode.episode }}
    </h4>
    <br>
    <h4>date de diffusion : {{ dataEpisode.date }}</h4>
    <br>
    <h4>{{ dataEpisode.note.mean }} / 5</h4>
    <br>
    <p>{{ dataEpisode.description }}</p>
    </div>

    <!-- <button v-if="dataEpisode.user.seen">Marquée comme non vue</button>
    <button v-else>Marquée comme non vue</button> -->

    <!-- <h4>Personage :</h4> -->
    <div class="container">
    <div
      v-for="character in dataEpisode.characters"
      :key="character.item"
      class="actor"
    >
          <div class="actor_img">
            <img :src="character.picture" alt=" Photo de l'acteur" />
          </div>
          <div class="actor_content">
          <h1 class="actor_title">{{ character.actor }} dans le role de {{ character.name }}</h1>
          </div>
        </div>
    </div>

  </div>
</template>

<script>
export default {
  name: "One_episode",
  data() {
    return {
      bool: false,
      idEpisode: this.$route.params.idEpisode,
      dataEpisode: {
        note: {},
        user: {},
        characters: {},
      },
      dataUser: {},
    };
  },
  mounted() {
    if (localStorage.getItem("user") != null) {
      this.bool = true;
      this.dataUser = JSON.parse(localStorage.getItem("user"));
    }
    fetch("http://localhost:8000/episode ", {
      method: "post",
      body: JSON.stringify({
        id: this.idEpisode,
        token: this.dataUser.token,
      }),
    })
      .then((res) => {
        return res.json();
      })
      .then((response) => {
        if (response.episode) {
          this.dataEpisode = response.content;
        } else alert("ERROR");
      });
  },
};
</script>

<style>
img {
  width: 250px;
  border-radius: 5px;
}
*{
  margin: 0;
}
html{
  background: radial-gradient(ellipse at bottom, #2360aa 0%, #0c0d13 100%);

}

.container {
  display: grid;
  grid-template-columns: 2fr 2fr 2fr 2fr;
  margin: 20px;
  align-items: center;
  justify-content: center;
  margin-left: 100px;
}

.info_episodes{
  color: #fff;
  text-align: center;
  font-size: 20px;
  background: #333;
  margin: 20px;
  padding: 20px;
  border-radius: 5px;
}

.actors {
  display: grid;
  grid-template-columns: 2fr 2fr 2fr;
  margin: 30px;
  align-items: center;
  justify-content: center;
  margin-left: 100px;
}

.actor {
  margin: 20px;
  position: relative;
  background: #333;
  width: 250px;
  height: 60vh;
  border-radius: 6px;
  padding: 2rem;
  color: rgb(255, 255, 255);
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.2), 0 0 1rem rgba(0, 0, 0, 0.2);
  overflow: hidden;
}
.actor__img {
  margin: -2rem -2rem 1rem -2rem;
}
.actor__line {
  opacity: 0;
  animation: LineFadeIn 0.8s 0.8s forwards ease-in;
}
.actor__img {
  opacity: 0;
  animation: ImageFadeIn 0.8s 1.4s forwards;
}
.actor__title {
  color: white;
  margin-top: 10;
  font-weight: 800;
  letter-spacing: 0.01em;
}
.actor__content {
  color: #fff;
  margin-top: -1rem;
  opacity: 0;
  animation: ContentFadeIn 0.8s 1.6s forwards;
}


</style>
