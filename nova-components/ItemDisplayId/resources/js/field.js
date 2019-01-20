Nova.booting((Vue, router, store) => {
    Vue.component('index-item-display-id', require('./components/IndexField'))
    Vue.component('detail-item-display-id', require('./components/DetailField'))
    Vue.component('form-item-display-id', require('./components/FormField'))
})
