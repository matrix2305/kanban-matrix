import { UpdateTaskDTO } from "../../../api-client";
import { UpdateTaskForm } from "./UpdateTaskForm";

export interface UpdateTask extends UpdateTaskForm {
  id: number;
  taskListId: number;
}

export const generateUpdateTaskDTO = (data: UpdateTask): UpdateTaskDTO => ({
  ...data,
  startOn: data.startOn ?? undefined,
  dueOn: data.dueOn ?? undefined,
});
