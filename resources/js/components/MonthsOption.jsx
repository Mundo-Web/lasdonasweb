import React from "react";

function MonthsOption({ label, isSelected }) {
  return (
    <div
      className={`flex-1 shrink gap-2 self-stretch px-6 py-4 rounded-3xl ${isSelected ? 'text-white bg-green-800' : 'border border-solid border-stone-300'
        } max-md:px-5`}
    >
      {label}
    </div>
  );
}

export default MonthsOption;