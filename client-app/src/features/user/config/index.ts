import { useLocation } from "react-router-dom";
import { UserApi } from "../../../api-client";
import { apiBaseConfig, baseAxiosClient } from "../../../config";
import { KANBAN_ROUTES } from "../../../routes";

export const FETCH_AUTHENTICATED_USER = "FETCH_AUTHENTICATED_USER";
export const FETCH_ALL_USERS = "FETCH_ALL_USERS";

export const useUserConfig = (caller: string) => {
  const location = useLocation();

  return {
    retry: 0,
    onError: (error: any) => {
      if (
        error?.response?.status === 401 &&
        location.pathname !== KANBAN_ROUTES.login
      ) {
        window.location.href = KANBAN_ROUTES.login;
      }
    },
  };
};

export const userApiClient = new UserApi(
  apiBaseConfig,
  process.env.API_BASE_URL,
  baseAxiosClient,
);
