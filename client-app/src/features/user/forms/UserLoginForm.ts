import { UserLoginRequest } from "../../../api-client";

export interface UserLoginForm {
  email: string;
  password: string;
}

export const generateEmptyUserLoginForm = (): UserLoginForm => ({
  email: "",
  password: "",
});

export const generateUserLoginDTO = (
  data: UserLoginForm,
): UserLoginRequest => ({
  ...data,
});
