<template>
    <div>
        <UpdateMedia
            :error="error"
            :server="server"
            :media_server="media_server + post_id"
            :media_file_path="media_file_path"
            
            @saved-media="savedMedia"
            @deleted-media='deletedMedia'
            @added-media='AddedMedia'
        />
    </div>
</template>

<script>
import {UpdateMedia} from 'vue-media-upload';

export default {
    data(){
        return{
            post_id:7,

            error:'', //if it is not null it will apply the error styling and show the error message.
            server:'/api/upload', //the api that will temporary save the image.
            media_server:'/api/media/', //the api that will return the images names.
            media_file_path:'/post_images', //the public file where the saved midia are saved.

            saved_media:[], //saved media
            deleted_media:[], //deleted media
            added_media:[], //the added images
        }
    },
    methods:{
        savedMedia(value){
            this.saved_media=value
        },
        deletedMedia(value){
            this.deleted_media=value
        },
        AddedMedia(value){
            this.added_media=value
        },
    },
    components:{
        UpdateMedia
    }

}
</script>

<style>

</style>