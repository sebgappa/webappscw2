<template>
        <div class="row">
            <div class="col-12">
                <a 
                    :href ="'/page/create'"
                    class="btn btn-success" 
                    role="button">
                    Create a new page +
                </a>
            </div>
            <div class="col-12 pt-3">
                <button 
                    class="btn btn-primary dropdown-toggle" 
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#memberPages" 
                    aria-expanded="true" 
                    aria-controls="memberPages">
                    Pages you're a member of
                </button>
                <div class="collapse show" id="memberPages">
                    <div v-for="page in memberPages.data" :key="page.id">
                        <div class="pt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ page.title}}</h5>
                                    <div v-if="page.tag" class="pb-2">
                                        <span class="badge badge-info text-white">{{ page.tag.name }}</span>
                                    </div>
                                    <p class="card-text"> {{ page.description }} </p>
                                    <p class="card-text font-weight-bold font-italic"> Created by {{ page.username }} </p>
                                    <a :href="'/page/' + page.id" class="btn btn-primary">Go to page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="memberPages" v-on:pagination-change-page="getMemberPages"></pagination>
                    </div>

                    <div v-if="memberPages.total == 0">
                        <label>You're not a member of any pages!</label>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-3">
                <button 
                    class="btn btn-primary dropdown-toggle" 
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#createdPages" 
                    aria-expanded="true" 
                    aria-controls="createdPages">
                    Pages you've created
                </button>
                <div class="collapse show" id="createdPages">
                    <div v-for="page in createdPages.data" :key="page.id">
                        <div class="pt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ page.title}}</h5>
                                    <div class="pb-2">
                                        <span class="badge badge-info text-white">{{ page.tag.name }}</span>
                                    </div>
                                    <p class="card-text"> {{ page.description }} </p>
                                    <a :href="'/page/' + page.id" class="btn btn-primary">Go to page</a>
                                    <a v-on:click="deletePage(page.id)" class="btn btn-danger">Delete page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="createdPages" v-on:pagination-change-page="getCreatedPages"></pagination>
                    </div>

                    <div v-if="createdPages.total == 0">
                        <label>You haven't created any pages!</label>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props:['userId'],
        data() {
            return {
                memberPages: {},
                createdPages: {}
            }
        },

        methods: {
            deletePage: function (pageId) {
                axios.delete(`/api/page/${pageId}`).then((res) => {
                    this.getCreatedPages()
                }).catch((error) => {
                    console.log(error)
                })
            },

            getMemberPages(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/user/${this.userId}/page/member?page=` + page).then((res) => {
                    this.memberPages = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            },

            getCreatedPages(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/user/${this.userId}/page/creator?page=` + page).then((res) => {
                    this.createdPages = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            }
        },

        mounted() {
            this.getMemberPages()
            this.getCreatedPages()
        }
    }
</script>