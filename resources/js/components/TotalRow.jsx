import React from 'react';

function TotalRow({ label, value, isBold = false }) {
  const textClasses = isBold
    ? "text-base font-bold tracking-wider text-right"
    : "text-sm tracking-wide text-right";

  return (
    <div className="flex items-center self-end mt-6 max-w-full font-bold text-right w-[400px]">
      <div className={`self-stretch my-auto ${textClasses} text-neutral-900 text-opacity-80 w-[133px]`}>
        {label}
      </div>
      <div className={`self-stretch my-auto ${textClasses} text-neutral-900 w-[133px]`}>
        {console.log(value)}
        S/ {Number(value).toFixed(2)}
      </div>
    </div>
  );
}

export default TotalRow;