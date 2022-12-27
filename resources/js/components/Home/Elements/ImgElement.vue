<template>
    <img v-if="src" :src="src" alt="">
    <img v-else src="/assets2/images/user-icon.jpg" alt="">
</template>

<script>
    export default {
        props:['src']
    }
</script>