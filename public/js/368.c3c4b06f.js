(self["webpackChunkquasarapp"]=self["webpackChunkquasarapp"]||[]).push([[368],{3368:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>f});n(71);var a=n(3673),s=n(8880),o=n(2323);const r={key:0,class:"row"},l={class:"form-row"},c={class:"form-row"},i=(0,a.Wm)("div",{class:"form-row"},[(0,a.Wm)("button",{type:"submit"},"Sign In")],-1),m={key:0,class:"row"},d=(0,a.Uk)(" - created at ");function u(e,t,n,u,p,g){return(0,a.wg)(),(0,a.j4)(a.HY,null,[(0,a.Wm)("div",null,[p.secrets.length?(0,a.kq)("",!0):((0,a.wg)(),(0,a.j4)("div",r,[(0,a.Wm)("form",{action:"#",onSubmit:t[3]||(t[3]=(0,s.iM)(((...e)=>g.handleLogin&&g.handleLogin(...e)),["prevent"]))},[(0,a.Wm)("div",l,[(0,a.wy)((0,a.Wm)("input",{type:"email","onUpdate:modelValue":t[1]||(t[1]=e=>p.formData.email=e)},null,512),[[s.nr,p.formData.email]])]),(0,a.Wm)("div",c,[(0,a.wy)((0,a.Wm)("input",{type:"password","onUpdate:modelValue":t[2]||(t[2]=e=>p.formData.password=e)},null,512),[[s.nr,p.formData.password]])]),i],32)]))]),(0,a.Wm)("div",null,[p.secrets.length?((0,a.wg)(),(0,a.j4)("div",m,[((0,a.wg)(!0),(0,a.j4)(a.HY,null,(0,a.Ko)(p.secrets,((e,t)=>((0,a.wg)(),(0,a.j4)("div",{class:"secret",key:t},[(0,a.Wm)("strong",{textContent:(0,o.zw)(e.secret)},null,8,["textContent"]),d,(0,a.Wm)("span",{textContent:(0,o.zw)(e.created_at)},null,8,["textContent"])])))),128))])):(0,a.kq)("",!0)])],64)}var p=n(8598),g=n.n(p);const w={name:"Login",data(){return{secrets:[],formData:{email:"",password:""}}},methods:{handleLogin(){g().get("/sanctum/csrf-cookie").then((e=>{g().post("/login",this.formData).then((e=>{console.log("User signed in!"),console.log(this.formData)})).catch((e=>console.log(e)))}))},getSecrets(){g().get("/api/secrets").then((e=>this.secrets=e.data))}}};w.render=u;const f=w}}]);