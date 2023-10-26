import { useQuery } from "@tanstack/react-query";
import {
  FETCH_AUTHENTICATED_USER,
  userApiClient,
  useUserConfig,
} from "../../config";

export const useFetchAuthenticatedUser = () => {
  const config = useUserConfig("useFetchAuthenticatedUser");

  const { data, isLoading, error } = useQuery(
    [FETCH_AUTHENTICATED_USER],
    async () => {
      const response = await userApiClient.getAuthUser();
      return response.data;
    },
    { ...config },
  );

  return {
    user: data,
    isAuthenticated: !isLoading && !!data,
    isLoading,
    error,
  };
};
