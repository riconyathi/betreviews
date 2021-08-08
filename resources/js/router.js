import Vue from  'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

import Body from './components/Body.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Groups from './components/GroupsView.vue';
import Connections from './components/ConnectionsView.vue';
import Photos from './components/PhotoView.vue';
import Following from './components/FollowingView.vue';
import Followers from './components/FollowersView.vue';
import GroupDetails from './components/GroupDetails.vue';
import GroupMembers from './components/GroupMembers.vue';
import GroupSettings from './components/GroupSettings.vue';
import GroupPhotos from './components/GroupPhotos.vue';
import Chat from './components/Chat.vue';
import Notifications from './components/AllNotifications.vue';
import PostsDetails from './components/PostsDetails.vue';
import GroupCreate from './components/GroupCreate.vue';
import UpdateProfile from './components/UpdateProfile.vue';



const routes = [
    { path: '/', component: Body },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/groups', component: Groups },
    { path: '/connections', component: Connections },
    { path: '/photos', component: Photos },
    { path: '/following', component: Following },
    { path: '/followers', component: Followers },
    { path: '/group-details/:slug', component: GroupDetails },
    { path: '/group-members/:slug', component: GroupMembers},
    { path: '/group-photos/:slug', component: GroupPhotos },
    { path: '/group-settings/:slug', component: GroupSettings },
    { path: '/chat/:id', component: Chat },
    { path: '/notifications', component: Notifications },
    { path: '/post-details/:slug', component: PostsDetails },
    { path: '/group_create', component: GroupCreate },
    { path: '/user-profile/:slug', component: UpdateProfile },
    {path: '/auth/:provider/callback',component: {template: '<div class="auth-component"></div>'}},
  ];

  const router = new VueRouter({
    routes:routes
    
  });

export default router;


