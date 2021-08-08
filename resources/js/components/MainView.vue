<template>
  <div>
    <!-- create post here -->
    <create-post></create-post>

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
          <!-- posts here -->
          <div v-for="post in posts" :key="post.id">
            <post-view :post="post"></post-view>
          </div>

          <div class="loading-btn">
            <button class="process-btn btn-hover" type="button">
              No More Posts
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CreatePost from "./CreatePost.vue";
import PostView from "./PostView.vue";
export default {
  components: {
    PostView,
    CreatePost,
  },
   data: function () {
    return { posts: [], userUrl : "/storage/userprofile/" }
  },
  methods: {
      getPost(){
          axios.get('api/posts')
          .then(response =>{
              this.posts = response.data;
             // console.log(this.posts);
             
          })
          .catch(error => { 
              console.log(error);
              });

      }
  },
  created(){
      this.getPost();
  }
};
</script>
    