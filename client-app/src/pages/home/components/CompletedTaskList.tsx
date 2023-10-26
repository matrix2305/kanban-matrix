import { Droppable } from "react-beautiful-dnd";
import { TaskListDTO } from "../../../api-client";
import Task from "./Task";

interface Props {
  completedTaskList: TaskListDTO;
}

function CompletedTaskList({ completedTaskList }: Props) {
  return (
    <Droppable droppableId={`${completedTaskList.id}`}>
      {(provided) => (
        <div
          {...provided.droppableProps}
          ref={provided.innerRef}
          className="w-[350px] py-3 px-1"
        >
          <div className="flex justify-between items-center m-2 mb-5">
            <h4 className="font-bold flex items-center gap-2 px-4">
              <span className="text-gray-700 text-lg ">
                {completedTaskList.name}
              </span>{" "}
              <span className="text-gray-400 text-md">
                ({completedTaskList.tasks?.length})
              </span>
            </h4>
          </div>
          <div className="max-h-[65vh] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-500 scrollbar-thumb-rounded-full px-2">
            {completedTaskList.tasks?.map((task, index) => {
              return (
                <Task
                  key={index}
                  task={task}
                  isCompleted={true}
                  index={index}
                  taskListId={Number(completedTaskList.id)}
                />
              );
            })}
            {provided.placeholder}
          </div>
        </div>
      )}
    </Droppable>
  );
}

export default CompletedTaskList;
