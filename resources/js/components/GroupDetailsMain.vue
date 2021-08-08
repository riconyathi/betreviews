<template>
  <div class="dtpgusr12">
    <div class="container">
      <div class="row">
        <main
          class="
            col col-xl-6
            order-xl-2
            col-lg-12
            order-lg-1
            col-md-12 col-sm-12 col-12
          "
        >
          <!-- create group post -->
          <create-group-post></create-group-post>
          <group-post></group-post>
        </main>
        <aside
          class="
            col col-xl-3
            order-xl-1
            col-lg-6
            order-lg-1
            col-md-6 col-sm-12 col-12
          "
        >
        <group-info></group-info>
        </aside>
        <aside
          class="
            col col-xl-3
            order-xl-3
            col-lg-6
            order-lg-3
            col-md-6 col-sm-12 col-12
          "
        >
          <div class="event-card rrmt-30 lgmt-30">
            <div class="headtte14m">
              <span><i class="fas fa-image"></i></span>
              <h4>Photos</h4>
            </div>
            <div class="panel-photos">
              <div class="row g-0">
                <div class="col-4">
                  <a
                    href="#"
                    class="pg-img"
                    data-image="images/post-1.jpg"
                    style="background-image: url(images/post-1.jpg)"
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>

<script>
import CreateGroupPost from './CreateGroupPost.vue'
import GroupPost from './GroupPost'
import GroupInfo from './GroupInfo'
export default {
  props: ["groupDetails"],
    components:{
        CreateGroupPost,
        GroupPost,
        GroupInfo
    }
    
}
</script>