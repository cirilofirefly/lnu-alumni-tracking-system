<template>
  <div class="header shadow">
    <div>
      <div class="logo"></div>
      <div>
        <h5 class="p-0">Leyte Normal University</h5>
        <p class="p-0">Alumni Information Tracking Sytem</p>
      </div>
    </div>
    <div v-if="user" class="user-info text-light">
      <span>{{
        `${user[0].student.student_basic_info.first_name} ${user[0].student.student_basic_info.first_name}(${user[0].username})`
      }}</span>

      <button @click.prevent="logout" class="btn btn-light d-flex">
        <i class="bi bi-box-arrow-in-left"></i> Logout
      </button>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$store.getters["STUDENT_AUTH/GET_STUDENT_USER"];
    },
  },
  methods: {
    async logout() {
      const response = await this.$store.dispatch("STUDENT_AUTH/LOGOUT");
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