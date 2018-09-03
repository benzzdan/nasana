<template>
     <section class="hero is-light is-large">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title handwritting">
                    Nasana
                </h1>
                <h3 class="subtitle">
                    v1.0
                </h3>
            </div>
        </div>
     </section>
</template>
<script>
import _ from 'lodash'
    export default {
      data(){
          return {

          }
      },
      methods: {
          debouncedLogOut: _.debounce(function(e){
              this.$auth.logout()
          }, 1000)

      }
    }
</script>

