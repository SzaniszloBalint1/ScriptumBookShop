<template>
    <div class="card-group mt-5 p-3 m-3" v-if="hasbooks">
        <Card v-for="book in booksForCategory" :key="book.id" :id="book.id" :name="book.title" :price="book.price" :img="book.cover_image" :author="book.author" >
        </Card>
    </div>
<p v-else>Nincs könyv adat amit megjelenítsünk</p>
</template>


<script>
import Card from '@/layout/Card.vue';
export default{
    components:{
        Card
    },
    watch:{
        $route(){
            this.getCategoryId();
        }
},
    computed:{
        hasbooks(){
            return this.$store.getters['book/hasBooks'];
        },
        booksForCategory() {
            const categoryId = this.$store.getters['category/categoryId'] ? this.$store.getters['category/categoryId'].id : null;
            return categoryId ? this.$store.getters['book/booksForCategory'](categoryId) : [];
        }
    },
    methods:{
       async getBooks(){
            await this.$store.dispatch('book/getData');
        },
      async  getCategoryId(){
        await this.$store.dispatch('category/getCategoryId',this.$route.params.id);
        },
    },
    created(){
        this.getBooks();
        this.getCategoryId();
    }
   

}

</script>

<style scoped>
div{
    display: flex;
    flex-wrap: wrap;
    gap: 80px; 
    justify-content: center; 
}

</style>
