<template>
  <div>
    <div v-if="userToken" class="event-card rrmt-30 lgmt-30">
      <div class="headtte14m">
        <span><i class="fas fa-users"></i></span>
        <a href="my_profile_connections.html">Connections</a>
        <div class="count-dt">{{length}}</div>
      </div>
      <div class="panel-photos">
        <div  class="row g-0">
          <div v-for="user in users" :key="user.id" class="col-lg-4 col-md-3 col-3">
            <div class="circled-user-box">
              <a href="#">
               
                <img src="images/left-imgs/img-11.jpg" alt="" />
                <div class="name-user">{{user.user.name}}</div>
              </a>
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
    return { users: [], length: '',userToken: "", imageUrl: "/storage/groupprofile/" }
  },
  methods: {
      getUsers(){
        this.userToken = this.$store.get('user-token');
         if(this.userToken){
        axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');

          axios.get('api/all-connections')
          .then(response =>{
              this.users = response.data;
              this.length = response.data.length;
                        
          })
          .catch(error => { 
              console.log(error);
              });
        });
      }
      }
  },
  created(){
   this.getUsers();
      
  }
}
</script>