export default {
        user(state){
            return state.user;
        },
        hasuser(state){
            return !!state.user;   
        },
        users(state) {
            return state.users;
          },
        userId(state){
            return state.userId;
        },
        role(state){
            return state.user ? state.user.role : null;
        },
        emailStatus(state) {
            return state.emailStatus;
        },
        email(state) {
            return state.email;
        },
}
