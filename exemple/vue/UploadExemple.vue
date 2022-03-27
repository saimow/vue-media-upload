
<template>
    <div>
        <UploadMedia
            :error="error"
            :server="server"

            @media='Media'
        />
        
    </div>
</template>

<script>
import {UploadMedia} from 'vue-media-upload';

export default {
    data(){
        return{
            error:'', //if it is not null it will apply the error styling and show the error message.
            server:'/api/upload', //the api that will temporary save the image.

            media:[], //the added images
        }
    },
    methods:{
        Media(value){
            this.media=value
        },
    },
    components:{
        UploadMedia,
        
    },

}
</script>

<style>

</style>