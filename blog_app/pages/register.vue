<template>
  <div class="register-container">

    <div>
        <AppHeader/>
      </div>

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
        const response = await this.$axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password
        });
        this.$router.push('/login');
      } catch (error) {
        console.error('Registration failed:', error.response.data);
        alert('Registration failed: ' + error.response.data.message);
      }
    }
  }
};
</script>

<style scoped>


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