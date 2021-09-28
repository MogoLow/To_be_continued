<template>
  <div>
    <Sidebar :log="bool" />
    <div id="container">
      <div id="User_box">
        <div id="avatar_box">
          <img v-bind:src="DataUser.member.avatar" alt="avatar" id="avatar" />
          <h3 id="pseudo">{{ DataUser.member.login }}</h3>
          <div id="User_info">
            <NuxtLink to="/friends" class="info">
              {{ DataUser.member.stats.friends }} amis
            </NuxtLink>

            <div class="info">
              {{ DataUser.member.stats.shows }} series / films suivie
            </div>
            <div class="info">{{ DataUser.member.xp }} XP</div>
            <div v-if="DataUser.member.valid_email == false" class="info">
              Email a valider
            </div>
            <div class="info">
              Membre depuis
              {{ DataUser.member.stats.member_since_days }} jours
            </div>
          </div>
        </div>
        <div class="followed_series">
          <div class="card_show" v-for="show in Shows" :key="show.item">
            <img
              @click="path('/One_series/' + show.id)"
              class="poster"
              :src="show.images.poster"
              alt="poster"
            />
            <div>
              <h3 class="title">{{ show.title }}</h3>
              <div v-if="show.user.next.code == 'S00E00'">
                <p>FINI!</p>
              </div>
              <div v-else>
                <h4>A voir :</h4>
                <p>
                  {{ show.user.next.title }}<br />
                  {{ show.user.next.code }}
                </p>
              </div>
              <input
                class="vu"
                @click="watched(show.user.next.id, true)"
                v-if="show.user.next.code != 'S00E00'"
                type="button"
                value="✔"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Profil",
  data() {
    return {
      bool: false,
      LocalData: {
        user: {},
      },
      DataUser: {
        member: {
          stats: {},
        },
      },
      Shows: {},
    };
  },
  methods: {
    path(path) {
      this.$router.push({
        path: path,
      });
    },
    watched(id, method) {
      fetch("http://localhost:8000/watched", {
        method: "POST",
        body: JSON.stringify({
          id: id,
          token: this.LocalData.token,
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
      fetch("http://localhost:8000/info_friend", {
        method: "POST",
        body: JSON.stringify({
          id: this.LocalData.user.id,
          token: this.LocalData.token,
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.info) {
            this.Shows = JSON.parse(response.series_followed).shows;
            this.DataUser = JSON.parse(response.content);
          } else {
            alert("Error get info user");
          }
        });
    },
  },

  beforeMount() {
    if (localStorage.getItem("user") != null) {
      this.bool = true;
    }
    if (localStorage.getItem("user")) {
      this.LocalData = JSON.parse(localStorage.getItem("user"));
    }

    this.start();
  },
};
</script>

<style >
@import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap");

* {
  margin: 0;
}
html {
  background: radial-gradient(ellipse at bottom, #2360aa 0%, #0c0d13 100%);
  background-repeat: no-repeat;
  width: 100%;
  height: 100%;
}

#container {
  color: #fff;
  margin-top: 60px;
  background-color: rgb(0, 0, 0);
  align-items: center;
  border-top: solid 2px #fff;
  border-bottom: solid 2px #fff;
}

#container:hover {
  border-top: solid 2px blueviolet;
  border-bottom: solid 2px blueviolet;
  transition: 1.5s;
}
#User_box {
  display: flex;
  align-items: center;
  flex-direction: row;
}
#avatar_box {
  border-right: solid 1px rgb(255, 255, 255);
  padding: 5%;
  align-content: center;
  align-items: center;
  height: 100%;
}
#avatar {
  width: 250px;
  height: auto;
  border-radius: 100%;
}
#User_info {
  margin: 10px;
  font-size: 20px;
  margin: 10px;
}
#pseudo {
  border-right: solid 1px blueviolet;
  font-size: 40px;
  text-align: center;
  margin-top: 10px;
  border-bottom: solid 1px blueviolet;
}
.followed_series {
  width: auto;
  margin: 2%;
  padding: 2%;
  overflow-x: scroll;
  display: flex;
  flex-direction: row;
  scrollbar-color: blueviolet black;
}
.card_show {
  border: solid 2px blueviolet;
  border-radius: 10px;
  margin: 2%;
  padding: 2%;
  width: 250px;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.title {
  font-family: "Bebas Neue", cursive;
  color: white;
  margin-top: 0;
  font-weight: 800;
  font-size: 1.8em;
  letter-spacing: 0.01em;
  padding: 5px;
  border-bottom: solid 2px #535480;
}

.poster {
  width: 180px;
  height: auto;
  object-fit: contain;
  cursor: pointer;
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

.vu:active {
  background-color: rgb(167, 224, 175);
}
</style>
