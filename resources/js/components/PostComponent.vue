<template>
        <div class="card">
            <div class="card-header">
                {{ this.post.title }}
            </div>
            <div class="card-body">
                {{ this.post.body }}
                <div v-if="post.image">
                    <div class="pt-3">
                        <img :src="post.image.image_path" class="img-fluid">
                    </div>
                </div>
                <p class="card-text pt-3 font-weight-bold font-italic"> Posted by {{ post.username}} </p>
                <a :href="'/page/' + pageId + '/post/' + postId + '/edit'" v-if="post.user_id == userId" class="btn btn-primary btn-sm">Edit Post</a>
            </div>
        </div>
</template>

<script>
    export default {
        props:['postId', 'pageId', 'userId'],
        data() {
            return {
                post: '',
            }
        },

        methods: {
            getPost() {
                axios.get(`/api/page/${this.pageId}/post/${this.postId}`).then((res) => {
                    this.post = res.data
                }).catch((error) => {
                    console.log(error)
                })
            }
        },

        mounted() {
            this.getPost()
        }
    }
</script>