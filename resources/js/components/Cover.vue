<template>
  <div v-if="userToken">
    <div   class="main-background-cover breadcrumb-pt">
      <div
        class="banner-user"
        style="background-image: url(images/banners/bg-2.jpg)"
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="banner-item-dts">
                <!-- <div class="cover-bg-btn">
                  <input
                    class="uploadBtn-main-input"
                    name="cover"
                    type="file"
                    accept="image/x-png, image/jpeg"
                    id="cover__input--source"
                  />
                  <label for="cover__input--source"
                    ><i class="fas fa-camera"></i><span>Cover</span></label
                  >
                </div> -->
                <div class="banner-content">
                  <div class="banner-media">
                    <div class="item-profile-img">
                      <img v-if="userData.profile.length > 0" :src="imageUrl+userData.profile[userData.profile.length-1].path" style="width:100px" alt="User-Avatar" />
                      <div class="avatar-btn">
                        <input
                          class="uploadBtn-main-input"
                          name="cover"
                           
                           ref="files"
                           @change="handleFileUpload"
                          type="file"
                          accept="image/x-png, image/jpeg"
                          id="avatar__input--source"
                        />
                        <label for="avatar__input--source"
                          ><i class="fas fa-camera"></i
                        ></label>
                      </div>
                    </div>
                    <div class="banner-media-body">
                      <h3 class="item-user-title">{{userData.name}}</h3>
                      <div class="item-username">{{userData.email}}</div>
                      <div class="profile-rating-section">
                      
                      </div>
                      <!-- <div class="item-total-link-group">
                        <div class="item-total-product-links">
                          <a
                            href="my_manage_jobs.html"
                            class="myprofle-item-links"
                            >Followers<span class="badge-alert">{{loggedUser.followers_count}}</span></a
                          >
                          <a
                            href="my_portfolio.html"
                            class="myprofle-item-links"
                            >Following<span class="badge-alert">5</span></a
                          >
                          <a href="my_courses.html" class="myprofle-item-links"
                            >Groups<span class="badge-alert">{{loggedUser.groups_count}}</span></a
                          >
                        </div>
                      </div> -->
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: ()=> {
    return {
      loggedUser: "",
      image : "",
      imageUrl : "/storage/userprofile/",
      userToken: ""
    }

  },
  computed : {

    userData: function () {
      return this.$store.get('user-data')
    },
    logged: function () {
      return this.$store.get('user-token')
    }
  },
  methods: {
    getUserData() {
      let userId = this.$store.get('user-data');
      this.userToken = this.$store.get('user-token');
      let id = userId.id;
      axios
        .get(`api/user/${id}`)
        .then((response) => {
          
          this.loggedUser = response.data;

          
        })
        .catch((error) => {
          console.log(error);
        });
    },
       handleFileUpload(e) {
      let user = this.$store.get('user-data');
      let id = user.id;

     if(e.target.files.length === 0){
       return;
     }
    
       this.image = this.$refs.files.files[0];

     this.token = this.$store.get('user-token');
     let form = new FormData();
     
       let file =  this.image;

       form.append('files',file);
      
      
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
        // axios.defaults.headers.common["content-type"] = `multipart/form-data`;
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }
        axios
          .post(`api/user/${id}`,form,headers)
          .then((response) => {
            console.log(response.data);
            if (response.status == 200) {
             
              document.getElementById('avatar__input--source').value = "";
              console.log(response);
            }
          })
          .catch(function (error) {
            
            console.log(error);
          });
      });
     
     
    },
    

},
created(){
  this.getUserData();
}
}
</script>