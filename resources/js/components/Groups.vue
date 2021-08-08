<template>
  <div>
    <div v-if="userToken" class="event-card mt-30">
      <div class="headtte14m">
        <span><i class="fas fa-users"></i></span>
        <router-link  :to="'/groups'">Groups </router-link>
        <div class="count-dt">{{groups.length}}</div>
      </div>
      <div class="panel-photos">
        <div class="row g-0">
         
          <div  v-for="group in groups" :key="group.id" class="col-lg-4 col-md-3 col-3">
            <div class="circled-user-box">
              <router-link  v-bind:to="'/group-details/'+group.slug" >
                <img
                v-if="group.profile.length > 0"
                 :src="groupProfile+group.profile[group.profile.length-1].path" alt="" />
                <div class="name-user">{{group.name}}</div>
              </router-link>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
   data: function () {
    return { groups: [],groupProfile : "/storage/groupprofile/", userToken: ""}
  },
  methods: {
      getGroups(){
        this.userToken = this.$store.get('user-token');
        if(this.userToken){
         axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
         
          axios.get('api/groups')
          .then(response =>{
              this.groups = response.data;
             
             
          })
          .catch(error => { 
              console.log(error);
              });
        });
      }
    }
  },
  created(){
     this.getGroups();
  }
}
</script>