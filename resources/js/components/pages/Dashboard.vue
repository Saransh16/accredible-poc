<template>
    <div>
        Welcome {{authUser.name}}
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
            },
            (error) => {
                console.log(error);
            }) 
        }
    }
};
</script>