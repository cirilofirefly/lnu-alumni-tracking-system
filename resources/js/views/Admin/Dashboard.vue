<template>
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-12 col-md-6">
        <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
          Dashboard
        </h1>
      </div>
      <div class="m-3 d-flex justify-content-center">
        <div class="card-container shadow">
          <div>
            <h2>{{ 20 + 1 }}</h2>
            <h6>Alumni Records</h6>
          </div>
          <div>
            <router-link
              :to="{ name: 'admin.alumni.records' }"
              class="btn btn-success"
              ><i class="bi bi-eye-fill"></i>View</router-link
            >
          </div>
        </div>
        <div class="card-container shadow">
          <div>
            <h2>{{ alumni_application_count }}</h2>

            <h6>Alumni Application</h6>
          </div>
          <div>
            <router-link
              :to="{ name: 'admin.alumni.approval' }"
              class="btn btn-success"
              ><i class="bi bi-eye-fill"></i>View</router-link
            >
          </div>
        </div>
      </div>
      <div class="m-3 d-flex justify-content-center">
        <div class="card-container shadow">
          <div>
            <h2>{{ 20 + 1 }}</h2>
            <h6>Alumni ID Records</h6>
          </div>
          <div>
            <router-link
              :to="{ name: 'admin.alumni.id-request' }"
              class="btn btn-success"
              ><i class="bi bi-eye-fill"></i>View</router-link
            >
          </div>
        </div>
        <div class="card-container shadow">
          <div>
            <h2>{{ alumni_batch_count }}</h2>
            <h6>Alumni Batch</h6>
          </div>
          <div>
            <router-link
              :to="{ name: 'admin.alumni.batch' }"
              class="btn btn-success"
              ><i class="bi bi-eye-fill"></i>View</router-link
            >
          </div>
        </div>
      </div>
      <div class="bg-light chart-container shadow">
        <PlanetChart />
      </div>
    </div>
  </div>
</template>

<script>
import PlanetChart from "../../components/chartjs/PlanetChart.vue";
export default {
  components: {
    PlanetChart,
  },
  computed: {
    alumni_application_count() {
      return this.$store.getters["ALUMNAE_APPROVAL/GET_ALUMNAE_COUNT"];
    },
    alumni_batch_count() {
      return this.$store.getters["ADMIN_BATCH/GET_BATCHES_COUNT"];
    },
    alumni_by_batch() {
      return [];
    },
  },
  async mounted() {
    await this.$store.dispatch("ADMIN_DASHBOARD/TOTAL_ALUMNI");
  },
};
</script>

<style>
</style>