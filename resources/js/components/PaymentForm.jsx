import React from "react";
import PaymentOption from "./PaymentOption";
import InputField from "./InputField";
import MonthsOption from "./MonthsOption";
import CardBrand from "./CardBrand";

const paymentOptions = [
  { icon: "https://cdn.builder.io/api/v1/image/assets/TEMP/90a451fb172f67a1f2f20313640b2713c7f348c869df39830a745143b509979c?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3", label: "Crédito" },
  { icon: "https://cdn.builder.io/api/v1/image/assets/TEMP/f5de629ffff2fefcbc8041223087bcbad6a493c837551954e0c1e9037415f069?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3", label: "Débito" },
  { icon: "https://cdn.builder.io/api/v1/image/assets/TEMP/e1558533c181bbb8c9fdfaa42bf0a973773683208d8a09532b04fe9cbd269680?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3", label: "Transferencia" },
  { icon: "https://cdn.builder.io/api/v1/image/assets/TEMP/7ec71fd993502123b9ac4f294b2450a5dc27a32083c9d8df14a4a8348bb862ef?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3", label: "Yape / Plin" }
];

const monthsOptions = ["Un pago", "3 meses", "6 meses"];

const cardBrands = [
  "https://cdn.builder.io/api/v1/image/assets/TEMP/65f538cbc0bcd316dbd237afe484fb673cdf4eb4d175159cd436f9caa481637a?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3",
  "https://cdn.builder.io/api/v1/image/assets/TEMP/527a47c4fcfce5db664c60dd6c54a8f6b849b8af81863e6c77864ed3d9fb50c9?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3",
  "https://cdn.builder.io/api/v1/image/assets/TEMP/7f9c1ef06cea9467035bec316579474fc9274396f815d4b6fa02ea31cfeff258?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3",
  "https://cdn.builder.io/api/v1/image/assets/TEMP/2e5cb500ab79f4f930671ef002199fad0400f4c23669e9d91d74506ae045e7a3?placeholderIfAbsent=true&apiKey=b6f214df1e0f4f5eae4157d4f12e0ba3"
];

function PaymentForm() {
  return (
    <main className="flex flex-col justify-center bg-white min-w-[240px] w-[488px] max-md:max-w-full">
      <h1 className="text-3xl font-bold tracking-widest leading-none text-neutral-900">
        Tipo de pago
      </h1>
      <section className="flex flex-wrap gap-8 justify-between items-center mt-8 w-full text-sm font-bold tracking-wide text-neutral-900 text-opacity-40 max-md:max-w-full">
        {paymentOptions.map((option, index) => (
          <PaymentOption key={index} icon={option.icon} label={option.label} />
        ))}
      </section>
      <div className="flex-1 shrink gap-2 self-stretch px-6 py-4 mt-8 w-full text-sm tracking-wide leading-5 text-green-800 rounded-2xl bg-stone-200 max-md:px-5 max-md:max-w-full">
        Es posible que la información que nos proporciones sea validada por uno de nuestros agentes.
      </div>
      <form className="flex flex-col mt-8 w-full text-neutral-900 max-md:max-w-full">
        <InputField label="Nombre del titular de la tarjeta" id="cardholderName" />
        <InputField label="Número de tarjeta" id="cardNumber" />
        <div className="flex flex-wrap gap-6 items-start mt-4 w-full whitespace-nowrap max-md:max-w-full">
          <InputField label="Vencimiento" id="expiryDate" placeholder="MM/YY" halfWidth />
          <InputField label="CVV" id="cvv" placeholder="***" halfWidth />
        </div>
        <div className="flex gap-6 items-start mt-4 w-full max-md:max-w-full">
          <div className="flex flex-col flex-1 shrink w-full basis-0 min-w-[240px] max-md:max-w-full">
            <label htmlFor="monthsOptions" className="text-base font-bold tracking-wider max-md:max-w-full">
              Meses sin intereses
            </label>
            <div className="flex flex-wrap gap-4 items-start mt-4 w-full text-sm tracking-wide max-md:max-w-full">
              {monthsOptions.map((option, index) => (
                <MonthsOption key={index} label={option} isSelected={index === 0} />
              ))}
            </div>
          </div>
        </div>
      </form>
      <footer className="flex flex-col items-center py-6 mt-8 w-full max-md:max-w-full">
        <p className="text-lg font-bold tracking-wider text-neutral-900">
          1 pago de S/ 180,00
        </p>
        <p className="mt-2 text-xs tracking-wide text-neutral-900">
          Aceptamos las siguientes tarjetas de debito
        </p>
        <div className="flex gap-2 items-start mt-2">
          {cardBrands.map((brand, index) => (
            <CardBrand key={index} src={brand} />
          ))}
        </div>
      </footer>
    </main>
  );
}

export default PaymentForm;