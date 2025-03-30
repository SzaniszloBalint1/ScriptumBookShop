<template>
  <div class="comment-section container mt-2 mb-2 p-3 bg-light rounded shadow-sm border border-secondary rounded bg-white"> 
    <div v-if="successMessage" 
         :class="['alert', successResponse ? 'alert-success' : 'alert-danger']">
      {{ successMessage }}
    </div>
    <div class="comment-form bg-light p-1 rounded">
      <h4>Új hozzászólás a könyvhöz</h4>
      <form @submit.prevent="submitComment">
        <div class="form-group mt-2">
          <textarea v-model="comment" class="form-control" rows="3" placeholder="Írd be a commented" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2 text-center">Küldés</button>
      </form>
    </div>


    <div class="comments-section">
      <h4 class="mt-4">Hozzászólások</h4>
      <div class="comments-container">
        <div v-if="bookComments.length > 0">
          <div v-for="comment in bookComments" :key="comment.id" class="comment-item bg-light p-2 rounded mb-2">
            <div class="comment-header d-flex justify-content-between">
              <span>{{comment.user?.Username}}</span>
              <span>{{formatDate(comment.created_at)}}</span>
            </div>
            <div class="comment-body mt-2 d-flex justify-content-between">
              <div class="comment-text">{{comment.comment}}</div>
              <div v-if="currentUser && currentUser.id == comment.user_id" 
                  @click="deleteComment(comment.id)" 
                  class="delete-comment ms-2">
                <i class="fa-solid fa-trash"></i>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="no-comments">Még nincsenek hozzászólások. Te lehetsz az első!</div>
      </div>
    </div>
  </div>
</template>


<script>

export default {
    props: {
        bookId: {
            type: [Number, String],
            required: true
        }
    },
    data() {
        return {
        comment:"",
        successMessage: "",
        successResponse: false,
        }
    },
    computed: {
        hascomments(){
            return this.$store.getters['comment/hascomments'];
        },
        currentUser(){
            return this.$store.getters['user/user'];
        },
        bookComments() {
            return this.$store.getters['comment/comments'].filter(
                comment => comment.book_id == this.bookId
            );
        },
    },
    methods: {
   
        deleteComment(commentId) {
            this.$store.dispatch('comment/deleteComment', commentId)
            .then(success=>{
                if (success) {
                this.successMessage = "Hozzászólás törölve";
                this.successResponse = true;
                
                this.getComments();
            } else {
                this.successMessage = "Hiba a hozzászólás törlése során";
                this.successResponse = false;
            }
            
            setTimeout(() => {
                this.successMessage = "";
            }, 3000);
            });
        },
        getComments(){
            this.$store.dispatch('comment/getComments');
        },
        async submitComment() {
            if (!this.currentUser) {
                this.successMessage = "Hozzászóláshoz be kell jelentkezned!";
                this.successResponse = false;
                return;
            }
            
            const commentData = {
                user_id: this.currentUser.id,
                book_id: this.bookId,
                comment: this.comment
            };
            
            const result = await this.$store.dispatch('comment/addComment', commentData);
            
            if (result) {
                this.successMessage = "Sikeres hozzászólás";
                this.successResponse = true;
                this.comment = "";
            } else {
                this.successMessage = "Hiba a hozzászólás során";
                this.successResponse = false;
            }
            
            setTimeout(() => {
                this.successMessage = "";
            }, 3000);
        },
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('hu-HU', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    },
    created(){
        this.getComments();
    }
}
</script>


<style scoped>

.delete-comment {
  cursor: pointer;
  color: #dc3545;
  font-size: 1.2rem;
  flex-shrink: 0;
  margin-left: 10px;
}

.comment-body {
  line-height: 1.5;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.comment-text {
  flex-grow: 1;
  word-break: break-word;
}

.date-actions {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.comment-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.comment-section {
  margin-top: 30px;
  margin-bottom: 30px;
}

.comment-form {
  background-color: #f8f9fa;
  padding: 5px;
  border-radius: 5px;
  margin-bottom: 20px;
}

.comments-list {
  margin-top: 20px;
  z-index: 2000;
}


.comments-container {
  max-height: 100px; 
  overflow-y: auto;
  padding-right: 10px;
  border: 1px solid #eaeaea;
  border-radius: 5px;
}

.comment-item {
  padding: 15px;
  border-bottom: 1px solid #eee;
  margin-bottom: 15px;
}

.comment-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.comment-body {
  line-height: 1.5;
}

.no-comments {
  font-style: italic;
  color: #6c757d;
  margin:10px;
}


.comments-container::-webkit-scrollbar {
  width: 8px; 
}

.comments-container::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.comments-container::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.comments-container::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>