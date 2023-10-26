import { useLocation } from "react-router-dom";
import { TaskListApi } from "../../../api-client";
import { apiBaseConfig, baseAxiosClient } from "../../../config";
import { KANBAN_ROUTES } from "../../../routes";

export const taskListApiClient = new TaskListApi(
  apiBaseConfig,
  process.env.API_BASE_URL,
  baseAxiosClient,
);

export const useTaskListConfig = (caller: string) => {
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

export const FETCH_ALL_TASK_LISTS = "FETCH_ALL_TASK_LISTS";

export const FETCH_COMPLETED_TASK_LIST = "FETCH_COMPLETED_TASK_LIST";
