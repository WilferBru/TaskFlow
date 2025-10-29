import axios from "axios";

const apiDomain = import.meta.env.VITE_API_URL

const axiosHttp = axios.create({
    baseURL: apiDomain
});

axiosHttp.interceptors.request.use(
    (config) => {

        const token = localStorage.getItem("token")
            ? localStorage.getItem("token")
            : "";
        if (token) {
            config.headers["Authorization"] = `Bearer ${token}`;
        }

        return config;
    },
    (error) => {
        return Promise.reject(error.response || error.message);
    }
);

axiosHttp.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {

        if (
            error.response &&
            error.response.status !== 403 &&
            error.response.status !== 401 &&
            error.response.status !== 500
        ) {
           /*  const responseData = error.response.data; */
        }

        if (error.response && error.response.status === 403) {
            localStorage.removeItem("token");
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }

        if (error.response && error.response.status === 401) {
            localStorage.removeItem("token");
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            return Promise.reject(error.response || error.message);
        }
    }
);

export default axiosHttp;