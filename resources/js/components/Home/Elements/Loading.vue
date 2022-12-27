<template>
    <!-- error-section -->
        <div class="" role="status">

                <content-placeholders v-for="lin,index in lines" :key="index">
                    <content-placeholders-heading :img="true" />
                    <content-placeholders-text :lines="1" />
                </content-placeholders>
            </div>   
</template>

<script>
export default {
    mounted() {
       
    },
    props:['lines'],
    methods:{
        logout(){
            
        }
    }
}
</script>



