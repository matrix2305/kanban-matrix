import { Button } from "@mui/material";
import { useMemo } from "react";
import { useForm } from "react-hook-form";
import Modal from "../../../../components/Modal";
import RHFFormProvider from "../../../../components/ReactHookForm/RHFFormProvider";
import RHFTextField from "../../../../components/ReactHookForm/RHFTextField";
import { REQUIRED_FIELD_MESSAGE } from "../../../../config/inputConf";
import {
  CreateTaskListForm,
  generateEmptyCreateTaskListForm,
} from "../../../../features/taskList/forms/CreateTaskListForm";
import { useCreateTaskList } from "../../../../features/taskList/states/mutations/useCreateTaskList";

interface Props {
  opened: boolean;
  close: () => void;
}

function CreateTaskListModal({ opened, close }: Props) {
  const { createTaskList } = useCreateTaskList();
  const formData = useMemo(() => {
    return generateEmptyCreateTaskListForm();
  }, [opened]);

  const methods = useForm({
    defaultValues: formData,
    mode: "onChange",
  });

  const { handleSubmit } = methods;

  const onSubmit = async (data: CreateTaskListForm) => {
    await createTaskList(data);
    close();
  };

  return (
    <Modal title="Create Task List" isOpen={opened} closeFn={close}>
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

export default CreateTaskListModal;
