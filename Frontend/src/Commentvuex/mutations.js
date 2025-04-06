export default {
    setComments(state,comments){
        state.comments=comments;
    },
    setCommentId(state,comment){
        state.commentId=comment;
    },
    addComment(state,comment){
        state.comments.push(comment);
    },
    updateCommentId(state,comment){
        const index=state.comments.findIndex(c=>c.id===comment.id);
        if(index!==-1){
            state.comments[index]=comment
        }
    },
    deleteCommentId(state,id){
        state.comments=state.comments.filter(c=>c.id!==id);
    }
}