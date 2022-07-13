import config from "@/config";

const Base = {
    apiUrl: (version = config.DEAFULT_API_VERSION) => {
        let baseUrl = "";
        switch (config.ENV) {
            case "staging":
                baseUrl = config.API_URL_STAGING;
                break;
            case "production":
                baseUrl = config.API_URL_PROD;
                break;
            default:
                baseUrl = config.API_URL_LOCAL;
                break;
        }

        baseUrl += "/api/" + version;

        return baseUrl.replace(/\/$/, "");
    }
};

const API = {
    
    register: () => {
        return `${Base.apiUrl()}/register`;
    },

    login: () => {
        return `${Base.apiUrl()}/login`;
    },

    getGroups: () => {
        return `${Base.apiUrl()}/groups`;
    },

    completeCourse: () => {
        return `${Base.apiUrl()}/certifications`
    },

    getCertificates: () => {
        return `${Base.apiUrl()}/certifications`
    },

    logout: () => {
        return `${Base.apiUrl()}/logout`;
    },
};

export default API;
