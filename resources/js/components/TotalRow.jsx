import React, { useState, useEffect } from 'react';


function TotalRow({ label, value, isBold = false, setIsModalOpen = () => {} }) {
  const textClasses = isBold
    ? "text-base font-bold tracking-wider text-right"
    : "text-sm tracking-wide text-right";

  // const [loadingText, setLoadingText] = useState('Evaluando');

  // useEffect(() => {
  //   const loadingStates = ['Evaluando', 'Evaluando.', 'Evaluando..', 'Evaluando...'];
  //   let index = 0;

  //   const interval = setInterval(() => {
  //     index = (index + 1) % loadingStates.length;
  //     setLoadingText(loadingStates[index]);
  //   }, 500);

  //   return () => clearInterval(interval);
  // }, []);

  return (
    <div className='flex flex-row justify-end'>
    <div className="flex flex-row items-center justify-end gap-5 mt-4 max-w-full font-bold text-right w-[400px]">
      <div className={`my-auto ${textClasses} text-neutral-900 text-opacity-80 w-[200px] md:w-[133px] text-start`}>
        {label}
      </div>
      <div className={`px-2 ${textClasses} text-neutral-900 w-full md:w-[133px]`}>
        {value == 0 ? <span className='text-center cursor-pointer' onClick={() => setIsModalOpen(true)}>
          <i className='fas fa-map-marker-alt me-1'></i>
          Seleccione una direccion
          </span> : (<>S / {Number(value).toFixed(2)}</>)}

      </div>
    </div>
    </div>
  );
}

export default TotalRow;