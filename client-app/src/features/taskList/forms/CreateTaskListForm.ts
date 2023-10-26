import { CreateTaskListDTO } from "../../../api-client";

export interface CreateTaskListForm {
  name: string;
}

export const generateEmptyCreateTaskListForm = (): CreateTaskListForm => ({
  name: "",
});

export const generateCreateTaskListDTO = (
  data: CreateTaskListForm,
): CreateTaskListDTO => ({
  ...data,
});
