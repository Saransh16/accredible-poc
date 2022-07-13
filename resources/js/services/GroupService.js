import api from "../api.js";
import baseService from "./BaseService";

const GroupService = {

    index() {
        return new Promise((res, rej) => {
            axios.get(api.getGroups(),
            {})
            .then((response) => {
                return res(response.data);
            },
            (error) => {
                baseService.handleError(error);
                return rej(error);
            })            
        })
    },

    completeCourse(group_id) {
        return new Promise((res, rej) => {
            axios.post(api.completeCourse(),
            {
                group_id : group_id
            },
            {})
            .then((response) => {
                return res(response.data);
            },
            (error) => {
                baseService.handleError(error);
                return rej(error);
            });
        })
    }
}

export default GroupService;
