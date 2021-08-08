<template>
  <div class="post-commet-textarea">
    <div class="post-base-1 post_comment_combo">
      <img src="images/logo_2.jpg" alt="" />
      <div class="post-base-1">
        <textarea
          v-model="comment"
          class="auto-resize comment-textarea textarea"
          placeholder="Write a comment "
          autocomplete="off"
        ></textarea>
        <div class="post-base-1 comment_option_footer">
          <div class="img-add">
            <input type="file" id="file" @change="handleFileUpload" ref="files" />
            <label for="file"><i class="fas fa-image"></i></label>
          </div>
          <div >
            <button @click="createComment" class="main-btn color btn-hover"> 
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
 
  data() {
    return {
      image: '',
      comment: "",
      token: '',
      
    };
  },

  methods: {
   
    handleFileUpload(e) {
     if(e.target.files.length === 0){
       return;
     }
     
       this.image = this.$refs.files.files[0];
      
     
     
    },
    createComment() {
      
      let slug = this.$route.params.slug
     this.token = this.$store.get('user-token');
     let form = new FormData();
      var self = this;
      
       let file =  self.image;

       form.append('image',file);
      
      form.append('comment',this.comment);
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
       
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }
        axios
          .post(`api/post/${slug}/comment`,form,headers)
          .then((response) => {
            console.log(response.data);
            if (response.status == 200) {
              this.comment = "";
              document.getElementById('file').value = "";
              console.log('Comment created succesfuly');
            }
          })
          .catch(function (error) {
            
            console.log(error);
          });
      });
    },
    
  },
}
</script>
