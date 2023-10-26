import { useQuery } from "@tanstack/react-query";
import {
  FETCH_COMPLETED_TASK_LIST,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";

export const useFetchCompletedTaskList = () => {
  const config = useTaskListConfig("useFetchCompletedTaskList");

  const { data, isLoading, error } = useQuery(
    [FETCH_COMPLETED_TASK_LIST],
    async () => {
      const response = await taskListApiClient.getCompletedTaskList();
      return response.data;
    },
    {
      ...config,
    },
  );

  return {
    completedTaskList: data,
    error,
    isLoading,
  };
};
