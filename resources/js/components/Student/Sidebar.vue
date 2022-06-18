<template>
  <div class="sidebar bg-dark">
    <div class="logo">
      <img src="../../../images/logo.png" alt="" srcset="" />
      <span class="logo-text">LNU AITS</span>
    </div>
    <ul class="nav-links">
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'student.home' }">
            <box-icon
              class="icon"
              type="solid"
              color="#fff"
              name="dashboard"
            ></box-icon>
            <span>Dashboard</span></router-link
          >
        </div>
      </li>
        <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'student.id-request' }">
            <box-icon color="#fff" type="solid" name="envelope"></box-icon>
            <span>ID Management</span></router-link
          >
        </div>
      </li>
       <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'student.events' }">
            <box-icon
              class="icon"
              type="solid"
              color="#fff"
              name="message-dots"
            ></box-icon>
            <span>Event</span></router-link
          >
        </div>
      </li>
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'student.account-setting' }">
            <box-icon
              color="#fff"
              type="solid"
              name="user-circle"
            ></box-icon>
            <span>Account Settings</span></router-link
          >
        </div>
      </li>
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'student.feedbacks' }">
            <box-icon color="#fff" type="solid" name="user"></box-icon>
            <span>Feedback</span></router-link
          >
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import "boxicons";
export default {
  data() {
    return {
      toggled: false,
    };
  },
  methods: {
    showSubMenu() {
      this.toggled = !this.toggled;
    },
  },
};
</script>

<style>
</style>