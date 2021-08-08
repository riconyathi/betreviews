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
      <div class="main-setting">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12">
              <div class="event-card mb-0">
                <div class="noti-item-left">
                  <h4 class="all-noti-title-left">Notifications</h4>
                  <p class="all-noti-des-left">
                    You’re all caught up! Check back later for new notifications
                  </p>
                </div>
                <div class="noti-item-bottom">
                  <span>Improve your notifications</span>
                  <a href="setting_notification.html" target="_blank"
                    >Notification Setting</a
                  >
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-8 col-md-12">
              <div class="event-card rrmt-30">
                <div class="headtte14m item-setting-top">
                  <span class="color_bb"><i class="fas fa-bell"></i></span>
                  <h4>All Notifications</h4>
                  <span class="pull-refresh ms-3 btn-hover" title="refresh">
                    <i class="fas fa-redo-alt"></i>
                  </span>
                </div>
                <div class="notification-block">
                  <div class="nt-card nt-card-unread pl-24">
                    <div class="nt-card__left-rail">
                      <div class="nt-blue-dot">
                        <i class="fas fa-circle"></i>
                      </div>
                      <a href="#">
                        <div class="ivm-image-view-model">
                          <div class="presence-entity presence-entity--size-4">
                            <img
                              title="View Jassica William’s profile"
                              src="images/left-imgs/img-2.jpg"
                              loading="lazy"
                              alt=""
                              class="
                                presence-entity__image
                                nt-view-attr__img--centered
                              "
                            />
                            <div class="presence-entity__badge badge__online">
                              <span class="visually-hidden">
                                Status is online
                              </span>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="display-flex flex-column flex-grow-1 mt-1 mr-3">
                      <a class="nt-card__headline t-black t-normal" href="#">
                        <span
                          >Congratulate Jassica William for
                          <strong>starting a new position</strong> as Associate
                          Project Manager at Gambolthemes</span
                        >
                      </a>
                      <div class="display-flex mt3">
                        <div class="mr2">
                          <div>
                            <button
                              class="message-anywhere-button btn-hover"
                              type="button"
                            >
                              <span aria-hidden="true">Say congrats</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="
                        display-flex
                        flex-column
                        text-align-right
                        align-self-flex-start
                      "
                    >
                      <p class="nt-card__time-ago">24m</p>
                      <div class="nt-card__dropdown dropdown">
                        <a
                          href="#"
                          class="nt-card_dwn epsttdwn"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                        <ul
                          class="
                            dropdown-menu dropdown-event-optn dropdown-menu-end
                          "
                        >
                          <li class="media-list">
                            <div class="item channel_item">
                              <i class="fas fa-trash me-3"></i>Delete
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-times-circle me-3"></i>Unfollow
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-bell-slash me-3"></i>Turn Off
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="nt-card nt-card-unread pl-24">
                    <div class="nt-card__left-rail">
                      <div class="nt-blue-dot">
                        <i class="fas fa-circle"></i>
                      </div>
                      <a href="#">
                        <div class="ivm-image-view-model">
                          <div class="presence-entity presence-entity--size-4">
                            <img
                              title="View Rock William’s profile"
                              src="images/left-imgs/img-3.jpg"
                              loading="lazy"
                              alt=""
                              class="
                                presence-entity__image
                                nt-view-attr__img--centered
                              "
                            />
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="display-flex flex-column flex-grow-1 mt-1 mr-3">
                      <a class="nt-card__headline t-black t-normal" href="#">
                        <span>Rock William applied to your job request.</span>
                      </a>
                    </div>
                    <div
                      class="
                        display-flex
                        flex-column
                        text-align-right
                        align-self-flex-start
                      "
                    >
                      <p class="nt-card__time-ago">1h</p>
                      <div class="nt-card__dropdown dropdown">
                        <a
                          href="#"
                          class="nt-card_dwn epsttdwn"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                        <ul
                          class="
                            dropdown-menu dropdown-event-optn dropdown-menu-end
                          "
                        >
                          <li class="media-list">
                            <div class="item channel_item">
                              <i class="fas fa-trash mr-3"></i>Delete
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-bell-slash mr-3"></i>Turn Off
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="nt-card pl-24">
                    <div class="nt-card__left-rail">
                      <a href="#">
                        <div class="ivm-image-view-model">
                          <div class="presence-entity presence-entity--size-4">
                            <img
                              title="View Nav Verma’s profile"
                              src="images/left-imgs/img-5.jpg"
                              loading="lazy"
                              alt=""
                              class="
                                presence-entity__image
                                nt-view-attr__img--centered
                              "
                            />
                            <div class="presence-entity__badge badge__offline">
                              <span class="visually-hidden">
                                Status is offline
                              </span>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="display-flex flex-column flex-grow-1 mt-1 mr-3">
                      <a class="nt-card__headline t-black t-normal" href="#">
                        <span
                          >Nav Verma react your comment: "Congratulations! Nice
                          Work, GLWS :)".</span
                        >
                      </a>
                    </div>
                    <div
                      class="
                        display-flex
                        flex-column
                        text-align-right
                        align-self-flex-start
                      "
                    >
                      <p class="nt-card__time-ago">15h</p>
                      <div class="nt-card__dropdown dropdown">
                        <a
                          href="#"
                          class="nt-card_dwn epsttdwn"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                        <ul
                          class="
                            dropdown-menu dropdown-event-optn dropdown-menu-end
                          "
                        >
                          <li class="media-list">
                            <div class="item channel_item">
                              <i class="fas fa-trash me-3"></i>Delete
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-times-circle me-3"></i>Unfollow
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-bell-slash me-3"></i>Turn Off
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="nt-card pl-24">
                    <div class="nt-card__left-rail">
                      <a href="#">
                        <div class="ivm-image-view-model">
                          <div class="presence-entity presence-entity--size-4">
                            <img
                              title="View Shikha Chawla’s profile"
                              src="images/left-imgs/img-4.jpg"
                              loading="lazy"
                              alt=""
                              class="
                                presence-entity__image
                                nt-view-attr__img--centered
                              "
                            />
                            <div class="presence-entity__badge badge__offline">
                              <span class="visually-hidden">
                                Status is offline
                              </span>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="display-flex flex-column flex-grow-1 mt-1 mr-3">
                      <a class="nt-card__headline t-black t-normal" href="#">
                        <span
                          >It's <strong>Shikha Chawla</strong>'s birthday today.
                          Let her know that you're thinking about her!</span
                        >
                      </a>
                    </div>
                    <div
                      class="
                        display-flex
                        flex-column
                        text-align-right
                        align-self-flex-start
                      "
                    >
                      <p class="nt-card__time-ago">2d</p>
                      <div class="nt-card__dropdown dropdown">
                        <a
                          href="#"
                          class="nt-card_dwn epsttdwn"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                        <ul
                          class="
                            dropdown-menu dropdown-event-optn dropdown-menu-end
                          "
                        >
                          <li class="media-list">
                            <div class="item channel_item">
                              <i class="fas fa-trash me-3"></i>Delete
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-times-circle me-3"></i>Unfollow
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-bell-slash me-3"></i>Turn Off
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="nt-card pl-24">
                    <div class="nt-card__left-rail">
                      <a href="#">
                        <div class="ivm-image-view-model">
                          <div class="presence-entity presence-entity--size-4">
                            <img
                              title="View Sunil Rallhan’s profile"
                              src="images/left-imgs/img-7.jpg"
                              loading="lazy"
                              alt=""
                              class="
                                presence-entity__image
                                nt-view-attr__img--centered
                              "
                            />
                            <div class="presence-entity__badge badge__offline">
                              <span class="visually-hidden">
                                Status is offline
                              </span>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="display-flex flex-column flex-grow-1 mt-1 mr-3">
                      <a class="nt-card__headline t-black t-normal" href="#">
                        <span
                          ><strong>Sunil Rallhan</strong> tagged you and
                          <strong>48 others</strong> in a post: "All steel gate
                          profile gate ralling work ready in all Punjab". Review
                          now.</span
                        >
                      </a>
                    </div>
                    <div
                      class="
                        display-flex
                        flex-column
                        text-align-right
                        align-self-flex-start
                      "
                    >
                      <p class="nt-card__time-ago">2d</p>
                      <div class="nt-card__dropdown dropdown">
                        <a
                          href="#"
                          class="nt-card_dwn epsttdwn"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                        <ul
                          class="
                            dropdown-menu dropdown-event-optn dropdown-menu-end
                          "
                        >
                          <li class="media-list">
                            <div class="item channel_item">
                              <i class="fas fa-trash me-3"></i>Delete
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-times-circle me-3"></i>Unfollow
                            </div>
                            <div class="item channel_item">
                              <i class="fas fa-bell-slash me-3"></i>Turn Off
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="loading-btn noti-loading">
                  <button class="process-btn btn-hover" type="button">
                    <span
                      class="spinner-border spinner-border-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    Loading...
                  </button>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-12">
              <div class="full-width mb-30 dstp-bnr-dt">
                <div class="banner-item">
                  <div class="banner-img">
                    <img src="images/banners/banner-1.jpg" alt="" />
                    <div class="banner-overlay">
                      <span>Learning Plateform</span>
                      <h4>Keep learning in the moments that matter.</h4>
                      <button
                        class="main-btn color btn-hover"
                        onclick="window.location.href='all_learning.html';"
                      >
                        See Courses
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="full-width dstp-bnr-dt">
                <div class="banner-item">
                  <div class="banner-img">
                    <img src="images/banners/banner-2.jpg" alt="" />
                    <div class="banner-overlay">
                      <span>Digital Marketplace</span>
                      <h4 class="prtf-size">
                        295 WordPress Themes &amp; Website Templates From $5
                      </h4>
                      <button
                        class="main-btn color btn-hover"
                        onclick="window.location.href='all_products.html';"
                      >
                        See Products
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

    <footer-component></footer-component>
  </div>
</template>

<script>
import GroupCover from "./GroupCover.vue";
import GroupSideView from "./GroupSideView.vue";
import ProfileView from "./ProfileView.vue";
import GroupDetailsMain from "./GroupDetailsMain.vue";

export default {
  components: {
    ProfileView,
    GroupCover,
    GroupDetailsMain,
    GroupSideView,
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