<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
        <section class="property-page-section property-grid reveiws-page">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'notifications'"></sidebar>
                
                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="home-header">
                            <h4 class="title"><i class="ri-notification-4-line"></i> Notifications : </h4> 
                        </div>
                        <div class="coments-area v2" v-if="loading"> 
                            <Loading :lines="2"></Loading>
                        </div>
                        <div class="comments-area v2" v-if="nots.length>0">
                            <div class="comment-box" v-for="not,index in nots" :key="index">
                                <div @click="redirect(not)" class="single-not">
                                <div class="comment" :class="{'active':!not.read_at}">
                                    <figure class="thumb-box">
                                        <img src="/assets2/images/news/comment-1.jpg" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>{{not.data.user.name}}</h5>
                                            <span> <i class="ri-time-line"></i> {{not.ago}}</span>
                                        </div>
                                        <p class="text">
                                            {{not.data.text}} 
                                        </p>
                                    </div>
                                </div>
                                </div>
                                </div>
                        </div>
                        <div class="comments-area v2"  v-else-if="nots.length==0 && !loading">
            
                                <div class="w-25 w-sm-50 pt-3 mx-auto">
                                    <img src="/assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">
                                </div>
                                <div class="text-center pb-5 mt-2">
                                    <h6 class="fs-18 fw-semibold lh-base">Hey! You have no notifications </h6>
                                </div>
                               
                            
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import Sidebar from './Elements/Sidebar.vue';


    export default {
    mounted() {
        this.$root.get_user();
        this.get_notifications()
        Fire.$on('LoadData',()=>{
            this.get_notifications()
        })
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            nots:[]
        };
    },
    methods: {
        get_notifications(){
            if(this.$root.user){
                this.loading=true
                axios.get('/api/get_notifications')
                .then((resp)=>{
                    this.nots=resp.data
                    this.loading=false
                })
            }
            },
            redirect(not){
            axios.get('/api/notification/'+not.id)
                 .then((resp)=>{
                    if(resp.data=='ok'){
                        this.$router.push(not.data.link)
                    }else{
                        this.$router.push('not-found')
                    }
                 })
        }
    },
    components: { Loading ,Sidebar }
}
</script>