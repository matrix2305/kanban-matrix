import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import { CreateTask, generateCreateTaskDTO } from "../../forms/CreateTask";

export const useCreateTask = () => {
  const config = useTaskListConfig("useCompleteAllTasksInList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: CreateTask) => {
      await taskListApiClient.createTask(generateCreateTaskDTO(data));
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
      },
    },
  );

  return {
    createTask: mutateAsync,
    isLoading,
    error,
  };
};
