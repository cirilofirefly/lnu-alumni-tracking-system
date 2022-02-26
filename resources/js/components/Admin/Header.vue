<template>
  <div class="header shadow">
    <div></div>
    <div v-if="user" class="user-info">
      <span>{{
        `${user.admin_info.first_name} ${user.admin_info.last_name}(${user.username})`
      }}</span>
      <button @click.prevent="logout" class="btn btn-outline-danger d-flex">
        <i class="bi bi-box-arrow-in-left"></i> Logout
      </button>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$store.getters["ADMIN_AUTH/GET_ADMIN_USER"];
    },
  },
  methods: {
    async logout() {
      const response = await this.$store.dispatch("ADMIN_AUTH/LOGOUT");
      if (response.status == 200) {
        this.$router.push({ name: "signin" });
        this.$toast.success(response.data.message);
      }
    },
  },
};
</script>

<style>
</style>