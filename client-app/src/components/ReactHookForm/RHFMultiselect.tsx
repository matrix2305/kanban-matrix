import { FormControl, InputLabel, Select, TextFieldProps } from "@mui/material";
import MenuItem from "@mui/material/MenuItem";
import { useMemo } from "react";
import { Controller, useFormContext } from "react-hook-form";

type IProps = {
  name: string;
  label: string;
  options: { id: string | number; name: string }[];
  rules?: any;
};

type Props = IProps & TextFieldProps;

export const RHFMultiselect = ({
  name,
  label,
  options,
  rules,
  ...other
}: Props) => {
  const uuid = useMemo(
    () => `${name}-${label}-${Math.floor(Math.random() * 101000000)}`,
    [],
  );
  const { control } = useFormContext();

  return (
    <Controller
      name={name}
      control={control}
      rules={rules}
      {...other}
      render={({ field }) => (
        <FormControl>
          <InputLabel id={uuid}>{label}</InputLabel>
          <Select labelId={uuid} label={label} multiple {...field}>
            {options.map((option, index) => (
              <MenuItem key={index} value={option.id}>
                {option.name}
              </MenuItem>
            ))}
          </Select>
        </FormControl>
      )}
    />
  );
};

export default RHFMultiselect;
