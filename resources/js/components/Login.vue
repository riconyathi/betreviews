<template>
  <div>
    <div class="form-wrapper">
      <div class="app-form">
        <div class="app-form-sidebar">
          <div class="sign-logo">
            <img  style="width:100px;" src="images/logo_2.jpg" alt="" />
          </div>
          <div class="sign_sidebar_text">
            <h1>
              Bet Zone
            </h1>
          </div>
        </div>
        <div class="app-form-content">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-10 col-md-10">
                <div class="app-top-items">
                  <div class="app-top-left-logo">
                    <img src="images/logo.png" alt="" />
                  </div>
                  <div class="app-top-right-link">
                    New to Bet Reviews?<router-link to="/register"
                      >Sign Up</router-link
                    >
                  </div>
                </div>
              </div>
              <div class="col-xl-5 col-lg-6 col-md-7">
                <div class="registration">
                  <form @submit="login">
                    <h2 class="registration_title">Sign in to Bet Reviews</h2>
                    <div class="form_group mt-30">
                      <label class="label25">Your Email*</label>
                      <input
                        v-model="user.email"
                        class="reg_form_input_1"
                        name="email"
                        type="email"
                        
                      />
                    </div>
                    <div class="form_group mt-25">
                      <div class="field_password">
                        <label class="label25">Password*</label>
                        <!-- <a class="FieldPassword__link" href="forgot_password.html">Forgot Password?</a> -->
                      </div>
                      <div class="loc_group">
                        <input
                          v-model="user.password"
                          class="reg_form_input_1"
                          name="password"
                          type="password"
                          placeholder=""
                        />
                        <span class="pass_show_dt cursor"
                          ><i class="fas fa-eye-slash"></i
                        ></span>
                      </div>
                    </div>
                    <button class="btn-register btn-hover" type="submit">
                      Sign In <i class="fas fa-sign-in-alt ms-2"></i>
                    </button>
                  </form>

                  <div class="app_responsive_signup_link">
                    New to Bet Reviews?<router-link to="/register"
                      >Sign Up</router-link
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="register_footer mt-50">
            © 2021 Bet Reviews owned by Gambolthemes. All rights reserved
            <nav class="footer__links">
              <a href="#" class="footer__link" target="_blank">Terms of Use</a>
              <a href="#" class="footer__link" target="_blank"
                >Privacy Policy</a
              >
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
  data: () => ({
    user: {
      email: "",
      password: "",
    },
  }),

  methods: {
    login(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("api/login", {
            email: this.user.email,
            password: this.user.password,
          })
          .then((response) => {
            
            this.$store.set('user-token', response.data.token)
            this.$store.set('user-data', response.data.user)
      
            if (response.status == '201') {
             currentObj.$router.push('/');
           }
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
  },
};
</script>