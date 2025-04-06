export default {
    comments(state){
        return state.comments;
    },
    hascomments(state){
        return state.comments && state.comments.length>0;
    },
    commentId(state){
        return state.commentId;
    }   
}