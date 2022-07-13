<template>

    <div class="max-h-screen flex flex-col w-0 flex-1 mt-12 overflow-y-scroll">
        <main class="flex-1 relative z-0 overflow-y-scroll pt-2 pb-6 focus:outline-none md:py-6" tabindex="0">

            <div class="mx-auto px-4 sm:px-6 md:px-8 flex justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold text-gray-900">Welcome {{authUser.name}}</h1>
                </div>
            </div>
            
            <div class="mt-2 mx-auto px-4 sm:px-6 md:px-8 border border-gray-300"></div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md mx-12 my-12">
                <ul role="list" class="divide-y divide-gray-200">
                    <li v-for="group in groups" :key="group.id">
                        <a href="#" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div class="truncate">
                                        <div class="flex text-sm">
                                            <p class="font-medium text-indigo-600 truncate">{{group.course_name}}</p>
                                            <p class="ml-1 flex-shrink-0 font-normal text-gray-500">({{group.name}})</p>
                                        </div>
                                        <!-- <div class="mt-2 flex">
                                            <div class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                            </svg>
                                            <p>
                                                Closing on
                                                <time datetime="2020-01-07">January 7, 2020</time>
                                            </p>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                                        <div class="flex overflow-hidden -space-x-1">
                                            <!-- <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Dries Vincent">

                                            <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Lindsay Walton">

                                            <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Courtney Henry">

                                            <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Tom Cook"> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </main>
    </div>

    
</template>

<script>
import store from "../../store/index";
import groupService from "../../services/GroupService";

export default {

    name: "AdminContainer",
    mounted() {
        this.authUser = store.getters.getAuthUser;
        this.fetchGroups();
    },
    data: () => {
        return {
            authUser: {
                full_name: ""
            },
            groups : []
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
            }) 
        }
    }
};
</script>