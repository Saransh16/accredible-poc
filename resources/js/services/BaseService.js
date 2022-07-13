const BaseService = {

    handleError(error) {
        let response = error.response;

        if (response && response.status) {
            switch (response.status) {
                case 401:
                    window.location.href = "/login";
                    break;
                case 404:
                    window.location.href = "/404";
                    break;
                default:
                    break;
            }
        }
    }
};

export default BaseService;
