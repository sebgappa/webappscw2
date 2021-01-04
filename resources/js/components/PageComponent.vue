<template>
        <div>
            <h3> {{ page.title }} </h3>
            <h5 class="font-weight-bold font-italic"> Created by {{page.username}}</h5>
            <div class="row pt-4">
                <div class="col-8">
                    <div v-for="post in posts.data" :key="post.id">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ post.title}}</h5>
                                <div v-if="post.tag" class="pb-2">
                                    <span class="badge badge-info text-white">{{ post.tag.name }}</span>
                                </div>
                                <p class="card-text"> {{ post.synopsis }} </p>
                                <p class="card-text font-weight-bold font-italic"> Posted by {{ post.username}} </p>
                                <a :href="'/page/' + page.id + '/post/' + post.id" class="btn btn-primary btn-sm">Go to post</a>
                                <a v-on:click="deletePost(post.id)" v-if="post.user_id == userId || admin" class="btn btn-danger btn-sm">Delete post</a>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="posts" v-on:pagination-change-page="getPosts"></pagination>
                    </div>

                    <div v-if="posts.total == 0">
                        <label>No posts yet!</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="pr-2 pb-2">
                        <a 
                            :href ="'/page/' + pageId + '/post/create'"
                            class="btn btn-success" 
                            role="button">
                            Create a new post
                        </a>
                    </div>
                    <button 
                        class="btn btn-secondary dropdown-toggle" 
                        type="button" 
                        data-toggle="collapse" 
                        data-target="#membersList" 
                        aria-expanded="false" 
                        aria-controls="membersList">
                        View members
                    </button>
                    <div class="pt-2">
                        <div class="collapse" id="membersList">
                            <div class="list-group">
                                <div v-for="user in users.data" :key="user.id">
                                    <li class="list-group-item"> {{user.name}} </li>
                                </div>
                            </div>
                            <div class="pt-2">
                                <pagination :data="users" v-on:pagination-change-page="getPageUsers"></pagination>
                            </div>

                            <div v-if="users.total == 0">
                                <label>No members yet!</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props:['pageId', 'userId'],
        data() {
            return {
                page: '',
                admin: false,
                posts: {},
                users: {}
            }
        },

        methods: {
            deletePost: function (postId) {
                axios.delete(`/api/page/${this.pageId}/post/${postId}`).then((res) => {
                    this.getPosts()
                }).catch((error) => {
                    console.log(error)
                })
            },

            getPageUsers(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/page/${this.pageId}/user?page=` + page).then((res) => {
                    this.users = res.data
                }).catch((error) => {
                    console.log(error)
                })
            },

            getPage() {
                axios.get(`/api/page/${this.pageId}`).then((res) => {
                    this.page = res.data
                }).catch((error) => {
                    console.log(error)
                })
            },

            getPosts(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/page/${this.pageId}/post?page=` + page).then((res) => {
                    this.posts = res.data
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
            this.getPage();
            this.getPosts();
            this.getPageUsers();
            this.isAdmin();
        }
    }
</script>