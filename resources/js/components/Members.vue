<template>
  <div>
   
    <div class="pageJobs-group">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="tab-content" id="v-pills-tabContent-pageJobs">
            <div
              class="tab-pane rmt-30 fade show active"
              id="v-pills-group-members"
              role="tabpanel"
              aria-labelledby="v-pills-group-members-tab"
            >
              <div class="dtpgusr12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="full-width">
                      <div class="my_connections_list">
                        <div class="cntn_top_filter border-bottom-0">
                          <h4>Members</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-for="member in groupMembers.users" :key="member.id" class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                  <router-link class="nav-link"  v-bind:to="'/user-profile/'+member.slug">
                    <div class="ppuser-card mt-30">
                      <div class="ppuser-img">
                      
                        <img
                        v-if="member.profile.length > 0"
                          class="ft-plus-square job-bg-circle bg-cyan me-0"
                          :src="imageUrl+ member.profile[member.profile.length-1].path"
                          alt=""
                        />
                      </div>
                      <a href="#" class="job-heading text-center"
                        >{{member.name}}</a
                      >
                      
                    </div>
                    </router-link>
                  </div>
                 
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade rmt-30"
              id="v-pills-invites"
              role="tabpanel"
              aria-labelledby="v-pills-invites-tab"
            >
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['groupMembers'],
  data:function (){
    return {
      length : '',
      imageUrl : "/storage/userprofile/"
    }
  },
  

}
</script>