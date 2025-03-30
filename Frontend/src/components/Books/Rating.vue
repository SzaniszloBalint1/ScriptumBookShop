<template>
    <div class="rating-container">
      <div class="stars-container">
        <span v-for="star in 5" :key="star" 
              class="rating__star"
              @mouseover="hoverRating = star" 
              @mouseleave="hoverRating = 0"
              @click="rateBook(star)">
          <i :class="[
            (hoverRating >= star || currentRating >= star) ? 'fas fa-star' : 'far fa-star',
            {'disabled': alreadyRated}
          ]"></i>
        </span>
        <span v-if="averageRating" class="rating-count">
          ({{ averageRating }})
        </span>
      </div>
      <div v-if="message" class="rating-message" :class="messageType">
        {{ message }}
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
              hoverRating: 0,
              message: '',
              messageType: ''
          }
      },
      computed: {
          currentRating() {
              return this.$store.getters['rating/getUserRating'](this.bookId);
          },
          averageRating() {
              return this.$store.getters['rating/getAverageRating'](this.bookId);
          },
          alreadyRated() {
              return this.$store.getters['rating/hasUserRated'](this.bookId);
          },
          isLoggedIn() {
              return this.$store.getters['user/user'] !== null;
          }
      },
      methods: {
          async rateBook(rating) {
              // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
              if (!this.isLoggedIn) {
                  this.message = 'Az értékeléshez be kell jelentkezned!';
                  this.messageType = 'error';
                  setTimeout(() => {
                      this.message = '';
                  }, 3000);
                  return;
              }
              
              // Ha már értékelte, ne engedjük újraértékelni
              if (this.alreadyRated) {
                  this.message = 'Ezt a könyvet már értékelted!';
                  this.messageType = 'warning';
                  setTimeout(() => {
                      this.message = '';
                  }, 3000);
                  return;
              }
              
              // Értékelés küldése a szervernek
              try {
                  const userId = this.$store.getters['user/user'].id;
                  await this.$store.dispatch('rating/addRating', {
                      user_id: userId,
                      book_id: this.bookId,
                      rating: rating
                  });
                  
                  this.message = 'Sikeres értékelés!';
                  this.messageType = 'success';
                  
                  // Frissítjük a könyv értékelési adatait
                  this.$store.dispatch('rating/getBookRatings', this.bookId);
              } catch (error) {
                  this.message = error.response?.data?.message || 'Hiba történt az értékelés során!';
                  this.messageType = 'error';
              }
              
              setTimeout(() => {
                  this.message = '';
              }, 3000);
          }
      },
      mounted() {
          // Könyv értékeléseinek lekérése
          this.$store.dispatch('rating/getBookRatings', this.bookId);
          
          // Felhasználó értékeléseinek lekérése
          if (this.isLoggedIn) {
              this.$store.dispatch('rating/getUserRatings');
          }
      }
  }
  </script>
  
  <style scoped>
  .rating-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 10px 0;
  }
  
  .stars-container {
      display: flex;
      align-items: center;
  }
  
  .rating__star {
      cursor: pointer;
      font-size: 1.5rem;
      margin: 0 2px;
  }
  
  .rating-count {
      margin-left: 5px;
      font-size: 0.9rem;
      color: #666;
  }
  

  .fas.fa-star {
      color: #FFD700;
  }
  

  .far.fa-star {
      color: #ccc;
  }
  
  .disabled {
      cursor: not-allowed;
      opacity: 0.7;
  }
  
  .rating-message {
      margin-top: 5px;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 0.9rem;
  }
  
  .success {
      background-color: #d4edda;
      color: #155724;
  }
  
  .error {
      background-color: #f8d7da;
      color: #721c24;
  }
  
  .warning {
      background-color: #fff3cd;
      color: #856404;
  }
  </style>