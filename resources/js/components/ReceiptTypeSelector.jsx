function ReceiptTypeSelector() {
  return (
    <div className="flex flex-wrap gap-8 items-center mt-8 w-full text-sm font-bold tracking-wide whitespace-nowrap max-md:max-w-full">
      <label className="flex gap-1 items-center self-stretch my-auto text-neutral-900 text-opacity-60">
        <input
          type="radio"
          name="receiptType"
          value="boleta"
          className="hover:text-orange-400 hover:border-orange-400 focus:ring-0 focus:ring-offset-0 focus:outline-none checked:bg-orange-400 checked:border-orange-400"
        />
        <span className="self-stretch my-auto">Boleta</span>
      </label>
      <label className="flex gap-1 items-center self-stretch my-auto text-neutral-900">
        <input
          type="radio"
          name="receiptType"
          value="factura"
          className="hover:text-orange-400 hover:border-orange-400 focus:ring-0 focus:ring-offset-0 focus:outline-none checked:bg-orange-400 checked:border-orange-400"
        />
        <span className="self-stretch my-auto">Factura</span>
      </label>
    </div>
  );
}

export default ReceiptTypeSelector;