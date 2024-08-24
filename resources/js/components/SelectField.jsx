import React from "react";

function SelectField({ label }) {
  return (
    <div className="gap-2 self-stretch px-6 py-4 mt-4 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 max-md:px-5 max-md:max-w-full">
      {label}
    </div>
  );
}

export default SelectField;