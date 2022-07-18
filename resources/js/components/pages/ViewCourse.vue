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
            design : []
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

        openUrl(url) {
            window.open(url, '_blank').focus();
        }
    }
}
</script>