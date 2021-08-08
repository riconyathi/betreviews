<template>
  <div>
    <!-- header with search -->
    <header-component></header-component>

    <div class="wrapper pt-0">
      <!-- cover main page  -->
      <!-- <cover-component :userData="userData"></cover-component> -->
      <side-view></side-view>

      <div class="container">
        <div class="hs__wrapper">
          <div class="hs__header">
            <h2 class="hs__headline">Groups</h2>
            <router-link v-if="isAdmin" to="/group_create">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </router-link>
            
            <div class="hs__arrows">
              <a class="arrow disabled arrow-prev"></a
              ><a class="arrow arrow-next"></a>
            </div>
          </div>
          <ul class="hs">
            <li v-for="group in groups" :key="group.id" class="hs__item">
               <router-link v-bind:to="'/group-details/'+group.slug">
              <div class="hs__item__image__wrapper" style="width: 100%;"
              >
                <img
                  v-if="group.profile.length > 0"
                  class="hs-image"
                  :src="imageUrl+group.profile[group.profile.length-1].path"
                  alt="" style="max-width: 100%;"
                />
              </div>
              <div class="hs__item__description">
                <span class="hs__item__title">{{ group.name }}</span
                >
              </div>
              </router-link>
            </li>
          </ul>
        </div>
      </div>

      <div class="dtpgusr12">
        <div class="container">
          <div class="row">
            <!-- groups -->
            <groups-main :posts="posts"></groups-main>
            
          </div>
        </div>
      </div>
    </div>

    <footer-component></footer-component>
  </div>
</template>

<script>
import SideView from "./SideView.vue";
import ProfileView from "./ProfileView.vue";
import GroupsMain from "./GroupsMain.vue";
import { VueCardCarousel } from "vue-card-carousel";
export default {
  components: {
    SideView,
    ProfileView,
    GroupsMain,
    VueCardCarousel,
  },
  data: function () {
    return {
     
      posts : [],
      groups: [],
      imageUrl : "/storage/groupprofile/",
      isAdmin : 0
    };
  },
  methods: {
  
    getGroups() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");

        axios
          .get("api/all-groups")
          .then((response) => {
            this.groups = response.data;
            // this.length = response.data.length;
            // console.log(this.groups);
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
     getPost(){
        axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
          axios
          .get('api/my-groups-post')
          .then(response =>{
              this.posts = response.data;
              //console.log(this.posts);
              
             
          })
          .catch(error => { 
              console.log(error);
              });
        });

      },
      checkIfAdmin(){
    
      let user = this.$store.get('user-data');
      
      if(user.roles[0].name == 'admin' ){  this.isAdmin = 1;} else {  this.isAdmin = 0 }
     
    },
  },

  created() {
  
    this.getGroups();
    this.getPost();
    this.checkIfAdmin();
  },
};
// work in progress - needs some refactoring and will drop JQuery i promise :)
var instance = $(".hs__wrapper");
$.each(instance, function (key, value) {
  var arrows = $(instance[key]).find(".arrow"),
    prevArrow = arrows.filter(".arrow-prev"),
    nextArrow = arrows.filter(".arrow-next"),
    box = $(instance[key]).find(".hs"),
    x = 0,
    mx = 0,
    maxScrollWidth =
      box[0].scrollWidth - box[0].clientWidth / 2 - box.width() / 2;

  $(arrows).on("click", function () {
    if ($(this).hasClass("arrow-next")) {
      x = box.width() / 2 + box.scrollLeft() - 10;
      box.animate({
        scrollLeft: x,
      });
    } else {
      x = box.width() / 2 - box.scrollLeft() - 10;
      box.animate({
        scrollLeft: -x,
      });
    }
  });

  $(box).on({
    mousemove: function (e) {
      var mx2 = e.pageX - this.offsetLeft;
      if (mx) this.scrollLeft = this.sx + mx - mx2;
    },
    mousedown: function (e) {
      this.sx = this.scrollLeft;
      mx = e.pageX - this.offsetLeft;
    },
    scroll: function () {
      toggleArrows();
    },
  });

  $(document).on("mouseup", function () {
    mx = 0;
  });

  function toggleArrows() {
    if (box.scrollLeft() > maxScrollWidth - 10) {
      // disable next button when right end has reached
      nextArrow.addClass("disabled");
    } else if (box.scrollLeft() < 10) {
      // disable prev button when left end has reached
      prevArrow.addClass("disabled");
    } else {
      // both are enabled
      nextArrow.removeClass("disabled");
      prevArrow.removeClass("disabled");
    }
  }
});
</script>

<style scoped>
* {
  box-sizing: border-box;
}

::-webkit-scrollbar {
  /* Webkit */
  width: 0;
  height: 0;
}

.hs {
  display: flex;
  overflow-x: scroll;
  justify-content: space-between;
  scrollbar-width: none;
  /* Firefox */
  -ms-overflow-style: none;
  /* IE 10+ */
  -webkit-overflow-scrolling: touch;
  margin: 0 -20px;
}
.hs__header {
  display: flex;
  align-items: center;
  width: 100%;
}
.hs__headline {
  flex: 1;
}
.hs__arrows {
  align-self: center;
}
.hs__arrows .arrow:before {
  content: "";
  display: inline-block;
  vertical-align: middle;
  content: "";
  background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNSIgaGVpZ2h0PSI5IiB2aWV3Qm94PSIwIDAgMTUgOSI+Cgk8cGF0aCBmaWxsPSIjMzMzMzMzIiBkPSJNNy44NjcgOC41NzRsLTcuMjItNy4yMi43MDctLjcwOEw3Ljg2NyA3LjE2IDE0LjA1Ljk4bC43MDYuNzA3Ii8+Cjwvc3ZnPgo=");
  background-size: contain;
  filter: brightness(5);
  width: 18px;
  height: 12px;
  cursor: pointer;
}
.hs__arrows .arrow.disabled:before {
  filter: brightness(2);
}
.hs__arrows .arrow.arrow-prev:before {
  transform: rotate(90deg);
  margin-right: 10px;
}
.hs__arrows .arrow.arrow-next:before {
  transform: rotate(-90deg);
}
.hs-image {

  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}
.hs__item {
  
  margin: 5px;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: relative;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;

  border-radius: 15px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
      transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
 
  cursor: pointer;
}
@media only screen and (max-width: 990px) {
  .hs__item {
    flex-basis: calc(100% / 3 - (10px * 2) - (20px / 3));
  }
}
.hs__item:last-child:after {
  content: "";
  display: block;
  position: absolute;
  width: 10px;
  height: 1px;
  right: calc(10px * 2 * -1);
}
.hs__item:first-child {
  margin-left: calc(10px * 2);
}
.hs__item__description {
  z-index: 1;
  align-self: flex-start;
  margin: 10px 0;
}
.hs__item__subtitle {
  color: #aaa;
  display: block;
}
.hs__item__image__wrapper {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 100%;
}

@media only screen and (min-width: 990px) {
  .hs__wrapper {
    overflow: hidden;
  }
}
@media (hover: none) and (pointer: coarse) {
  .hs__wrapper .hs__arrows {
    display: none;
  }
  .hs__wrapper .hs__item {
    flex: 1 0 calc(23% - 10px * 2);
  }
}
@media only screen and (hover: none) and (pointer: coarse) and (max-width: 990px) {
  .hs__wrapper .hs__item {
    flex: 1 0 calc(45% - 10px * 2);
  }
}

/* Base Styling */
body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  font-family: "Muli", sans-serif;
  color: white;
  background: white;
  line-height: 1.5;
  letter-spacing: 0.15px;
}

.container {
  max-width: 990px;
  padding: calc(10px * 2);
  margin: 0 auto;
  
  mix-blend-mode: invert;
  position: relative;
}
.container:after {
  content: "";
  width: 100vw;
  height: 100%;
  background: #212121;
  position: absolute;
  left: 50%;
  top: 0;
  transform: translateX(-50%);
  z-index: -1;
}
@media only screen and (min-width: 990px) {
  .container {
    padding: calc(10px * 4) calc(10px * 8);
  }
}

.description {
  max-width: 990px;
  color: #212121;
  margin: 0 auto;
  padding: calc(10px * 4);
}

ul {
  padding: 0;
  margin: 0;
}
</style>