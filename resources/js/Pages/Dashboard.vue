<template>
    <div>
        <DashboardComponent>
            <div class="flex justify-center text-2xl">
                Select subscription package
            </div>
            <div class="flex justify-between items-center mt-16">
                <span class="mr-2">Weekly Subscription - NGN{{ weeklyAmount }}/week</span>
                <span class="text-gray-500">Other details here</span>
                <button @click.prevent="submit(10)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Monthly Subscription - ${{ monthlyAmount }}/month</div>
                <button @click.prevent="submit(100)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Yearly Subscription - ${{ yearlyAmount }}/Year</div>
                <button @click="submit(999)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
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
            weeklyAmount: 10,
            monthlyAmount: 100,
            yearlyAmount: 999
        }
    },
    methods: {
        submit(amount) {
            router.post('/pay', { amount })
        }
    }
}
</script>
