import { useQuery } from "@tanstack/react-query";
import { FETCH_ALL_USERS, userApiClient, useUserConfig } from "../../config";

export const useFetchAllUsers = () => {
  const config = useUserConfig("useFetchAllUsers");

  const { data, isLoading, error } = useQuery(
    [FETCH_ALL_USERS],
    async () => {
      const response = await userApiClient.getAllUsers();
      return response.data;
    },
    { ...config },
  );

  return {
    users: data,
    isLoading,
    error,
  };
};
