<template>
        <div class="card">
            <div class="card-header">
                {{ this.post.title }}
            </div>
            <div class="card-body">
                {{ this.post.body }}
                <p class="card-text pt-3 font-weight-bold font-italic"> Posted by {{ post.username}} </p>
            </div>
        </div>
</template>

<script>
    export default {
        props:['postId', 'pageId'],
        data() {
            return {
                post: '',
            }
        },

        methods: {
            getPost() {
                axios.get(`/api/pages/${this.pageId}/posts/${this.postId}`).then((res) => {
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