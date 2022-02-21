<template>
  <div class="admin">
    <AdminSidebar />
    <div class="container-fluid p-0">
      <AdminHeader />
      <router-view class="router-container"></router-view>
    </div>
  </div>
</template>
<script>
import AdminHeader from "../../components/Admin/Header.vue";
import AdminSidebar from "../../components/Admin/Sidebar.vue";
export default {
  components: {
    AdminHeader,
    AdminSidebar,
  },
};
</script>