import { Button } from "@mui/material";
import { useEffect, useMemo } from "react";
import { useForm } from "react-hook-form";
import { TaskDTO } from "../../../../api-client";
import Modal from "../../../../components/Modal";
import RHFDatepicker from "../../../../components/ReactHookForm/RHFDatepicker";
import RHFFormProvider from "../../../../components/ReactHookForm/RHFFormProvider";
import RHFMultiselect from "../../../../components/ReactHookForm/RHFMultiselect";
import RHFTextField from "../../../../components/ReactHookForm/RHFTextField";
import { REQUIRED_FIELD_MESSAGE } from "../../../../config/inputConf";
import { useFetchAllLabels } from "../../../../features/label/states/queries/useFetchAllLabels";
import {
  generateUpdateTaskForm,
  UpdateTaskForm,
} from "../../../../features/taskList/forms/UpdateTaskForm";
import { useUpdateTask } from "../../../../features/taskList/states/mutations/useUpdateTask";
import { useFetchAllUsers } from "../../../../features/user/states/queries/useFetchAllUsers";

interface Props {
  task: TaskDTO;
  taskListId: number;
  opened: boolean;
  close: () => void;
}

function UpdateTaskModal({ opened, close, taskListId, task }: Props) {
  const { updateTask } = useUpdateTask();
  const { users } = useFetchAllUsers();
  const { labels } = useFetchAllLabels();
  const formData = useMemo(() => {
    return generateUpdateTaskForm(task);
  }, [opened, task]);

  const methods = useForm({
    defaultValues: formData,
    mode: "onChange",
  });

  const { handleSubmit, reset } = methods;

  useEffect(() => {
    reset(formData);
  }, [formData]);

  const labelsOptions = useMemo(() => {
    return labels?.map((label) => ({
      id: Number(label.id),
      name: `${label.name} - ${label.color}`,
    }));
  }, [labels]);

  const usersOptions = useMemo(() => {
    return users?.map((user) => ({
      id: Number(user.id),
      name: String(user.name),
    }));
  }, [labels]);

  const onSubmit = async (data: UpdateTaskForm) => {
    await updateTask({ ...data, taskListId, id: Number(task.id) });
    close();
  };

  return (
    <Modal title="Update Task" isOpen={opened} closeFn={close}>
      <RHFFormProvider methods={methods} onSubmit={handleSubmit(onSubmit)}>
        <div className="flex flex-col gap-3">
          <RHFTextField
            name="name"
            label="Name"
            rules={{
              required: REQUIRED_FIELD_MESSAGE,
              maxLength: {
                value: 256,
                message: "Maximum length is 256",
              },
            }}
          />
          <RHFTextField
            name="description"
            label="Description"
            rules={{
              required: REQUIRED_FIELD_MESSAGE,
            }}
          />
          <RHFDatepicker name="startOn" label="Start on" />
          <RHFDatepicker name="dueOn" label="Due on" />
          <RHFMultiselect
            name="usersIds"
            label="Assigned users"
            options={usersOptions ?? []}
          />
          <RHFMultiselect
            name="labelsIds"
            label="Labels"
            options={labelsOptions ?? []}
          />
          <Button type="submit">Submit</Button>
        </div>
      </RHFFormProvider>
    </Modal>
  );
}

export default UpdateTaskModal;
