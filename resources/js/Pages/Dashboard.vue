<template>
    <div>
        <DashboardComponent>
            <span>
                <button @click="showModal" class="hover:bg-gray-500">Upload new video</button>
            </span> 
            <div class="flex justify-center text-2xl" v-if="showModalData">
                <div>
                    <label for="title">
                        Video title
                    </label>
                    <input type="text" name="title" v-model="Title">
                </div>
                <input type="file" @change="submitVideo">
                <button type="submit">upload video</button>
            </div>
        </DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from './DashboardComponent.vue'
import { router } from '@inertiajs/vue3'
export default {
    components: {
        DashboardComponent
    },
    data() {
        return {
            showModalData:false,
            Title:''
        }
    },
    methods: {
       showModal(){
        this.showModalData = !this.showModalData
       },
       submitVideo(event){
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('data',{
                title: this.Title,
                video: file
            }); 
            router.post('/videoUpload',{
                formData
            });
       }
        }
}
</script>
