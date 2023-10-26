import { useMemo } from "react";
import { generateEmptyUserLoginForm } from "../../features/user/forms/UserLoginForm";
import { useUserLogin } from "../../features/user/states/mutations/useUserLogin";
import LoginForm from "./components/LoginForm";

function Login() {
  const formData = useMemo(() => {
    return generateEmptyUserLoginForm();
  }, []);
  const { userLogin } = useUserLogin();

  return (
    <div className="flex w-full h-[100vh] items-center justify-center">
      <LoginForm formData={formData} submitHandler={userLogin} />
    </div>
  );
}

export default Login;
