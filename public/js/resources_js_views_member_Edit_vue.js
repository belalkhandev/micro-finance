"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_member_Edit_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "Edit",
  data: function data() {
    return {
      form: {
        name: '',
        father_name: '',
        mother_name: '',
        gender: 'male',
        phone: '',
        nid: '',
        member_photo: '',
        district_id: '',
        upazilla_id: '',
        union_id: '',
        post_office_id: '',
        village_id: '',
        address: '',
        joining_date: '',
        account_no: '',
        member_type: '',
        group: '',
        day: '',
        nominee_name: '',
        nominee_father_name: '',
        nominee_mother_name: '',
        nominee_gender: 'male',
        nominee_phone: '',
        nominee_nid: '',
        nominee_photo: '',
        nominee_address: '',
        relation: '',
        member_id: this.$route.params.member_id
      },
      errors: null,
      error: null,
      lang: localStorage.getItem('lang') ? localStorage.getItem('lang') : 'en'
    };
  },
  computed: _objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)({
    members: 'member/members',
    districts: 'location/districts',
    upazillas: 'location/upazillas',
    unions: 'location/unions',
    villages: 'location/villages',
    post_offices: 'location/post_offices',
    groups: 'group/groups',
    days: 'group/days',
    memberTypes: 'group/member_types',
    relations: 'group/relations',
    validation_errors: 'validation_errors',
    error_message: 'error_message'
  })), {}, {
    filterRoles: function filterRoles() {
      return this.roles;
    },
    fetchDistricts: function fetchDistricts() {
      if (this.districts) {
        this.form.district_id = 12;
      }

      return this.districts;
    },
    fetchUpazillas: function fetchUpazillas() {
      var _this = this;

      if (this.form.district_id && this.upazillas) {
        return this.upazillas.filter(function (upazilla) {
          return upazilla.district_id === _this.form.district_id;
        });
      }

      return this.upazillas;
    },
    fetchUnions: function fetchUnions() {
      var _this2 = this;

      if (this.form.upazilla_id && this.unions) {
        return this.unions.filter(function (union) {
          return union.upazilla_id === _this2.form.upazilla_id;
        });
      } else if (this.form.district_id && this.unions) {
        return this.unions.filter(function (union) {
          return union.upazilla.district_id === _this2.form.district_id;
        });
      }

      return this.unions;
    },
    fetchPostOffices: function fetchPostOffices() {
      var _this3 = this;

      if (this.form.upazilla_id && this.post_offices) {
        return this.post_offices.filter(function (po) {
          return po.upazilla_id === _this3.form.upazilla_id;
        });
      } else if (this.form.district_id && this.post_offices) {
        return this.post_offices.filter(function (po) {
          return po.upazilla.district_id === _this3.form.district_id;
        });
      }

      return this.post_offices;
    },
    fetchVillages: function fetchVillages() {
      var _this4 = this;

      if (this.form.union_id && this.villages) {
        return this.villages.filter(function (village) {
          return village.union_id === _this4.form.union_id;
        });
      } else if (this.form.upazilla_id && this.villages) {
        return this.villages.filter(function (village) {
          return village.upazilla_id === _this4.form.upazilla_id;
        });
      } else if (this.form.district_id && this.villages) {
        return this.villages.filter(function (village) {
          return village.union.upazilla.district_id === _this4.form.district_id;
        });
      }

      return this.villages;
    },
    member: function member() {
      var _this5 = this;

      if (this.members && this.form.member_id) {
        var member = this.members.find(function (member) {
          return member.id == _this5.form.member_id;
        });

        if (member) {
          this.form.name = member.name;
          this.form.father_name = member.father_name;
          this.form.mother_name = member.mother_name;
          this.form.gender = member.gender;
          this.form.nid = member.nid;
          this.form.phone = member.phone;
          this.form.phone = member.phone;
          this.form.district_id = member.district_id;
          this.form.upazilla_id = member.upazilla_id;
          this.form.union_id = member.union_id;
          this.form.post_office_id = member.post_office_id;
          this.form.village_id = member.village_id;
          this.form.joining_date = member.joining_date;
          this.form.account_no = member.account_no;
          this.form.member_type = member.member_type;
          this.form.group = member.group_id;
          this.form.day = member.day;
          this.form.nominee_name = member.nominee.name;
          this.form.nominee_father_name = member.nominee.father_name;
          this.form.nominee_mother_name = member.nominee.mother_name;
          this.form.nominee_gender = member.nominee.gender;
          this.form.nominee_phone = member.nominee.phone;
          this.form.nominee_nid = member.nominee.nid;
          this.form.nominee_address = member.nominee.address;
          this.form.relation = member.nominee.relation;
        }
      }
    }
  }),
  methods: _objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapActions)({
    getDistricts: 'location/getDistricts',
    getUpazillas: 'location/getUpazillas',
    getUnions: 'location/getUnions',
    getVillages: 'location/getVillages',
    getGroups: 'group/getGroups',
    getPostOffices: 'location/getPostOffices',
    getMembers: 'member/getMembers',
    editMember: 'member/editMember'
  })), {}, {
    handleMemberPhoto: function handleMemberPhoto() {
      this.form.member_photo = this.$refs.member_photo.files[0];
    },
    handleNomineePhoto: function handleNomineePhoto() {
      this.form.nominee_photo = this.$refs.nominee_photo.files[0];
    },
    updateMember: function updateMember() {
      var _this6 = this;

      jquery__WEBPACK_IMPORTED_MODULE_0___default()('#updateMember').prop('disabled', true).addClass('submitted');
      var formData = new FormData();
      var inputData = this.form;
      Object.keys(inputData).forEach(function (fieldName) {
        formData.append(fieldName, inputData[fieldName]);
      });
      this.editMember(formData).then(function () {
        if (!_this6.validation_errors && !_this6.error_message) {
          _this6.errors = _this6.error = null;
          Object.assign(_this6.$data, _this6.$options.data.apply(_this6));

          _this6.$swal({
            icon: "success",
            title: "Success!",
            text: "Member has been updated successfully",
            timer: 3000
          });
        } else {
          _this6.errors = _this6.validation_errors;
          _this6.error = _this6.error_message;
        }

        jquery__WEBPACK_IMPORTED_MODULE_0___default()('#updateMember').prop('disabled', false).removeClass('submitted');
      });
    }
  }),
  mounted: function mounted() {
    if (!this.members) {
      this.getMembers();
    }

    this.getDistricts();
    this.getUpazillas();
    this.getUnions();
    this.getPostOffices();
    this.getVillages();
    this.getGroups();
  },
  watch: {
    district_id: function district_id() {
      this.form.upazilla_id = "";
      this.form.post_office_id = "";
      this.form.village_id = "";
    },
    upazilla_id: function upazilla_id() {
      this.form.union_id = "";
      this.form.post_office_id = "";
      this.form.village_id = "";
    },
    union_id: function union_id() {
      this.form.village_id = "";
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=template&id=4b9d6e60":
/*!****************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=template&id=4b9d6e60 ***!
  \****************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "box"
};
var _hoisted_2 = {
  "class": "box-header"
};

var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "box-title"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, "Update member")], -1
/* HOISTED */
);

var _hoisted_4 = {
  "class": "box-action"
};

var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Member list");

var _hoisted_6 = {
  "class": "box-body"
};
var _hoisted_7 = {
  "class": "form-section form-section-primary"
};

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "Personal Information", -1
/* HOISTED */
);

var _hoisted_9 = {
  "class": "row"
};
var _hoisted_10 = {
  "class": "col-md-4"
};
var _hoisted_11 = {
  "class": "form-group"
};

var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Name *", -1
/* HOISTED */
);

var _hoisted_13 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_14 = {
  "class": "col-md-4"
};
var _hoisted_15 = {
  "class": "form-group"
};

var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Father/Spouse name *", -1
/* HOISTED */
);

var _hoisted_17 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_18 = {
  "class": "col-md-4"
};
var _hoisted_19 = {
  "class": "form-group"
};

var _hoisted_20 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Mother Name", -1
/* HOISTED */
);

var _hoisted_21 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_22 = {
  "class": "row"
};
var _hoisted_23 = {
  "class": "col-md-4"
};
var _hoisted_24 = {
  "class": "form-group"
};

var _hoisted_25 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Gender *", -1
/* HOISTED */
);

var _hoisted_26 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "male"
}, "Male", -1
/* HOISTED */
);

var _hoisted_27 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "female"
}, "Female", -1
/* HOISTED */
);

var _hoisted_28 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "other"
}, "Other", -1
/* HOISTED */
);

var _hoisted_29 = [_hoisted_26, _hoisted_27, _hoisted_28];
var _hoisted_30 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_31 = {
  "class": "col-md-4"
};
var _hoisted_32 = {
  "class": "form-group"
};

var _hoisted_33 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Phone", -1
/* HOISTED */
);

var _hoisted_34 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_35 = {
  "class": "col-md-4"
};
var _hoisted_36 = {
  "class": "form-group"
};

var _hoisted_37 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "NID", -1
/* HOISTED */
);

var _hoisted_38 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_39 = {
  "class": "row"
};
var _hoisted_40 = {
  "class": "col-md-4"
};
var _hoisted_41 = {
  "class": "form-group"
};

var _hoisted_42 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": ""
}, "Photo", -1
/* HOISTED */
);

var _hoisted_43 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_44 = {
  "class": "form-section form-section-danger"
};

var _hoisted_45 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "Address Information", -1
/* HOISTED */
);

var _hoisted_46 = {
  "class": "row"
};
var _hoisted_47 = {
  "class": "col-md-4"
};
var _hoisted_48 = {
  "class": "form-group"
};

var _hoisted_49 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "District", -1
/* HOISTED */
);

var _hoisted_50 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_51 = ["value"];
var _hoisted_52 = {
  key: 0
};
var _hoisted_53 = {
  key: 1
};
var _hoisted_54 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_55 = {
  "class": "col-md-4"
};
var _hoisted_56 = {
  "class": "form-group"
};

var _hoisted_57 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Upazilla", -1
/* HOISTED */
);

var _hoisted_58 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_59 = ["value"];
var _hoisted_60 = {
  key: 0
};
var _hoisted_61 = {
  key: 1
};
var _hoisted_62 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_63 = {
  "class": "col-md-4"
};
var _hoisted_64 = {
  "class": "form-group"
};

var _hoisted_65 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Union", -1
/* HOISTED */
);

var _hoisted_66 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_67 = ["value"];
var _hoisted_68 = {
  key: 0
};
var _hoisted_69 = {
  key: 1
};
var _hoisted_70 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_71 = {
  "class": "row"
};
var _hoisted_72 = {
  "class": "col-md-4"
};
var _hoisted_73 = {
  "class": "form-group"
};

var _hoisted_74 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Post-Office", -1
/* HOISTED */
);

var _hoisted_75 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_76 = ["value"];
var _hoisted_77 = {
  key: 0
};
var _hoisted_78 = {
  key: 1
};
var _hoisted_79 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_80 = {
  "class": "col-md-4"
};
var _hoisted_81 = {
  "class": "form-group"
};

var _hoisted_82 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Village", -1
/* HOISTED */
);

var _hoisted_83 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_84 = ["value"];
var _hoisted_85 = {
  key: 0
};
var _hoisted_86 = {
  key: 1
};
var _hoisted_87 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_88 = {
  "class": "col-md-4"
};
var _hoisted_89 = {
  "class": "form-group"
};

var _hoisted_90 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Address", -1
/* HOISTED */
);

var _hoisted_91 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_92 = {
  "class": "form-section form-section-success"
};

var _hoisted_93 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "Account Information", -1
/* HOISTED */
);

var _hoisted_94 = {
  "class": "row"
};
var _hoisted_95 = {
  "class": "col-md-4"
};
var _hoisted_96 = {
  "class": "form-group"
};

var _hoisted_97 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Joining Date", -1
/* HOISTED */
);

var _hoisted_98 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_99 = {
  "class": "col-md-4"
};
var _hoisted_100 = {
  "class": "form-group"
};

var _hoisted_101 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Account No", -1
/* HOISTED */
);

var _hoisted_102 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_103 = {
  "class": "col-md-4"
};
var _hoisted_104 = {
  "class": "form-group"
};

var _hoisted_105 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Member Type", -1
/* HOISTED */
);

var _hoisted_106 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_107 = ["value"];
var _hoisted_108 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_109 = {
  "class": "row"
};
var _hoisted_110 = {
  "class": "col-md-4"
};
var _hoisted_111 = {
  "class": "form-group"
};

var _hoisted_112 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Group", -1
/* HOISTED */
);

var _hoisted_113 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select Group", -1
/* HOISTED */
);

var _hoisted_114 = ["value"];
var _hoisted_115 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_116 = {
  "class": "col-md-4"
};
var _hoisted_117 = {
  "class": "form-group"
};

var _hoisted_118 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Day", -1
/* HOISTED */
);

var _hoisted_119 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_120 = ["value"];
var _hoisted_121 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_122 = {
  "class": "form-section form-section-warning"
};

var _hoisted_123 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "Nominee Information", -1
/* HOISTED */
);

var _hoisted_124 = {
  "class": "row"
};
var _hoisted_125 = {
  "class": "col-md-4"
};
var _hoisted_126 = {
  "class": "form-group"
};

var _hoisted_127 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Name *", -1
/* HOISTED */
);

var _hoisted_128 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_129 = {
  "class": "col-md-4"
};
var _hoisted_130 = {
  "class": "form-group"
};

var _hoisted_131 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Father/Spouse name *", -1
/* HOISTED */
);

var _hoisted_132 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_133 = {
  "class": "col-md-4"
};
var _hoisted_134 = {
  "class": "form-group"
};

var _hoisted_135 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Mother Name", -1
/* HOISTED */
);

var _hoisted_136 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_137 = {
  "class": "row"
};
var _hoisted_138 = {
  "class": "col-md-4"
};
var _hoisted_139 = {
  "class": "form-group"
};

var _hoisted_140 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Gender *", -1
/* HOISTED */
);

var _hoisted_141 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "male"
}, "Male", -1
/* HOISTED */
);

var _hoisted_142 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "female"
}, "Female", -1
/* HOISTED */
);

var _hoisted_143 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "other"
}, "Other", -1
/* HOISTED */
);

var _hoisted_144 = [_hoisted_141, _hoisted_142, _hoisted_143];
var _hoisted_145 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_146 = {
  "class": "col-md-4"
};
var _hoisted_147 = {
  "class": "form-group"
};

var _hoisted_148 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Phone", -1
/* HOISTED */
);

var _hoisted_149 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_150 = {
  "class": "col-md-4"
};
var _hoisted_151 = {
  "class": "form-group"
};

var _hoisted_152 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "NID", -1
/* HOISTED */
);

var _hoisted_153 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_154 = {
  "class": "row"
};
var _hoisted_155 = {
  "class": "col-md-4"
};
var _hoisted_156 = {
  "class": "form-group"
};

var _hoisted_157 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Relation with member", -1
/* HOISTED */
);

var _hoisted_158 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, "Select", -1
/* HOISTED */
);

var _hoisted_159 = ["value"];
var _hoisted_160 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_161 = {
  "class": "col-md-8"
};
var _hoisted_162 = {
  "class": "form-group"
};

var _hoisted_163 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": ""
}, "Address", -1
/* HOISTED */
);

var _hoisted_164 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_165 = {
  "class": "row"
};
var _hoisted_166 = {
  "class": "col-md-4"
};
var _hoisted_167 = {
  "class": "form-group"
};

var _hoisted_168 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": ""
}, "Photo", -1
/* HOISTED */
);

var _hoisted_169 = {
  key: 0,
  "class": "text-danger text-sm"
};
var _hoisted_170 = {
  "class": "box-footer"
};
var _hoisted_171 = {
  type: "submit",
  "class": "ml-2 btn btn-primary",
  id: "updateMember"
};

var _hoisted_172 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "spinner-border",
  role: "status"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "visually-hidden"
}, "Loading...")], -1
/* HOISTED */
);

var _hoisted_173 = {
  style: {
    "display": "none"
  }
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'Members'
    },
    "class": "btn btn-sm btn-primary"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_5];
    }),
    _: 1
    /* STABLE */

  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    onSubmit: _cache[27] || (_cache[27] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.updateMember && $options.updateMember.apply($options, arguments);
    }, ["prevent"]))
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [_hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.form.name = $event;
    }),
    placeholder: "Enter name",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.name]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.name ? $data.errors.name[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [_hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.form.father_name = $event;
    }),
    placeholder: "Enter father/spouse name",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.father_name]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.father_name ? $data.errors.father_name[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [_hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $data.form.mother_name = $event;
    }),
    placeholder: "Enter mother name",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.mother_name]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.mother_name ? $data.errors.mother_name[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [_hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $data.form.gender = $event;
    }),
    "class": "form-control"
  }, _hoisted_29, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.gender]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.gender ? $data.errors.gender[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [_hoisted_33, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $data.form.phone = $event;
    }),
    placeholder: "Enter phone",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.phone]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_34, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.phone ? $data.errors.phone[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [_hoisted_37, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $data.form.nid = $event;
    }),
    placeholder: "Enter NID",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nid]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nid ? $data.errors.nid[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [_hoisted_42, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "file",
    "class": "form-control",
    ref: "member_photo",
    id: "member_photo",
    onChange: _cache[6] || (_cache[6] = function ($event) {
      return $options.handleMemberPhoto();
    })
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_43, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.member_photo ? $data.errors.member_photo[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [_hoisted_45, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [_hoisted_49, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $data.form.district_id = $event;
    })
  }, [_hoisted_50, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.fetchDistricts, function (district, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: district.id,
      key: i
    }, [$data.lang == 'en' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_52, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(district.name), 1
    /* TEXT */
    )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_53, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(district.bn_name ? district.bn_name : district.name), 1
    /* TEXT */
    ))], 8
    /* PROPS */
    , _hoisted_51);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.district_id]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_54, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.district_id ? $data.errors.district_id[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [_hoisted_57, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $data.form.upazilla_id = $event;
    })
  }, [_hoisted_58, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.fetchUpazillas, function (upazilla, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: upazilla.id,
      key: i
    }, [$data.lang == 'en' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_60, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(upazilla.name), 1
    /* TEXT */
    )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_61, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(upazilla.bn_name ? upazilla.bn_name : upazilla.name), 1
    /* TEXT */
    ))], 8
    /* PROPS */
    , _hoisted_59);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.upazilla_id]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_62, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.upazilla_id ? $data.errors.upazilla_id[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [_hoisted_65, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $data.form.union_id = $event;
    })
  }, [_hoisted_66, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.fetchUnions, function (union, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: union.id,
      key: i
    }, [$data.lang == 'en' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_68, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(union.name), 1
    /* TEXT */
    )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_69, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(union.bn_name ? union.bn_name : union.name), 1
    /* TEXT */
    ))], 8
    /* PROPS */
    , _hoisted_67);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.union_id]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_70, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.union_id ? $data.errors.union_id[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [_hoisted_74, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $data.form.post_office_id = $event;
    })
  }, [_hoisted_75, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.fetchPostOffices, function (post_office, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: post_office.id,
      key: i
    }, [$data.lang == 'en' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_77, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(post_office.name), 1
    /* TEXT */
    )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_78, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(post_office.bn_name ? post_office.bn_name : post_office.name), 1
    /* TEXT */
    ))], 8
    /* PROPS */
    , _hoisted_76);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.post_office_id]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_79, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.post_office_id ? $data.errors.post_office_id[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [_hoisted_82, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $data.form.village_id = $event;
    })
  }, [_hoisted_83, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.fetchVillages, function (village, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: village.id,
      key: i
    }, [$data.lang == 'en' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_85, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(village.name), 1
    /* TEXT */
    )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_86, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(village.bn_name ? village.bn_name : village.name), 1
    /* TEXT */
    ))], 8
    /* PROPS */
    , _hoisted_84);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.village_id]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_87, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.village_id ? $data.errors.village_id[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_88, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [_hoisted_90, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $data.form.address = $event;
    }),
    "class": "form-control",
    id: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.address]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_91, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.address ? $data.errors.address[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_92, [_hoisted_93, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_94, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [_hoisted_97, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $data.form.joining_date = $event;
    }),
    placeholder: "Enter joining date",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.joining_date]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_98, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.joining_date ? $data.errors.joining_date[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_99, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_100, [_hoisted_101, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $data.form.account_no = $event;
    }),
    placeholder: "Enter account no",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.account_no]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_102, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.account_no ? $data.errors.account_no[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_103, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_104, [_hoisted_105, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $data.form.member_type = $event;
    }),
    "class": "form-control"
  }, [_hoisted_106, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.memberTypes, function (type, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: i,
      value: type.code
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(type.name), 9
    /* TEXT, PROPS */
    , _hoisted_107);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.member_type]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_108, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.member_type ? $data.errors.member_type[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_109, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_110, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_111, [_hoisted_112, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $data.form.group = $event;
    }),
    "class": "form-control"
  }, [_hoisted_113, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.groups, function (group, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: i,
      value: group.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)('(' + group.group_no + ') ' + group.group_name + '-' + group.day), 9
    /* TEXT, PROPS */
    , _hoisted_114);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.group]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_115, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.group ? $data.errors.group[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_116, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_117, [_hoisted_118, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $data.form.day = $event;
    }),
    "class": "form-control"
  }, [_hoisted_119, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.days, function (day, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: i,
      value: day.code
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(day.name), 9
    /* TEXT, PROPS */
    , _hoisted_120);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.day]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_121, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.day ? $data.errors.day[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_122, [_hoisted_123, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_124, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_125, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_126, [_hoisted_127, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $data.form.nominee_name = $event;
    }),
    placeholder: "Enter name",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nominee_name]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_128, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_name ? $data.errors.nominee_name[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_129, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_130, [_hoisted_131, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $data.form.nominee_father_name = $event;
    }),
    placeholder: "Enter father/spouse name",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nominee_father_name]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_132, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_father_name ? $data.errors.nominee_father_name[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_133, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_134, [_hoisted_135, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $data.form.nominee_mother_name = $event;
    }),
    placeholder: "Enter mother name",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nominee_mother_name]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_136, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_mother_name ? $data.errors.nominee_mother_name[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_137, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_138, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_139, [_hoisted_140, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[21] || (_cache[21] = function ($event) {
      return $data.form.nominee_gender = $event;
    }),
    "class": "form-control"
  }, _hoisted_144, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.nominee_gender]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_145, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_gender ? $data.errors.nominee_gender[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_146, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_147, [_hoisted_148, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $data.form.nominee_phone = $event;
    }),
    placeholder: "Enter phone",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nominee_phone]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_149, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_phone ? $data.errors.nominee_phone[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_150, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_151, [_hoisted_152, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[23] || (_cache[23] = function ($event) {
      return $data.form.nominee_nid = $event;
    }),
    placeholder: "Enter NID",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nominee_nid]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_153, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_nid ? $data.errors.nominee_nid[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_154, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_155, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_156, [_hoisted_157, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[24] || (_cache[24] = function ($event) {
      return $data.form.relation = $event;
    }),
    "class": "form-control"
  }, [_hoisted_158, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.relations, function (relation, i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: i,
      value: relation.code
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(relation.name), 9
    /* TEXT, PROPS */
    , _hoisted_159);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.relation]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_160, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.relation ? $data.errors.relation[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_161, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_162, [_hoisted_163, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "onUpdate:modelValue": _cache[25] || (_cache[25] = function ($event) {
      return $data.form.nominee_address = $event;
    }),
    placeholder: "Enter nominee address",
    rows: "1",
    "class": "form-control"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.nominee_address]]), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_164, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_address ? $data.errors.nominee_address[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_165, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_166, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_167, [_hoisted_168, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "file",
    "class": "form-control",
    ref: "nominee_photo",
    id: "nominee_photo",
    onChange: _cache[26] || (_cache[26] = function ($event) {
      return $options.handleNomineePhoto();
    })
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), $data.errors ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_169, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors.nominee_photo ? $data.errors.nominee_photo[0] : ''), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_170, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_171, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$t('save')), 1
  /* TEXT */
  ), _hoisted_172])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_173, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.member), 1
  /* TEXT */
  )], 32
  /* HYDRATE_EVENTS */
  )]);
}

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.form-control {\n    background-color: #ffffff80;\n}\n.form-control:focus {\n    background-color: #ffffff90;\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_style_index_0_id_4b9d6e60_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_style_index_0_id_4b9d6e60_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_style_index_0_id_4b9d6e60_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/views/member/Edit.vue":
/*!********************************************!*\
  !*** ./resources/js/views/member/Edit.vue ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Edit_vue_vue_type_template_id_4b9d6e60__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Edit.vue?vue&type=template&id=4b9d6e60 */ "./resources/js/views/member/Edit.vue?vue&type=template&id=4b9d6e60");
/* harmony import */ var _Edit_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Edit.vue?vue&type=script&lang=js */ "./resources/js/views/member/Edit.vue?vue&type=script&lang=js");
/* harmony import */ var _Edit_vue_vue_type_style_index_0_id_4b9d6e60_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css */ "./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css");
/* harmony import */ var _home_belal_Workspace_micro_finance_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_home_belal_Workspace_micro_finance_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_Edit_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Edit_vue_vue_type_template_id_4b9d6e60__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/views/member/Edit.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/views/member/Edit.vue?vue&type=script&lang=js":
/*!********************************************************************!*\
  !*** ./resources/js/views/member/Edit.vue?vue&type=script&lang=js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Edit.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/views/member/Edit.vue?vue&type=template&id=4b9d6e60":
/*!**************************************************************************!*\
  !*** ./resources/js/views/member/Edit.vue?vue&type=template&id=4b9d6e60 ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_template_id_4b9d6e60__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_template_id_4b9d6e60__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Edit.vue?vue&type=template&id=4b9d6e60 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=template&id=4b9d6e60");


/***/ }),

/***/ "./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css":
/*!****************************************************************************************!*\
  !*** ./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_style_index_0_id_4b9d6e60_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/member/Edit.vue?vue&type=style&index=0&id=4b9d6e60&lang=css");


/***/ })

}]);