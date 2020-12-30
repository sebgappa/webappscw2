<template>
    <div class="pt-2">
        <form @submit.prevent="saveComment">
            <div class="form-group">
                <label for="comment">Your Comment:</label>
                <textarea v-model="form.body" name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

        <div class="pt-3">
             <button 
                class="btn btn-secondary dropdown-toggle" 
                type="button" 
                data-toggle="collapse" 
                data-target="#commentsList" 
                aria-expanded="false" 
                aria-controls="commentsList">
                View comments
            </button>
            <div class="pt-2">
                <div class="collapse" id="commentsList">
                    <div v-for="comment in comments" :key="comment.id">
                        <div class="pt-3">
                            <div class="card card-header">
                                {{ comment.username }}
                            </div>
                            <div class="card card-body">
                                {{ comment.body }}
                            </div>
                        </div>
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
                comments: '',

                form: new Form({
                    body: '',
                })
            }
        },

        methods: {
            getComments() {
                axios.get(`/api/posts/${this.postId}/comment`).then((res) => {
                    this.comments = res.data
                }).catch((error) => {
                    console.log(error)
                })
            },

            saveComment() {
                let data = new FormData()
                data.append('body', this.form.body)
                data.append('user_id', this.userId)
                
                axios.post(`/api/posts/${this.postId}/comment`, data).then((res) => {
                    this.form.reset()
                    this.getComments()
                }).catch((error) => {
                    console.log(error)
                })
            }
        },

        mounted() {
            this.getComments()
        }
    }
</script>
