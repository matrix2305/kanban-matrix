import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { GlobalLoader } from "../components/GlobalLoader";
import { useFetchAuthenticatedUser } from "../features/user/states/queries/useFetchAuthenticatedUser";
import { KANBAN_ROUTES } from "../routes";

interface Props {
  children: React.ReactNode;
}

function AuthGuard({ children }: Props) {
  const { isAuthenticated, isLoading } = useFetchAuthenticatedUser();
  const navigate = useNavigate();

  useEffect(() => {
    if (!isAuthenticated && !isAuthenticated) {
      navigate(KANBAN_ROUTES.login);
    }
  }, [isAuthenticated, isLoading]);

  if (isLoading) {
    return <GlobalLoader />;
  }

  return <>{children}</>;
}

export default AuthGuard;
