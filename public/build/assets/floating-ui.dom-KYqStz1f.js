function Y(t){return yt(t)?(t.nodeName||"").toLowerCase():"#document"}function A(t){var e;return(t==null||(e=t.ownerDocument)==null?void 0:e.defaultView)||window}function D(t){var e;return(e=(yt(t)?t.ownerDocument:t.document)||window.document)==null?void 0:e.documentElement}function yt(t){return t instanceof Node||t instanceof A(t).Node}function O(t){return t instanceof Element||t instanceof A(t).Element}function L(t){return t instanceof HTMLElement||t instanceof A(t).HTMLElement}function ht(t){return typeof ShadowRoot>"u"?!1:t instanceof ShadowRoot||t instanceof A(t).ShadowRoot}function Q(t){const{overflow:e,overflowX:o,overflowY:n,display:i}=E(t);return/auto|scroll|overlay|hidden|clip/.test(e+n+o)&&!["inline","contents"].includes(i)}function Lt(t){return["table","td","th"].includes(Y(t))}function it(t){return[":popover-open",":modal"].some(e=>{try{return t.matches(e)}catch{return!1}})}function at(t){const e=ut(),o=O(t)?E(t):t;return o.transform!=="none"||o.perspective!=="none"||(o.containerType?o.containerType!=="normal":!1)||!e&&(o.backdropFilter?o.backdropFilter!=="none":!1)||!e&&(o.filter?o.filter!=="none":!1)||["transform","perspective","filter"].some(n=>(o.willChange||"").includes(n))||["paint","layout","strict","content"].some(n=>(o.contain||"").includes(n))}function Pt(t){let e=N(t);for(;L(e)&&!I(e);){if(at(e))return e;if(it(e))return null;e=N(e)}return null}function ut(){return typeof CSS>"u"||!CSS.supports?!1:CSS.supports("-webkit-backdrop-filter","none")}function I(t){return["html","body","#document"].includes(Y(t))}function E(t){return A(t).getComputedStyle(t)}function rt(t){return O(t)?{scrollLeft:t.scrollLeft,scrollTop:t.scrollTop}:{scrollLeft:t.scrollX,scrollTop:t.scrollY}}function N(t){if(Y(t)==="html")return t;const e=t.assignedSlot||t.parentNode||ht(t)&&t.host||D(t);return ht(e)?e.host:e}function vt(t){const e=N(t);return I(e)?t.ownerDocument?t.ownerDocument.body:t.body:L(e)&&Q(e)?e:vt(e)}function G(t,e,o){var n;e===void 0&&(e=[]),o===void 0&&(o=!0);const i=vt(t),s=i===((n=t.ownerDocument)==null?void 0:n.body),r=A(i);if(s){const c=lt(r);return e.concat(r,r.visualViewport||[],Q(i)?i:[],c&&o?G(c):[])}return e.concat(i,G(i,[],o))}function lt(t){return t.parent&&Object.getPrototypeOf(t.parent)?t.frameElement:null}const j=Math.min,H=Math.max,et=Math.round,tt=Math.floor,B=t=>({x:t,y:t}),Dt={left:"right",right:"left",bottom:"top",top:"bottom"},St={start:"end",end:"start"};function Ft(t,e,o){return H(t,j(e,o))}function st(t,e){return typeof t=="function"?t(e):t}function X(t){return t.split("-")[0]}function Z(t){return t.split("-")[1]}function kt(t){return t==="x"?"y":"x"}function dt(t){return t==="y"?"height":"width"}function J(t){return["top","bottom"].includes(X(t))?"y":"x"}function mt(t){return kt(J(t))}function Nt(t,e,o){o===void 0&&(o=!1);const n=Z(t),i=mt(t),s=dt(i);let r=i==="x"?n===(o?"end":"start")?"right":"left":n==="start"?"bottom":"top";return e.reference[s]>e.floating[s]&&(r=nt(r)),[r,nt(r)]}function Bt(t){const e=nt(t);return[ft(t),e,ft(e)]}function ft(t){return t.replace(/start|end/g,e=>St[e])}function Vt(t,e,o){const n=["left","right"],i=["right","left"],s=["top","bottom"],r=["bottom","top"];switch(t){case"top":case"bottom":return o?e?i:n:e?n:i;case"left":case"right":return e?s:r;default:return[]}}function Wt(t,e,o,n){const i=Z(t);let s=Vt(X(t),o==="start",n);return i&&(s=s.map(r=>r+"-"+i),e&&(s=s.concat(s.map(ft)))),s}function nt(t){return t.replace(/left|right|bottom|top/g,e=>Dt[e])}function Mt(t){return{top:0,right:0,bottom:0,left:0,...t}}function bt(t){return typeof t!="number"?Mt(t):{top:t,right:t,bottom:t,left:t}}function ot(t){const{x:e,y:o,width:n,height:i}=t;return{width:n,height:i,top:o,left:e,right:e+n,bottom:o+i,x:e,y:o}}function pt(t,e,o){let{reference:n,floating:i}=t;const s=J(e),r=mt(e),c=dt(r),l=X(e),f=s==="y",d=n.x+n.width/2-i.width/2,u=n.y+n.height/2-i.height/2,h=n[c]/2-i[c]/2;let a;switch(l){case"top":a={x:d,y:n.y-i.height};break;case"bottom":a={x:d,y:n.y+n.height};break;case"right":a={x:n.x+n.width,y:u};break;case"left":a={x:n.x-i.width,y:u};break;default:a={x:n.x,y:n.y}}switch(Z(e)){case"start":a[r]-=h*(o&&f?-1:1);break;case"end":a[r]+=h*(o&&f?-1:1);break}return a}const Ht=async(t,e,o)=>{const{placement:n="bottom",strategy:i="absolute",middleware:s=[],platform:r}=o,c=s.filter(Boolean),l=await(r.isRTL==null?void 0:r.isRTL(e));let f=await r.getElementRects({reference:t,floating:e,strategy:i}),{x:d,y:u}=pt(f,n,l),h=n,a={},m=0;for(let g=0;g<c.length;g++){const{name:w,fn:p}=c[g],{x,y:v,data:b,reset:y}=await p({x:d,y:u,initialPlacement:n,placement:h,strategy:i,middlewareData:a,rects:f,platform:r,elements:{reference:t,floating:e}});d=x??d,u=v??u,a={...a,[w]:{...a[w],...b}},y&&m<=50&&(m++,typeof y=="object"&&(y.placement&&(h=y.placement),y.rects&&(f=y.rects===!0?await r.getElementRects({reference:t,floating:e,strategy:i}):y.rects),{x:d,y:u}=pt(f,h,l)),g=-1)}return{x:d,y:u,placement:h,strategy:i,middlewareData:a}};async function $t(t,e){var o;e===void 0&&(e={});const{x:n,y:i,platform:s,rects:r,elements:c,strategy:l}=t,{boundary:f="clippingAncestors",rootBoundary:d="viewport",elementContext:u="floating",altBoundary:h=!1,padding:a=0}=st(e,t),m=bt(a),w=c[h?u==="floating"?"reference":"floating":u],p=ot(await s.getClippingRect({element:(o=await(s.isElement==null?void 0:s.isElement(w)))==null||o?w:w.contextElement||await(s.getDocumentElement==null?void 0:s.getDocumentElement(c.floating)),boundary:f,rootBoundary:d,strategy:l})),x=u==="floating"?{x:n,y:i,width:r.floating.width,height:r.floating.height}:r.reference,v=await(s.getOffsetParent==null?void 0:s.getOffsetParent(c.floating)),b=await(s.isElement==null?void 0:s.isElement(v))?await(s.getScale==null?void 0:s.getScale(v))||{x:1,y:1}:{x:1,y:1},y=ot(s.convertOffsetParentRelativeRectToViewportRelativeRect?await s.convertOffsetParentRelativeRectToViewportRelativeRect({elements:c,rect:x,offsetParent:v,strategy:l}):x);return{top:(p.top-y.top+m.top)/b.y,bottom:(y.bottom-p.bottom+m.bottom)/b.y,left:(p.left-y.left+m.left)/b.x,right:(y.right-p.right+m.right)/b.x}}const zt=t=>({name:"arrow",options:t,async fn(e){const{x:o,y:n,placement:i,rects:s,platform:r,elements:c,middlewareData:l}=e,{element:f,padding:d=0}=st(t,e)||{};if(f==null)return{};const u=bt(d),h={x:o,y:n},a=mt(i),m=dt(a),g=await r.getDimensions(f),w=a==="y",p=w?"top":"left",x=w?"bottom":"right",v=w?"clientHeight":"clientWidth",b=s.reference[m]+s.reference[a]-h[a]-s.floating[m],y=h[a]-s.reference[a],C=await(r.getOffsetParent==null?void 0:r.getOffsetParent(f));let V=C?C[v]:0;(!V||!await(r.isElement==null?void 0:r.isElement(C)))&&(V=c.floating[v]||s.floating[m]);const q=b/2-y/2,W=V/2-g[m]/2-1,S=j(u[p],W),U=j(u[x],W),M=S,K=V-g[m]-U,R=V/2-g[m]/2+q,z=Ft(M,R,K),P=!l.arrow&&Z(i)!=null&&R!==z&&s.reference[m]/2-(R<M?S:U)-g[m]/2<0,T=P?R<M?R-M:R-K:0;return{[a]:h[a]+T,data:{[a]:z,centerOffset:R-z-T,...P&&{alignmentOffset:T}},reset:P}}}),_t=function(t){return t===void 0&&(t={}),{name:"flip",options:t,async fn(e){var o,n;const{placement:i,middlewareData:s,rects:r,initialPlacement:c,platform:l,elements:f}=e,{mainAxis:d=!0,crossAxis:u=!0,fallbackPlacements:h,fallbackStrategy:a="bestFit",fallbackAxisSideDirection:m="none",flipAlignment:g=!0,...w}=st(t,e);if((o=s.arrow)!=null&&o.alignmentOffset)return{};const p=X(i),x=J(c),v=X(c)===c,b=await(l.isRTL==null?void 0:l.isRTL(f.floating)),y=h||(v||!g?[nt(c)]:Bt(c)),C=m!=="none";!h&&C&&y.push(...Wt(c,g,m,b));const V=[c,...y],q=await $t(e,w),W=[];let S=((n=s.flip)==null?void 0:n.overflows)||[];if(d&&W.push(q[p]),u){const R=Nt(i,r,b);W.push(q[R[0]],q[R[1]])}if(S=[...S,{placement:i,overflows:W}],!W.every(R=>R<=0)){var U,M;const R=(((U=s.flip)==null?void 0:U.index)||0)+1,z=V[R];if(z)return{data:{index:R,overflows:S},reset:{placement:z}};let P=(M=S.filter(T=>T.overflows[0]<=0).sort((T,F)=>T.overflows[1]-F.overflows[1])[0])==null?void 0:M.placement;if(!P)switch(a){case"bestFit":{var K;const T=(K=S.filter(F=>{if(C){const k=J(F.placement);return k===x||k==="y"}return!0}).map(F=>[F.placement,F.overflows.filter(k=>k>0).reduce((k,Tt)=>k+Tt,0)]).sort((F,k)=>F[1]-k[1])[0])==null?void 0:K[0];T&&(P=T);break}case"initialPlacement":P=c;break}if(i!==P)return{reset:{placement:P}}}return{}}}};async function It(t,e){const{placement:o,platform:n,elements:i}=t,s=await(n.isRTL==null?void 0:n.isRTL(i.floating)),r=X(o),c=Z(o),l=J(o)==="y",f=["left","top"].includes(r)?-1:1,d=s&&l?-1:1,u=st(e,t);let{mainAxis:h,crossAxis:a,alignmentAxis:m}=typeof u=="number"?{mainAxis:u,crossAxis:0,alignmentAxis:null}:{mainAxis:0,crossAxis:0,alignmentAxis:null,...u};return c&&typeof m=="number"&&(a=c==="end"?m*-1:m),l?{x:a*d,y:h*f}:{x:h*f,y:a*d}}const jt=function(t){return t===void 0&&(t=0),{name:"offset",options:t,async fn(e){var o,n;const{x:i,y:s,placement:r,middlewareData:c}=e,l=await It(e,t);return r===((o=c.offset)==null?void 0:o.placement)&&(n=c.arrow)!=null&&n.alignmentOffset?{}:{x:i+l.x,y:s+l.y,data:{...l,placement:r}}}}};function Rt(t){const e=E(t);let o=parseFloat(e.width)||0,n=parseFloat(e.height)||0;const i=L(t),s=i?t.offsetWidth:o,r=i?t.offsetHeight:n,c=et(o)!==s||et(n)!==r;return c&&(o=s,n=r),{width:o,height:n,$:c}}function gt(t){return O(t)?t:t.contextElement}function _(t){const e=gt(t);if(!L(e))return B(1);const o=e.getBoundingClientRect(),{width:n,height:i,$:s}=Rt(e);let r=(s?et(o.width):o.width)/n,c=(s?et(o.height):o.height)/i;return(!r||!Number.isFinite(r))&&(r=1),(!c||!Number.isFinite(c))&&(c=1),{x:r,y:c}}const Xt=B(0);function At(t){const e=A(t);return!ut()||!e.visualViewport?Xt:{x:e.visualViewport.offsetLeft,y:e.visualViewport.offsetTop}}function Yt(t,e,o){return e===void 0&&(e=!1),!o||e&&o!==A(t)?!1:e}function $(t,e,o,n){e===void 0&&(e=!1),o===void 0&&(o=!1);const i=t.getBoundingClientRect(),s=gt(t);let r=B(1);e&&(n?O(n)&&(r=_(n)):r=_(t));const c=Yt(s,o,n)?At(s):B(0);let l=(i.left+c.x)/r.x,f=(i.top+c.y)/r.y,d=i.width/r.x,u=i.height/r.y;if(s){const h=A(s),a=n&&O(n)?A(n):n;let m=h,g=lt(m);for(;g&&n&&a!==m;){const w=_(g),p=g.getBoundingClientRect(),x=E(g),v=p.left+(g.clientLeft+parseFloat(x.paddingLeft))*w.x,b=p.top+(g.clientTop+parseFloat(x.paddingTop))*w.y;l*=w.x,f*=w.y,d*=w.x,u*=w.y,l+=v,f+=b,m=A(g),g=lt(m)}}return ot({width:d,height:u,x:l,y:f})}function qt(t){let{elements:e,rect:o,offsetParent:n,strategy:i}=t;const s=i==="fixed",r=D(n),c=e?it(e.floating):!1;if(n===r||c&&s)return o;let l={scrollLeft:0,scrollTop:0},f=B(1);const d=B(0),u=L(n);if((u||!u&&!s)&&((Y(n)!=="body"||Q(r))&&(l=rt(n)),L(n))){const h=$(n);f=_(n),d.x=h.x+n.clientLeft,d.y=h.y+n.clientTop}return{width:o.width*f.x,height:o.height*f.y,x:o.x*f.x-l.scrollLeft*f.x+d.x,y:o.y*f.y-l.scrollTop*f.y+d.y}}function Ut(t){return Array.from(t.getClientRects())}function Ot(t){return $(D(t)).left+rt(t).scrollLeft}function Kt(t){const e=D(t),o=rt(t),n=t.ownerDocument.body,i=H(e.scrollWidth,e.clientWidth,n.scrollWidth,n.clientWidth),s=H(e.scrollHeight,e.clientHeight,n.scrollHeight,n.clientHeight);let r=-o.scrollLeft+Ot(t);const c=-o.scrollTop;return E(n).direction==="rtl"&&(r+=H(e.clientWidth,n.clientWidth)-i),{width:i,height:s,x:r,y:c}}function Gt(t,e){const o=A(t),n=D(t),i=o.visualViewport;let s=n.clientWidth,r=n.clientHeight,c=0,l=0;if(i){s=i.width,r=i.height;const f=ut();(!f||f&&e==="fixed")&&(c=i.offsetLeft,l=i.offsetTop)}return{width:s,height:r,x:c,y:l}}function Jt(t,e){const o=$(t,!0,e==="fixed"),n=o.top+t.clientTop,i=o.left+t.clientLeft,s=L(t)?_(t):B(1),r=t.clientWidth*s.x,c=t.clientHeight*s.y,l=i*s.x,f=n*s.y;return{width:r,height:c,x:l,y:f}}function wt(t,e,o){let n;if(e==="viewport")n=Gt(t,o);else if(e==="document")n=Kt(D(t));else if(O(e))n=Jt(e,o);else{const i=At(t);n={...e,x:e.x-i.x,y:e.y-i.y}}return ot(n)}function Et(t,e){const o=N(t);return o===e||!O(o)||I(o)?!1:E(o).position==="fixed"||Et(o,e)}function Qt(t,e){const o=e.get(t);if(o)return o;let n=G(t,[],!1).filter(c=>O(c)&&Y(c)!=="body"),i=null;const s=E(t).position==="fixed";let r=s?N(t):t;for(;O(r)&&!I(r);){const c=E(r),l=at(r);!l&&c.position==="fixed"&&(i=null),(s?!l&&!i:!l&&c.position==="static"&&!!i&&["absolute","fixed"].includes(i.position)||Q(r)&&!l&&Et(t,r))?n=n.filter(d=>d!==r):i=c,r=N(r)}return e.set(t,n),n}function Zt(t){let{element:e,boundary:o,rootBoundary:n,strategy:i}=t;const r=[...o==="clippingAncestors"?it(e)?[]:Qt(e,this._c):[].concat(o),n],c=r[0],l=r.reduce((f,d)=>{const u=wt(e,d,i);return f.top=H(u.top,f.top),f.right=j(u.right,f.right),f.bottom=j(u.bottom,f.bottom),f.left=H(u.left,f.left),f},wt(e,c,i));return{width:l.right-l.left,height:l.bottom-l.top,x:l.left,y:l.top}}function te(t){const{width:e,height:o}=Rt(t);return{width:e,height:o}}function ee(t,e,o){const n=L(e),i=D(e),s=o==="fixed",r=$(t,!0,s,e);let c={scrollLeft:0,scrollTop:0};const l=B(0);if(n||!n&&!s)if((Y(e)!=="body"||Q(i))&&(c=rt(e)),n){const u=$(e,!0,s,e);l.x=u.x+e.clientLeft,l.y=u.y+e.clientTop}else i&&(l.x=Ot(i));const f=r.left+c.scrollLeft-l.x,d=r.top+c.scrollTop-l.y;return{x:f,y:d,width:r.width,height:r.height}}function ct(t){return E(t).position==="static"}function xt(t,e){return!L(t)||E(t).position==="fixed"?null:e?e(t):t.offsetParent}function Ct(t,e){const o=A(t);if(it(t))return o;if(!L(t)){let i=N(t);for(;i&&!I(i);){if(O(i)&&!ct(i))return i;i=N(i)}return o}let n=xt(t,e);for(;n&&Lt(n)&&ct(n);)n=xt(n,e);return n&&I(n)&&ct(n)&&!at(n)?o:n||Pt(t)||o}const ne=async function(t){const e=this.getOffsetParent||Ct,o=this.getDimensions,n=await o(t.floating);return{reference:ee(t.reference,await e(t.floating),t.strategy),floating:{x:0,y:0,width:n.width,height:n.height}}};function oe(t){return E(t).direction==="rtl"}const ie={convertOffsetParentRelativeRectToViewportRelativeRect:qt,getDocumentElement:D,getClippingRect:Zt,getOffsetParent:Ct,getElementRects:ne,getClientRects:Ut,getDimensions:te,getScale:_,isElement:O,isRTL:oe};function re(t,e){let o=null,n;const i=D(t);function s(){var c;clearTimeout(n),(c=o)==null||c.disconnect(),o=null}function r(c,l){c===void 0&&(c=!1),l===void 0&&(l=1),s();const{left:f,top:d,width:u,height:h}=t.getBoundingClientRect();if(c||e(),!u||!h)return;const a=tt(d),m=tt(i.clientWidth-(f+u)),g=tt(i.clientHeight-(d+h)),w=tt(f),x={rootMargin:-a+"px "+-m+"px "+-g+"px "+-w+"px",threshold:H(0,j(1,l))||1};let v=!0;function b(y){const C=y[0].intersectionRatio;if(C!==l){if(!v)return r();C?r(!1,C):n=setTimeout(()=>{r(!1,1e-7)},1e3)}v=!1}try{o=new IntersectionObserver(b,{...x,root:i.ownerDocument})}catch{o=new IntersectionObserver(b,x)}o.observe(t)}return r(!0),s}function se(t,e,o,n){n===void 0&&(n={});const{ancestorScroll:i=!0,ancestorResize:s=!0,elementResize:r=typeof ResizeObserver=="function",layoutShift:c=typeof IntersectionObserver=="function",animationFrame:l=!1}=n,f=gt(t),d=i||s?[...f?G(f):[],...G(e)]:[];d.forEach(p=>{i&&p.addEventListener("scroll",o,{passive:!0}),s&&p.addEventListener("resize",o)});const u=f&&c?re(f,o):null;let h=-1,a=null;r&&(a=new ResizeObserver(p=>{let[x]=p;x&&x.target===f&&a&&(a.unobserve(e),cancelAnimationFrame(h),h=requestAnimationFrame(()=>{var v;(v=a)==null||v.observe(e)})),o()}),f&&!l&&a.observe(f),a.observe(e));let m,g=l?$(t):null;l&&w();function w(){const p=$(t);g&&(p.x!==g.x||p.y!==g.y||p.width!==g.width||p.height!==g.height)&&o(),g=p,m=requestAnimationFrame(w)}return o(),()=>{var p;d.forEach(x=>{i&&x.removeEventListener("scroll",o),s&&x.removeEventListener("resize",o)}),u==null||u(),(p=a)==null||p.disconnect(),a=null,l&&cancelAnimationFrame(m)}}const ce=jt,le=_t,fe=zt,ae=(t,e,o)=>{const n=new Map,i={platform:ie,...o},s={...i.platform,_c:n};return Ht(t,e,{...i,platform:s})};export{se as a,fe as b,ae as c,le as f,E as g,O as i,ce as o};