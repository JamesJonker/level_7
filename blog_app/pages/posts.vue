<template>
    <div class="posts-page">

        <div class="top_section">
            <div aria-colindex="1">
                <h1>Posts</h1>
            </div>
              <button class="addBtn" @click="dialog = true" > + New post</button>
              <new-post-modal :dialog.sync="dialog" @submit="addPost"></new-post-modal>
        </div>
           
      <div v-if="!posts">
        There are no posts to view
      </div>
      <div v-if="posts">
        <div v-for="post in posts" :key="post.id" class="post">

          <div class="top_section_posts ">
            <div aria-colindex="1">
              <h2>{{ post.title }}</h2>
            </div>
            <v-btn
              icon
              @click="deletePost(post)"
              class="delete-button"
            >
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </div>
          <div>
            <p>{{ post.body }}</p>
          </div>

          
          
    
          <div class="comments-section">
            <h3>Comments</h3>
            
          <CommentBubble :comments="post.comments" />

            <form @submit.prevent="addComment(post.id)">
              <input
                v-model="newComment[post.id]"
                type="text"
                placeholder="Write a comment..."
              />
              <button type="submit">Add Comment</button>
            </form>
          </div>
        </div>
        
      </div>

    </div>
  </template>
  
  <script>

import NewPostModal from '/components/newPostModal.vue';
import CommentBubble from '~/components/CommentBubble.vue';

  export default {
    middleware: 'auth',
    components: {
    NewPostModal,
  },
  components: {
    CommentBubble
  },

    data() {
      return {
        posts: [],
        newComment: {},
        dialog: false,
        showComments: false,
      };
    },
    async fetch() {
      console.log("fetching")
      const response = await this.$axios.$get('/posts');
      console.log(response);
      this.posts = response;

      for (let post of this.posts) {
          await this.fetchComments(post);
          if (!post.comments) {
            this.$set(post, 'comments', []);
          }
        }

    },
    
    methods: {

      toggleComments() {
      this.showComments = !this.showComments;
    },
      async fetchComments(post) {
      try {
        const response = await this.$axios.get(`/posts/${post.id}/comments`);
        this.$set(post, 'comments', response.data);
      } catch (error) {
        console.error(`Error fetching comments for post ${post.id}:`, error);
      }
    },
      async addPost(post) {
        try {
          const response = await this.$axios.post('/posts', post);
          console.log('Post created:', response.data);
          window.location.reload();
          this.posts.unshift(post);
        } catch (error) {
          console.error('Failed to create post:', error);
        }
      },
      async addComment(postId) {

        console.log("This is post id", postId);

        console.log("check newcommenttext", this.newComment[postId])
        if (this.newComment[postId] === undefined) {
            this.$set(this.newComment, postId, ''); 
          }
       
      const commentText = this.newComment[postId];
      
      if (!commentText) return; 

      try {
        const response = await this.$axios.post(`/posts/${postId}/comments`, { body: commentText });
        const newComment = response.data.comment;

        const post = this.posts.find(post => post.id === postId);
        post.comments.push(newComment);

        this.newComment[postId] = '';
      } catch (error) {
        console.error(`Error adding comment to post ${postId}:`, error);
      }
    },
    deletePost(postinfo) {

      // postId = post.id;
        // Confirm before deleting
        console.log("auth", this.$auth.user);
        console.log("check Post",postinfo.id);

        if(this.$auth.user.id === postinfo.user_id){

          if (confirm("Are you sure you want to delete this post?")) {
  
  
            // Call the API to delete the post
            this.$axios
              .delete(`/posts/${postinfo.id}`)
              .then(() => {
                // Remove the post from the list
                this.posts = this.posts.filter((post) => post.id !== postinfo.id);
              })
              .catch((error) => {
                console.error("There was an error deleting the post:", error);
              });
          }
        }else{
          alert("You are not the Auther of the post. You can not remove this Post!")
        }
      }
    }
      
  };

  </script>

  <style scoped>
  .comment-bubble {
  display: inline-block;
  position: relative;
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

.commentBtn{
  background-color: #eee;
  border: none;
  border-radius: 50%;
  padding: 10px;
  cursor: pointer;
  font-size: 16px;
}
  .posts-page {
    padding: 20px;
  }
  
  .post {
    margin-bottom: 40px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 20px;
  }
  
  .comments-section {
    margin-top: 20px;
  }
  
  .comment {
    margin-bottom: 10px;
  }
  
  form {
    display: flex;
    margin-top: 10px;
  }
  
  input[type="text"] {
    flex: 1;
    padding: 8px;
    margin-right: 10px;
  }
  
  button {
    padding: 8px 16px;
  }


  .top_section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px dotted #ccc;
  }
  .top_section_posts {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    /* border-bottom: 1px dotted #ccc; */
  }
  .addBtn{
    display: inline-block;
    background: #333;
    color: #fff;
    padding: 0.3rem 1rem;
    margin-right: 0.5rem;
  }
  </style>