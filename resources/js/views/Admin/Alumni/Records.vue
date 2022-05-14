<template>
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-12">
        <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
          Alumni Records
        </h1>
      </div>
      <div class="col-12 mt-3 shadow p-3 bg-light">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Student No</th>
              <th scope="col">Full Name</th>
              <th scope="col">Contact Number</th>
              <th scope="col">Address</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
        	<div v-if="loading" class="mt-2 float-center mx-auto">
				<span>Loading Data...</span>
				<div class="spinner-border" role="status">
					<span class="sr-only"></span>
				</div>
			</div>
            <tr  v-else v-for="student in records" :key="student.id">
              <th v-if="student">{{ student.student.student_basic_info.student_number }}</th>
              <td v-if="student">{{ `${student.student.student_basic_info.first_name} ${student.student.student_basic_info.last_name}`}}</td>
              <td v-if="student">{{ student.student.student_basic_info.mobile_number }}</td>
              <td v-if="student">{{ student.student.student_basic_info.current_address }}</td>
              <td v-if="student" class="text-center">
                <b-button variant="info text-light" @click="$router.push({ path: `record/${student.student.id}` })">View More</b-button>
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
            loading: false
        }
    },
  computed: {
    records() {
      return this.$store.getters["ALUMNAE_APPROVAL/GET_ALUMNAE_RECORDS"];
    },
  },
  methods: {
      setLoading() {
          this.loading = !this.loading
      }
  },
  async mounted() {
      this.setLoading()
      await this.$store.dispatch("ALUMNAE_APPROVAL/FETCH_ALUMNAE_RECORDS");
      this.setLoading()
  },
};
</script>