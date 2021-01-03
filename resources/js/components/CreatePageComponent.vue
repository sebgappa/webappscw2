<template>
        <form @submit.prevent="createPage">
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <label for="title">Page title:</label>
                        <input v-model="form.title" :class="{'is-invalid' : form.errors.has('title')}" name="title" class="form-control" rows="3" @keydown="form.errors.clear('title')">
                        <label class="text-danger pt-2 pl-2" 
                            v-if="form.errors.has('title')" 
                            v-text="form.errors.get('title')"></label>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="description">Page description:</label>
                        <textarea v-model="form.description" :class="{'is-invalid' : form.errors.has('description')}" name="description" class="form-control" rows="3" @keydown="form.errors.clear('description')"></textarea>
                        <label class="text-danger pt-2 pl-2" 
                            v-if="form.errors.has('description')" 
                            v-text="form.errors.get('description')"></label>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="tag">Tag:</label>
                        <input v-model="form.tag" :class="{'is-invalid' : form.errors.has('tag')}" name="tag" class="form-control" rows="3" @keydown="form.errors.clear('tag')">
                        <label class="text-danger pt-2 pl-2" 
                            v-if="form.errors.has('tag')" 
                            v-text="form.errors.get('tag')"></label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    title: '',
                    description: '',
                    tag: '',
                })
            }
        },

        methods: {
            createPage() {
                let data = new FormData()
                data.append('title', this.form.title)
                data.append('description', this.form.description)
                data.append('tag', this.form.tag);

                axios.post(`/api/page/`, data).then((res) => {
                    this.form.reset()
                    window.location.href = `/home`
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        }
    }
</script>