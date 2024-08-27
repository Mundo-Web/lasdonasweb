import React from 'react';


function QuantitySelector({ quantity, Qadd, Qdelete }) {
  return (
    <div className="flex gap-1 items-center self-start p-2 mt-5 text-lg font-medium text-white whitespace-nowrap bg-green-400 rounded-3xl min-h-[40px]">
      <button aria-label="Decrease quantity" className="flex items-center justify-center w-6 h-6" onClick={Qdelete}>
        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/f1f2ccb1fc035948188f4f836531e5d42a5237e6f40ac2776664db8bc2dcf291?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3" alt="" className="object-contain w-6 aspect-square" />
      </button>
      <span className="px-2 w-6">{quantity}</span>
      <button aria-label="Increase quantity" className="flex items-center justify-center w-6 h-6" onClick={Qadd}>
        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/915f3ca0393bd48d11d7a48ef12c1e451fbcb5d48740c98d58a14626bf02fa52?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3" alt="" className="object-contain w-6 aspect-square" />
      </button>
    </div>
  );
}

export default QuantitySelector;