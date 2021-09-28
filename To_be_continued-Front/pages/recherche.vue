<template>
  <div>
    <Sidebar :log="bool" />
    <div>
      <div class="flexbox">
        <div class="search">
          <div>
            <input
              class="search"
              id="login"
              type="text"
              placeholder="Search . . ."
              v-model="input.recherche"
            />
            <input
              class="btnSearch"
              type="submit"
              id="submit"
              value="Rechercher"
              v-on:click="recherche()"
            />
          </div>
          <div class="container">
            <div v-if="condition">aucun resultat</div>
            <div class="result" v-else v-for="show in search" :key="show.item">
              <div class="card" @click="path('/One_series/' + show.id)">
                <div class="card__image-container" v-if="show.images">
                  <img class="card__image" :src="show.images.poster" alt="" />
                </div>

                <svg class="card__svg" viewBox="0 0 800 500">
                  <path
                    d="M 0 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 800 400 L 800 500 L 0 500"
                    stroke="transparent"
                    fill="#333"
                  />
                  <path
                    class="card__line"
                    d="M 0 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 800 400"
                    stroke="pink"
                    stroke-width="3"
                    fill="transparent"
                  />
                </svg>

                <div class="card__content">
                  <h1 class="card__title">{{ show.title }}</h1>
                  <br />
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Serch",
  data() {
    return {
      bool: false,
      input: {
        recherche: "",
      },
      search: {},
      condition: false,
    };
  },
  methods: {
    path(path) {
      this.$router.push({
        path: path,
      });
    },

    recherche() {
      this.condition = false;
      fetch("http://localhost:8000/recherche", {
        method: "POST",
        body: JSON.stringify({
          recherche: this.input.recherche + "%",
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.recherche) {
            this.search = JSON.parse(response.content).shows;
            if (this.search.length == 0) {
              this.condition = true;
            }
          } else {
            alert("ERROR !");
          }
        });
    },
  },
  mounted() {
    if (localStorage.getItem("user") != null) {
      this.bool = true;
    }
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");
@import url("https://fonts.googleapis.com/css2?family=Anton&display=swap");

* {
  padding: 0;
  margin: 0;
}
html {
  background: radial-gradient(ellipse at bottom, #2360aa 0%, #0c0d13 100%);
  background-repeat: no-repeat;
  width: 100%;
  height: 4000px;
}

img {
  height: 400px;
  margin-right: 190px;
}

.recherche {
  color: #fff;
  text-align: center;
  font-family: "Anton", sans-serif;
  letter-spacing: 5px;
}

.result {
  color: #fff;
}
.search {
  outline: none;
  background: none;
  height: 30px;
  text-align: center;
  border: none;
  color: #fff;
  font-size: 20px;
  margin-bottom: 20px;
}
.search::placeholder {
  color: #fff;
}
.btnSearch {
  outline: none;
  width: 100px;
  height: 20px;
  color: #fff;
  border: none;
  background: none;
  cursor: pointer;
  border-radius: 5px;
}
.btnSearch:hover {
  background: #fff;
  color: black;
  transition: 1.5s;
}

.container {
  display: grid;
  grid-template-columns: 2fr 2fr 2fr;
  margin: 30px;
  align-items: center;
  justify-content: center;
  margin-left: 100px;
}

.card {
  position: relative;
  background: #333;
  width: 400px;
  height: 75vh;
  border-radius: 6px;
  padding: 2rem;
  color: #aaa;
  box-shadow: 0 0.25rem 0.25rem rgba(0, 0, 0, 0.2), 0 0 1rem rgba(0, 0, 0, 0.2);
  overflow: hidden;
  margin: 20px;
  cursor: pointer;
}
.card__image-container {
  margin: -2rem -2rem 1rem -2rem;
}
.card__line {
  opacity: 0;
  animation: LineFadeIn 0.8s 0.8s forwards ease-in;
}
.card__image {
  opacity: 0;
  animation: ImageFadeIn 0.8s 1.4s forwards;
}
.card__title {
  color: white;
  margin-top: 0;
  font-weight: 800;
  letter-spacing: 0.01em;
}
.card__content {
  margin-top: -1rem;
  opacity: 0;
  animation: ContentFadeIn 0.8s 1.6s forwards;
}
.card__svg {
  position: absolute;
  left: 0;
  top: 115px;
}

@keyframes LineFadeIn {
  0% {
    opacity: 0;
    d: path(
      "M 0 300 Q 0 300 0 300 Q 0 300 0 300 C 0 300 0 300 0 300 Q 0 300 0 300 "
    );
    stroke: #fff;
  }
  50% {
    opacity: 1;
    d: path(
      "M 0 300 Q 50 300 100 300 Q 250 300 350 300 C 350 300 500 300 650 300 Q 750 300 800 300"
    );
    stroke: #888bff;
  }
  100% {
    opacity: 1;
    d: path(
      "M -2 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 802 400"
    );
    stroke: #545581;
  }
}
@keyframes ContentFadeIn {
  0% {
    transform: translateY(-1rem);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}
@keyframes ImageFadeIn {
  0% {
    transform: translate(-0.5rem, -0.5rem) scale(1.05);
    opacity: 0;
    filter: blur(2px);
  }
  50% {
    opacity: 1;
    filter: blur(2px);
  }
  100% {
    transform: translateY(0) scale(1);
    opacity: 1;
    filter: blur(0);
  }
}
</style>
