<template>
  <div class="main_content">
    <div class="tab-content" id="event-tabContent">
      <div
        class="tab-pane fade show active"
        id="nav-all"
        role="tabpanel"
        aria-labelledby="nav-all-tab"
      >
        <div class="rcntacttle">
          <span>Recent Activity</span>
        </div>
         <div v-for="post in groupPost" :key="post.id" class="full-width mb-30">
          <div class="recent-items">
            <div class="posts-list">
              <div class="feed-shared-author-dt">
                <div class="author-left">
                  
                   <img
                     v-if="post.user.profile.length != 0"
                      class="ft-plus-square job-bg-circle bg-cyan mr-0"
                      :src="userUrl+post.user.profile[post.user.profile.length-1].path"
                      alt=""
                  />
                </div>
                <div class="author-dts">
                  <a href="#" class="job-heading">{{post.user.name}}</a>
                  <p class="notification-text font-small-4">
                    <span class="time-dt">
                      <vue-moments-ago
                        prefix="posted"
                        suffix="ago"
                        :date="post.created_at"
                        lang="en"
                      />
                    </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="post-meta">
              <div class="feed-shared-dt-1">
                <p class="mb-0">
                  {{ post.body }}
                </p>
                <div
                  v-for="image in post.images"
                  :key="image.id"
                  class="post-img"
                >
                  <img :src="imageUrl + image.path" alt="" />
                </div>
              </div>
              <div class="feed-shared-result">
                <ul class="social-counts">
                  <li class="social-counts-items">
                    <button class="social-dts-social-counts__count-value">
                      Like<span class="social-counts-reactions-count">{{post.likes_count}}</span>
                    </button>
                  </li>
                  <li class="social-counts-items">
                    <button
                      class="social-dts-social-counts__count-value all_comments"
                    >
                      Comments<span class="social-counts-reactions-count"
                        >{{post.comments_count}}</span
                      >
                    </button>
                  </li>
                </ul>
              </div>
              <div class="feed-shared-social-actions">
                <div class="reactions-button-left">
                  <button
                    @click="likePost(post.id)"
                    class="react-button__trigger action-btn"
                  >
                    <i class="fas fa-thumbs-up icon-mr"></i>Like
                  </button>
                  <router-link class="react-button__comment action-btn leave_a_comment" v-bind:to="'/post-details/'+post.slug" >
           
                  <i class="fas fa-comment-alt icon-mr"></i>Comment
                 </router-link>
                </div>
              </div>
            </div>
          </div>
        </div> 

        <div class="loading-btn">
          <button class="process-btn btn-hover" type="button">
            No More Posts
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueMomentsAgo from "vue-moments-ago";
export default {
  components: {
    VueMomentsAgo,
  },
  data: function () {
    return {
      groupPost: [],
      slug: "",
      imageUrl : "storage/posts/",
      userUrl : "storage/userprofile/"
    };
  },
  methods: {
    likePost(id) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .post("api/like", {
            post_id: id,
          })
          .then((response) => {
            alert(response.data.message);
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
    getGroupPost() {
      this.slug = this.$route.params.slug;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .get(`api/group/${this.slug}/post`)
          .then((response) => {
           this.groupPost = response.data;
            
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
  },
  created() {
    this.getGroupPost();
  },
};
</script>