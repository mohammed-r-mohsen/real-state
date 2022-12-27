<template>
   <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block" v-for="item,index in ads.data" :key="index">
                <AdBlock :item="item"></AdBlock>
            </div>
        </div>
</template>

<script>
import AdBlock from "./AdBlock.vue";
export default {
    props: ["ad_id"],
    mounted() {
        this.get_similar();
    },
    data() {
        return {
            ads: {},
        };
    },
    methods: {
        get_similar() {
            axios.get("/api/similar_ads/" + this.ad_id)
                .then((resp) => {
                this.ads = resp.data;
            });
        }
    },
    components: { AdBlock }
}
</script>



