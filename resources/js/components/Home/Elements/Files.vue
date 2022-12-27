<template>
    <div >

    <carousel :per-page="3" :mouse-drag="true" :navigationEnabled="false" :paginationEnabled="false" :spacePadding="5">
            <slide  v-for="slider,index in $parent.form.sliders.length" :key="index">
                   <div class="mb-3 edge-mr">
                            <label for="userimage" class="form-label">{{trans('lang.slider')}} {{slider}}</label>
                            <div class="gallery-box">
                                <span class="remove-slider-btn" @click="remove_slider(index)">
                                    <i class="ri-close-circle-line"></i>
                                </span>
                            <div class="upload-inner sm centred" v-if="!$parent.form.sliders[slider-1].image">
                                <i class="ri-file-upload-line"></i>
                                <div class="upload-box slider">
                                    <input v-if="!ad_images[slider-1].image" @change="upload" type="file" :id="'check_slider'+slider">
                                    <label v-if="!ad_images[slider-1].image" @click="change_slider(slider)" :for="'check_slider'+slider">{{trans('lang.click_here')}}</label>  
                                </div>
                            </div>
                            <div class="upload-inner sm centred" v-else>
                                
                                <div class="upload-box preview">
                                   <img  :src="$parent.form.sliders[slider-1].image">
                                </div>
                            </div>
                        </div>
                            <div class="upload-btns">
                            <button v-if="ad_images[slider-1].image" @click="upload_ad_image" :disabled="image_loading" type="button" class="btn btn-primary btn-sm">{{trans('lang.save')}}</button>
                            <button v-else-if="$parent.form.sliders[slider-1].image" @click="remove_ad_image(slider)"   type="button" class="btn btn-danger btn-sm">{{trans('lang.delete')}}</button>
                            </div>
                            <div class="text-danger" v-if="ad_images[slider-1].error"  v-html="ad_images[slider-1].error" />
                        </div>
            </slide>
    </carousel>
    <div class="mb-10">
    <div class="btn btn-primary" @click="add_slider" > + {{trans('lang.add_image')}} </div>
    </div>
    </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
    export default{
        mounted(){
            let i=0
            for(i=1;i<=1;i++){
                let element={name:'slider'+i,image:''}
                let element2={name:'slider'+i,image:'',error:''}
                this.$parent.form.sliders.unshift(element)
                this.ad_images.unshift(element2)
            }
        },
        data(){
            return {
                ad_image:'',
                slider:0,
                ad_images:[],
                image_loading:false
            }
        },
        methods:{
            add_slider(){
               let i= this.$parent.form.sliders.length
               if(i<15){
                   let element={name:'slider'+i,image:''}
                   let element2={name:'slider'+i,image:'',error:''}
                   this.$parent.form.sliders.unshift(element)
                   this.ad_images.unshift(element2)
                }
            },
            remove_slider(index){
                console.log(index)
                this.$parent.form.sliders.splice(index,1)
            },
            check_number(){
                if(this.$parent.form.sliders.length==1){
                    return 1
                }else if(this.$parent.form.sliders.length==2){
                    return 2
                }else if(this.$parent.form.sliders.length>2){
                    return 3
                }
            },
            upload(e){
                let file=e.target.files[0]
                this.ad_images[this.slider-1].image=file
            },
            change_slider(slider){
                this.slider=parseInt(slider)
            },
            upload_ad_image(){
            this.image_loading=true
            const formdata=new FormData
            formdata.append('image',this.ad_images[this.slider-1].image)
            this.ad_images[this.slider-1].error=''
            axios.post('/api/upload_ad_image',formdata)
                 .then((resp)=>{
                    if(resp.data.errors){
                        this.ad_images[this.slider-1].error=resp.data.errors.image
                        this.image_loading=false
                        this.ad_images[this.slider-1].image=''
                    }else{
                        this.$parent.form.sliders[this.slider-1].image=resp.data
                        this.ad_images[this.slider-1].image=''
                        this.image_loading=false
                    }
                 })
        },
    remove_ad_image(slider){
        this.slider=slider
            axios.post('/api/remove_ad_image',{path:this.$parent.form.sliders[this.slider-1].image})
                .then((resp)=>{
                    this.$parent.form.sliders[this.slider-1].image=''
                })
        },
        },
        components: {Carousel,Slide }
    }
</script>