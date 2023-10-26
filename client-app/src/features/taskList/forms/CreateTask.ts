import { CreateTaskDTO } from "../../../api-client";
import { CreateTaskForm } from "./CreateTaskForm";

export interface CreateTask extends CreateTaskForm {
  taskListId: number;
}

export const generateCreateTaskDTO = (data: CreateTask): CreateTaskDTO => ({
  ...data,
});
