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
              
            <main-component></main-component>
            </main>
           
            <aside
              class="
                col col-xl-3
                order-xl-3
                col-lg-6
                order-lg-3
                col-md-6 col-sm-12 col-12
              "
            >
           
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
export default {
  components:{
    SideView,
    ProfileView
  }, 
  data: function(){
    return {
      userData : []
    }
  },
  methods: {
    getUserData(){
       this.userData = this.$store.userData;
    }
  },
  created(){
      this.getUserData();
  }

};
</script>