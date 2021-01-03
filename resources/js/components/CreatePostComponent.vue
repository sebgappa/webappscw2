<template>
        <form @submit.prevent="createPost">
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <label for="title">Title:</label>
                        <input v-model="form.title" :class="{'is-invalid' : form.errors.has('title')}" name="title" class="form-control" rows="3" @keydown="form.errors.clear('title')">
                        <label class="text-danger pt-2 pl-2" 
                            v-if="form.errors.has('title')" 
                            v-text="form.errors.get('title')"></label>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="body">Body:</label>
                        <textarea v-model="form.body" :class="{'is-invalid' : form.errors.has('body')}" name="body" class="form-control" rows="3" @keydown="form.errors.clear('body')"></textarea>
                        <label class="text-danger pt-2 pl-2" 
                            v-if="form.errors.has('body')" 
                            v-text="form.errors.get('body')"></label>
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
        props:['pageId'],
        data() {
            return {
                form: new Form({
                    title: '',
                    body: '',
                    tag: '',
                })
            }
        },

        methods: {
            createPost() {
                let data = new FormData()
                data.append('title', this.form.title)
                data.append('body', this.form.body)
                data.append('tag', this.form.tag)

                axios.post(`/api/page/${this.pageId}/post/`, data).then((res) => {
                    this.form.reset()
                    window.location.href = `/page/${this.pageId}`
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        }
    }
</script>