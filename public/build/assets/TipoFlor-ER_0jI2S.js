import{j as t}from"./Example-zgwdEd5i.js";import{c as ce}from"./ReactAppend-mx8-aehl.js";import{r as o}from"./useOutsideClick-TT1qJ6UJ.js";import{C as de}from"./CreateReactScript-VVPwJ0HX.js";import{C as pe}from"./Card-eNbsL1sp.js";import{a as me}from"./axios-_sX4vCAy.js";/* empty css             */import"./index-XJuWVQ-l.js";import{P as ue}from"./ProductCard-MWC-_EEA.js";import{m as fe}from"./main-Vi8adC25.js";import"./index-38suPYpT.js";import"./_commonjsHelpers-4gQjN7DL.js";import"./CreateReactScript-scAdndyK.js";/* empty css              */import"./storage-zp2nPsZU.js";const xe=({categorias:z,selected_category:b,categoria:g,url_env:p,beneficios:M,tipoFloresList:m})=>{const c=fe.GET.tipo_flor,w=12;let y=new AbortController;const[$,I]=o.useState([]),[r,C]=o.useState(c?{tipoFlor:[c]}:{}),[ge,Q]=o.useState(0),[u,N]=o.useState(1),[X,V]=o.useState("Cargar mas productos"),[h,A]=o.useState(""),[Y,Z]=o.useState(!0),[F,v]=o.useState(!1),[q,D]=o.useState(""),[he,ee]=o.useState(g?g.name:""),[L,B]=o.useState(c?m.find(e=>e.id==c).name:""),[je,te]=o.useState(!1),[f,x]=o.useState({categories:b?[{id:`${g.id}`,name:g.name}]:[],priceOrder:"",tipoFlor:c?[{id:c,name:m.find(e=>e.id==c).name}]:[]}),[_,S]=o.useState(c?m.find(e=>e.id==c):{}),[P,k]=o.useState(!1),O=o.useRef({});o.useRef({});const H=o.useRef({}),se=()=>{k(!P)};o.useState(!1),o.useRef(!1);const re=(e=[],s)=>{const i=[];return e.forEach((a,j)=>{j==0?i.push(a):i.push(s,a)}),i},oe=()=>{v(!F)};function ie(e){const s=e?`/catalogo/${e}`:"/catalogo";window.history.pushState(null,"",s)}const U=o.useRef(null),E=o.useRef(null),R=o.useRef(null),G=e=>{U.current&&!U.current.contains(e.target)&&te(!1),E.current&&!E.current.contains(e.target)&&k(!1),R.current&&!R.current.contains(e.target)&&v(!1)};o.useEffect(()=>(document.addEventListener("mousedown",G),()=>{document.removeEventListener("mousedown",G)}),[]);const le=e=>{k(!P);const s=e.target.id,i=H.current[s].querySelector("span").textContent;S(m.find(a=>a.id==s)),B(i),!f.tipoFlor.find(a=>a.id==s)&&(x(a=>({...a,tipoFlor:[{id:s,name:i}]})),C(a=>({...a,tipoFlor:[s]})))};o.useEffect(()=>{N(1),T()},[r]),o.useEffect(()=>{T()},[u]);const J=e=>{v(!F);let s=e.target.id,i=O.current[s].querySelector("span").textContent;D(i),A(a=>e.target.value),x(a=>({...a,priceOrder:e.target.value}))};o.useEffect(()=>{N(1),T()},[h]);const ae=e=>{ee("Ocasiones"),ie(null),S({}),x(s=>({...s,categories:s.categories.filter(i=>i.id!==e)})),C(s=>({...r,category_id:r.category_id.filter(i=>i!==e)}))},W=()=>{D("Ordenar por"),x(e=>({...e,priceOrder:""})),A("")},ne=()=>{S({}),B("Tipo de Flor"),x(e=>({...e,tipoFlor:[]})),C(e=>({...r,tipoFlor:[]}))},T=async()=>{y.abort("some"),y=new AbortController;let e=y.signal;V("Cargando ...");const s=[];let i=[];if(h&&(h==="price_high"?i.push({selector:"products.preciofiltro",desc:!0}):h==="price_low"?i.push({selector:"products.preciofiltro",desc:!1}):i.push({selector:"products.created_at",desc:!0})),(r.maxPrice||r.minPrice)&&(r.maxPrice&&r.minPrice?s.push([[["preciofiltro",">=",r.minPrice]],"and",[["preciofiltro","<=",r.maxPrice]]]):r.minPrice?s.push([["precio",">=",r.minPrice],"or",["descuento",">=",r.minPrice]]):r.maxPrice&&s.push([["precio","<=",r.maxPrice],"or",["descuento","<=",r.maxPrice]])),r.collections&&r.collections.length>0){const l=[];r.collections.forEach((n,d)=>{d===0?l.push(["collection_id","=",n]):l.push("or",["collection_id","=",n])}),s.push(l)}if(r.sizes&&r.sizes.length>0){const l=[];r.sizes.forEach((n,d)=>{d===0?l.push(["combinaciones.talla_id","=",n]):l.push("or",["combinaciones.talla_id","=",n])}),s.push(l)}if(r.colors&&r.colors.length>0){const l=[];r.colors.forEach((n,d)=>{d===0?l.push(["combinaciones.color_id","=",n]):l.push("or",["combinaciones.color_id","=",n])}),s.push(l)}if(r.tipoFlor&&r.tipoFlor.length>0){const l=[];r.tipoFlor.forEach((n,d)=>{d===0?l.push(["tipo_flor_id","=",n]):l.push("or",["tipo_flor_id","=",n])}),s.push(l)}if(r.category_id&&r.category_id.length>0){const l=[];r.category_id.forEach((n,d)=>{d===0?l.push(["categoria_id","=",n]):l.push("or",["categoria_id","=",n])}),s.push(l)}const a=await me.post("/api/products/paginate",{requireTotalCount:!0,filter:re([...s,["products.visible","=",!0]],"and"),take:w,skip:w*(u-1),sort:i},{headers:{"Content-Type":"application/json"},signal:e}),{data:j,totalCount:K}=a.data;u==1?I(j??[]):I([...$,...j]),V("Cargar más modelos"),Q(K??0),w*u>=K&&Z(!1)};return t.jsx(t.Fragment,{children:t.jsx("section",{className:"mb-24",children:t.jsxs("div",{className:"mt-14 px-[5%] lg:px-[8%] font-b_slick_bold",children:[t.jsxs("div",{className:"flex flex-col gap-3",children:[t.jsxs("div",{className:"text-[#FE4A11] text-base tracking-normal uppercase",children:[" ",`Inicio / ${_.name??"Todas las Flores"} `]}),t.jsx("div",{className:"text-3xl lg:text-5xl font-bold text-[#112212] uppercase tracking-wider",children:_.name}),t.jsx("div",{className:"text-[#112212] opacity-80 font-b_slick_regular text-lg",children:_.description})]}),t.jsxs("div",{className:"grid grid-cols-1 md:grid-cols-4 mt-4 lg:mt-12 gap-4 lg:gap-10",children:[t.jsxs("div",{className:"dropdown w-full",ref:E,children:[t.jsx("div",{className:"input-box focus:outline-none font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-6 bg-[#F5F5F5]",onClick:se,children:L||"Tipo de Flor"}),P&&t.jsx("div",{className:"list z-[100] animate-fade-down animate-duration-[2000ms] overflow-y-auto",style:{maxHeight:"150px",boxShadow:"rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px"},children:m.map((e,s)=>t.jsxs("div",{className:"w-full",children:[t.jsx("input",{type:"radio",name:"drop1",id:e.id,className:"radio",value:"price_high",onChange:le}),t.jsx("label",{ref:i=>H.current[e.id]=i,htmlFor:e.id,className:"font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar",children:t.jsx("span",{className:"name inline-block w-full",children:e.name})})]},s))})]}),t.jsxs("div",{className:"dropdown w-full",ref:R,children:[t.jsx("div",{className:"input-box focus:outline-none font-bold text-text16 md:text-text20 mr-20 shadow-md px-4 py-6 bg-[#F5F5F5]",onClick:oe,children:q||"Ordenar por"}),F&&t.jsxs("div",{className:"list z-[100] animate-fade-down animate-duration-[2000ms]",style:{maxHeight:"150px",boxShadow:"rgba(0, 0, 0, 0.15) 0px 1px 2px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 1px"},children:[t.jsxs("div",{className:"w-full",children:[t.jsx("input",{type:"radio",name:"drop1",id:"id11",className:"radio",value:"price_high",onChange:J}),t.jsx("label",{ref:e=>O.current.id11=e,htmlFor:"id11",className:"font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar",children:t.jsx("span",{className:"name inline-block w-full",children:"Precio más alto"})})]}),t.jsxs("div",{className:"w-full",children:[t.jsx("input",{type:"radio",name:"drop1",id:"id12",className:"radio",value:"price_low",onChange:J}),t.jsx("label",{ref:e=>O.current.id12=e,htmlFor:"id12",className:"font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar",children:t.jsx("span",{className:"name inline-block w-full",children:"Precio más bajo"})})]})]})]})]}),t.jsxs("div",{className:"flex flex-wrap gap-4 mt-7",children:[f.categories.map((e,s)=>t.jsxs("div",{className:"cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2",onClick:()=>ae(`${e.id}`),children:["Categoria - ",e.name,t.jsx("img",{src:`${p}/img_donas/x.png`,type:"icon",alt:"",className:"pl-2  flex items-center justify-center"})]})),f.priceOrder&&(f.priceOrder==="price_high"?t.jsxs("div",{className:"cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2",onClick:W,children:["Orden - Ascendente",t.jsx("img",{src:`${p}/img_donas/x.png`,type:"icon",alt:"",className:"pl-2  flex items-center justify-center"})]}):t.jsxs("div",{className:"cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2",onClick:W,children:["Orden - Descendente",t.jsx("img",{src:`${p}/img_donas/x.png`,type:"icon",alt:"",className:"pl-2  flex items-center justify-center"})]})),f.tipoFlor.map((e,s)=>t.jsxs("div",{className:"cursor-pointer text-[#112212] text-sm rounded-xl shadow-lg flex flex-row items-center justify-center px-4 py-2",onClick:ne,children:["Tipo de Flor - ",e.name,t.jsx("img",{src:`${p}/img_donas/x.png`,type:"icon",alt:"",className:"pl-2  flex items-center justify-center"})]}))]}),t.jsx("div",{className:"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-16",children:$.map((e,s)=>t.jsx(ue,{...e},`product-${s}`))}),t.jsx("div",{className:"flex flex-row w-full items-center justify-center mt-12",children:Y&&t.jsx("button",{type:"button",onClick:()=>N(u+1),className:"rounded-full border-2 bg-white shadow-xl border-[#336234] text-[#336234] p-2 px-3 font-bold",children:X})}),t.jsx("div",{className:"mt-14 font-b_slick_bold w-full",children:t.jsx("div",{className:"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 justify-between",children:M.map((e,s)=>t.jsx(pe,{item:e,url:p}))})})]})})})};de((z,b)=>{ce(z).render(t.jsx(xe,{...b}))});