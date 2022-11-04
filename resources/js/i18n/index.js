import en from './lang/en.json'
import bn from './lang/bn.json'
import { createI18n } from 'vue-i18n'

export default createI18n({
    locale: localStorage.getItem('lang') || 'en',
    fallbackLocale: 'en', //set fallback locale
    messages: {
        en: en,
        bn: bn
    }
})
