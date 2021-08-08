<template>
  <div>
   
    <!-- header with search -->
    <header-component></header-component>
<div class="wrapper">
		<div class="main-setting">
			<div class="container">
				<div class="row">
					
					<div class="col-xl-9 col-lg-8 col-md-12">
						<div class="event-card rrmt-30">
							<div class="headtte14m item-setting-top">
								<span class="color_bb"><i class="fas fa-user"></i></span>
								<h4>Basic</h4>
								
							</div>
							<div class="item-setting">
								<div class="item-padding30 main-form">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<div class="form_group mt-30">
												<label class="label25">Name*</label>

												<input
                        v-model="name"
                         class="form_input_1" type="text"
                         >
                         
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form_group mt-30">
												<label class="label25">Surname*</label>
												<input
                        v-model="surname"
                         class="form_input_1" type="text" >
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form_group mt-30">
												<label class="label25">Gender*</label>
												<select class="selectpicker" title="Select Gender" v-model="gender">
													<option value="male" selected>Male</option>
													<option value="female">Female</option>
													<option value="other">Other</option>
												</select>
											</div>
										</div>
                     								

										<div class="col-lg-12 col-md-12">
											<div class="form_group mt-30">
												<label class="label25">About*</label>
												<textarea
                        v-model="about"
                         class="form_textarea_1" placeholder="">
                         </textarea>
											</div>
										</div>
									
									</div>
								</div>
								<div class="save-change-btns">
									<button @click="updateProfile" class="main-save-btn color btn-hover">Save Changes</button>
								</div>
							</div>
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
import SideView from './SideView.vue'
import ProfileView from './ProfileView.vue'
import PostDetail from './PostDetail.vue'
export default {
  components:{
    SideView,
    ProfileView,
    PostDetail
  }, 
  data: function(){
    return {
      name: "",
      surname : "",
      gender : "",
      email : "",
      about : "",
      userData : []

      
    }
  },
  methods: {
    getUserData(){
       axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
    let slug = this.$route.params.slug;
       axios.get(`api/user/${slug}/data`)
          .then(response =>{
           
              this.userData = response.data;
               //console.log(this.userData);
              this.name = this.userData.name;
              this.surname = this.userData.surname;
              this.gender = this.userData.gender;
              this.about = this.userData.about;
             
          })
          .catch(error => { 
              console.log(error);
              }); 
              }); 
    },
    updateProfile(){
      let slug = this.$route.params.slug;
     axios.get("/sanctum/csrf-cookie").then((response) => {
      axios
        .post(`api/user/${slug}/update`, {
        name: this.name,
        surname: this.surname,
        gender: this.gender,
        about: this.about,
        })
        .then((response) => {
        
        })
        .catch((error) => {
          console.log(error);
        });
    })
    }
  },
  created(){
      this.getUserData();
  }

};
</script>