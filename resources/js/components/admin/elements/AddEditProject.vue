<template>
<div>
        <!-- Modal -->
    <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="inviteMembersModalLabel">Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="search-box mb-3">
                        <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                        <i class="ri-search-line search-icon"></i>
                    </div>

                    <div class="mb-4 d-flex align-items-center">
                        <div class="me-2">
                            <h5 class="mb-0 fs-13">Members :</h5>
                        </div>
                        <div class="avatar-group justify-content-center">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                                <div class="avatar-xs">
                                    <img src="/assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                        <div class="vstack gap-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <img src="/assets/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Nancy Martino</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                           
                        </div>
                        <!-- end list -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success w-xs">Invite</button>
                </div>
            </div>
            <!-- end modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
    <!-- end modal -->

    <form @submit.prevent="!$root.editMode?create():update()">
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="project-title-input">Project Title</label>
                    <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') } " type="text" class="form-control" id="project-title-input" placeholder="Enter project title">
                    <div class="text-danger" v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="project-thumbnail-img">Thumbnail Image</label>
                    <input @change="upload" class="form-control" id="project-thumbnail-img" type="file" accept="image/png, image/gif, image/jpeg">
                    <div class="text-danger" v-if="form.errors.has('image')" v-html="form.errors.get('image')" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Project {{trans('lang.description')}}</label>
                    <div id="ckeditor-classic" >
                        
                    </div>
                    <div class="text-danger" v-if="form.errors.has('desc')" v-html="form.errors.get('desc')" />
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3 mb-lg-0">
                            <label for="choices-priority-input" class="form-label">Priority</label>
                            <select v-model="form.priority" class="form-select" :class="{ 'is-invalid': form.errors.has('priority') } " data-choices data-choices-search-false id="choices-priority-input">
                                <option value="">Select</option>
                                <option value="High" selected>High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                            <div class="text-danger" v-if="form.errors.has('priority')" v-html="form.errors.get('priority')" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3 mb-lg-0">
                            <label for="choices-status-input" class="form-label">{{trans('lang.status')}}</label>
                            <select v-model="form.status" class="form-select" :class="{ 'is-invalid': form.errors.has('status') } " data-choices data-choices-search-false id="choices-status-input">
                                <option value="">Select</option>
                                <option value="Inprogress" >Inprogress</option>
                                <option value="Completed">Completed</option>
                            </select>
                                <div class="text-danger" v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <label for="datepicker-deadline-input" class="form-label">Deadline</label>
                            <input v-model="form.deadline" type="text" class="form-control" id="datepicker-deadline-input" placeholder="Enter due date" data-provider="flatpickr">
                            <div class="text-danger" v-if="form.errors.has('deadline')" v-html="form.errors.get('deadline')" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Attached files</h5>
            </div>
            <div class="card-body">
                <div>
                    <p class="text-muted">Add Attached files here.</p>

                    <div class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple="multiple">
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>

                            <h5>Drop files here or click to upload.</h5>
                        </div>
                    </div>

                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                        <li class="mt-2" id="dropzone-preview-list">
                            <!-- This is used as the file preview template -->
                            <div class="border rounded">
                                <div class="d-flex p-2">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-light rounded">
                                            <img src="#" alt="Project-Image" data-dz-thumbnail class="img-fluid rounded d-block" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="pt-1">
                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- end dropzon-preview -->
                </div>
            </div>
        </div>
        <!-- end card -->
        <div class="text-end mb-4">
            <button @click="$root.cancel" type="button" class="btn btn-danger w-sm">Cancel</button>
            <button type="button" class="btn btn-secondary w-sm">Draft</button>
            <button type="submit" class="btn btn-success w-sm">Create</button>
        </div>
    </div>
    <!-- end col -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Privacy</h5>
            </div>
            <div class="card-body">
                <div>
                    <label for="choices-privacy-status-input" class="form-label">{{trans('lang.status')}}</label>
                    <select v-model="form.privacy" class="form-select" data-choices data-choices-search-false id="choices-privacy-status-input">
                        <option value="">Select</option>
                        <option value="Private">Private</option>
                        <option value="Team">Team</option>
                        <option value="Public">Public</option>
                    </select>
                    <div class="text-danger" v-if="form.errors.has('privacy')" v-html="form.errors.get('privacy')" />
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tags</h5>
            </div>
            <div class="card-body"> 
                <div>
                    <label for="choices-text-input" class="form-label">Skills</label>
                    <input  class="form-control" id="choices-text-input" data-choices data-choices-limit="Required Limit" placeholder="Enter Skills" type="text"  />
                    <div class="text-danger" v-if="form.errors.has('skills')" v-html="form.errors.get('skills')" />
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Members</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="choices-lead-input" class="form-label">Team Lead</label>
                    <select v-model="form.leader_id" class="form-select" data-choices data-choices-search-false id="choices-lead-input">
                        <option value=""> Select </option>
                        <option v-for="(user,index) in users" :key="index" :value="user.id" >{{user.name}}</option>
                    </select>
                    <div class="text-danger" v-if="form.errors.has('leader_id')" v-html="form.errors.get('leader_id')" />
                </div>

                <div>
                    <label class="form-label">Team Members</label>
                    <div class="avatar-group">
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                            <div class="avatar-xs">
                                <img src="/assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Sylvia Wright">
                            <div class="avatar-xs">
                                <div class="avatar-title rounded-circle bg-secondary">
                                    S
                                </div>
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                            <div class="avatar-xs">
                                <img src="/assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid">
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Add Members">
                            <div class="avatar-xs" data-bs-toggle="modal" data-bs-target="#inviteMembersModal">
                                <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                    +
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

</div>
    </form>
<!-- end row -->
</div>
</template>


<script>
export default {
    mounted() {
        this.get_users()
    },
    data(){
        return {
            form:new Form({
                id:'',
                title:'',
                image:'',
                desc:'',
                priority:'',
                status:'',
                deadline:'',
                privacy:'',
                skills:'',
                leader_id:'',
                members:'',
            }),
            users:[],
        }
    },
    methods:{
        upload(e){
          let file=e.target.files[0]
          const reader=new FileReader()
          reader.onload= ()=>{
            this.form.image=reader.result
          }
          reader.readAsDataURL(file)
        },
        get_users(){
            axios.get('/admin/admin_api/users')
                 .then((resp)=>{
                     console.log(resp)
                     this.users=resp.data
                 })
        },
        create(){
           var desc= document.getElementsByClassName('ck-content')[0].innerHTML
           var skills= document.getElementById('choices-text-input').value
            this.form.desc=desc
            this.form.skills=skills
           
            this.form.post('/admin/admin_api/projects')
                .then((resp)=>{
                    Fire.$emit('Load')
                    //alert
                    var element = document.getElementById("createdAlert");
                    element.classList.add("show");
                    setTimeout(() => {
                        element.classList.remove('show')
                    }, 3000);
                    //end alert
                    $('#modalID').modal('hide')
                })
        },
      
        update(){
            this.form.put('/admin/admin_api/projects/'+this.form.id)
                .then(()=>{
                    Fire.$emit('Load')
                    //alert
                    var element = document.getElementById("updatedAlert");
                    element.classList.add("show");
                    setTimeout(() => {
                        element.classList.remove('show')
                    }, 3000);
                    //end alert
                    this.form.reset()
                    $('#modalID').modal('hide')
                })
        },
    }
}
</script>