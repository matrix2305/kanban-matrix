export interface CreateTaskForm {
  name: string;
  description: string;
  startOn?: string;
  dueOn?: string;
  usersIds: number[];
  labelsIds: number[];
}

export const generateEmptyCreateTaskForm = (): CreateTaskForm => ({
  name: "",
  description: "",
  startOn: "",
  dueOn: "",
  usersIds: [],
  labelsIds: [],
});
