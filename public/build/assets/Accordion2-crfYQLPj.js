import{j as s}from"./Example-zgwdEd5i.js";import{r as n}from"./useOutsideClick-TT1qJ6UJ.js";import{a as x}from"./axios-_sX4vCAy.js";const g=({id:o,url_env:c,setDetallePedido:l})=>{const[r,d]=n.useState([]),[t,i]=n.useState(!0);if(n.useEffect(()=>{(async()=>{try{const a=await x.post("/buscaSubComplementosDetalle",{id:o});d(a.data.productos),i(!1)}catch(a){console.error("Error fetching data:",a),i(!1)}})()},[o]),t)return s.jsx("div",{children:"Loading..."});const h=e=>{l(a=>a.complementos.findIndex(u=>u===e)===-1?{...a,complementos:[...a.complementos,e]}:{...a,complementos:a.complementos.filter(u=>u!==e)})};return s.jsx("div",{className:"grid w-full gap-4 grid-cols-1 md:grid-cols-4 mt-6",children:r.map(e=>s.jsxs("div",{className:"m-auto",children:[s.jsx("label",{htmlFor:`react-option-${e.id}`,className:"inline-flex items-center justify-between w-full bg-white rounded-lg cursor-pointer",children:s.jsxs("div",{className:"block relative",children:[s.jsx("input",{type:"checkbox",id:`react-option-${e.id}`,name:"complementos[]",className:"peer absolute top-3 left-3 w-5 h-5 accent-rosalasdonas border-[#FF8555] rounded-md peer-checked:accent-[#73B473]",required:!0,onChange:()=>h(e.id)}),e.images.length>0?e.images.map(a=>a.caratula===1?s.jsx("img",{className:"size-full w-48 h-56 rounded-lg object-cover",src:a.name_imagen?`${c}/${a.name_imagen}`:"path/to/default.jpg",alt:e.producto},a.id):null):s.jsx("img",{className:"size-full w-48 h-56 rounded-lg object-cover",src:`${c}/images/img/noimagen.jpg`,alt:"No imagen"})]})}),s.jsx("h2",{className:"text-base font-normal text-black text-center",children:e.producto}),s.jsx("div",{className:"flex font-medium justify-center gap-4",children:e.descuento>0?s.jsxs(s.Fragment,{children:[s.jsxs("p",{children:["S/ ",s.jsx("span",{children:e.descuento})]}),s.jsxs("p",{className:"line-through text-gray-400",children:["S/ ",s.jsx("span",{children:e.precio})]})]}):s.jsxs(s.Fragment,{children:[s.jsx("p",{children:"S/ "}),s.jsx("span",{children:e.precio})]})})]},e.id))})},b=({datos:o,url_env:c,setDetallePedido:l})=>{const[r,d]=n.useState(null),[t,i]=n.useState([]),h=e=>{r===e?d(null):(d(e),t.includes(e)||i([...t,e]))};return s.jsx("div",{children:o.map((e,a)=>s.jsxs("div",{className:"mt-4",children:[s.jsx("h2",{id:`accordion-collapse-heading-${e.id}`,className:"gap-4 flex flex-col",children:s.jsxs("button",{className:`flex items-center justify-between w-full p-5 font-medium rounded-t-xl  dark:focus:ring-gray-800 dark:border-gray-700 dark:text-black hover:bg-gray-100 dark:hover:bg-gray-800 gap-3 ${r===a?"bg-[#FF8555] text-white":"text-black"}`,"data-accordion-target":`#accordion-collapse-body-${e.id}`,"aria-expanded":r===a,"aria-controls":`accordion-collapse-body-${e.id}`,type:"button",style:{transition:"all 500ms ease-in-out"},onClick:()=>h(a),children:[s.jsx("span",{children:e.name}),s.jsx("svg",{"data-accordion-icon":"",className:`w-3 h-3 shrink-0 ${r===a?"":"rotate-180"} stroke-[#FF8555]`,fill:"none",viewBox:"0 0 10 6",children:s.jsx("path",{stroke:"currentColor",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M9 5 5 1 1 5"})})]})}),s.jsx("div",{id:`accordion-collapse-body-${e.id}`,className:`${r===a?"":"hidden"}`,"aria-labelledby":`accordion-collapse-heading-${e.id}`,children:s.jsx("div",{className:"p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900",children:t.includes(a)&&s.jsx(g,{id:e.id,url_env:c,setDetallePedido:l})})})]},e.id))})};export{b as A};