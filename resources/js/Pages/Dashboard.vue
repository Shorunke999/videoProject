<template>
    <div>
        <DashboardComponent>
            <div class=" flex justify-center text-2xl ">
                 Select subscription package
             </div>
            <div class="flex justify-between items-center mt-16"> 
                <span class="mr-2">Weekly Subscription - $10/week</span>
                <span class="text-gray-500">Other details here</span>
                <form @submit.prevent="submit">
                    <input type="hidden" value="10" v-model="value" name="charge"/>
                    <button @click="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
                </form>
        
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Monthly Subscription - $100/month</div>
                <form @submit.prevent="submit">
                    <input type="hidden" value="100" v-model="value" name=""/>
                    <button @click="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
                </form>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Yearly Subscription - $999/Year </div>
                <form @submit.prevent="submit">
                    <input type="hidden" value="999" v-model="value" name=""/>
                    <button @click="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
                </form>
            </div>
                
        </DashboardComponent>
    </div>
</template>
<script>
import DashboardComponent from './DashboardComponent.vue'
import { router } from '@inertiajs/vue3'
export default{
    components:{
        DashboardComponent
    },
    data() {
        return {
            value:null
        }
    },
    methods: {
        submit(){
            router.get('payment/'+ this.value)
        }
    },

}
</script>