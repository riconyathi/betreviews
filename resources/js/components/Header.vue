<template>
  <div>
    <header class="header clearfix">
      <div class="header-inner">
        <nav
          class="
            navbar navbar-expand-lg
            bg-micko
            micko-head
            justify-content-sm-start
            micko-top
            pt-0
            pb-0
          "
        >
          <div class="container">
            <button class="navbar-toggler align-self-start" type="button">
              <span class="navbar-toggler-icon"
                ><i class="fas fa-bars"></i
              ></span>
            </button>
            <a
              class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 me-auto"
              href="/"
            >
              <div class="res_main_logo">
                <img src="images/res-logo.png" alt="" />
              </div>
              <div class="main_logo" id="logo">
                <img style="width: 60px" src="images/logo_2.jpg" alt="" />
                <img class="logo-inverse" src="images/dark-logo.png" alt="" />
              </div>
            </a>
            <form class="search-form-header order-lg-0 order-md-1 order-md-0">
              <input
                class="search-form-control"
                type="search"
                placeholder="Search..."
                aria-label="Search"
              />
              <button class="search-btn btn-color btn-hover">
                <i class="fas fa-search"></i>
              </button>
            </form>
            <div
              class="
                collapse
                navbar-collapse
                bg-micko-nav
                p-3 p-lg-0
                mt-6 mt-lg-0
                d-flex
                flex-column flex-lg-row flex-xl-row
                justify-content-lg-end
                mobileMenu
              "
              id="navbarSupportedContent"
            ></div>

            <div v-if="logged != null" class="msg-noti-acnt-section order-2">
              <ul class="mn-icons-set align-self-stretch">
                <!-- <li class="mn-icon">
                  <a class="mn-link" href="messages.php" role="button">
                    <i class="fas fa-envelope"></i>
                    <div class="alert-circle"></div>
                  </a>
                </li>
                <li class="mn-icon">
                  <a
                    class="mn-link"
                    href="all_notifications.html"
                    role="button"
                  >
                    <i class="fas fa-bell"></i>
                    <div class="alert-circle"></div>
                  </a>
                </li> -->

                <li class="mn-icon dropdown dropdown-account">
                  <a
                    href="#"
                    class="opts_account"
                    role="button"
                    data-bs-toggle="dropdown"
                  >
                    <img src="images/left-imgs/img-1.jpg" alt="" />
                    <i class="fas fa-caret-down arrow-icon"></i>
                  </a>
                  <ul
                    class="
                      dropdown-menu dropdown-menu-account dropdown-menu-end
                    "
                  >
                    <li class="media-list">
                      <div class="media">
                        <div class="media-left">
                          <img
                            class="ft-plus-square icon-bg-circle bg-cyan mr-0"
                            src="images/logo_2.jpg"
                            alt=""
                          />
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading text-16">
                            {{ userData.name }}
                          </h6>
                          <p class="email-text font-small-3">
                            {{ roles }}
                            
                          </p>
                          <router-link
                            class="view-p-link font-small-4"
                            v-bind:to="'/user-profile/'+userData.slug"
                          >
                            Profile
                          </router-link>
                          
                        </div>
                      </div>
                      <div class="night_mode_switch__btn">
                        <!-- <a href="#" id="night-mode" class="btn-night-mode">
                          <i class="far fa-moon"></i>Night mode
                          <span class="btn-night-mode-switch">
                            <span class="uk-switch-button"></span>
                          </span>
                        </a> -->
                      </div>
                    </li>
                    <li class="dropdown-menu-footer">
                      <a
                        @click="logout"
                        class="dropdown-item-link text-link text-center"
                        >Logout</a
                      >
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <div v-else>
              <ul class="mn-icons-set align-self-stretch">
                <li class="mn-icon">
                  <router-link class="mn-link" role="button" to="/login">
                    <!-- <i class="fas fa-sign-in-alt"></i> -->
                    
                    <div><i class="fas fa-sign-in-alt"></i></div>
                  </router-link>
                </li>
                <li class="mn-icon">
                  <router-link class="mn-link" role="button" to="/register">
                    <div><i class="fas fa-user-plus"></i></div>
                  </router-link>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="overlay"></div>
      </div>
    </header>
  </div>
</template>
<script>
// let token = JSON.parse(localStorage.getItem('user-token'));
// console.log(token);
export default {
  data: () => {
    return {
      isLoggedIn: "",
      role: "",
    };
  },
  computed: {
    userData: function () {
      return this.$store.get("user-data");
    },
    logged: function () {
      return this.$store.get("user-token");
    },
    roles: function () {
      let role = this.$store.get("user-data");

      return role.roles[0].name;
    },
  },
  methods: {
    logout() {
      this.isLoggedIn = this.$store.get("user-token");
      //console.log(this.isLoggedIn);
      if (this.$store.get("user-token") != null) {
        axios.get("/sanctum/csrf-cookie").then((response) => {
          //token user
          axios.defaults.headers.common["Authorization"] =
            "Bearer " + this.isLoggedIn;
          // axios.defaults.headers.common["'content-type'"] = `multipart/form-data`;
          axios
            .post("api/logout")
            .then((response) => {
              this.$store.remove("user-data");
              this.$store.remove("user-token");
              this.$router.push("/login");
            })
            .catch((error) => {
              console.log(error);
            });
        });
      }
    },
    checkUser() {
      console.log(this.isLoggedIn);
      this.isLoggedIn = this.$store.get("user-token");
    },
    created() {
      this.checkUser;
    },
  },
};
</script>