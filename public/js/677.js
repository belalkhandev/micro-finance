"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[677],{216:(t,a,n)=>{n.d(a,{Z:()=>l});var s=n(3645),e=n.n(s)()((function(t){return t[1]}));e.push([t.id,".widget .widget-header span i.bx{transform:translate(5%,10%)}",""]);const l=e},7677:(t,a,n)=>{n.r(a),n.d(a,{default:()=>Bt});var s=n(821),e={key:0,class:"row"},l={class:"col-md-3"},r={class:"widget widget-success"},i={class:"widget-header"},d={class:"title"},o=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-group"})],-1),c={class:"widget-body"},_={class:"col-md-3"},u={class:"widget widget-warning"},w={class:"widget-header"},b={class:"title"},m=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-group"})],-1),p={class:"widget-body"},h={class:"col-md-3"},g={class:"widget widget-primary"},f={class:"widget-header"},v={class:"title"},z=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-dollar-circle"})],-1),y={class:"widget-body"},D={class:"col-md-3"},k={class:"widget widget-warning"},x={class:"widget-header"},$={class:"title"},F=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-dollar-circle"})],-1),O={class:"widget-body"},T={key:1,class:"row mt-4"},U={class:"col-md-3"},L={class:"widget widget-primary"},j={class:"widget-header"},P={class:"title"},C=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-dollar-circle"})],-1),M={class:"widget-body"},S={class:"col-md-3"},W={class:"widget widget-danger"},N={class:"widget-header"},Z={class:"title"},q=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-dollar-circle"})],-1),E={class:"widget-body"},H={class:"col-md-3"},K={class:"widget widget-warning"},Y={class:"widget-header"},B={class:"title"},A=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-dollar-circle"})],-1),G={class:"widget-body"},I={class:"col-md-3"},J={class:"widget widget-success"},Q={class:"widget-header"},R={class:"title"},V=(0,s._)("span",null,[(0,s._)("i",{class:"bx bx-dollar-circle"})],-1),X={class:"widget-body"},tt={class:"row mt-4"},at={class:"col-md-12"},nt={class:"box"},st={class:"box-header"},et={class:"box-title"},lt={class:"box-body"},rt={class:"table"},it=(0,s._)("br",null,null,-1),dt=(0,s._)("br",null,null,-1),ot=(0,s._)("br",null,null,-1),ct={key:0,class:"text-success"},_t={key:1,class:"text-danger"},ut={key:0},wt=["onClick"],bt={key:1,class:"text-danger"},mt=[(0,s._)("span",{class:"btn btn-success btn-sm py-1"},"Collected",-1)],pt={key:1},ht=[(0,s._)("td",{colspan:"10"},"No Transaction found",-1)],gt=(0,s._)("div",{class:"box-footer"},null,-1),ft={class:"box"},vt={class:"box-header"},zt={class:"box-title"},yt={class:"box-body"},Dt={class:"table"},kt=(0,s._)("br",null,null,-1),xt=(0,s._)("br",null,null,-1),$t=(0,s._)("br",null,null,-1),Ft={key:0,class:"text-success"},Ot={key:1,class:"text-danger"},Tt={key:0},Ut=["onClick"],Lt={key:1,class:"text-danger"},jt=[(0,s._)("span",{class:"btn btn-success btn-sm py-1"},"Collected",-1)],Pt={key:1},Ct=[(0,s._)("td",{colspan:"10"},"No Transaction found",-1)],Mt=(0,s._)("div",{class:"box-footer"},null,-1);var St=n(8637);function Wt(t,a){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);a&&(s=s.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),n.push.apply(n,s)}return n}function Nt(t){for(var a=1;a<arguments.length;a++){var n=null!=arguments[a]?arguments[a]:{};a%2?Wt(Object(n),!0).forEach((function(a){Zt(t,a,n[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):Wt(Object(n)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(n,a))}))}return t}function Zt(t,a,n){return a in t?Object.defineProperty(t,a,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[a]=n,t}const qt={name:"Dashboard",mixins:[n(4118).B],computed:Nt(Nt({},(0,St.Se)({dashboard:"dashboard/dashboard_data",loan_transactions:"transaction/loan_transactions",dps_transactions:"transaction/dps_transactions"})),{},{fetchLatestLoanTransactions:function(){var t=this;return this.loan_transactions?this.loan_transactions.data.filter((function(t){return 1==t.is_paid})).slice(0,9):(this.getLoanTransaction().then((function(){if(t.loan_transactions)return t.loan_transactions.data.filter((function(t){return 1==t.is_paid})).slice(0,9)})),null)},fetchLatestDpsTransactions:function(){var t=this;return this.dps_transactions?this.dps_transactions.data.filter((function(t){return 1==t.is_paid})).slice(0,9):(this.getDpsTransactions().then((function(){if(t.dps_transactions)return t.dps_transactions.data.filter((function(t){return 1==t.is_paid})).slice(0,9)})),null)}}),methods:Nt({},(0,St.nv)({getDashboardData:"dashboard/getDashboardData",getLoanTransaction:"transaction/getLoanTransactions",getDpsTransactions:"transaction/getDpsTransactions"})),mounted:function(){this.getDashboardData()}};var Et=n(2446),Ht=n.n(Et),Kt=n(216),Yt={insert:"head",singleton:!1};Ht()(Kt.Z,Yt);Kt.Z.locals;const Bt=(0,n(3744).Z)(qt,[["render",function(t,a,n,St,Wt,Nt){var Zt=(0,s.up)("router-link");return(0,s.wg)(),(0,s.iD)("div",null,[t.dashboard?((0,s.wg)(),(0,s.iD)("div",e,[(0,s._)("div",l,[(0,s._)("div",r,[(0,s._)("div",i,[(0,s._)("h5",d,(0,s.zw)(t.$t("members")),1),o]),(0,s._)("div",c,[(0,s.Wm)(Zt,{to:"/members"},{default:(0,s.w5)((function(){return[(0,s._)("h3",null,(0,s.zw)(t.dashboard.members),1)]})),_:1})])])]),(0,s._)("div",_,[(0,s._)("div",u,[(0,s._)("div",w,[(0,s._)("h5",b,(0,s.zw)(t.$t("admins")),1),m]),(0,s._)("div",p,[(0,s.Wm)(Zt,{to:"/admins"},{default:(0,s.w5)((function(){return[(0,s._)("h3",null,(0,s.zw)(t.dashboard.admins),1)]})),_:1})])])]),(0,s._)("div",h,[(0,s._)("div",g,[(0,s._)("div",f,[(0,s._)("h5",v,(0,s.zw)(t.$t("dps_transactions")),1),z]),(0,s._)("div",y,[(0,s._)("h3",null,(0,s.zw)(t.numberFormat(t.dashboard.transactions_dps)),1)])])]),(0,s._)("div",D,[(0,s._)("div",k,[(0,s._)("div",x,[(0,s._)("h5",$,(0,s.zw)(t.$t("loan_transactions")),1),F]),(0,s._)("div",O,[(0,s._)("h3",null,(0,s.zw)(t.numberFormat(t.dashboard.transactions_loan)),1)])])])])):(0,s.kq)("",!0),t.dashboard?((0,s.wg)(),(0,s.iD)("div",T,[(0,s._)("div",U,[(0,s._)("div",L,[(0,s._)("div",j,[(0,s._)("h5",P,(0,s.zw)(t.$t("total_collection")),1),C]),(0,s._)("div",M,[(0,s._)("h3",null,(0,s.zw)(t.numberFormat(t.dashboard.total_collection)),1)])])]),(0,s._)("div",S,[(0,s._)("div",W,[(0,s._)("div",N,[(0,s._)("h5",Z,(0,s.zw)(t.$t("total_dues")),1),q]),(0,s._)("div",E,[(0,s._)("h3",null,(0,s.zw)(t.numberFormat(t.dashboard.total_dues)),1)])])]),(0,s._)("div",H,[(0,s._)("div",K,[(0,s._)("div",Y,[(0,s._)("h5",B,(0,s.zw)(t.$t("expenses")),1),A]),(0,s._)("div",G,[(0,s.Wm)(Zt,{to:"/expenses/list"},{default:(0,s.w5)((function(){return[(0,s._)("h3",null,(0,s.zw)(t.numberFormat(t.dashboard.total_expense)),1)]})),_:1})])])]),(0,s._)("div",I,[(0,s._)("div",J,[(0,s._)("div",Q,[(0,s._)("h5",R,(0,s.zw)(t.$t("fund_amount")),1),V]),(0,s._)("div",X,[(0,s._)("h3",null,(0,s.zw)(t.numberFormat(t.dashboard.fund_amount)),1)])])])])):(0,s.kq)("",!0),(0,s._)("div",tt,[(0,s._)("div",at,[(0,s._)("div",nt,[(0,s._)("div",st,[(0,s._)("div",et,[(0,s._)("h5",null,(0,s.zw)(t.$t("recent_dps_transactions")),1)])]),(0,s._)("div",lt,[(0,s._)("table",rt,[(0,s._)("thead",null,[(0,s._)("tr",null,[(0,s._)("th",null,(0,s.zw)(t.$t("tr_no")),1),(0,s._)("th",null,(0,s.zw)(t.$t("members"))+"/"+(0,s.zw)(t.$t("acc_no")),1),(0,s._)("th",null,(0,s.zw)(t.$t("dps_type"))+"/"+(0,s.zw)(t.$t("amount")),1),(0,s._)("th",null,(0,s.zw)(t.$t("balance")),1),(0,s._)("th",null,(0,s.zw)(t.$t("tr_day")),1),(0,s._)("th",null,(0,s.zw)(t.$t("due_date")),1),(0,s._)("th",null,(0,s.zw)(t.$t("issue_date")),1),(0,s._)("th",null,(0,s.zw)(t.$t("status")),1),(0,s._)("th",null,(0,s.zw)(t.$t("action")),1)])]),(0,s._)("tbody",null,[Nt.fetchLatestDpsTransactions?((0,s.wg)(!0),(0,s.iD)(s.HY,{key:0},(0,s.Ko)(Nt.fetchLatestDpsTransactions,(function(a,n){return(0,s.wg)(),(0,s.iD)("tr",{key:a.id},[(0,s._)("td",null,(0,s.zw)(a.transaction_no),1),(0,s._)("td",null,[(0,s.Wm)(Zt,{to:{name:"MemberShow",params:{member_id:a.member_id}},class:"text-primary"},{default:(0,s.w5)((function(){return[(0,s.Uk)((0,s.zw)(a.member.name)+" ",1),it,(0,s.Uk)(" "+(0,s.zw)(a.member.account_no),1)]})),_:2},1032,["to"])]),(0,s._)("td",null,[(0,s.Uk)((0,s.zw)(a.application.dps_type)+" ",1),dt,(0,s.Uk)(" "+(0,s.zw)(t.numberFormat(a.amount)),1)]),(0,s._)("td",null,(0,s.zw)(t.numberFormat(a.balance)),1),(0,s._)("td",null,[(0,s.Uk)((0,s.zw)(t.dayNameFormat(a.transaction_date))+", ",1),ot,(0,s.Uk)(" "+(0,s.zw)(t.userFormattedDate(a.transaction_date)),1)]),(0,s._)("td",null,(0,s.zw)(t.userFormattedDate(a.due_date)),1),(0,s._)("td",null,(0,s.zw)(t.userFormattedDate(a.updated_at)),1),(0,s._)("td",null,[a.is_paid?((0,s.wg)(),(0,s.iD)("span",ct,"Paid")):((0,s.wg)(),(0,s.iD)("span",_t,"Unpaid"))]),(0,s._)("td",null,[a.is_paid?((0,s.wg)(),(0,s.iD)("span",bt,mt)):((0,s.wg)(),(0,s.iD)("span",ut,[(0,s._)("a",{href:"#",class:"btn btn-primary btn-sm py-1",onClick:(0,s.iM)((function(n){return t.showDpsTransactionModal(a)}),["prevent"])}," Collect now ",8,wt)]))])])})),128)):((0,s.wg)(),(0,s.iD)("tr",pt,ht))])])]),gt]),(0,s._)("div",ft,[(0,s._)("div",vt,[(0,s._)("div",zt,[(0,s._)("h5",null,(0,s.zw)(t.$t("recent_loan_transactions")),1)])]),(0,s._)("div",yt,[(0,s._)("table",Dt,[(0,s._)("thead",null,[(0,s._)("tr",null,[(0,s._)("th",null,(0,s.zw)(t.$t("tr_no")),1),(0,s._)("th",null,(0,s.zw)(t.$t("members"))+"/"+(0,s.zw)(t.$t("acc_no")),1),(0,s._)("th",null,(0,s.zw)(t.$t("loan_type"))+"/"+(0,s.zw)(t.$t("amount")),1),(0,s._)("th",null,(0,s.zw)(t.$t("balance")),1),(0,s._)("th",null,(0,s.zw)(t.$t("tr_day")),1),(0,s._)("th",null,(0,s.zw)(t.$t("due_date")),1),(0,s._)("th",null,(0,s.zw)(t.$t("issue_date")),1),(0,s._)("th",null,(0,s.zw)(t.$t("status")),1),(0,s._)("th",null,(0,s.zw)(t.$t("action")),1)])]),(0,s._)("tbody",null,[Nt.fetchLatestLoanTransactions?((0,s.wg)(!0),(0,s.iD)(s.HY,{key:0},(0,s.Ko)(Nt.fetchLatestLoanTransactions,(function(a,n){return(0,s.wg)(),(0,s.iD)("tr",{key:a.id},[(0,s._)("td",null,(0,s.zw)(a.transaction_no),1),(0,s._)("td",null,[(0,s.Wm)(Zt,{to:{name:"MemberShow",params:{member_id:a.member_id}},class:"text-primary"},{default:(0,s.w5)((function(){return[(0,s.Uk)((0,s.zw)(a.member.name)+" ",1),kt,(0,s.Uk)(" "+(0,s.zw)(a.member.account_no),1)]})),_:2},1032,["to"])]),(0,s._)("td",null,[(0,s.Uk)((0,s.zw)(a.application.dps_type)+" ",1),xt,(0,s.Uk)((0,s.zw)(t.numberFormat(a.amount)),1)]),(0,s._)("td",null,(0,s.zw)(t.numberFormat(a.balance)),1),(0,s._)("td",null,[(0,s.Uk)((0,s.zw)(t.dayNameFormat(a.transaction_date))+", ",1),$t,(0,s.Uk)(" "+(0,s.zw)(t.userFormattedDate(a.transaction_date)),1)]),(0,s._)("td",null,(0,s.zw)(t.userFormattedDate(a.due_date)),1),(0,s._)("td",null,(0,s.zw)(t.userFormattedDate(a.updated_at)),1),(0,s._)("td",null,[a.is_paid?((0,s.wg)(),(0,s.iD)("span",Ft,"Paid")):((0,s.wg)(),(0,s.iD)("span",Ot,"Unpaid"))]),(0,s._)("td",null,[a.is_paid?((0,s.wg)(),(0,s.iD)("span",Lt,jt)):((0,s.wg)(),(0,s.iD)("span",Tt,[(0,s._)("a",{href:"#",class:"btn btn-primary btn-sm py-1",onClick:(0,s.iM)((function(n){return t.showLoanTransactionModal(a)}),["prevent"])}," Collect now ",8,Ut)]))])])})),128)):((0,s.wg)(),(0,s.iD)("tr",Pt,Ct))])])]),Mt])])])])}]])}}]);