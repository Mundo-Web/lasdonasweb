import React, { useState } from 'react';

const AccordionItem = ({ title, content, id }) => {
  const [isOpen, setIsOpen] = useState(false);

  const toggleAccordion = () => {
    setIsOpen(!isOpen);
  };

  return (
    <div className=''>
      <h2 id={`accordion-heading-${id}`}>
        <button
          type="button"
          className={`text-center flex items-center justify-center w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0
             border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400
              hover:bg-gray-100 dark:hover:bg-gray-800 gap-3 ${isOpen ? 'bg-[#4b6e78] ' : ''}`}
          onClick={toggleAccordion}
          aria-expanded={isOpen}
          aria-controls={`accordion-body-${id}`}
        >
          <span className={`text-center items-center content-center ${isOpen ? 'text-white ' : ''} `}>{title}</span>
        </button>
      </h2>
      <div
        id={`accordion-body-${id}`}
        className={`${isOpen ? '' : 'hidden'} `}
        aria-labelledby={`accordion-heading-${id}`}
      >
        <div className="  border-gray-200 dark:border-gray-700 dark:bg-gray-900 text-center">
          {content}
        </div>
      </div>
    </div>
  );
};

export default AccordionItem;