import React from "react";

function MessageField({ defaultMessage, data }) {
  console.log(data);
  return (
    <div className="flex flex-wrap gap-10 justify-between items-center px-6 py-4 mt-6 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 text-neutral-900 max-md:px-5 max-md:max-w-full">
      <select className="self-stretch my-auto border border-orange-400 rounded-md p-2">
        <option value="">{defaultMessage}</option>
        {data && data.map((item) => (
          <option key={item.id} value={item.id}>
            {item.mensaje}
          </option>
        ))}
      </select>
      <img
        loading="lazy"
        src="https://cdn.builder.io/api/v1/image/assets/TEMP/caa6fdd64e3a471bad6ab4cd3ead61034da6a83fd41d47fd5a67d49c1a37d632?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
        alt=""
        className="object-contain shrink-0 self-stretch my-auto w-6 aspect-square"
      />
    </div>
  );
}

export default MessageField;