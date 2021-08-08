<template>
  <div>
    <ul class="we-comment-dt">
      <li v-for="reply in replies" :key="reply.id">
        <div class="comet-avatar">
          <img src="images/left-imgs/img-5.jpg" alt="" />
        </div>
        <div class="we-comment">
          <a href="#" title="" class="user-name">{{reply.users.name}}</a>
          <p>{{ reply.reply}}</p>
          <div v-if="reply.image !== null" class="post-img">
            
            <img :src="imageUrl + reply.image" alt="" />
          </div>
          <div class="inline-itms">
            <span>
              <vue-moments-ago
                prefix="posted"
                suffix="ago"
                :date="reply.created_at"
                lang="en"
              />
            </span>
          </div>
        </div>
      </li>

      <li>
        <create-reply :comment_id="commentID"></create-reply>
      </li>
    </ul>
  </div>
</template>
<script>
import VueMomentsAgo from "vue-moments-ago";
export default {
  props: ["comment_id"],
  components:{
    VueMomentsAgo
  },
  data() {
    return {
      commentID: this.$props.comment_id,
      replies: [], imageUrl : "/storage/replies/"
    };
  },
  methods: {
    getReplies() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios
          .get(`api/comment/${this.commentID}/replies`)
          .then((response) => {
            this.replies = response.data;
            console.log(this.replies);
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
  },
  created() {
    this.getReplies();
  },
};
</script>