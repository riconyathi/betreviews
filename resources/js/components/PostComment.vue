<template>
  <div class="main-comment-section">
    
    <ul class="we-comment-dt">
      <li v-for="comment in comments" :key="comment.id">
        <div class="comet-avatar">
          <img
             
            v-if="comment.user.profile.length != 0"
            class="ft-plus-square job-bg-circle bg-cyan mr-0"
            :src="userUrl+comment.user.profile[comment.user.profile.length-1].path"
            
                
            />
        </div>
        <div class="we-comment">
          <a href="#" title="" class="user-name">{{comment.user.name}}</a>
          <p>{{ comment.comment}}</p>
          <div v-if="comment.image !== null" class="post-img">
            
            <img :src="imageUrl + comment.image" alt="" />
          </div>
          <div class="inline-itms">
            <span>
              <vue-moments-ago
                prefix="posted"
                suffix="ago"
                :date="comment.created_at"
                lang="en"
              />
            </span>
            <!-- <a class="we-reply" href="#" title="Reply"
              ><i class="fa fa-reply"></i
            ></a> -->
            <a @click="likeComment(comment.id)" title=""
              >{{comment.likes.length}}<i class="fas fa-thumbs-up"></i
              ><span class="social-counts-reactions-count"></span
            ></a>
          </div>
        </div>
        <!-- <comment-reply :comment_id="comment.id"></comment-reply> -->
      </li>

      <!-- <li>
        <div class="viewcmnts">
          <span class="pointer">View more comments</span>
        </div>
      </li> -->
      <li>
        <create-comment></create-comment>
      </li>
    </ul>
  </div>
</template>
<script>
import VueMomentsAgo from "vue-moments-ago";
import CommentReply from "./CommentReply.vue";
export default {
  props: ["comments"],
  data(){
    return {
      imageUrl: "/storage/comments/",
      userUrl : "/storage/userprofile/"
    }
  },
  components: {
    CommentReply,
    VueMomentsAgo,
  },
  methods: {
    likeComment(id) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .post("api/comment/like", {
            comment_id: id,
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
};
</script>
