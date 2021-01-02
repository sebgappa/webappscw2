<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <div class="text-center">
                                <img :src="'images/user-circle-solid.svg'" class="card-img-top mt-3" style="width:100px;height:100px;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{user.name}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Email: {{user.email}}</li>
                                <li class="list-group-item">Birthday: June 24 1999</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="btn btn-primary">Change information</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 pt-3">
                        <button 
                            class="btn btn-secondary dropdown-toggle" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#pagesList" 
                            aria-expanded="false" 
                            aria-controls="pagesList">
                        View pages
                        </button>
                        <div class="collapse" id="pagesList">
                            <div v-for="page in pages.data" :key="page.id">
                                <div class="pt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ page.title}}</h5>
                                            <a :href="'/pages/' + page.id" class="btn btn-primary">Go to page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <pagination :data="pages" v-on:pagination-change-page="getPages"></pagination>
                            </div>
                        </div>
                    </div>
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
                                            <a :href="'/pages/' + post.page_id + '/posts/' + post.id" class="btn btn-primary">Go to post</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <pagination :data="posts" v-on:pagination-change-page="getPosts"></pagination>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 pt-3">
                        <button 
                            class="btn btn-secondary dropdown-toggle" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#commentsList" 
                            aria-expanded="false" 
                            aria-controls="commentsList">
                        View comments
                        </button>
                        <div class="collapse" id="commentsList">
                            <div v-for="comment in comments.data" :key="comment.id">
                                <div class="pt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text"> {{ comment.body }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <pagination :data="comments" v-on:pagination-change-page="getComments"></pagination>
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
        props:['user'],
        data() {
            return {
                pages: {},
                posts: {},
                comments: {}
            }
        },

        methods: {
            getPages(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/users/${this.user.id}/pages?page=` + page).then((res) => {
                    this.pages = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            },
            getPosts(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/users/${this.user.id}/posts?page=` + page).then((res) => {
                    this.posts = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            },
            getComments(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/users/${this.user.id}/comments?page=` + page).then((res) => {
                    this.comments = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            }
        },

        mounted() {
            this.getPages(),
            this.getPosts(),
            this.getComments()
        }
    }
</script>