(self["webpackChunkquasarapp"]=self["webpackChunkquasarapp"]||[]).push([[629],{6294:(n,e,r)=>{"use strict";r.d(e,{B:()=>l,p:()=>o});const l="/login",o="/register"},3629:(n,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>F});r(71);var l=r(3673),o=r(8880);const a={key:0},t=(0,l.Wm)("br",null,null,-1),s=(0,l.Wm)("br",null,null,-1),d=(0,l.Wm)("br",null,null,-1),i=(0,l.Wm)("br",null,null,-1),m=(0,l.Wm)("br",null,null,-1);function p(n,e,r,p,u,c){return(0,l.wg)(),(0,l.j4)("div",null,[u.registered?((0,l.wg)(),(0,l.j4)("span",a,"Successfully registered")):(0,l.kq)("",!0),t,(0,l.wy)((0,l.Wm)("input",{type:"text","onUpdate:modelValue":e[1]||(e[1]=n=>u.form.name=n),placeholder:"Name"},null,512),[[o.nr,u.form.name]]),s,(0,l.wy)((0,l.Wm)("input",{type:"text","onUpdate:modelValue":e[2]||(e[2]=n=>u.form.email=n),placeholder:"Email"},null,512),[[o.nr,u.form.email]]),d,(0,l.wy)((0,l.Wm)("input",{type:"password","onUpdate:modelValue":e[3]||(e[3]=n=>u.form.password=n),placeholder:"Password"},null,512),[[o.nr,u.form.password]]),i,(0,l.wy)((0,l.Wm)("input",{type:"password","onUpdate:modelValue":e[4]||(e[4]=n=>u.form.password_confirmation=n),placeholder:"Password Confirmation"},null,512),[[o.nr,u.form.password_confirmation]]),m,(0,l.Wm)("button",{onClick:e[5]||(e[5]=(...n)=>c.sendForm&&c.sendForm(...n)),disabled:u.pending},"Registration",8,["disabled"])])}var u=r(8598),c=r.n(u),f=r(6294);const w={name:"Registration",data(){return{pending:!1,registered:!1,form:{name:null,email:null,password:null,password_confirmation:null}}},methods:{sendForm(){!1===this.pending&&(this.pending=!0,c().post(f.p,this.form).then((n=>{this.registered=!0})).catch((n=>{})).then((()=>{this.pending=!1})))}}};var g=r(4379),h=r(151),b=r(5589),y=r(8240),W=r(8689),Q=r(6805),Z=r(4554),k=r(9367),C=r(7518),v=r.n(C);w.render=p;const F=w;v()(w,"components",{QPage:g.Z,QCard:h.Z,QCardSection:b.Z,QBtn:y.Z,QForm:W.Z,QInput:Q.Z,QIcon:Z.Z,QCardActions:k.Z})}}]);