import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  FETCH_COMPLETED_TASK_LIST,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";

export const useCompleteAllTasksInList = () => {
  const config = useTaskListConfig("useCompleteAllTasksInList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (id: number) => {
      await taskListApiClient.completeAllTasksInList(id);
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
        await queryClient.invalidateQueries([FETCH_COMPLETED_TASK_LIST]);
      },
    },
  );

  return {
    completeAllTasksInList: mutateAsync,
    isLoading,
    error,
  };
};
