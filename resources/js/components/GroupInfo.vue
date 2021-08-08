<template>

  <div class="event-card rrmt-30 lgmt-30">
    <div class="headtte14m">
      <span><i class="fas fa-info"></i></span>
      <h4>Group Info</h4>
    </div>
    <div class="evntdt99">
      <div class="mndtlist">
        <div class="evntflldt4 flxcntr">
          <div class="hhttd14s">
            <i class="fas fa-users"></i>
          </div>
          <div class="ttlpple"><span class="mr-1">{{groupDetails.users_count}}</span>Members</div>
        </div>
      </div>
     
      <div class="mndtlist">
        <div class="evntflldt4 flxcntr">
          <div class="hhttd14s">
            <i class="fas fa-newspaper"></i>
          </div>
          <div class="ttlpple">
            <span>{{groupDetails.posts_count}} Posts</span>
          </div>
        </div>
      </div>
      <div class="mndtlist">
        <div class="mndesp145 page-ddes">
          <div class="evarticledes">
            <p class="mb-0">
              {{groupDetails.about}}<br />
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return {
      groupDetails : []
    }
  },
  methods: {
    getGroupDetails() {
     let slug = this.$route.params.slug;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + this.$store.get("user-token");
        axios;
        axios
          .get(`api/group/${slug}`)
          .then((response) => {
            console.log(response.data);
            this.groupDetails = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
  },
  created() {
    this.getGroupDetails();
  }
}
</script>