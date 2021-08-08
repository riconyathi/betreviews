<template>
  <div>
    
    <!-- header with search -->
    <header-component></header-component>

    <div class="wrapper pt-0">
      <!-- cover main page  -->
      <group-cover :groupDetails="groupDetails"></group-cover>
      <group-side-view :groupDetails="groupDetails"></group-side-view>

      <group-settings-main :groupDetails="groupDetails"></group-settings-main>
      
    </div>
   

<footer-component></footer-component>
  </div>
</template>

<script>
import GroupCover from './GroupCover.vue'
import GroupSideView from './GroupSideView.vue'
import ProfileView from './ProfileView.vue'
import GroupSettingsMain from './GroupSettingsMain.vue'

export default {
  components:{
    ProfileView,
    GroupCover,
    GroupSettingsMain,
    GroupSideView
  }, 
  data: function(){
    return {
      groupDetails : []
    }
  },
  methods: {
    getGroupDetails() {
      this.slug = this.$route.params.slug;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios;
        axios
          .get(`api/group/${this.slug}`)
          .then((response) => {
            console.log(response.data);
            this.groupDetails = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },

  },
  created(){
    this.getGroupDetails();
  }

};
</script>