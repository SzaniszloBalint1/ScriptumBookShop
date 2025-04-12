export default {
        setUsers(state,users){
            state.users=users;
        },
       updateRole(state,user){
            const index=state.users.findIndex(u=>u.id===user.id);
            if (index !== -1) {
                state.users.splice(index, 1, user);
            }
        },

        setUserId(state,id){
            state.userId=id;
        },
        setUser(state,data){
            state.user=data;
            state.isAuth=true;
        },

        cleanUser(state){
            state.user=null;
            state.token=null;
            state.isAuth=false;
        },

        setEmailStatus(state, status) {
            state.emailStatus = status;
        },
        setEmail(state, data) {
            state.email = data;
        },
}