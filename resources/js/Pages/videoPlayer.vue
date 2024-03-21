<template>
    <div>
        <DashboardComponent>
            <video :src='url'> videoPlayer</video>
        </DashboardComponent>
        
    </div>
</template>
<script>
import DashboardComponent from './DashboardComponent.vue'
export default {
    props:{
        url:Object
    },
    components:{
        DashboardComponent
    },
    data() {
        return {
            
        }
    },
}
</script>