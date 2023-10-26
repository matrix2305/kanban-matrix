import { useState } from "react";
import { DragDropContext, DropResult } from "react-beautiful-dnd";
import { TaskListDTO } from "../../../api-client";
import { arrayMove } from "../../../utils/arrayMove";
import CompletedTaskList from "./CompletedTaskList";
import { useMoveTaskToAnotherTaskList } from "../../../features/taskList/states/mutations/useMoveTaskToAnotherTaskList";
import { useUpdateTasksOrderInTaskList } from "../../../features/taskList/states/mutations/useUpdateTasksOrderInTaskList";
import TaskList from "./TaskList";
import CreateTaskListModal from "./modals/CreateTaskListModal";

interface Props {
  lists: TaskListDTO[];
  completedTaskList: TaskListDTO;
}

function TaskLists({ lists, completedTaskList }: Props) {
  const [openedCreateTaskListModal, setOpenedCreateTaskListModal] =
    useState<boolean>(false);
  const { updateTasksOrderInTaskList } = useUpdateTasksOrderInTaskList();
  const { moveTaskToAnotherList } = useMoveTaskToAnotherTaskList();

  const handleDragEnd = async (result: DropResult) => {
    if (result.reason === "CANCEL") return;

    if (
      result.destination &&
      result.destination.droppableId !== result.source.droppableId
    ) {
      await moveTaskToAnotherList({
        movedToTaskListId: Number(result.destination.droppableId),
        taskId: Number(result.draggableId),
        taskListId: Number(result.source.droppableId),
      });
    } else {
      const taskList = lists?.find(
        (list) => list.id === Number(result.source.droppableId),
      );
      if (!taskList || !taskList.tasks || !result.destination) {
        return;
      }

      const toIndex = Number(result.destination.index);
      const fromIndex = taskList.tasks.findIndex(
        (task) => task.id === Number(result.draggableId),
      );

      const taskIds = arrayMove(
        taskList.tasks.map((task) => Number(task.id)),
        fromIndex,
        toIndex,
      );

      await updateTasksOrderInTaskList({
        id: Number(taskList.id),
        taskIds,
      });
    }
  };

  return (
    <div className="flex gap-3">
      {openedCreateTaskListModal && (
        <CreateTaskListModal
          opened={openedCreateTaskListModal}
          close={() => setOpenedCreateTaskListModal(false)}
        />
      )}
      <DragDropContext onDragEnd={handleDragEnd}>
        {lists.map((taskList, index) => {
          return <TaskList key={index} taskList={taskList} />;
        })}
        <div
          onClick={() => setOpenedCreateTaskListModal(true)}
          className="px-4 py-2 pt-1 text-3xl shadow-lg bg-slate-100 h-fit rounded-md flex justify-center items-center border-slate-200 text-slate-400 border-[1px] cursor-pointer"
        >
          <span>+</span>
        </div>
        <CompletedTaskList completedTaskList={completedTaskList} />
      </DragDropContext>
    </div>
  );
}

export default TaskLists;
