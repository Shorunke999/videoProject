<template>
    <div>
        <DashboardComponent>
            <div v-if="$page.props.flash.msg" class="bg-green-500 items-center flex justify-center">
                {{ $page.props.flash.msg }}
            </div>
            <div class="justify-center flex mt-3">
                <button @click="showModal" class="bg-green-500 hover:bg-green-600  text-white px-4 py-2 rounded">
                    Upload new video
                </button>
            </div>
                
            <div class="flex justify-center bg-green-400 mt-4 text-black" v-if="showModalData" >
                <div>
                    <label for="title">
                            Video title
                    </label>
                    <input type="text" name="title" v-model="Title">
                    <input type="file" @change="submitVideo">
                </div>
            </div>
        </DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from './DashboardComponent.vue'
import { router } from '@inertiajs/vue3'
export default {
    props:{
        msg:Object
    },
    components: {
        DashboardComponent
    },
    data() {
        return {
            showModalData:false,
            Title:'',
            file: null
        }
    },
    methods: {
       showModal(){
        this.showModalData = !this.showModalData
       },
       submitVideo(event){
            const formData = {
               title: this.Title,
                video: event.target.files[0]
            }
            console.log(formData) 
           router.post('/videoUpload',formData);
       }   
    },
    mounts:{
        //call data from api and render them on the page..also get image to use for background
    }
}
</script>
