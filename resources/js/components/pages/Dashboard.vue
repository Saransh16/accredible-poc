<template>

    <div class="max-h-screen flex flex-col w-0 flex-1 mt-12 overflow-y-scroll">
        <main class="flex-1 relative z-0 overflow-y-scroll pt-2 pb-6 focus:outline-none md:py-6" tabindex="0">

            <div class="mx-auto px-4 sm:px-6 md:px-8 flex justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-900">Welcome {{authUser.name}}</h1>
                </div>
            </div>
            
            <div class="mt-2 mx-auto px-4 sm:px-6 md:px-8 border border-gray-300"></div>

            <div class="bg-white shadow overflow-hidden sm:rounded-md mx-12 my-12">
                <ul role="list" class="divide-y divide-gray-200">
                    <li v-for="group in groups" :key="group.id">
                        <a href="javascript:void(0)" @click="openCourse(group.id)" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div class="truncate">
                                        <div class="flex text-sm">
                                            <p class="font-medium text-indigo-600 truncate">{{group.course_name}}</p>
                                            <p class="ml-1 flex-shrink-0 font-normal text-gray-500">({{group.name}})</p>
                                        </div>
                                    </div>
                                    <!-- <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                                        <div class="flex overflow-hidden -space-x-1">
                                            <button @click="completeCourse(group.id)" type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Complete</button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
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
import store from "../../store/index";
import groupService from "../../services/GroupService";
import Toast from '@/components/partials/Toast';

export default {

    name: "AdminContainer",
    components : {
        Toast
    }, 
    mounted() {
        this.authUser = store.getters.getAuthUser;
        this.fetchGroups();
    },
    data: () => {
        return {
            authUser: {
                full_name: ""
            },
            groups : [],
            alert: {
                show: false,
                title: '',
                message: '',
            }            
        };
    },
    methods: {
        fetchGroups() {
            groupService.index()
            .then((response) => {
                console.log(response);
                this.groups = response.data;
            },
            (error) => {
                console.log(error);
            });
        },

        openCourse(group_id) {
            this.$router.push({name: 'view-course', params: { id: group_id}})
        },

        completeCourse(group_id) {
            groupService.completeCourse(group_id)
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
    }
};
</script>