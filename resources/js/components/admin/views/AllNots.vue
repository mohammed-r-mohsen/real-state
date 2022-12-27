<template>
    <div >
            <div class="element mb-3" v-for="not,index in nots" :key="index">
                <a :href="'/admin/notification/'+not.id">
            <div :class="{'alert-primary':!not.read_at,'alert-light':not.read_at}" class="alert alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                     <img class="label-icon" v-if="not.data.user.avatar" :src="not.data.user.avatar" >
                     <img class="label-icon" v-else src="/assets/images/users/user-dummy-img.jpg" >
                     <strong>{{not.data.user.first_name}} {{not.data.user.last_name}}</strong> -
                      {{not.data.text}}
                      <p class="mb-0"> {{not.ago}} </p>
                    </div>
                </a>
            </div>
    </div>
</template>

<script>

    export default{
        mounted(){

        },
        props:['nots'],
    }

</script>