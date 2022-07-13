import api from "../api.js";
import baseService from "./BaseService";

const AuthService = {
    register(form_data) {
        return new Promise((res, rej) => {
            axios.post(api.register(), form_data, {}).then(
                response => {
                    return res(response.data);
                },
                error => {
                    baseService.handleError(error);
                    return rej(error.response.data);
                }
            );
        });
    },

    login(form_data) {
        return new Promise((res, rej) => {
            axios.post(api.login(), form_data, {}).then(
                response => {
                    return res(response.data);
                },
                error => {
                    baseService.handleError(error);
                    return rej(error.response.data);
                }
            );
        }); 
    }
};

export default AuthService;
