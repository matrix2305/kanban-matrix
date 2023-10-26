import { useQuery } from "@tanstack/react-query";
import { FETCH_ALL_LABELS, labelApiClient, useLabelConfig } from "../../config";

export const useFetchAllLabels = () => {
  const config = useLabelConfig("useFetchAllLabels");

  const { data, isLoading, error } = useQuery(
    [FETCH_ALL_LABELS],
    async () => {
      const response = await labelApiClient.getAllLabels();
      return response.data;
    },
    { ...config },
  );

  return {
    labels: data,
    isLoading,
    error,
  };
};
