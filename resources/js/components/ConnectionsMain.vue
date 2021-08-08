<template>
  <div class="col-xl-9 col-lg-8 col-md-12">
    <div class="headtte14m rrmt-30 box-shadow_main">
      <span><i class="fas fa-users"></i></span>
      <h4>Connections</h4>
    </div>
    <div class="product-items-list pl_item_search mt-35">
      <!-- connections links -->
      <connection-links></connection-links>
      <div class="full-width mt-30 mb-30">
        <div class="recent-items">
          <div v-for="user in users" :key="user.id" class="jobs-list">
            <div class="media invite125 d-md-flex">
              <div class="job-left">
                <img
                  class="ft-plus-square job-bg-circle bg-cyan me-0"
                  src="images/left-imgs/img-12.jpg"
                  alt=""
                />
              </div>
              <div class="media-body">
                <a href="#" class="job-heading pt-0 mb_5">{{user.user.name}}</a>
                <p class="notification-text font-small-4">
                  <a href="#" class="cmpny-dt">{{user.user.email}}</a>
                  <span class="job-loca"
                    ><i class="fas fa-location-arrow"></i
                    ><ins class="state-name">Delhi,</ins> India</span
                  >
                  <span class="cnttme125">{{user.created_at}}</span>
                </p>
              </div>
              <div class="media-btns">
                <router-link class="accpt-btn btn-hover accpt-btn-clr" v-bind:to="'/chat/'+user.id">
                  Message
                </router-link>
                <button
                  type="button"
                  class="rcancel-btn remove_connection"
                  title="Remove Connection"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="loading-btn">
        <button class="process-btn btn-hover" type="button">
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          Loading...
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import ConnectionLinks from './ConnectionLinks.vue';

export default {
   components:{
     ConnectionLinks
   }, 
  data: function () {
    return { users : [] };
  },

  methods: {
    getUsers() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
      axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
      axios
        .get("api/all-connections")
        .then((response) => {
          // console.log(response.data);
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
      });
    },
  },
  created() {
    this.getUsers();
  },
};
</script>
    