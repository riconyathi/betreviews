<template>
  <div>
    <div class="pages-dt-view">
      <div class="page-tabs">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <ul class="nav-tabs">
                <li class="nav-item">
                 <router-link class="nav-link"  v-bind:to="'/group-details/'+groupDetails.slug"><i class="fas fa-newspaper me-2"></i>Home</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link"  v-bind:to="'/group-members/'+groupDetails.slug"><i class="fas fa-user-friends me-2"></i>Members</router-link>
                </li>
                <li v-if="!member"  class="nav-item">
                  
                  <button class="nav-link" @click="joinGroup"  ><i class="fas fa-image me-2"></i>Join Group</button>
                </li>

                <li  class="nav-item">
                  <router-link class="nav-link"  v-bind:to="'/group-settings/'+groupDetails.slug"><i class="fas fa-users me-2"></i>Settings</router-link>
                </li>
                
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["groupDetails"],
  data(){
    return {
      member : "",
     
    }
  },

  methods:{
    joinGroup(){
      let slug = this.$route.params.slug;
        axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
         
          axios.post(`api/group/${slug}/join`)
          .then(response =>{
            console.log(response.data);
              
          })
          .catch(error => { 
              console.log(error);
              });
        });
    },
    isMember(){
    
      let slug = this.$route.params.slug;
        axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
         
          axios.get(`api/group/${slug}/is-member`)
          .then(response =>{
            this.member = response.data;
              
          })
          .catch(error => { 
              console.log(error);
              });
        });

    },
    
    
  },
    created(){
      this.isMember();
     
    }
  
}

</script>