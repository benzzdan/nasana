<template>
    <section class="hero">
        <div class="hero-body" style="padding: 1rem 1.5rem;">
            <div class="container">
                <div class="field has-text-centered">
                    <h1 class="handwritting">Registrarse</h1>
                </div>
                <div class="box" style="margin: 0 20%">
                    <form id="regForm" @submit.prevent="register" method="post">
                    <div class="field">
                            <label  class="label">Nombre completo</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input type="text" class="input" placeholder="nombre" v-model="name" name="name" :class="{ 'is-danger' : errors.name}">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-address-card-o"></i>
                                    </span>
                                </div>
                                <p v-if="error && errors.name" class="help is-danger">{{ errors.name[0]}}</p>

                        </div>
                          <div class="field">
                            <label  class="label">Correo</label>
                                <div class="control has-icons-left has-icons-right" :class="{'is-loading' : isLoadingEmail }">
                                    <input  @input="loadingEmail" name="email" type="text" class="input" placeholder="correo" v-model="email" :class="{ 'is-danger' : errors.email || showBanEmail || emailValidation, 'is-success' : emailCheck }">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <span v-if="showCheckEmail" class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <span v-if="showBanEmail" class="icon is-small is-right">
                                        <i class="fa fa-ban"></i>
                                    </span>
                                </div>
                                <p v-if="error && errors.email" class="help is-danger">{{ errors.email[0]}}</p>
                                <p v-if="invalidEmail" class="help is-danger">La dirección de correo no es válida.</p>
                                <p v-if="error && emailErrors != []" class="help is-danger">{{ emailErrors[0]}}</p>
                        </div>
                        <div class="field">
                            <label  class="label">Usuario</label>
                                <div class="control has-icons-left has-icons-right" :class="{'is-loading' : isLoading }">
                                    <input @input="loading" name="username" type="text" class="input" placeholder="usuario" v-model="username" :class="{ 'is-danger' : errors.username || showBan, 'is-success' : usernameCheck }">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span v-if="showCheck" class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <span v-if="showBan" class="icon is-small is-right">
                                        <i class="fa fa-ban"></i>
                                    </span>
                                      <!-- <span class="icon is-small is-right">
                                        <i :class="showCheck == true && usernameCheck == true ? 'fa fa-check': 'fa fa-ban'"></i>
                                    </span> -->

                                </div>
                                <p v-if="error && errors.username" class="help is-danger">{{ errors.username[0]}}</p>
                                <p v-if="error && userErrors != []" class="help is-danger">{{ userErrors[0]}}</p>

                        </div>
                         <div class="field">
                            <label  class="label">Contraseña</label>
                                <div class="control has-icons-left has-icons-right" :class="{ 'is-loading' :  isLoadingPassword }">
                                    <input  @input="loadingPassword" name="password" type="password" class="input" placeholder="contraseña" v-model="password" :class="{ 'is-danger' : errors.password || checkEmptyPassword , 'is-success' : showCheckPassword }">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <span v-if="showCheckPassword" class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <span v-if="checkEmptyPassword" class="icon is-small is-right">
                                        <i class="fa fa-ban"></i>
                                    </span>
                                </div>
                           <p v-if="error && errors.password" class="help is-danger">{{ errors.password[0]}}</p>
                           <p v-if="checkEmptyPassword" class="help is-danger">Campo requerido.</p>

                        </div>
                         <div class="field">
                            <label  class="label">Confirmar contraseña</label>
                                <div class="control has-icons-left has-icons-right" :class="{ 'is-loading' :  isLoadingConfirmPassword }">
                                    <input :disabled=!validated @input="loadingConfirmPassword" name="confirmPassword" type="password" class="input" placeholder="confirmar contraseña" v-model="confirmPassword" :class="{ 'is-danger' : errors.password || checkIncompatiblePassword, 'is-success': showCheckConfirmPassword}">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <span v-if="showCheckConfirmPassword" class="icon is-small is-right">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <span v-if="checkIncompatiblePassword" class="icon is-small is-right">
                                        <i class="fa fa-ban"></i>
                                    </span>
                                </div>
                           <p v-if="error && errors.password" class="help is-danger">{{ errors.password[0]}}</p>
                           <p v-if="error && incompatiblePasswordError != ''" class="help is-danger">{{ incompatiblePasswordError }}</p>


                        </div>
                        <div class="field has-text-centered" style="margin-top: 1vh">
                            <!-- <a @click="triggerForm" class="button is-success is-large  is-fullwidth">Registrar</a> -->
                            <button :disabled=!validatedConfirmPassword type="submit" class="button is-success is-large is-fullwidth" :class="{ 'is-loading': loadingReg }">Registrar</button>
                        </div>
                    </form>
                         <div class="field">
                            <p>¿Tienes una cuenta?
                                <router-link to="/login">
                                    <a href="#">Inicia Sesión</a>
                                </router-link>
                            </p>
                        </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>

<script>
import _ from 'lodash'
// require('./bootstrap')  todo: try to use babel

    export default {
        data(){
            return {
                //URL de la app
                rootUrl: process.env.MIX_ROOT_URL,
                //info de registro
                name: '',
                loadingReg: false,
                email: '',
                username: '',
                password: '',
                confirmPassword: '',
                //para notificaciones
                error: false,
                errors: {},
                emailErrors: [],
                userErrors: [],
                success: false,
                usernameCheck: null,
                isLoading: false,
                showCheck: false,
                showBan: false,
                isLoadingEmail : false,
                showBanEmail : false,
                emailCheck : false,
                showCheckEmail : false,
                errorValidEmail : false,
                isLoadingPassword : false,
                isLoadingConfirmPassword : false,
                showCheckPassword: false,
                showCheckConfirmPassword: false,
                checkIncompatiblePassword: false,
                checkEmptyPassword: false,
                emailValidation: null,
                validated: false,
                validatedConfirmPassword: false,
                invalidEmail: false,
                incompatiblePasswordError : ''
            }
        },
        watch: {
            username: function(username){
            //    this.checkEmail(email)
                  this.debouncedUsernameCheck()
            },
            email: function(email) {
                this.debouncedEmailCheck()
            },
            password: function(password) {
                this.debouncedCheckPassword()
            },
            confirmPassword: function(password) {
                this.debouncedCheckConfirmPassword()
            }

        },
        methods: {
            register(){

                var app = this
                app.loadingReg = true
                // this.$auth.register({
                //     params: {
                //         name: app.name,
                //         email: app.email,
                //         username: app.username,
                //         password: app.password
                //     },
                //     success: function(){
                //         app.success = true
                //     },
                //     error: function (resp) {
                //         app.error = true;
                //         app.errors = resp.response.data.errors;
                //     },
                //     //TODO: check about the cookie to remember user logged in, meta auth: false
                // })
                app.debouncedRedirectToDashboard()

            },
           checkUsername(){

               var vm = this
               vm.userErrors = []
               vm.isLoading = true
               vm.showCheck = false
               vm.showBan = false

                  if(this.username == ''){
                this.error= true
                this.userErrors.push('Campo requerido.')
                this.showBan = true
                this.isLoading = false

            }else {




               axios.get(this.rootUrl+':8000/api/auth/usernamecheck', {
                   params: {
                       username: vm.username
                   }
               })
                .then(function(resp){
                    console.log(resp)
                    console.log('Successsss!')
                    vm.isLoading = false
                    //Si no encontro usuario existente muestra palomita
                    vm.showCheck = true
                    vm.usernameCheck = true

                })
                //Si encuentra un usuario muestra ban

                 .catch(function(error){
                     console.log('ERRROR USUARIO:')
                     var userError = error.response.data.error
                     vm.isLoading = false
                     vm.showBan = true
                     vm.usernameCheck = false
                     vm.error = true
                     vm.userErrors.push(userError)

                })
           }
           },

           checkEmail(){

               var vm = this
               vm.isLoadingEmail = true
               vm.showCheckEmail = false
               vm.showBanEmail = false

            //checks if email is empty, aqui todavia no hace llamada al API

            if(this.email == ''){
                this.error = true
                this.emailErrors.push('Campo requerido.')
                this.showBanEmail = true
                this.isLoadingEmail = false

            }else{
            //Borrar mensajes de campo vacio antes de iniciar a validar correo
                this.emailErrors = []
            //Validate email sintax
            if (!this.validEmail(this.email)) {
                this.debouncedshowBanEmail()
            }else {
                this.emailErrors = []
                this.error = false
               axios.get(this.rootUrl+':8000/api/auth/emailcheck', {
                   params: {
                       email: vm.email
                   }
               })
                .then(function(resp){
                    console.log(resp.data)
                    console.log('Success')
                    vm.isLoadingEmail = false
                    //Si no encontro usuario existente muestra palomita

                        vm.showCheckEmail = true
                        vm.emailCheck = true
                        vm.errorValidEmail = false
                        vm.showBanEmail = false
                        vm.emailValidation = false

                })
                //Si encuentra un email muestra ban

                 .catch(function(error){
                    var emailError = error.response.data.msg
                     vm.isLoadingEmail = false
                     vm.showBanEmail = true
                     vm.emailCheck = false
                     vm.error = true
                     vm.emailErrors.push(emailError)

                })
                }
            }
           },
           debouncedUsernameCheck: _.debounce(function(e) {
                console.log('loading....')
                this.checkUsername(this.username)
           }, 500),
           debouncedEmailCheck: _.debounce(function(e) {
                console.log('loading email....')
                this.checkEmail(this.email)
           }, 500),
               validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
                },
            debouncedshowBan: _.debounce(function(e) {
                this.isLoadingEmail = false
                this.showBanEmail = true
                this.errorValidEmail = true
            }, 1000),
            debouncedshowBanEmail: _.debounce(function(e) {
                this.isLoadingEmail = false
                this.showBanEmail = true
                this.errorValidEmail = true
                this.invalidEmail = true
                this.showCheckEmail = false
            }, 500),
           loading(){
               this.showCheck = false
               this.isLoading = true
               this.showBan = false
           },
           loadingEmail(){
               this.showBanEmail = false
               this.showCheckEmail = false
               this.isLoadingEmail = true
               this.invalidEmail = false

           },
           validatePassword(){
               if(this.password == ''){
                   this.checkEmptyPassword = true
                    //Bloquea el input the confirm password si esta vacio el de password
                   this.validated = false
               }else {
                   this.showCheckPassword = true
                   //Permite confirmar el password
                   this.validated = true
               }
           },
           validateConfirmPassword(){
                if(this.confirmPassword == this.password && this.password != ''){
                    this.showCheckConfirmPassword = true
                    this.validatedConfirmPassword = true
                }else {
                    this.validatedConfirmPassword = false
                    this.showCheckConfirmPassword = false
                    this.checkIncompatiblePassword = true
                    //Set error
                    this.error = true
                    this.incompatiblePasswordError = 'La contraseña no coincide.'
                }

           },
           loadingPassword(){
               this.isLoadingPassword = true
               this.showCheckPassword = false
               this.checkEmptyPassword = false
           },
           loadingConfirmPassword(){
               this.isLoadingConfirmPassword = true
               this.showCheckConfirmPassword = false
               this.checkIncompatiblePassword = false
               this.incompatiblePasswordError = ''
               this.error = false
           },
             debouncedCheckPassword: _.debounce(function(e) {
                this.isLoadingPassword =  false,
                this.validatePassword()

            }, 500),
             debouncedCheckConfirmPassword: _.debounce(function(e) {
                this.isLoadingConfirmPassword =  false,
                this.validateConfirmPassword()

            }, 500),
             debouncedRedirectToDashboard: _.debounce(function(e) {
                             this.$auth.register({
                    params: {
                        name: this.name,
                        email: this.email,
                        username: this.username,
                        password: this.password
                    },
                    success: function(){
                        this.success = true
                    },
                    error: function (resp) {
                        this.error = true;
                        this.errors = resp.response.data.errors;
                    },
                    //TODO: check about the cookie to remember user logged in, meta auth: false
                    redirect: '/dashboard'
                })
            }, 1000),
            emptyPassword(){
              if(this.password ==  ''){
                  this.emptyPass = 1
              }else{
               this.emptyPass = 0
              }
            }

        }
    }
</script>


