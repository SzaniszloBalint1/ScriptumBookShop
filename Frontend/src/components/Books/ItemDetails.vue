<template>
    <div class="item-details-container">
      <div class="back-button">
        <return-button @step-back="Backto">
          <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </return-button>
      </div>
      
      <section v-if="book" :key="book.id" class="book-section">
        <div class="book-layout">
 
          <div class="book-image-container">
            <img :src="book.cover_image" alt="book cover" class="book-image">
          </div>
  
          <div class="book-details">
            <h2 class="book-title text-center">{{book.title}}</h2>
            <p class="book-author text-center">{{book.author}}</p>
            <p class="book-description">{{book.describe}}</p>
            <Rating :bookId="book.id"></Rating>
          </div>
          

          <div class="book-price-container ">
            <h3>{{book.price}} Ft</h3>
            <cart-button @click="additemtoCart()" class="cart-button">Kosárba</cart-button>
          </div>
        </div>
      </section>
      
      <Comment v-if="book" :bookId="book.id" class="comment-section" />


      <AuthorOtherBooks 
  v-if="book"
  :author="book.author" 
  :currentBookId="book.id"
></AuthorOtherBooks>
    </div>
  </template>

<script>
import ReturnButton from '../../layout/ReturnButton.vue';
import CartButton from '../Cart/CartButton.vue';
import Comment from './Comment.vue';
import Rating from './Rating.vue';
import AuthorOtherBooks from './AuthorOtherBooks.vue';
export default {
    components:{
        ReturnButton,
        CartButton,
        Comment,
        Rating,
        AuthorOtherBooks
    },
    computed: {
        book() {
            return this.$store.getters['book/bookId']; 
        } 
    },
    methods:{
        getBooksId(){
            this.$store.dispatch('book/getDataId', this.$route.params.id);
        },
        Backto(){
            return this.$router.push('/home');
        },
        additemtoCart(){
            const book = {
                id: this.book.id,
                name: this.book.title,
                price: this.book.price,
                img: this.book.cover_image,
            };
            this.$store.commit('cart/addItemToCart', book);
        }
    },
    created(){
        this.getBooksId();
    }
}
</script>

<style scoped>
.item-details-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.back-button {
  margin-bottom: 20px;
}

.fa-solid {
  color: #2E8B57;
  cursor: pointer;
}

.book-section {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 30px;
  margin-bottom: 30px;
}

.book-layout {
  display: flex;
  gap: 40px;
  align-items: flex-start;
}


.book-image-container {
  flex: 0 0 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.book-image {
  width: 200px;
  height: 300px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  object-fit: cover;
}

.book-details {
  flex: 1 1 auto;
  display: flex;
  flex-direction: column;
}

.book-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 10px;
  color: #333;
}

.book-author {
  font-size: 18px;
  font-weight: 500;
  margin-bottom: 20px;
  color: #555;
}

.book-description {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 20px;
  color: #666;
}


.book-price-container {
  flex: 0 0 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border-radius: 8px;
  background-color: #f9f9f9;
}

h3 {
  
  font-weight: 700;
  color: #2E8B57;
  margin-bottom: 15px;
}

.cart-button {
  background-color: #2E8B57;
  border: none;
  color: white;
    padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 600;
  font-size: 16px;
  width: 100%;
  max-width: 180px;
  transition: background-color 0.3s;
}

.cart-button:hover {
  background-color: #24704a;
}

.comment-section, .most-viewed-section {
  margin-top: 30px;
}


@media (max-width: 900px) {
  .book-layout {
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .book-image-container {
    flex: 0 0 45%;
    margin-right: 5%;
  }
  
  .book-price-container {
    flex: 0 0 45%;
    margin-left: auto;
  }
  
  .book-details {
    flex: 0 0 100%;
    order: 3;
    margin-top: 30px;
  }
}


@media (max-width: 768px) {
  .book-layout {
    flex-direction: column;
  }
  
  .book-image-container {
    flex: 0 0 auto;
    width: 100%;
    margin-right: 0;
    margin-bottom: 20px;
    align-items: center;
  }
  
  .book-price-container {
    flex: 0 0 auto;
    width: 100%;
    margin-left: 0;
    margin-top: 20px;
  }
  
  .book-details {
    text-align: center;
  }
}


@media (max-width: 480px) {
  .item-details-container {
    padding: 10px;
  }
  
  .book-section {
    padding: 15px;
  }
  
  .book-title {
    font-size: 20px;
  }
  
  .book-author {
    font-size: 16px;
  }
  
  .book-description {
    font-size: 14px;
  }
  
  .book-image {
    width: 150px;
    height: 225px;
  }
  
  h3 {
    font-size: 20px;
  }
  
  .cart-button {
    padding: 10px;
    font-size: 14px;
  }
  
  .fa-solid {
    margin-left: 10px;
  }
}
</style>