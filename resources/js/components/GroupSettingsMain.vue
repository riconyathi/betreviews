<template>
  <div class="dtpgusr12">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <div class="item-setting-tabs">
            <div
            v-if="isAdmin"
              class="nav flex-column nav-pills"
              id="v-pills-tab"
              role="tablist"
              aria-orientation="vertical"
            >
              <a
              
                class="nav-link active"
                id="v-pills-group-setting-tab"
                data-bs-toggle="pill"
                href="#v-pills-group-setting"
                role="tab"
                aria-controls="v-pills-group-setting"
                aria-selected="true"
                ><i class="fas fa-cog me-3"></i>Group Settings</a
              >
             
              
              <a
                class="nav-link"
                id="v-pills-delete-group-tab"
                data-bs-toggle="pill"
                href="#v-pills-delete-group"
                role="tab"
                aria-controls="v-pills-delete-group"
                aria-selected="false"
                ><i class="fas fa-trash me-3"></i>Delete Page</a
              >
            </div>
            <div
            v-if="!isAdmin"
              class="nav flex-column nav-pills"
              id="v-pills-tab"
              role="tablist"
              aria-orientation="vertical"
            >
            <a
              
                class="nav-link active"
                id="v-pills-group-leave-tab"
                data-bs-toggle="pill"
                href="#v-pills-group-leave"
                role="tab"
                aria-controls="v-pills-group-leave"
                aria-selected="true"
                ><i class="fas fa-cog me-3"></i>Group Settings</a
              >
            </div>

          </div>
        </div>
        <div  class="col-lg-8 col-md-12">
          <div class="tab-content" id="v-pills-tabContent-pageJobs">
            <div
              class="tab-pane fade show active"
              id="v-pills-group-leave"
              role="tabpanel"
              aria-labelledby="v-pills-group-leave-tab"
            >
            test
            </div>
            <div
              class="tab-pane fade show active"
              id="v-pills-group-setting"
              role="tabpanel"
              aria-labelledby="v-pills-group-setting-tab"
            >
              <div class="event-card">
                <div class="headtte14m item-setting-top">
                  <span class="color_bb"><i class="fas fa-cog"></i></span>
                  <h4>Group Setting</h4>
                </div>
                <div class="item-setting">
                  <div class="item-padding30 main-form">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form_group mt-30">
                          <label class="label25">Group Name*</label>
                          <input
                            class="form_input_1"
                            type="text"
                            v-model="groupName"
                            
                          />
                          <span class="alt-text"
                            >(Please make this a maximum of 100 characters and
                            unique.)</span
                          >
                        </div>
                      </div>

                    
                      <div class="col-lg-12">
                        <div class="form_group mt-30">
                          <label class="label25">About*</label>
                          <textarea 
                          class="form_textarea_1" 
                           v-model="about">
                            
                             </textarea
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="save-change-btns">
                    <button @click="updateGroup"
                    class="main-save-btn color btn-hover">
                      Save Changes
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
           
            <div
              class="tab-pane fade"
              id="v-pills-delete-group"
              role="tabpanel"
              aria-labelledby="v-pills-delete-group-tab"
            >
              <div class="event-card">
                <div class="headtte14m item-setting-top">
                  <span class="color_bb"><i class="fas fa-trash"></i></span>
                  <h4>Delete Page</h4>
                </div>
                <div class="item-setting">
                  <div class="item-padding30">
                    <div class="alert alert-warning alert-action mt-30">
                      <div class="icon">
                        <i class="fa fa-exclamation-triangle fa-2x"></i>
                      </div>
                      <div class="text pt5">
                        Once you delete your group you will no longer can access
                        it again
                      </div>
                    </div>
               
                  </div>
                  <div class="save-change-btns">
                    <button v-if="isAdmin" @click="deleteGroup(groupDetails.id)" class="main-save-btn color btn-hover">
                      <i class="fas fa-trash mr-2"></i>Delete Page
                    </button>
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
data(){
  return  {  
    groupName : "",
    about : "",
    isAdmin : 0,
    groupDetails : []
  }

},
   methods:{
  getGroupInfo(){
      let slug = this.$route.params.slug;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .get(`api/group/${slug}`)
          .then((response) => {
            
            this.groupName = response.data.name;
            this.about = response.data.about;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
    updateGroup(){
      let slug = this.$route.params.slug;
     this.token = this.$store.get('user-token');
    
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
        
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }

        let form = new FormData();
        form.append('name',this.groupName);
        form.append('about',this.about);
        axios
          .post(`api/group/${slug}/update`,form,headers)
          .then((response) => {
            
          })
          .catch(function (error) {
            
            console.log(error);
          });
      });
    },
     checkIfAdmin(){
    
      let user = this.$store.get('user-data');
      
      if(user.roles[0].name == 'admin' ){  this.isAdmin = 1;} else {  this.isAdmin = 0 }
     
    },
    deleteGroup(id){
     if(confirm("Do you really want to delete?")){
       axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .delete(`api/group/${id}`)
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      });
     }
    },
     getGroupDetails() {
     let slug = this.$route.params.slug;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios;
        axios
          .get(`api/group/${slug}`)
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
      this.getGroupInfo();
      this.checkIfAdmin();
      this.getGroupDetails();
    }

 
};
</script>