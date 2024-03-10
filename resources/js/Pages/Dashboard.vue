<template>
    <div>
        <DashboardComponent>
            <div class=" flex justify-center text-2xl ">
                 Select subscription package
             </div>
            <div class="flex justify-between items-center mt-16"> 
                <span class="mr-2">Weekly Subscription - $10/month</span>
                <span class="text-gray-500">Other details here</span>
            
                <button @click="ss" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Monthly Subscription</div>
            
                <button @click="ss" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Yearly Subscription</div>
            
                <button @click="ss" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
                
        </DashboardComponent>
    </div>
</template>
<script>
import DashboardComponent from './DashboardComponent.vue'
export default{
    components:{
        DashboardComponent
    },

}
</script>