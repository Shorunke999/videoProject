<template>
    <div>
        <DashboardComponent>
            <div v-if="Modal ==false" class="mt-4 ">
                <div class="flex justify-center text-2xl">
                    Select subscription package
                </div>
                <div class="flex justify-between items-center mt-8 ">
                    <span class="mr-2">Weekly Subscription - NGN{{ weeklyAmount }}/week</span>
                    <button @click.prevent="modalVisibility(1000)" class="bg-indigo-500  text-white px-4 py-2 rounded">Subscribe</button>
                </div>
                <div class="flex justify-between items-center mt-2 ">
                    <div class="justify-left">Monthly Subscription - NGN{{ monthlyAmount }}/month</div>
                    <button @click.prevent="modalVisibility(10000)" class="bg-indigo-500  text-white px-4 py-2 rounded">Subscribe</button>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <div class="justify-left">Yearly Subscription - NGN{{ yearlyAmount }}/Year</div>
                    <button @click.prevent="modalVisibility(9999)" class="bg-indigo-500  text-white px-4 py-2 rounded">Subscribe</button>
                </div>
                <div v-if="$page.props.flash.msg">{{ $page.props.flash.msg }}</div>
            </div>
            <div v-if="Modal" class="block justify-end mt-12">
                <div @click ="paystack" class="cursor-pointer">
                    <p>Paystack</p>
                </div>
                <div @click ="FlutterWave" class="cursor-pointer">
                    <p>FlutterWave</p>
                </div>
                <button @click="cancelModal" class="rounded bg-indigo-500">Exit payment</button>
            </div>    
        </DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from './DashboardComponent.vue'
import { Inertia } from '@inertiajs/inertia';


export default {
    components: {
        DashboardComponent
    },
    data() {
        return {
            weeklyAmount: 10,
            monthlyAmount: 100,
            yearlyAmount: 999,
            Modal:false,
            Amount: 0
        }
    },
    methods: {
        modalVisibility(amount){
            this.Modal = true
            this.Amount = amount
        },
        paystack() {
            Inertia.post('/pay', { Amount: this.Amount })
            .then(res => {
                window.location.href = res.data.redirect_url;
            }).catch(error => {
                console.error('Payment error:', error);
            });
        },
        FlutterWave(){
            Inertia.post('/api/flutter', { Amount: this.Amount });
        },
        cancelModal(){
            this.Modal = false
        }
        
    }
}
</script>
