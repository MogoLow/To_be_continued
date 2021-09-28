<template>
  <div class="contain">
    <Sidebar :log="bool" />
    <div class="friend_list">
      <h1>Friends list ! {{ DataUser.friends_list.users.length }}</h1>
      <div v-if="DataUser.friends_list.users.length != 0">
        <div v-for="friend in DataUser.friends_list.users" :key="friend.id">
          <div>
            <p>@{{ friend.login }}</p>
            <button @click="delete_friend(friend.id, false)">Delete</button>
            <button @click="blockORunblock_friend(friend.id, false)">
              Blocked
            </button>
          </div>
        </div>
      </div>
      <div v-else>
        <p>Sors de ta chambre et fais toi des amis bordel !</p>
      </div>
    </div>
    <div class="blocked_list">
      <h1>
        Blocked friends list {{ DataUser.blocked_friends_list.users.length }}
      </h1>
      <div
        v-for="friend in DataUser.blocked_friends_list.users"
        :key="friend.id"
      >
        <p>{{ friend.login }}</p>
        <button @click="blockORunblock_friend(friend.id, true)">
          Unblocked
        </button>
      </div>
    </div>
    <div class="serch">
      <div class="serch_bar">
        <input
          class="border_bot"
          id="login"
          type="text"
          name="login"
          v-model="input.login"
        />
        <input
          input
          type="submit"
          id="submit"
          value="SERCH"
          v-on:click="serchFriend"
        />
      </div>
      <div class="result_serch">
        <div v-if="condition">Pas membre</div>
        <div v-for="membre in membres" :key="membre.item">
          <div>
            <h4>@{{ membre.login }}</h4>
            <button @click="delete_friend(membre.id, true)">Add</button>
            <button @click="blockORunblock_friend(membre.id, true)">
              Block
            </button>
          </div>
        </div>
      </div>
    </div>
    <Background class="back" />
  </div>
</template>

<style  scoped>
.contain {
  display: flex;
  align-content: center;
  align-items: center;
  flex-direction: column;
  color: white;
}

.friend_list {
  padding: 5%;
  width: 60vw;
  border-radius: 15px;
}
.blocked_list {
  padding: 5%;
  width: 60vw;
  border-radius: 15px;
}
.back {
  z-index: -1;
}
</style>

<script>
export default {
  name: "Friends",
  data() {
    return {
      bool: false,
      LocalData: {},
      DataUser: {
        friends_list: {
          users: {},
          errors: {},
        },
        blocked_friends_list: {
          users: {},
          errors: {},
        },
      },
      input: {
        login: "",
      },
      membres: {},
      condition: "",
    };
  },
  methods: {
    delete_friend(id, method) {
      fetch("http://localhost:8000/addORremove_friend", {
        method: "POST",
        body: JSON.stringify({
          id: id,
          token: this.LocalData.token,
          method: method,
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.friend) {
            alert("BRAVO");
          } else {
            alert("Erreur");
          }
        });

      this.list_friend();
    },

    blockORunblock_friend(id, method) {
      fetch("http://localhost:8000/blockORunblock_friend", {
        method: "POST",
        body: JSON.stringify({
          id: id,
          token: this.LocalData.token,
          method: method,
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.block_friend) {
            alert("BRAVO");
          } else {
            alert("Erreur");
          }
        });

      this.list_friend();
    },

    list_friend() {
      if (localStorage.getItem("user")) {
        this.LocalData = JSON.parse(localStorage.getItem("user"));
      }
      fetch("http://localhost:8000/friends", {
        method: "POST",
        body: JSON.stringify({
          id: this.LocalData.user.id,
          token: this.LocalData.token,
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.friends) {
            this.DataUser.friends_list = JSON.parse(response.friends_list);
            this.DataUser.blocked_friends_list = JSON.parse(
              response.blocked_friends_list
            );
          } else {
            alert("Error get amis");
          }
        });
    },

    serchFriend() {
      this.condition = false;

      fetch("http://localhost:8000/find_friend", {
        method: "POST",
        body: JSON.stringify({
          login: this.input.login + "%",
        }),
      })
        .then((res) => res.json())
        .then((response) => {
          if (response.membre) {
            this.membres = JSON.parse(response.content).users;
            if (this.membres.length == 0) {
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

    this.list_friend();
  },
};
</script>

