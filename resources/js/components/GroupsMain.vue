<template>
  <div>
    <div v-for="post in posts" :key="post.id" class="full-width mb-30">
    <div class="recent-items">
      <div class="posts-list">
        <div class="feed-shared-author-dt">
          <div class="author-left">
            <a href="#"
              ><img
                class="ft-plus-square job-bg-circle bg-cyan me-0"
                :src="groupUrl+post.group.profile[0].path"
                alt=""
            /></a>
          </div>
          <div class="author-dts">
            <a href="#" class="job-heading"><span>{{post.group.name}} : </span>{{ post.user.name }}</a>
            <p class="notification-text font-small-4">
              <span class="time-dt"
                ><vue-moments-ago
                  prefix="posted"
                  suffix="ago"
                  :date="post.created_at"
                  lang="en"
              /></span>
            </p>
          </div>
        </div>
      </div>
      <div class="post-meta">
        <div class="feed-shared-dt-1">
          <p class="mb-0">
            {{ post.body }}
          </p>
          <div class="row"> 
            <div class="col-12">
              <div v-if="post.images.length !== 0"  class="post-img">
              <a :href="imageUrl+ post.images[0]['path']" data-lightbox="image-1" data-title="My caption">
                <img :src="imageUrl+ post.images[0]['path']" alt="" />
                </a>
            
            </div>
            </div>

            <div class="col-md-12">
           
            <div v-if="post.images.length > 1"  style="display: flex; flex-wrap: wrap; justify-content: flex-start">
              <div v-for="image in post.images" :key="image.id">
              <img :src="imageUrl+image.path" alt="" style="max-width: 50px; max-height: 50px; margin: 5px" />
            
            </div>
            </div>
             
            </div>
           

          </div>
          
        </div>
        <div class="feed-shared-result">
          <ul class="social-counts">
            <li class="social-counts-items">
              <button class="social-dts-social-counts__count-value">
                Like<span class="social-counts-reactions-count">{{
                  post.likes_count
                }}</span>
              </button>
            </li>
            <li class="social-counts-items">
              <button
                class="social-dts-social-counts__count-value all_comments"
              >
                Comments<span class="social-counts-reactions-count">{{
                  post.comments_count
                }}</span>
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
  </div>
</template>

<script>
export default {
  props: ["posts"],
  data: function () {
    return { groups: [], imageUrl: "storage/posts/",groupUrl : "storage/groupprofile/" };
  },
  methods: {
    getGroups() {
      axios
        .get("api/groups")
        .then((response) => {
          this.groups = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    joinGroup(id) {
      //unauth
      axios
        .post(`api/group/${id}/join`)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
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
  },
  created() {
    this.getGroups();
  },
};
</script>
    