import Datepicker from "vue3-date-time-picker";
import moment from 'moment'
import {ref} from "vue";
import store from "../store";

export const helpers = {

    data () {
        return {
            page: 1,
            per_page: 15,
            pages: [],
            lang: localStorage.getItem('lang') ? localStorage.getItem('lang') : 'en',
            is_open_search: false,
            is_loan_open_search: false,
            search_key: "",
            search_date: "",
            search_loan_date: "",
            action_by_user: null,
            perms: store.getters['auth/permissions']
        }
    },

    setup() {
        const date = ref(new Date());
        return {
            date
        }
    },

    components: {
        Datepicker
    },

    methods: {
        numberFormat (number, length) {
            if (!length) {
                length = 2;
            }
            const currency = '৳';
            if (!number) {
                return currency+' '+ 0;
            }
            return currency+' '+ parseFloat(number).toFixed(length)
        },

        userFormattedDate (date) {
            if (date) {
                return moment(date).format("D MMM, YY");
            }
            return '-';
        },

        datePickerFormat (date) {
            return moment(date).format("L");
        },

        dayNameFormat(date) {
            return moment(date).format("dddd");
        },

        openSearch()
        {
            return this.is_open_search = !this.is_open_search
        },

        openLoanSearch()
        {
            return this.is_loan_open_search = !this.is_loan_open_search
        },

        ucFirst(val) {
            if (!val) {
                return false;
            }
            let str = val.replaceAll('_', ' ');
            return str.charAt(0).toUpperCase() + str.slice(1);
        },

        // pagination make
        paginate(data) {
            let page = this.page;
            let perPage = this.per_page;
            let from = (page * perPage) - perPage;
            let to = (page * perPage);
            if (data) {
                return data.slice(from, to);
            }
        },

        hasPermission(permission) {
            if (this.perms.find(perm => {
                return perm.name === permission
            })) {
                return true;
            } else {
                return false;
            }
        },

        message403()
        {
            return this.$swal({
                icon: 'warning',
                title: 'Access Denied',
                text: 'Sorry! you have no permission for the action'
            })
        }
    },
}
