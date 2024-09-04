<template>
  <div>
    <div v-if="$auth.loggedIn">
      <p>Welcome, {{ $auth.user.name }}</p>
    </div>
    <div v-else>
      <p>Please log in to access this content.</p>
      <nuxt-link to="/register">Login</nuxt-link>
    </div>
  </div>
</template>


<script>
export default {
  middleware: 'auth',

}
</script>