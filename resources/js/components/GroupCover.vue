<template>
  <div class="main-background-cover breadcrumb-pt">
    <div
      class="banner-user"
      style="background-image: url(images/banners/bg-1.jpg)"
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

                     <img v-if="groupDetails.profile.length > 0" :src="imageUrl+groupDetails.profile[groupDetails.profile.length-1].path" style="width:100px" alt="User-Avatar" />
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
                    <h3 class="item-user-title">{{groupDetails.name}}</h3>
                    
                    <div class="item-total-likes-followers">
                      <i class="fas fa-users"></i><span>{{groupDetails.users_count}}</span>Members
                    </div>
                    <!-- <ul class="user-meta-btns">
                      <li>
                        <a
                          href="my_group_setting.html"
                          class="profile-edit-btn btn-hover"
                          ><i class="fas fa-edit me-2"></i>Edit</a
                        >
                      </li>
                    </ul> -->
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
  props: ["groupDetails"],
    data: ()=> {
    return {
      
      imageUrl : "/storage/groupprofile/"
    }

  },

  methods:{
     handleFileUpload(e) {
      let slug = this.$route.params.slug;
       

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
        
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }
        axios
          .post(`api/group/${slug}/cover`,form,headers)
          .then((response) => {
            console.log(response.data);
            if (response.status == 200) {
             
              document.getElementById('avatar__input--source').value = "";
              // console.log(response);
            }
          })
          .catch(function (error) {
            
            console.log(error);
          });
      });
     
     
    },
  }
};
</script>