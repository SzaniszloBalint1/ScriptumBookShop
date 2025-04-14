<template>
  <div class="user-settings-container">
    <ReturnButton @step-back="Back" class="return-btn">
      <i class="fa-solid fa-arrow-left fa-2xl" style="color:#2E8B57;"></i>
    </ReturnButton>
    
    <div class="container mt-5">
      <h1 class="m-5">Felhasználók listája</h1>
      
      <!-- Asztali és tablet nézet -->
      <div class="table-responsive d-none d-md-block">
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">Felhasználónév</th>
              <th scope="col">Email</th>
              <th scope="col" class="d-none d-lg-table-cell">Teljes név</th>
              <th scope="col" class="d-none d-lg-table-cell">Telefonszám</th>
              <th scope="col">Jogosultság</th>
              <th scope="col">Művelet</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.Username }}</td>
              <td>{{ user.email }}</td>
              <td class="d-none d-lg-table-cell">{{ user.FullName }}</td>
              <td class="d-none d-lg-table-cell">{{ user.PhoneNumber }}</td>
              <td>{{ user.role }}</td>
              <td>
                <button class="btn btn-primary" @click="getUserId(user.id)">
                  <i class="fa-solid fa-pen-to-square me-1"></i>Szerkesztés
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Mobil nézet kártyákkal -->
      <div class="user-cards d-md-none">
        <div class="user-card" v-for="user in users" :key="user.id">
          <div class="card-header">
            <h5 class="card-title">{{ user.Username }}</h5>
            <span class="badge" :class="getBadgeClass(user.role)">{{ user.role }}</span>
          </div>
          <div class="card-body">
            <div class="user-details">
              <p><i class="fa-solid fa-envelope me-2"></i> {{ user.email }}</p>
              <p><i class="fa-solid fa-user me-2"></i> {{ user.FullName }}</p>
              <p><i class="fa-solid fa-phone me-2"></i> {{ user.PhoneNumber }}</p>
            </div>
            <div class="user-actions">
              <button class="btn btn-primary w-100" @click="getUserId(user.id)">
                <i class="fa-solid fa-pen-to-square me-1"></i>Szerkesztés
              </button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</template>

<script>
import ReturnButton from '@/layout/ReturnButton.vue';
export default {
    components:{
        ReturnButton
    },
    computed:{
        users(){
            return this.$store.getters['user/users'];       
        },
        userId(){
            return this.$store.getters['user/userId'];
        }
    },
    methods:{
      Back(){
        this.$router.push('/admin');
      },
      getUserId(id){
        return this.$router.push(`/role/${id}`);
      },
      getUsers(){
        this.$store.dispatch('user/fetchUsers');
      },
      getBadgeClass(role) {
        switch(role) {
          case 'admin':
            return 'bg-danger';
          case 'user':
            return 'bg-success';
          default:
            return 'bg-secondary';
        }
      }
    },
    created(){
        this.getUsers();
    }
}
</script>

<style scoped>

.fa-solid{
    cursor: pointer;
}
.user-settings-container {
  position: relative;
  padding: 10px;
}

.return-btn {
  position: absolute;
  top: 15px;
  left: 15px;
  z-index: 10;
}

h1 {
  text-align: center;
  margin-top: 20px;
  font-size: 28px;
}


.table-responsive {
  overflow-x: auto;
  margin-bottom: 30px;
}

.table th {
  background-color: #f8f9fa;
  vertical-align: middle;
}

.table td {
  vertical-align: middle;
}

.user-cards {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-bottom: 30px;
}

.user-card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  overflow: hidden;
}

.card-header {
  padding: 15px;
  background-color: #f8f9fa;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-body {
  padding: 15px;
}

.card-title {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
}

.user-details {
  margin-bottom: 20px;
}

.user-details p {
  margin-bottom: 10px;
  display: flex;
  align-items: center;
}

.user-actions {
  display: flex;
  justify-content: center;
}

.badge {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 500;
}


@media (max-width: 992px) {
  h1 {
    font-size: 24px;
    margin: 3rem 1rem !important;
  }
  
  .return-btn {
    top: 10px;
    left: 10px;
  }
}

@media (max-width: 576px) {
  h1 {
    font-size: 22px;
    margin: 2rem 0.5rem !important;
  }
  
  .return-btn {
    position: relative;
    display: block;
    margin-bottom: 10px;
    top: auto;
    left: auto;
  }
  
  .card-header {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .badge {
    margin-top: 8px;
    align-self: flex-start;
  }
}
</style>