import { MoveTaskToAnotherTaskListDTO } from "../../../api-client";

export interface MoveTaskToAnotherTaskList {
  taskId: number;
  taskListId: number;
  movedToTaskListId: number;
}

export const generateMoveTaskToAnotherTaskListDTO = (
  data: MoveTaskToAnotherTaskList,
): MoveTaskToAnotherTaskListDTO => ({ ...data });
