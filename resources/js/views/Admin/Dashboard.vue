<template>
  <div class="container-fluid">
    <div class="row g-0">
      <h1 class="fw-bold" style="">Dashboard</h1>
      <p>Welcome back, Here is your summary</p>
      <div class="row gy-2 gx-1">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between">
              <div>
                <h1 class="fw-bold">{{ alumni_records_count }}</h1>
                <h5>Alumni Records</h5>
              </div>
              <div>
                <router-link :to="{ name: 'admin.alumni.records' }" class="btn btn-success"><i class="bi bi-eye-fill"></i>View</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between">
              <div>
                <h1 class="fw-bold">{{ alumni_application_count }}</h1>
                <h5>Alumni Application</h5>
              </div>
              <div>
                <router-link :to="{ name: 'admin.alumni.approval' }" class="btn btn-success"><i class="bi bi-eye-fill"></i>View</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between">
              <div>
                <h1 class="fw-bold">{{ 0 }}</h1>
                <h5>Alumni ID Records</h5>
              </div>
              <div>
                <router-link :to="{ name: 'admin.alumni.id-request' }" class="btn btn-success"><i class="bi bi-eye-fill"></i>View</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between">
              <div>
                <h1 class="fw-bold">{{ alumni_batch_count }}</h1>
                <h5>Alumni Batch</h5>
              </div>
              <div>
                <router-link :to="{ name: 'admin.alumni.batch' }" class="btn btn-success"><i class="bi bi-eye-fill"></i>View</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex mt-5">
        <div class="col-12 col-lg-12">
          <div class="bg-light card shadow-sm">
            <PlanetChart />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import PlanetChart from '../../components/chartjs/PlanetChart.vue';
  export default {
    components: {
      PlanetChart,
    },
    computed: {

      alumni_records_count() {
        return this.$store.getters['ADMIN_DASHBOARD/GET_ALUMNI_RECORD_COUNT'];
      },
      alumni_application_count() {
        return this.$store.getters['ADMIN_DASHBOARD/GET_ALUMNI_COUNT'];
      },
      alumni_batch_count() {
        return this.$store.getters['ADMIN_DASHBOARD/GET_BATCHES_COUNT'];
      },
      alumni_by_batch() {
        return [];
      },
    },
    async mounted() {
      await this.$store.dispatch('ADMIN_DASHBOARD/TOTAL_ALUMNI_BY_BATCH');
    //   await this.$store.dispatch('ADMIN_DASHBOARD/TOTAL_ALUMNI');
      await this.$store.dispatch('ADMIN_DASHBOARD/TOTAL_ALUMNI_RECORDS');
      await this.$store.dispatch('ADMIN_DASHBOARD/TOTAL_BATCHES');
    },
  };
</script>

<style></style>
