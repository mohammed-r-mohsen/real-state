<template>
    <div class="vue-content">
 
    <div class="card">
        <div class="card-body">
        <form @submit.prevent="update()">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="teammembersName" class="form-label">{{trans('lang.name')}} *</label>
                            <input required :class="{ 'is-invalid': form.errors.has('name') } " v-model="form.name" name="name" class="form-control" id="teammembersname" >
                            <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="usermail" class="form-label">{{trans('lang.email')}} *</label>
                            <input required autocomplete="new-password"  type="email" :class="{ 'is-invalid': form.errors.has('email') } " v-model="form.email" class="form-control" id="usermail" >
                            <div class="text-danger" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                        </div>
                    </div>
                    <!-- <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="useravatar" class="form-label">{{trans('lang.avatar')}} </label>
                            <input :class="{ 'is-invalid': form.errors.has('avatar') }" @change="upload" type="file" class="form-control" id="useravatar">
                            <div class="text-danger" v-if="form.errors.has('avatar')" v-html="form.errors.get('avatar')" />
                        </div>
                    </div> -->
                    
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userpassword" class="form-label">{{trans('lang.password')}} </label>
                            <input autocomplete="new-password" type="password" :class="{ 'is-invalid': form.errors.has('password') } " v-model="form.password" class="form-control" id="userpassword" >
                            <div class="text-danger" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userpassword" class="form-label">{{trans('lang.confirm_password')}} </label>
                            <input  type="password" :class="{ 'is-invalid': form.errors.has('password_confirmation') } " v-model="form.password_confirmation" class="form-control" id="userpassword_confirmation" >
                            
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success">Update</button>
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
        this.form.fill(this.admin)
        this.form.password=''
        this.form.avatar=''
    },
    props:['admin'],
    data(){
        return {
            form :new Form({
                id:'',
                name:'',
                avatar:'',
                email:'',
                password:'',
                password_confirmation:'',
            }),

        }
    },
    methods:{
    
        upload(e){
          let file=e.target.files[0]
          const reader=new FileReader()
          reader.onload= ()=>{
            this.form.avatar=reader.result
          }
          reader.readAsDataURL(file)
        },

      
        update(){
            this.form.put('/admin/admin_api/editors/'+this.form.id)
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