import React from "react";

function Button({ href, variant, children, width = 'w-full', type = 'button', callback = () => { } }) {
  const baseClasses = `gap-2 self-stretch px-6 py-4 ${width} text-center text-sm font-bold tracking-wide whitespace-nowrap rounded-3xl max-md:px-5 max-md:max-w-full`
  const variantClasses = {
    primary: "text-white bg-green-800",
    secondary: "text-green-800 bg-white border border-green-800 border-solid",
  };

  if (href) return <a href={href}
    className={`${baseClasses} ${variantClasses[variant]} hover:text-white hover:bg-green-800`} onClick={callback}>
    {children}
  </a>
  return (
    <button
      type={type}
      className={`${baseClasses} ${variantClasses[variant]} hover:text-white hover:bg-green-800`} onClick={callback}>
      {children}
    </button>
  );
}

export default Button;