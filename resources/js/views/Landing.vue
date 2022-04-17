<template>
  <div class="landing">
    <div class="container vh-100 h-100">
      <div class="d-flex flex-column justify-content-center h-100">
        <div class="">
          <img src="/images/logo.png" alt="" height="100" />
        </div>
        <div class="text-white mt-4">
          <h5 class="ls-sm mb-1 text-uppercase">Leyte Normal University</h5>
          <h1 class="ls-sm fw-bold heading text-uppercase">
            Alumni Information <br />
            Tracking System
          </h1>
          <h1></h1>
        </div>
        <div class="d-block mt-3">
          <router-link to="signin" class="btn btn-outline-light btn-lg">SIGN-IN</router-link>
        </div>
        <p class="text-white mt-2">Dont have an account? <router-link to="signup" class="text-white ml-2">Create Account</router-link></p>
      </div>
    </div>
    <!-- <div class="navbar">
      <router-link to="signin" class="nav-item me-5">
        <span>
          <i class="bi bi-box-arrow-in-left"></i>
          SIGN IN
        </span>
      </router-link>
    </div> -->
    <!-- <div class="landing-content">
      <div class="logo"></div>
      <div class="title-header">
        <p>Leyte Normal University</p>
        <h1>Alumni Information</h1>
        <h3>Tracking System</h3>
      </div>
      <router-link to="signup" class="btn2 btn btn-outline-light rounded-pill">
        <span> <i class="bi bi-person-circle me-2"></i> SIGN UP </span>
      </router-link>

      <div class="arrow bounce lg"></div>
    </div> -->
  </div>
</template>
