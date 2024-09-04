<template>
  <div>
    <div v-if="$auth.loggedIn">
      <p>Welcome, {{ $auth.user.name }}</p>
    </div>
    <div v-else>
      <p>Please log in to access this content.</p>
      <nuxt-link to="/login">Login</nuxt-link>
    </div>
  </div>
</template>


<script>
export default {
  middleware: 'auth',

  async asyncData({ $auth, redirect }) {
    if ($auth.loggedIn) {
      // Redirect to the posts page if logged in
      return redirect('/posts');
    }else{
      return redirect('/login');
    }
  }

}
</script>