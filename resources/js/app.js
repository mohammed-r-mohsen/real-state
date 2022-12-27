

require("./bootstrap");
import Axios from 'axios';
window.Vue=require('vue')
window.Fire = new Vue();
import VueRouter from "vue-router";
Vue.use(VueRouter);
import Form from "vform";
window.Form = Form;
import Swal from "sweetalert2";
import { filter, truncate } from 'lodash';
import Vue from 'vue';
window.swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
window.toast = Toast;

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};


import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU",
    },
    // installComponents:false
});

import VueGeolocation from "vue-browser-geolocation";
Vue.use(VueGeolocation);


Vue.filter('firstLastCarachter',function(value){
    var names = value.split(" "),
        initials = names[0].substring(0, 1).toUpperCase();

    if (names.length > 1) {
        initials += names[names.length - 1].substring(0, 1).toUpperCase();
    }
    return initials;
})
Vue.filter('desc_filter',function(value){
    
    return value.substring(0, 40)+'...';
})
Vue.filter('desc_filter2',function(value){
    
    return value.substring(0, 100)+'...';
})
Vue.filter('title_filter',function(value){
    if(value.length>30){        
        return value.substring(0, 30)+'...';
    }else{
        return value
    }
})
Vue.filter('date_filter',function(value){
    let date=new Date(value)
    let year = date.getFullYear()
    let month = date.getMonth()+1
    let day = date.getDate()
    return day + '-'+ month +'-'+year 
})



// custom components
Vue.component("pagination", require("laravel-vue-pagination"));
// Elements components
Vue.component("page-header",require("./components/admin/elements/PageHeader.vue").default);
Vue.component("admin-notifications",require("./components/admin/elements/AdminNotifications.vue").default);

// Views components
Vue.component("users",require("./components/admin/views/Users.vue").default);
Vue.component("all-users",require("./components/admin/views/AllUsers.vue").default);
Vue.component("editors",require("./components/admin/views/Editors.vue").default);
Vue.component("packages",require("./components/admin/views/Packages.vue").default);
Vue.component("states",require("./components/admin/views/States.vue").default);
Vue.component("cities", require("./components/admin/views/Cities.vue").default);
Vue.component("countries", require("./components/admin/views/Countries.vue").default);
Vue.component("regions", require("./components/admin/views/Regions.vue").default);
Vue.component("providers", require("./components/admin/views/Providers.vue").default);
Vue.component("categories", require("./components/admin/views/Categories.vue").default);
Vue.component("currencies", require("./components/admin/views/Currencies.vue").default);
Vue.component("neighbors", require("./components/admin/views/Neighbors.vue").default);
Vue.component("appart-models", require("./components/admin/views/AppartModels.vue").default);
Vue.component("advertisements", require("./components/admin/views/Advertisements.vue").default);
Vue.component("orders", require("./components/admin/views/Orders.vue").default);
Vue.component("view-ad", require("./components/admin/views/ViewAd.vue").default);
Vue.component("profile", require("./components/admin/views/Profile.vue").default);
Vue.component("all-nots", require("./components/admin/views/AllNots.vue").default);
Vue.component("faqs", require("./components/admin/views/Faqs.vue").default);
Vue.component("pages", require("./components/admin/views/Pages.vue").default);
Vue.component("users-chat", require("./components/admin/views/UsersChat.vue").default);
Vue.component("settings", require("./components/admin/views/Settings.vue").default);
Vue.component("sliders", require("./components/admin/views/Sliders.vue").default);
Vue.component("ads-numbers", require("./components/admin/views/AdsNumbers.vue").default);
Vue.component("building-ages", require("./components/admin/views/BuildingAges.vue").default);
Vue.component("floor-numbers", require("./components/admin/views/FloorNumbers.vue").default);
Vue.component("heatings", require("./components/admin/views/Heatings.vue").default);
Vue.component("title-deeds", require("./components/admin/views/TitleDeeds.vue").default);

// home elements
Vue.component("sidebar", require("./components/Home/Elements/Sidebar.vue").default);
Vue.component("Waiting", require("./components/Home/Elements/Waiting.vue").default);
Vue.component("no-items", require("./components/Home/Elements/NoItems.vue").default);
Vue.component("loading", require("./components/Home/Elements/Loading.vue").default);
Vue.component("packages-section", require("./components/Home/Elements/PackagesSection.vue").default);
Vue.component("categories-section", require("./components/Home/Elements/CategoriesSection.vue").default);
Vue.component("user-nots", require("./components/Home/Elements/UserNots.vue").default);

import vSelect from "vue-select";
Vue.component("v-select", vSelect);

import routes from "./routes";
const router = new VueRouter(routes);
function isVerified() {
    return localStorage.getItem("email_verified_at");
}
function loggedIn(){
    return localStorage.getItem('token');
}

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: "/login",
                query: { redirect: to.fullPath },
            });
        } else {
            if(!isVerified()){
                next({
                    path: "/verify_email",
                    query: { redirect: to.fullPath },
                }); 
                
            }else{
               next();
            }
           
        }
    } else if (to.matched.some((record) => record.meta.IsAuth)) {
        if (loggedIn()) {
            if(!isVerified()){
                next();
            
        }else{
             next({
                 path: "/home",
                 query: { redirect: to.fullPath },
             });
        }
        
        } else {
            next();
        }
    }
     else {
        next(); // make sure to always call next()!
    }
});




import jQuery from "jquery";
global.jQuery=jQuery
global.$=jQuery
import VueContentPlaceholders from 'vue-content-placeholders'
Vue.use(VueContentPlaceholders);

const app = new Vue({
    el: "#app",
    router,
    mounted() {
        this.get_user();
        this.get_lang();
        
    },

    data() {
        return {
            user: "",
            token: localStorage.getItem("token"),
            search: "",
            loading: false,
            user_package: "",
            package_id: "",
            filter_ads: new Form({
                search: "",
                category_id: "",
                type: "",
                user_id: "",
                state_id: "",
                city_id: "",
                region_id: "",
                neighbor_id: "",
                heating_id: "",
                price_from: 0,
                price_to: 0,
                area_from: 0,
                area_to: 0,
                currency: "",
                floor_count: "",
                balacony: "",
                furnished: "",
                available_for_loan: "",
                floor_number_id: "",
                heatings: [],
                title_deeds: [],
            }),
            lang: "en",
        };
    },
    methods: {
        check_lang(item,table){
            if(this.lang==''){
                this.lang='en'
            }
            let translated = table+this.lang
            return item[translated]
            
        },
        language(label){
            return label+this.lang
        },
        get_lang(){
            axios.get("/web/get_lang")
                 .then((resp)=>{
                    console.log(resp.data)
                    this.lang=resp.data
                 })
        },
        logout() {
            swal.fire({
                title: "Are you sure",
                text: "You are going to log out from your account",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout",
            }).then((result) => {
                if (result.value) {
                    //send request to server
                    axios
                        .post("/api/logout")
                        .then(() => {
                            localStorage.removeItem("token");
                            localStorage.removeItem("email_verified_at");
                            this.user = "";
                            this.token = "";
                            this.user_package = "";
                            this.$router.push("/login");
                        })
                        .catch(() => {
                            swal.fire("Error !", "warning");
                        });
                }
            });
        },
        check_auth() {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + this.token;
            axios
                .get("/api/user")
                .then((resp) => {
                    this.user = resp.data;
                    return resp.data;
                })
                .catch(() => {
                    localStorage.removeItem("token");
                    this.token=''
                    localStorage.removeItem("email_verified_at");
                    this.$router.push("/login");
                });
            // vue js code
        },
        get_user() {
            
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + this.token;
            axios.get("/api/user").then((resp) => {
                if(resp.data){
                    this.user = resp.data;
                }else{
                    localStorage.removeItem('token')
                }
                if(resp.data.email_verified_at!=null){
                    localStorage.setItem('email_verified_at',resp.data.email_verified_at)
                }
                
                Fire.$emit('LoadData')
            });
        },
        check_user_package() {
            if (this.user) {
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + this.token;
                axios.get("/api/check_user_package").then((resp) => {
                    this.user_package = resp.data;
                    return resp.data;
                });
            }
        },
        success(message) {
            toast.fire({
                icon: "success",
                title: message, ///Toast Notifiblogion
            });
        },
        user_type() {
            if (this.user.is_provider == 0 || this.user.is_provider == null) {
                return "Customer";
            } else {
                return "Service Provider";
            }
        },
        check_company(user) {
            if (user.is_company == 1) {
                return user.c_name;
            }
            {
                return user.name;
            }
        },
        swal_push(title, text, confirm_text, link) {
            swal.fire({
                title: title,
                text: text,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: confirm_text,
            }).then((result) => {
                if (result.value) {
                    this.$router.push(link);
                }
            });
        },
        login_alert() {
            this.swal_push(
                "Login Alert",
                "You should login to your account before this action",
                "Login",
                "/login"
            );
        },
        collapse(){ 
            document.getElementById("navbarSupportedContent").classList.remove('show');
        },
        send_verification_link(){
            axios.post('/api/send_verification_link')
                 .then((resp)=>{
                    this.success('we have sent you an email with a verification link');
                 })
        }
    },
});
