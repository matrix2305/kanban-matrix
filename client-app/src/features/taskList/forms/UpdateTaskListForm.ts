import { TaskListDTO } from "../../../api-client";

export interface UpdateTaskListForm {
  name: string;
}

export const generateUpdateTaskListForm = (
  data: TaskListDTO,
): UpdateTaskListForm => ({
  name: String(data.name),
});
