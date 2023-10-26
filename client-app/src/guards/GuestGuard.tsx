import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { GlobalLoader } from "../components/GlobalLoader";
import { useFetchAuthenticatedUser } from "../features/user/states/queries/useFetchAuthenticatedUser";
import { KANBAN_ROUTES } from "../routes";

interface Props {
  children: React.ReactNode;
}

function GuestGuard({ children }: Props) {
  const { isAuthenticated, isLoading } = useFetchAuthenticatedUser();
  const navigate = useNavigate();

  useEffect(() => {
    if (isAuthenticated) {
      navigate(KANBAN_ROUTES.home);
    }
  }, [isAuthenticated]);

  if (isLoading) {
    return <GlobalLoader />;
  }

  return <>{children}</>;
}

export default GuestGuard;
