export  function authenticated({ next, router }) {
    if (!localStorage.getItem('token')) {
        return router.push({name: 'login'});
    }
    return next();
}

export  function unauthenticated({ next, router }) {
    if (localStorage.getItem('token')) {
        return router.push({name: "dashboard"});
    }
    return next();
}
