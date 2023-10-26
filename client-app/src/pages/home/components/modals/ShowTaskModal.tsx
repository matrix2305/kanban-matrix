import { TaskDTO } from "../../../../api-client";
import Modal from "../../../../components/Modal";

interface Props {
  opened: boolean;
  close: () => void;
  task: TaskDTO;
}

function ShowTaskModal({ opened, close, task }: Props) {
  return (
    <Modal closeFn={close} isOpen={opened} title="Show task">
      <h3>Task name: {task.name}</h3>
      <p>{task.description}</p>
      <div>
        <label>Assigned users</label>
        <div className="flex flex-wrap gap-3">
          {task.users?.map((user) => <div key={user.id}>{user.name}</div>)}
        </div>
      </div>
      <div>
        <label>Labels</label>
        <div className="flex flex-wrap gap-3">
          {task.labels?.map((label) => (
            <div
              key={label.id}
              className="w-[10px] h-[10px] border-[5px]"
              style={{ backgroundColor: label.color }}
            />
          ))}
        </div>
      </div>
    </Modal>
  );
}

export default ShowTaskModal;
