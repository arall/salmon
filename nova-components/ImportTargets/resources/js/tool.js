Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'import-targets',
      path: '/import-targets',
      component: require('./components/Tool'),
    },
  ])
})
