<template>
  <div>
    
    <!-- header with search -->
    <header-component></header-component>

    <div class="wrapper pt-0">
      

      <div class="dtpgusr12">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-12">
              <div class="item-setting-tabs">
                <div
                  class="nav flex-column nav-pills"
                  id="v-pills-tab"
                  role="tablist"
                  aria-orientation="vertical"
                ></div>
              </div>
            </div>
            <div class="col-lg-8 col-md-12">
              <div class="tab-content" id="v-pills-tabContent-pageJobs">
                <div
                  class="tab-pane fade show active"
                  id="v-pills-group-setting"
                  role="tabpanel"
                  aria-labelledby="v-pills-group-setting-tab"
                >
                  <div class="event-card">
                    <div class="headtte14m item-setting-top">
                      <span class="color_bb"><i class="fas fa-cog"></i></span>
                      <h4>Create Group</h4>
                    </div>
                    <div class="item-setting">
                      <div class="item-padding30 main-form">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form_group mt-30">
                              <label class="label25">Group Name*</label>
                              <input
                              v-model="groupName"
                                class="form_input_1"
                                type="text"
                                placeholder="Group Name Here"
                                value=""
                              />
                            </div>
                            <div class="form_group mt-30">
                              <label class="label25">About*</label>
                               <textarea
                                v-model="about"
                                class="add-post-textarea"
                                
                              ></textarea>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="save-change-btns">
                        <button @click="createGroup" class="main-save-btn color btn-hover">
                          Save 
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="v-pills-group-privacy"
                  role="tabpanel"
                  aria-labelledby="v-pills-group-privacy-tab"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer-component></footer-component>
  </div>
</template>

<script>
import GroupCover from "./GroupCover.vue";
import GroupSideView from "./GroupSideView.vue";
import ProfileView from "./ProfileView.vue";
import GroupSettingsMain from "./GroupSettingsMain.vue";

export default {
  components: {
    ProfileView,
    GroupCover,
    GroupSettingsMain,
    GroupSideView,
  },
   data() {
    return {
      
      groupName: "",
      token: '',
      about : ""
      
    };
  },
  methods: {
    createGroup() {
      
     
     this.token = this.$store.get('user-token');
     let form = new FormData();
      
      
          
      form.append('name',this.groupName);
      form.append('about',this.about);
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
       
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }
        axios
          .post(`api/create/group`,form,headers)
          .then((response) => {
            console.log(response.data);
            if (response.status == 200) {
              this.groupName = "";
              this.about = "";
              console.log('Group created succesfuly');
            }
          })
          .catch(function (error) {
            
            console.log(error);
          });
      });
    },
  },
};
</script>