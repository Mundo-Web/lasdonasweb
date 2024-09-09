import React from "react";

function DateTimeDisplay({ date, time, iconSrc }) {
  return (
    <div className="flex flex-row gap-4 justify-center items-center px-3 md:px-6 py-5 w-full text-sm md:text-base tracking-wide text-center text-white rounded-lg  bg-green-800 ">
      <div className="max-w-xl mx-auto flex flex-row justify-center items-center gap-4 sm:gap-6 md:gap-10">
        <i className="far fa-calendar-alt text-2xl"></i>
        {/* <img loading="lazy" src={iconSrc} alt="" className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" /> */}
        <div className="flex flex-col self-stretch my-auto w-full">
          <div>{date}</div>
          <div className="mt-1">{time}</div>
        </div>
      </div>
    </div>
  );
}

export default DateTimeDisplay;