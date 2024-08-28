import React, { useState, useEffect } from 'react';


function TotalRow({ label, value, isBold = false }) {
  const textClasses = isBold
    ? "text-base font-bold tracking-wider text-right"
    : "text-sm tracking-wide text-right";

  const [loadingText, setLoadingText] = useState('Seleccione direccion');

  useEffect(() => {
    const loadingStates = ['Seleccione direccion', 'Seleccione direccion.', 'Seleccione direccion..', 'Seleccione direccion...'];
    let index = 0;

    const interval = setInterval(() => {
      index = (index + 1) % loadingStates.length;
      setLoadingText(loadingStates[index]);
    }, 500);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="flex items-center gap-5 self-end mt-6 max-w-full font-bold text-right w-[400px]">
      <div className={`self-stretch my-auto ${textClasses} text-neutral-900 text-opacity-80 w-[133px]`}>
        {label}
      </div>
      <div className={`self-stretch px-2 ${textClasses} text-neutral-900 w-[140px] text-start`}>
        {value == 0 ? loadingText : (<>S / {Number(value).toFixed(2)}</>)}

      </div>
    </div>
  );
}

export default TotalRow;