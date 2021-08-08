<template>
  <div class="dtpgusr12">
    <div class="container">
      <div class="row">
        <main
          class="
           col-xl-9 col-lg-9 col-md-12
          "
        >
         
        <members :groupMembers="groupMembers"></members>
        </main>
        <aside
          class="
            col col-xl-3
            order-xl-1
            col-lg-3
            order-lg-1
            col-md-6 col-sm-12 col-12
          "
        >
        <group-info></group-info>
        </aside>
       
      </div>
    </div>
  </div>
</template>

<script>

import Members from './Members'
import GroupInfo from './GroupInfo'
export default {
  data: function(){
    return {
     
      groupMembers : []
      
    }
  },
    components:{
        Members,
        GroupInfo
    },
    methods:{
  getGroupMembers(){
      let slug = this.$route.params.slug;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .get(`api/group/${slug}/members`)
          .then((response) => {
            
            this.groupMembers = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    }
    
    },
    created(){
      this.getGroupMembers();
    }
    
}
</script>