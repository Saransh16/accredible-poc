import api from "../api.js";
import baseService from "./BaseService";

const CertificateService = {
    index() {
        return new Promise((res, rej) => {
            axios.get(api.getCertificates(),
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
};

export default CertificateService;
