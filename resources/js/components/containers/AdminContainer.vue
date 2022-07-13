<template>
    <div class="app">
        <!-- The burger button to be shown in small screens to open menu -->
        <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
            <button
                @click="showMenu = true"
                class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
                aria-label="Open sidebar"
            >
                <svg
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
        </div>
        <div class="h-screen flex overflow-hidden bg-white">
            <!-- Off-canvas menu for mobile -->
            <div class="md:hidden" v-show="showMenu">
                <div class="fixed inset-0 flex z-40">
                    <transition
                        enter-active-class="transition-opacity ease-linear duration-300"
                        enter-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition-opacity ease-linear duration-300"
                        leave-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div class="fixed inset-0" v-show="showMenu">
                            <div
                                class="absolute inset-0 bg-gray-600 opacity-75"
                            ></div>
                        </div>
                    </transition>
                    <transition
                        enter-active-class="transition ease-in-out duration-300 transform"
                        enter-class="-translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="transition ease-in-out duration-300 transform"
                        leave-class="translate-x-0"
                        leave-to-class="-translate-x-full"
                    >
                        <div
                            v-show="showMenu"
                            class="relative flex-1 flex flex-col max-w-xs w-full bg-white"
                        >
                            <div class="absolute top-0 right-0 -mr-14 p-1">
                                <button
                                    @click="showMenu = false"
                                    class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                                    aria-label="Close sidebar"
                                >
                                    <svg
                                        class="h-6 w-6 text-white"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                                <div
                                    class="flex-shrink-0 flex items-center px-4"
                                >
                                    <!-- <img
                                        class="h-6 w-auto"
                                        :src="asset('/images/notre-logo.png')"
                                        alt="Workflow"
                                    /> -->
                                </div>
                                <NavLinks />
                            </div>
                            <div
                                class="flex-shrink-0 flex border-t border-gray-200 p-4"
                            >
                                <a
                                    href="javascript:void(0)"
                                    class="flex-shrink-0 group block focus:outline-none"
                                >
                                    <div class="flex items-center">
                                        <div>
                                            <img
                                                class="inline-block h-10 w-10 rounded-full"
                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt
                                            />
                                        </div>
                                        <div class="ml-3">
                                            <p
                                                class="text-base leading-6 font-medium text-gray-700 group-hover:text-gray-900"
                                            >
                                                {{ authUser.name }}
                                            </p>
                                            <p
                                                class="text-sm leading-5 font-medium text-gray-500 group-hover:text-gray-700 group-focus:underline transition ease-in-out duration-150"
                                            >
                                                <a
                                                    href="#"
                                                    class="underline"
                                                    @click.prevent="logout()"
                                                    >Logout</a
                                                >
                                                &nbsp;
                                                <router-link
                                                    :to="{
                                                        name: 'dashboard'
                                                    }"
                                                    class="underline"
                                                >
                                                    Main Site
                                                </router-link>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </transition>
                    <div class="flex-shrink-0 w-14">
                        <!-- Force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div
                    class="flex flex-col w-64 border-r border-gray-200 bg-white"
                >
                    <div
                        class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto"
                    >
                        <div class="flex items-center flex-shrink-0 px-4">
                        </div>
                        <NavLinks />
                    </div>
                    <div
                        class="flex-shrink-0 flex border-t border-gray-200 p-4"
                    >
                        <a
                            href="javascript:void(0)"
                            class="flex-shrink-0 w-full group block"
                        >
                            <div class="flex items-center">
                                <div>
                                    <img
                                        class="inline-block h-9 w-9 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt
                                    />
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="lato text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900"
                                    >
                                        {{ authUser.name }}
                                    </p>
                                    <p
                                        class="text-sm leading-5 font-medium text-gray-500 group-hover:text-gray-700 group-focus:underline transition ease-in-out duration-150"
                                    >
                                        <a
                                            href="#"
                                            class="underline"
                                            @click.prevent="logout()"
                                            >Logout</a
                                        >
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import NavLinks from "@/components/partials/NavLinks.vue";
import store from "../../store/index";

export default {
    name: "AdminContainer",
    components: {
        NavLinks
    },
    data: () => {
        return {
            showMenu: false,
            profileDropdownShow: false,
            authUser: {
                full_name: ""
            }
        };
    },
    watch: {
        $route(to, from) {
            this.showMenu = false;
        }
    },
    mounted() {
        this.authUser = store.getters.getAuthUser;
    },
};
</script>
