(self["webpackChunkquasarapp"]=self["webpackChunkquasarapp"]||[]).push([[96],{3096:(t,e,a)=>{"use strict";a.r(e),a.d(e,{default:()=>f});a(71);var n=a(3673),s=a(8880),o=a(2323);const r={key:0,class:"row"},l={class:"form-row"},i={class:"form-row"},m=(0,n.Wm)("div",{class:"form-row"},[(0,n.Wm)("button",{type:"submit"},"Sign In")],-1),c={key:0,class:"row"},d=(0,n.Uk)(" - created at ");function u(t,e,a,u,p,g){return(0,n.wg)(),(0,n.j4)(n.HY,null,[(0,n.Wm)("div",null,[p.secrets.length?(0,n.kq)("",!0):((0,n.wg)(),(0,n.j4)("div",r,[(0,n.Wm)("form",{action:"#",onSubmit:e[3]||(e[3]=(0,s.iM)(((...t)=>g.handleLogin&&g.handleLogin(...t)),["prevent"]))},[(0,n.Wm)("div",l,[(0,n.wy)((0,n.Wm)("input",{type:"email","onUpdate:modelValue":e[1]||(e[1]=t=>p.formData.email=t)},null,512),[[s.nr,p.formData.email]])]),(0,n.Wm)("div",i,[(0,n.wy)((0,n.Wm)("input",{type:"password","onUpdate:modelValue":e[2]||(e[2]=t=>p.formData.password=t)},null,512),[[s.nr,p.formData.password]])]),m],32)]))]),(0,n.Wm)("div",null,[p.secrets.length?((0,n.wg)(),(0,n.j4)("div",c,[((0,n.wg)(!0),(0,n.j4)(n.HY,null,(0,n.Ko)(p.secrets,((t,e)=>((0,n.wg)(),(0,n.j4)("div",{class:"secret",key:e},[(0,n.Wm)("strong",{textContent:(0,o.zw)(t.secret)},null,8,["textContent"]),d,(0,n.Wm)("span",{textContent:(0,o.zw)(t.created_at)},null,8,["textContent"])])))),128))])):(0,n.kq)("",!0)])],64)}var p=a(8598),g=a.n(p);const w={name:"Login",data(){return{secrets:[],formData:{email:"",password:""}}},methods:{handleLogin(){g().get("/sanctum/csrf-cookie").then((t=>{g().post("/login",this.formData).then((t=>{console.log("User signed in!"),console.log(this.formData)})).catch((t=>console.log(this.formData)))}))},getSecrets(){g().get("/api/secrets").then((t=>this.secrets=t.data))}}};w.render=u;const f=w}}]);