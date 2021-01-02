<template>
        <div>
            <div v-for="page in pages.data" :key="page.id">
                <div class="card mb-4">
                     <div class="card-body">
                        <h5 class="card-title">{{ page.title}}</h5>
                        <p class="card-text"> {{ page.description }} </p>
                        <a :href="'/pages/' + page.id" class="btn btn-primary">Go to page</a>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <pagination :data="pages" v-on:pagination-change-page="getPages"></pagination>
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

                axios.get(`/api/users/${this.userId}/pages?page=` + page).then((res) => {
                    this.pages = res.data;
                }).catch((error) => {
                    console.log(error)
                })
            }
        },

        mounted() {
            this.getPages()
        }
    }
</script>