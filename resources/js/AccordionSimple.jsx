import React, { useState } from 'react';
import AccordionContentSimple from './AccordionContentSimple';


const AccordionSimple = ({ datos, url_env }) => {
  const [activeIndex, setActiveIndex] = useState(null);
  const [loadedIndexes, setLoadedIndexes] = useState([]);

  const handleAccordionClick = (index) => {
    if (activeIndex === index) {
      setActiveIndex(null);
    } else {
      setActiveIndex(index);
      if (!loadedIndexes.includes(index)) {
        setLoadedIndexes([...loadedIndexes, index]);
      }
    }
  };



  return (
    <div>
      {datos.map((complemento, index) => (
        <div key={complemento.id} className='mb-3'>
          <h2 id={`accordion-collapse-heading-${complemento.id}`} className="">
            <button
              className={`flex items-center justify-between w-full p-4 font-medium rounded-t-xl  dark:focus:ring-gray-800 dark:border-gray-700 dark:text-black  dark:hover:bg-gray-800 gap-3 ${activeIndex === index ? 'bg-[#FF8555] text-white' : 'text-black bg-gray-100'}`}
              data-accordion-target={`#accordion-collapse-body-${complemento.id}`}
              aria-expanded={activeIndex === index}
              aria-controls={`accordion-collapse-body-${complemento.id}`}
              type="button"
              style={{ transition: 'all 500ms ease-in-out' }}
              onClick={() => handleAccordionClick(index)}
            >
              <span>{complemento.name}</span>
              <svg
                data-accordion-icon=""
                className={`w-3 h-3 shrink-0 ${activeIndex === index ? '' : 'rotate-180'} stroke-[#FF8555]`}
                fill="none"
                viewBox="0 0 10 6"
              >
                <path
                  stroke="currentColor"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M9 5 5 1 1 5"
                />
              </svg>
            </button>
          </h2>
          <div
            id={`accordion-collapse-body-${complemento.id}`}
            className={`${activeIndex === index ? '' : 'hidden'}`}
            aria-labelledby={`accordion-collapse-heading-${complemento.id}`}
          >
            <div className="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
              {loadedIndexes.includes(index) && <AccordionContentSimple id={complemento.id} url_env={url_env} contenido={complemento.text} />}
            </div>
          </div>
        </div>
      ))}
    </div>
  );
};

export default AccordionSimple;