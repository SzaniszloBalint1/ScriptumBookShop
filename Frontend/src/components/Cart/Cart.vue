<template>
    <ReturnButton @step-back="BookPage"><i class="fa-solid fa-arrow-left fa-2xl"></i></ReturnButton>
    <div class="container  text-white" id="div1" v-if="hasCart">
        <div class="d-flex  justify-content-around">
            <div class="header">
                <h5 >Könyvek</h5>
            </div>
            <div class="header">
                <h5>Könyv címe</h5>
            </div>
            <div class="header">
                <h5>Könyv mennyisége</h5>
            </div >
            <div class="header">
                <h5>Könyv ára</h5>
            </div>
            <div class="header">
                <h5>Könyv összege</h5>
            </div>
        </div>
    </div>
        <div class="container p-2 text-white" id="div2">
            <ul v-if="hasCart">
                <li v-for="item in cart" :key="item.id">
                    <div class="img">
                        <img :src="item.img" alt="könyv">
                    </div>
                    
                    <div class="name">
                        <h3 >{{ item.name}}</h3>
                    </div>

                    <div class="buttons">
                        <button @click="addItemToTheCart(item)" class="operators"><i class="fa-solid fa-plus"></i></button>
          <input type="number"  min="0" readonly v-model.number="item.quantity">
            <button @click="removeItemFromCart(item)" class="operators"><i class="fa-solid fa-minus"></i></button> 
                    </div>
                    <div class="book_price">
                        <h3 > {{ item.price }} Ft</h3>
                    </div>
                    <div class="total">
                        <h3 >{{  item.price * item.quantity }} Ft</h3>
                    </div>
                        <button @click="removeItemCart(item)" class="trash"><i class="fa-solid fa-trash" style="color: #ff0000;"></i>Törlés</button>
                </li>
            </ul>
            <hr>
           
            <h3 v-if="hasCart" class="final">Végösszeg: {{ getTotalSum }} Ft</h3>
            <div v-else>
               <h2>A kosár tartalma üres</h2>

            </div>
            <router-link class="btn" to="/purchase">Fizetés</router-link>
        </div>
        
</template>

<script>
import ReturnButton from '../../layout/ReturnButton.vue';

export default {
    components:{
        ReturnButton
    },

    computed:{
        cart(){
            return this.$store.getters['cart/cart'];
        },
        hasCart(){
            return this.$store.getters['cart/hascart'];
        },
    getTotalSum(){
        return this.$store.getters['cart/totalSum'];
    }
    },
    methods:{
        addItemToTheCart(item){
            return this.$store.commit('cart/addItemToCart',item);
        },
        removeItemFromCart(item){
            return this.$store.commit('cart/removeAnItemFromCart',item);
        },
        BookPage(){
            return this.$router.push('/home');
        },
        removeItemCart(item){
             this.$store.commit('cart/removeItemFromCart',item);
            if(!this.hasCart){
                this.$router.push('/home');
            }
        }
    },
    created(){
        if(!this.hasCart){
            this.$router.push('/home');
        }
    }
   
}
</script>


<style scoped>
.header{
    text-align: center;
    display: flex;
    width:20%;
    padding: 5px 10px;
    margin: 10px 0px 10px 24px;
     
}
.final{
    color: #333333;
    text-align: center;
}



.buttons{
    width: 20%;
    padding: 1px;

    .operators{
    border: none;
    background-color: transparent;
    cursor: pointer;
    .fa-solid{
        color: #333333;
        margin: 1px;
    }    
}
}
hr{
    color: #333333;
    width: 110%;
}
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

div{
    h2{
        color: #333333;
        text-align: center;
    }
}

.trash{
    background-color: transparent;
    border: none;
    cursor: pointer;
    .fa-trash{
        color: #333333;
        margin: 10px;
    }
}

#div2{
    border-radius: 3px;
    max-width: 64%;
    margin:10px auto;
    
}
.fa-solid{
    margin-top: 100px;
    margin-left: 30px;
    cursor: pointer;
    color: #2E8B57;
}
.name{
    justify-content: right;
    color: #333333;
    display: flex;  
    width: 20%;
    margin: 30px;

}
.book_price{
    color: #333333;
    justify-content: left;
    display: flex;
    width: 15%;
    padding: 5px;
    margin: 5px;
}

.total{
    color: #333333;
    justify-content: right;
    display: flex;
    gap: 10px;
    width: 20%;
    margin: 5px;

    
}
h3{
    margin: 30px;
    
}
#div1{
  
   background-color:#2E8B57 ;
    border-radius: 3px;
   max-width: 62.5%;
    margin:10px auto;
    text-align: center;
    display: block;
    
}
img{
    display: flex;
    height: 200px;
    width: 140px;
    border-radius: 5px;
    margin: 10px;
}


ul{
    padding: 0px;
    margin-top: 10px;
    list-style: none;
}




input{
    width: 60px;
    height: 40px;
    text-align: center;
    border-radius: 2px;
    border: 1px solid rgba(231, 229, 229, 0.6);
    margin: 5px;
}

li{
    border: 1px solid rgba(231, 229, 229, 0.3);
    background-color: rgba(231, 229, 229, 0.1);
    border-radius: 5px;
    margin: 5px;
    display: flex;
    text-align: center;
    align-items: center;
    gap: 10px;


}
li:hover{
    background-color: rgba(231, 229, 229, 0.5);
}
button{
    height: 100%;
    
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 200px;
    margin: 20px auto;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 1.2rem;
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #2E8B57, #1a5632);
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 15px rgba(46, 139, 87, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}
.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 7px 20px rgba(46, 139, 87, 0.4);
    color: white;
}

.btn:active {
    transform: translateY(1px);
    box-shadow: 0 3px 10px rgba(46, 139, 87, 0.3);
}

.btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.btn:hover::before {
    left: 100%;
}


@media (max-width: 575px) {
    .header{
        width: 100%;
        padding: 5px 10px;
        margin: 10px 0px 10px 24px;
        
    }
  #div1, #div2 {
    max-width: 100%;
    margin: 0 auto;
  }
  li {
    flex-direction: column;
    align-items: center;
  }
  .buttons, .book_price, .name, .total {
    width: 100%;
    justify-content: center;
    margin: 5px 0;
  }
  img {
    height: 120px;
    width: 90px;
  }
}


@media (min-width: 576px) and (max-width: 991px) {
  #div1, #div2 {
    max-width: 90%;
  }
  li {
    flex-wrap: wrap;
    justify-content: space-around;
  }
  .buttons, .book_price, .name, .total {
    width: auto;
    margin: 10px;
  }
  img {
    height: 150px;
    width: 110px;
  }
}



@media (min-width: 992px) {
  #div1, #div2 {
    max-width: 70%;
  }
  li {
    flex-direction: row;
    justify-content: space-between;
  }
}
</style>
