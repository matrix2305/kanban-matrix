import ModalMui from "@mui/material/Modal";
import React from "react";

interface Props {
  title: string;
  isOpen: boolean;
  closeFn: () => void;
  children: React.ReactNode;
}

export default function Modal({ title, closeFn, children, isOpen }: Props) {
  return (
    <ModalMui open={isOpen} onClose={closeFn}>
      <div className="absolute top-[30%] left-[50%] -translate-x-[50%] -translate-y-[30%] bg-gray-300 rounded-md p-5 min-w-[500px]">
        <div className="flex justify-end mb-5">
          <button className="" onClick={closeFn}>
            Close
          </button>
        </div>
        <h3 className="text-lg font-bold mb-5">{title}</h3>
        {children}
      </div>
    </ModalMui>
  );
}
