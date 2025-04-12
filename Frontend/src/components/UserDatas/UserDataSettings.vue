<template>
   
    <div class="container mt-5">
        <h2>Személyes adatok</h2>
        <div v-if="statusMessage" 
             :class="['status-message', statusSuccess ? 'status-success' : 'status-error']">
            {{ statusMessage }}
        </div>
        <Form @submit="updateUser" v-if="userData">
            <div class="form-group">
                <label for="Username">Felhasználónév</label>
                <Field type="text" id="Username" class="form-control" v-model="userData.username" name="Username" :rules="validateUsername" />
                <ErrorMessage name="Username" class="error-text" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <Field type="email" id="email" class="form-control" v-model="userData.email" name="email" :rules="validateEmail" />
                <ErrorMessage name="email" class="error-text" />
            </div>
            <div class="form-group">
                <label for="PhoneNumber">Telefonszám</label>
                <Field type="text" id="PhoneNumber" class="form-control" v-model="userData.PhoneNumber" name="PhoneNumber" :rules="validatePhone" />
                <ErrorMessage name="PhoneNumber" class="error-text" />
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-success">Mentés</button>
                <button type="button" class="btn btn-secondary" @click="goToBack">Vissza</button>
            </div>
        </Form>
        <div v-else class="loading">Adatok betöltése...</div>
    </div>
</template>

<script>
import {Form, Field, ErrorMessage} from 'vee-validate';   
export default {
    components:{
        Form,
        Field,
        ErrorMessage
    },
    data(){
        return{
            userData: null,
            statusMessage: '',
            statusSuccess: false,
            isLoading: true,
        }
    },
    computed:{
        currentUser(){
            return this.$store.state.user.user;
        }
    },
    methods:{
        async updateUser() {
            try {
                console.log("Frissítendő adatok:", {
                    id: this.currentUser.id,
                    username: this.userData.username,
                    email: this.userData.email,
                    PhoneNumber: this.userData.PhoneNumber
                });
                
                const success = await this.$store.dispatch('user/updateUserData', {
                    id: this.currentUser.id,
                    username: this.userData.username,
                    email: this.userData.email,
                    PhoneNumber: this.userData.PhoneNumber,
                });
                
                if(success) {
                    this.statusMessage = "Adatok sikeresen frissítve!";
                    this.statusSuccess = true;
                    await this.reloadUserData();
                  
                    setTimeout(() => {
                        this.statusMessage = '';
                        this.$router.push('/home');
                    }, 2000);
                  
                } else {
                    this.statusMessage = "Hiba történt az adatok frissítésekor!";
                    this.statusSuccess = false;
                }
            } catch (error) {
                console.error("Hiba a felhasználói adatok frissítésekor:", error);
                this.statusMessage = "Hiba történt: " + (error.message || "Ismeretlen hiba");
                this.statusSuccess = false;
            }
        },
        
        async reloadUserData() {
            await this.$store.dispatch('user/user');
            
            if (this.currentUser) {
                console.log("Újratöltött felhasználói adatok:", this.currentUser);
                this.userData = {
                    username: this.currentUser.Username || '', 
                    email: this.currentUser.email || '',
                    PhoneNumber: this.currentUser.PhoneNumber || ''
                };
            }
        },
        
        loadUserData() {
            if (this.currentUser) {
                console.log("Felhasználói adatok betöltése:", this.currentUser);
                this.userData = {
                    username: this.currentUser.Username || '', 
                    email: this.currentUser.email || '',
                    PhoneNumber: this.currentUser.PhoneNumber || ''
                };
                this.isLoading = false;
            } else {
                this.$store.dispatch('user/user')
                  .then(() => {
                      if (this.currentUser) {
                          console.log("Felhasználói adatok lekérve:", this.currentUser);
                          this.userData = {
                              username: this.currentUser.Username || '', 
                              email: this.currentUser.email || '',
                              PhoneNumber: this.currentUser.PhoneNumber || ''
                          };
                      } else {
                          console.log("Nincs bejelentkezett felhasználó");
                          this.$router.push('/login');
                      }
                      this.isLoading = false;
                  })
                  .catch(error => {
                      console.error("Hiba a felhasználói adatok lekérésekor:", error);
                      this.isLoading = false;
                      this.$router.push('/login');
                  });
            }
        },
        
        goToBack() {
            this.$router.push('/home');
        },
        
        validateUsername(value) {
            if (!value) return "A felhasználónév megadása kötelező";
            if (value.length < 3) return "A felhasználónév legalább 3 karakter legyen";
            return true;
        },
        
        validateEmail(value) {
            if (!value) return "Az email cím megadása kötelező";
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) return "Érvénytelen email formátum";
            return true;
        },
        
        validatePhone(value) {
            if (!value) return "A telefonszám megadása kötelező";
            const phoneRegex = /^[+]?[(]?[0-9]{1,4}[)]?[-\s.]?[0-9]{1,4}[-\s.]?[0-9]{1,9}$/;
            if (!phoneRegex.test(value)) return "Érvénytelen telefonszám formátum";
            return true;
        }
    },
    created() {
        this.loadUserData();
    }
}
</script>

<style scoped>
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #2E8B57;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.status-message {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    text-align: center;
    font-weight: bold;
}

.status-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

.btn-success {
    background-color: #2E8B57;
    color: white;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.loading {
    text-align: center;
    margin: 30px 0;
    font-style: italic;
    color: #666;
}
</style>