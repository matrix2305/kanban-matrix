import { useMutation, useQueryClient } from "@tanstack/react-query";
import { BEARER_TOKEN_KEY } from "../../../../config";
import {
  FETCH_AUTHENTICATED_USER,
  userApiClient,
  useUserConfig,
} from "../../config";
import { generateUserLoginDTO, UserLoginForm } from "../../forms/UserLoginForm";

export const useUserLogin = () => {
  const config = useUserConfig("useUserLogin");
  const queryClient = useQueryClient();

  const { mutateAsync, isLoading, error } = useMutation(
    async (data: UserLoginForm) => {
      const response = await userApiClient.userLogin(
        generateUserLoginDTO(data),
      );
      return response.data;
    },
    {
      ...config,
      onSuccess: (data) => {
        localStorage.setItem(BEARER_TOKEN_KEY, String(data.token));
        queryClient.setQueryData([FETCH_AUTHENTICATED_USER], data.user);
      },
    },
  );

  return {
    userLogin: mutateAsync,
    isLoading,
    error,
  };
};
