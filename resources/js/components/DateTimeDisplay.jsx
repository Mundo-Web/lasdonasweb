import React from "react";

function DateTimeDisplay({ date, time, iconSrc }) {
  return (
    <div className="flex flex-wrap gap-4 justify-center items-center px-6 py-3 w-full text-sm tracking-wide text-center text-white rounded-lg  bg-green-800 max-md:px-5 max-md:max-w-full">
      <i className="far fa-calendar-alt text-2xl"></i>
      {/* <img loading="lazy" src={iconSrc} alt="" className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" /> */}
      <div className="flex flex-col self-stretch my-auto w-[200px]">
        <div>{date}</div>
        <div className="mt-1">{time}</div>
      </div>
    </div>
  );
}

export default DateTimeDisplay;