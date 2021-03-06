export default [

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------RUTAS GUIA Y PRUEBA------------------------------------------------
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/products', component: require('./components/product/Products.vue').default },
    { path: '/product/tag', component: require('./components/product/Tag.vue').default },
    { path: '/product/category', component: require('./components/product/Category.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },
    { path: '/product/test', component: require('./components/product/Test.vue').default },

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------RUTAS ADMIN------------------------------------------------
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    { path: '/admin/personas', component: require('./components/admin/Personas.vue').default },
    { path: '/admin/organizaciones', component: require('./components/admin/Organizaciones.vue').default },
    { path: '/admin/donativos', component: require('./components/admin/Donativos.vue').default },
    { path: '/admin/Catdonativos', component: require('./components/admin/CatDonativos.vue').default },
    { path: '/admin/voluntario', component: require('./components/admin/Voluntario.vue').default },
    { path: '/admin/voluntarioPersona', component: require('./components/admin/VoluntarioPersona.vue').default },
    { path: '/admin/voluntarioEstudiante', component: require('./components/admin/VoluntarioEstudiante.vue').default },
    { path: '/admin/actividad', component: require('./components/admin/Actividades.vue').default },
  

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------=-------------------------------RUTAS CLIENTE-------------------------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    { path: '/', component: require('./components/cliente/Home.vue').default },
    { path: '/home', component: require('./components/cliente/Home.vue').default },
    { path: '/reservacion', component: require('./components/cliente/Reservar.vue').default },
    { path: '/donaciones', component: require('./components/cliente/Donaciones.vue').default },
    { path: '/pruebas', component: require('./components/cliente/pruebas.vue').default },
];
