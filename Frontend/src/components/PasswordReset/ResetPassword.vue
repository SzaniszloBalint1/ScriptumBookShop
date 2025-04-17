<template>
    <div class="container mt-5 mb-5 p-5">
        <h1>Jelszó visszaállítása</h1>
        <p>Kérjük, adjon meg egy új jelszót fiókjához.</p>
        
        <div v-if="statusMessage" :class="['alert', statusSuccess ? 'alert-success' : 'alert-danger']">
            {{ statusMessage }}
        </div>
        
        <Form @submit="resetPassword">
            <div class="form-group">
                <label for="email">E-mail cím</label>
                <Field type="email" class="form-control" id="email" name="email" v-model="email" :rules="emailvalidate" readonly></Field>
                <ErrorMessage name="email" class="text-danger"></ErrorMessage>
            </div>
            
            <div class="form-group">
                <label for="password">Új jelszó</label>
                <Field type="password" class="form-control" id="password" name="password" v-model="password" :rules="passwordvalidate" required></Field>
                <ErrorMessage name="password" class="text-danger"></ErrorMessage>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Jelszó megerősítése</label>
                <Field type="password" class="form-control" id="password_confirmation" name="password_confirmation" :rules="password_confirmationvalidate" v-model="password_confirmation" required></Field>
                <ErrorMessage name="password_confirmation" class="text-danger"></ErrorMessage>
            </div>
            
            <input type="hidden" name="token" v-model="token">
            
            <br>
            <button type="submit" class="btn btn-success" :disabled="loading">
                {{ loading ? 'Feldolgozás...' : 'Jelszó módosítása' }}
            </button>
            <button type="button" class="btn btn-danger" @click="goToLogin">Mégsem</button>
        </Form>
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
            email: '',
            password: '',
            password_confirmation: '',
            token: '',
            loading: false,
            statusMessage: '',
            statusSuccess: false,
        }
    },
    created() {
        this.token = this.$route.params.token;
        this.email = this.$route.query.email;
        
        if (!this.token || !this.email) {
            this.statusSuccess = false;
            this.statusMessage = 'Érvénytelen jelszó-visszaállítási link.';
            setTimeout(() => {
                this.$router.push('/');
            }, 3000);
        }
    },
    methods: {
        async resetPassword() {
            this.loading = true;
            this.statusMessage = '';
            
            try {
                const response=await this.$store.dispatch('user/PasswordReset', {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    token: this.token
                });
                
                this.statusSuccess = true;
                this.statusMessage = response.message || 'A jelszó sikeresen módosítva.';
                
                setTimeout(() => {
                    this.$router.push('/login?reset=success');
                }, 3000);
            } catch (error) {
                this.statusSuccess = false;
                if (error.response && error.response.data) {
                    this.statusMessage = error.response.data.message || 'Hiba történt a jelszó visszaállítása közben.';
                } else {
                    this.statusMessage = 'Hiba történt a jelszó visszaállítása közben.';
                }
                console.error('Password reset error:', error);
            } finally {
                this.loading = false;
            }
        },
        passwordvalidate(value){
            this.password = value;
            if (value.length < 8) {
                return 'A jelszónak legalább 8 karakter hosszúnak kell lennie.';
            }
            return true;
        },
        password_confirmationvalidate(value){
            if (value !== this.password) {
                return 'A két jelszó nem egyezik meg.';
            }
            if(value.length<8){
                return 'A jelszónak legalább 8 karakter hosszúnak kell lennie.';
            }
            return true;
            
        },
        emailvalidate(value){
            if(!value){
                return "Ne hagyd üresen a mezőt";
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                return 'Nem megfelelő email cím formátum.';
            }
            return true;
        },
        goToLogin() {
            this.$router.push('/login');
        }
    }
}
</script>

<style scoped>
.container {
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 50%;
}

.form-group {
    margin-bottom: 1rem;
}

button {
    margin-top: 1rem; 
    width: 300px;
    margin-left: 5rem;
    height: 2.8rem;
    text-align: center;
    font-size: 1.2rem;
    border-radius: 5px;
    font-weight: bold;
}

.text-danger {
    color: red;
}
</style>