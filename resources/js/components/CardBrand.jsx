import React from "react";

function CardBrand({ src }) {
  return (
    <img loading="lazy" src={src} alt="Card brand logo" className="object-contain shrink-0 w-10 aspect-[1.48]" />
  );
}

export default CardBrand;