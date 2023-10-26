import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";

export const useDeleteTaskList = () => {
  const config = useTaskListConfig("useCompleteAllTasksInList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (id: number) => {
      await taskListApiClient.deleteTaskList(id);
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
      },
    },
  );

  return {
    deleteTask: mutateAsync,
    isLoading,
    error,
  };
};
