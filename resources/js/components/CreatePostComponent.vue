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
            <div class="row">
                <div class="col-12 pt-3 pb-3">
                    <label >Upload image:</label>
                    <input type="file" @change="updateImage($event)" id="image" name="image">
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
                postId: '',
                image: '',

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
                    this.postId = res.data
                    this.form.reset()
                    this.uploadImage()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            },

            uploadImage() {
                let data = new FormData()
                data.append('image', this.image)

                axios.post(`/api/post/${this.postId}/image`, data, {headers: {'Content-Type': 'multipart/form-data'}}).then((res) => {
                    window.location.href = `/page/${this.pageId}`
                }).catch((error) => {
                    console.log(error)
                })
            },

            updateImage(event) {
                this.image = event.target.files[0]
            }
        }
    }
</script>