<template>
        <div class="row">
            <div class="col-12">
                <a 
                    :href ="'/page/create'"
                    class="btn btn-success" 
                    role="button">
                    Create a new page
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
                                    <p class="card-text"> {{ page.description }} </p>
                                    <p class="card-text font-weight-bold font-italic"> Created by {{ page.username}} </p>
                                    <a :href="'/pages/' + page.id" class="btn btn-primary">Go to page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="memberPages" v-on:pagination-change-page="getMemberPages"></pagination>
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
                                    <p class="card-text"> {{ page.description }} </p>
                                    <a :href="'/pages/' + page.id" class="btn btn-primary">Go to page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <pagination :data="createdPages" v-on:pagination-change-page="getCreatedPages"></pagination>
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
            getMemberPages(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/users/${this.userId}/pages/member?page=` + page).then((res) => {
                    this.memberPages = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            },

            getCreatedPages(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/users/${this.userId}/pages/creator?page=` + page).then((res) => {
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