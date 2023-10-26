import { UpdateTaskListDTO } from "../../../api-client";
import { UpdateTaskListForm } from "./UpdateTaskListForm";

export interface UpdateTaskList extends UpdateTaskListForm {
  id: number;
}

export const generateUpdateTaskListDTO = (
  data: UpdateTaskList,
): UpdateTaskListDTO => ({
  ...data,
});
