<template>
  <div class="col-xl-8 col-lg-7 col-md-12">
    <div>
      <div class="full-width mb-0 rrmt-30">
        <div class="messages-container">
          <div class="recipients-top-dt">
            <div class="msg-usr-dt">
              <div class="recipient-avatar">
                <img
                  src="images/left-imgs/img-2.jpg"
                  loading="lazy"
                  alt=""
                  class="presence-entity__image nt-view-attr__img--centered"
                />
                <div class="presence-entity__badge badge__online">
                  <span class="visually-hidden"> Status is online </span>
                </div>
              </div>
              <div class="recipient-user-dt">
                <a href="#" target="_blank">Jassica William</a>
                <p class="user-last-seen">
                  <span class="small-last-seen">2 d</span>
                </p>
              </div>
            </div>
            <div class="usr-cht-opts-btns">
              <span class="option-icon"><i class="fas fa-phone-alt"></i></span>
              <span class="option-icon"><i class="fas fa-video"></i></span>
              <span class="option-icon"><i class="fas fa-trash-alt"></i></span>
            </div>
          </div>
          <div
            class="chat-container mCustomScrollbar _mCS_3 mCS-autoHide"
            style="height: 439px; overflow: visible"
          >
            <div
              id="mCSB_3"
              class="
                mCustomScrollBox
                mCS-minimal-dark
                mCSB_vertical mCSB_outside
              "
              tabindex="0"
              style="max-height: 419px"
            >
              <div
                id="mCSB_3_container"
                class="mCSB_container"
                style="position: relative; top: -115px; left: 0px"
                dir="ltr"
              >
                <div class="chat-content">
                  <ul class="chats-lists">
                    <li v-for="chat in chats" :key="chat.id" class="you">
                      <div class="chat-thumb">
                        <img
                          src="images/left-imgs/img-2.jpg"
                          alt=""
                          class="mCS_img_loaded"
                        />
                      </div>
                      <div class="notifi-event">
                        <span class="chat-msg-item">{{ chat.message }}</span>
                        <span class="notifi-date">
                          <time datetime="2021-01-24T18:18" class="posted-date">
                            <vue-moments-ago
                              prefix="posted"
                              suffix="ago"
                              :date="chat.created_at"
                              lang="en"
                            />
                          </time>
                        </span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div
              id="mCSB_3_scrollbar_vertical"
              class="
                mCSB_scrollTools mCSB_3_scrollbar
                mCS-minimal-dark
                mCSB_scrollTools_vertical
              "
              style="display: block"
            >
              <div class="mCSB_draggerContainer">
                <div
                  id="mCSB_3_dragger_vertical"
                  class="mCSB_dragger"
                  style="
                    position: absolute;
                    min-height: 0px;
                    display: block;
                    height: 0px;
                    top: 0px;
                  "
                >
                  <div class="mCSB_dragger_bar" style="line-height: 0px"></div>
                </div>
                <div class="mCSB_draggerRail"></div>
              </div>
            </div>
          </div>
          <form @submit="sendMessage" class="send_messages_form">
            <div class="send_input_group">
              <div class="msg_write_combo">
                <div class="add_files">
                  <div
                    class="img-add"
                    data-toggle="tooltip"
                    data-placement="top"
                    title=""
                    data-bs-original-title="Files, Photos and Videos"
                  >
                    <input type="file" id="file1" />
                    <label for="file1"><i class="fas fa-clone"></i></label>
                  </div>
                </div>
                <textarea
                  v-model="message"
                  class="form-control custom-controls"
                  placeholder="Write Something.."
                ></textarea>
                <div
                  class="emoji-panel"
                  data-toggle="tooltip"
                  data-placement="top"
                  title=""
                  data-bs-original-title="Emoji"
                >
                  <button class="emoji-combo ml-2">
                    <i class="fas fa-smile"></i>
                  </button>
                </div>
                <div
                  class="mic_recording-icon"
                  data-toggle="tooltip"
                  data-placement="top"
                  title=""
                  data-bs-original-title="Audio Recording"
                >
                  <button class="mic-record">
                    <i class="fas fa-microphone"></i>
                  </button>
                </div>
              </div>
              <span class="input-send-btn">
                <button class="btn-main btn-hover send-button" type="submit">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueMomentsAgo from "vue-moments-ago";
export default {
  data: function () {
    return {
      message: "",
      chats: [],
      id: "",
    };
  },
  components: {
    VueMomentsAgo,
  },
  methods: {
    sendMessage() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          `Bearer ` + this.$store.get("user-token");
        axios.defaults.headers.common["'content-type'"] = `multipart/form-data`;

        axios
          .post("api/chat", {
            recipient_id: this.$route.params.id,
            message: this.message,
            media: "test.jpg",
          })
          .then((response) => {
            if (response.status == 200) {
              this.message = "";
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      });
    },
    getChat() {
      this.id = this.$route.params.id;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .get(`api/chat/${this.id}`)
          .then((response) => {
            this.chats = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
  },
  created() {
    this.getChat();
  },
};
</script>