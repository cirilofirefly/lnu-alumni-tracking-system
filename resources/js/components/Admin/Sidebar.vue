<template>
  <div class="sidebar">
    <div class="logo">
      <img src="../../../images/logo.png" alt="" srcset="" />
      <span class="logo-text">LNU AITS</span>
    </div>
    <ul class="nav-links">
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'admin.dashboard' }">
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
      <li class="nav-item" >
        <div class="main" @click.prevent="showSubMenu">
          <div class="nav-link">
            <box-icon class="icon" color="#fff" name="user-circle"></box-icon>
            <span class="p-0"> Alumni Management </span>
          </div>
          <box-icon
            :name=" toggled ? 'chevron-up' : 'chevron-down'"
            class="icon"
            type="solid"
            color="#fff"
          ></box-icon>
        </div>

        <ul class="sub-menu" v-if="toggled">
          <li class="sub-item">
            <router-link
              class="sub-link"
              :to="{ name: 'admin.alumni.approval' }"
            >
              <box-icon
                class="icon"
                type="solid"
                color="#fff"
                name="inbox"
              ></box-icon>
              <span>Approval</span>
            </router-link>
          </li>
          <li class="sub-item">
            <router-link
              class="sub-link"
              :to="{ name: 'admin.alumni.id-request' }"
            >
              <box-icon class="icon" name="id-card" color="#ffffff"></box-icon>
              <span>ID Request </span></router-link
            >
          </li>
          <li class="sub-item">
            <router-link class="sub-link" :to="{ name: 'admin.alumni.batch' }">
              <box-icon color="#fff" name="history"></box-icon>
              <span>Batch </span></router-link
            >
          </li>
          <li class="sub-item">
            <router-link
              class="sub-link"
              :to="{ name: 'admin.alumni.records' }"
            >
              <box-icon class="icon" name="data" color="#ffffff"></box-icon>
              <span>Records </span></router-link
            >
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'admin.event' }">
            <box-icon
              color="#fff"
              type="solid"
              name="calendar-event"
            ></box-icon>
            <span>Event Management</span></router-link
          >
        </div>
      </li>
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'admin.account' }">
            <box-icon color="#fff" type="solid" name="user"></box-icon>
            <span>Account Management</span></router-link
          >
        </div>
      </li>
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'admin.feedback' }">
            <box-icon color="#fff" type="solid" name="envelope"></box-icon>
            <span>Feedback</span></router-link
          >
        </div>
      </li>
      <li class="nav-item">
        <div class="main">
          <router-link class="nav-link" :to="{ name: 'admin.notification' }">
            <box-icon color="#fff" type="solid" name="bell-ring"></box-icon>
            <span>Notification</span></router-link
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