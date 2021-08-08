<template>
  <div>
    <div class="main-setting">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="full-width mb-0">
              <form class="message-sidebar">
                <div class="msg-top-left-items">
                  <div class="msg-search">
                    <i class="fas fa-search"></i>
                    <input
                      class="search_input_1 refund-textarea"
                      type="text"
                      placeholder="Search"
                      value=""
                    />
                  </div>
                  <div class="msg-create-btns">
                    <button
                      type="button"
                      class="btn-main btn-hover"
                      data-toggle="tooltip"
                      data-placement="top"
                      title=""
                      data-bs-original-title="Mark all conversations as read"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill="currentColor"
                          d="M14,10H2V12H14V10M14,6H2V8H14V6M2,16H10V14H2V16M21.5,11.5L23,13L16,20L11.5,15.5L13,14L16,17L21.5,11.5Z"
                        ></path>
                      </svg>
                    </button>
                    <button
                      type="button"
                      class="btn-main btn-hover create_group_chat"
                      data-toggle="tooltip"
                      data-placement="top"
                      title=""
                      data-bs-original-title="Create Group"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill="currentColor"
                          d="M13,13C11,13 7,14 7,16V18H19V16C19,14 15,13 13,13M19.62,13.16C20.45,13.88 21,14.82 21,16V18H24V16C24,14.46 21.63,13.5 19.62,13.16M13,11A3,3 0 0,0 16,8A3,3 0 0,0 13,5A3,3 0 0,0 10,8A3,3 0 0,0 13,11M18,11A3,3 0 0,0 21,8A3,3 0 0,0 18,5C17.68,5 17.37,5.05 17.08,5.14C17.65,5.95 18,6.94 18,8C18,9.06 17.65,10.04 17.08,10.85C17.37,10.95 17.68,11 18,11M8,10H5V7H3V10H0V12H3V15H5V12H8V10Z"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="msg-tabs">
                  <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        data-bs-toggle="pill"
                        href="#users-message"
                        role="tab"
                      >
                        <i class="fas fa-user me-2"></i>Users
                      </a>
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-bs-toggle="pill"
                        href="#groups-message"
                        role="tab"
                      >
                        <i class="fas fa-users me-2"></i>Groups
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content mt-30">
                    <div
                      class="tab-pane fade active show"
                      id="users-message"
                      role="tabpanel"
                    >
                      <div
                        class="
                          user-message-chat-list
                          mCustomScrollbar
                          _mCS_1
                          mCS-autoHide
                        "
                        style="
                          height: 435px;
                          position: relative;
                          overflow: visible;
                        "
                      >
                        <div
                          id="mCSB_1"
                          class="
                            mCustomScrollBox
                            mCS-minimal-dark
                            mCSB_vertical mCSB_outside
                          "
                          style="max-height: 435px"
                          tabindex="0"
                        >
                          <div
                            id="mCSB_1_container"
                            class="mCSB_container"
                            style="position: relative; top: 0; left: 0"
                            dir="ltr"
                          >
                            <div v-for="user in users" :key="user.id" class="user-recipients-list active">
                              <div class="recipient-avatar">
                                <img
                                  src="images/left-imgs/img-2.jpg"
                                  loading="lazy"
                                  alt=""
                                  class="
                                    presence-entity__image
                                    nt-view-attr__img--centered
                                    mCS_img_loaded
                                  "
                                />
                                <div
                                  class="presence-entity__badge badge__online"
                                >
                                  <span class="visually-hidden">
                                    Status is online
                                  </span>
                                </div>
                              </div>
                              <div class="msg-right-part">
                                <div class="msg-last-sent" title="1 w">15m</div>
                                <span class="user-recipient-name"
                                  >{{user.user.name}}</span
                                >
                                <p class="">
                                  contact me on my email address i sent to you
                                  so that i can tell you more about myself
                                </p>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div
                          id="mCSB_1_scrollbar_vertical"
                          class="
                            mCSB_scrollTools mCSB_1_scrollbar
                            mCS-minimal-dark
                            mCSB_scrollTools_vertical
                          "
                          style="display: block"
                        >
                          <div class="mCSB_draggerContainer">
                            <div
                              id="mCSB_1_dragger_vertical"
                              class="mCSB_dragger"
                              style="
                                position: absolute;
                                min-height: 0px;
                                display: block;
                              "
                            >
                              <div
                                class="mCSB_dragger_bar"
                                style="line-height: 0px"
                              ></div>
                            </div>
                            <div class="mCSB_draggerRail"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="groups-message"
                      role="tabpanel"
                    >
                      <div
                        class="
                          group-message-chat-list
                          mCustomScrollbar
                          _mCS_2
                          mCS-autoHide mCS_no_scrollbar
                        "
                        style="
                          height: 435px;
                          position: relative;
                          overflow: visible;
                        "
                      >
                        <div
                          id="mCSB_2"
                          class="
                            mCustomScrollBox
                            mCS-minimal-dark
                            mCSB_vertical mCSB_outside
                          "
                          style="max-height: 435px"
                          tabindex="0"
                        >
                          <div
                            id="mCSB_2_container"
                            class="
                              mCSB_container
                              mCS_y_hidden mCS_no_scrollbar_y
                            "
                            style="position: relative; top: 0; left: 0"
                            dir="ltr"
                          >
                            <span
                              class="no-online-users text-center empty_state"
                            >
                              <i class="fas fa-user-friends"></i>
                              No groups to show
                            </span>
                          </div>
                        </div>
                        <div
                          id="mCSB_2_scrollbar_vertical"
                          class="
                            mCSB_scrollTools mCSB_2_scrollbar
                            mCS-minimal-dark
                            mCSB_scrollTools_vertical
                          "
                          style="display: none"
                        >
                          <div class="mCSB_draggerContainer">
                            <div
                              id="mCSB_2_dragger_vertical"
                              class="mCSB_dragger"
                              style="
                                position: absolute;
                                min-height: 0px;
                                top: 0px;
                              "
                            >
                              <div
                                class="mCSB_dragger_bar"
                                style="line-height: 0px"
                              ></div>
                            </div>
                            <div class="mCSB_draggerRail"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- Members -->
          <chat-members></chat-members>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ChatMembers from './ChatMembers.vue'
export default {
  data: function () {
    return { messages : [],id :'', users : [] };
  },    
    components:{
        ChatMembers
    }
    ,methods: {
      getUsers() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
      axios.defaults.headers.common["Authorization"] = 'Bearer '+ this.$store.get('user-token');
      axios
        .get("api/all-connections")
        .then((response) => {
          // console.log(response.data);
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
      });
    },
  },
  created() {
    this.getUsers();
  },
}
</script>