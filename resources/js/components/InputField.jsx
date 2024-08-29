import React from "react";

function InputField({ eRef, label, type = "text", value, defaultValue, placeholder, handleDatosFinales, name, className, required = false }) {
  return (
    <div className="flex flex-col mt-1 w-full max-md:max-w-full">
      {label && (
        <label className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
          {label} {required ? <span className="text-red-500 font-bold">*</span> : ''}
        </label>
      )}
      <input
        // required={isRequired}
        ref={eRef}
        value={value}
        onChange={handleDatosFinales}
        name={name}
        type={type}
        defaultValue={defaultValue}
        placeholder={placeholder}
        required={required}
        className="gap-2 self-stretch px-6 py-4 mt-1 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full"
      />
    </div>
  );
}

export default InputField;