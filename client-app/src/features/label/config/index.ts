import { useLocation } from "react-router-dom";
import { LabelApi } from "../../../api-client";
import { apiBaseConfig, baseAxiosClient } from "../../../config";
import { KANBAN_ROUTES } from "../../../routes";

export const labelApiClient = new LabelApi(
  apiBaseConfig,
  process.env.API_BASE_URL,
  baseAxiosClient,
);

export const useLabelConfig = (caller: string) => {
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

export const FETCH_ALL_LABELS = "FETCH_ALL_LABELS";
