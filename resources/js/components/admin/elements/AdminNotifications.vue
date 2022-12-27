<template>
    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{count}}<span
                                class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> {{trans('lang.notifications')}} </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"> {{count}} {{trans('lang.new')}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                            aria-selected="true">
                                            {{trans('lang.recent')}} ({{count}})
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content" id="notificationItemsTabContent" v-if="nots.length>0">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">

                                    <div v-for="not,index in nots" :key="index" class="text-reset notification-item d-block dropdown-item position-relative" :class="{'active':!not.read_at}">
                                        <div class="d-flex">
                                            <img v-if="not.data.user.avatar" :src="not.data.user.avatar"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <img v-else src="/assets/images/users/user-dummy-img.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">

                                            <div class="flex-1">
                                                <a :href="'/admin/notification/'+not.id" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{not.data.user.name}}</h6>
                                                
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">{{not.data.text}}.</p> 
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> {{not.ago}} </span>
                                                </p>
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="my-3 text-center">
                                        <a href="/admin/notifications" class="btn btn-soft-success waves-effect waves-light">View
                                            {{trans('lang.notifications')}} <i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-content" id="notificationItemsTabContent" v-else>
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                            <div class="w-25 w-sm-50 pt-3 mx-auto">
                                    <img src="/assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">
                                </div>
                                <div class="text-center pb-5 mt-2">
                                    <h6 class="fs-18 fw-semibold lh-base">{{trans('lang.no_notifications_msg')}} </h6>
                                </div>
                                <div class="my-3 text-center">
                                        <a href="/admin/notifications" class="btn btn-soft-success waves-effect waves-light">View
                                            {{trans('lang.all_notifications')}} <i class="ri-arrow-right-line align-middle"></i></a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</template>

<script>
export default {
    mounted(){
        this.get_recent()
        // Fire.$on(('Load'),e=>{
        //     this.get_recent()
        // })
        // setInterval(() => {
        //     Fire.$emit('Load')       
        // }, 1000)
    },
    data(){
        return {
            nots:[],
            count:0
        }
    },
    methods:{
        get_recent(){
            axios.get('/admin/admin_api/get_recent_nots')
                 .then((resp)=>{
                    // if(this.count < resp.data.length){
                    //   let audio=  document.getElementById('audio')
                    //   audio.play()
                    // }
                    this.nots=resp.data
                    this.count=this.nots.length
                 })

        }
    }
}
</script>