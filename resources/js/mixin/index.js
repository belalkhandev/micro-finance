import Datepicker from "vue3-date-time-picker";
import moment from 'moment'
import {ref} from "vue";

export const helpers = {
    data () {
        return {
            page: 1,
            per_page: 10,
            pages: [],
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
            return moment(date).format("LL");
        },

        datePickerFormat (date) {
            return moment(date).format("L");
        },

        dayNameFormat(date) {
            return moment(date).format("dddd");
        },

        // pagination make
        paginate(data) {
            let page = this.page;
            let perPage = this.per_page;
            let from = (page * perPage) - perPage;
            let to = (page * perPage);
            return data.slice(from, to);
        },

    },
}
