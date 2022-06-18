<template>
  <div class="header shadow-sm">
    <div class="lh-sm" v-if="user.admin_info">
      <p>{{ `${user.admin_info.last_name}. ${user.admin_info.first_name}` }}</p>
      <p class="text-muted"><small>{{user.admin_info.email}}</small></p>
    </div>
    <div v-if="user.admin_info" class="user-info">
      <a type="button" @click.prevent="logout" class="text-danger text-decoration-none ms-4"> <i class="bi bi-box-arrow-in-left"></i> Logout </a>
    </div>
  </div>
</template>

<script>
  export default {
    computed: {
      user() {
        return this.$store.getters['ADMIN_AUTH/GET_ADMIN_USER'];
      },
    },
    methods: {
      async logout() {
        const response = await this.$store.dispatch('ADMIN_AUTH/LOGOUT');
        if (response.status == 200) {
          this.$router.push({ name: 'signin' });
          this.$toast.success(response.data.message);
        }
      },
    },
  };
</script>

<style></style>
