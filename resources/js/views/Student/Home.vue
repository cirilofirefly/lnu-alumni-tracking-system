<template>
  <div class="container-fluid p-4">
    <div class="row">
      <div class="col-6">
        <div class="col-12 p-3 bg-light shadow rounded">
          <div
            class="col-12 d-flex justify-content-center align-items-center mb-2"
          >
            <img
              :src="`http://localhost:8000${user[0].student.id_image}`"
              style="width: 150px; height: 150px"
              alt="Id Picture"
              class="border border-dark rounded-circle float-center"
            />
          </div>
          <div class="col-12 mb-3 border border-dark rounded">
            <h4 class="border-bottom border-dark p-2">Basic Information</h4>
            <div class="ps-2 row">
              <div class="col-6">
                <p class="m-0">
                  Student ID:
                  <strong>
                    {{ user[0].student.student_basic_info.student_number }}
                  </strong>
                </p>
                <p class="m-0">
                  Name:
                  <strong>{{
                    `${user[0].student.student_basic_info.last_name},  ${
                      user[0].student.student_basic_info.first_name
                    } ${
                      user[0].student.student_basic_info.suffix == null
                        ? ""
                        : user[0].student.student_basic_info.suffix
                    } ${
                      user[0].student.student_basic_info.middle_name == null
                        ? ""
                        : user[0].student.student_basic_info.middle_name
                    } `
                  }}</strong>
                </p>
                <p class="m-0">
                  Current Address:
                  <strong>
                    {{ user[0].student.student_basic_info.current_address }}
                  </strong>
                </p>
                <p class="m-0">
                  Permanent Address:
                  <strong>
                    {{ user[0].student.student_basic_info.permanent_address }}
                  </strong>
                </p>

                <p class="m-0">
                  Mobile Number:
                  <strong>
                    {{ user[0].student.student_basic_info.mobile_number }}
                  </strong>
                </p>
                <p class="m-0">
                  Telephone Number:
                  <strong>
                    {{ user[0].student.student_basic_info.telephone_number }}
                  </strong>
                </p>
              </div>

              <div class="col-6">
                <p class="m-0">
                  Email:
                  <strong>
                    {{ user[0].student.student_basic_info.email }}
                  </strong>
                </p>
                <p class="m-0">
                  Birthdate:
                  <strong>
                    {{ user[0].student.student_basic_info.birthdate }}
                  </strong>
                </p>
                <p class="m-0">
                  Birthplace:
                  <strong>
                    {{ user[0].student.student_basic_info.birthplace }}
                  </strong>
                </p>
                <p class="m-0">
                  Religion:
                  <strong>
                    {{ user[0].student.student_basic_info.religion }}
                  </strong>
                </p>
                <p class="m-0">
                  Gender:
                  <strong>
                    {{ user[0].student.student_basic_info.gender }}
                  </strong>
                </p>
                <p class="m-0">
                  Civil Status:
                  <strong>
                    {{ user[0].student.student_basic_info.civil_status }}
                  </strong>
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 border border-dark rounded">
            <h4 class="border-bottom border-dark p-2">
              Educational Information
            </h4>
            <div class="ps-2">
              <p class="m-0">
                Student ID:
                <strong>
                  {{ user[0].student.student_basic_info.student_number }}
                </strong>
              </p>
              <p class="m-0">
                Name:
                <strong>{{
                  `${user[0].student.student_basic_info.last_name},  ${
                    user[0].student.student_basic_info.first_name
                  } ${
                    user[0].student.student_basic_info.suffix == null
                      ? ""
                      : user[0].student.student_basic_info.suffix
                  } ${
                    user[0].student.student_basic_info.middle_name == null
                      ? ""
                      : user[0].student.student_basic_info.middle_name
                  } `
                }}</strong>
              </p>

              <p class="m-0">
                Email:
                <strong>
                  {{ user[0].student.student_basic_info.email }}
                </strong>
              </p>
              <p class="m-0">
                Birthdate:
                <strong>
                  {{ user[0].student.student_basic_info.birthdate }}
                </strong>
              </p>
              <p class="m-0">
                Birthplace:
                <strong>
                  {{ user[0].student.student_basic_info.birthplace }}
                </strong>
              </p>
              <p class="m-0">
                Religion:
                <strong>
                  {{ user[0].student.student_basic_info.religion }}
                </strong>
              </p>
              <p class="m-0">
                Gender:
                <strong>
                  {{ user[0].student.student_basic_info.gender }}
                </strong>
              </p>

              <p class="m-0">
                Civil Status:
                <strong>
                  {{ user[0].student.student_basic_info.civil_status }}
                </strong>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="col-12 p-3 bg-light shadow rounded">
          <h3>Latest Happening</h3>
          <div>{{ user[0].student.student_account_info }}</div>
        </div>
      </div>
      <!-- <div class="col-lg-6 col-md-12 bg-light shadow rounded p-3 m-3 ">
        <div>
          <h3>Basic Info</h3>
          <div v-if="user" class="mt-3">
            <h5>
              Name:
              <strong>{{
                `${user[0].student.student_basic_info.last_name}, ${
                  user[0].student.student_basic_info.middle_name == null
                    ? ""
                    : user[0].student.student_basic_info.middle_name
                } ${user[0].student.student_basic_info.first_name}`
              }}</strong>
            </h5>
            <h6>
              Name:
              <strong>{{
                user[0].student.student_basic_info.first_name
              }}</strong>
            </h6>
            <h6>
              Name:
              <strong>{{
                user[0].student.student_basic_info.first_name
              }}</strong>
            </h6>
            <h6>
              Name:
              <strong>{{
                user[0].student.student_basic_info.first_name
              }}</strong>
            </h6>
            <h6>
              Name:
              <strong>{{
                user[0].student.student_basic_info.first_name
              }}</strong>
            </h6>
          </div>
        </div>
        <div>
          <h3>Educational Info</h3>
          <div>
            {{ user }}
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 shadow p-3 m-3 bg-light rounded">
        <div>
          <h1>Latest Happening</h1>
        </div>
      </div> -->
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
};
</script>

<style>
</style>