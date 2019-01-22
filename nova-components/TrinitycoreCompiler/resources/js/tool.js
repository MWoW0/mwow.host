Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'trinitycore-compiler',
            path: '/trinitycore-compiler',
            component: require('./components/Tool'),
        },
    ])
})
