<template>
    <div class="pt-2">
        <form @submit.prevent="saveComment">
            <div class="form-group">
                <label for="comment">Your Comment:</label>
                <textarea v-model="form.body" name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:['userId', 'postId'],
        data() {
            return {
                form: new Form({
                    body: '',
                    user_id: this.userId,
                    post_id: this.postId
                })
            }
        },

        methods: {
            saveComment() {
                let data = new FormData()
                data.append('body', this.form.body)
                data.append('user_id', this.form.user_id)
                data.append('post_id', this.form.post_id)
                
                axios.post('/api/comment', data)
            }
        },

        mounted() {
        }
    }
</script>
