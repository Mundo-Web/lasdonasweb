import React from 'react';

const ProgressStep = ({ label, isActive }) => {
  return (
    <div className="flex z-0 flex-col items-center">
      <div className={isActive ? 'text-green-800' : 'text-stone-200'}>{label}</div>
      <div className={`flex mt-2 rounded-full h-[21px] min-h-[21px] w-[21px] ${isActive ? 'bg-green-800' : 'bg-stone-200'}`} />
    </div>
  );
}

export default ProgressStep;