

<template>
  
    <v-container>
      <div>
        <AppHeader/>
      </div>
      <v-form @submit.prevent="login" method="POST">
        <v-text-field v-model="email" label="Email" required></v-text-field>
        <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
        <v-btn type="submit">Login</v-btn>
        <div v-if="errorMessage" class="error-message">
          {{errorMessage}}
        </div>
      </v-form>
      
      
    </v-container>
  </template>
  <script>
  
  import AppHeader from '~/components/AppHeader.vue';
  export default {
    // middleware: 'auth',
    data() {
      return {
        email: '',
        password: '',
        errorMessage: ''
      }
    },
    components: {
    AppHeader
  },

    methods: {
      async login() {
        try{

            const response = await this.$auth.loginWith('local', {
              data: {
                email: this.email,  
                password: this.password
              }
            });
            console.log('check response', response)
            this.$router.push('/posts');
            this.$root.$emit('reload-header');
              }catch(error){
                if (error.response && error.response.status === 422) {
              this.errorMessage = error.response.data.errors.email[0];
              this.$router.push('/login');
            } else {
              this.errorMessage = 'An error occurred during login. Please try again.';
              this.$router.push('/login');
              this.email ='';
              this.password = '';

            }

          }
        
        }
        
    }
  }
  </script>
  </script>

  <style scoped>

  
  .error-message {
    color: red;
    margin-top: 10px;
  }
  </style>