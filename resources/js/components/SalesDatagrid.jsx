import React, { useEffect, useState } from 'react';
import DataGrid, { Column, Paging, Pager, Scrolling, Toolbar, Item } from 'devextreme-react/data-grid';
import 'devextreme/dist/css/dx.light.css';
import 'jquery-modal/jquery.modal.css';
import 'jquery-modal/jquery.modal';
import moment from 'moment';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import Cookies from 'js-cookie';
import Modal from 'react-modal';
import InvoiceModal from './InvoiceModal';

const SalesDataGrid = ({ isAdmin, statuses }) => {
  const [dataSource, setDataSource] = useState([]);
  const [modalIsOpen, setModalIsOpen] = useState(false);
  const [selectedSale, setSelectedSale] = useState(null);

  const formattedTime = (timeString) => {



    const [hours, minutes, seconds] = timeString.split(':');
    const date = new Date();
    date.setHours(hours, minutes, seconds);

    // Verificar si la hora es válida
    if (isNaN(date.getTime())) {
      return 'Not Set';
    }

    // Formatear la hora
    const options = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
    const formattedTime = new Intl.DateTimeFormat('es-ES', options).format(date);

    // Capitalizar la hora formateada
    const capitalizedTime = formattedTime.charAt(0).toUpperCase() + formattedTime.slice(1);

    return capitalizedTime;
  }


  useEffect(() => {
    const loadData = async () => {
      const res = await fetch(`${isAdmin ? '/api/sales/paginate' : '/api/sales/paginate?data=mine'}`, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'XSRF-TOKEN': decodeURIComponent(Cookies.get('XSRF-TOKEN'))
        },
        body: JSON.stringify({
          _token: document.querySelector('[name="_token"]').value
        })
      });
      const data = await res.json();

      setDataSource(data.data);
    };

    loadData();
  }, [isAdmin]);

  const openSaleModal = (sale) => {
    setSelectedSale(sale);
    setModalIsOpen(true);
  };

  const closeSaleModal = () => {
    setModalIsOpen(false);
    setSelectedSale(null);
  };

  const onToolbarPreparing = (e) => {
    e.toolbarOptions.items.unshift({
      widget: 'dxButton',
      location: 'after',
      options: {
        icon: 'revert',
        hint: 'REFRESCAR TABLA',
        onClick: () => {
          e.component.refresh();
        }
      }
    });
  };

  const renderDateCell = (data) => {
    return (
      <div className="!px-3 !py-2">
        {data.fechaenvio ? <> {moment(data.fechaenvio).format('YYYY-MM-DD ')} {formattedTime(data?.horario_envio?.start_time)} - {formattedTime(data?.horario_envio?.end_time)}   </> : 'Sin fecha'}
      </div>
    );
  }
  const renderOrderCell = (data) => {
    return (
      <div className="!px-3 !py-2">
        <a
          className="block text-sm font-medium truncate dark:text-white text-blue-500 cursor-pointer max-w-max"
          onClick={() => openSaleModal(data)}
        >
          #{data.codigo_orden}
          {data.confirmation_client && (
            <span
              className="ms-1 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-green-900 dark:text-green-300 w-max"
              title="El cliente confirmo la recepcion del producto"
              data-tippy
            >
              <i className="fa fa-solid fa-user-check"></i>
            </span>
          )}
          {data.confirmation_user && (
            <span
              className="ms-1 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-green-900 dark:text-green-300 w-max"
              title="El vendedor confirmo la entrega del producto"
              data-tippy
            >
              <i className="fa fa-solid fa-check-to-slot"></i>
            </span>
          )}
        </a>
        <p className="text-sm text-gray-500 dark:text-gray-400">
          {data.address_full
            ? `${data.address_full}`
            : 'Recojo en tienda'}
        </p>
        <p className="text-xs text-gray-400">
          {isAdmin && <span className="me-1 text-gray-800">{data.name} {data.lastname}</span>}
          {moment(data.created_at).format('YYYY-MM-DD HH:mm:ss')}
        </p>
      </div>
    );
  };

  const renderStatusCell = (data) => {
    const color = data.status_ordenes?.color ?? '#000000';

    return (
      <div className="!px-3 !py-2 !text-center flex items-center justify-center content-center" style={{ verticalAlign: 'middle' }}>
        <span
          className={`inline-flex items-center bg-[${color}77] text-[${color}30] text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-[${color}22] dark:text-[${color}bb] w-max`}
        >
          {data.status_ordenes?.name ?? 'Sin estado'}
        </span>
      </div>
    );
  };

  const renderTotalCell = (data) => {
    const isFree = !Boolean(Number(data.precio_envio));
    return (
      <div className="!px-3 !py-2 !text-center" style={{ verticalAlign: 'middle' }}>
        <div className="text-center">
          <span className="block w-max mx-auto">S/. {data.monto}</span>
          <span
            className={`inline-flex items-center ${isFree ? 'bg-green-100' : 'bg-blue-100'} ${isFree ? 'text-green-800' : 'text-blue-800'} text-xs font-medium px-2.5 py-0.5 rounded-full dark:${isFree ? 'bg-green-900' : 'bg-blue-900'} dark:${isFree ? 'text-green-300' : 'text-blue-300'} w-max`}
          >
            <span className={`w-2 h-2 me-1 ${isFree ? 'bg-green-500' : 'bg-blue-500'} rounded-full`}></span>
            {isFree ? 'Envio gratis' : `S/. ${Number(data.precio_envio).toFixed(2)}`}
          </span>
        </div>
      </div>
    );
  };

  return (

    <>
      <DataGrid
        dataSource={dataSource}
        onToolbarPreparing={onToolbarPreparing}
        remoteOperations={true}
        columnResizingMode="widget"
        allowColumnResizing={true}
        allowColumnReordering={true}
        columnAutoWidth={true}
        rowAlternationEnabled={true}
        showBorders={true}
        paging={{ pageSize: 5 }}
        pager={{
          visible: true,
          allowedPageSizes: [5, 10, 25, 50, 100],
          showPageSizeSelector: true,
          showInfo: true,
          showNavigationButtons: true,
        }}
        scrolling={{
          mode: 'standard',
          useNative: true,
          preloadEnabled: true,
          rowRenderingMode: 'standard'
        }}
        onContentReady={() => {
          tippy('[data-tippy]', {
            arrow: true,
            animation: 'scale'
          });
        }}
      >
        <Column dataField="created_at" caption="ORDEN" cellRender={({ data }) => renderOrderCell(data)} />
        <Column dataField="fechaenvio" caption="FECHA DEL ENVIO" cellRender={({ data }) => renderDateCell(data)} />

        <Column dataField="status.name" caption="ESTADO" cellRender={({ data }) => renderStatusCell(data)} />
        <Column dataField="total" caption="MONTO" cellRender={({ data }) => renderTotalCell(data)} />
        <Toolbar>
          <Item name="refreshButton" />
        </Toolbar>
      </DataGrid>

      {/* <Modal
        isOpen={modalIsOpen}
        onRequestClose={closeSaleModal}
        contentLabel="Detalles de la Venta"
        ariaHideApp={false}
        style={{
          content: {
            width: '500px',
            height: '200px',
            // margin: 'auto',
            padding: '20px',
            borderRadius: '10px',
            boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)'
          }
        }}
      >
        {selectedSale && (
          <div>
            <button
              onClick={closeSaleModal}
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
            <h2>Detalles de la Venta #{selectedSale.code}</h2>
            <p>Cliente: {selectedSale.name} {selectedSale.lastname}</p>
            <p>Dirección: {selectedSale.address_description ? `${selectedSale.address_department}, ${selectedSale.address_province}, ${selectedSale.address_district} - ${selectedSale.address_street} #${selectedSale.address_number}` : 'Recojo en tienda'}</p>
            <p>Fecha: {moment(selectedSale.created_at).format('YYYY-MM-DD HH:mm:ss')}</p>
            <p>Total: S/. {selectedSale.total}</p>
          </div>
        )}
      </Modal> */}

      <InvoiceModal
        isOpen={modalIsOpen}
        onRequestClose={closeSaleModal}
        data={selectedSale}
        isAdmin={isAdmin}
        statuses={statuses}
      />
    </>



  );
};

export default SalesDataGrid;