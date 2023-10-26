import { StyledEngineProvider } from "@mui/material";
import { QueryClientProvider, QueryClient } from "@tanstack/react-query";
import React from "react";
import { BrowserRouter } from "react-router-dom";
import { AppRoutes } from "./routes";
import { LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDateFns } from "@mui/x-date-pickers/AdapterDateFns";

const App = () => {
  return (
    <LocalizationProvider dateAdapter={AdapterDateFns}>
      <StyledEngineProvider injectFirst>
        <QueryClientProvider client={new QueryClient()}>
          <BrowserRouter>
            <AppRoutes />
          </BrowserRouter>
        </QueryClientProvider>
      </StyledEngineProvider>
    </LocalizationProvider>
  );
};

export default App;
