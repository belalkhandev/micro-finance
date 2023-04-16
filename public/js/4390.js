"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[4390],{7735:(s,r,e)=>{e.r(r),e.d(r,{default:()=>ts});var t=e(821),o=e(3581),a={class:"row"},n={class:"col-md-7"},l={class:"box"},i=(0,t._)("div",{class:"box-header bg-indigo-400"},[(0,t._)("div",{class:"box-title"},[(0,t._)("h5",{class:"text-white"},"Admin Profile")])],-1),d={class:"box-body"},u={key:0,class:"profile"},c={class:"row"},p={class:"col-md-5"},_={class:"user-box"},w=["src"],b={key:1,src:o.Z,alt:""},m={class:"mb-3 mt-3"},f={class:"text-indigo-600"},h=(0,t._)("button",{type:"button",class:"btn btn-sm btn-warning"},"Edit Profile",-1),g=(0,t._)("button",{type:"button",class:"btn btn-sm btn-danger"},"Deactive Account",-1),v={class:"col-md-7"},y={class:"user-info"},P={class:"table table-borderless"},x=(0,t._)("th",null,"Name",-1),O=(0,t._)("td",{class:"py-2"},":",-1),k=(0,t._)("th",null,"Email",-1),D=(0,t._)("td",{class:"py-2"},":",-1),j=(0,t._)("th",null,"Phone",-1),z=(0,t._)("td",{class:"py-2"},":",-1),U=(0,t._)("th",null,"Gender",-1),S=(0,t._)("td",{class:"py-2"},":",-1),A=(0,t._)("th",null,"Address",-1),C=(0,t._)("td",{class:"py-2"},":",-1),E=(0,t._)("th",null,"Birthdate",-1),$=(0,t._)("td",{class:"py-2"},":",-1),q=(0,t._)("th",null,"Account Status",-1),N=(0,t._)("td",{class:"py-2"},":",-1),V={key:0,class:"text-green-600"},Z={key:1,class:"text-red-600"},B={key:0,class:"col-md-5"},F={class:"box"},G=(0,t._)("div",{class:"box-header bg-zinc-400"},[(0,t._)("div",{class:"box-title"},[(0,t._)("h5",{class:"text-white"},"Password & Security: Set New Password")])],-1),L={class:"box-body"},M={class:"form-group"},R=(0,t._)("label",null,"New Password",-1),H={key:0,class:"text-danger text-sm"},I={class:"form-group"},J=(0,t._)("label",null,"Confirm Password",-1),K={key:0,class:"text-danger text-sm"},Q=(0,t._)("div",{class:"box-footer text-right"},[(0,t._)("button",{type:"submit",class:"btn btn-sm btn-primary",id:"updatePassword"},[(0,t._)("span",null,"Reset Password"),(0,t._)("div",{class:"spinner-border",role:"status"},[(0,t._)("span",{class:"visually-hidden"},"Loading...")])])],-1);var T=e(8637),W=e(9755),X=e.n(W);function Y(s,r){var e=Object.keys(s);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(s);r&&(t=t.filter((function(r){return Object.getOwnPropertyDescriptor(s,r).enumerable}))),e.push.apply(e,t)}return e}function ss(s){for(var r=1;r<arguments.length;r++){var e=null!=arguments[r]?arguments[r]:{};r%2?Y(Object(e),!0).forEach((function(r){rs(s,r,e[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(s,Object.getOwnPropertyDescriptors(e)):Y(Object(e)).forEach((function(r){Object.defineProperty(s,r,Object.getOwnPropertyDescriptor(e,r))}))}return s}function rs(s,r,e){return r in s?Object.defineProperty(s,r,{value:e,enumerable:!0,configurable:!0,writable:!0}):s[r]=e,s}const es={name:"AdminProfile",data:function(){return{user_id:this.$route.params.admin_id,form:{user_id:this.$route.params.admin_id,password:"",password_confirmation:""},errors:null,error:null}},computed:ss(ss({},(0,T.Se)({users:"user/users",authUser:"auth/user",validation_errors:"validation_errors",error_message:"error_message"})),{},{user:function(){var s=this;if(this.users&&this.user_id)return this.users.find((function(r){return r.id==s.user_id}))}}),methods:ss(ss({},(0,T.nv)({getUsers:"user/getUsers",resetPassword:"auth/resetPassword"})),{},{changePassword:function(){var s=this;X()("#updatePassword").prop("disabled",!0).addClass("submitted");var r=new FormData,e=this.form;Object.keys(e).forEach((function(s){r.append(s,e[s])})),this.resetPassword(r).then((function(){s.validation_errors||s.error_message?(s.errors=s.validation_errors,s.error=s.error_message):(s.errors=s.error=null,Object.assign(s.$data,s.$options.data.apply(s)),s.$swal({icon:"success",title:"Updated!",text:"Password has been updated successfully",timer:3e3})),X()("#updatePassword").prop("disabled",!1).removeClass("submitted")}))}}),mounted:function(){this.users||this.getUsers()}};const ts=(0,e(3744).Z)(es,[["render",function(s,r,e,o,T,W){return(0,t.wg)(),(0,t.iD)("div",a,[(0,t._)("div",n,[(0,t._)("div",l,[i,(0,t._)("div",d,[W.user?((0,t.wg)(),(0,t.iD)("div",u,[(0,t._)("div",c,[(0,t._)("div",p,[(0,t._)("div",_,[W.user.profile&&W.user.profile.photo?((0,t.wg)(),(0,t.iD)("img",{key:0,src:W.user.profile.photo,alt:"User photo"},null,8,w)):((0,t.wg)(),(0,t.iD)("img",b)),(0,t._)("div",m,[(0,t._)("h3",null,(0,t.zw)(W.user.name),1),(0,t._)("h5",f,(0,t.zw)(W.user.role_name),1)]),h,g])]),(0,t._)("div",v,[(0,t._)("div",y,[(0,t._)("table",P,[(0,t._)("tbody",null,[(0,t._)("tr",null,[x,O,(0,t._)("td",null,(0,t.zw)(W.user.name),1)]),(0,t._)("tr",null,[k,D,(0,t._)("td",null,(0,t.zw)(W.user.email),1)]),(0,t._)("tr",null,[j,z,(0,t._)("td",null,(0,t.zw)(W.user.phone),1)]),(0,t._)("tr",null,[U,S,(0,t._)("td",null,(0,t.zw)(W.user.profile?W.user.profile.gender:"-"),1)]),(0,t._)("tr",null,[A,C,(0,t._)("td",null,(0,t.zw)(W.user.profile?W.user.profile.address:"-"),1)]),(0,t._)("tr",null,[E,$,(0,t._)("td",null,(0,t.zw)(W.user.profile?W.user.profile.birthdate:"-"),1)]),(0,t._)("tr",null,[q,N,(0,t._)("td",null,[W.user.is_active?((0,t.wg)(),(0,t.iD)("strong",V," Active ")):((0,t.wg)(),(0,t.iD)("strong",Z,"Deactivate"))])])])])])])])])):(0,t.kq)("",!0)])])]),s.authUser&&"superadmin"===s.authUser.role_name?((0,t.wg)(),(0,t.iD)("div",B,[(0,t._)("div",F,[G,(0,t._)("form",{onSubmit:r[2]||(r[2]=(0,t.iM)((function(){return W.changePassword&&W.changePassword.apply(W,arguments)}),["prevent"]))},[(0,t._)("div",L,[(0,t._)("div",M,[R,(0,t.wy)((0,t._)("input",{type:"password","onUpdate:modelValue":r[0]||(r[0]=function(s){return T.form.password=s}),placeholder:"New password",class:"form-control"},null,512),[[t.nr,T.form.password]]),T.errors?((0,t.wg)(),(0,t.iD)("span",H,(0,t.zw)(T.errors.password?T.errors.password[0]:""),1)):(0,t.kq)("",!0)]),(0,t._)("div",I,[J,(0,t.wy)((0,t._)("input",{type:"password","onUpdate:modelValue":r[1]||(r[1]=function(s){return T.form.password_confirmation=s}),placeholder:"Confirm password",class:"form-control"},null,512),[[t.nr,T.form.password_confirmation]]),T.errors?((0,t.wg)(),(0,t.iD)("span",K,(0,t.zw)(T.errors.password_confirmation?T.errors.password_confirmation[0]:""),1)):(0,t.kq)("",!0)])]),Q],32)])])):(0,t.kq)("",!0)])}]])}}]);