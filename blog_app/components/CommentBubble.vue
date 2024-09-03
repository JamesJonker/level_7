<template>
    <div class="comment-bubble">
      <button @click="toggleComments">
        💬 {{ comments.length }} 
      </button>
      <transition name="fade">
        <div v-if="showComments" class="comments-section">
          <ul>
            <li v-for="comment in comments" :key="comment.id">
              <!-- {{comment}} -->
              {{ comment.body }} - <small>by User {{ comment.user_id }}</small>
              <v-btn
                  icon
                  @click="deleteComment(comment.id, comment.user_id, comment.post_id)"
                  class="delete-button"
                >
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
            </li>
          </ul>
        </div>
      </transition>
    </div>
  </template>
  
  <script>
  export default {
    middleware: 'auth',
    mounted() {
    if (this.$auth.loggedIn) {
      console.log('User is logged in:', this.$auth.user.id);
    } 
  },
    props: {
      comments: {
        type: Array,
        required: true,
        default: () => []
      }
    },
    data() {
      return {
        showComments: false
      };
    },
    methods: {
      toggleComments() {
        this.showComments = !this.showComments;

      },
        deleteComment(commentId, user_id, postId) {
          if(user_id === this.$auth.user.id){

            if (confirm("Are you sure you want to delete this comment?" + commentId + user_id + postId )) {
              // Call your API to delete the comment
              this.$axios
                .delete(`/comments/${commentId}`)
                .then(() => {
                  // Remove the comment from the list
                  this.comments = this.comments.filter(
                    (comment) => comment.id !== commentId
                  );
                })
                .catch((error) => {
                  console.error("There was an error deleting the comment:", error);
                });
            }
          }else{
            alert("You are not the Auther of this comment you can not delete this commene!")
          }

        // Confirmation prompt before deleting

      }
   }
  };
  </script>
  
  <style scoped>
  .comment-bubble {
    display: inline-block;
    position: relative;
  }
  button {
    background-color: rgb(26, 168, 216);
    border: none;
    border-radius: 50%;
    padding: 10px;
    cursor: pointer;
    font-size: 16px;
  }
  .comments-section {
    margin-top: 10px;
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  </style>