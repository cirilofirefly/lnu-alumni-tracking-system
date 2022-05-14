<template>
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-12 p-4">
        <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
          Feedback
        </h1>
      </div>
      <div class="col-12 bg-light shadow">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col" class="text-center">Content</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(feedbacks, index) in feedbacks" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ feedbacks.name }}</td>
              <td>{{ feedbacks.email }}</td>
              <td class="text-center">
                <button style="width: 100px" class="btn btn-success mx-2">
                  <i class="bi bi-eye-fill"></i> View
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      feedback: {
        feedback: ''
      },
    };
  },
  computed: {
    feedbacks() {
      return this.$store.getters["ADMIN_FEEDBACK/GET_FEEDBACKS"];
    },
  },
  async sendFeedback() {
    const response = await this.$store.dispatch(
      "ADMIN_FEEDBACK/STORE_FEEDBACK",
      data
    );
    if (response.status) {
    }
  },
  async mounted() {
    this.$store.dispatch("ADMIN_FEEDBACK/FETCH_FEEDBACKS");
  },
};
</script>

<style>
</style>