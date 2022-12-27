<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="ri-notification-4-line">
            <span v-if="$root.user" class="badge badge-dark">{{nots.length}}</span>
        </i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" v-if="$root.user">

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

                <div class="my-3 text-center">
                        <router-link to="/notifications" class="theme-btn btn-one">View
                            All Notifications <i class="ri-arrow-right-line align-middle"></i></router-link>
                </div>
        </div>
        <div class="comments-area v2"  v-else>
            
                <div class="w-25 w-sm-50 pt-3 mx-auto">
                    <img src="/assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">
                </div>
                <div class="text-center pb-5 mt-2">
                    <h6 class="fs-18 fw-semibold lh-base">Hey! You have no unread notifications </h6>
                </div>
                <div class="my-3 text-center">
                        <router-link to="/notifications" class="theme-btn btn-one">View
                            All Notifications <i class="ri-arrow-right-line align-middle"></i></router-link>
                </div>
            
        </div>

        </div>
    </li>
</template>

<script>

export default {
    mounted(){
        this.get_nots()
        // Echo.channel("not").listen("NotEvent", (e) => {
        //     alert(e)
        //     if(e.user.id==this.$root.user.id){
        //         this.get_nots()
        //         let audio=document.getElementById('audio')
        //          audio.play()
        //     }
            
            
        // });
        setInterval(() => {
            let audio=document.getElementById('audio')
            let oldcount=this.nots.length
            if(this.$root.token && localStorage.getItem('email_verified_at')){
                  axios.get('/api/get_user_nots')
                  .then((resp)=>{
                      this.nots=resp.data
                      
                    })
                    
                }
            let newcount=this.nots.length
            if(newcount > oldcount){
                 audio.play()
            }
        }, 3000);
    },
    data(){
        return {
            nots:[],
            not:''
        }
    },
    methods:{
        get_nots(){
          setTimeout(() => {
              if(this.$root.token){
                  axios.get('/api/get_user_nots')
                  .then((resp)=>{
                      this.nots=resp.data
                    })
                    
                }
            }, 1000);
              
        },
        redirect(not){
            axios.get('/api/notification/'+not.id)
                 .then((resp)=>{
                    if(resp.data=='ok'){
                        this.$router.push(not.data.link)
                        this.get_nots()
                    }else{
                        this.$router.push('not-found')
                    }
                 })
        }
    }
}
</script>