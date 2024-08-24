import React from 'react';
import ProgressStep from './ProgressStep';

const ProgressBar = () => {
  const steps = [
    { label: 'Iniciar sesión', isActive: true },
    { label: 'Datos de envío y formas de pago', isActive: true },
    { label: 'Confirmación', isActive: false }
  ];

  return (
    <header className="flex relative gap-10 items-end self-center mt-28 text-sm font-bold tracking-wide text-green-800 max-md:mt-10 max-md:max-w-full">
      <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0e50d3c8b826068c684f8e8aaae5486a7bbc87805e23803a390bd12dfd3a4828?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3" alt="" className="object-contain absolute bottom-2.5 z-0 self-start h-0 min-w-[240px] right-[58px] w-[271px]" />
      {steps.map((step, index) => (
        <React.Fragment key={index}>
          <ProgressStep label={step.label} isActive={step.isActive} />
          {step.isActive && steps[index + 1]?.isActive && (
            <div className="h-1 w-10 bg-green-800"></div>
          )}
        </React.Fragment>
      ))}
      <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/39542631d1854d829eb54d8f16f4949c8830ea0ad8a7af5cfe2ecfa866db03a7?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3" alt="" className="object-contain absolute bottom-2.5 z-0 self-start h-0 left-[47px] min-w-[240px] w-[271px]" />
    </header>
  );
}

export default ProgressBar;