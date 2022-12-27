<template>
    <div class="vue-content">

        <div class="card">
            <div class="card-body">
                <form @submit.prevent="update()">
                              <div class="row">
                                <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.about_title_en')}}</label>
                                            <textarea rows="4" class="form-control" v-model="form.about_title.en"></textarea> 
                                         <div class="text-danger" v-if="form.errors.has('about_title')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.about_title_tr')}}</label>
                                            <textarea rows="4" class="form-control" v-model="form.about_title.tr"></textarea> 
                                         <div class="text-danger" v-if="form.errors.has('about_title')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.about_title_ar')}}</label>
                                            <textarea rows="4" class="form-control" v-model="form.about_title.ar"></textarea> 
                                         <div class="text-danger" v-if="form.errors.has('about_title')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.about_desc_en')}}</label>
                                            <vue-editor v-model="form.about_desc.en"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('about_desc')" v-html="form.errors.get('about_desc')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.about_desc_tr')}}</label>
                                            <vue-editor v-model="form.about_desc.tr"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('about_desc')" v-html="form.errors.get('about_desc')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.about_desc_ar')}}</label>
                                            <vue-editor v-model="form.about_desc.ar"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('about_desc')" v-html="form.errors.get('about_desc')" />
                                      </div>
                                  </div>
                                  
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.terms_en')}}</label>
                                            <vue-editor v-model="form.terms.en"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('terms')" v-html="form.errors.get('terms_en')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.terms_tr')}}</label>
                                            <vue-editor v-model="form.terms.tr"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('terms')" v-html="form.errors.get('terms_tr')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.terms_ar')}}</label>
                                            <vue-editor v-model="form.terms.ar"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('terms')" v-html="form.errors.get('terms_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.privacy_en')}}</label>
                                            <vue-editor v-model="form.privacy.en"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('privacy')" v-html="form.errors.get('privacy_en')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.privacy_tr')}}</label>
                                            <vue-editor v-model="form.privacy.tr"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('privacy')" v-html="form.errors.get('privacy_tr')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.privacy_ar')}}</label>
                                            <vue-editor v-model="form.privacy.ar"></vue-editor> 
                                         <div class="text-danger" v-if="form.errors.has('privacy')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.banner_en')}}</label>
                                            <textarea rows="4" class="form-control" v-model="form.banner.en"></textarea> 
                                         <div class="text-danger" v-if="form.errors.has('banner')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.banner_tr')}}</label>
                                            <textarea rows="4" class="form-control" v-model="form.banner.tr"></textarea> 
                                         <div class="text-danger" v-if="form.errors.has('banner')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label  class="form-label">{{trans('lang.banner_ar')}}</label>
                                            <textarea rows="4" class="form-control" v-model="form.banner.ar"></textarea> 
                                         <div class="text-danger" v-if="form.errors.has('banner')" v-html="form.errors.get('privacy_ar')" />
                                      </div>
                                  </div>

                                  <div class="col-lg-12">
                                      <div class="hstack gap-2 justify-content-end">
                                          <button type="submit" class="btn btn-success">{{trans('lang.update')}}</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
            </div>
        </div>

      
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
export default {
    mounted(){
        if(this.page.banner!=null){
            this.form.fill(this.page)
        }
        
      
    },
    components: {
        VueEditor
    },
    props:['page'],
    data(){
        return {
            form :new Form({
                id:'',
                terms:{
                    en:'',
                    tr:'',
                    ar:'',
                },
                privacy:{
                    en:'',
                    tr:'',
                    ar:'',
                },
                banner:{
                    en:'',
                    tr:'',
                    ar:'',
                },
                about_title:{
                    en:'',
                    tr:'',
                    ar:'',
                },
                about_desc:{
                    en:'',
                    tr:'',
                    ar:'',
                },
            }),

        }
    },
    methods:{
        
    
       
      
        update(){
            this.form.post('/admin/admin_api/update_pages')
                .then(()=>{
                    //alert
                    var element = document.getElementById("updatedAlert");
                    element.classList.add("show");
                    setTimeout(() => {
                        element.classList.remove('show')
                    }, 3000);
                    //end alert
                })
        },
        
    }
}
</script>