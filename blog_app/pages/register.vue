<template>
  <div class="register-container">
    <h1>Register</h1>
    <form @submit.prevent="register">


      <div class="form-group">

        <v-card-text>
            <v-form ref="form">
            <v-text-field
              label="name"
              v-model="name"
              :rules="[v => !!v || 'Title is required']"
              required
            ></v-text-field>
  
            <v-text-field
              label="email"
              v-model="email"
              :rules="[v => !!v || 'Title is required']"
              required
            ></v-text-field>

            <v-text-field
              label="password"
              v-model="password"
              :type="showPassword ? 'text' : 'password'"
                prepend-icon="mdi-lock"
                append-icon="mdi-eye"
              :rules="[v => !!v || 'Title is required']"
              required
            ></v-text-field>

          </v-form>
        </v-card-text>
    </div>
      <div class="form-group">
        <button type="submit">Register</button>
        <!-- <v-btn color="blue darken-1" text @click="submit">Register</v-btn> -->
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: ''
    };
  },
  methods: {
    async register() {
      try {
        // Replace with your API endpoint
        const response = await this.$axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password
        });
        // Handle successful registration (e.g., redirect to login)
        this.$router.push('/login');
      } catch (error) {
        // Handle errors
        console.error('Registration failed:', error.response.data);
        alert('Registration failed: ' + error.response.data.message);
      }
    }
  }
};
</script>

<style scoped>
/* Add your styles here */
/* .register-container {
  max-width: 100%;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
} */

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

button {
  width: 100%;
  padding: 10px;
  background: #333;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

</style>