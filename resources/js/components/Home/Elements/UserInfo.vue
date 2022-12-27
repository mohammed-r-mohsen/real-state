<template>
    
    <div class="">
        <div class="myprofile-section" v-if="!$root.loading">
            <div class="general-information">
                <h4><i class="ri-shield-user-line"></i>{{trans('lang.general_information')}}:</h4>
                <div class="inner-box default-form">
                    <form @submit.prevent="update()">
                <div class="row">
                     <div class="col-lg-12">
                        <div class="mb-3 user-upload centred">
                            <div class="gallery-box" v-if="form.avatar==''">
                            <div class="upload-inner ">
                                <i class="ri-file-upload-line"></i>
                                <div class="upload-box">
                                    <input @change="upload" type="file" id="check1">
                                    <label for="check1">{{trans('lang.click_here')}}</label>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="gallery-box" v-else>
                            <div class="upload-inner ">
                                <div class="upload-box">
                                   <img v-if="form.avatar!=''" :src="form.avatar">
                                <img v-else-if="$root.user.avatar!==null" :src="$root.user.avatar">
                                <img v-else src="/assets2/images/user-icon.jpg">
                                     <span @click="form.avatar=''" v-if="form.avatar!=''"> <i class="f ri-close-circle-line"></i> </span>
                                </div>
                            </div>
                            </div>
                            <div class="text-danger" v-if="form.errors.has('avatar')" v-html="form.errors.get('avatar')" />
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="mb-3">
                            <div class="live-img">
                                <img v-if="form.avatar!=''" :src="form.avatar">
                                <img v-else-if="$root.user.avatar!==null" :src="$root.user.avatar">
                                <img v-else src="/assets2/images/user-icon.jpg">
                                <span @click="form.avatar=''" v-if="form.avatar!=''"> <i class="f ri-close-circle-line"></i> </span>
                            </div>
                        </div>
                    </div> -->
                
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.name')}} *</label>
                            <input type="text"  :class="{ 'is-invalid': form.errors.has('name') } " v-model="form.name" name="name" class="form-control"  >
                            <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.email')}} *</label>
                            <input  autocomplete="new-password"  type="email" :class="{ 'is-invalid': form.errors.has('email') } " v-model="form.email" class="form-control"  >
                            <div class="text-danger" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.phone')}} *</label>
                            <input type="text"  :class="{ 'is-invalid': form.errors.has('phone') } " v-model="form.phone" class="form-control" >
                            <div class="text-danger" v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.whatsapp')}} *</label>
                            <input type="text"  :class="{ 'is-invalid': form.errors.has('whatsapp') } " v-model="form.whatsapp" class="form-control" >
                            <div class="text-danger" v-if="form.errors.has('whatsapp')" v-html="form.errors.get('whatsapp')" />
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">{{trans('lang.city')}} *</label>
                            <v-select  @input="get_cities" v-model="form.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('state_id')" v-html="form.errors.get('state_id')" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">{{trans('lang.state')}} *</label>
                            <v-select   v-model="form.city_id" :options="cities" :reduce="city => city.id" label="lang_name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('city_id')" v-html="form.errors.get('city_id')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.address')}} *</label>
                            <input type="text"  :class="{ 'is-invalid': form.errors.has('address') } " v-model="form.address" class="form-control" >
                            <div class="text-danger" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                        </div>
                    </div> 
                   
                    
                
                    <div class="form-group text-left col-6" >
                        <div class="form-check">
                            <input :required="is_provider" v-model="form.is_provider" class="form-check-input" type="checkbox"   id="is-prvider">
                            <label class="form-check-label"  for="is-prvider"> {{trans('lang.are_you_provider')}}  </label>
                        </div>      
                        </div>
                    <div class="form-group text-left col-6" >
                        <div class="form-check">
                            <input v-model="form.is_company" class="form-check-input" type="checkbox"   id="is-company">
                            <label class="form-check-label"  for="is-company"> {{trans('lang.are_you_company')}}  </label>
                        </div>      
                        </div>
                        <div class="col-12 row" v-if="form.is_company==1">

                        <div class="mb-3 col-lg-6">
                            <label  class="form-label"> {{trans('lang.company_name')}} *</label>
                            <input  type="text" :class="{ 'is-invalid': form.errors.has('c_name') } " v-model="form.c_name" class="form-control" >
                            <div class="text-danger" v-if="form.errors.has('c_name')" v-html="form.errors.get('c_name')" />
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">{{trans('lang.licence_number')}} *</label>
                            <input  type="text" :class="{ 'is-invalid': form.errors.has('lisence_number') } " v-model="form.lisence_number" class="form-control" >
                            <div class="text-danger" v-if="form.errors.has('lisence_number')" v-html="form.errors.get('lisence_number')" />
                        </div>
                        <div class="mb-3 col-lg-3">
                            <label  class="form-label">{{trans('lang.licence_document')}} </label>
                            <div class="gallery-box" style="border:1px solid #ddd">
                            <div class="upload-inner centred">
                                <i class="ri-file-upload-line"></i>
                                <div class="upload-box">
                                    <input @change="upload2" type="file" id="check2">
                                    <label for="check2">{{trans('lang.click_here')}}</label>
                                </div>
                            </div>
                            </div>
                            <div class="text-danger" v-if="form.errors.has('lisence_document')" v-html="form.errors.get('lisence_document')" />
                        </div>
                        <div class="col-lg-3">
                        <div class="mb-3 mt-3">
                            <div class="live-img">
                                <img v-if="form.lisence_document!=''" :src="form.lisence_document">
                                <img v-else-if="$root.user.lisence_document!=''" :src="$root.user.lisence_document">
                                <img v-else src="/assets2/images/user-icon.jpg">
                                <span @click="form.lisence_document=''" v-if="form.lisence_document!=''"> <i class="f ri-close-circle-line"></i> </span>
                            </div>
                        </div>
                    </div>
                    
                        </div>
                
                    
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button v-if="!loading" class="theme-btn btn-one " type="submit">
                                {{trans('lang.update')}}
                            </button>
                            <button v-else disabled class="theme-btn btn-one " type="submit">
                                <Waiting></Waiting>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
        <div v-else>
            <loading :lines="6"></loading>
        </div>
    </div>
    
</template>

<script>
import Waiting from './Waiting.vue'

export default ({
    mounted() {
        Fire.$on(("LoadUser"), () => {
            this.get_user();
        });
        this.get_user();
        this.get_states();
    },
    props: ["is_provider", "after_update"],
    data() {
        return {
            form: new Form({
                id: "",
                name: "",
                phone: "",
                whatsapp: "",
                state_id: "",
                city_id: "",
                avatar: "",
                address: "",
                email: "",
                password: "",
                password_confirmation: "",
                is_provider: false,
                is_company: false,
                c_name: "",
                lisence_number: "",
                lisence_document: "",
            }),
            states: [],
            cities: [],
            loading: false
        };
    },
    methods: {
        upload(e) {
            let file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = () => {
                this.form.avatar = reader.result;
            };
            reader.readAsDataURL(file);
        },
        upload2(e) {
            let file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = () => {
                this.form.lisence_document = reader.result;
            };
            reader.readAsDataURL(file);
        },
        get_user() {
            this.form.fill(this.$root.user);
            this.form.avatar = "";
            this.form.lisence_document = "";
            this.form.is_provider = parseInt(this.form.is_provider);
            this.form.is_company = parseInt(this.form.is_company);
        },
        update() {
            this.loading = true;
            this.form.post("/api/update_profile")
                .then((resp) => {
                this.$root.user = resp.data;
                toast.fire({
                    icon: "success",
                    title: "Account Updated successfully.", ///Toast Notifiblogion
                });
                this.loading = false;
                this.$router.push(this.after_update);
            }).catch((resp)=>{
                this.loading = false;

            });
        },
        get_states() {
            axios.get("/api/get_states")
                .then((resp) => {
                this.states = resp.data;
            });
            axios.get("/api/get_cities/" + this.form.state_id)
                .then((resp) => {
                if (resp.data == "") {
                    this.form.city_id = "";
                }
                this.cities = resp.data;
            });
        },
        get_cities() {
            this.form.city_id = "";
            axios.get("/api/get_cities/" + this.form.state_id)
                .then((resp) => {
                if (resp.data == "") {
                    this.form.city_id = "";
                }
                this.cities = resp.data;
            });
        },
    },
    components: { Waiting }
})
</script>
