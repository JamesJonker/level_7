<template>
    <v-dialog v-model="localDialog" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Add New Post</span>
        </v-card-title>
  
        <v-card-text>
          <v-form ref="form" v-model="valid">
            <v-text-field
              label="Title"
              v-model="title"
              :rules="[v => !!v || 'Title is required']"
              required
            ></v-text-field>
  
            <v-textarea
              label="Content"
              v-model="body"
              :rules="[v => !!v || 'Content is required']"
              required
            ></v-textarea>
          </v-form>
        </v-card-text>
  
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeDialog">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="submitForm">Submit</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </template>
  
  <script>

  export default {
    middleware: 'auth',

    mounted() {
    if (this.$auth.loggedIn) {
      console.log('User is logged in:', this.$auth.user);
    } 
  },
    
    props: {
      dialog: {
        type: Boolean,
        required: true,
      },
    },
    data() {
      return {
        localDialog: this.dialog,
        title: '',
        body: '',
        valid: false,
      };
    },
    watch: {
      dialog(val) {
        this.localDialog = val;
      },
      localDialog(val) {
        this.$emit('update:dialog', val);
      },
    },
    methods: {
      closeDialog() {
        this.localDialog = false;
      },

      submitForm() {
        if (this.$refs.form.validate()) {
        const newPost = {
          user_id: this.$auth.user.id,
          title: this.title,
          body: this.body,
        };
        this.$emit('submit', newPost);

        this.closeDialog();
        this.title = '';
        this.body = '';
        this.$refs.form.reset();
      }
      },
    },
  };
  </script>
  
  <style scoped>
  .headline {
    font-weight: bold;
  }
  </style>
  