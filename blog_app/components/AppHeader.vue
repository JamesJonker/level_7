<template>
    <header class="header">
      <h1 class="title">Blog Platform</h1>
      <ul>
        <div v-if="$auth.loggedIn">

          <!-- <li>
              <nuxt-link to="/posts">Posts</nuxt-link>
          </li> -->
        </div>
        <div v-if="$auth.loggedIn">
          <li>
          <nuxt-link to="/logout">Logout</nuxt-link>
        </li>
        </div>
        <!-- <div v-if="$auth.loggedIn">
          <li>
            <nuxt-link to="/about">About</nuxt-link>
          </li>
        </div> -->
        <div v-if="!$auth.loggedIn">
          
            <li>
              <nuxt-link :to="linkTo">{{ linkText }}</nuxt-link>
          </li>
        </div>
      </ul>
    </header>
  </template>
  
  <script>

import { mapGetters, mapActions } from 'vuex';

  export default {
    name: "AppHeader",

    data() {
    return {
      user: null
    };
  },
    mounted() {
      console.log("AppHeader", 'james');
    this.$root.$on('user-logged-out', this.reloadHeader);
      },
      methods: {
        async reloadHeader() {
          this.user = await this.$auth.fetchUser();
        }
      },

      computed: {
    // Check if the current path is '/register'
    isRegisterPage() {
      return this.$route.path === '/register';
    },
    // Determine the link destination and text based on the current path
    linkTo() {
      return this.isRegisterPage ? '/login' : '/register';
    },
    linkText() {
      return this.isRegisterPage ? 'Cancel' : 'Register';
    }
  }

  };
  </script>

  <style>
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px dotted #ccc;
  }
  
  .header .title {
    font-size: 3rem;
    color: #526488;
  }
  
  .header ul {
    display: flex;
  }
  
  .header a {
    display: inline-block;
    background: #333;
    color: #fff;
    padding: 0.3rem 1rem;
    margin-right: 0.5rem;
  }
  </style>