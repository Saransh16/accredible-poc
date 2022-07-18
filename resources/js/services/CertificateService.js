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

    expireCredential(credential_id, group_id) {
        return new Promise((res, rej) => {
            axios.post(api.expireCertificate(),
            {
                credential_id : credential_id,
                group_id : group_id
            },
            {})
            .then((response) => {
                return res(response.data);
            },
            (error) => {
                baseService.handleError(error);
                return rej(error);
            })            
        })        
    }
};

export default CertificateService;
