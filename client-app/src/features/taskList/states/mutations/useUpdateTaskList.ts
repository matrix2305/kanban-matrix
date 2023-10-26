import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import {
  generateUpdateTaskListDTO,
  UpdateTaskList,
} from "../../forms/UpdateTaskList";

export const useUpdateTaskList = () => {
  const config = useTaskListConfig("useUpdateTaskList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: UpdateTaskList) => {
      await taskListApiClient.updateTaskList(generateUpdateTaskListDTO(data));
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
      },
    },
  );

  return {
    updateTaskList: mutateAsync,
    isLoading,
    error,
  };
};
