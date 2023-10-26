import { UpdateTaskListsOrderDTO } from "../../../api-client";

export interface UpdateTaskListsOrder {
  taskListIds: number[];
}

export const generateUpdateTaskListsOrderDTO = (
  data: UpdateTaskListsOrder,
): UpdateTaskListsOrderDTO => ({
  ...data,
});
