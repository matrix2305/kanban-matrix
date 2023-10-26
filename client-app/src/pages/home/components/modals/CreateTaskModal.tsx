import { Button } from "@mui/material";
import { useMemo } from "react";
import { useForm } from "react-hook-form";
import Modal from "../../../../components/Modal";
import RHFDatepicker from "../../../../components/ReactHookForm/RHFDatepicker";
import RHFFormProvider from "../../../../components/ReactHookForm/RHFFormProvider";
import RHFMultiselect from "../../../../components/ReactHookForm/RHFMultiselect";
import RHFTextField from "../../../../components/ReactHookForm/RHFTextField";
import { REQUIRED_FIELD_MESSAGE } from "../../../../config/inputConf";
import { useFetchAllLabels } from "../../../../features/label/states/queries/useFetchAllLabels";
import {
  CreateTaskForm,
  generateEmptyCreateTaskForm,
} from "../../../../features/taskList/forms/CreateTaskForm";
import { useCreateTask } from "../../../../features/taskList/states/mutations/useCreateTask";
import { useFetchAllUsers } from "../../../../features/user/states/queries/useFetchAllUsers";

interface Props {
  opened: boolean;
  close: () => void;
  taskListId: number;
}

function CreateTaskModal({ opened, close, taskListId }: Props) {
  const { createTask } = useCreateTask();
  const { users } = useFetchAllUsers();
  const { labels } = useFetchAllLabels();
  const formData = useMemo(() => {
    return generateEmptyCreateTaskForm();
  }, [opened]);

  const methods = useForm({
    defaultValues: formData,
    mode: "onChange",
  });

  const { handleSubmit } = methods;

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

  const onSubmit = async (data: CreateTaskForm) => {
    await createTask({ ...data, taskListId });
    close();
  };

  return (
    <Modal title="Create Task" isOpen={opened} closeFn={close}>
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
        </div>
        <Button type="submit">Submit</Button>
      </RHFFormProvider>
    </Modal>
  );
}

export default CreateTaskModal;
