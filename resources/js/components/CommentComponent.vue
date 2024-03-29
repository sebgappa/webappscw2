<template>
    <div class="pt-2">
        <form @submit.prevent="createComment">
            <div class="form-group">
                <label for="comment">Your Comment:</label>
                <textarea v-model="form.body" :class="{'is-invalid' : form.errors.has('body')}" name="comment" class="form-control" rows="3" @keydown="form.errors.clear('body')"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
            <span class="text-danger pt-2 pl-2" v-if="form.errors.has('body')" v-text="form.errors.get('body')"></span>
        </form>

        <div class="pt-3">
             <button 
                class="btn btn-secondary dropdown-toggle" 
                type="button" 
                data-toggle="collapse" 
                data-target="#commentsList" 
                aria-expanded="true" 
                aria-controls="commentsList">
                View comments
            </button>
            <div class="pt-2">
                <div class="collapse show" id="commentsList">
                    <div v-for="comment in comments.data" :key="comment.id">
                        <div class="pt-3">
                            <div class="card">
                                <div class="card-header">
                                    {{ comment.username }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text"> {{ comment.body }} </p>
                                    <a v-on:click="deleteComment(comment.id)" v-if="comment.user_id == userId || admin" class="btn btn-danger btn-sm">Delete Comment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="comments" v-on:pagination-change-page="getComments"></pagination>
                    </div>

                     <div v-if="comments.total == 0">
                        <label>This post doesn't have any comments yet!</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['userId', 'postId'],
        data() {
            return {
                admin: false,
                comments: {},

                form: new Form({
                    body: '',
                })
            }
        },

        methods: {
            deleteComment: function (commentId) {
                axios.delete(`/api/post/${this.postId}/comment/${commentId}`).then((res) => {
                    this.getComments()
                }).catch((error) => {
                    console.log(error)
                })
            },

            getComments(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/post/${this.postId}/comment?page=` + page).then((res) => {
                    this.comments = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            },

            createComment() {
                let data = new FormData()
                data.append('body', this.form.body)
                data.append('user_id', this.userId)
                
                axios.post(`/api/post/${this.postId}/comment`, data).then((res) => {
                    this.form.reset()
                    this.getComments()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            },

            isAdmin() {
                axios.get(`/api/user/admin`).then((res) => {
                    this.admin = res.data
                }).catch((error) => {
                    console.log(error)
                })
            }
        },

        mounted() {
            this.getComments()
            this.isAdmin()
        }
    }
</script>
