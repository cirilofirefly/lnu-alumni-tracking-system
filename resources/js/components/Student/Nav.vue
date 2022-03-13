<template>
  <div class="nav">
    <button @click="$router.push({ name: 'student.home'})" class="btn btn-outline-success me-2">
      <i class="bi bi-house-fill"></i> Home
    </button>
    <button @click="$router.push({ name: 'student.account-setting'})" class="btn btn-outline-primary me-2">
      <i class="bi bi-gear"></i> Account Setting
    </button>
    <button @click="$router.push({ name: 'student.feedback'})" class="btn btn-outline-info me-2">
      <i class="bi bi-send-fill"></i> Feedback
    </button>
    <button @click="$router.push({ name: 'student.id-request'})" class="btn btn-outline-success me-2">
      <i class="bi bi-person-badge-fill"></i> ID Request
    </button>
  </div>
</template>

<script>
export default {
  computed: {},
  methods: {},
};
</script>

<style>
</style>