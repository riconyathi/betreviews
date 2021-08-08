<template>
  <div>
   
    <!-- header with search -->
    <header-component></header-component>

    <div class="wrapper pt-0">
      <!-- cover main page  -->
      <cover-component :userData="userData"></cover-component>
      <side-view></side-view>
      <div class="dtpgusr12">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12">
              <profile-view></profile-view>
              
            </div>
           <!-- connections -->
           <photo-main></photo-main>
          </div>
        </div>
      </div>
    </div>

    <footer-component></footer-component>
  </div>
</template>

<script>
import SideView from "./SideView.vue";
import ProfileView from "./ProfileView.vue";
import PhotoMain from "./PhotoMain.vue";
export default {
  components: {
    SideView,
    ProfileView,
    PhotoMain,
  },
  data: function () {
    return {
      userData: [],
    };
  },
  methods: {
    getUserData() {
      axios
        .get("api/user/20")
        .then((response) => {
          console.log(response);
          this.userData = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getUserData();
  },
};
</script>