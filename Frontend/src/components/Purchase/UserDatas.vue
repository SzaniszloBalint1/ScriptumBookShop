<template>
  <div class="container mt-5">
    <div  v-if="this.$store.getters['order/orderStep'] === 1">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h2 class="text-center mb-4">Adja meg adatait</h2>
          <div class="order-summary">
            <h4>Kosár összesítése</h4>
            <p>Termékek száma: {{ cartItemCount }}</p>
            <p class="total-price">Végösszeg: <strong>{{ getTotalSum }} Ft</strong></p>
          </div>
          
          <Form @submit="onSubmitUserData">
            <div class="form-group">
              <label for="name">Teljes név</label>
              <Field name="name" type="text" id="name" class="form-control" placeholder="Név" :value="userData.FullName" :rules="nameValidate" />
              <ErrorMessage name="name" class="text-danger" />      
            </div>
          
            <div class="form-group">
              <label for="email">Email cím</label>
              <Field name="email" type="email" id="email" class="form-control" placeholder="Email" :value="userData.email" :rules="emailValidate" />
              <ErrorMessage name="email" class="text-danger" />
            </div>
        
            <div class="form-group">
              <label for="address">Szállítási cím</label>
              <Field name="address" type="text" id="address" class="form-control" placeholder="Cím" :value="orderData.address"  :rules="addressValidate" />
              <ErrorMessage name="address" class="text-danger" />
            </div>

            <div class="form-group">
              <label for="phone">Telefonszám</label>
              <Field name="phone" type="text" id="phone" class="form-control" placeholder="Telefonszám" :value="userData.PhoneNumber" :rules="phoneValidate" />
              <ErrorMessage name="phone" class="text-danger" />
            </div>
            
            <div class="form-group">
              <label>Szállítási mód</label>
              <div class="form-check">
                <Field name="deliveryMethod" type="radio" id="home" value="home" class="form-check-input"   :rules="deliveryMethodValidate" />
                <label for="home" class="form-check-label">Házhozszállítás (+990 Ft)</label>
              </div>
              <div class="form-check">
                <Field name="deliveryMethod" type="radio" id="pickup" value="pickup" class="form-check-input" :rules="deliveryMethodValidate" />
                <label for="pickup" class="form-check-label">Személyes átvétel (ingyenes)</label>
              </div>
              <ErrorMessage name="deliveryMethod" class="text-danger" />
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mt-4">Tovább a rendelés áttekintéséhez</button>
          </Form>
        </div>
      </div>
    </div>
    <div v-if="this.$store.getters['order/orderStep'] === 2">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h2 class="text-center mb-4">Rendelés áttekintése</h2>
          
          <div class="order-summary card mb-4">
            <div class="card-header">
              <h5>Szállítási adatok</h5>
            </div>
            <div class="card-body">
              <p><strong>Név:</strong> {{ this.$store.getters['order/orderData'].name }}</p>
              <p><strong>Email:</strong> {{ this.$store.getters['order/orderData'].email }}</p>
              <p><strong>Telefonszám:</strong> {{ this.$store.getters['order/orderData'].phone }}</p>
              <p><strong>Cím:</strong> {{ this.$store.getters['order/orderData'].address }}</p>
              <p><strong>Szállítási mód:</strong> {{ this.$store.getters['order/deliveryMethodText'] }}</p>
            </div>
          </div>
          
          <div class="order-items card mb-4">
            <div class="card-header">
              <h5>Rendelt termékek</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Könyv</th>
                      <th>Ár</th>
                      <th>Mennyiség</th>
                      <th>Összesen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in cartItems" :key="item.bookId">
                      <td>{{ item.name }}</td>
                      <td>{{ item.price }} Ft</td>
                      <td>{{ item.quantity }}</td>
                      <td>{{ item.price * item.quantity }} Ft</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="payment-summary card mb-4">
            <div class="card-header">
              <h5>Fizetési összesítő</h5>
            </div>
            <div class="card-body">
              <p><strong>Termékek összesen:</strong> {{ getTotalSum }} Ft</p>
              <p><strong>Szállítási díj:</strong> {{ this.$store.getters['order/deliveryFee'] }} Ft</p>
              <p class="total-price"><strong>Végösszeg:</strong> {{ getTotalSum + this.$store.getters['order/deliveryFee'] }} Ft</p>
              <p><strong>Fizetési mód:</strong> Utánvét</p>
            </div>
          </div>
          
          <div class="d-flex justify-content-between">
            <button @click="this.$store.dispatch('order/setOrderStep', 1)" class="btn btn-secondary">Vissza</button>
            <button @click="confirmOrder" class="btn btn-primary" :disabled="this.$store.getters['order/isLoading']">
              <span v-if="this.$store.getters['order/isLoading']" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Rendelés véglegesítése
            </button>
          </div>
          
          <div v-if="this.$store.getters['order/orderError']" class="alert alert-danger mt-3">
            {{ this.$store.getters['order/orderError'] }}
          </div>
        </div>
      </div>
    </div>

    <div v-if="this.$store.getters['order/orderStep'] === 3">
      <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
          <div class="success-icon mb-4">
            <i class="fas fa-check-circle text-success fa-5x"></i>
          </div>
          <h2 class="mb-3">Köszönjük a rendelését!</h2>
          <p class="mb-4">
            A rendelését sikeresen rögzítettük. A rendelés azonosítója: 
            <strong>{{ this.$store.getters['order/orderId'] }}</strong>
          </p>
          <p>A rendelés részleteiről küldtünk egy visszaigazoló emailt a megadott email címre.</p>
          
          <button @click="$router.push('/home')" class="btn btn-primary mt-4">
            Vissza a főoldalra
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';


export default {
  components: {
    Form,
    Field,
    ErrorMessage
  },
  data() {
    return {
      step: 1,
      deliveryFee: 0,
      orderData: {
        name: '',
        email: '',
        address: '',
        phone: '',
        deliveryMethod: 'pickup',
      },
      orderId: '',
      isLoading: false,
      totalPrice: 0
    };
  },
  computed: {
    cartItems() {
      return this.$store.getters['cart/cart'] || [];
    },
    cartItemCount() {
      return this.cartItems.reduce((total, item) => total + item.quantity, 0);
    },
    getTotalSum(){
      return this.$store.getters['cart/totalSum'];
    },
    userData() {
      return this.$store.getters['user/user'] || {};
    },
    deliveryMethodText() {
      return this.orderData.deliveryMethod === 'home' ? 'Házhozszállítás (+990 Ft)' : 'Személyes átvétel (ingyenes)';
    },
    orderdata() {
      return this.$store.getters['order/orderdata'];
    }
  },
  methods: {
    nameValidate(value) {
      if (!value) {
        return 'A név megadása kötelező';
      }
      if (value.length < 3) {
        return 'A névnek legalább 3 karaktert kell tartalmaznia';
      }
      return true;
    },

    emailValidate(value) {
      if (!value) {
        return 'Az email cím megadása kötelező';
      }
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(value)) {
        return 'Nem megfelelő email cím formátum';
      }
      return true;
    },

    addressValidate(value) {
      if (!value) {
        return 'A cím megadása kötelező';
      }
      if (value.length < 5) {
        return 'A címnek legalább 5 karaktert kell tartalmaznia';
      }
      return true;
    },

    phoneValidate(value) {
      if (!value) {
        return 'A telefonszám megadása kötelező';
      }
      if (value.length < 8) {
        return 'A telefonszámnak legalább 8 karaktert kell tartalmaznia';
      }
      const phoneRegex = /^[0-9+\s-]+$/;
      if (!phoneRegex.test(value)) {
        return 'Érvénytelen telefonszám formátum';
      }
      return true;
    },

    deliveryMethodValidate(value) {
      if (!value) {
        return 'Kérjük, válasszon szállítási módot';
      }
      return true;
    },
    
   
    onSubmitUserData(values) {
      this.$store.dispatch('order/saveUserData', {
        ...values,
        paymentMethod: 'Utánvét'
      });
      
      this.$store.dispatch('order/setOrderStep', 2);
    },
    async confirmOrder() {
    try {
      console.log("Rendelés elküldése kezdődik");
      const success = await this.$store.dispatch('order/confirmOrder');
      console.log("Rendelés elküldve, eredmény:", success);
      
      if (!success) {
        alert("Hiba történt: " + this.$store.getters['order/orderError']);
      }
    } catch (error) {
      console.error("Váratlan hiba történt:", error);
      alert("Váratlan hiba történt a rendelés során");
    }
  },

  },
  created() {
    if (!this.$store.getters['cart/cart'] || this.$store.getters['cart/cart'].length === 0) {
      this.$router.push('/cart');
    }
    
    this.$store.dispatch('order/resetOrder');
  }
};
</script>
