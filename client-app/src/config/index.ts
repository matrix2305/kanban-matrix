import axios, { AxiosError, AxiosInstance } from "axios";

export const BEARER_TOKEN_KEY = "auth-key";

export const apiBaseConfig = {
  isJsonMime(mime: string): boolean {
    return false;
  },
  accessToken: `Bearer ${localStorage.getItem(BEARER_TOKEN_KEY)}`,
};

const setAxiosInterceptors = (axiosInstance: AxiosInstance) => {
  const interceptors = {
    onRequest: async (config: any) => {
      // Set csrf token

      // await axios.get(
      //     `${(axiosInstance.defaults.baseURL as string).replace('/api', '')}/sanctum/csrf-cookie`
      // );

      // Set bearer token from storage
      const token = localStorage.getItem(BEARER_TOKEN_KEY);
      if (!config.headers) config.headers = {};
      if (token) {
        config.headers.Authorization = "Bearer " + token;
      }
      config.headers["Content-Type"] = "application/json";
      return config;
    },
    onRequestError: (error: any) => Promise.reject(error),
    onResponse: (response: any) => response,
    onResponseError: async (error: AxiosError) => {
      return Promise.reject(error);
    },
  };

  axiosInstance.defaults.withCredentials = false;
  axiosInstance.interceptors.request.use(
    interceptors.onRequest,
    interceptors.onRequestError,
  );
  axiosInstance.interceptors.response.use(
    interceptors.onResponse,
    interceptors.onResponseError,
  );
  return axiosInstance;
};

export const baseAxiosClient = setAxiosInterceptors(axios.create());

export const DATE_FORMAT = "DD.MM.YYYY";
