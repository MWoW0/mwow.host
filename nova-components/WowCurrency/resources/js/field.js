import VueMask from 'v-mask';

Nova.booting((Vue, router, store) => {
    Vue.use(VueMask);

    Vue.component('index-wow-currency', require('./components/IndexField'))
    Vue.component('detail-wow-currency', require('./components/DetailField'))
    Vue.component('form-wow-currency', require('./components/FormField'))
})
