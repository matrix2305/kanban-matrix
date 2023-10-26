import { UpdateTasksOrderInTaskListDTO } from "../../../api-client";

export interface UpdateTasksOrderInTaskList {
  id: number;
  taskIds: number[];
}

export const generateUpdateTasksOrderInTaskListDTO = (
  data: UpdateTasksOrderInTaskList,
): UpdateTasksOrderInTaskListDTO => ({ ...data });
