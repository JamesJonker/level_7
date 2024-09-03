<template>
    <div>
      <p>You are being logged out...</p>
    </div>
  </template>
  
  <script>
  export default {
    async created() {
      await this.$auth.logout();
      this.$router.push('/login');
      this.$root.$emit('reload-header');
    }
  }
  </script>