<template>
    <ReturnButton @step-back="Back"><i class="fa-solid fa-arrow-left fa-lg" style="color: #63E6BE;"></i></ReturnButton>
    <div class="container mt-5 mb-5 p-5"> 
        <h1>Role List</h1>
        <form @submit.prevent="updateRole">
            <div class="form-group" v-if="user">
                <label for="role">Username</label>
                <input type="text" class="form-control" :value="user.Username"  disabled>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" v-model="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3 rounded container">Submit</button>
        </form>
    </div>
</template>


<script>
import ReturnButton from '@/layout/ReturnButton.vue';
export default {
    components:{
        ReturnButton
    },
    data(){
        return{
            selectedRole:null,
            role:"",
        }
    },
    computed:{
        selectRole(role){
            this.selectedRole=role;
        },
       users(){
              return this.$store.getters['user/users'];  
       },
       userId(){
            return this.$route.params.id;
       },
         user(){
       return this.users.find(u => String(u.id) === String(this.userId));
    },
}, 
    methods:{
        Back(){
            this.$router.push('/settings');
        },
        getUsers(){
            this.$store.dispatch('user/fetchUsers');
        },
        async updateRole(){
           const response=await this.$store.dispatch('user/updateRole',{
                id: this.userId,
                role: this.role,
           });
           if(response){
               console.log("Role sikeresen hozzáadva",response);
               this.$router.push('/settings');
           }
           else{
                console.log("Role hozzáadása sikertelen",response);
           }
        }
    },
    watch: {
        users: {
            immediate: true,
            handler() {
                const user = this.users.find(u => String(u.id) === String(this.userId));
                if (user) {
                    this.role = user.role;
                }
            }
        }
    },
    created(){
        this.getUsers();
    }
}

</script>

<style scoped>

h1{
    text-align: center;
}

</style>