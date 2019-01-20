Nova.booting((Vue, router, store) => {
    Vue.component('index-item-quality', require('./components/IndexField'))
    Vue.component('detail-item-quality', require('./components/DetailField'))
    Vue.component('form-item-quality', require('./components/FormField'))
})
