<template>
<div class="dropdown">
  <button class="btn btn-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
   Könyvek
  </button>
  <ul class="dropdown-menu dropdown-menu-white">
    <p><strong>Kategóriák</strong></p>
    <hr>
    <li  v-for="category in categories" :key="category.id" :id="category.id"><router-link class="navbar-links" :to="'/categories/'+category.id">{{ category.CategoryName }}</router-link></li>
  </ul>
</div>

</template>

<script>


export default{
        computed:{
           categories(){
            return this.$store.getters['category/categories'];
           },
           hascategories(){
            return this.$store.getters['category/hascategories'];
           }
        },
        methods:{
            getCategory(){
                this.$store.dispatch('category/getCategories');
            },
            goToItemDetail(id){
              return this.$router.push(`/categories/${id}`);
            },
        },
        created(){
            this.getCategory();
        }
}
</script>


<style scoped>
p{
  margin-top: 10px;
}
.dropdown-menu {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
  width: 300px;
  padding: 10px;
}
.dropdown:hover .dropdown-menu {
  display: block;
  transition: all 1s ease;
}
.dropdown {
  position: relative;
  display:block;
}
button{
  color: #333333;
}
button:hover{
  
  color: #333333;
  border-bottom-color: #f39c12; 
}
button:visited{
  color: white; 
  border-bottom-color: #f39c12;

}
button::after{
  display: none;
  color: white; 
  border-bottom-color: #f39c12;
}


.navbar-links{
  color: #333333;
  display:flexbox;

  text-decoration: none;
  margin-bottom: 10px;
  max-height: 100px;
}
.navbar-links:hover{
  color: #333333; 
  text-decoration:underline;
  margin-bottom: 10px;
}

</style>


