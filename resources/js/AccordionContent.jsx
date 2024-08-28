import React, { useState, useEffect } from 'react';
import axios from 'axios';
import agregarComplementoPedido from './Utils/agregarComplemento';



const AccordionContent = ({ id, setDetallePedido }) => {
  const [complementos, setComplementos] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchComplementos = async () => {
      try {
        const response = await axios.post("/buscaSubComplementosDetalle", { id });
        setComplementos(response.data.productos);
        setLoading(false);
      } catch (error) {
        console.error("Error fetching data:", error);
        setLoading(false);
      }
    };

    fetchComplementos();
  }, [id]);

  if (loading) {
    return <div>Loading...</div>;
  }
  const handleCheckboxChange = (id) => {

    console.log(id);


    let carrito = Local.get('carrito') ?? [];
    if (carrito.length > 0) {

      console.log('entra porque tiene algo ')

      agregarComplementoPedido(id)

    } else {
      setDetallePedido((prev) => {
        const index = prev.complementos.findIndex((complemento) => complemento === id);
        if (index === -1) {
          return {
            ...prev,
            complementos: [...prev.complementos, id],
          };
        }
        return {
          ...prev,
          complementos: prev.complementos.filter((complemento) => complemento !== id),
        };
      });
    }
  }

  return (
    <div className="grid w-full gap-4 grid-cols-1 md:grid-cols-4 mt-6">
      {complementos.map((complemento) => (

        <div key={complemento.id} className="m-auto">
          <label
            htmlFor={`react-option-${complemento.id}`}
            className="inline-flex items-center justify-between w-full bg-white rounded-lg cursor-pointer"
          >
            <div className="block relative">
              <input
                type="checkbox"
                id={`react-option-${complemento.id}`}
                name="complementos[]"
                className="peer absolute top-3 left-3 w-5 h-5 accent-rosalasdonas border-[#FF8555] rounded-md peer-checked:accent-[#73B473]"
                required
                onChange={() => handleCheckboxChange(complemento.id)}
              />
              {complemento.images.length > 0 ? (
                complemento.images.map((image) =>
                  image.caratula === 1 ? (
                    <img
                      key={image.id}
                      className="size-full w-48 h-56 rounded-lg object-cover"
                      src={image.name_imagen ? `/${image.name_imagen}` : 'path/to/default.jpg'}
                      alt={complemento.producto}
                    />
                  ) : null
                )
              ) : (
                <img
                  className="size-full w-48 h-56 rounded-lg object-cover"
                  src={`/images/img/noimagen.jpg`}
                  alt="No imagen"
                />
              )}
            </div>
          </label>
          <h2 className="text-base font-normal text-black text-center">{complemento.producto}</h2>
          <div className="flex font-medium justify-center gap-4">
            {complemento.descuento > 0 ? (
              <>
                <p>S/ <span>{complemento.descuento}</span></p>

                <p className='line-through text-gray-400'>S/ <span >{complemento.precio}</span></p>

              </>
            ) : (
              <>

                <p>S/ </p>
                <span>{complemento.precio}</span>
              </>
            )}

          </div>
        </div>
      ))}
    </div>
  );
};

export default AccordionContent;