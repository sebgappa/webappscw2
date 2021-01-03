<template>
        <div>
            <div v-for="page in pages.data" :key="page.id">
                <div class="pt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ page.title}}</h5>
                                <div v-if="page.tag" class="pb-2">
                                        <span class="badge badge-info text-white">{{ page.tag.name }}</span>
                                </div>
                                <p class="card-text"> {{ page.description }} </p>
                                <p class="card-text font-weight-bold font-italic"> Created by {{ page.username }} </p>
                                <a v-on:click="joinPage(page.id)" class="btn btn-success">Join page</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <pagination :data="pages" v-on:pagination-change-page="getPages"></pagination>
            </div>
            <div v-if="pages.total == 0">
                <label>There are no pages left to join!</label>
            </div>
        </div>
</template>

<script>
    export default {
        props:['userId'],
        data() {
            return {
                pages: {},
            }
        },

        methods: {
            getPages(page) {
                if (typeof page == 'undefined') {
                    page = 1;
                }

                axios.get(`/api/page?page=` + page).then((res) => {
                    this.pages = res.data
                }).catch((error) => {
                    console.log(error)
                })
            },

            joinPage(pageId) {
                axios.put(`/api/user/${this.userId}/page/${pageId}/join`).then((res) => {
                    window.location.href = `/home`
                }).catch((error) => {
                    console.log(error);
                })
            }
        },

        mounted() {
            this.getPages();
        }
    }
</script>