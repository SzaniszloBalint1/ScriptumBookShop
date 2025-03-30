<template>
  
 <div class="card-container">
    <div class="card small-card">
      <img :src="img" loading="lazy" class="card-img-top" :alt="name" @click="incrementViewCountAndGoToDetail(id)"  />
      <div class="card-body ">
        <h3 class="card-title">{{ name }}</h3>
        <h4 class="card-subtitle">{{ author }}</h4>
        <h5 class="card-subtitle-success">{{ price }} Ft</h5>
        <cart-button @click="additemtoCart()" class="button">Kosárba</cart-button>
        <slot></slot>
      </div>
    </div>
  </div>

</template>



<script>
import CartButton from '@/components/Cart/CartButton.vue';
export default{
  components:{
    CartButton
  },
  props:{
    id:{
      type:Number,
      required:true
    },
    name:{
      type:String,
      required:true
    },
    price:{
      type:Number,
      required:true
    },
    img:{
      type:String,
      required:true
    },
    author:{
      type:String,
      required:true
    }
  },
  methods:{
    additemtoCart(){
      const book = {
      id: this.id,
      name: this.name,
      price: this.price,
      img: this.img,
      author: this.author,
      quantity: 1
    };
    this.$store.commit('cart/addItemToCart',book);
      },
      incrementViewCountAndGoToDetail(id) {
      this.$store.dispatch("book/incrementViewCounter", id)
        .then(() => {
          this.$router.push(`/books/${id}`);
        })
        .catch((err) => {
          console.error("Növelés sikertelen:", err);
          this.$router.push(`/books/${id}`); 
        });
    },
  }
}
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
.button {
  background-color: #2E8B57;
  border: none;
  color: white;
  padding: 8px 0px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 8px;
  width: 100px;
  text-align: center;
  font-size: 0.9rem;
}

.card-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}

.card {
  margin-top: 8px;
  width: 160px;         
  max-width: 160px;      
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  font-size: 14px;       
  font-family: 'Oswald', sans-serif;
  color: #333333;
}

.card:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
  transition: all 0.8s ease;
}

.card-img-top {
  cursor: pointer;
  width: 160px;         
  height: 240px;         
  object-fit: cover;
}

.card-body {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;        
  width: 100%;
}

.card-title {
  font-size: 0.9rem;     
  font-weight: bold;
  min-height: 40px;     
  margin: 5px 0;
  padding: 0 5px;
}

.card-subtitle {
  color: #666;
  font-size: 0.9rem;     
  min-height: 30px;      
  margin: 5px 0;
  padding: 0 5px;
}

.card-subtitle-success {
  font-size: 0.9rem;    
  margin: 5px 0;
}


</style>
