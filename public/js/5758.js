"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[5758],{5758:(t,a,n)=>{n.r(a),n.d(a,{default:()=>Ct});var l=n(821),i={key:0,class:"row"},e={class:"col-md-8"},o={class:"box"},c=(0,l._)("div",{class:"box-header"},[(0,l._)("div",{class:"box-title"},[(0,l._)("h5",null,"Application details")])],-1),r={class:"box-body"},p={key:0,class:"dps-application-member mb-4"},s=["src"],u={class:"application-info"},_={class:"table table-borderless table-striped"},d=(0,l._)("th",null,"Loan Status",-1),m=["innerHTML"],b=(0,l._)("th",null,"Loan",-1),h={class:"text-right"},g=(0,l._)("th",null,"Loan Service",-1),w={class:"text-right"},y=(0,l._)("th",null,"Service in amount",-1),v={class:"text-right"},f=(0,l._)("th",null,"Loan + Service",-1),x={class:"text-right"},k=(0,l._)("th",null,"Installment",-1),z={class:"text-right"},D={class:"text-right"},O={key:0},C=(0,l._)("th",null,"Previous repayment",-1),L={class:"text-right"},F=(0,l._)("th",null,"Total transactions",-1),P={class:"text-right"},A=(0,l._)("th",null,"Total repayment",-1),q={class:"text-right"},j={key:0,class:"box"},S=(0,l._)("div",{class:"box-header"},[(0,l._)("div",{class:"box-title"},[(0,l._)("h5",null,"Application Closing Information")])],-1),B={class:"box-body"},M={class:"application-info"},T={class:"table table-borderless table-striped"},E=(0,l._)("td",null,"Payable loan amount",-1),I={class:"text-right"},U=(0,l._)("td",null,"Service",-1),$={class:"text-right"},W=(0,l._)("td",null,"Early payment discount",-1),H={class:"text-right"},Y=(0,l._)("td",null,"Beginning Balance",-1),N={class:"text-right"},R=(0,l._)("td",null,"Payable amount",-1),Z={class:"text-right"},G=(0,l._)("td",null,"Payment",-1),J={class:"text-right"},K=(0,l._)("td",null,"Payment method",-1),Q={class:"text-right"},V={key:0},X=(0,l._)("td",null,"Payment channel",-1),tt={class:"text-right"},at={key:1},nt=(0,l._)("td",null,"Transaction no",-1),lt={class:"text-right"},it={key:2},et=(0,l._)("td",null,"Cheque no",-1),ot={class:"text-right"},ct={key:3},rt=(0,l._)("td",null,"Note",-1),pt={class:"text-right"},st=(0,l._)("td",null,"Closed by",-1),ut={class:"text-right"},_t={class:"col-md-4"},dt={key:0,class:"box"},mt=(0,l._)("div",{class:"box-header"},[(0,l._)("h5",null,"Application Manage by")],-1),bt={class:"box-body"},ht=(0,l.Uk)("Created By: "),gt={key:1,class:"box"},wt=(0,l._)("div",{class:"box-header"},[(0,l._)("h5",null,"Operations")],-1),yt={class:"box-body"},vt=(0,l.Uk)("Edit Loan"),ft=(0,l.Uk)("Close Loan");var xt=n(8637);function kt(t,a){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(t);a&&(l=l.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),n.push.apply(n,l)}return n}function zt(t){for(var a=1;a<arguments.length;a++){var n=null!=arguments[a]?arguments[a]:{};a%2?kt(Object(n),!0).forEach((function(a){Dt(t,a,n[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):kt(Object(n)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(n,a))}))}return t}function Dt(t,a,n){return a in t?Object.defineProperty(t,a,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[a]=n,t}const Ot={name:"ShowLoanApplication",data:function(){return{application_id:this.$route.params.application_id,isLoading:!1}},computed:zt({},(0,xt.Se)({application:"loan/application"})),methods:zt(zt({},(0,xt.nv)({getApplicationById:"loan/getApplicationById",deleteApplication:"loan/deleteApplication"})),{},{deleteConfirm:function(t){var a=this;this.hasPermission("delete_application")?this.$swal({title:"Really want to delete!",text:"Are you sure? You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#5430d6",confirmButtonText:"Yes, Delete it!",cancelButtonColor:"#c82333"}).then((function(n){n.isConfirmed&&a.deleteApplication(t).then((function(){a.error_message?a.error=a.error_message:(a.$swal({icon:"success",title:"Congratulation!",text:"Deleted successfully"}),a.$router.push({name:"ApplicationLoan"}))}))})):this.message403()}}),mounted:function(){var t=this;this.isLoading=!0,this.getApplicationById(this.application_id).then((function(){console.log(t.application),t.isLoading=!1,t.application}))}};const Ct=(0,n(3744).Z)(Ot,[["render",function(t,a,n,xt,kt,zt){var Dt=(0,l.up)("router-link");return t.application&&!kt.isLoading?((0,l.wg)(),(0,l.iD)("div",i,[(0,l._)("div",e,[(0,l._)("div",o,[c,(0,l._)("div",r,[t.application.member?((0,l.wg)(),(0,l.iD)("div",p,[t.application.member.photo?((0,l.wg)(),(0,l.iD)("img",{key:0,src:t.application.member.photo,alt:"Member photo",class:"w-24"},null,8,s)):(0,l.kq)("",!0),(0,l.Wm)(Dt,{to:{name:"MemberShow",params:{member_id:t.application.member_id}},class:"text-primary"},{default:(0,l.w5)((function(){return[(0,l.Uk)((0,l.zw)(t.application.member.name),1)]})),_:1},8,["to"]),(0,l._)("h5",null,"Account: "+(0,l.zw)(t.application.member.account_no),1)])):(0,l.kq)("",!0),(0,l._)("div",u,[(0,l._)("table",_,[(0,l._)("tbody",null,[(0,l._)("tr",null,[d,(0,l._)("td",{class:"text-right",innerHTML:t.getStatusFormat(t.application.status)},null,8,m)]),(0,l._)("tr",null,[b,(0,l._)("td",h,(0,l.zw)(t.numberFormat(t.application.loan_amount)),1)]),(0,l._)("tr",null,[g,(0,l._)("td",w,(0,l.zw)(t.application.service)+"%",1)]),(0,l._)("tr",null,[y,(0,l._)("td",v,(0,l.zw)(t.numberFormat(t.application.service_amount)),1)]),(0,l._)("tr",null,[f,(0,l._)("td",x,(0,l.zw)(t.numberFormat(t.application.total_amount)),1)]),(0,l._)("tr",null,[k,(0,l._)("td",z,(0,l.zw)(t.application.installment),1)]),(0,l._)("tr",null,[(0,l._)("th",null,(0,l.zw)(t.ucFirst(t.application.dps_type))+" installment amount",1),(0,l._)("td",D,(0,l.zw)(t.numberFormat(t.application.installment_amount)),1)]),t.application.prev_deposit?((0,l.wg)(),(0,l.iD)("tr",O,[C,(0,l._)("td",L,(0,l.zw)(t.numberFormat(t.application.prev_deposit)),1)])):(0,l.kq)("",!0),(0,l._)("tr",null,[F,(0,l._)("td",P,(0,l.zw)(t.application.paid_transactions.length),1)]),(0,l._)("tr",null,[A,(0,l._)("td",q,(0,l.zw)(t.numberFormat(t.application.balance)),1)])])])])])]),t.application.close_application?((0,l.wg)(),(0,l.iD)("div",j,[S,(0,l._)("div",B,[(0,l._)("div",M,[(0,l._)("table",T,[(0,l._)("tbody",null,[(0,l._)("tr",null,[E,(0,l._)("td",I,(0,l.zw)(t.numberFormat(t.application.close_application.payable_loan_amount)),1)]),(0,l._)("tr",null,[U,(0,l._)("td",$,(0,l.zw)(t.numberFormat(t.application.close_application.service_amount)),1)]),(0,l._)("tr",null,[W,(0,l._)("td",H,(0,l.zw)(t.numberFormat(t.application.close_application.early_payment_discount,2)),1)]),(0,l._)("tr",null,[Y,(0,l._)("td",N,(0,l.zw)(t.numberFormat(t.application.close_application.beginning_balance)),1)]),(0,l._)("tr",null,[R,(0,l._)("td",Z,(0,l.zw)(t.numberFormat(t.application.close_application.payable_amount)),1)]),(0,l._)("tr",null,[G,(0,l._)("td",J,(0,l.zw)(t.numberFormat(t.application.close_application.payment)),1)]),(0,l._)("tr",null,[K,(0,l._)("td",Q,(0,l.zw)(t.ucFirst(t.application.close_application.payment_method)),1)]),t.application.close_application.payment_channel?((0,l.wg)(),(0,l.iD)("tr",V,[X,(0,l._)("td",tt,(0,l.zw)(t.application.close_application.payment_channel),1)])):(0,l.kq)("",!0),t.application.close_application.transaction_no?((0,l.wg)(),(0,l.iD)("tr",at,[nt,(0,l._)("td",lt,(0,l.zw)(t.application.close_application.transaction_no),1)])):(0,l.kq)("",!0),t.application.close_application.cheque_no?((0,l.wg)(),(0,l.iD)("tr",it,[et,(0,l._)("td",ot,(0,l.zw)(t.application.close_application.cheque_no),1)])):(0,l.kq)("",!0),t.application.close_application.note?((0,l.wg)(),(0,l.iD)("tr",ct,[rt,(0,l._)("td",pt,(0,l.zw)(t.application.close_application.note),1)])):(0,l.kq)("",!0),(0,l._)("tr",null,[st,(0,l._)("td",ut,(0,l.zw)(t.application.close_application.user.name),1)])])])])])])):(0,l.kq)("",!0)]),(0,l._)("div",_t,[t.application.created_user?((0,l.wg)(),(0,l.iD)("div",dt,[mt,(0,l._)("div",bt,[(0,l._)("div",null,[(0,l._)("p",null,[ht,(0,l._)("strong",null,(0,l.zw)(t.application.created_user.name),1)]),(0,l._)("p",null,"Created at: "+(0,l.zw)(t.userFormattedDate(t.application.created_at)),1)])])])):(0,l.kq)("",!0),"closed"!=t.application.status?((0,l.wg)(),(0,l.iD)("div",gt,[wt,(0,l._)("div",yt,[(0,l._)("ul",null,[(0,l._)("li",null,[(0,l.Wm)(Dt,{to:{name:"EditLoanApplication",params:{application_id:kt.application_id}},class:"btn btn-outline-primary mb-2 w-100"},{default:(0,l.w5)((function(){return[vt]})),_:1},8,["to"])]),(0,l._)("li",null,[(0,l.Wm)(Dt,{to:{name:"CloseLoanApplication",params:{application_id:kt.application_id}},class:"btn btn-outline-warning mb-2 w-100"},{default:(0,l.w5)((function(){return[ft]})),_:1},8,["to"])]),(0,l._)("li",null,[(0,l._)("a",{href:"",class:"btn btn-outline-danger mb-2 w-100",onClick:a[0]||(a[0]=(0,l.iM)((function(a){return zt.deleteConfirm(t.application.id)}),["prevent"]))},"Delete Loan")])])])])):(0,l.kq)("",!0)])])):(0,l.kq)("",!0)}]])}}]);