// form
// @mui
import { SxProps, TextField, TextFieldProps, Theme } from "@mui/material";
import { DatePicker } from "@mui/x-date-pickers";
import moment from "moment";
import { Controller, RegisterOptions, useFormContext } from "react-hook-form";
import { DATE_FORMAT } from "../../config";

// ----------------------------------------------------------------------

type IProps = {
  name: string;
  rules?: RegisterOptions;
  sx?: SxProps<Theme> | undefined;
};

type Props = IProps & TextFieldProps;

export const RHFDatepicker = ({ name, sx, ...other }: Props) => {
  const { control } = useFormContext();

  const formatStringDateToDateObject = (date: string) => {
    return moment(date, DATE_FORMAT).toDate();
  };

  const dateToString = (date: Date): string => {
    return moment(date).format(DATE_FORMAT);
  };

  return (
    <Controller
      name={name}
      rules={other.rules}
      control={control}
      render={({ field: { onChange, value }, fieldState: { error } }) => (
        <DatePicker
          label={other.label}
          value={value ? formatStringDateToDateObject(value) : null}
          onChange={(val) => onChange(val ? dateToString(val) : "")}
          disabled={other.disabled}
          renderInput={(params: any) => (
            <TextField
              error={!!error}
              helperText={error?.message}
              {...params}
              fullWidth
              sx={{
                ...sx,
              }}
            />
          )}
        />
      )}
    />
  );
};

export default RHFDatepicker;
