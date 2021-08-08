<template>
  <div class="event-card">
  
    <div class="add-post-section lead emoji-picker-container">
      <div class="add-textarea-dt">
        <textarea
         v-model="body"
          class="add-post-textarea"
          placeholder="What's going on? post in group"
        ></textarea>
      </div>
      <div class="add-post-items">
        <div class="add-left-items">
          <ul>
            <li>
               <div class="upload-icon">
                <input type="file" id="file" name="image" ref="files" multiple @change="handleFileUpload" />
                <label for="file" title="Image"
                  ><i class="fas fa-camera"></i
                  ><span class="icon-text">Image</span></label
                >
              </div>
            </li>
         
          </ul>
        </div>
       
      </div>
    </div>
    <div class="postbox">
      <div class="share-submit-btns">
        <button @click="createPost"  class="main-btn color btn-hover"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
      </div>
    </div>
     
  </div>
</template>

<script>

export default {
  data() {
    return {
      images: [],
      body: "",
      slug : ''
    };
  },

  methods: {
    handleFileUpload(e) {
     if(e.target.files.length === 0){
       return;
     }
     for (let i = 0; i < this.$refs.files.files.length; i++) {
       this.images.push(this.$refs.files.files[i]);
      
     }
     console.log(this.images);
    },
     createPost() {
        this.slug = this.$route.params.slug;
     this.token = this.$store.get('user-token');
     let form = new FormData();
      var self = this;
      for (let i = 0; i < this.images.length; i++) {
       let file =  self.images[i];

       form.append('files['+i+']',file);
      }
      form.append('body',this.body);
      axios.get("/sanctum/csrf-cookie").then((response) => {
       
        axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
       
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }
        axios
          .post(`api/group/${this.slug}/post`,form,headers)
          .then((response) => {
            console.log(response.data);
            if (response.status == 200) {
              this.body = "";
              document.getElementById('file').value = "";
              console.log('Post created succesfuly');
            }
          })
          .catch(function (error) {
            
            console.log(error);
          });
      });
    },
  },
};
</script>