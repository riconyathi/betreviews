<template>
    <div>
        <div class="form-wrapper">
			<div class="app-form">
				<div class="app-form-sidebar">
					<div class="sign-logo">
						<img style="width:100px;" src="images/logo_2.jpg" alt="">
					</div>
					<div class="sign_sidebar_text">
						<h1>BETREVIEWS</h1>
					</div>
				</div>
				<div class="app-form-content">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-10 col-md-10">
								<div class="app-top-items">
									<div class="app-top-left-logo">
										<img  width="20rem" src="images/logo_2.jpg" alt="">
									</div>
									<div class="app-top-right-link">
										Already have an account?<router-link to="/login">login</router-link>
									</div>
								</div>
							</div>
							<div class="col-xl-5 col-lg-6 col-md-7">
								<div class="registration">
									<form @submit="register">
										<h2 class="registration_title">Sign up to BetReviews</h2>
										<div class="form_group mt-30">
											<label class="label25">Name*</label>
											<input class="reg_form_input_1" v-model="name" type="text" placeholder="">
										</div>
										<div class="form_group mt-30">
											<label class="label25">Surname*</label>
											<input class="reg_form_input_1" v-model="surname" type="text" placeholder="">
										</div>
										<div class="form_group mt-25">
											<label class="label25">Your Email*</label>
											<input class="reg_form_input_1" v-model="email" type="email" placeholder="" >
										</div>
										<div class="form_group mt-25">
											<label class="label25">Create Password*</label>
											<div class="loc_group">
												<input class="reg_form_input_1" v-model="password" type="password" placeholder="">
												<span class="pass_show_dt cursor"><i class="fas fa-eye-slash"></i></span>
											</div>
										</div>
										<div class="form_group mt-25">
											<label class="label25">Confirm Password*</label>
											<div class="loc_group">
												<input class="reg_form_input_1" v-model="password_confirmation" type="password" placeholder="">
												<span class="pass_show_dt cursor"><i class="fas fa-eye-slash"></i></span>
											</div>
										</div>
										<!-- <div class="signup_check_checkbox mt-30">
											<input type="checkbox" id="google_analytics_check">
											<label for="google_analytics_check">I agree to the <a href="#">Privacy Policy</a> and <a href="#">Terms and Conditions</a></label>
										</div> -->
										<button class="btn-register btn-hover" type="submit" >Create Account</button>
									</form>
<!-- 									
									
										
											<button @click="AuthProvider('facebook')">auth Facebook</button>
											<button @click="AuthProvider('google')">auth Google</button>
											<button @click="AuthProvider('twitter')">auth Twitter</button>
										> -->

										Already have an account?<a class="SidebarRegister__link" href="sign_in.html">Sign In</a>
									
								</div>
							</div>
						</div>
					</div>
					<div class="register_footer mt-50">
						© 2021 BetReviews. All rights reserved
						<nav class="footer__links">
							<a href="#" class="footer__link" target="_blank">Terms of Use</a>
							<a href="#" class="footer__link" target="_blank">Privacy Policy</a>
							<a href="#" class="footer__link" target="_blank">Refund Policy</a>
							<a href="#" class="footer__link" target="_blank">About</a>
							<a href="#" class="footer__link" target="_blank">Contact Us</a>
						</nav>
					</div>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
	  name: "",
	  surname: "",
      email: "",
      password: "",
	  password_confirmation: "",
    };
  },

  methods: {
    register(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get("/sanctum/csrf-cookie").then((response) => {
      axios
        .post("api/register", {
		  name: this.name,
		  surname: this.surname,
          email: this.email,
          password: this.password,
		password_confirmation: this.password_confirmation
        })
        .then((response) => {
          console.log(response);
          //change status response on json api
           if (response.status == '200') {
            this.$store.set('user-token', response.data.token)
            this.$store.set('user-data', response.data.user)
			
             currentObj.$router.push('/');
          
           }
        })
        .catch((error) => {
          console.log(error);
        });
    })
},
   methods: {

            AuthProvider(provider) {

              var self = this

              this.$auth.authenticate(provider).then(response =>{

                self.SocialLogin(provider,response)

                }).catch(err => {
                    console.log({err:err})
                })

            },

            SocialLogin(provider,response){

                this.$http.post('/sociallogin/'+provider,response).then(response => {

                    console.log(response.data)

                }).catch(err => {
                    console.log({err:err})
                })
            },

        }
  }
};
</script>