<template>
  <div class="container-fluid admin-books">
    <h1 class="mt-5">Admin könyvlista</h1>
    <div class="action-buttons">
      <router-link class="btn btn-success mt-3 me-2 mb-3" to="/create">Új könyv létrehozás</router-link>  
      <router-link class="btn btn-success mt-3 me-2 mb-3" to="/settings">Userek</router-link>
    </div>

    <div class="table-responsive d-none d-md-block">
      <table class="table table-hover table-bordered">
        <thead>
          <tr class="text-center">
            <th scope="col">Kép</th>
            <th scope="col">Cím</th>
            <th scope="col">Szerző</th>
            <th scope="col" class="d-none d-lg-table-cell">ISBN</th>
            <th scope="col" class="d-none d-lg-table-cell">Kiadás dátuma</th>
            <th scope="col">Ár</th>
            <th scope="col">Szerkesztés</th>
            <th scope="col">Törlés</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr v-for="book in books" :key="book.id">
            <td><img :src="book.cover_image" alt="book" class="book-cover"></td>
            <td>{{ book.title }}</td>
            <td>{{ book.author }}</td>
            <td class="d-none d-lg-table-cell">{{ book.isbn }}</td>
            <td class="d-none d-lg-table-cell">{{ book.publish_date }}</td>
            <td>{{ book.price }} Ft</td>
            <td><router-link class="btn btn-primary" :to="'/update/'+book.id">Szerkesztés</router-link></td>
            <td><button class="btn btn-danger" @click="deleteBooks(book.id)">Törlés</button></td>
          </tr>
        </tbody>
      </table>
    </div>

 
    <div class="book-cards d-md-none">
      <div class="book-card" v-for="book in books" :key="book.id">
        <div class="card-header d-flex">
          <img :src="book.cover_image" alt="book" class="book-cover me-3">
          <div>
            <h5 class="card-title">{{ book.title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ book.author }}</h6>
            <p class="card-text fw-bold">{{ book.price }} Ft</p>
          </div>
        </div>
        <div class="card-body">
          <div class="book-details">
            <p><strong>ISBN:</strong> {{ book.isbn }}</p>
            <p><strong>Kiadás dátuma:</strong> {{ book.publish_date }}</p>
          </div>
          <div class="book-actions">
            <router-link class="btn btn-primary me-2" :to="'/update/'+book.id">Szerkesztés</router-link>
            <button class="btn btn-danger" @click="deleteBooks(book.id)">Törlés</button>
          </div>
        </div>
      </div>
    </div>
    
    <router-view></router-view>
  </div>
</template>

<script>
export default {
    computed:{
        books(){
            return this.$store.getters['book/books'];       
        },  
    },
    methods:{
     getBooks(){
            this.$store.dispatch('book/getData');
     },
     deleteBooks(id){
        const isConfirmed = confirm("Biztosan törölni szeretnéd?");
      if (isConfirmed) {
        this.$store.dispatch('book/deleteBook',id);
      }
     }
    },
    created() {
        this.getBooks(); 
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

.admin-books {
  font-family: 'Roboto', sans-serif;
  background-color: #f3f3f0;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

.action-buttons {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  margin-bottom: 20px;
}

.table-responsive {
  overflow-x: auto;
  margin-bottom: 30px;
}

table {
  width: 100%;
  background-color: #f3f3f0 !important;
}

td {
  vertical-align: middle !important;
}

.book-cover {
  width: 80px;
  height: 120px;
  object-fit: cover;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}


.book-cards {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-bottom: 30px;
}

.book-card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  overflow: hidden;
}

.card-header {
  padding: 15px;
  background-color: #fff;
  border-bottom: 1px solid #eee;
}

.card-body {
  padding: 15px;
  background-color: #fff;
}

.book-details {
  margin-bottom: 15px;
}

.book-details p {
  margin-bottom: 5px;
  background-color: #fff;
}

.book-actions {
  display: flex;
  justify-content: center;
  gap: 10px;
  background-color: #fff;
}


@media (max-width: 992px) {
  .book-cover {
    width: 70px;
    height: 105px;
  }
}

@media (max-width: 768px) {
  .action-buttons {
    justify-content: center;
  }
  
  .book-card .book-cover {
    width: 60px;
    height: 90px;
  }
  
  .card-title {
    font-size: 16px;
    background-color: #fff;
  }
  
  .card-subtitle {
    font-size: 14px;
    background-color: #fff;
  }
}

@media (max-width: 576px) {
  .action-buttons .btn {
    width: 100%;
    margin-right: 0 !important;
  }
  
  .book-actions {
    flex-direction: column;
  }
  
  .book-actions .btn {
    width: 100%;
    margin: 5px 0;
  }
}
</style>