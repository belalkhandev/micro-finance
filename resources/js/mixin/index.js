import moment from "moment";

export const helpers = {
    data () {
        return {
            hello: 'I am from mixin'
        }
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

        dayNameFormat(date) {
            return moment(date).format("dddd");
        },

    },
}
