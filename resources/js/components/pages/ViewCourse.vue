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
                            <ul role="list" class="space-y-12 sm:divide-y sm:divide-gray-200 sm:space-y-0 sm:-mt-8 lg:gap-x-8 lg:space-y-0">
                                <li class="sm:py-8" v-for="certificate in certificates" :key="certificate.id">
                                    <div class="space-y-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:space-y-0">
                                        <div class="aspect-w-2 aspect-h-2 sm:aspect-w-2 sm:aspect-h-3">
                                            <img @click="openUrl(certificate.url)" class="object-cover shadow-lg rounded-lg" :src="certificate.url" alt="">
                                        </div>
                                        <div class="sm:col-span-2">
                                            <div class="space-y-4">
                                                <div class="text-lg leading-6 font-medium space-y-1">
                                                    <h3>{{certificate.group.course_name}}</h3>
                                                    <p class="text-indigo-600">{{certificate.group.name}}</p>
                                                    <div class="mt-2 flex">
                                                        <div class="flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>
                                                                Issued On
                                                                <span>{{certificate.issued_on}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 flex">
                                                        <div class="flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>
                                                                Expiring On
                                                                <span>{{certificate.expired_on}}</span>
                                                            </p>
                                                        </div>
                                                    </div>                                                                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</template>

<script>
import certificateService from "../../services/CertificateService";

export default {
    name: 'ViewCourse',
    mounted() {
        // this.fetchCertificates();
    },
    data:() => {
        return {
            certificates: []
        }
    },
    methods: {
        fetchCertificates() {
            certificateService.index()
            .then((response) => {
                console.log(response);
                this.certificates = response.data;
            },
            (error) => {
                console.log(error);
            });
        },

        openUrl(url) {
            window.open(url, '_blank').focus();
        }
    }
}
</script>