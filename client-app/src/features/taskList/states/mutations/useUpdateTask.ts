import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import { generateUpdateTaskDTO, UpdateTask } from "../../forms/UpdateTask";

export const useUpdateTask = () => {
  const config = useTaskListConfig("useUpdateTask");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: UpdateTask) => {
      await taskListApiClient.updateTask(generateUpdateTaskDTO(data));
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
      },
    },
  );

  return {
    updateTask: mutateAsync,
    isLoading,
    error,
  };
};
