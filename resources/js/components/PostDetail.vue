<template>
  <div class="full-width mb-30">
    <div class="recent-items">
      <div class="posts-list">
        <div class="feed-shared-author-dt">
          <div class="author-left">
            <img
             
            v-if="post.user.profile.length != 0"
            class="ft-plus-square job-bg-circle bg-cyan mr-0"
            :src="userUrl+post.user.profile[post.user.profile.length-1].path"
            
                
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
          <div
          v-if="canDelete(post.user_id)"
            class="
              ellipsis-options
              post-ellipsis-options
              dropdown dropdown-account
            "
          >
            <a
              href="#"
              class="option-eps"
              role="button"
              data-bs-toggle="dropdown"
              ><i class="fas fa-ellipsis-h"></i
            ></a>
            <ul  class="dropdown-menu dropdown-ellipsis dropdown-menu-end">
              <li class="media-list">
                <button 
                @click="deletePost(post.id)"
                class="item channel_item"
                  ><i class="fas fa-trash icon-mr1"></i>
                  Delete Posts</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="post-meta">
        <div class="feed-shared-dt-1">
          <p class="mb-0">
            {{post.body}}
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
                Like<span class="social-counts-reactions-count">{{post.likes_count}}</span>
              </button>
            </li>
            <li class="social-counts-items">
              <button
                class="social-dts-social-counts__count-value all_comments"
              >
                Comments<span class="social-counts-reactions-count">{{post.comments_count}}</span>
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
            <button class="react-button__comment action-btn leave_a_comment">
              <i class="fas fa-comment-alt icon-mr"></i>Comment
            </button>
          </div>
         
        </div>
      </div>
       <div class=" main-comment-section">
     <comments :comments="post.comments"></comments>
       </div>
    </div>
  </div>
</template>

<script>
import VueMomentsAgo from "vue-moments-ago";
import Comments from "./PostComment.vue";
import PostView from "./PostView.vue";
export default {
  components: {
    PostView,
    Comments,
    VueMomentsAgo

  },
  data: function () {
    return { post: [], postId : '',
            imageUrl : "/storage/posts/",
            userUrl : "/storage/userprofile/"
            };
  },
  methods: {
    getPost() {
        let slug = this.$route.params.slug
    axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
      axios
        .get(`api/post/${slug}`)
        .then((response) => {
          this.post = response.data;
          this.postId = this.post.id;
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
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
    canDelete(id){
      let role = this.$store.get('user-data');
       // console.log(role);
      if(role.roles[0].name === "admin"|| role.id === id ){
        return true;
      }else{
        return false;
      }
    },
     deletePost(id){
       if(confirm("Do you really want to delete?")){
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .delete(`api/post/${id}`)
          .then((response) => {
            if(response.status == 200){
               console.log(response.data);
              this.$router.back();
            }
            
          })
          .catch((error) => {
            console.log(error);
          });
      });
       }
    },

  },
  created() {
    this.getPost();
  },
};
</script>
    