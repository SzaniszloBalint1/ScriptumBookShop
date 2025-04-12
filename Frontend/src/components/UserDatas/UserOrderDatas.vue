<template>
    <div class="container mt-5 p-3 mb-3 bg-white rounded shadow-sm border">
      <h2>Rendeléseim</h2>
    </div>
    
    <div class="container rounded shadow-sm border" v-for="order in orderData" :key="order.id">
      <div class="order-header">
        <div class="order-info">
          <h2><strong>Rendelésszám: #{{ order.reference_id }}</strong></h2>
          <h3>Rendelés dátuma: {{ order.OrderDate }}</h3>
        </div>
        <div class="status-badge">
          <strong>{{ order.Status }}</strong>
        </div>
      </div>
      
      <hr>
      
      <div class="product-count d-flex justify-content-between">
        <div>{{ order.order_items.length }} termék</div>
        <div>{{ order.TotalAmount }} Ft</div>
      </div>
     
      <div v-for="product in order.order_items" :key="product.id" class="product-item">
        <div class="product-image">
          <img v-if="product.book && product.book.cover_image" :src="product.book.cover_image" 
               class="img-fluid rounded" alt="Termék kép">
        </div>
        <div class="product-details">
          <h4>{{ product.book ? product.book.title : 'Termék' }}</h4>
          <p>{{ product.book.author }}</p>
          <p>{{ product.Quantity }} db</p>
        </div>
        <div class="product-price">
          {{ product.UnitPrice }} Ft
        </div>
      </div>
      
      <div class="summary-container">
        <div class="shipping-section">
          <p class="shipping-title"><strong>Szállítási adatok</strong></p>
          <div v-if="order.shipping">
            <p>{{ order.shipping.name  }}</p>
            <p>{{ order.shipping.address  }}</p>
            <p>{{ order.shipping.phone }}</p>
          </div>
          <div v-else>
            <p>Nincs szállítási adat</p>
          </div>
        </div>
        
        <div class="totals-section">
          <div class="order-total-row">
            <span>Részösszeg:</span>
            <span>{{ order.order_items.reduce((sum, item) => sum + (item.UnitPrice * item.Quantity), 0) }} Ft</span>
          </div>
          <div class="order-total-row">
            <span>Szállítási díj:</span>
            <span>{{ order.shipping ? order.shipping.fee : '990' }} Ft</span>
          </div>
          <div class="order-total-row final-total">
            <span><strong>Végösszeg:</strong></span>
            <span><strong>{{order.TotalAmount }} Ft</strong></span>
          </div>
        </div>
      </div>
    </div>
  </template>


<script>
export default {
        computed:{
            orderData(){
                return this.$store.getters['order/orderdata'];
            }
        },
        methods:{
            getData(){
                this.$store.dispatch('order/getData');
            },
            
        },
        created(){
            this.getData();
        }
}

</script>

<style scoped>
.container {
  max-width: 800px;
  margin: auto;
  background-color: #fff;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  padding: 20px;
  margin-bottom: 20px;
}

.container h2 {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 15px;
  color: #212529;
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  margin-bottom: 15px;
}

.order-info {
  margin-bottom: 0;
}

.order-info h3 {
  font-size: 1rem;
  font-weight: 400;
  margin-bottom: 5px;
  color: #212529;
}

.status-badge {
  display: inline-block;
  padding: 6px 12px;
  background-color: #d4edda;
  color: #155724;
  border-radius: 25px;
  font-size: 0.875rem;
}

.product-item {
  display: flex;
  margin-bottom: 15px;
  padding-bottom: 15px;
  padding: 10px;
  background-color: #f8f9fa;
  border-radius: 5px;
}

.product-image {
  width:100px;
  height: 150px;
  background-color: #e9ecef;
  margin-right: 15px;
  flex-shrink: 0;
}

.product-details {
  flex: 1;
}

.product-details h4 {
  font-size: 1rem;
  font-weight: 600;
  margin-top: 5px;
  margin-bottom: 5px;
}

.product-details p {
  margin-bottom: 5px;
  color: #6c757d;
  font-size: 0.9rem;
}

.product-price {
  margin-left: auto;
  font-weight: 600;
  font-size: 1.1rem;
  align-self: center;
  padding-right: 10px;
}

.product-count {
  display: flex;
  justify-content: space-between;
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 15px;
}

.summary-container {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.shipping-section {
  width: 48%;
  padding: 15px;
  background-color: #f8f9fa;
  border-radius: 5px;
}

.totals-section {
  width: 48%;
  padding: 15px;
  background-color: #f8f9fa;
  border-radius: 5px;
}

.shipping-section p {
  margin-bottom: 5px;
}

.shipping-title {
  font-weight: 600;
  margin-bottom: 10px;
}

.order-total-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.final-total {
  margin-top: 15px;
  font-size: 1.1rem;
}

hr {
  margin: 20px 0;
  border: 0;
  border-top: 1px solid #dee2e6;
}
</style>
