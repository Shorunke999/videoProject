<template>
    <div>
        <DashboardComponent>
            <div class="flex justify-center text-2xl">
                Select subscription package
            </div>
            <div class="flex justify-between items-center mt-16">
                <span class="mr-2">Weekly Subscription - NGN{{ weeklyAmount }}/week</span>
                <span class="text-gray-500">Other details here</span>
                <button @click.prevent="submitPayment(10)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Monthly Subscription - ${{ monthlyAmount }}/month</div>
                <button @click.prevent="submitPayment(100)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="justify-left">Yearly Subscription - ${{ yearlyAmount }}/Year</div>
                <button @click.prevent="submitPayment(999)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Subscribe</button>
            </div>
            <div v-if="$page.props.flash.msg">{{ $page.props.flash.msg }}</div>
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
        submitPayment(amount) {
            router.post('/pay', { Amount: amount })
            .then((page) => {
                // Assuming the response is handled by a callback on the page component
                // You can access the response data using page.props
                window.location.href = page.props.redirect_url;
            })
            .catch((error) => {
                console.error('Error submitting payment:', error);
                // Handle the error (e.g., show a message to the user)
            });
        }
    }
}
</script>
