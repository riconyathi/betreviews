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
            <!-- main content -->
             <main
              class="
                col col-xl-6
                order-xl-2
                col-lg-12
                order-lg-1
                col-md-12 col-sm-12 col-12
              "
            >
              
            <post-detail></post-detail>
            </main>
            <aside
              class="
                col col-xl-3
                order-xl-1
                col-lg-6
                order-lg-1
                col-md-6 col-sm-12 col-12
              "
            >
             
              <!-- profile user -->
              <!-- <profile-view></profile-view> -->
              
            </aside>
            <aside
              class="
                col col-xl-3
                order-xl-3
                col-lg-6
                order-lg-3
                col-md-6 col-sm-12 col-12
              "
            >
            <!-- connections -->
            <!-- <connections-component></connections-component> -->

             <!-- groups -->
             <groups-component></groups-component>
            </aside>
          </div>
        </div>
      </div>
    </div>

<footer-component></footer-component>
  </div>
</template>

<script>
import SideView from './SideView.vue'
import ProfileView from './ProfileView.vue'
import PostDetail from './PostDetail.vue'
export default {
  components:{
    SideView,
    ProfileView,
    PostDetail
  }, 
  data: function(){
    return {
      userData : []
    }
  },
  methods: {
    getUserData(){
       axios.get('api/user/20')
          .then(response =>{
            console.log(response);
              this.userData = response.data;
             
          })
          .catch(error => { 
              console.log(error);
              }); 
    }
  },
  created(){
      this.getUserData();
  }

};
</script>