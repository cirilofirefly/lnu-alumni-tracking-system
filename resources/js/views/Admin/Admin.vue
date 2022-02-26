<template>
  <div class="admin">
    <div v-if="loaded">
      <AdminSidebar />
      <div>
        <AdminHeader />
        <router-view class="router-container"></router-view>
      </div>
    </div>
    <div
      v-else
      class="w-100 vh-100 d-flex flex-column justify-content-center align-items-center"
    >
      <div><h4>Now Loading...</h4></div>
      <div>
        <div class="spinner-grow mx-2" role="status"></div>
        <div class="spinner-grow mx-2" role="status"></div>
        <div class="spinner-grow mx-2" role="status"></div>
      </div>
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
  data() {
    return {
      loaded: true,
    };
  },
  async mounted() {
    this.loaded = !this.loaded;
    await this.$store.dispatch("ADMIN_AUTH/CHECK");
    this.loaded = !this.loaded;
  },
};
</script>