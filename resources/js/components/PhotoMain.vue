<template>
  <div class="col-xl-9 col-lg-8 col-md-12">
    <div class="headtte14m rrmt-30 box-shadow_main">
      <span><i class="fas fa-image"></i></span>
      <h4>Photos (1)</h4>
    </div>
    <div class="product-items-list pl_item_search mt-30">
      <div class="list-group-profile-photos">
        <div class="media-list-block">
          <div class="photo-data text-center">
            <a href="#">
              <img src="images/post-1.jpg" alt="" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</template>

<script>
export default {
  data: function () {
    return { photos: [] };
  },
  methods: {
    getPhotos() {
      axios
        .get("api/groups")
        .then((response) => {
          this.photos = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getPhotos();
  },
};
</script>
    