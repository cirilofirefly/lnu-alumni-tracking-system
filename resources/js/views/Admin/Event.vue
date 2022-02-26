<template>
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-12">
        <h1 class="text-uppercase fw-bold" style="letter-spacing: 3px">
          Event Management
        </h1>
      </div>
      <div class="col-12 mt-3 shadow p-3">
        <div class="mb-5 mt-2">
          <button class="btn btn-success mx-2" v-b-modal.modal-add>
            <i class="bi bi-plus"></i> Add Event
          </button>
          <button class="btn btn-success">
            <i class="bi bi-journal-text"></i> View all events
          </button>
        </div>
        <div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col" class="text-center">Content</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Sample Event</td>
                <td>Enrollment</td>
                <td>
                  {{
                    sampletext.length > 10
                      ? `${sampletext.substring(0, 10)}...`
                      : sampletext
                  }}
                </td>
                <td class="text-center">
                  <button style="width: 100px" class="btn btn-success mx-2">
                    <i class="bi bi-eye-fill"></i> View
                  </button>
                </td>
                <td class="text-center">
                  <button
                    style="width: 100px"
                    class="btn btn-primary mx-2"
                    @click.prevent="
                    id = 1;
                    $bvModal.show('modal-update')"
                  >
                    <i class="bi bi-pencil-square"></i> Edit</button
                  ><button
                    style="width: 100px"
                    class="btn btn-danger mx-2"
                    @click.prevent="
                      id = 1;
                      $bvModal.show('modal-delete');
                    "
                  >
                    <i class="bi bi-trash3-fill"></i> Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <b-modal
            id="modal-add"
            size="lg"
            centered
            title="Add Event"
            ok-title="Add Event"
          >
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input
                      type="text"
                      class="form-control"
                      id="event-name"
                      placeholder="Event Name"
                    />
                    <label for="event-name">Event Name</label>
                  </div>
                  <div class="mb-3">
                    <select
                      class="form-select"
                      aria-label=".form-select-lg example"
                    >
                      <option :value="null">-- Select an option --</option>
                      <option v-for="category in categories" :key="category.id">
                        {{ category.name }}
                      </option>
                    </select>
                  </div>
                  <div>
                    <vue-editor v-model="content" />
                  </div>
                </div>
              </div>
            </div>
          </b-modal>

          <b-modal
            id="modal-update"
            size="lg"
            centered
            title="Update Event"
            ok-title="Update Event"
            ok-variant="warning"
          >
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input
                      type="text"
                      class="form-control"
                      id="event-name"
                      placeholder="Event Name"
                    />
                    <label for="event-name">Event Name</label>
                  </div>
                  <div class="mb-3">
                    <select
                      class="form-select"
                      aria-label=".form-select-lg example"
                    >
                      <option :value="null">-- Select an option --</option>
                      <option v-for="category in categories" :key="category.id">
                        {{ category.name }}
                      </option>
                    </select>
                  </div>
                  <div>
                    <vue-editor v-model="content" />
                  </div>
                </div>
              </div>
            </div>
          </b-modal>

          <b-modal
            id="modal-delete"
            title="Delete Event"
            ok-variant="danger"
            ok-title="Delete"
          >
            <div class="container-fluid">
              <div class="row">
                <p class="text-center">
                  Are you sure you want to continue this action? <br />
                  Click "Cancel" button to cancel the action
                </p>
              </div>
            </div>
          </b-modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
  components: { VueEditor },
  data() {
    return {
      sampletext: "sample text that the length is greater than 5 kape kape",
      categories: [
        { id: 1, name: "Announcement" },
        { id: 2, name: "Enrollment" },
        { id: 3, name: "Job Hiring" },
      ],
      id: null,
    };
  },
};
</script>

<style>
</style>