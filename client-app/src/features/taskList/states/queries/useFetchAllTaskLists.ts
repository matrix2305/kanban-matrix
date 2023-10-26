import { useQuery } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";

export const useFetchAllTaskLists = () => {
  const config = useTaskListConfig("useFetchAllTaskLists");

  const { data, isLoading, error } = useQuery(
    [FETCH_ALL_TASK_LISTS],
    async () => {
      const response = await taskListApiClient.getAllTaskLists();
      return response.data;
    },
    {
      ...config,
    },
  );

  return {
    taskLists: data,
    error,
    isLoading,
  };
};
