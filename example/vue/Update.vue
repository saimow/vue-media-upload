<template>
    <div class="">
        <form @submit.prevent="onSubmit" class="">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input v-model="post.title" type="text" :class="errors.title?'is-invalid':''" class="form-control" id="title" name="title">
                <p v-if="errors.title" class="text-danger">{{ errors.title[0] }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea v-model="post.content" name="content" cols="30" rows="10" :class="errors.content?'is-invalid':''" class="form-control" id='content'></textarea>
                <p v-if="errors.content" class="text-danger">{{ errors.content[0] }}</p>
            </div>

            <!-- vue-media-upload component -->
            <div class="mb-4">
                <label class="form-label">Media</label>
                <div>
                    <Uploader
                        v-if="hasResponse"
                        server='/api/posts/media/upload'
                        :is-invalid="errors['media.list'] ? true : false"
                        :media="post.media.saved"
                        location="/storage/posts/media"
                        @init="initMedia"
                        @change="changeMedia"
                        @add="addMedia"
                        @remove="removeMedia"
                    />
                </div>
                <p v-if="errors['media.list']" class="text-danger">{{ errors['media.list'][0] }}</p>
            </div>

            <!-- Submit button -->
            <button class="btn btn-primary" :disabled="isLoading">
                <div v-if="!isLoading">
                    Submit
                </div>
                <div v-if="isLoading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </div>
            </button>
        </form>
    </div>
</template>

<script>

import axios from 'axios';
import Uploader from 'vue-media-upload'

    export default {
        props:{

        },
        mounted(){
            this.getData()
        },
        data(){
            return{
                post: {
                    id: 1,
                    title: '',
                    content: '',
                    media: {
                        list: [], //all media (savedMedia + addedAdded)
                        saved: [
                            { id: 1, name: '123_image.jpg' },
                            { id: 2, name: '456_image.jpg' },
                        ],
                        added: [],
                        removed: []
                    },
                },
                errors: [],
                hasResponse: false,
                isLoading: false,
            }
        },
        methods:{
            getData(){
                axios.get('/api/posts/data/'+ this.post.id)
                    .then(response => {
                        this.post = response.data.post
                        this.post.media = {list: [], saved: [], added:[], removed:[]}
                        this.post.media.saved = response.data.media
                        this.hasResponse = true
                    })
            },
            onSubmit(){
                this.isLoading = true
                axios.put('/api/posts/update/'+this.id, this.post)
                    .then(response => {
                        window.location.replace(this.indexRoute); 
                    })
                    .catch(error => {
                        if(error.response.data){
                            this.errors = error.response.data.errors
                            console.log(this.errors) 
                        }
                        this.isLoading = false
                    })
            },
            initMedia(media){
                this.post.media.list = media
            },
            changeMedia(media){
                this.post.media.list = media
            },
            addMedia(addedImage, addedMedia){
                this.post.media.added = addedMedia
            },
            removeMedia(removedImage, removedMedia){
                this.post.media.removed = removedMedia
            },
        },
        components:{
            Uploader
        },
        
    }
</script>

<style scoped>

</style>