// form
// @mui
import {
  Checkbox,
  FormControlLabel,
  FormControlLabelProps,
  FormGroup,
} from "@mui/material";
import { Controller, useFormContext } from "react-hook-form";

// ----------------------------------------------------------------------

interface RHFCheckboxProps extends Omit<FormControlLabelProps, "control"> {
  name: string;
}

export function RHFCheckbox({ name, ...other }: RHFCheckboxProps) {
  const { control } = useFormContext();

  return (
    <FormControlLabel
      control={
        <Controller
          name={name}
          control={control}
          render={({ field }) => (
            <Checkbox
              {...field}
              checked={field.value}
              disabled={other.disabled}
            />
          )}
        />
      }
      {...other}
    />
  );
}

// ----------------------------------------------------------------------

interface RHFMultiCheckboxProps
  extends Omit<FormControlLabelProps, "control" | "label"> {
  name: string;
  options: {
    label: string;
    value: any;
  }[];
}

export function RHFMultiCheckbox({
  name,
  options,
  ...other
}: RHFMultiCheckboxProps) {
  const { control } = useFormContext();

  return (
    <Controller
      name={name}
      control={control}
      render={({ field }) => {
        const onSelected = (option: string) =>
          field.value.includes(option)
            ? field.value.filter((value: string) => value !== option)
            : [...field.value, option];

        return (
          <FormGroup>
            {options.map((option) => (
              <FormControlLabel
                key={option.value}
                control={
                  <Checkbox
                    checked={field.value.includes(option.value)}
                    onChange={() => field.onChange(onSelected(option.value))}
                  />
                }
                label={option.label}
                {...other}
              />
            ))}
          </FormGroup>
        );
      }}
    />
  );
}
