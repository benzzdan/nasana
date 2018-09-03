<template>
    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <div class="field has-text-centered">
                    <h1>Inicia Sesión</h1>
                </div>
                <form @submit.prevent="debounceLogin" method="post">
                    <div class="box" style="margin: 0 20%">
                            <div class="field">
                                <label  class="label">Usuario</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name="username" type="text" class="input" placeholder="usuario" v-model="username" :class="{'is-danger' : error}">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                            </div>
                            <div class="field">
                                <label  class="label">Password</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name="password" type="password" class="input" placeholder="password" v-model="password" :class="{'is-danger' : error}">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                            </div>

                            <p v-if="error" class="help is-danger">{{ remoteMsg }}</p>

                            <!-- <div class="field has-text-centered" style="margin-top: 1vh">
                                <a href="#" class="button is-success is-large  is-fullwidth">Iniciar Sesión</a>
                            </div> -->
                            <div class="field">
                                <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                            </div>
                              <div class="field has-text-centered" style="margin-top: 1vh">
                            <!-- <a @click="triggerForm" class="button is-success is-large  is-fullwidth">Registrar</a> -->
                            <button @click="isLoading = true, error = false" type="submit" class="button is-success is-large is-fullwidth" :class="{'is-loading': isLoading }">Iniciar sesión</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                username: null,
                password: null,
                error: false,
                isLoading: false,
                remoteMsg: '',
                // nameRules: [
                //     v => !!v || 'Name is required',
                // ]
            }
        },
        methods: {
            debounceLogin: _.debounce(function(e){
                this.login()
            }, 500),
            login(){
                var app = this
                this.$auth.login({
                    params: {
                        username: app.username,
                        password: app.password
                    },
                    success: function(){
                        console.log('logged in!');
                    },
                    error: function(resp){
                        this.isLoading  = false
                        const errResp = resp.response.data.msg
                        app.error = true;
                        app.errrors = resp.response.data
                        app.remoteMsg = errResp
                    },
                    redirect: '/dashboard'

                })
            }
        }
    }
</script>


