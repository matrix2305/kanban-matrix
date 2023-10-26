import { useMutation, useQueryClient } from "@tanstack/react-query";
import { useNavigate } from "react-router-dom";
import { BEARER_TOKEN_KEY } from "../../../../config";
import {
  FETCH_AUTHENTICATED_USER,
  userApiClient,
  useUserConfig,
} from "../../config";

export const useUserLogout = () => {
  const config = useUserConfig("useUserLogout");
  const queryClient = useQueryClient();
  const navigate = useNavigate();

  const { mutateAsync, isLoading, error } = useMutation(
    async () => {
      const response = await userApiClient.userLogout();
      return response.data;
    },
    {
      ...config,
      onSuccess: async () => {
        await queryClient.invalidateQueries([FETCH_AUTHENTICATED_USER]);
        localStorage.removeItem(BEARER_TOKEN_KEY);
        navigate("/login");
      },
    },
  );

  return {
    userLogout: mutateAsync,
    isLoading,
    error,
  };
};
