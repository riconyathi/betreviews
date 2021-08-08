<template>
  <div>
    <div class="popup-wrapper2">
      <div class="popup post-sharing">
        <span class="popup-closed"><i class="far fa-window-close"></i></span>
        <div class="popup-meta">
          <div class="popup-head">
            <h4>Share Post</h4>
          </div>
          <div class="popup-body">
            <div class="post-share-category share145l">
              <label
                ><input
                  type="radio"
                  name="colorRadio"
                  value="feed"
                  checked=""
                /><span>Share in your feed</span></label
              >
              <label
                ><input type="radio" name="colorRadio" value="page" /><span
                  >Share in a page</span
                ></label
              >
              <label
                ><input type="radio" name="colorRadio" value="group" /><span
                  >Share in a group</span
                ></label
              >
              <label
                ><input type="radio" name="colorRadio" value="message" /><span
                  >Share in message</span
                ></label
              >
              <div class="feed share-box"></div>
              <div class="page share-box">
                <input
                  class="form_input"
                  type="text"
                  placeholder="Please type the page name"
                />
              </div>
              <div class="group share-box">
                <input
                  class="form_input"
                  type="text"
                  placeholder="Please type the group name"
                />
              </div>
              <div class="message share-box">
                <input
                  class="form_input"
                  type="text"
                  placeholder="Please type the people name"
                />
              </div>
              <div class="comment-box">
                <textarea placeholder="Write something here.."></textarea>
              </div>
            </div>
            <div class="export-share">
              <h6>Export</h6>
              <ul class="social-share">
                <li>
                  <a href="#" class="fb" title="Facebook"
                    ><i class="fab fa-facebook-f"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="tw" title="Twitter"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="ln" title="LinkedIn"
                    ><i class="fab fa-linkedin-in"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="pin" title="Pinterest"
                    ><i class="fab fa-pinterest-p"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="wp" title="Whatsapp"
                    ><i class="fab fa-whatsapp"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="tl" title="Telegram"
                    ><i class="fab fa-telegram-plane"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="in" title="Instagram"
                    ><i class="fab fa-instagram"></i
                  ></a>
                </li>
                <li>
                  <a href="#" class="cpy" title="Copy Link"
                    ><i class="fas fa-link"></i
                  ></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="postbox">
            <div class="share-submit-btns">
              <button class="main-btn cancel" data-ripple="">Cancel</button>
              <button class="main-btn color btn-hover" data-ripple="">
                Share
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header with search -->
    <header-component></header-component>

    <div class="wrapper pt-0">
      <!-- cover main page  -->
      <cover-component :userData="userData"></cover-component>
      <side-view></side-view>
      <div class="dtpgusr12">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12">
              <profile-view></profile-view>
              
            </div>
           <!-- connections -->
           <followers-main></followers-main>
          </div>
        </div>
      </div>
    </div>

    <footer-component></footer-component>
  </div>
</template>

<script>
import SideView from "./SideView.vue";
import ProfileView from "./ProfileView.vue";
import FollowersMain from "./FollowersMain.vue";
export default {
  components: {
    SideView,
    ProfileView,
    FollowersMain,
  },
  data: function () {
    return {
      userData: [],
    };
  },
  methods: {
    getUserData() {
      axios
        .get("api/user/20")
        .then((response) => {
          console.log(response);
          this.userData = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getUserData();
  },
};
</script>