<template>
  <header class="navbar">
    <div class="navbar-container">
      <router-link to="/home" class="navbar-link scriptum-logo">Scriptum</router-link>
      <nav class="navbar-links" :class="{ 'mobile-open': mobileMenuOpen }">
        <div class="search-container">
          <div class="navbar-search">
            <input 
              type="text" 
              placeholder="Keresés..." 
              v-model="search" 
              @input="debounceSearch"
            >
          </div>
          <button class="search-button" @click="gototheBook"><i class="fas fa-search"></i></button>
        </div>
        
        <div class="dropdown scriptum-dropdown" v-if="search && !isLoading">
          <ul class="dropdown-menu scriptum-dropdown-menu" v-if="searchResults.length">
            <li v-for="book in searchResults" :key="book.id" :id="book.id" class="dropdown-item">
              <router-link class="router" :to="'/books/' + book.id">
                <img :src="book.cover_image" alt="book cover" class="book-cover" />
                <span class="book-info">
                  <strong>{{ book.title }}</strong>
                  <em>{{ book.price }} Ft</em>
                </span>
              </router-link>
            </li>
          </ul>
          <div class="dropdown-menu scriptum-dropdown-menu no-results" v-else-if="search.length > 2 && !isLoading">
            Nincs találat a keresett kifejezésre.
          </div>
        </div>

        <div class="dropdown scriptum-dropdown" v-if="isLoading">
          <div class="dropdown-menu scriptum-dropdown-menu">
            <div class="loading-spinner">
              <span class="spinner"></span> Keresés...
            </div>
          </div>
        </div>
      </nav>

      <div class="nav-right">
        <div class="navbar-actions" v-if="!isAuthenticated">
          <router-link to="/register" class="navbar-link">Regisztráció</router-link>
          <span class="separator">/</span>
          <router-link to="/login" class="navbar-link">Bejelentkezés</router-link>
        </div>

        <div class="user-controls" v-if="isAuthenticated">
          <div class="dropdown user-dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user fa-lg"></i>
              <span class="username">{{ isuser.Username }}</span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" @click="UserSettings">Adatok <i class="fa-solid fa-user fa-mg"></i></a></li>
              <li><a class="dropdown-item" @click="UsersOrder">Rendeléseim <i class="fa-solid fa-cart-shopping"></i></a></li>
              <li><a class="dropdown-item" @click="logout">Kijelentkezés <i class="fa-solid fa-right-to-bracket" style="color: #63E6BE;"></i></a></li>
            </ul>
          </div>
          
          <router-link to="/admin" class="btn btn-danger admin-btn" v-if="isuser.role==='admin' && isAuthenticated">
            <i class="fa-solid fa-user-shield"></i>
          </router-link>
          
          <div class="cart-container">
            <span class="separator">│</span>
            <router-link to="/cart" class="navbar-link cart-link">
              <i class="fas fa-shopping-cart"></i>
            </router-link>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container dropdown-container">
      <TheDropdown></TheDropdown>
    </div>
  </header>
</template>
<script>
import TheDropdown from './TheDropdown.vue';

export default {
  components: {
    TheDropdown
  },
  data() {
    return {
      search: "",
      showDropdown: false,
      mobileMenuOpen: false,
      debounceTimer: null
    }
  },
  watch: {
    $route() {
      this.mobileMenuOpen = false; 
      this.clearSearch();
    },
    search(value) {
      this.showDropdown = value.length > 0;
    }
  },
  computed: {
    isuser() {
      return this.$store.getters['user/user'];
    },
    isAuthenticated() {
      return this.$store.getters['user/hasuser'];
    },
    filteredBooks() {
      return this.$store.getters['book/filteredBooks'](this.search);
    },
    searchResults() {
      return this.$store.getters['search/searchResults'];
    },
    isLoading() {
      return this.$store.getters['search/isLoading'];
    },
    hasError() {
      return this.$store.getters['search/hasError'];
    },
  },
  methods: {
    UsersOrder(){
      this.$router.push('/usersorder');
    },
    UserSettings() {
      this.$router.push('/usersettings');
    },
    logout() {
      this.$store.dispatch('user/logoutUser');
    },
   
    debounceSearch() {
      clearTimeout(this.debounceTimer);
      this.debounceTimer = setTimeout(() => {
        if (this.search.length > 2) {
          this.$store.dispatch('search/searchBooks', this.search);
        } else if (this.search.length === 0) {
          this.clearSearch();
        }
      }, 300);
    },
    gototheBook() {
      if (this.search && this.filteredBooks.length > 0) {
        this.$router.push(`/books/${this.filteredBooks[0].id}`);
      }
    },
    clearSearch() {
      this.search = "";
      this.$store.dispatch('search/clearSearch');
    },
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
    }
  },
  created() {
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) {
        this.mobileMenuOpen = false;
      }
    });
  },
  beforeUnmount() {
    window.removeEventListener('resize', () => {});
  }
};
</script>

<style scoped>
.loading-spinner {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 15px;
  color: #666;
}

.spinner {
  display: inline-block;
  width: 18px;
  height: 18px;
  border: 2px solid rgba(46, 139, 87, 0.3);
  border-radius: 50%;
  border-top-color: #2E8B57;
  animation: spin 0.8s linear infinite;
  margin-right: 10px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}
.navbar {
  background-color: #f3f3f0;
  color: #333333;
  padding: 15px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: relative;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
}

.scriptum-logo {
  font-size: 24px;
  font-weight: bold;
  color: #2E8B57;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-right: 20px;
  text-decoration: none;
  white-space: nowrap;
}

.scriptum-logo:hover {
  color: #2E8B57;
}

.navbar-links {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-grow: 1;
  color: #333333;
}



.navbar-search {
  display: flex;
  align-items: center;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px 0 0 4px;
  padding: 10px 15px;
  width: 100%;
  flex-grow: 1;
}

.navbar-search input {
  border: none;
  outline: none;
  width: 100%;
  font-size: 14px;
  display: flex;
  background: transparent;
}

.search-button {
  background-color: #2E8B57;
  border: none;
  padding: 8px 40px;
  border-radius: 0 4px 4px 0;
  color: #fff;
  cursor: pointer;
}

.search-button i {
  color: #fff;
  font-size: 16px;
}

.dropdown-container {
  position: relative;
  display: flex;
  top: 25px;
  padding: 10px 80px;
  margin-top: 5px;
  justify-content: center;
}

.navbar-link {
  background-color: transparent;
  padding: 10px 40px;
  display: flex;
  border-radius: 5px;
  color: #333333;
  flex-grow: 0;
  text-decoration: none;
  white-space: nowrap;
}

.navbar-link:hover {
  color: #2E8B57;
}

.navbar-actions {
  display: flex;
  align-items: center;
}

.separator {
  color: #333333;
  margin: 0 10px;
}

.nav-right {
  display: flex;
  align-items: center;
}

.user-controls {
  display: flex;
  align-items: center;
}

.user-dropdown {
  margin-right: 10px;
}

.username {
  margin-left: 5px;
  font-weight: 600;
}

.cart-container {
  display: flex;
  align-items: center;
}

.cart-link i {
  font-size: 24px;
  cursor: pointer;
}



.scriptum-dropdown {
  position: absolute;
  z-index: 1000;
  width: 50px;
  left: 0;
  right: 70vh;
  margin-left: auto;
  margin-right: auto;
}

.search-container {
  display: flex;
  width: 500px;
  margin-right: 15px;
  position: relative; 
}
.dropdown-menu.scriptum-dropdown-menu {
  display: block !important;
  opacity: 1 !important;
  visibility: visible !important;
  background-color: white !important;
  width: 400px !important;
  border: 1px solid #ccc !important;
  border-radius: 4px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  max-height: 300px;
  overflow-y: auto;
  margin: 0 !important; 
  padding: 0;
}
.fa-solid{
  margin-left:7px;
  margin-top: 3px;
}
.dropdown-item {
  margin: 10px 0;
  display: flex;
  padding: 10px 10px;
  transition: background-color 0.2s;
}

.dropdown-item:hover {
  background-color: #f5f5f5;
}

.dropdown-item .router {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: #333333;
  width: 100%;
}

.book-cover {
  width: 40px;
  height: 60px;
  object-fit: cover;
  margin-right: 10px;
}

.book-info {
  display: flex;
  flex-direction: column;
  font-size: 14px;
}

.book-info strong {
  font-weight: 600;
  margin-bottom: 4px;
}

.no-results {
  padding: 15px;
  text-align: center;
  color: #666;
}


.mobile-menu-toggle {
  display: none;
  font-size: 24px;
  cursor: pointer;
  margin-right: 15px;
}

@media (max-width: 1200px) {
  .mobile-menu-toggle {
    display: block;
  }

  .navbar-container {
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .scriptum-logo {
    order: 0;
    margin-right: auto;
  }

  .nav-right {
    order: 1;
    margin-left: auto;
  }

  .navbar-links {
    order: 2;
    width: 100%;
    margin-top: 15px;
  }

  .search-container {
    width: 100%;
    max-width: none;
    margin: 0;
  }

  .scriptum-dropdown {
    width: 100%;
    left: 400px;
    top: 100%;
    
  }

  .dropdown-menu.scriptum-dropdown-menu {
    width: 100% !important;
    max-width: none;
    left: 0 !important;
    right: auto !important;
  }
  .navbar-links:not(.mobile-open) {
    display: flex;
  }

  .navbar-links.mobile-open {
    display: flex;
  }
}

@media (min-width: 1201px) {
  .scriptum-dropdown {
    width: fixed;
    top: 70px;
    left:0;
  }
}

@media (min-width: 993px) and (max-width: 1200px) {
  .scriptum-dropdown {
    width: fixed;
    top: 15vh;
    left: 0;
  }
}

@media (min-width: 769px) and (max-width: 992px) {
  .scriptum-dropdown {
    width: fixed;
    top: 15vh;
    left: 0;
    right: 0;
  }
}

@media (min-width: 577px) and (max-width: 768px) {
  .scriptum-dropdown {
    width: fixed;
    top: 15vh;
    left: 0;
    right: 0;
  }
  
  
  
}

@media (max-width: 576px) {
  .scriptum-dropdown {
    width: fixed;
    top: 20vh;
    left: 0;
    right: 0; 
  }


}

</style>