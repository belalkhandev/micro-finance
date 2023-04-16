"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[3566],{1222:(e,a,l)=>{l.d(a,{Z:()=>ke});var n=l(821),m={class:"box"},t={class:"box-body"},r={class:"member member-show"},o={class:"member-img mt-2 mb-2"},s=["src"],i={class:"member-info text-center mb-4"},d={href:"tel:01798673163"},b={class:"member-nav mb-4"},c=(0,n._)("span",null,"Profile",-1),_=(0,n._)("i",{class:"bx bx-chevrons-right"},null,-1),u=(0,n._)("span",null,"DPS/Loan Applications",-1),f=(0,n._)("i",{class:"bx bx-chevrons-right"},null,-1),p=(0,n._)("span",null,"Dps transaction History",-1),h=(0,n._)("i",{class:"bx bx-chevrons-right"},null,-1),v=(0,n._)("span",null,"Loan Transaction history",-1),w=(0,n._)("i",{class:"bx bx-chevrons-right"},null,-1),g=(0,n._)("span",null,"Savings Account",-1),y=(0,n._)("i",{class:"bx bx-chevrons-right"},null,-1),x={class:"member-account mb-2"},D=(0,n._)("h5",null,"Account Overview",-1),k={class:"w-100"},M=(0,n._)("td",null,"Account no",-1),P={class:"text-right"},z=(0,n._)("td",null,"Member Type",-1),T={class:"text-right"},S=(0,n._)("td",null,"Address",-1),O={class:"text-right"},F=(0,n._)("td",null,"Status",-1),U={key:0,class:"text-success text-right"},j={key:1,class:"text-danger text-right"},A={class:"member-download"},N=(0,n._)("h5",null,"Download",-1),W=["href"],V=[(0,n._)("i",{class:"bx bx-download"},null,-1),(0,n.Uk)(" Member Profile ")],L=(0,n._)("button",{type:"button",class:"btn btn-outline-success w-100 mt-2","data-bs-target":"#downloadDpsTransactions","data-bs-toggle":"modal"},[(0,n._)("i",{class:"bx bx-download"}),(0,n.Uk)(" DPS Transactions ")],-1),I=(0,n._)("button",{type:"button",class:"btn btn-outline-info w-100 mt-2","data-bs-target":"#downloadLoanTransactions","data-bs-toggle":"modal"},[(0,n._)("i",{class:"bx bx-download"}),(0,n.Uk)(" Loan Transactions ")],-1);var B=l(4118),C={class:"modal fade",id:"downloadDpsTransactions"},Z={class:"modal-dialog"},G={class:"modal-content"},E=(0,n._)("div",{class:"modal-header"},[(0,n._)("h5",{class:"modal-title"},"Download DPS Transactions"),(0,n._)("button",{type:"button",class:"btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center","data-bs-dismiss":"modal","aria-label":"Close"},[(0,n._)("i",{class:"bx bx-x"})])],-1),q={class:"modal-body"},H={class:"form-group"},$={class:"row"},J=(0,n._)("div",{class:"col-md-4 text-left"},[(0,n._)("label",{class:"col-form-label"},"From Date")],-1),R={class:"col-md-8"},Y={class:"form-group"},K={class:"row"},Q=(0,n._)("div",{class:"col-md-4 text-left"},[(0,n._)("label",{class:"col-form-label"},"To Date")],-1),X={class:"col-md-8"},ee={class:"modal-footer text-right"},ae=["href"],le=[(0,n._)("i",{class:"bx bx-download"},null,-1),(0,n.Uk)(" Download ")];const ne={name:"MemberDpsTransaction",props:{member_id:Number},mixins:[B.B],data:function(){return{form:{member_id:this.member_id,from_date:"",to_date:""},from_date:"",to_date:""}},watch:{from_date:function(){var e=this.datePickerFormat(this.from_date);this.form.from_date="Invalid date"!=e?e:""},to_date:function(){var e=this.datePickerFormat(this.to_date);this.form.to_date="Invalid date"!=e?e:""}}};var me=l(3744);const te=(0,me.Z)(ne,[["render",function(e,a,l,m,t,r){var o=(0,n.up)("Datepicker");return(0,n.wg)(),(0,n.iD)("div",C,[(0,n._)("div",Z,[(0,n._)("div",G,[E,(0,n._)("div",q,[(0,n._)("div",H,[(0,n._)("div",$,[J,(0,n._)("div",R,[(0,n.Wm)(o,{modelValue:t.from_date,"onUpdate:modelValue":a[0]||(a[0]=function(e){return t.from_date=e}),format:"dd-MM-yyyy",enableTimePicker:!1,autoApply:"",placeholder:"Select From Date"},null,8,["modelValue"])])])]),(0,n._)("div",Y,[(0,n._)("div",K,[Q,(0,n._)("div",X,[(0,n.Wm)(o,{modelValue:t.to_date,"onUpdate:modelValue":a[1]||(a[1]=function(e){return t.to_date=e}),format:"dd-MM-yyyy",enableTimePicker:!1,autoApply:"",placeholder:"Select To Date"},null,8,["modelValue"])])])])]),(0,n._)("div",ee,[(0,n._)("a",{href:"/download/dps/"+l.member_id+"/transactions?from_date="+t.form.from_date+"&to_date="+t.form.to_date,class:"btn btn-success",target:"_blank"},le,8,ae)])])])])}]]);var re={class:"modal fade",id:"downloadLoanTransactions"},oe={class:"modal-dialog"},se={class:"modal-content"},ie=(0,n._)("div",{class:"modal-header"},[(0,n._)("h5",{class:"modal-title"},"Download Loan Transactions"),(0,n._)("button",{type:"button",class:"btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center","data-bs-dismiss":"modal","aria-label":"Close"},[(0,n._)("i",{class:"bx bx-x"})])],-1),de={class:"modal-body"},be={class:"form-group"},ce={class:"row"},_e=(0,n._)("div",{class:"col-md-4 text-left"},[(0,n._)("label",{class:"col-form-label"},"From Date")],-1),ue={class:"col-md-8"},fe={class:"form-group"},pe={class:"row"},he=(0,n._)("div",{class:"col-md-4 text-left"},[(0,n._)("label",{class:"col-form-label"},"To Date")],-1),ve={class:"col-md-8"},we={class:"modal-footer text-right"},ge=["href"],ye=[(0,n._)("i",{class:"bx bx-download"},null,-1),(0,n.Uk)(" Download ")];const xe={name:"MemberLoanTransaction",props:{member_id:Number},mixins:[B.B],data:function(){return{form:{member_id:this.member_id,from_date:"",to_date:""},from_date:"",to_date:""}},watch:{from_date:function(){var e=this.datePickerFormat(this.from_date);this.form.from_date="Invalid date"!=e?e:""},to_date:function(){var e=this.datePickerFormat(this.to_date);this.form.to_date="Invalid date"!=e?e:""}}},De={components:{MemberDpsTransaction:te,MemberLoanTransaction:(0,me.Z)(xe,[["render",function(e,a,l,m,t,r){var o=(0,n.up)("Datepicker");return(0,n.wg)(),(0,n.iD)("div",re,[(0,n._)("div",oe,[(0,n._)("div",se,[ie,(0,n._)("div",de,[(0,n._)("div",be,[(0,n._)("div",ce,[_e,(0,n._)("div",ue,[(0,n.Wm)(o,{modelValue:t.from_date,"onUpdate:modelValue":a[0]||(a[0]=function(e){return t.from_date=e}),format:"dd-MM-yyyy",enableTimePicker:!1,autoApply:"",placeholder:"Select From Date"},null,8,["modelValue"])])])]),(0,n._)("div",fe,[(0,n._)("div",pe,[he,(0,n._)("div",ve,[(0,n.Wm)(o,{modelValue:t.to_date,"onUpdate:modelValue":a[1]||(a[1]=function(e){return t.to_date=e}),format:"dd-MM-yyyy",enableTimePicker:!1,autoApply:"",placeholder:"Select To Date"},null,8,["modelValue"])])])])]),(0,n._)("div",we,[(0,n._)("a",{href:"/download/loan/"+l.member_id+"/transactions?from_date="+t.form.from_date+"&to_date="+t.form.to_date,class:"btn btn-success",target:"_blank"},ye,8,ge)])])])])}]])},name:"MemberShowSidebar",props:{member:Object},mixins:[B.B]},ke=(0,me.Z)(De,[["render",function(e,a,l,B,C,Z){var G=(0,n.up)("router-link"),E=(0,n.up)("MemberDpsTransaction"),q=(0,n.up)("MemberLoanTransaction");return(0,n.wg)(),(0,n.iD)(n.HY,null,[(0,n._)("div",m,[(0,n._)("div",t,[(0,n._)("div",r,[(0,n._)("div",o,[l.member.photo?((0,n.wg)(),(0,n.iD)("img",{key:0,src:l.member.photo,alt:"",class:"w-24 img-thumbnail"},null,8,s)):(0,n.kq)("",!0)]),(0,n._)("div",i,[(0,n._)("h3",null,(0,n.zw)(l.member.name),1),(0,n._)("a",d,(0,n.zw)(l.member.phone),1)]),(0,n._)("div",b,[(0,n._)("ul",null,[(0,n._)("li",null,[(0,n.Wm)(G,{to:{name:"MemberShow",params:{member_id:l.member.id}}},{default:(0,n.w5)((function(){return[c,_]})),_:1},8,["to"])]),(0,n._)("li",null,[(0,n.Wm)(G,{to:{name:"MemberApplications",params:{member_id:l.member.id}}},{default:(0,n.w5)((function(){return[u,f]})),_:1},8,["to"])]),(0,n._)("li",null,[(0,n.Wm)(G,{to:{name:"MemberDpsTransaction",params:{member_id:l.member.id}}},{default:(0,n.w5)((function(){return[p,h]})),_:1},8,["to"])]),(0,n._)("li",null,[(0,n.Wm)(G,{to:{name:"MemberLoanTransaction",params:{member_id:l.member.id}}},{default:(0,n.w5)((function(){return[v,w]})),_:1},8,["to"])]),(0,n._)("li",null,[(0,n.Wm)(G,{to:{name:"MemberSavingsProfile",params:{member_id:l.member.id}}},{default:(0,n.w5)((function(){return[g,y]})),_:1},8,["to"])])])]),(0,n._)("div",x,[D,(0,n._)("table",k,[(0,n._)("tr",null,[M,(0,n._)("td",P,(0,n.zw)(l.member.account_no),1)]),(0,n._)("tr",null,[z,(0,n._)("td",T,(0,n.zw)(e.ucFirst(l.member.member_type)),1)]),(0,n._)("tr",null,[S,(0,n._)("td",O,(0,n.zw)(l.member.address),1)]),(0,n._)("tr",null,[F,l.member.is_active?((0,n.wg)(),(0,n.iD)("td",U,"Active")):((0,n.wg)(),(0,n.iD)("td",j,"Inactive"))])])]),(0,n._)("div",A,[N,(0,n._)("a",{href:"/download/member/profile/"+l.member.id,class:"btn btn-outline-primary w-100",download:""},V,8,W),L,I])])])]),(0,n.Wm)(E,{member_id:l.member.id},null,8,["member_id"]),(0,n.Wm)(q,{member_id:l.member.id},null,8,["member_id"])],64)}]])},3566:(e,a,l)=>{l.r(a),l.d(a,{default:()=>je});var n=l(821),m={key:0,class:"row"},t={class:"col-md-3"},r={class:"col-md-9"},o={class:"box animate__animated animate__fadeIn"},s={class:"box-header"},i=(0,n._)("div",{class:"box-title"},[(0,n._)("h5",null,"Member Profile")],-1),d={class:"action"},b=(0,n._)("i",{class:"bx bx-edit"},null,-1),c=(0,n.Uk)(" Edit Profile "),_=["href"],u=[(0,n._)("i",{class:"bx bxs-file-pdf"},null,-1),(0,n.Uk)(" Print Profile ")],f={class:"box-body"},p={class:"member-details"},h={class:"member-detail"},v=(0,n._)("h3",null,"Personal Information",-1),w={class:"member-infos"},g={class:"member-info"},y=(0,n._)("p",null,"Name",-1),x={class:"member-info"},D=(0,n._)("p",null,"Father/Spouse name",-1),k={class:"member-info"},M=(0,n._)("p",null,"Mother name",-1),P={class:"member-info"},z=(0,n._)("p",null,"Phone",-1),T={class:"member-info"},S=(0,n._)("p",null,"Gender",-1),O={class:"member-info"},F=(0,n._)("p",null,"NID",-1),U={key:0,class:"member-detail"},j={key:0},A={key:1},N=(0,n.Uk)(" information"),W={class:"member-infos"},V={class:"member-info"},L=(0,n._)("p",null,"Name",-1),I={class:"member-info"},B=(0,n._)("p",null,"Father/Spouse name",-1),C={class:"member-info"},Z=(0,n._)("p",null,"Mother name",-1),G={class:"member-info"},E=(0,n._)("p",null,"Gender",-1),q={class:"member-info"},H=(0,n._)("p",null,"Phone",-1),$={class:"member-info"},J=(0,n._)("p",null,"Gender",-1),R={class:"member-info"},Y=(0,n._)("p",null,"NID",-1),K={class:"member-info"},Q=(0,n._)("p",null,"Relation",-1),X={class:"member-info"},ee=(0,n._)("p",null,"Address",-1),ae={class:"member-detail"},le=(0,n._)("h3",null,"Account information",-1),ne={class:"member-infos"},me={class:"member-info"},te=(0,n._)("p",null,"Account No",-1),re={class:"member-info"},oe=(0,n._)("p",null,"Joining Date",-1),se={class:"member-info"},ie=(0,n._)("p",null,"Member Type",-1),de={class:"member-info"},be=(0,n._)("p",null,"Group",-1),ce={class:"member-info"},_e=(0,n._)("p",null,"Day",-1),ue={class:"member-detail"},fe=(0,n._)("h3",null,"Managed By User",-1),pe={class:"member-infos"},he={class:"member-info"},ve=(0,n._)("p",null,"Created By",-1),we={class:"member-info"},ge=(0,n._)("p",null,"Last Updated By",-1),ye={class:"member-info"},xe=(0,n._)("p",null,"Created at",-1),De={class:"member-info"},ke=(0,n._)("p",null,"Updated at",-1),Me=(0,n._)("div",{class:"box-footer"},null,-1);var Pe=l(8637),ze=l(1222),Te=l(4118);function Se(e,a){var l=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);a&&(n=n.filter((function(a){return Object.getOwnPropertyDescriptor(e,a).enumerable}))),l.push.apply(l,n)}return l}function Oe(e){for(var a=1;a<arguments.length;a++){var l=null!=arguments[a]?arguments[a]:{};a%2?Se(Object(l),!0).forEach((function(a){Fe(e,a,l[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(l)):Se(Object(l)).forEach((function(a){Object.defineProperty(e,a,Object.getOwnPropertyDescriptor(l,a))}))}return e}function Fe(e,a,l){return a in e?Object.defineProperty(e,a,{value:l,enumerable:!0,configurable:!0,writable:!0}):e[a]=l,e}const Ue={name:"MemberProfileShow",components:{MemberShowSidebar:ze.Z},data:function(){return{member_id:this.$route.params.member_id}},mixins:[Te.B],computed:Oe({},(0,Pe.Se)({member:"member/member"})),methods:Oe({},(0,Pe.nv)({getMember:"member/getMemberByMemberId"})),created:function(){this.getMember(this.member_id)},watch:{"$route.params.member_id":function(e,a){this.getMember(this.member_id)}}};const je=(0,l(3744).Z)(Ue,[["render",function(e,a,l,Pe,ze,Te){var Se=(0,n.up)("member-show-sidebar"),Oe=(0,n.up)("router-link");return e.member?((0,n.wg)(),(0,n.iD)("div",m,[(0,n._)("div",t,[(0,n.Wm)(Se,{member:e.member},null,8,["member"])]),(0,n._)("div",r,[(0,n._)("div",o,[(0,n._)("div",s,[i,(0,n._)("div",d,[(0,n.Wm)(Oe,{to:{name:"EditMember",params:{member_id:e.member.id}},class:"btn btn-warning btn-sm mr-2"},{default:(0,n.w5)((function(){return[b,c]})),_:1},8,["to"]),(0,n._)("a",{href:"/download/member/profile/"+e.member.id,class:"btn btn-secondary btn-sm",target:"_blank"},u,8,_)])]),(0,n._)("div",f,[(0,n._)("div",p,[(0,n._)("div",h,[v,(0,n._)("div",w,[(0,n._)("div",g,[y,(0,n._)("h5",null,(0,n.zw)(e.member.name),1)]),(0,n._)("div",x,[D,(0,n._)("h5",null,(0,n.zw)(e.member.father_name),1)]),(0,n._)("div",k,[M,(0,n._)("h5",null,(0,n.zw)(e.member.mother_name&&"null"!=e.member.mother_name?e.member.mother_name:"No"),1)]),(0,n._)("div",P,[z,(0,n._)("h5",null,(0,n.zw)(e.member.phone),1)]),(0,n._)("div",T,[S,(0,n._)("h5",null,(0,n.zw)(e.ucFirst(e.member.gender)),1)]),(0,n._)("div",O,[F,(0,n._)("h5",null,(0,n.zw)(e.member.nid&&"null"!=e.member.nid?e.member.nid:"No"),1)])])]),e.member.nominee?((0,n.wg)(),(0,n.iD)("div",U,[(0,n._)("h3",null,["loan_weekly"==e.member.member_type||"loan_monthly"==e.member.member_type?((0,n.wg)(),(0,n.iD)("span",j,"Guarantor")):((0,n.wg)(),(0,n.iD)("span",A,"Nominee")),N]),(0,n._)("div",W,[(0,n._)("div",V,[L,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.name),1)]),(0,n._)("div",I,[B,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.father_name),1)]),(0,n._)("div",C,[Z,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.mother_name&&"null"!=e.member.nominee.mother_name?e.member.nominee.mother_name:"No"),1)]),(0,n._)("div",G,[E,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.gender),1)]),(0,n._)("div",q,[H,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.phone),1)]),(0,n._)("div",$,[J,(0,n._)("h5",null,(0,n.zw)(e.ucFirst(e.member.nominee.gender)),1)]),(0,n._)("div",R,[Y,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.nid&&"null"!=e.member.nominee.nid?e.member.nominee.nid:"No"),1)]),(0,n._)("div",K,[Q,(0,n._)("h5",null,(0,n.zw)(e.ucFirst(e.member.nominee.relation)),1)]),(0,n._)("div",X,[ee,(0,n._)("h5",null,(0,n.zw)(e.member.nominee.address),1)])])])):(0,n.kq)("",!0),(0,n._)("div",ae,[le,(0,n._)("div",ne,[(0,n._)("div",me,[te,(0,n._)("h5",null,(0,n.zw)(e.member.account_no),1)]),(0,n._)("div",re,[oe,(0,n._)("h5",null,(0,n.zw)(e.userFormattedDate(e.member.joining_date)),1)]),(0,n._)("div",se,[ie,(0,n._)("h5",null,(0,n.zw)(e.ucFirst(e.member.member_type)),1)]),(0,n._)("div",de,[be,(0,n._)("h5",null,(0,n.zw)(e.member.group?e.member.group.group_name+" ("+e.member.group.group_no+")":"No group"),1)]),(0,n._)("div",ce,[_e,(0,n._)("h5",null,(0,n.zw)(e.member.day),1)])])]),(0,n._)("div",ue,[fe,(0,n._)("div",pe,[(0,n._)("div",he,[ve,(0,n._)("h5",null,(0,n.zw)(e.member.created_by),1)]),(0,n._)("div",we,[ge,(0,n._)("h5",null,(0,n.zw)(e.member.updated_by),1)]),(0,n._)("div",ye,[xe,(0,n._)("h5",null,(0,n.zw)(e.userFormattedDate(e.member.created_at)),1)]),(0,n._)("div",De,[ke,(0,n._)("h5",null,(0,n.zw)(e.userFormattedDate(e.member.updated_at)),1)])])])])]),Me])])])):(0,n.kq)("",!0)}]])}}]);