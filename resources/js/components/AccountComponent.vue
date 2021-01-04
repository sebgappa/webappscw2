<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="text-center">
                                <img :src="dog" class="card-img-top mt-3" style="width:100px;height:100px;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{user.name}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Email: {{user.email}}</li>
                                <li v-if="admin" class="badge bg-primary text-white">Admin</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 pt-3">
                        <button 
                            class="btn btn-secondary dropdown-toggle" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#postsList" 
                            aria-expanded="false" 
                            aria-controls="postsList">
                        View posts
                        </button>
                        <div class="collapse" id="postsList">
                            <div v-for="post in posts.data" :key="post.id">
                                <div class="pt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ post.title}}</h5>
                                            <p class="card-text"> {{ post.synopsis }} </p>
                                            <a :href="'/page/' + post.page_id + '/post/' + post.id" class="btn btn-primary btn-sm">Go to post</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <pagination :data="posts" v-on:pagination-change-page="getPosts"></pagination>
                            </div>

                            <div v-if="posts.total == 0">
                                <label>You haven't created any posts!</label>
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
        props:['user', 'dog'],
        data() {
            return {
                admin: false,
                posts: {},
                comments: {}
            }
        },

        methods: {
            getPosts(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/user/${this.user.id}/post?page=` + page).then((res) => {
                    this.posts = res.data;
                }).catch((error) => {
                    console.log(error)
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
            this.getPosts(),
            this.isAdmin()
        }
    }
</script>