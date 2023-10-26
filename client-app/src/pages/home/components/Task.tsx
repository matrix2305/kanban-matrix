import { useState } from "react";
import { Draggable } from "react-beautiful-dnd";
import { TaskDTO } from "../../../api-client";
import UpdateTaskModal from "./modals/UpdateTaskModal";

interface Props {
  task: TaskDTO;
  taskListId: number;
  index: number;
  isCompleted: boolean;
}

function Task({ task, index, isCompleted, taskListId }: Props) {
  const [updateTaskModal, setUpdateTaskModal] = useState(false);

  return (
    <>
      <UpdateTaskModal
        task={task}
        taskListId={taskListId}
        opened={updateTaskModal}
        close={() => setUpdateTaskModal(false)}
      />
      <Draggable key={task.id} draggableId={`${task.id}`} index={index}>
        {(provided) => (
          <div
            className={`m-1 flex min-h-[100px] bg-slate-100 shadow-lg rounded-md border-[1px] overflow-hidden 
          "before:bg-slate-100 before:w-1 before:block" ${
            isCompleted && "before:bg-green-50 bg-green-50"
          }`}
            ref={provided.innerRef}
            {...provided.draggableProps}
            {...provided.dragHandleProps}
            data-id={task.id}
            onClick={() => setUpdateTaskModal(true)}
          >
            <div className="flex-1 p-2">
              <p className={`${isCompleted && "line-through"}`}>
                #{task.id} {task.name}
              </p>
              <div className="flex gap-2 items-center mt-2">
                {/* eslint-disable-next-line no-nested-ternary */}
                <div className="flex gap-1 items-center">
                  {task.labels?.map((label, index) => {
                    return (
                      <div
                        key={index}
                        className="w-2 h-2 rounded-full"
                        style={{
                          backgroundColor: label.color,
                        }}
                      />
                    );
                  })}
                  <span className="text-gray-400 text-sm">
                    +{task.labels?.length}
                  </span>
                </div>
              </div>
              <div className="flex justify-between items-center mt-2">
                <p className="font-bold text-gray-700 flex flex-wrap gap-3">
                  <span>{task.startOn ?? " - "}</span>
                  <span>{task.dueOn ?? " - "}</span>
                </p>
                <div className="flex -space-x-2">
                  {task.users?.map((user, index) => {
                    return (
                      <img
                        key={index}
                        src={user.avatarUrl}
                        alt={user.name}
                        className="w-7 h-7 rounded-full"
                      />
                    );
                  })}
                </div>
              </div>
            </div>
          </div>
        )}
      </Draggable>
    </>
  );
}

export default Task;
