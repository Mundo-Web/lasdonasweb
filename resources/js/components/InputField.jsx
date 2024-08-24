import React from "react";

function InputField({ label, type = "text", value, defaultValue, placeholder, handleDatosFinales, name, className }) {
  return (
    <div className="flex flex-col mt-4 w-full max-md:max-w-full">
      {label && (
        <label className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
          {label}
        </label>
      )}
      <input
        value={value}
        onChange={handleDatosFinales}
        name={name}
        type={type}
        defaultValue={defaultValue}
        placeholder={placeholder}
        className="gap-2 self-stretch px-6 py-4 mt-4 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full"
      />
    </div>
  );
}

export default InputField;