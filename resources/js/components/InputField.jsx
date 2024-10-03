import React, { useState } from "react";


function InputField({ eRef, label, type = "text", value, defaultValue, placeholder, handleDatosFinales, name, className,
  required = false, maxLength, min, max, sendForm = false, disabled = false }) {


  const [touched, setTouched] = useState(true);

  const handleBlur = () => {
    setTouched(true);
  };

  const isError = required && touched && !value && sendForm;


  return (
    <div className="flex flex-col mt-1 w-full max-md:max-w-full">
      {label && (
        <label className="text-base font-bold tracking-wider text-neutral-900 max-md:max-w-full">
          {label} {required ? <span className="text-red-500 font-bold">*</span> : ''}
        </label>
      )}
      <input
        onBlur={handleBlur}
        ref={eRef}
        value={value}
        onChange={handleDatosFinales}
        name={name}
        type={type}
        defaultValue={defaultValue}
        placeholder={placeholder}
        required={required}
        disabled={disabled}
        maxLength={type === "number" ? undefined : maxLength}
        min={type === "number" ? min : undefined}
        max={type === "number" ? max : undefined}
        className={`gap-2 self-stretch px-6 py-4 mt-1 w-full text-sm tracking-wide rounded-2xl border  focus:ring-0 focus:outline-none
           focus:border-[#336234] ${isError ? 'border-red-500' : 'border-[#BDBDBD]'} max-md:px-5 max-md:max-w-full disabled:cursor-not-allowed no-spin`}
        onKeyDown={(e) => {

          if (e.key === 'Enter') {
            e.preventDefault();
          }
        }}
      />
      {isError && <span className="text-red-500 text-sm mt-1">Este campo es obligatorio</span>}
    </div>
  );
}

export default InputField;