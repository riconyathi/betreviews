<template>
  <div v-if="logged"  class="event-card">
    <div class="add-post-section lead emoji-picker-container">
      <div class="add-textarea-dt">
        <textarea
          v-model="body"
          class="add-post-textarea"
          placeholder="What's going on? Rico Posts"
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
        <button @click="createPost" class="main-btn color btn-hover"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</template>

<script>
const token = localStorage.getItem("user-token");
export default {
  data() {
    return {
      images: [],
      body: "",
      token: '',
      
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
     
    },
    createPost() {
     this.token = this.$store.get('user-token');
     let form = new FormData();
      var self = this;
      for (let i = 0; i < this.images.length; i++) {
       let file =  self.images[i];

       form.append('files['+i+']',file);
      }
      form.append('body',this.body);
      axios.get("/sanctum/csrf-cookie").then((response) => {
        //token user
        axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
        // axios.defaults.headers.common["content-type"] = `multipart/form-data`;
        const config = {
          headers : { "content-type" :  "multipart/form-data" }
        }
        axios
          .post("api/post",form,headers)
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
    loggedIn(){
      if (typeof this.$store.get('user-token') !== 'undefined') {this.logged = true; }
    }
  },
  created(){
    this.loggedIn();
  }
    

};
</script>