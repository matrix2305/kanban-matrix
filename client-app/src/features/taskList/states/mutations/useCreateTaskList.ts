import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import {
  CreateTaskListForm,
  generateCreateTaskListDTO,
} from "../../forms/CreateTaskListForm";

export const useCreateTaskList = () => {
  const config = useTaskListConfig("useCompleteAllTasksInList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: CreateTaskListForm) => {
      await taskListApiClient.createTaskList(generateCreateTaskListDTO(data));
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_ALL_TASK_LISTS]);
      },
    },
  );

  return {
    createTaskList: mutateAsync,
    error,
    isLoading,
  };
};
