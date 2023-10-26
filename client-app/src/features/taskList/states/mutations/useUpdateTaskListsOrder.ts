import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import {
  generateUpdateTaskListsOrderDTO,
  UpdateTaskListsOrder,
} from "../../forms/UpdateTaskListsOrder";

export const useUpdateTaskListsOrder = () => {
  const config = useTaskListConfig("useUpdateTaskListsOrder");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: UpdateTaskListsOrder) => {
      await taskListApiClient.updateTaskListsOrder(
        generateUpdateTaskListsOrderDTO(data),
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
    updateTaskListsOrder: mutateAsync,
    isLoading,
    error,
  };
};
