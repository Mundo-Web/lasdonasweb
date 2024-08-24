import React from "react";

function PaymentOption({ icon, label }) {
  return (
    <div className="flex gap-1 items-center self-stretch my-auto whitespace-nowrap text-neutral-900">
      <img loading="lazy" src={icon} alt="" className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square" />
      <div className="self-stretch my-auto">{label}</div>
    </div>
  );
}

export default PaymentOption;