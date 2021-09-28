<template>
  <div class="oneCard">
    <Sidebar :log="bool" />
    <div class="card">
      <div class="card_left" v-if="series.images">
        <img :src="series.images.banner" alt="poster" />
      </div>
      <div class="card_right">
        <h1>{{ series.title }}</h1>
        <br />
        <hr />
        <br />
        <div class="card_right__details">
          <ul>
            <li class="infos">{{ series.creation }}</li>
            <li class="infos">{{ series.length }} min</li>
            <li class="infos">Saisons {{ series.seasons }}</li>
            <li class="infos">Épisode {{ series.episodes }}</li>
            <li class="infos">langue {{ series.language }}</li>
            <div class="genres">
              <div v-for="genres in series.genres" :key="genres" class="genre">
                #{{ genres }}
              </div>
            </div>
          </ul>
          <div class="card_right__review">
            <p>
              {{ series.description }}
            </p>
          </div>
          <div class="card_right__button">
            <div v-if="follow">
              <div class="submit" @click="Follow(id, false)">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                FUIR
              </div>
            </div>
            <div class="submit" v-else @click="Follow(id, true)">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              SUIVRE
            </div>
          </div>
          <div class="info_saison">
            <!-- <div id="user_watch" v-if="follow">
              <h4>A voir :</h4>
              <p>
                {{ series.user.next.title }}<br />
                {{ series.user.next.code }}
              </p>
              <button @click="watched(series.user.next.id, true)" class="vu">
                ✔
              </button>
            </div> -->
            <div id="saisons">
              <div class="saison" v-for="saison in saisons" :key="saison.item">
                <img class="poster" :src="saison.image" alt="" />
                <p>Saison {{ saison.number }}</p>
                <ul v-for="episode in episodes" :key="episode.item">
                  <div v-if="episode.season == saison.number">
                    <li v-if="episode.user.seen && follow">
                      <div
                        class="episode"
                        @click="path('/One_series/episode/' + episode.id)"
                      >
                        Episode : {{ episode.episode }} Vu
                      </div>
                    </li>
                    <li v-if="episode.user.seen == false && follow">
                      <div
                        class="episode"
                        @click="path('/One_series/episode/' + episode.id)"
                      >
                        Episode : {{ episode.episode }}
                      </div>
                      <button
                        @click="watched(episode.id, true)"
                        class="button type1"
                      >
                        marquée comme vu
                      </button>
                    </li>
                  </div>
                </ul>
              </div>
            </div>
            <div id="user_watched" v-if="follow">
              <h4>Deja vu :</h4>
              <ul v-for="episode in episodes" :key="episode.item">
                <div v-if="episode.user.seen">
                  <li>
                    <div
                      class="episode"
                      @click="path('/episode/' + episode.id)"
                    >
                      Episode : {{ episode.episode }}
                    </div>
                    <button
                      @click="watched(episode.id, false)"
                      class="button type1"
                    >
                      marquée comme non vu
                    </button>
                  </li>
                </div>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "one_series",
  data() {
    return {
      bool: false,
      id: "",
      series: {
        user: {
          next: {},
        },
      },
      saisons: {},
      episodes: {},
      mySeries: {},
      userData: {},
      id_user: false,
      dataUser: {
        user: {},
      },
      follow: "",
      token: "",
    };
  },
  methods: {
    path(path) {
      this.$router.push({
        path: path,
      });
    },
    Follow(id, method) {
      fetch("http://localhost:8000/follow", {
        method: "POST",
        body: JSON.stringify({
          id: id,
          token: this.token,
          method: method,
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.follow) {
            alert("BRAVO");
          } else {
            alert("Erreur");
          }
        });

      if (this.follow) {
        this.follow = false;
      } else {
        this.follow = true;
      }
    },
    watched(id, method) {
      fetch("http://localhost:8000/watched", {
        method: "POST",
        body: JSON.stringify({
          id: id,
          token: this.token,
          method: method,
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.watched) {
            alert("BRAVO");
          } else {
            alert("Erreur");
          }
        });

      this.start();
    },
    start() {
      fetch("http://localhost:8000/oneSerie ", {
        method: "post",
        body: JSON.stringify({
          id: this.id,
          id_user: this.id_user,
          token: this.token,
        }),
      })
        .then((res) => {
          return res.json();
        })
        .then((response) => {
          this.follow = response.follow;
          this.series = response.serie.show;
          this.userData = response.serie.user;
          this.saisons = response.saison.seasons;
          this.episodes = response.episodes;
        });
    },
  },
  mounted() {
    if (localStorage.getItem("user") != null) {
      this.bool = true;
    }
    this.id = this.$route.params.id;

    if (localStorage.getItem("user") != null) {
      this.dataUser = JSON.parse(localStorage.getItem("user"));
      this.id_user = this.dataUser.user.id;
      this.token = this.dataUser.token;
    }

    this.start();
  },
};
</script>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
html {
  background: radial-gradient(ellipse at bottom, #2360aa 0%, #0c0d13 100%);
}
.card {
  margin-top: -30px;
  margin-left: 180px;
  width: 1500px;
  height: 800px;
  background: transparent;
  border-radius: 10px;
  box-shadow: 0px 20px 30px 3px rgba(0, 0, 0, 0.55);
}

.infos {
  margin: 5px;
  text-align: center;
}

.card_left {
  width: 100%;
  height: 400px;
  float: left;
  overflow: hidden;
  background: transparent;
}
.card_left img {
  width: 100%;
  height: 100%;
  position: relative;
}
.card_right {
  width: 100%;
  float: left;
  background: #000000;
  height: auto;
}
.card_right h1 {
  color: white;
  font-family: "Montserrat", sans-serif;
  font-weight: 400;
  text-align: left;
  font-size: 40px;
  margin: 30px 0 0 0;
  padding: 0 0 0 40px;
  letter-spacing: 1px;
}
.card_right__details ul {
  list-style-type: none;
  padding: 0 0 0 40px;
  margin: 10px 0 0 0;
}
.card_right__details ul li {
  display: inline;
  color: blueviolet;
  font-family: "Montserrat", sans-serif;
  font-weight: 400;
  font-size: 20px;
  padding: 0 40px 0 0;
}

.card_right__review p {
  color: white;
  font-family: "Montserrat", sans-serif;
  font-size: 18px;
  padding: 0 40px 0 40px;
  letter-spacing: 1px;
  margin: 10px 0 10px 0;
  line-height: 20px;
}
.card_right__review a {
  text-decoration: none;
  font-family: "Montserrat", sans-serif;
  font-size: 14px;
  padding: 0 0 0 40px;
  color: #ea00ff;
  margin: 0;
}
.card_right__button {
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 10px;
}

.submit {
  position: relative;
  display: inline-block;
  padding: 30px 61px;
  border-radius: 4px;
  color: #03e9f4;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  margin: 25px;
  font-family: "Roboto", sans-serif;
  filter: hue-rotate(0deg);
  border: 2px solid #d2bdff;
  transition: all 0.1s linear;
}
.submit:hover {
  border: 1px solid transparent;
}
.submit:hover span {
  position: absolute;
  display: block;
}
.submit:hover span:nth-child(1) {
  filter: hue-rotate(0deg);
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, transparent, #3a86ff);
  animation: animate1 1s linear infinite;
}
@keyframes animate1 {
  0% {
    left: -100%;
  }
  50%,
  100% {
    left: 100%;
  }
}
.submit:hover span:nth-child(2) {
  filter: hue-rotate(60deg);
  top: -100%;
  right: 0;
  width: 3px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #3a86ff);
  animation: animate2 1s linear infinite;
  animation-delay: 0.25s;
}
@keyframes animate2 {
  0% {
    top: -100%;
  }
  50%,
  100% {
    top: 100%;
  }
}
.submit:hover span:nth-child(3) {
  filter: hue-rotate(120deg);
  bottom: 0;
  right: 0;
  width: 100%;
  background: linear-gradient(270deg, transparent, #3a86ff);
  animation: animate3 1s linear infinite;
  animation-delay: 0.5s;
}
@keyframes animate3 {
  0% {
    right: -100%;
    height: 3px;
  }
  50%,
  100% {
    height: 2px;
    right: 100%;
  }
}
.submit:hover span:nth-child(4) {
  filter: hue-rotate(300deg);
  bottom: -100%;
  left: 0;
  width: 3px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #3a86ff);
  animation: animate4 1s linear infinite;
  animation-delay: 0.75s;
}
@keyframes animate4 {
  0% {
    bottom: -100%;
  }
  50%,
  100% {
    bottom: 100%;
  }
}
.info_saison {
  background: #000000;
}
#user_watch,
#user_watched {
  color: #ddd;
}
.vu {
  border-radius: 100%;
  background-color: rgb(255, 255, 255);
  color: #0c0d13;
  width: 50px;
  height: 50px;
  font-size: 2.3em;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset,
    rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
  text-align: center;
}

#saisons {
  display: grid;
  grid-template-columns: 35% 35% 35%;
  color: #ddd;
  justify-items: center;
  justify-content: center;
}
.saison {
  margin: 10px;
  flex-wrap: wrap;
}
.poster {
  width: 180px;
  height: auto;
  object-fit: contain;
}

.button {
  position: relative;
  padding: 1em 1.5em;
  border: none;
  background-color: transparent;
  cursor: pointer;
  outline: none;
  font-size: 18px;
  margin: 1em 0.8em;
}
.button.type1 {
  color: rgb(255, 255, 255);
}
.button.type1.type1::after,
.button.type1.type1::before {
  content: "";
  display: block;
  position: absolute;
  width: 20%;
  height: 20%;
  border: 2px solid;
  transition: all 0.6s ease;
  border-radius: 2px;
}
.button.type1.type1::after {
  bottom: 0;
  right: 0;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: blueviolet;
  border-right-color: blueviolet;
}
.button.type1.type1::before {
  top: 0;
  left: 0;
  border-bottom-color: transparent;
  border-right-color: transparent;
  border-top-color: blueviolet;
  border-left-color: blueviolet;
}
.button.type1.type1:hover:after,
.button.type1.type1:hover:before {
  width: 100%;
  height: 100%;
}
.episode {
  cursor: pointer;
}
.label_genres {
  margin: 5px;
}
.genres {
  margin: 5px;

  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.genre {
  background-color: floralwhite;
  color: blueviolet;
  width: auto;
  border-radius: 20px;
  margin-left: 3px;
  margin-right: 3px;
  padding: 2px;
}
</style>
