<template>
    <div class="vue-content">
 
    <div class="card">
        <div class="card-body">
        <form @submit.prevent="update()">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="teammembersName" class="form-label">Site {{trans('lang.name')}} *</label>
                            <input required :class="{ 'is-invalid': form.errors.has('name') } " v-model="form.site_name" class="form-control" id="teammembersname" >
                            <div class="text-danger" v-if="form.errors.has('site_name')" v-html="form.errors.get('site_name')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.email')}} *</label>
                            <input required autocomplete="new-password"  type="email" :class="{ 'is-invalid': form.errors.has('email') } " v-model="form.email" class="form-control"  >
                            <div class="text-danger" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.address')}} *</label>
                            <input required type="text" :class="{ 'is-invalid': form.errors.has('address') } " v-model="form.address" class="form-control"  placeholder="Enter address">
                            <div class="text-danger" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.phone')}} *</label>
                            <input required type="text" :class="{ 'is-invalid': form.errors.has('phone') } " v-model="form.phone" class="form-control"  >
                            <div class="text-danger" v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label  class="form-label">{{trans('lang.whatsapp')}} *</label>
                            <input required type="text" :class="{ 'is-invalid': form.errors.has('whatsapp') } " v-model="form.whatsapp" class="form-control"  placeholder="Enter whatsapp">
                            <div class="text-danger" v-if="form.errors.has('whatsapp')" v-html="form.errors.get('whatsapp')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="useravatar" class="form-label">{{trans('lang.logo')}} *</label>
                            <input  :class="{ 'is-invalid': form.errors.has('site_logo') }" @change="upload" type="file" class="form-control" id="usersite_logo">
                            <div class="text-danger" v-if="form.errors.has('site_logo')" v-html="form.errors.get('site_logo')" />
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
export default {
    mounted(){
        this.form.fill(this.settings)
        this.form.site_logo=''
    },
    props:['settings'],
    data(){
        return {
            form :new Form({
                id:'',
                site_name:'',
                site_logo:'',
                email:'',
                phone:'',
                whatsapp:'',
                address:'',
            }),

        }
    },
    methods:{
    
        upload(e){
          let file=e.target.files[0]
          const reader=new FileReader()
          reader.onload= ()=>{
            this.form.site_logo=reader.result
          }
          reader.readAsDataURL(file)
        },

      
        update(){
            this.form.post('/admin/admin_api/settings')
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