<template>
    <div class="container mt-5 mb-5 p-5">
        <h1>Elfelejtett Jelszó</h1>
    <p>Kérjük, adja meg e-mail-címét, hogy a jelszó módosításához szükséges információkat elküldhessük Önnek.</p>
    <div v-if="statusMessage" :class="['alert', statusSuccess ? 'alert-success' : 'alert-danger']">
        {{ statusMessage }}
    </div>
    <Form @submit="sendEmail">
        <div class="form-group">
            <label for="email">E-mail cím</label>
            <Field type="email" class="form-control" id="email" name="email" v-model="email" required></Field>
            <ErrorMessage name="email"></ErrorMessage>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Küldés</button>
        <button class="btn btn-danger"@click="goBack">Mégsem</button>
    </Form>
    </div>
   
</template>


<script>
import { Form,Field,ErrorMessage } from 'vee-validate';

export default {
    components: {
        Form,
        Field,
        ErrorMessage
    },
    data() {
        return {
            email: '',
            statusMessage: '',
            statusSuccess: false,
        }
    },
    methods: {
       sendEmail(values) {
            try{
             this.$store.dispatch('user/PasswordResetEmail',{
                email: this.email
            });
            console.log('sikeres password-reset email küldés', values);
                this.statusSuccess = true;
                this.statusMessage = 'Az email elküldve';
            }
            catch (error) {
                this.statusSuccess = false; 
                this.statusMessage = 'Nem sikerült az email küldése: ' + 
                (error.response?.data?.message || error.message);
            }
        },
        emailvalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
        return 'nem megfelelő email cím formátum';
      }
      return true;
            },
            goBack() {
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

</style>
