import React from "react";

function SignatureField() {
  return (
    <div className="flex flex-col mt-6 w-full max-md:max-w-full">
      <label htmlFor="signature" className="text-xs tracking-wide text-neutral-900">
        Firma
      </label>
      <input
        id="signature"
        type="text"
        placeholder="Persona que firma el mensaje de la tarjeta"
        className="flex-1 shrink gap-2 self-stretch px-6 py-4 mt-2 w-full text-sm tracking-wide rounded-3xl border border-solid border-stone-300 text-stone-300 max-md:px-5 max-md:max-w-full"
      />
    </div>
  );
}

export default SignatureField;