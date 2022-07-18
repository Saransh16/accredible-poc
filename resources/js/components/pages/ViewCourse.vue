<template>

    <div class="max-h-screen flex flex-col w-0 flex-1 mt-12 overflow-y-scroll">
        <main class="flex-1 relative z-0 overflow-y-scroll pt-2 pb-6 focus:outline-none md:py-6" tabindex="0">

            <div class="mx-auto px-4 sm:px-6 md:px-8 flex justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-900">View Course</h1>
                </div>
            </div>
            
            <div class="mt-2 mx-auto px-4 sm:px-6 md:px-8 border border-gray-300"></div>

            <div class="bg-white">
                <div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8 lg:py-24">
                    <div class="space-y-12 lg:grid lg:grid-cols-3 lg:gap-8 lg:space-y-0">
                        <div class="lg:col-span-4">                                                    
                            <div class="pb-5 border-b border-gray-200">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">{{group.course_name}}</h3>
                                <p class="mt-2 max-w-4xl text-sm text-gray-600">{{group.course_description}}</p>
                            </div>
                            <div class="space-y-4 sm:grid sm:grid-cols-3 sm:items-center sm:gap-6 sm:space-y-0 mt-12">
                                <div class="aspect-w-2 aspect-h-2 sm:aspect-w-2 sm:aspect-h-3">
                                    <img @click="openUrl(design.rasterized_content_url)" class="object-cover shadow-lg rounded-lg" :src="design.rasterized_content_url" alt="">
                                </div>
                                <div class="ml-8">
                                    <div class="text-center">
                                        Add in custom attributes
                                    </div>
                                    <form @submit.prevent="completeCourse()" class="space-y-6 text-gray-700 mt-12">
                                        <div>
                                            <label class="block text-sm font-normal text-gray-700">
                                                Company Name
                                            </label>
                                            <div class="mt-1">
                                                <input v-model="form.company_name" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>                                
                                        </div>

                                        <div class="space-y-1">
                                            <label class="block text-sm font-normal text-gray-700">
                                                Remarks
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="form.remarks" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>                                
                                        </div>
                           
                                        <div>
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Complete Course
                                            </button>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <Toast 
            :show="alert.show" 
            :title="alert.title" 
            :message="alert.message" 
            @toast-close="alert.show = false"
        ></Toast>         
    </div>
</template>

<script>
import groupService from "../../services/GroupService";
import Toast from '@/components/partials/Toast';

export default {
    name: 'ViewCourse',
    components : {
        Toast
    },     
    mounted() {
        let params = this.$route.params;
        this.group_id = params.id;        
        this.fetchGroup();
    },
    data:() => {
        return {
            alert: {
                show: false,
                title: '',
                message: '',
            },
            group_id : '',
            group : [],
            design : [],
            form : {
                company_name : '',
                remarks : ''
            }
        }
    },
    methods: {

        fetchGroup() {
            groupService.getGroup(this.group_id)
            .then((response) => {
                console.log(response);
                this.group = response.data.group;
                this.fetchDesign(response.data.group.certificate_design_id);
            },
            (error) => {
                console.log(error);
            });
        },

        fetchDesign(design_id) {
            groupService.getDesign(design_id)
            .then((response) => {
                console.log(response);
                this.design = response.data.design;
            },
            (error) => {
                console.log(error);
            })
        },

        completeCourse() {
            groupService.completeCourse(this.group.id, this.form)
            .then((response) => {
                console.log(response);
                this.showAlert('Certification completed successfully');
            },
            (error) => {
                console.log(error);
            });
        },

        showAlert(message, time=3000) {
            this.alert.show = true;
            this.alert.title = message;
            setTimeout(() => {
                this.alert.show = false;
            }, time);
        },        

        openUrl(url) {
            window.open(url, '_blank').focus();
        }
    }
}
</script>