<template>
    <div>
        <div class="min-h-screen bg-white flex">
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <div>
                        <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                            Create Account
                        </h2>
                        <p class="mt-2 text-gray-700 text-md">
                            Already have an account?
                            <span>
                                <a @click="goToLogin()" class="text-indigo-500 hover:text-indigo-700 hover:translate-y-2" href="#">Login</a>
                            </span>
                        </p>
                    </div>

                    <div class="mt-8">
                        <div class="mt-6">
                            <form @submit.prevent="register()" class="space-y-6 text-gray-700">
                                <div>
                                    <label for="email" class="block text-sm font-normal text-gray-700">
                                        Full Name
                                    </label>
                                    <div class="mt-1">
                                        <input v-model="form.name" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="mt-2 text-red-400 text-sm" v-if="form_errors.name">
                                        {{form_errors.name.join(", ")}}
                                    </div>                                
                                </div>                                                          
                                <div class="space-y-1">
                                    <label for="email" class="block text-sm font-normal text-gray-700">
                                        Email address
                                    </label>
                                    <div class="mt-1">
                                        <input type="email" v-model="form.email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="mt-2 text-red-400 text-sm" v-if="form_errors.email">
                                        {{form_errors.email.join(", ")}}
                                    </div>                                
                                </div>

                                <div class="space-y-1">
                                    <label for="password" class="block text-sm font-normal text-gray-700">
                                        Password
                                    </label>
                                    <div class="mt-1">
                                        <input type="password" v-model="form.password" placeholder="Atleast 6 characters" minlength="6" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="mt-2 text-red-400 text-sm" v-if="form_errors.password">
                                        {{form_errors.password.join(", ")}}
                                    </div>                                
                                </div>

                                <!-- using this for spam detection -->
                                <div class="space-y-1 hidden">
                                    <label  class="block text-sm font-normal text-gray-700">
                                        Spam Detection
                                    </label>
                                    <div class="mt-1">
                                        <input name="honeypot" type="text" v-model="form.is_spam_detected" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>                            

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sign in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block relative w-0 flex-1">
                <img class="absolute inset-0 h-full w-full object-cover" src="https://images.idgesg.net/images/article/2019/02/certificate_certification_by_svetazi_gettyimages-655331082_2400x1600-100788475-large.jpg?auto=webp&quality=85,70" alt="">
            </div>
        </div>
        <Toast 
            :show="alert.show" 
            :title="alert.title" 
            :message="alert.message" 
            @toast-close="alert.show = false"
        ></Toast>         

    </div>    
</template>

<script>
import authService from "@/services/AuthService.js";
import Toast from '@/components/partials/Toast';

export default {
    name : 'RegisterPage',
    components : {
        Toast
    },    
    data : () => {
        return {
            form : {
                'is_spam_detected' : ''
            },
            form_errors : {},
            alert: {
                show: false,
                title: '',
                message: '',
            },             
        }
    },
    methods : {
        register() {
            this.form_errors = {};
            authService.register(this.form)
            .then((res) => {
                console.log(res);
                this.$router.push({'name' : 'dashboard'});
            },
            (error) => {
                console.log("error", error);
                let message;
                if(error.code == 422) {
                    message = "Your form has errors.";
                    this.form_errors = error.errors;
                }
                this.showAlert(message);
            });

        },
        showAlert(message, time=3000) {
            this.alert.show = true;
            this.alert.title = message;
            setTimeout(() => {
                this.alert.show = false;
            }, time);
        },          
        goToLogin() {
            this.$router.push({'name' : 'LoginPage'});
        }
    }
}
</script>