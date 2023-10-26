import { Button } from "@mui/material";
import { useForm } from "react-hook-form";
import RHFFormProvider from "../../../components/ReactHookForm/RHFFormProvider";
import RHFTextField from "../../../components/ReactHookForm/RHFTextField";
import { REQUIRED_FIELD_MESSAGE } from "../../../config/inputConf";
import { UserLoginForm } from "../../../features/user/forms/UserLoginForm";

interface Props {
  formData: UserLoginForm;
  submitHandler: (data: UserLoginForm) => void;
}

function LoginForm({ formData, submitHandler }: Props) {
  const methods = useForm({
    defaultValues: formData,
    mode: "onChange",
  });

  const { handleSubmit } = methods;

  return (
    <>
      <RHFFormProvider methods={methods} onSubmit={handleSubmit(submitHandler)}>
        <h1 className="text-center text-[23px] mb-3">Login - Kanban</h1>
        <div className="w-[500px] flex flex-col gap-3">
          <RHFTextField
            name="email"
            label="Email"
            rules={{ required: REQUIRED_FIELD_MESSAGE }}
          />
          <RHFTextField
            name="password"
            label="Password"
            type="password"
            rules={{ required: REQUIRED_FIELD_MESSAGE }}
          />
          <button
            type="submit"
            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full"
          >
            Submit
          </button>
        </div>
      </RHFFormProvider>
    </>
  );
}

export default LoginForm;
