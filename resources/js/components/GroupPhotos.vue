<template>
  <div>
    
    <!-- header with search -->
    <header-component></header-component>

    <div class="wrapper pt-0">
      <!-- cover main page  -->
      <group-cover></group-cover>
      <group-side-view></group-side-view>

      <group-photos-main></group-photos-main>
      
    </div>
   

<footer-component></footer-component>
  </div>
</template>

<script>
import GroupCover from './GroupCover.vue'
import GroupSideView from './GroupSideView.vue'
import ProfileView from './ProfileView.vue'
import GroupPhotosMain from './GroupPhotosMain.vue'

export default {
  components:{
    ProfileView,
    GroupCover,
    GroupPhotosMain,
    GroupSideView
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