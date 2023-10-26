import { useMutation, useQueryClient } from "@tanstack/react-query";
import {
  FETCH_ALL_TASK_LISTS,
  FETCH_COMPLETED_TASK_LIST,
  taskListApiClient,
  useTaskListConfig,
} from "../../config";
import {
  generateMoveTaskToAnotherTaskListDTO,
  MoveTaskToAnotherTaskList,
} from "../../forms/MoveTaskToAnotherTaskList";

export const useMoveTaskToAnotherTaskList = () => {
  const config = useTaskListConfig("useMoveTaskToAnotherTaskList");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: MoveTaskToAnotherTaskList) => {
      await taskListApiClient.moveTaskToAnotherTaskList(
        generateMoveTaskToAnotherTaskListDTO(data),
      );
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
    moveTaskToAnotherList: mutateAsync,
    isLoading,
    error,
  };
};
