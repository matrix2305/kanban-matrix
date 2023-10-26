import { RouteObject, useRoutes } from "react-router-dom";
import AuthGuard from "../guards/AuthGuard";
import GuestGuard from "../guards/GuestGuard";
import Home from "../pages/home";
import Login from "../pages/login";

export const KANBAN_ROUTES = {
  login: "/login",
  home: "/",
};

const routeObject: RouteObject = {
  path: "/",
  children: [
    {
      path: KANBAN_ROUTES.login,
      element: (
        <GuestGuard>
          <Login />
        </GuestGuard>
      ),
    },
    {
      path: KANBAN_ROUTES.home,
      element: (
        <AuthGuard>
          <Home />
        </AuthGuard>
      ),
    },
  ],
};

export const AppRoutes = () => {
  return useRoutes([routeObject]);
};
