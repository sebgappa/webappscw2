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
                                <p class="card-text"> {{ post.synopsis }} </p>
                                <p class="card-text font-weight-bold font-italic"> Posted by {{ post.username}} </p>
                                <a :href="'/pages/' + page.id + '/posts/' + post.id" class="btn btn-primary">Go to post</a>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="posts" v-on:pagination-change-page="getPosts"></pagination>
                    </div>
                </div>
                <div class="col-4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props:['pageId'],
        data() {
            return {
                page: '',
                posts: {},
                users: {}
            }
        },

        methods: {
            getPageUsers(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/pages/${this.pageId}/users?page=` + page).then((res) => {
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
        },

        mounted() {
            this.getPage();
            this.getPosts();
            this.getPageUsers();
        }
    }
</script>