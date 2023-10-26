import { Button } from "@mui/material";
import { useMemo } from "react";
import { useForm } from "react-hook-form";
import { TaskListDTO } from "../../../../api-client";
import Modal from "../../../../components/Modal";
import RHFFormProvider from "../../../../components/ReactHookForm/RHFFormProvider";
import RHFTextField from "../../../../components/ReactHookForm/RHFTextField";
import { REQUIRED_FIELD_MESSAGE } from "../../../../config/inputConf";
import { CreateTaskListForm } from "../../../../features/taskList/forms/CreateTaskListForm";
import {
  generateUpdateTaskListForm,
  UpdateTaskListForm,
} from "../../../../features/taskList/forms/UpdateTaskListForm";
import { useUpdateTaskList } from "../../../../features/taskList/states/mutations/useUpdateTaskList";

interface Props {
  taskList: TaskListDTO;
  opened: boolean;
  close: () => void;
}

function UpdateTaskListModal({ taskList, opened, close }: Props) {
  const { updateTaskList } = useUpdateTaskList();

  const formData = useMemo(() => {
    return generateUpdateTaskListForm(taskList);
  }, [opened, taskList]);

  const methods = useForm({
    defaultValues: formData,
    mode: "onChange",
  });

  const { handleSubmit } = methods;

  const onSubmit = async (data: UpdateTaskListForm) => {
    await updateTaskList({ ...data, id: Number(taskList.id) });
    close();
  };

  return (
    <Modal title="Update Task List" isOpen={opened} closeFn={close}>
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
          <Button type="submit">Submit</Button>
        </div>
      </RHFFormProvider>
    </Modal>
  );
}

export default UpdateTaskListModal;
