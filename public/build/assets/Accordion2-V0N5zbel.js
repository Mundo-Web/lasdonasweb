import{j as a}from"./Example-zgwdEd5i.js";import{r as g}from"./useOutsideClick-TT1qJ6UJ.js";import{a as p}from"./axios-_sX4vCAy.js";import{s as m}from"./storage-zp2nPsZU.js";const x=async i=>{try{const n=await p.post("/api/products/addComplemento",{id:i});if(n.status===200){const{data:l}=n.data;let s=l.map(r=>{var e;return{id:r.id,producto:r.producto,precio:r.descuento>0?r.descuento:r.precio,imagen:((e=r.images.filter(t=>t.caratula===1)[0])==null?void 0:e.name_imagen)??"/images/img/noimagen.jpg",cantidad:1,sku:r.sku,tipo:"Complemento",fecha:"",horario:"",extract:r.extract}}),o=m.Local.get("carrito")??[];o.some(r=>r.id===s[0].id)?o=o.map(r=>r.id===s[0].id?{...r,cantidad:r.cantidad+Number(s[0].cantidad)}:r):o=[...o,s[0]],m.Local.set("carrito",o);const c=$("#gift-icon");c.addClass("send-to-cart"),setTimeout(()=>{c.removeClass("send-to-cart"),c.removeAttr("style"),limpiarHTML(),PintarCarrito(),$(cartButton).addClass("shake"),setTimeout(function(){$(cartButton).removeClass("shake")},1e3)},1e3)}}catch(n){console.error(n),Swal.fire({icon:"error",title:"Error",text:"Hubo un error al agregar el pedido. Por favor, inténtelo de nuevo."})}},f=({id:i,url_env:n,setDetallePedido:l})=>{const[s,o]=g.useState([]),[d,c]=g.useState(!0);if(g.useEffect(()=>{(async()=>{try{const t=await p.post("/buscaSubComplementosDetalle",{id:i});o(t.data.productos),c(!1)}catch(t){console.error("Error fetching data:",t),c(!1)}})()},[i]),d)return a.jsx("div",{children:"Loading..."});const r=e=>{console.log(e),(Local.get("carrito")??[]).length>0?(console.log("entra porque tiene algo "),x(e)):l(u=>u.complementos.findIndex(h=>h===e)===-1?{...u,complementos:[...u.complementos,e]}:{...u,complementos:u.complementos.filter(h=>h!==e)})};return a.jsx("div",{className:"grid w-full gap-4 grid-cols-1 md:grid-cols-4 mt-6",children:s.map(e=>a.jsxs("div",{className:"m-auto",children:[a.jsx("label",{htmlFor:`react-option-${e.id}`,className:"inline-flex items-center justify-between w-full bg-white rounded-lg cursor-pointer",children:a.jsxs("div",{className:"block relative",children:[a.jsx("input",{type:"checkbox",id:`react-option-${e.id}`,name:"complementos[]",className:"peer absolute top-3 left-3 w-5 h-5 accent-rosalasdonas border-[#FF8555] rounded-md peer-checked:accent-[#73B473]",required:!0,onChange:()=>r(e.id)}),e.images.length>0?e.images.map(t=>t.caratula===1?a.jsx("img",{className:"size-full w-48 h-56 rounded-lg object-cover",src:t.name_imagen?`${n}/${t.name_imagen}`:"path/to/default.jpg",alt:e.producto},t.id):null):a.jsx("img",{className:"size-full w-48 h-56 rounded-lg object-cover",src:`${n}/images/img/noimagen.jpg`,alt:"No imagen"})]})}),a.jsx("h2",{className:"text-base font-normal text-black text-center",children:e.producto}),a.jsx("div",{className:"flex font-medium justify-center gap-4",children:e.descuento>0?a.jsxs(a.Fragment,{children:[a.jsxs("p",{children:["S/ ",a.jsx("span",{children:e.descuento})]}),a.jsxs("p",{className:"line-through text-gray-400",children:["S/ ",a.jsx("span",{children:e.precio})]})]}):a.jsxs(a.Fragment,{children:[a.jsx("p",{children:"S/ "}),a.jsx("span",{children:e.precio})]})})]},e.id))})},v=({datos:i,url_env:n,setDetallePedido:l})=>{const[s,o]=g.useState(null),[d,c]=g.useState([]),r=e=>{s===e?o(null):(o(e),d.includes(e)||c([...d,e]))};return a.jsx("div",{children:i.map((e,t)=>a.jsxs("div",{className:"mt-3",children:[a.jsx("h2",{id:`accordion-collapse-heading-${e.id}`,className:"gap-4 flex flex-col",children:a.jsxs("button",{className:`flex items-center justify-between w-full p-5 font-medium rounded-t-xl  dark:focus:ring-gray-800 dark:border-gray-700 dark:text-black hover:bg-gray-100 bg-[#F8F8F8] dark:hover:bg-gray-800 gap-3 ${s===t?"bg-[#FF8555] text-white":"text-black"}`,"data-accordion-target":`#accordion-collapse-body-${e.id}`,"aria-expanded":s===t,"aria-controls":`accordion-collapse-body-${e.id}`,type:"button",style:{transition:"all 500ms ease-in-out"},onClick:()=>r(t),children:[a.jsx("span",{children:e.name}),a.jsx("svg",{"data-accordion-icon":"",className:`w-3 h-3 shrink-0 ${s===t?"stroke-[#FF8555]":"rotate-180 text-[#FF8555]"} `,fill:"none",viewBox:"0 0 10 6",children:a.jsx("path",{stroke:"currentColor",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M9 5 5 1 1 5"})})]})}),a.jsx("div",{id:`accordion-collapse-body-${e.id}`,className:`${s===t?"":"hidden"}`,"aria-labelledby":`accordion-collapse-heading-${e.id}`,children:a.jsx("div",{className:"p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900",children:d.includes(t)&&a.jsx(f,{id:e.id,url_env:n,setDetallePedido:l})})})]},e.id))})};export{v as A,x as a};