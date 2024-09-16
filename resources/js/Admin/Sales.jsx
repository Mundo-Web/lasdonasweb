import React from 'react'
import CreateReactScript from '../Utils/CreateReactScript';
import { createRoot } from 'react-dom/client';
import { useEffect } from 'react';
import Table from '../components/Table';
import { useRef } from 'react';
import SalesRest from '../actions/SalesRest';
import Modal from 'react-modal';
import { useState } from 'react';
import 'sode-extend-react/sources/string';
import { renderToString } from 'react-dom/server';
import ReactAppend from '../Utils/ReactAppend';

Modal.setAppElement('#app');

const modalStyles = {
  content: {
    height: 'max-content',
    maxHeight: '95vh',
    overflowY: 'auto'
  }
}

const salesRest = new SalesRest()

const Sales = () => {

  const gridRef = useRef()

  const [modalIsOpen, setModalIsOpen] = useState(false);
  const [saleLoaded, setSaleLoaded] = useState(null);

  const openModal = (sale) => {
    setModalIsOpen(true)
    setSaleLoaded(sale)
  }
  const closeModal = () => {
    setModalIsOpen(false)
    setSaleLoaded(null)
  }

  useEffect(() => {
    document.title = 'Las doñas - Ventas'
  })

  return <>
    <Table gridRef={gridRef} rest={salesRest} exportable title='Ventas'
      toolBar={(container) => {
        container.unshift({
          widget: 'dxButton', location: 'after',
          options: {
            icon: 'refresh',
            hint: 'Refrescar tabla',
            onClick: () => $(gridRef.current).dxDataGrid('instance').refresh()
          }
        });
      }}
      columns={[
        {
          dataField: 'codigo_orden',
          caption: 'Codigo',
          cellTemplate: (container, { data }) => {
            ReactAppend(container, <>
              <p>#{data.codigo_orden}</p>
              <button className='text-blue-500' onClick={() => openModal(data)}>
                Ver pedido
                <i className='mdi mdi-arrow-top-right ms-1'></i>
              </button>
            </>)
          }
        },
        {
          dataField: 'billing_name',
          caption: 'Cliente',
          cellTemplate: (container, { data }) => {
            container.html(renderToString(<>
              <p>{data.billing_name ?? ''}</p>
              <span className='text-gray-500'>{data.billing_email}</span>
            </>))
          }
        },
        {
          dataField: 'monto',
          caption: 'Precio total',
          dataType: 'number',
          cellTemplate: (container, { data }) => {
            container.html(renderToString(<>
              <p>S/.{Number(data.monto).toFixed(2)}</p>
              <span className='text-gray-500'>
                Envío: {data.precio_envio == 0
                  ? 'Gratis'
                  : `S./${Number(data.precio_envio).toFixed(2)}`}
              </span>
            </>))
          }
        },
        {
          dataField: 'sale.created_at',
          caption: 'Fecha envío',
          dataType: 'datetime',
          format: 'yyyy-MM-dd HH:mm:ss',
          cellTemplate: (container, { data }) => {
            container.html(renderToString(<>
              <p>{moment(data.fecha_envio).format('LL')}</p>
              <div className="text-gray-500 flex gap-1">
                <span>De</span>
                <span>{moment(data.horario_envio?.start_time, 'HH:mm:ss').format('HH:mm')}</span>
                <span>a</span>
                <span>{moment(data.horario_envio?.end_time, 'HH:mm:ss').format('HH:mm')}</span>
              </div>
            </>))
          }
        },
      ]}
      customizeCell={(options) => {
        if (options?.gridCell?.rowType == 'data' && !options?.gridCell?.value) {
          if (options.gridCell.column.dataField === 'sale.address_district') {
            options.excelCell.value = '- Sin distrito -'
            options.excelCell.font = { italic: true }
          }
        } else if (options?.gridCell?.rowType == 'data' && options.gridCell.column.dataField === 'product_name') {
          options.excelCell.value = html2string(
            options.excelCell.value
              .replaceAll('</b><ul', '</b>\n<ul')
              .replaceAll('</li><li', '</li>\n<li')
          )
          options.excelCell.alignment = {
            wrapText: true
          }
        } else if (options?.gridCell?.rowType == 'data' && options.gridCell.column.dataField === 'price') {
          options.excelCell.numFmt = '0.00';
          options.excelCell.alignment = {
            horizontal: 'right'
          }
        } else if (options?.gridCell?.rowType == 'data' && options.gridCell.column.dataField === 'sale.name') {
          options.excelCell.value = `${options.gridCell.data.sale.name} ${options.gridCell.data.sale.lastname}`
        }
      }}
    />
    <Modal
      isOpen={modalIsOpen}
      onRequestClose={closeModal}
      className="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-xl"
      overlayClassName="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4"
      style={modalStyles}
    >
      <div className="space-y-6">
        <div className="flex justify-between items-center border-b pb-4">
          <h2 className="text-2xl font-bold text-gray-800">Pedido #{saleLoaded?.codigo_orden}</h2>
          <button onClick={closeModal} className="text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 className="font-semibold text-lg mb-2">Información del Cliente</h3>
            <div className="px-4 flex items-center gap-2 py-3 text-sm text-gray-900 rounded border shadow mb-2">
              <img
                className='h-10 w-10 flex-shrink-0 object-cover object-center rounded-full'
                src={`/storage/${saleLoaded?.usuario_pedido.profile_photo_path}`}
                alt={`Perfil de ${saleLoaded?.usuario_pedido.name} ${saleLoaded?.usuario_pedido.lastname || ''}`}
                onError={(e) => e.target.src = `https://ui-avatars.com/api/?name=${saleLoaded?.usuario_pedido.name}+${saleLoaded?.usuario_pedido.lastname || ''}&color=7F9CF5&background=EBF4FF`}
              />
              <div className='min-w-0 flex-1'>
                <div className="font-medium truncate">
                  {saleLoaded?.usuario_pedido.name} {saleLoaded?.usuario_pedido.lastname || ''}
                </div>
                <div className='truncate text-gray-500'>
                  {saleLoaded?.usuario_pedido.email}
                </div>
              </div>
            </div>
            <p><b>Celular</b>: {saleLoaded?.consumer_phone}</p>
          </div>

          <div>
            <h3 className="font-semibold text-lg mb-2">Detalles de Facturación</h3>
            <p><b>Documento</b>: {saleLoaded?.billing_type == 'boleta' ? 'DNI' : 'RUC'} {saleLoaded?.billing_document}</p>
            <p><b>Nombre</b>: {saleLoaded?.billing_name ?? ''}</p>
            <p><b>Dirección Fiscal</b>: {saleLoaded?.billing_address}</p>
            <p><b>Correo</b>: {saleLoaded?.billing_email}</p>
          </div>
        </div>

        <div>
          <h3 className="font-semibold text-lg mb-2">Productos</h3>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200 border rounded">
              <thead>
                <tr>
                  <th></th>
                  <th scope="col" className="px-6 py-3 text-start text-sm font-medium text-slate-800">
                    Producto
                  </th>
                  <th scope="col" className="px-6 py-3 text-center text-sm font-medium text-slate-800">
                    Precio
                  </th>
                  <th scope="col" className="px-6 py-3 text-center text-sm font-medium text-slate-800">
                    Cantidad
                  </th>
                  <th scope="col" className="px-6 py-3 text-end text-sm font-medium text-slate-800">
                    Total
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-200">
                {saleLoaded?.detalle_orden.map((item, index) => (
                  <tr key={index}>
                    <td className="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800">
                      <div className="flex flex-row items-start gap-4">
                        <img
                          className="w-10 aspect-square shadow rounded object-cover object-center"
                          src={`/${item.imagen_producto.name_imagen}`}
                          alt={item.producto.producto}
                        />
                      </div>
                    </td>
                    <td>
                      <h2 className="-mb-2">{item.producto.producto}</h2>
                      {item.points_used > 0 && (
                        <span className="text-orange-500 text-xs">Usó puntos</span>
                      )}
                    </td>
                    <td className="px-4 py-2 text-sm font-bold text-center text-gray-800">
                      {item.points_used > 0 ? (
                        <>
                          <span className="block">{item.precio}</span>
                          <span className="block text-orange-500">
                            <i className="mdi mdi-dots-hexagon me-1"></i>{item.points}
                          </span>
                        </>
                      ) : (
                        item.precio
                      )}
                    </td>
                    <td className="px-4 py-2 text-sm text-gray-800 text-center font-bold">
                      {item.points_used > 0 ? (
                        <>
                          <span className="block">
                            {item.cantidad - item.points_used / item.points}
                          </span>
                          <span className="block text-orange-500">
                            {item.points_used / item.points}
                          </span>
                        </>
                      ) : (
                        item.cantidad
                      )}
                    </td>
                    <td className="px-4 py-2 text-sm text-end font-medium text-gray-800">
                      {item.points_used > 0 ? (
                        <>
                          <span className="block">S/. {item.price_used}</span>
                          <span className="block text-orange-500">{item.points_used} puntos</span>
                        </>
                      ) : (
                        `S/. ${item.price_used}`
                      )}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 className="font-semibold text-lg mb-2">Resumen del Pedido</h3>
            <p>Subtotal: S/. {Number(saleLoaded?.monto).toFixed(2)}</p>
            <p>Costo de envío: S/. {Number(saleLoaded?.precio_envio).toFixed(2)}</p>
            <p className="font-bold">Total: S/. {(Number(saleLoaded?.monto) + Number(saleLoaded?.precio_envio)).toFixed(2)}</p>
          </div>
          <div>
            <h3 className="font-semibold text-lg mb-2">Detalles del Arreglo Floral</h3>
            {
              saleLoaded?.dedication_image &&
              <img src={`/${saleLoaded?.dedication_image}`} alt="Arreglo Floral" className="max-w-full max-h-40 object-cover rounded-md mb-2" />
            }
            <p><b>Mensaje</b>: {saleLoaded?.dedication_message || <i className='text-gray-500'>- Sin mensaje -</i>}</p>
            <p><b>De</b>: {saleLoaded?.from || <i className='text-gray-500'>- Sin de -</i>}</p>
            <p><b>Para</b>: {saleLoaded?.to || <i className='text-gray-500'>- Sin para -</i>}</p>
          </div>
        </div>

        <div>
          <h3 className="font-semibold text-lg mb-2">Ubicación de Entrega</h3>
          <p><b>Recibe</b>: {saleLoaded?.address_owner}</p>
          <p className='mb-2'><b>En</b>: {saleLoaded?.address_full}</p>

          {saleLoaded?.tipo_tarjeta == 'transferencia' && (<a className='underline pb-6' href={`/${saleLoaded?.img_transferencia}`} download={'transferencia.jpg'} target='_blank' > Img Transferencia</a>)}


          <iframe class="w-full aspect-video rounded-md "
            src={`https://www.google.com/maps/embed/v1/place?key=AIzaSyBDikLz7ELBdUFW0TnvkWkcXPK48Wc003U&q=${saleLoaded?.address_latitude},${saleLoaded?.address_longitude}&zoom=16&maptype=satellite`}
            style={{ border: 0 }} allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
          {/* <div className="relative h-60 rounded-md overflow-hidden">
            <div className="absolute top-2 left-2 bg-white p-2 rounded-full shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <img src="https://g-g3zj-tgfl57.vusercontent.net/placeholder.svg" alt="Mapa de entrega" className="w-full h-full object-cover" />
          </div> */}
        </div>
      </div>
    </Modal>
  </>
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Sales {...properties} />);
})