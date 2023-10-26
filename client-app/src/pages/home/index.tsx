import { GlobalLoader } from "../../components/GlobalLoader";
import { useFetchAllTaskLists } from "../../features/taskList/states/queries/useFetchAllTaskLists";
import { useFetchCompletedTaskList } from "../../features/taskList/states/queries/useFetchCompletedTaskList";
import { useUserLogout } from "../../features/user/states/mutations/useUserLogout";
import TaskLists from "./components/TaskLists";

function Home() {
  const { completedTaskList, isLoading: isLoadingCompletedTaskList } =
    useFetchCompletedTaskList();
  const { taskLists, isLoading: isLoadingAllTaskLists } =
    useFetchAllTaskLists();
  const { userLogout } = useUserLogout();

  if (isLoadingAllTaskLists || isLoadingCompletedTaskList) {
    return <GlobalLoader />;
  }

  return (
    <>
      <div className="flex items-center">
        <h5 className="text-3xl text-blue-700 text-center my-10 w-full">
          Kanban - Matrix2305
        </h5>
        <div className="mx-10">
          <button onClick={() => userLogout()}>Logout</button>
        </div>
      </div>
      {completedTaskList && taskLists && (
        <TaskLists lists={taskLists} completedTaskList={completedTaskList} />
      )}
    </>
  );
}

export default Home;
