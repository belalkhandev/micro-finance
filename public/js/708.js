"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[708],{7823:(e,t,a)=>{a.d(t,{Z:()=>m});var i=a(821);var s=(e,t)=>{const a=e.__vccOpts||e;for(const[e,i]of t)a[e]=i;return a};const n={inheritAttrs:!1,emits:["pagination-change-page"],components:{RenderlessLaravelVuePagination:{emits:["pagination-change-page"],props:{data:{type:Object,default:()=>{}},limit:{type:Number,default:0},showDisabled:{type:Boolean,default:!1},size:{type:String,default:"default",validator:e=>-1!==["small","default","large"].indexOf(e)},align:{type:String,default:"left",validator:e=>-1!==["left","center","right"].indexOf(e)}},computed:{isApiResource(){return!!this.data.meta},currentPage(){return this.isApiResource?this.data.meta.current_page:this.data.current_page},firstPageUrl(){return this.isApiResource?this.data.links.first:null},from(){return this.isApiResource?this.data.meta.from:this.data.from},lastPage(){return this.isApiResource?this.data.meta.last_page:this.data.last_page},lastPageUrl(){return this.isApiResource?this.data.links.last:null},nextPageUrl(){return this.isApiResource?this.data.links.next:this.data.next_page_url},perPage(){return this.isApiResource?this.data.meta.per_page:this.data.per_page},prevPageUrl(){return this.isApiResource?this.data.links.prev:this.data.prev_page_url},to(){return this.isApiResource?this.data.meta.to:this.data.to},total(){return this.isApiResource?this.data.meta.total:this.data.total},pageRange(){if(-1===this.limit)return 0;if(0===this.limit)return this.lastPage;for(var e,t=this.currentPage,a=this.lastPage,i=this.limit,s=t-i,n=t+i+1,r=[],l=[],o=1;o<=a;o++)(1===o||o===a||o>=s&&o<n)&&r.push(o);return r.forEach((function(t){e&&(t-e==2?l.push(e+1):t-e!=1&&l.push("...")),l.push(t),e=t})),l}},methods:{previousPage(){this.selectPage(this.currentPage-1)},nextPage(){this.selectPage(this.currentPage+1)},selectPage(e){"..."!==e&&this.$emit("pagination-change-page",e)}},render(){return this.$slots.default({data:this.data,limit:this.limit,showDisabled:this.showDisabled,size:this.size,align:this.align,computed:{isApiResource:this.isApiResource,currentPage:this.currentPage,firstPageUrl:this.firstPageUrl,from:this.from,lastPage:this.lastPage,lastPageUrl:this.lastPageUrl,nextPageUrl:this.nextPageUrl,perPage:this.perPage,prevPageUrl:this.prevPageUrl,to:this.to,total:this.total,pageRange:this.pageRange},prevButtonEvents:{click:e=>{e.preventDefault(),this.previousPage()}},nextButtonEvents:{click:e=>{e.preventDefault(),this.nextPage()}},pageButtonEvents:e=>({click:t=>{t.preventDefault(),this.selectPage(e)}})})}}},props:{data:{type:Object,default:()=>{}},limit:{type:Number,default:0},showDisabled:{type:Boolean,default:!1},size:{type:String,default:"default",validator:e=>-1!==["small","default","large"].indexOf(e)},align:{type:String,default:"left",validator:e=>-1!==["left","center","right"].indexOf(e)}},methods:{onPaginationChangePage(e){this.$emit("pagination-change-page",e)}}},r=["tabindex"],l=(0,i._)("span",{"aria-hidden":"true"},"«",-1),o=(0,i._)("span",{class:"sr-only"},"Previous",-1),c={key:0,class:"sr-only"},u=["tabindex"],d=(0,i._)("span",{"aria-hidden":"true"},"»",-1),g=(0,i._)("span",{class:"sr-only"},"Next",-1);var m=s(n,[["render",function(e,t,a,s,n,m){const h=(0,i.up)("RenderlessLaravelVuePagination");return(0,i.wg)(),(0,i.j4)(h,{data:a.data,limit:a.limit,"show-disabled":a.showDisabled,size:a.size,align:a.align,onPaginationChangePage:m.onPaginationChangePage},{default:(0,i.w5)((t=>[t.computed.total>t.computed.perPage?((0,i.wg)(),(0,i.iD)("ul",(0,i.dG)({key:0},e.$attrs,{class:["pagination",{"pagination-sm":"small"==t.size,"pagination-lg":"large"==t.size,"justify-content-center":"center"==t.align,"justify-content-end":"right"==t.align}]}),[t.computed.prevPageUrl||t.showDisabled?((0,i.wg)(),(0,i.iD)("li",{key:0,class:(0,i.C_)(["page-item pagination-prev-nav",{disabled:!t.computed.prevPageUrl}])},[(0,i._)("a",(0,i.dG)({class:"page-link",href:"#","aria-label":"Previous",tabindex:!t.computed.prevPageUrl&&-1},(0,i.mx)(t.prevButtonEvents)),[(0,i.WI)(e.$slots,"prev-nav",{},(()=>[l,o]))],16,r)],2)):(0,i.kq)("",!0),((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(t.computed.pageRange,((e,a)=>((0,i.wg)(),(0,i.iD)("li",{class:(0,i.C_)(["page-item pagination-page-nav",{active:e==t.computed.currentPage}]),key:a},[(0,i._)("a",(0,i.dG)({class:"page-link",href:"#"},(0,i.mx)(t.pageButtonEvents(e))),[(0,i.Uk)((0,i.zw)(e)+" ",1),e==t.computed.currentPage?((0,i.wg)(),(0,i.iD)("span",c,"(current)")):(0,i.kq)("",!0)],16)],2)))),128)),t.computed.nextPageUrl||t.showDisabled?((0,i.wg)(),(0,i.iD)("li",{key:1,class:(0,i.C_)(["page-item pagination-next-nav",{disabled:!t.computed.nextPageUrl}])},[(0,i._)("a",(0,i.dG)({class:"page-link",href:"#","aria-label":"Next",tabindex:!t.computed.nextPageUrl&&-1},(0,i.mx)(t.nextButtonEvents)),[(0,i.WI)(e.$slots,"next-nav",{},(()=>[d,g]))],16,u)],2)):(0,i.kq)("",!0)],16)):(0,i.kq)("",!0)])),_:3},8,["data","limit","show-disabled","size","align","onPaginationChangePage"])}]])},708:(e,t,a)=>{a.r(t),a.d(t,{default:()=>G});var i=a(821),s={class:"row"},n={class:"col-md-4"},r={class:"widget widget-primary mb-4"},l=(0,i._)("div",{class:"widget-header"},[(0,i._)("h5",{class:"title"},"Total Member"),(0,i._)("span",null,[(0,i._)("i",{class:"bx bx-group"})])],-1),o={key:0,class:"widget-body"},c={class:"col-md-4"},u={class:"widget widget-success mb-4"},d=(0,i._)("div",{class:"widget-header"},[(0,i._)("h5",{class:"title"},"Total Members (DPS)"),(0,i._)("span",null,[(0,i._)("i",{class:"bx bx-group"})])],-1),g={key:0,class:"widget-body"},m={class:"col-md-4"},h={class:"widget widget-warning mb-4"},p=(0,i._)("div",{class:"widget-header"},[(0,i._)("h5",{class:"title"},"Total Members (Loan)"),(0,i._)("span",null,[(0,i._)("i",{class:"bx bx-group"})])],-1),b={key:0,class:"widget-body"},f={class:"box"},_={class:"box-header"},w=(0,i._)("div",{class:"box-title"},[(0,i._)("h4",null,"Member list")],-1),v={class:"box-action"},P=(0,i.Uk)("New member"),y={class:"box-body"},x={class:"table"},k=(0,i._)("thead",null,[(0,i._)("tr",null,[(0,i._)("th",null,"#"),(0,i._)("th",null,"Member"),(0,i._)("th",null,"Father/Spouse Name"),(0,i._)("th",null,"Mother Name"),(0,i._)("th",null,"Member Type"),(0,i._)("th",null,"Status"),(0,i._)("th")])],-1),M={key:0},D={class:"application-member"},O=["src"],z={key:0,class:"text-success"},R={key:1,class:"text-danger"},C={class:"action"},U=(0,i._)("i",{class:"bx bx-show"},null,-1),A=(0,i._)("i",{class:"bx bx-edit"},null,-1),j=["onClick"],B=[(0,i._)("i",{class:"bx bx-trash"},null,-1)],S={class:"box-footer"},E={key:0,class:"pagination"},q={class:"pagination-data"};var W=a(8637),$=a(4118);function N(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,i)}return a}function T(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?N(Object(a),!0).forEach((function(t){I(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):N(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function I(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const Y={name:"Index",components:{Pagination:a(7823).Z},mixins:[$.B],computed:T(T({},(0,W.Se)({members:"member/members"})),{},{fetchMembers:function(){return this.members}}),methods:T(T({},(0,W.nv)({getMembers:"member/getMembers",deleteMember:"member/deleteMember"})),{},{deleteConfirm:function(e){var t=this;this.perms.find((function(e){return"delete_member"===e.name}))?this.$swal({title:"Really want to delete!",text:"Are you sure? You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",confirmButtonText:"Yes, Delete it!",cancelButtonColor:"#c82333"}).then((function(a){a.isConfirmed&&t.deleteMember(e).then((function(){t.error_message?t.error=t.error_message:t.$swal({icon:"success",title:"Congratulation!",text:"Member has been deleted successfully"})}))})):this.$swal({icon:"warning",title:"Access Denied",text:"Sorry you have no permission for the action"})},getResults:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;this.getMembers(e)},downloadMember:function(){window.open(window.location.origin+"/download/members/all")}}),mounted:function(){this.getResults(1)}};const G=(0,a(3744).Z)(Y,[["render",function(e,t,a,W,$,N){var T=(0,i.up)("router-link"),I=(0,i.up)("Pagination");return(0,i.wg)(),(0,i.iD)(i.HY,null,[(0,i._)("div",s,[(0,i._)("div",n,[(0,i._)("div",r,[l,N.fetchMembers?((0,i.wg)(),(0,i.iD)("div",o,[(0,i.Wm)(T,{to:"#"},{default:(0,i.w5)((function(){return[(0,i._)("h3",null,(0,i.zw)(N.fetchMembers.total),1)]})),_:1})])):(0,i.kq)("",!0)])]),(0,i._)("div",c,[(0,i._)("div",u,[d,N.fetchMembers?((0,i.wg)(),(0,i.iD)("div",g,[(0,i.Wm)(T,{to:{name:"MemberType",params:{member_type:"deposit"}}},{default:(0,i.w5)((function(){return[(0,i._)("h3",null,(0,i.zw)(N.fetchMembers.total_members_dps),1)]})),_:1})])):(0,i.kq)("",!0)])]),(0,i._)("div",m,[(0,i._)("div",h,[p,N.fetchMembers?((0,i.wg)(),(0,i.iD)("div",b,[(0,i.Wm)(T,{to:{name:"MemberType",params:{member_type:"loan"}}},{default:(0,i.w5)((function(){return[(0,i._)("h3",null,(0,i.zw)(N.fetchMembers.total_members_loan),1)]})),_:1})])):(0,i.kq)("",!0)])])]),(0,i._)("div",f,[(0,i._)("div",_,[w,(0,i._)("div",v,[(0,i._)("button",{class:"btn btn-sm btn-secondary",onClick:t[0]||(t[0]=function(e){return N.downloadMember()})},"Download"),(0,i.Wm)(T,{to:{name:"CreateMember"},class:"btn btn-sm btn-primary"},{default:(0,i.w5)((function(){return[P]})),_:1})])]),(0,i._)("div",y,[(0,i._)("table",x,[k,N.fetchMembers&&N.fetchMembers.data?((0,i.wg)(),(0,i.iD)("tbody",M,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(N.fetchMembers.data,(function(t,a){return(0,i.wg)(),(0,i.iD)("tr",{key:a,class:"animate__animated animate__fadeIn"},[(0,i._)("td",null,(0,i.zw)(N.fetchMembers.from+a),1),(0,i._)("td",null,[(0,i._)("div",D,[(0,i._)("img",{src:t.photo?t.photo:"",alt:"",class:"w-8 rounded"},null,8,O),(0,i._)("div",null,[(0,i.Uk)((0,i.zw)(t.name)+" ",1),(0,i._)("p",null,"Acc. no: "+(0,i.zw)(t.account_no),1)])])]),(0,i._)("td",null,(0,i.zw)(t.father_name),1),(0,i._)("td",null,(0,i.zw)(t.mother_name),1),(0,i._)("td",null,(0,i.zw)(e.ucFirst(t.member_type)),1),t.is_active?((0,i.wg)(),(0,i.iD)("td",z,"Active")):((0,i.wg)(),(0,i.iD)("td",R,"Inactive")),(0,i._)("td",null,[(0,i._)("div",C,[(0,i.Wm)(T,{to:{name:"MemberShow",params:{member_id:t.id}},class:"btn btn-outline-success btn-sm"},{default:(0,i.w5)((function(){return[U]})),_:2},1032,["to"]),(0,i.Wm)(T,{to:{name:"EditMember",params:{member_id:t.id}},class:"btn btn-outline-danger btn-sm"},{default:(0,i.w5)((function(){return[A]})),_:2},1032,["to"]),(0,i._)("a",{href:"#",class:"btn btn-outline-warning btn-sm",onClick:(0,i.iM)((function(e){return N.deleteConfirm(t.id)}),["prevent"])},B,8,j)])])])})),128))])):(0,i.kq)("",!0)])]),(0,i._)("div",S,[N.fetchMembers?((0,i.wg)(),(0,i.iD)("div",E,[(0,i._)("p",q," Page "+(0,i.zw)(N.fetchMembers.current_page)+" Showing "+(0,i.zw)(N.fetchMembers.from)+" to "+(0,i.zw)(N.fetchMembers.to)+" of "+(0,i.zw)(N.fetchMembers.total)+" Data ",1),(0,i.Wm)(I,{data:N.fetchMembers,onPaginationChangePage:N.getResults,limit:6},null,8,["data","onPaginationChangePage"])])):(0,i.kq)("",!0)])])],64)}]])}}]);