import React, { useState, useEffect } from 'react';
import Modal from 'react-modal';
import Cookies from 'js-cookie';
import moment from 'moment';
import axios from 'axios';

const InvoiceModal = ({ isOpen, onRequestClose, data, isAdmin, statuses }) => {
  const [invoiceData, setInvoiceData] = useState(null);

  useEffect(() => {
    if (data) {
      setInvoiceData(data);
    }
  }, [data]);

  const fetchSaleDetails = async (id) => {
    try {
      const res = await axios.get(`/api/saledetails/${id}`);
      const saleDetails = res.data;
      setInvoiceData((prevData) => ({
        ...prevData,
        products: saleDetails
      }));
    } catch (error) {
      console.error('Error fetching sale details:', error);
    }
  };

  useEffect(() => {
    if (invoiceData) {
      fetchSaleDetails(invoiceData.id);
    }
  }, [isOpen]);

  const handleStatusChange = async (e) => {
    const status_id = e.target.value;
    const res = await fetch("{{ route('sales.status') }}", {
      method: 'PATCH',
      headers: {
        'Content-type': 'application/json',
        'XSRF-TOKEN': decodeURIComponent(Cookies.get('XSRF-TOKEN'))
      },
      body: JSON.stringify({
        _token: document.querySelector('[name="_token"]').value,
        id: invoiceData.id,
        status_id
      })
    });
    if (res.ok) {
      // Refresh data or handle success
    }
  };

  const handleConfirmationChange = async (e) => {
    const field = e.target.value;
    const checked = e.target.checked;
    if (!checked) return;

    const isConfirmed = window.confirm(field === 'client' ? 'Marcalo cuando hayas recibido los productos' : 'Marcalo cuando hayas entregado los productos al cliente');
    if (!isConfirmed) return e.preventDefault();

    const res = await fetch("{{ route('sales.confirmation') }}", {
      method: 'POST',
      headers: {
        'Content-type': 'application/json',
        'XSRF-TOKEN': decodeURIComponent(Cookies.get('XSRF-TOKEN'))
      },
      body: JSON.stringify({
        _token: document.querySelector('[name="_token"]').value,
        id: invoiceData.id,
        field
      })
    });

    if (res.ok) {
      setInvoiceData((prevData) => ({
        ...prevData,
        [field === 'client' ? 'confirmation_client' : 'confirmation_user']: true
      }));
    }
  };

  return (
    <Modal
      isOpen={isOpen}
      onRequestClose={onRequestClose}
      contentLabel="Detalles de la Venta"
      ariaHideApp={false}
      style={{
        content: {
          width: '720px',
          height: '531px',
          padding: '20px',
          borderRadius: '10px',
          boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
          position: 'absolute',
          top: '50%',
          left: '50%',
          transform: 'translate(-50%, -50%)',
          zIndex: '9999'
        }
      }}
    >
      {invoiceData && (
        <div>
          <button
            onClick={onRequestClose}
            style={{
              position: 'absolute',
              top: '10px',
              right: '10px',
              background: 'transparent',
              border: 'none',
              fontSize: '16px',
              cursor: 'pointer'
            }}
          >
            &times;
          </button>
          <div className="relative md:absolute border rounded-lg right-8 top-6 py-2 px-3 mb-2 text-center">
            {/* <b className="block">{invoiceData.tipo_comprobante.toUpperCase()}</b> */}
            <b className="block">{invoiceData.tipo_comprobante ?? ''}</b>
            <b className="block">{invoiceData.doc_number}</b>
            <h4 className="h4 mb-1">S/. {Number(invoiceData.total) + Number(invoiceData.address_price)}</h4>
          </div>
          <h4 className="h4 mb-2 mt-2">Orden #{invoiceData.code}</h4>
          <p className="font-bold mb-2">{invoiceData.name} {invoiceData.lastname}</p>
          <span>Direccion Envio:</span>
          <p className="text-gray-700 mb-2">{invoiceData.address_description ? `${invoiceData.address_department}, ${invoiceData.address_province}, ${invoiceData.address_district} - ${invoiceData.address_street} #${invoiceData.address_number}` : 'Recojo en tienda'}</p>

          <p className="font-bold"> Datos Facturacion: </p>
          <p>
            <span>Nombre / Razon Social: </span>
            <span>{invoiceData.razon_fact}</span>
          </p>
          <p className="mb-2">
            <span> Direccion Fiscal:</span>
            <span>{invoiceData.direccion_fact}</span>
          </p>

          {isAdmin ? (
            <div className="mb-2 flex gap-2 items-center">
              <span>Estado:</span>
              <select name="status_id" value={invoiceData.status?.id ?? ''} onChange={handleStatusChange} className="rounded-md px-3 py-1">
                {statuses.map((status) => (
                  <option key={status.id} value={status.id}>{status.name}</option>
                ))}
              </select>
            </div>
          ) : (
            <p className="mb-2">Estado: <span className="font-bold">{invoiceData.status?.name ?? 'Sin estado'}</span></p>
          )}

          <div className="flex gap-4">
            <label className="inline-flex items-center cursor-pointer">
              <input id="confirmation_client" name="invoice-confirmation" type="checkbox" value="client" checked={invoiceData.confirmation_client} onChange={handleConfirmationChange} className="sr-only peer" disabled={isAdmin} />
              <div className="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
              <span className="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                {isAdmin ? 'Conformidad del cliente' : 'Marcar conformidad'}
              </span>
            </label>
            <label className="inline-flex items-center cursor-pointer">
              <input id="confirmation_user" name="invoice-confirmation" type="checkbox" value="user" checked={invoiceData.confirmation_user} onChange={handleConfirmationChange} className="sr-only peer" disabled={!isAdmin} />
              <div className="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
              <span className="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                {isAdmin ? 'Marcar como entregado' : 'Productos entregados'}
              </span>
            </label>
          </div>
          <hr className="my-4" />

          <div className="relative overflow-x-auto mb-4">
            <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
              <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr className="border-b">
                  <th scope="col" className="px-6 py-3">Producto</th>
                  <th scope="col" className="px-6 py-3">P. Unit.</th>
                  <th scope="col" className="px-6 py-3">Cant.</th>
                  <th scope="col" className="px-6 py-3">P. total</th>
                </tr>
              </thead>
              <tbody>
                {invoiceData.products ? (
                  invoiceData.products.length > 0 ? (
                    invoiceData.products.map((item, index) => (
                      <tr key={index} className="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{item.product_name}</th>
                        <td className="px-6 py-4">S/. {Number(item.price).toFixed(2)}</td>
                        <td className="px-6 py-4">{item.quantity}</td>
                        <td className="px-6 py-4">S/. {(item.price * item.quantity).toFixed(2)}</td>
                      </tr>
                    ))
                  ) : (
                    <tr className="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                      <th colSpan="4" scope="row" className="px-6 py-4 font-normal whitespace-nowrap dark:text-white text-center">
                        <i className="text-gray-500">- No hay productos -</i>
                      </th>
                    </tr>
                  )
                ) : (
                  <tr className="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <th colSpan="4" scope="row" className="px-6 py-4 font-normal whitespace-nowrap dark:text-white text-center">
                      <i className="text-gray-500">- Cargando productos -</i>
                    </th>
                  </tr>
                )}
                {invoiceData.address_price && (
                  <tr className="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Envio</th>
                    <td className="px-6 py-4">S/. {invoiceData.address_price}</td>
                    <td className="px-6 py-4">1</td>
                    <td className="px-6 py-4">S/. {invoiceData.address_price}</td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
      )}
    </Modal>
  );
};

export default InvoiceModal;