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
                <textarea v-model="post.content" name="content" cols="30" rows="10" :class="this.errors.content?'is-invalid':''" class="form-control" id='content'></textarea>
                <p v-if="errors.content" class="text-danger">{{ errors.content[0] }}</p>
            </div>

            <!-- vue-media-upload component -->
            <div class="mb-4">
                <label class="form-label">Media</label>
                <div>
                    <Uploader 
                        server="/api/posts/media/upload"
                        :is-invalid="errors.media ? true : false"
                        @change="changeMedia"
                    />
                </div>
                <p v-if="errors.media" class="text-danger">{{ errors.media[0] }}</p>
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

        },
        data(){
            return{
                post:{
                    title: '',
                    content: '',
                    media: [],
                },
                errors:[],
                isLoading: false,
            }
        },
        methods:{
            onSubmit(){
                this.isLoading = true
                axios.post('/api/posts/create', this.post)
                    .then(response => {
                        //
                    })
                    .catch(error => {
                        if(error.response.data){
                            this.errors = error.response.data.errors
                        }
                        this.isLoading = false
                    })
            },
            changeMedia(media){
                this.post.media = media
            },
        },
        components:{
            Uploader
        }
    }
</script>

<style scoped>

</style>