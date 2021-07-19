(()=>{"use strict";var e={119:(e,t,r)=>{r(7280),r(5363),r(71);var o=r(8880),n=r(4345),a=r(3673);function i(e,t,r,o,n,i){const l=(0,a.up)("router-view");return(0,a.wg)(),(0,a.j4)(l)}const l=(0,a.aZ)({name:"App"});l.render=i;const s=l;var c=r(4584),u=r(7083),p=r(9582);const d=[{path:"/",component:()=>Promise.all([r.e(736),r.e(983)]).then(r.bind(r,3983)),children:[{path:"",component:()=>Promise.all([r.e(736),r.e(87)]).then(r.bind(r,6087))},{path:"/login",component:()=>r.e(460).then(r.bind(r,9460))},{path:"/registration",component:()=>r.e(908).then(r.bind(r,1908))},{path:"/secrets",component:()=>Promise.all([r.e(736),r.e(408)]).then(r.bind(r,6408)),meta:{auth:!0}}]},{path:"/:catchAll(.*)*",component:()=>Promise.all([r.e(736),r.e(434)]).then(r.bind(r,6434))}],f=d,h=(0,u.BC)((()=>{const e=p.PO,t=(0,p.p7)({scrollBehavior:()=>({left:0,top:0}),routes:f,history:e("/")});return t}));async function v(e,t){const o="function"===typeof c.default?await(0,c.default)({}):c.default,{storeKey:a}=await Promise.resolve().then(r.bind(r,4584)),i="function"===typeof h?await h({store:o}):h;o.$router=i;const l=e(s);return l.use(n.Z,t),{app:l,store:o,storeKey:a,router:i}}const m={config:{}},b="/";async function g({app:e,router:t,store:r,storeKey:o},n){let a=!1;const i=e=>{a=!0;const r=Object(e)===e?t.resolve(e).fullPath:e;window.location.href=r},l=window.location.href.replace(window.location.origin,"");for(let c=0;!1===a&&c<n.length;c++)try{await n[c]({app:e,router:t,store:r,ssrContext:null,redirect:i,urlPath:l,publicPath:b})}catch(s){return s&&s.url?void(window.location.href=s.url):void console.error("[Quasar] boot error:",s)}!0!==a&&(e.use(t),e.use(r,o),e.mount("#q-app"))}v(o.ri,m).then((e=>Promise.all([Promise.resolve().then(r.bind(r,5474))]).then((t=>{const r=t.map((e=>e.default)).filter((e=>"function"===typeof e));g(e,r)}))))},5474:(e,t,r)=>{r.r(t),r.d(t,{default:()=>l,api:()=>i});var o=r(7083),n=r(52),a=r.n(n);const i=a().create({baseURL:"https://api.example.com"}),l=(0,o.xr)((({app:e})=>{e.config.globalProperties.$axios=a(),e.config.globalProperties.$api=i}))},4584:(e,t,r)=>{r.r(t),r.d(t,{default:()=>a});var o=r(7083),n=r(7874);const a=(0,o.h)((()=>{const e=(0,n.MT)({modules:{},strict:!1});return e}))}},t={};function r(o){var n=t[o];if(void 0!==n)return n.exports;var a=t[o]={exports:{}};return e[o](a,a.exports,r),a.exports}r.m=e,(()=>{var e=[];r.O=(t,o,n,a)=>{if(!o){var i=1/0;for(u=0;u<e.length;u++){for(var[o,n,a]=e[u],l=!0,s=0;s<o.length;s++)(!1&a||i>=a)&&Object.keys(r.O).every((e=>r.O[e](o[s])))?o.splice(s--,1):(l=!1,a<i&&(i=a));if(l){e.splice(u--,1);var c=n();void 0!==c&&(t=c)}}return t}a=a||0;for(var u=e.length;u>0&&e[u-1][2]>a;u--)e[u]=e[u-1];e[u]=[o,n,a]}})(),(()=>{r.n=e=>{var t=e&&e.__esModule?()=>e["default"]:()=>e;return r.d(t,{a:t}),t}})(),(()=>{r.d=(e,t)=>{for(var o in t)r.o(t,o)&&!r.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})}})(),(()=>{r.f={},r.e=e=>Promise.all(Object.keys(r.f).reduce(((t,o)=>(r.f[o](e,t),t)),[]))})(),(()=>{r.u=e=>"js/"+e+"."+{87:"b5f6ce7a",408:"322a9814",434:"747a3d02",460:"37324426",908:"546398c7",983:"6c906518"}[e]+".js"})(),(()=>{r.miniCssF=e=>"css/vendor.9908373a.css"})(),(()=>{r.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"===typeof window)return window}}()})(),(()=>{r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)})(),(()=>{var e={},t="finoman:";r.l=(o,n,a,i)=>{if(e[o])e[o].push(n);else{var l,s;if(void 0!==a)for(var c=document.getElementsByTagName("script"),u=0;u<c.length;u++){var p=c[u];if(p.getAttribute("src")==o||p.getAttribute("data-webpack")==t+a){l=p;break}}l||(s=!0,l=document.createElement("script"),l.charset="utf-8",l.timeout=120,r.nc&&l.setAttribute("nonce",r.nc),l.setAttribute("data-webpack",t+a),l.src=o),e[o]=[n];var d=(t,r)=>{l.onerror=l.onload=null,clearTimeout(f);var n=e[o];if(delete e[o],l.parentNode&&l.parentNode.removeChild(l),n&&n.forEach((e=>e(r))),t)return t(r)},f=setTimeout(d.bind(null,void 0,{type:"timeout",target:l}),12e4);l.onerror=d.bind(null,l.onerror),l.onload=d.bind(null,l.onload),s&&document.head.appendChild(l)}}})(),(()=>{r.r=e=>{"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}})(),(()=>{r.p="/"})(),(()=>{var e={143:0};r.f.j=(t,o)=>{var n=r.o(e,t)?e[t]:void 0;if(0!==n)if(n)o.push(n[2]);else{var a=new Promise(((r,o)=>n=e[t]=[r,o]));o.push(n[2]=a);var i=r.p+r.u(t),l=new Error,s=o=>{if(r.o(e,t)&&(n=e[t],0!==n&&(e[t]=void 0),n)){var a=o&&("load"===o.type?"missing":o.type),i=o&&o.target&&o.target.src;l.message="Loading chunk "+t+" failed.\n("+a+": "+i+")",l.name="ChunkLoadError",l.type=a,l.request=i,n[1](l)}};r.l(i,s,"chunk-"+t,t)}},r.O.j=t=>0===e[t];var t=(t,o)=>{var n,a,[i,l,s]=o,c=0;for(n in l)r.o(l,n)&&(r.m[n]=l[n]);if(s)var u=s(r);for(t&&t(o);c<i.length;c++)a=i[c],r.o(e,a)&&e[a]&&e[a][0](),e[i[c]]=0;return r.O(u)},o=self["webpackChunkfinoman"]=self["webpackChunkfinoman"]||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var o=r.O(void 0,[736],(()=>r(119)));o=r.O(o)})();