var J=Object.defineProperty;var L=(o,r,t)=>r in o?J(o,r,{enumerable:!0,configurable:!0,writable:!0,value:t}):o[r]=t;var g=(o,r,t)=>(L(o,typeof r!="symbol"?r+"":r,t),t);import{j as e}from"./Example-zgwdEd5i.js";import{c as G}from"./ReactAppend-mx8-aehl.js";import{r as s}from"./useOutsideClick-TT1qJ6UJ.js";import{J as V}from"./JSEncrypt-jwo8Dr6z.js";import{C as H}from"./CreateReactScript-VVPwJ0HX.js";import{m as a}from"./main-Vi8adC25.js";import{R as z}from"./recaptcha-wrapper-SUZHBnda.js";import"./CreateReactScript-scAdndyK.js";import{H as q}from"./HtmlContent-Aen3UoIq.js";import{S as T}from"./Profile-6kVS_QzG.js";import{M as K}from"./ModalGoogle-6wSbWolA.js";import"./index-38suPYpT.js";import"./_commonjsHelpers-4gQjN7DL.js";/* empty css              */import"./index-XJuWVQ-l.js";import"./storage-zp2nPsZU.js";import"./index-VFMbf6KQ.js";import"./hoist-non-react-statics.cjs-Lm1c23b2.js";import"./axios-_sX4vCAy.js";class h{}g(h,"login",async r=>{try{const{status:t,result:n}=await a.Fetch("./api/login",{method:"POST",body:JSON.stringify(r)});if(!t)throw new Error((n==null?void 0:n.message)||"Error al iniciar sesion");return a.Notify.add({icon:"/images/svg/Boost.svg",title:"Operacion correcta",body:"Se inicio sesion correctamente"}),!0}catch(t){return a.Notify.add({icon:"/images/svg/Boost.svg",title:"Error",body:t.message,type:"danger"}),!1}}),g(h,"signup",async r=>{try{const{status:t,result:n}=await a.Fetch("./api/signup",{method:"POST",body:JSON.stringify(r)});if(!t)throw new Error((n==null?void 0:n.message)||"Error al registrar el usuario");return a.Notify.add({icon:"/assets/img/logo-login.svg",title:"Operacion correcta",body:"Se registro el usuario correctamente"}),n.data}catch(t){return a.Notify.add({icon:"/assets/img/logo-login.svg",title:"Error",body:t.message,type:"danger"}),null}});const W=({PUBLIC_RSA_KEY:o,RECAPTCHA_SITE_KEY:r,token:t,terms:n="Terminos y condiciones",APP_URL:Y,termsAndCondicitions:d,politicas:m})=>{document.title="Registro | Las Doñas";const u=new V;u.setPublicKey(o);const[b,i]=s.useState(!0),[y,C]=s.useState(null),[Q,M]=s.useState(!1),j=s.useRef(),f=s.useRef(),v=s.useRef(),N=s.useRef(),w=s.useRef(),R=s.useRef(),k=s.useRef(),E=s.useRef(),p=s.useRef(),[P,O]=s.useState(!1);s.useRef(),s.useEffect(()=>{i(!1)},[null]);const F=async l=>{l.preventDefault(),i(!0);const c=R.current.value,_=k.current.value;if(c!=_)return T.fire({icon:"warning",title:"Error",text:"Las contraseñas no coinciden",confirmButtonText:"Ok"});if(!y)return T.fire({icon:"warning",title:"Error",text:"Por favor, complete el captcha",confirmButtonText:"Ok"});const U={document_type:$(j.current).val(),document_number:f.current.value,name:v.current.value,lastname:N.current.value,email:w.current.value,password:u.encrypt(c),confirmation:u.encrypt(_),terms:E.current.checked,captcha:y,_token:t},x=await h.signup(U);if(!x)return i(!1);x&&(location.href=`./confirm-email/${x}`),i(!1)},B=l=>{f.current.value="",M(!1)},D="/img_donas/login.png",S=()=>{O(!P)},I=l=>{const c=l.target.getAttribute("data-tipo");p.current=c,S()};return e.jsxs(e.Fragment,{children:[e.jsxs("div",{className:"flex flex-row md:h-screen justify-center h-screen font-b_slick_bold min-h-[999px]",children:[e.jsx("div",{className:"basis-1/2 hidden md:block font-poppins",children:e.jsx("div",{class:"basis-1/2 hidden md:block ",children:e.jsx("div",{className:"bg-cover bg-center bg-no-repeat w-full h-full",children:e.jsx("img",{src:D,alt:"",className:"w-full h-full object-cover min-h-[999px]"})})})}),e.jsx("div",{className:"w-full md:basis-1/2  text-[#151515] flex justify-center items-center px-12 ",children:e.jsx("div",{className:"w-5/6 flex flex-col gap-5 py-5",children:e.jsxs("div",{className:"flex flex-col",children:[e.jsx("div",{className:"text-center mb-4",children:e.jsx("h4",{className:"text-uppercase mt-0 font-bold",children:"Registrate"})}),e.jsxs("form",{onSubmit:F,className:"flex flex-col gap-4",children:[e.jsxs("div",{className:"flex flex-col",children:[e.jsxs("label",{htmlFor:"document_type",className:"form-label",children:["Tipo documento ",e.jsx("b",{className:"text-danger",children:"*"})]}),e.jsxs("select",{className:'relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid " type="text" id="document_number" placeholder="Ingrese su documento"',name:"",id:"",ref:j,onChange:B,required:!0,children:[e.jsx("option",{value:"DNI",children:"DNI - Documento Nacional de Identidad"}),e.jsx("option",{value:"CE",children:"CE - Carnet de Extranjeria"})]})]}),e.jsx("div",{className:"flex flex-col",children:e.jsx("input",{ref:f,className:"relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid ",type:"text",id:"document_number",placeholder:"Ingrese su documento",required:!0})}),e.jsxs("div",{className:"grid grid-cols-4 gap-2",children:[e.jsx("div",{className:"flex flex-col col-span-2",children:e.jsx("input",{ref:v,className:"relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid ",type:"text",id:"name",placeholder:"Ingrese su nombre",required:!0})}),e.jsx("div",{className:"flex flex-col col-span-2",children:e.jsx("input",{ref:N,className:"relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid ",type:"text",id:"lastname",placeholder:"Ingrese sus apellidos",required:!0})})]}),e.jsx("div",{className:"flex flex-col",children:e.jsx("input",{ref:w,className:"relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid ",type:"email",id:"email",required:!0,placeholder:"Ingrese su correo electronico"})}),e.jsx("div",{className:"flex flex-col",children:e.jsx("input",{ref:R,className:"relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid ",type:"password",required:!0,id:"password",placeholder:"Ingrese su contraseña"})}),e.jsx("div",{className:"flex flex-col",children:e.jsx("input",{ref:k,className:"relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid ",type:"password",required:!0,id:"confirmation",placeholder:"Confirme su contraseña"})}),e.jsx("div",{className:"flex flex-col",children:e.jsxs("div",{class:"flex gap-3 px-4 items-center",children:[e.jsx("input",{ref:E,type:"checkbox",className:"form-check-input",id:"checkbox-signup",required:!0}),e.jsxs("label",{for:"",class:"font-normal text-sm ",children:["Acepto la",e.jsx("span",{class:" font-bold text-[#006BF6]  cursor-pointer open-modal","data-tipo":"PoliticaPriv",onClick:I,children:" Política de Privacidad "}),"y los "," ",e.jsx("span",{class:" font-bold text-[#006BF6] open-modal cursor-pointer open-modal","data-tipo":"terminosUso",onClick:I,children:"Términos de Uso "})]})]})}),e.jsx(z,{className:"m-auto mb-3",sitekey:r,onChange:C,style:{display:"block",width:"max-content"}}),e.jsx("div",{className:"mb-0 text-center d-grid",children:e.jsx("button",{className:"text-white bg-green-800 w-full py-4 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-wide",type:"submit",disabled:b,children:b?e.jsxs(e.Fragment,{children:[e.jsx("i",{className:"fa fa-spinner fa-spin"})," Verificando"]}):"Registrarme"})})]}),e.jsxs("a",{href:"/login-google",class:"flex flex-row gap-2 justify-center items-center px-6 py-3.5 mt-4 w-full rounded-3xl border border-green-800 border-solid min-h-[51px]",children:[e.jsx("img",{loading:"lazy",src:"/img_donas/Google1.png",alt:"",class:"object-contain shrink-0  my-auto w-6 aspect-square"}),e.jsx("span",{class:" my-auto",children:" Registrarse con Google"})]}),e.jsx("div",{className:"row mt-3",children:e.jsx("div",{className:"col-12 text-center",children:e.jsxs("p",{className:"text-muted",children:["Ya tienes una cuenta? ",e.jsx("a",{href:"/login",className:"text-dark ms-1",children:e.jsx("b",{children:"Iniciar sesion"})})]})})})]})})})]}),e.jsx(K,{handlemodalMaps:S,isModalOpen:P,tittle:p.current=="PoliticaPriv"?"Politica de Prtivacidad ":"Terminos de Uso",children:p.current=="PoliticaPriv"?e.jsx(q,{html:(m==null?void 0:m.content)??""}):e.jsx(q,{html:(d==null?void 0:d.content)??""})})]})};H((o,r)=>{G(o).render(e.jsx(W,{...r}))});