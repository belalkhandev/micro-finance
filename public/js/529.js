"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[529],{8793:(r,s,e)=>{e.r(s),e.d(s,{default:()=>lr});var t=e(821),o=e(3581),a={class:"row"},l={class:"col-md-8"},n={class:"box"},d=(0,t._)("div",{class:"box-header bg-indigo-400"},[(0,t._)("div",{class:"box-title"},[(0,t._)("h5",{class:"text-white"},"Profile")])],-1),i={class:"box-body"},u={key:0,class:"profile"},c={class:"row"},p={class:"col-md-5"},_={class:"user-box mb-4"},w=["src"],b=(0,t._)("img",{src:o.Z,alt:""},null,-1),f={class:"mb-3 mt-3"},m={class:"text-indigo-600"},h=(0,t._)("button",{type:"button",class:"btn btn-sm btn-warning"},"Edit Profile",-1),g=(0,t._)("button",{type:"button",class:"btn btn-sm btn-danger"},"Deactive Account",-1),y={class:"col-md-7"},v={class:"user-info"},P={class:"table table-borderless"},x=(0,t._)("th",null,"Name",-1),O=(0,t._)("td",{class:"py-2"},":",-1),k=(0,t._)("th",null,"Email",-1),D=(0,t._)("td",{class:"py-2"},":",-1),j=(0,t._)("th",null,"Phone",-1),z=(0,t._)("td",{class:"py-2"},":",-1),C=(0,t._)("th",null,"Gender",-1),S=(0,t._)("td",{class:"py-2"},":",-1),U=(0,t._)("th",null,"Address",-1),q=(0,t._)("td",{class:"py-2"},":",-1),E=(0,t._)("th",null,"Birthdate",-1),A=(0,t._)("td",{class:"py-2"},":",-1),N=(0,t._)("th",null,"Account Status",-1),V=(0,t._)("td",{class:"py-2"},":",-1),$={key:0,class:"text-green-600"},Z={key:1,class:"text-red-600"},B={class:"col-md-4"},F={class:"box"},G=(0,t._)("div",{class:"box-header bg-zinc-400"},[(0,t._)("div",{class:"box-title"},[(0,t._)("h5",{class:"text-white"},"Password & Security")])],-1),L={class:"box-body"},M={class:"form-group"},H=(0,t._)("label",null,"Current Password",-1),I={key:0,class:"text-danger text-sm"},J={class:"form-group"},K=(0,t._)("label",null,"New Password",-1),Q={key:0,class:"text-danger text-sm"},R={class:"form-group"},T=(0,t._)("label",null,"Confirm Password",-1),W={key:0,class:"text-danger text-sm"},X=(0,t._)("div",{class:"box-footer text-right"},[(0,t._)("button",{type:"submit",class:"btn btn-sm btn-primary",id:"updatePassword"},[(0,t._)("span",null,"Update Password"),(0,t._)("div",{class:"spinner-border",role:"status"},[(0,t._)("span",{class:"visually-hidden"},"Loading...")])])],-1);var Y=e(8637),rr=e(9755),sr=e.n(rr);function er(r,s){var e=Object.keys(r);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(r);s&&(t=t.filter((function(s){return Object.getOwnPropertyDescriptor(r,s).enumerable}))),e.push.apply(e,t)}return e}function tr(r){for(var s=1;s<arguments.length;s++){var e=null!=arguments[s]?arguments[s]:{};s%2?er(Object(e),!0).forEach((function(s){or(r,s,e[s])})):Object.getOwnPropertyDescriptors?Object.defineProperties(r,Object.getOwnPropertyDescriptors(e)):er(Object(e)).forEach((function(s){Object.defineProperty(r,s,Object.getOwnPropertyDescriptor(e,s))}))}return r}function or(r,s,e){return s in r?Object.defineProperty(r,s,{value:e,enumerable:!0,configurable:!0,writable:!0}):r[s]=e,r}const ar={name:"Profile",data:function(){return{form:{current_password:"",password:"",password_confirmation:""},errors:null,error:null}},computed:tr({},(0,Y.Se)({user:"auth/user",validation_errors:"validation_errors",error_message:"error_message"})),methods:tr(tr({},(0,Y.nv)({updatePassword:"auth/changePassword"})),{},{changePassword:function(){var r=this;sr()("#updatePassword").prop("disabled",!0).addClass("submitted");var s=new FormData,e=this.form;Object.keys(e).forEach((function(r){s.append(r,e[r])})),this.updatePassword(s).then((function(){r.validation_errors||r.error_message?(r.errors=r.validation_errors,r.error=r.error_message):(r.errors=r.error=null,Object.assign(r.$data,r.$options.data.apply(r)),r.$swal({icon:"success",title:"Updated!",text:"Password has been updated successfully",timer:3e3})),sr()("#updatePassword").prop("disabled",!1).removeClass("submitted")}))}})};const lr=(0,e(3744).Z)(ar,[["render",function(r,s,e,o,Y,rr){return(0,t.wg)(),(0,t.iD)("div",a,[(0,t._)("div",l,[(0,t._)("div",n,[d,(0,t._)("div",i,[r.user?((0,t.wg)(),(0,t.iD)("div",u,[(0,t._)("div",c,[(0,t._)("div",p,[(0,t._)("div",_,[r.user.profile&&r.user.profile.photo?((0,t.wg)(),(0,t.iD)("img",{key:0,src:r.user.profile.photo,alt:"User photo"},null,8,w)):(0,t.kq)("",!0),b,(0,t._)("div",f,[(0,t._)("h3",null,(0,t.zw)(r.user.name),1),(0,t._)("h5",m,(0,t.zw)(r.user.role_name),1)]),h,g])]),(0,t._)("div",y,[(0,t._)("div",v,[(0,t._)("table",P,[(0,t._)("tbody",null,[(0,t._)("tr",null,[x,O,(0,t._)("td",null,(0,t.zw)(r.user.name),1)]),(0,t._)("tr",null,[k,D,(0,t._)("td",null,(0,t.zw)(r.user.email),1)]),(0,t._)("tr",null,[j,z,(0,t._)("td",null,(0,t.zw)(r.user.phone),1)]),(0,t._)("tr",null,[C,S,(0,t._)("td",null,(0,t.zw)(r.user.profile?r.user.profile.gender:"-"),1)]),(0,t._)("tr",null,[U,q,(0,t._)("td",null,(0,t.zw)(r.user.profile?r.user.profile.address:"-"),1)]),(0,t._)("tr",null,[E,A,(0,t._)("td",null,(0,t.zw)(r.user.profile?r.user.profile.birthdate:"-"),1)]),(0,t._)("tr",null,[N,V,(0,t._)("td",null,[r.user.is_active?((0,t.wg)(),(0,t.iD)("strong",$," Active ")):((0,t.wg)(),(0,t.iD)("strong",Z,"Deactivate"))])])])])])])])])):(0,t.kq)("",!0)])])]),(0,t._)("div",B,[(0,t._)("div",F,[G,(0,t._)("form",{onSubmit:s[3]||(s[3]=(0,t.iM)((function(){return rr.changePassword&&rr.changePassword.apply(rr,arguments)}),["prevent"]))},[(0,t._)("div",L,[(0,t._)("div",M,[H,(0,t.wy)((0,t._)("input",{type:"password","onUpdate:modelValue":s[0]||(s[0]=function(r){return Y.form.current_password=r}),placeholder:"Current password",class:"form-control"},null,512),[[t.nr,Y.form.current_password]]),Y.errors?((0,t.wg)(),(0,t.iD)("span",I,(0,t.zw)(Y.errors.current_password?Y.errors.current_password[0]:""),1)):(0,t.kq)("",!0)]),(0,t._)("div",J,[K,(0,t.wy)((0,t._)("input",{type:"password","onUpdate:modelValue":s[1]||(s[1]=function(r){return Y.form.password=r}),placeholder:"New password",class:"form-control"},null,512),[[t.nr,Y.form.password]]),Y.errors?((0,t.wg)(),(0,t.iD)("span",Q,(0,t.zw)(Y.errors.password?Y.errors.password[0]:""),1)):(0,t.kq)("",!0)]),(0,t._)("div",R,[T,(0,t.wy)((0,t._)("input",{type:"password","onUpdate:modelValue":s[2]||(s[2]=function(r){return Y.form.password_confirmation=r}),placeholder:"Confirm password",class:"form-control"},null,512),[[t.nr,Y.form.password_confirmation]]),Y.errors?((0,t.wg)(),(0,t.iD)("span",W,(0,t.zw)(Y.errors.password_confirmation?Y.errors.password_confirmation[0]:""),1)):(0,t.kq)("",!0)])]),X],32)])])])}]])}}]);