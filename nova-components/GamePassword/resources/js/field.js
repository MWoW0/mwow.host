Nova.booting((Vue, router, store) => {
    Vue.component('index-game-password', require('./components/IndexField'))
    Vue.component('detail-game-password', require('./components/DetailField'))
    Vue.component('form-game-password', require('./components/FormField'))
})
