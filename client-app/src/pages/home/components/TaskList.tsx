import IconButton from "@mui/material/IconButton";
import Menu from "@mui/material/Menu";
import MenuItem from "@mui/material/MenuItem";
import React, { useState } from "react";
import { Droppable } from "react-beautiful-dnd";
import { TaskDTO, TaskListDTO } from "../../../api-client";
import dots from "../../../assets/trotacka.svg";
import CreateTaskModal from "./modals/CreateTaskModal";
import UpdateTaskListModal from "./modals/UpdateTaskListModal";
import Task from "./Task";
import { useCompleteAllTasksInList } from "../../../features/taskList/states/mutations/useCompleteAllTasksInList";
import { useDeleteTaskList } from "../../../features/taskList/states/mutations/useDeleteTaskList";

interface Props {
  taskList: TaskListDTO;
}

function TaskList({ taskList }: Props) {
  const [dropdown, setDropdown] = React.useState<null | HTMLElement>(null);
  const menuOpen = Boolean(dropdown);
  const { completeAllTasksInList } = useCompleteAllTasksInList();
  const { deleteTask } = useDeleteTaskList();
  const [updateTaskListModal, setUpdateTaskListModal] = useState(false);
  const [createNewTaskModal, setCreateNewTaskModal] = useState<boolean>(false);
  const [taskForUpdate, setTaskForUpdate] = useState<TaskDTO | null>(null);

  const completeAllTasksInListHandler = async () => {
    await completeAllTasksInList(Number(taskList.id));
    handleMenuClose();
  };

  const deleteTaskHandler = async () => {
    await deleteTask(Number(taskList.id));
    handleMenuClose();
  };

  const handleMenuOpen = (event: React.MouseEvent<HTMLButtonElement>) => {
    setDropdown(event.currentTarget);
  };
  const handleMenuClose = () => {
    setDropdown(null);
  };

  return (
    <>
      <UpdateTaskListModal
        taskList={taskList}
        opened={updateTaskListModal}
        close={() => setUpdateTaskListModal(false)}
      />
      <CreateTaskModal
        opened={createNewTaskModal}
        close={() => setCreateNewTaskModal(false)}
        taskListId={Number(taskList.id)}
      />
      <Droppable droppableId={`${taskList.id}`} direction="vertical">
        {(provided) => (
          <div
            {...provided.droppableProps}
            ref={provided.innerRef}
            className="w-[350px] py-3 px-1"
          >
            <div className="flex justify-between items-center m-2 mb-5">
              <h4 className="font-bold flex items-center gap-2 px-4">
                <span className="text-gray-700 text-lg ">{taskList?.name}</span>{" "}
                <span className="text-gray-400 text-md">
                  ({taskList.tasks?.length})
                </span>
              </h4>

              <IconButton
                onClick={handleMenuOpen}
                aria-controls={menuOpen ? "basic-menu" : undefined}
                aria-haspopup="true"
                aria-expanded={menuOpen ? "true" : undefined}
              >
                <img src={dots} alt="dots" className="cursor-pointer" />
              </IconButton>
              <Menu
                open={menuOpen}
                onClose={handleMenuClose}
                sx={{
                  borderRadius: 8,
                }}
                anchorEl={dropdown}
              >
                <MenuItem onClick={completeAllTasksInListHandler}>
                  Complete
                </MenuItem>
                <MenuItem onClick={() => setUpdateTaskListModal(true)}>
                  Update
                </MenuItem>
                <MenuItem onClick={deleteTaskHandler}>Move to Trash</MenuItem>
              </Menu>
            </div>
            <div className="max-h-[80vh]  scrollbar-thin scrollbar-thumb-gray-500 scrollbar-thumb-rounded-full px-2">
              {taskList.tasks?.map((task, index) => {
                return (
                  <Task
                    key={index}
                    task={task}
                    index={index}
                    isCompleted={Boolean(taskList.completedTaskList)}
                    taskListId={Number(taskList.id)}
                  />
                );
              })}
              {provided.placeholder}
            </div>

            <button
              className="px-6 text-violet-700 font-bold mt-2 outline-none"
              onClick={() => setCreateNewTaskModal(true)}
            >
              + Add task
            </button>
          </div>
        )}
      </Droppable>
    </>
  );
}

export default TaskList;
