import { TaskDTO } from "../../../api-client";

export interface UpdateTaskForm {
  name: string;
  description: string;
  startOn?: string | null;
  dueOn?: string | null;
  usersIds: number[];
  labelsIds: number[];
}

export const generateUpdateTaskForm = (data: TaskDTO): UpdateTaskForm => ({
  name: String(data.name),
  description: String(data.description),
  startOn: data.startOn,
  dueOn: data.dueOn,
  usersIds: data.users?.map((user) => Number(user.id)) ?? [],
  labelsIds: data.labels?.map((label) => Number(label.id)) ?? [],
});
