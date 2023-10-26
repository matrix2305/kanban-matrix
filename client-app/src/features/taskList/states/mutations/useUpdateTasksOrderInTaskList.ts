import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import {
  generateUpdateTasksOrderInTaskListDTO,
  UpdateTasksOrderInTaskList,
} from "../../forms/UpdateTasksOrderInTaskList";

export const useUpdateTasksOrderInTaskList = () => {
  const config = useTaskListConfig("useUpdateTasksOrderInTaskList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: UpdateTasksOrderInTaskList) => {
      await taskListApiClient.updateTasksOrderInTaskList(
        generateUpdateTasksOrderInTaskListDTO(data),
      );
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
      },
    },
  );

  return {
    updateTasksOrderInTaskList: mutateAsync,
    isLoading,
    error,
  };
};
