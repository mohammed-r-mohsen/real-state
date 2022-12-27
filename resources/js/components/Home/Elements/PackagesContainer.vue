<template>
 <!-- category-section -->
        <section class="category-section  centred">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h5>{{trans('lang.packages')}}</h5>
                    <!-- <h2>30 dayes free trail </h2> -->
                </div>
                <packages-section :view="4"></packages-section>
            </div>
        </section>
        <!-- category-section end -->
                    
</template>

<script>
import PackagesSection from './PackagesSection.vue';

export default {
  components: { PackagesSection },
    mounted() {
        // this.get_packages();
    },
    data() {
        return {
            packages: [],
        };
    },
    methods: {
        get_packages() {
            this.$root.loading = true;
            axios.get("/api/paginate_packages")
                .then((resp) => {
                this.packages = resp.data.data;
                this.$root.loading = false;
            });
        },
       
    },
}
</script>



