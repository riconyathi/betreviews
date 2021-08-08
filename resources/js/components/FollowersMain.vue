<template>
  <div class="col-xl-9 col-lg-8 col-md-12">
    <div class="headtte14m rrmt-30 box-shadow_main">
      <span><i class="fas fa-users"></i></span>
      <h4>Connections</h4>
    </div>
    <div class="product-items-list pl_item_search mt-35">
      <!-- connections links -->
      <connection-links></connection-links>
      <div class="following-followrs-list">
        <div class="row">
 
          <div v-for="user in users" :key="user.id" class="col-xl-4 col-lg-6 col-md-6">
            <div class="ppuser-card mt-30">
              <div class="ppuser-img">
                <img
                  class="ft-plus-square job-bg-circle bg-cyan me-0"
                  src="images/left-imgs/img-8.jpg"
                  alt=""
                />
              </div>
              <a href="#" class="job-heading text-center">{{user.user.name}}</a>
              <p class="notification-text font-small-4 text-center pt-2">
                <span class="job-loca">
                  <i class="fas fa-location-arrow"></i>
                  <ins class="state-name">Ludhiana,</ins> India
                </span>
              </p>
              <button @click="follow(user.user.id)" class="act-btn btn-hover" type="button">
                <i class="fas fa-plus me-2"></i>Follow
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ConnectionLinks from "./ConnectionLinks.vue";

export default {
  components: {
    ConnectionLinks,
  },
  data: function () {
    return { users: [] };
  },

  methods: {
     getUsers() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
      axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
     axios
        .get("api/followers")
        .then((response) => {

          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
        });
    },
     follow: function (id) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
      axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
      axios
        .post("api/follow",{
          following_id : id
        })
        .then((response) => {

        alert(response.data.message);
        })
        .catch((error) => {
          console.log(error);
        });
      
      })
    }
  },
  created() {
    this.getUsers();
  },
};
</script>
    