import React from "react";

function Button({ variant, children, width = 'w-full', callback = () => { } }) {
  const baseClasses = `gap-2 self-stretch px-6 py-4 ${width} text-sm font-bold tracking-wide whitespace-nowrap rounded-3xl max-md:px-5 max-md:max-w-full`
  const variantClasses = {
    primary: "text-white bg-green-800",
    secondary: "mt-2 text-green-800 bg-white border border-green-800 border-solid",
  };

  return (
    <button
      type="button"
      className={`${baseClasses} ${variantClasses[variant]} hover:text-white hover:bg-green-800`} onClick={callback}>
      {children}
    </button>
  );
}

export default Button;